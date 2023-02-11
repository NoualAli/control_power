<template>
  <div v-can="'view_domain'">
    <ContentHeader>
      <template v-slot:actions>
        <router-link :to="{ name: 'domains-create' }" class="btn btn-info" v-can="'create_domain'">
          Ajouter
        </router-link>
      </template>
    </ContentHeader>
    <ContentBody>
      <NLDatatable :config="config" @show="show" @delete="destroy" @edit="edit" title="Liste des domaines"
        namespace="domains" />
      <NLModal :show="rowSelected" @close="rowSelected = null">
        <template v-slot:title>Informations domaine</template>
        <template v-slot>
          <div class="grid list">
            <div class="col-12 col-lg-6 list-item">
              <div class="list-item-label">
                Domaine
              </div>
              <div class="list-item-content">
                {{ rowSelected?.name }}
              </div>
            </div>
            <div class="col-12 col-lg-6 list-item">
              <div class="list-item-label">
                Famille
              </div>
              <div class="list-item-content">
                {{ rowSelected?.familly?.name }}
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
    return { title: 'Domaines' }
  },
  computed: {
    ...mapGetters({
      domains: 'domains/paginated',
      domain: 'domains/current',
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
            field: 'familly.name',
          },
          {
            label: 'Nom',
            field: 'name',
            orderable: true,
          },
          {
            label: 'Nombres de processus',
            field: 'processes_count',
          },
        ],
        actions: {
          show: (item) => {
            return user().authorizations.view_domain
          },
          edit: (item) => {
            return user().authorizations.edit_domain
          },
          delete: (item) => {
            return user().authorizations.delete_domain
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
      this.$store.dispatch('domains/fetch', { id: item.id }).then(() => this.rowSelected = this.domain.current)
    },

    /**
     * Redirige vers la page d'edition
     * @param {Object} item
     */
    edit(item) {
      this.$router.push({ name: 'domains-edit', params: { domain: item.id } })
    },

    /**
     * Supprime la ressource
     * @param {Object} item
     */
    destroy(item) {
      swal.confirm_destroy().then((action) => {
        if (action.isConfirmed) {
          api.delete('domains/' + item.id).then(response => {
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
      this.$store.dispatch('domains/fetchPaginated').then(() => {
        this.config.data = this.domains.paginated
      })
    }
  }
}
</script>
