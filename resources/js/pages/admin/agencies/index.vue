<template>
  <div v-can="'view_agency'">
    <ContentHeader title="Liste des agences">
      <template v-slot:actions>
        <router-link :to="{ name: 'agencies-create' }" class="btn btn-info" v-can="'create_agency'">
          Ajouter
        </router-link>
      </template>
    </ContentHeader>
    <ContentBody>
      <NLDatatable :config="config" @show="show" @delete="destroy" @edit="edit" />
      <NLModal :show="rowSelected" @close="rowSelected = null">
        <template v-slot:title>Informations agence</template>
        <template v-slot>
          <div class="grid list">
            <div class="col-12 col-lg-6 list-item">
              <div class="list-item-label">
                Agence
              </div>
              <div class="list-item-content">
                {{ rowSelected?.full_name }}
              </div>
            </div>
            <div class="col-12 col-lg-6 list-item">
              <div class="list-item-label">
                Dre
              </div>
              <div class="list-item-content">
                {{ rowSelected?.dre?.full_name }}
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
    return { title: 'Agences' }
  },
  computed: {
    ...mapGetters({
      agencies: 'agencies/paginated',
      agency: 'agencies/current',
    }),
  },
  data() {
    return {
      rowSelected: null,
      config: {
        data: null,
        namespace: 'agencies',
        state_key: 'paginated',
        rowKey: 'id',
        search: true,
        columns: [
          {
            label: 'Code',
            field: 'code',
            orderable: true,
          },
          {
            label: 'Nom',
            field: 'name',
            orderable: true,
          },
          {
            label: 'Dre',
            field: 'dre_full_name',
          },
        ],
        actions: {
          show: (item) => {
            return user().authorizations.view_agency
          },
          edit: (item) => {
            return user().authorizations.edit_agency
          },
          delete: (item) => {
            return user().authorizations.delete_agency
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
      this.$store.dispatch('agencies/fetch', item.id).then(() => this.rowSelected = this.agency.current)
    },

    /**
     * Redirige vers la page d'edition
     * @param {Object} item
     */
    edit(item) {
      this.$router.push({ name: 'agencies-edit', params: { agency: item.id } })
    },

    /**
     * Supprime la ressource
     * @param {Object} item
     */
    destroy(item) {
      swal.confirm_destroy().then((action) => {
        if (action.isConfirmed) {
          api.delete('agencies/' + item.id).then(response => {
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
      this.$store.dispatch('agencies/fetchPaginated').then(() => {
        this.config.data = this.agencies.paginated
      })
    }
  }
}
</script>
