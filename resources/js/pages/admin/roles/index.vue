<template>
  <div v-can="'view_role'">
    <ContentHeader>
      <template v-slot:actions>
        <router-link :to="{ name: 'roles-create' }" class="btn btn-info" v-can="'create_role'">
          Ajouter
        </router-link>
      </template>
    </ContentHeader>
    <ContentBody>
      <NLDatatable :config="config" @show="show" @delete="destroy" @edit="edit" title="Liste des rôles"
        namespace="roles" />
      <NLModal :show="rowSelected" @close="rowSelected = null">
        <template v-slot:title>Informations rôle</template>
        <template v-slot>
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
              <div class="tags" v-html="rowSelected?.permissions_str"></div>
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
    return { title: 'Rôles' }
  },
  computed: {
    ...mapGetters({
      permissions: 'permissions/all',
      role: 'roles/current',
      roles: 'roles/paginated'
    }),
  },
  data() {
    return {
      rowSelected: null,
      config: {
        data: null,
        columns: [
          {
            label: 'Code',
            field: 'code',
            orderable: true,
          },
          {
            label: 'Name',
            field: 'name',
            orderable: true,
          },
        ],
        actions: {
          show: (item) => {
            return user().authorizations.view_role
          },
          edit: (item) => {
            return user().authorizations.edit_role
          },
          delete: (item) => {
            return user().authorizations.delete_role && item.code !== 'root'
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
      this.$store.dispatch('roles/fetch', item.id).then(() => this.rowSelected = this.role.current)
    },

    /**
     * Redirige vers la page d'edition
     * @param {Object} item
     */
    edit(item) {
      this.$router.push({ name: 'roles-edit', params: { role: item.id } })
    },

    /**
     * Supprime la ressource
     * @param {Object} item
     */
    destroy(item) {
      swal.confirm_destroy().then((action) => {
        if (action.isConfirmed) {
          api.delete('roles/' + item.id).then(response => {
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
      this.$store.dispatch('roles/fetchPaginated').then(() => {
        this.config.data = this.roles.paginated
      })
    }
  }
}
</script>
