<template>
  <div v-if="can('view_role')">
    <ContentHeader>
      <template #actions>
        <router-link v-if="can('create_role')" :to="{ name: 'roles-create' }" class="btn btn-info">
          Ajouter
        </router-link>
      </template>
    </ContentHeader>
    <ContentBody>
      <NLDatatable
        :config="config" title="Liste des rôles" namespace="roles" @show="show" @delete="destroy"
        @edit="edit"
      />
      <NLModal :show="rowSelected" @close="rowSelected = null">
        <template #title>
          Informations rôle
        </template>
        <template #default>
          <div class="grid list">
            <div class="col-12 col-lg-6 list-item">
              <div class="list-item-label">
                Rôle
              </div>
              <div class="list-item-content">
                {{ rowSelected?.name }}
              </div>
            </div>
            <div class="col-12 col-lg-6 list-item">
              <div class="list-item-label">
                Code
              </div>
              <div class="list-item-content">
                {{ rowSelected?.code }}
              </div>
            </div>
            <div class="col-12 list-item">
              <div class="list-item-label">
                Permissions
              </div>
              <div class="tags" v-html="rowSelected?.permissions_str" />
            </div>
          </div>
        </template>
        <template #footer>
          <div v-if="can('delete_role', 'edit_role')" class="d-flex justify-end align-center gap-5 w-100">
            <button v-if="can('delete_role')" class="btn btn-danger has-icon" @click.prevent="destroy(rowSelected)">
              <i class="las la-trash icon" />
              <span class="icon-text">
                Supprimer
              </span>
            </button>
            <button v-if="can('edit_role')" class="btn btn-warning has-icon" @click.prevent="edit(rowSelected)">
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
  layout: 'backend',
  middleware: ['auth', 'admin'],
  metaInfo () {
    return { title: 'Rôles' }
  },
  computed: {
    ...mapGetters({
      permissions: 'permissions/all',
      role: 'roles/current',
      roles: 'roles/paginated'
    })
  },
  data () {
    return {
      rowSelected: null,
      config: {
        data: null,
        columns: [
          {
            label: 'Code',
            field: 'code',
            orderable: true
          },
          {
            label: 'Name',
            field: 'name',
            orderable: true
          }
        ],
        actions: {
          show: (item) => {
            return this.can('view_role')
          },
          edit: (item) => {
            return this.can('edit_role')
          },
          delete: (item) => {
            return this.can('delete_role') && item.code !== 'root'
          }
        }
      }
    }
  },
  created () {
    this.initData()
  },
  methods: {
    /**
     * Affiche les détailles de la resource
     * @param {Object} item
     */
    show (item) {
      this.$store.dispatch('roles/fetch', item.id).then(() => this.rowSelected = this.role.current)
    },

    /**
     * Redirige vers la page d'edition
     * @param {Object} item
     */
    edit (item) {
      this.$router.push({ name: 'roles-edit', params: { role: item.id } })
    },

    /**
     * Supprime la ressource
     * @param {Object} item
     */
    destroy (item) {
      this.$swal.confirm_destroy().then((action) => {
        if (action.isConfirmed) {
          api.delete('roles/' + item.id).then(response => {
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
        this.$swal.alert_error()
      })
    },

    /**
     * Initialise les données
     */
    initData () {
      this.$store.dispatch('roles/fetchPaginated').then(() => {
        this.config.data = this.roles.paginated
      })
    }
  }
}
</script>
