<template>
  <div v-if="can('view_dre')">
    <ContentHeader>
      <template #actions>
        <router-link v-if="can('create_dre')" :to="{ name: 'dre-create' }" class="btn btn-info">
          Ajouter
        </router-link>
      </template>
    </ContentHeader>
    <ContentBody>
      <NLDatatable :config="config" namespace="dre" title="Liste des DRE" @show="show" @delete="destroy" @edit="edit" />
      <NLModal :show="rowSelected" @close="rowSelected = null">
        <template #title>
          Informations dre
        </template>
        <template #default>
          <div class="grid list">
            <div class="col-12 col-lg-6 list-item">
              <div class="list-item-label">
                Dre
              </div>
              <div class="list-item-content">
                {{ rowSelected?.full_name }}
              </div>
            </div>
            <div class="col-12 list-item">
              <div class="list-item-label">
                Agences
              </div>
              <div class="list-item-content">
                {{ rowSelected?.agencies_str }}
              </div>
            </div>
          </div>
        </template>
        <template #footer>
          <div v-if="can(['delete_dre', 'edit_dre'])" class="d-flex justify-end align-center gap-5 w-100">
            <button v-if="can('delete_dre')" class="btn btn-danger has-icon" @click.prevent="destroy(rowSelected)">
              <i class="las la-trash icon" />
              <span class="icon-text">
                Supprimer
              </span>
            </button>
            <button v-if="can('edit_dre')" class="btn btn-warning has-icon" @click.prevent="edit(rowSelected)">
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
    return { title: 'Dre' }
  },
  computed: {
    ...mapGetters({
      dres: 'dre/paginated',
      dre: 'dre/current'
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
            label: 'Nom',
            field: 'name',
            orderable: true
          },
          {
            label: 'Nombre d\'agences',
            field: 'agencies_count'
          }
        ],
        actions: {
          show: (item) => {
            return this.can('view_dre')
          },
          edit: (item) => {
            return this.can('edit_dre')
          },
          delete: (item) => {
            return this.can('delete_dre')
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
      this.$store.dispatch('dre/fetch', item.id).then(() => this.rowSelected = this.dre.current)
    },

    /**
     * Redirige vers la page d'edition
     * @param {Object} item
     */
    edit (item) {
      this.$router.push({ name: 'dre-edit', params: { dre: item.id } })
    },

    /**
     * Supprime la ressource
     * @param {Object} item
     */
    destroy (item) {
      this.$swal.confirm_destroy().then((action) => {
        if (action.isConfirmed) {
          api.delete('dre/' + item.id).then(response => {
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
      this.$store.dispatch('dre/fetchPaginated').then(() => {
        this.config.data = this.dres.paginated
      })
    }
  }
}
</script>
