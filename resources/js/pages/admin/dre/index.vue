<template>
  <div v-if="can('view_dre')">
    <ContentHeader>
      <template v-slot:actions>
        <router-link :to="{ name: 'dre-create' }" class="btn btn-info" v-if="can('create_dre')">
          Ajouter
        </router-link>
      </template>
    </ContentHeader>
    <ContentBody>
      <NLDatatable :config="config" @show="show" @delete="destroy" @edit="edit" namespace="dre" title="Liste des DRE" />
      <NLModal :show="rowSelected" @close="rowSelected = null">
        <template v-slot:title>Informations dre</template>
        <template v-slot>
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
        <template v-slot:footer>
          <div class="d-flex justify-end align-center gap-5 w-100" v-if="can(['delete_dre', 'edit_dre'])">
            <button class="btn btn-danger has-icon" @click.prevent="destroy(rowSelected)" v-if="can('delete_dre')">
              <i class="las la-trash icon"></i>
              <span class="icon-text">
                Supprimer
              </span>
            </button>
            <button @click.prevent="edit(rowSelected)" class="btn btn-warning has-icon" v-if="can('edit_dre')">
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
    return { title: 'Dre' }
  },
  computed: {
    ...mapGetters({
      dres: 'dre/paginated',
      dre: 'dre/current',
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
            label: 'Nom',
            field: 'name',
            orderable: true,
          },
          {
            label: 'Nombre d\'agences',
            field: 'agencies_count',
          },
        ],
        actions: {
          show: (item) => {
            return this.can('.view_dre')
          },
          edit: (item) => {
            return this.can('.edit_dre')
          },
          delete: (item) => {
            return this.can('.delete_dre')
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
      this.$store.dispatch('dre/fetch', item.id).then(() => this.rowSelected = this.dre.current)
    },

    /**
     * Redirige vers la page d'edition
     * @param {Object} item
     */
    edit(item) {
      this.$router.push({ name: 'dre-edit', params: { dre: item.id } })
    },

    /**
     * Supprime la ressource
     * @param {Object} item
     */
    destroy(item) {
      swal.confirm_destroy().then((action) => {
        if (action.isConfirmed) {
          api.delete('dre/' + item.id).then(response => {
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
      this.$store.dispatch('dre/fetchPaginated').then(() => {
        this.config.data = this.dres.paginated
      })
    }
  }
}
</script>
