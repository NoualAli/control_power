<template>
  <div v-if="can('view_control_point')">
    <ContentHeader>
      <template v-slot:actions>
        <router-link :to="{ name: 'control-points-create' }" class="btn btn-info" v-if="can('create_control_point')">
          Ajouter
        </router-link>
      </template>
    </ContentHeader>
    <ContentBody>
      <NLDatatable :config="config" @show="show" @delete="destroy" @edit="edit" namespace="controlPoints"
        title="Liste des Points de contrôle" @filterReset="filterReset" :filters="filtersData" />
      <NLModal :show="rowSelected" @close="rowSelected = null">
        <template v-slot:title>Informations point de contrôle</template>
        <template v-slot>
          <div class="grid list">
            <div class="col-12 col-lg-6 list-item">
              <div class="list-item-label">
                Famille
              </div>
              <div class="list-item-content">
                {{ rowSelected?.familly?.name }}
              </div>
            </div>
            <div class="col-12 col-lg-6 list-item">
              <div class="list-item-label">
                Domaine
              </div>
              <div class="list-item-content">
                {{ rowSelected?.domain?.name }}
              </div>
            </div>
            <div class="col-12 col-lg-6 list-item">
              <div class="list-item-label">
                Processus
              </div>
              <div class="list-item-content">
                {{ rowSelected?.process?.name }}
              </div>
            </div>
            <div class="col-12 col-lg-6 list-item">
              <div class="list-item-label">
                Point de contrôle
              </div>
              <div class="list-item-content">
                {{ rowSelected?.name }}
              </div>
            </div>
            <div class="col-12 list-item" v-if="rowSelected?.scores !== '' && rowSelected?.scores !== null">
              <div class="list-item-label">
                Notations
              </div>
              <div class="tags" v-html="rowSelected?.scores_str">
              </div>
            </div>
            <div class="col-12 list-item" v-if="rowSelected?.fields !== '' && rowSelected?.fields !== null">
              <div class="list-item-label">
                Metadata
              </div>
              <div class="list-item-content no-bg">
                <table>
                  <thead>
                    <tr>
                      <th>Type</th>
                      <th>Label</th>
                      <th>Nom</th>
                      <th>Taille</th>
                      <th>Identifiant</th>
                      <th>Placeholder</th>
                      <th>Text d'aide</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(field, id) in rowSelected?.fields" :key="id">
                      <td>
                        {{ field[0].type }}
                      </td>
                      <td>
                        {{ field[1].label }}
                      </td>
                      <td>
                        {{ field[2].name }}
                      </td>
                      <td>
                        {{ field[3]['length'] }}
                      </td>
                      <td>
                        {{ field[5].id }}
                      </td>
                      <td>
                        {{ field[6].placeholder }}
                      </td>
                      <td>
                        {{ field[7].help_text }}
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </template>
        <template v-slot:footer>
          <div class="d-flex justify-end align-center gap-5 w-100"
            v-if="can(['delete_control_point', 'edit_control_point'])">
            <button class="btn btn-danger has-icon" @click.prevent="destroy(rowSelected)"
              v-if="can('delete_control_point')">
              <i class="las la-trash icon"></i>
              <span class="icon-text">
                Supprimer
              </span>
            </button>
            <button @click.prevent="edit(rowSelected)" class="btn btn-warning has-icon" v-if="can('edit_control_point')">
              <i class="las la-edit icon"></i>
              <span class="icon-text">
                Modifier
              </span>
            </button>
          </div>
        </template>
      </NLModal>
    </ContentBody>
  </div>
</template>

<script>
import NLDatatable from '../../../components/NLDatatable'
import { mapGetters } from 'vuex'
export default {
  components: { NLDatatable },
  layout: 'backend',
  middleware: [ 'auth', 'admin' ],
  metaInfo() {
    return { title: 'Points de contrôle' }
  },
  computed: {
    ...mapGetters({
      controlPoints: 'controlPoints/paginated',
      filters: 'references/filters',
      controlPoint: 'controlPoints/current',
    }),
  },
  data() {
    return {
      rowSelected: null,
      config: {
        data: null,
        columns: [
          {
            label: 'Famille',
            field: 'familly_name',
          },
          {
            label: 'Domaine',
            field: 'domain_name',
          },
          {
            label: 'Processus',
            field: 'process_name',
          },
          {
            label: 'Nom',
            field: 'name',
          },
        ],
        actions: {
          show: (item) => {
            return this.can('view_control_point')
          },
          edit: (item) => {
            return this.can('edit_control_point')
          },
          delete: (item) => {
            return this.can('delete_control_point')
          }
        }
      },
      filtersData: {
        families: {
          label: 'Famille',
          cols: 'col-lg-3',
          multiple: true,
          data: null,
          value: null
        },
        domains: {
          label: 'Domaine',
          cols: 'col-lg-3',
          multiple: true,
          data: null,
          value: null
        },
        processes: {
          label: 'Processus',
          cols: 'col-lg-3',
          multiple: true,
          data: null,
          value: null
        },
      },
    }
  },
  created() {
    this.initFilters()
    this.initData()
  },
  methods: {
    /**
     * Affiche les détailles de la resource
     * @param {Object} item
     */
    show(item) {
      this.$store.dispatch('controlPoints/fetch', item.id).then(() => {
        this.rowSelected = this.controlPoint.current
      })
    },

    /**
     * Redirige vers la page d'edition
     * @param {Object} item
     */
    edit(item) {
      this.$router.push({ name: 'control-points-edit', params: { controlPoint: item.id } })
    },

    /**
     * Supprime la ressource
     * @param {Object} item
     */
    destroy(item) {
      swal.confirm_destroy().then((action) => {
        if (action.isConfirmed) {
          api.delete('control-points/' + item.id).then(response => {
            if (response.data.status) {
              this.rowSelected = null
              this.initData()
              swal.toast_success(response.data.message)
            } else {
              swal.toast_error(response.data.message)
            }
          })
        }
      }).catch(error => {
        swal.alert_error(error.message)
      })
    },

    filterReset() {
      this.filtersData = {
        families: null,
        domains: null,
        processes: null
      }
      this.initData()
    },

    /**
     * Initialise les données
     */
    initData() {
      this.$store.dispatch('controlPoints/fetchPaginated').then(() => {
        this.config.data = this.controlPoints.paginated
      })
    },
    initFilters() {
      this.$store.dispatch('references/fetchPCF', true).then(() => {
        this.filtersData.families.data = this.filters.filters.famillies
        this.filtersData.domains.data = this.filters.filters.domains
        this.filtersData.processes.data = this.filters.filters.processes

        console.log(this.filters.famillies);
      })
    }
  }
}
</script>
