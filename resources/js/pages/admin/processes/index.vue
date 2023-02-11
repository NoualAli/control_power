<template>
  <div v-can="'view_process'">
    <ContentHeader>
      <template v-slot:actions>
        <router-link :to="{ name: 'processes-create' }" class="btn btn-info" v-can="'create_process'">
          Ajouter
        </router-link>
      </template>
    </ContentHeader>
    <ContentBody>
      <NLDatatable :config="config" @show="show" @delete="destroy" @edit="edit" title="Liste des processus"
        namespace="processes" />
      <NLModal :show="rowSelected" @close="rowSelected = null">
        <template v-slot:title>Informations processus</template>
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
                {{ rowSelected?.name }}
              </div>
            </div>
          </div>
        </template>
        <template v-slot:footer>
          <div class="d-flex justify-end align-center gap-5 w-100"
            v-if="rowSelected?.authorizations.delete || rowSelected?.authorizations.edit">
            <button class="btn btn-danger has-icon" @click.prevent="destroy(rowSelected)"
              v-if="rowSelected?.authorizations.delete">
              <i class="las la-trash icon"></i>
              <span class="icon-text">
                Supprimer
              </span>
            </button>
            <button @click.prevent="edit(rowSelected)" class="btn btn-warning has-icon"
              v-if="rowSelected?.authorizations.edit">
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
    return { title: 'Processus' }
  },
  computed: {
    ...mapGetters({
      processes: 'processes/paginated',
      process: 'processes/current',
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
            label: 'Nom',
            field: 'name',
            orderable: true,
          },
          {
            label: 'Nombres de points de contrôle',
            field: 'control_points_count',
          },
        ],
        actions: {
          show: (item) => {
            return user().authorizations.view_process
          },
          edit: (item) => {
            return user().authorizations.edit_process
          },
          delete: (item) => {
            return user().authorizations.delete_process
          }
        }
      }
    }
  },
  created() {
    this.initData()
  },
  methods: {
    /**
     * Affiche les détailles de la resource
     * @param {Object} item
     */
    show(item) {
      this.$store.dispatch('processes/fetch', item.id).then(() => this.rowSelected = this.process.current)
    },

    /**
     * Redirige vers la page d'edition
     * @param {Object} item
     */
    edit(item) {
      this.$router.push({ name: 'processes-edit', params: { process: item.id } })
    },

    /**
     * Supprime la ressource
     * @param {Object} item
     */
    destroy(item) {
      swal.confirm_destroy().then((action) => {
        if (action.isConfirmed) {
          api.delete('processes/' + item.id).then(response => {
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
        swal.alert_error()
      })
    },

    /**
     * Initialise les données
     */
    initData() {
      this.$store.dispatch('processes/fetchPaginated').then(() => {
        this.config.data = this.processes.paginated
      })
    }
  }
}
</script>
