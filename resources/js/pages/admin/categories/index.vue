<template>
  <div v-if="can('view_category')">
    <ContentHeader>
      <template #actions>
        <router-link :to="{ name: 'categories-create' }" class="btn btn-info" v-if="can('create_category')">
          Ajouter
        </router-link>
      </template>
    </ContentHeader>
    <ContentBody>
      <NLDatatable :config="config" @show="show" @delete="destroy" @edit="edit" title="Liste des catégories"
        namespace="categories" />
      <NLModal :show="rowSelected" @close="rowSelected = null">
        <template v-slot:title>Informations catégorie</template>
        <template v-slot>
          <div class="grid list">
            <div class="col-12 list-item">
              <div class="list-item-label">
                Catégorie
              </div>
              <div class="list-item-content">
                {{ rowSelected?.name }}
              </div>
            </div>
            <div class="col-12 list-item">
              <div class="list-item-label">
                Processus
              </div>
              <div class="tags" v-html="rowSelected?.processes_tags"></div>
            </div>
          </div>
        </template>
        <template v-slot:footer>
          <div class="d-flex justify-end align-center gap-5 w-100" v-if="can('delete_category,edit_category')">
            <button class="btn btn-danger has-icon" @click.prevent="destroy(rowSelected)" v-if="can('delete_category')">
              <i class="las la-trash icon"></i>
              <span class="icon-text">
                Supprimer
              </span>
            </button>
            <button @click.prevent="edit(rowSelected)" class="btn btn-warning has-icon" v-if="can('edit_category')">
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
    return { title: 'Catégories' }
  },
  computed: {
    ...mapGetters({
      categories: 'categories/paginated',
      category: 'categories/current',
    }),
  },
  data() {
    return {
      rowSelected: null,
      config: {
        data: null,
        columns: [
          {
            label: 'Nom',
            field: 'name',
            orderable: true,
          },
          {
            label: 'Total processus',
            field: 'processes_count',
            orderable: true,
          },
        ],
        actions: {
          show: (item) => {
            return this.can('view_category')
          },
          edit: (item) => {
            return this.can('edit_category')
          },
          delete: (item) => {
            return this.can('delete_category')
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
      this.$store.dispatch('categories/fetch', item.id).then(() => this.rowSelected = this.category.current)
    },

    /**
     * Redirige vers la page d'edition
     * @param {Object} item
     */
    edit(item) {
      this.$router.push({ name: 'categories-edit', params: { category: item.id } })
    },

    /**
     * Supprime la ressource
     * @param {Object} item
     */
    destroy(item) {
      swal.confirm_destroy().then((action) => {
        if (action.isConfirmed) {
          api.delete('categories/' + item.id).then(response => {
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
      this.$store.dispatch('categories/fetchPaginated').then(() => {
        this.config.data = this.categories.paginated
      })
    }
  }
}
</script>
