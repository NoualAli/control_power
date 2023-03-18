<template>
  <div v-if="can('view_user')">
    <ContentHeader>
      <template v-slot:actions>
        <router-link :to="{ name: 'users-create' }" class="btn btn-info" v-if="can('create_user')">
          Ajouter
        </router-link>
      </template>
    </ContentHeader>
    <ContentBody>
      <NLDatatable :config="config" @show="show" @delete="destroy" @edit="edit" title="Liste des utilisateurs"
        namespace="users" />
      <NLModal :show="rowSelected" @close="rowSelected = null">
        <template v-slot:title>Informations utilisateur</template>
        <template v-slot>
          <div class="grid list">
            <div class="col-12 d-flex justify-center align-center">
              <Avatar :avatar="rowSelected?.avatar" />
            </div>
            <div class="col-12 col-lg-6 list-item">
              <div class="list-item-label">
                Nom complet
              </div>
              <div class="list-item-content">
                {{ rowSelected?.full_name }}
              </div>
            </div>
            <div class="col-12 col-lg-6 list-item">
              <div class="list-item-label">
                Rôle
              </div>
              <div class="list-item-content">
                {{ rowSelected?.roles_str }}
              </div>
            </div>
            <div class="col-12 col-lg-6 list-item">
              <div class="list-item-label">
                Adresse email
              </div>
              <div class="list-item-content">
                {{ rowSelected?.email }}
              </div>
            </div>
            <div class="col-12 col-lg-6 list-item">
              <div class="list-item-label">
                Nom d'utilisateur
              </div>
              <div class="list-item-content">
                {{ rowSelected?.username }}
              </div>
            </div>
            <div class="col-12 col-lg-6 list-item">
              <div class="list-item-label">
                N° de téléphone
              </div>
              <div class="list-item-content">
                {{ rowSelected?.phone ? rowSelected?.phone : '-' }}
              </div>
            </div>
            <div class="col-12 col-lg-6 list-item">
              <div class="list-item-label">
                DRE
              </div>
              <div class="list-item-content">
                {{ rowSelected?.dres_str }}
              </div>
            </div>
          </div>
        </template>
        <template v-slot:footer>
          <div class="d-flex justify-end align-center gap-5 w-100"
            v-if="!isCurrent(rowSelected) && can('delete_user', 'edit_user')">
            <button class="btn btn-danger has-icon" @click.prevent="destroy(rowSelected)" v-if="can('edit_user')">
              <i class="las la-trash icon"></i>
              <span class="icon-text">
                Supprimer
              </span>
            </button>
            <button @click.prevent="edit(rowSelected)" class="btn btn-warning has-icon" v-if="can('edit_user')">
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
import NLModal from '../../../components/NLModal'
import { mapGetters } from 'vuex'
import Avatar from '../../../components/Avatar.vue'
import { user } from '../../../plugins/user'
export default {
  components: { NLDatatable, NLModal, Avatar },
  layout: 'backend',
  middleware: [ 'auth', 'admin' ],
  metaInfo() {
    return { title: 'Utilisateurs' }
  },
  data() {
    return {
      rowSelected: null,
      config: {
        data: null,
        columns: [
          {
            label: "Nom d'utilisateur",
            field: 'username',
            orderable: true,
          },
          {
            label: 'Nom complet',
            field: 'full_name',
          },
          {
            label: 'Adresse email',
            field: 'email',
            orderable: true
          },
          {
            label: 'DRE',
            field: 'dres',
          },
          {
            label: 'Rôles',
            field: 'roles',
          },
        ],
        actions: {
          show: true,
          edit: (item) => {
            return !this.isCurrent(item) && this.can('edit_user') && !item.roles.includes('root')
          },
          delete: (item) => {
            return !this.isCurrent(item) && this.can('delete_user') && !item.roles.includes('root')
          }
        }
      },
    }

  },
  computed: mapGetters({
    users: 'users/paginated',
    user: 'users/current'
  }),
  methods: {
    /**
     * Vérifie si la ligne correspond à l'utilisateur actuel
     * @param {Object} item
     */
    isCurrent(item) {
      return item?.id == user()?.id
    },
    /**
     * Affiche les détailles de la resource
     * @param {Object} item
     */
    show(item) {
      this.$store.dispatch('users/fetch', item.id).then(() => this.rowSelected = this.user.current)
    },

    /**
     * Redirige vers la page d'edition
     * @param {Object} item
     */
    edit(item) {
      this.$router.push({ name: 'users-edit', params: { user: item.id } })
    },

    /**
     * Supprime la ressource
     * @param {Object} item
     */
    destroy(item) {
      swal.confirm_destroy().then((action) => {
        if (action.isConfirmed) {
          api.delete('users/' + item.id).then(response => {
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
      this.$store.dispatch('users/fetchPaginated').then(() => {
        this.config.data = this.users.paginated
      })
    }
  },
  mounted() {
    this.initData()
  }
}
</script>
