<template>
  <div v-if="can('view_category')">
    <ContentHeader>
      <template #actions>
        <router-link v-if="can('create_category')" :to="{ name: 'categories-create' }" class="btn btn-info">
          Ajouter
        </router-link>
      </template>
    </ContentHeader>
    <ContentBody>
      <NLDatatable
        :config="config" title="Liste des catégories" namespace="categories" @show="show" @delete="destroy"
        @edit="edit"
      />
      <NLModal :show="rowSelected" @close="rowSelected = null">
        <template #title>
          Informations catégorie
        </template>
        <template #default>
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
              <div class="tags" v-html="rowSelected?.processes_tags" />
            </div>
          </div>
        </template>
        <template #footer>
          <div v-if="can('delete_category,edit_category')" class="d-flex justify-end align-center gap-5 w-100">
            <button v-if="can('delete_category')" class="btn btn-danger has-icon" @click.prevent="destroy(rowSelected)">
              <i class="las la-trash icon" />
              <span class="icon-text">
                Supprimer
              </span>
            </button>
            <button v-if="can('edit_category')" class="btn btn-warning has-icon" @click.prevent="edit(rowSelected)">
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
import NLDatatable from '~/components/NLDatatable'
import * as swal from '~/plugins/swal'
import api from '~/plugins/api'
import { mapGetters } from 'vuex'
export default {
  components: { NLDatatable },
  layout: 'backend',
  middleware: ['auth', 'admin'],
  metaInfo () {
    return { title: 'Catégories' }
  },
  data () {
    return {
      rowSelected: null,
      config: {
        data: null,
        columns: [
          {
            label: 'Nom',
            field: 'name',
            orderable: true
          },
          {
            label: 'Total processus',
            field: 'processes_count',
            orderable: true
          }
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
  computed: {
    ...mapGetters({
      categories: 'categories/paginated',
      category: 'categories/current'
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
      this.$store.dispatch('categories/fetch', item.id).then(() => { this.rowSelected = this.category.current })
    },

    /**
     * Redirige vers la page d'edition
     * @param {Object} item
     */
    edit (item) {
      this.$router.push({ name: 'categories-edit', params: { category: item.id } })
    },

    /**
     * Supprime la ressource
     * @param {Object} item
     */
    destroy (item) {
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
        console.error(error)
      })
    },

    /**
     * Initialise les données
     */
    initData () {
      this.$store.dispatch('categories/fetchPaginated').then(() => {
        this.config.data = this.categories.paginated
      })
    }
  }
}
</script>
