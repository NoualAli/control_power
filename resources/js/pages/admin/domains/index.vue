<template>
  <div v-if="can('view_domain')">
    <ContentHeader>
      <template #actions>
        <router-link v-if="can('create_domain')" :to="{ name: 'domains-create' }" class="btn btn-info">
          Ajouter
        </router-link>
      </template>
    </ContentHeader>
    <ContentBody>
      <NLDatatable :config="config" title="Liste des domaines" namespace="domains" @show="show" @delete="destroy"
        @edit="edit" />
      <NLModal :show="rowSelected" @close="rowSelected = null">
        <template #title>
          Informations domaine
        </template>
        <template #default>
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
        <template #footer>
          <div v-if="can(['delete_domain', 'edit_domain'])" class="d-flex justify-end align-center gap-5 w-100">
            <button v-if="can('delete_domain')" class="btn btn-danger has-icon" @click.prevent="destroy(rowSelected)">
              <i class="las la-trash icon" />
              <span class="icon-text">
                Supprimer
              </span>
            </button>
            <button v-if="can('edit_domain')" class="btn btn-warning has-icon" @click.prevent="edit(rowSelected)">
              <i class="las la-edit icon" />
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
  layout: 'MainLayout',
  middleware: [ 'auth', 'admin' ],
  metaInfo() {
    return { title: 'Domaines' }
  },
  data() {
    return {
      rowSelected: null,
      config: {
        data: null,
        columns: [
          {
            label: 'Famille',
            field: 'familly.name'
          },
          {
            label: 'Nom',
            field: 'name',
            orderable: true
          },
          {
            label: 'Nombres de processus',
            field: 'processes_count'
          }
        ],
        actions: {
          show: (item) => {
            return this.can('view_domain')
          },
          edit: (item) => {
            return this.can('edit_domain')
          },
          delete: (item) => {
            return this.can('delete_domain')
          }
        }
      }
    }
  },
  computed: {
    ...mapGetters({
      domains: 'domains/paginated',
      domain: 'domains/current'
    })
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
      this.$store.dispatch('domains/fetch', { id: item.id }).then(() => { this.rowSelected = this.domain.current })
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
      this.$swal.confirm_destroy().then((action) => {
        if (action.isConfirmed) {
          this.$api.delete('domains/' + item.id).then(response => {
            if (response.data.status) {
              this.rowSelected = null
              this.initData()
              this.$swal.toast_success(response.data.message)
            } else {
              this.$swal.toast_error(response.data.message)
            }
          })
        }
      }).catch(error => {
        console.error(error)
        this.$swal.alert_error()
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
