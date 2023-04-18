<template>
  <div v-if="can('view_permission')">
    <ContentHeader>
      <template #actions>
        <router-link v-if="can('create_permission')" :to="{ name: 'permissions-create' }" class="btn btn-info">
          Ajouter
        </router-link>
      </template>
    </ContentHeader>
    <ContentBody>
      <NLDatatable
        :config="config" title="Liste des permissions" namespace="permissions" @show="show" @delete="destroy"
        @edit="edit"
      />
      <NLModal :show="rowSelected" @close="rowSelected = null">
        <template #title>
          Informations permission
        </template>
        <template #default>
          <div class="grid list">
            <div class="col-12 col-lg-6 list-item">
              <div class="list-item-label">
                Permission
              </div>
              <div class="list-item-content">
                {{ rowSelected?.name }}
              </div>
            </div>
            <div class="col-12 list-item">
              <div class="list-item-label">
                Rôles
              </div>
              <div class="list-item-content">
                {{ rowSelected?.roles }}
              </div>
            </div>
          </div>
        </template>
        <template #footer>
          <div v-if="can(['delete_permission', 'edit_permission'])" class="d-flex justify-end align-center gap-5 w-100">
            <button v-if="can('delete_permission')" class="btn btn-danger has-icon" @click.prevent="destroy(rowSelected)">
              <i class="las la-trash icon" />
              <span class="icon-text">
                Supprimer
              </span>
            </button>
            <button v-if="can('edit_permission')" class="btn btn-warning has-icon" @click.prevent="edit(rowSelected)">
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
import * as swal from '~/plugins/swal'
import api from '~/plugins/api'
export default {
  components: { NLDatatable },
  layout: 'backend',
  middleware: ['auth', 'admin'],
  metaInfo () {
    return { title: 'Permissions' }
  },
  data () {
    return {
      rowSelected: null,
      config: {
        data: null,
        columns: [
          {
            label: 'Name',
            field: 'name',
            orderable: true
          },
          {
            label: 'Rôles',
            field: 'roles'
          }
        ],
        actions: {
          show: (item) => {
            return this.can('view_permission')
          },
          edit: (item) => {
            return this.can('edit_permission')
          },
          delete: (item) => {
            return this.can('delete_permission')
          }
        }
      }
    }
  },
  computed: {
    ...mapGetters({
      permissions: 'permissions/paginated',
      permission: 'permissions/current'
    })
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
      // this.$store.dispatch('permissions/fetch', item.id).then(() => )
      this.rowSelected = item
    },

    /**
     * Redirige vers la page d'edition
     * @param {Object} item
     */
    edit (item) {
      this.$router.push({ name: 'permissions-edit', params: { permission: item.id } })
    },

    /**
     * Supprime la ressource
     * @param {Object} item
     */
    destroy (item) {
      swal.confirm_destroy().then((action) => {
        if (action.isConfirmed) {
          api.delete('permissions/' + item.id).then(response => {
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
        console.error(error)
        swal.alert_error()
      })
    },

    /**
     * Initialise les données
     */
    initData () {
      this.$store.dispatch('permissions/fetchPaginated').then(() => {
        this.config.data = this.permissions.paginated
      })
    }
  }
}
</script>
