<template>
  <div v-if="can('view_familly')">
    <ContentHeader>
      <template #actions>
        <router-link v-if="can('create_familly')" :to="{ name: 'famillies-create' }" class="btn btn-info">
          Ajouter
        </router-link>
      </template>
    </ContentHeader>
    <ContentBody>
      <NLDatatable :config="config" title="Liste des familles" namespace="famillies" @delete="destroy" @edit="edit" />
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
    return { title: 'Famille' }
  },
  computed: {
    ...mapGetters({
      famillies: 'famillies/paginated'
    })
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
            orderable: true
          },
          {
            label: 'Nombre de domaines',
            field: 'domains_count'
          }
        ],
        actions: {
          show: (item) => {
            return false
          },
          edit: (item) => {
            return this.can('edit_familly')
          },
          delete: (item) => {
            return this.can('delete_familly')
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
      this.$store.dispatch('famillies/fetch', item.id).then(() => this.rowSelected = this.familly.current)
    },

    /**
     * Redirige vers la page d'edition
     * @param {Object} item
     */
    edit(item) {
      this.$router.push({ name: 'famillies-edit', params: { familly: item.id } })
    },

    /**
     * Supprime la ressource
     * @param {Object} item
     */
    destroy(item) {
      this.$swal.confirm_destroy().then((action) => {
        if (action.isConfirmed) {
          api.delete('famillies/' + item.id).then(response => {
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
    initData() {
      this.$store.dispatch('famillies/fetchPaginated').then(() => {
        this.config.data = this.famillies.paginated
      })
    }
  }
}
</script>
