<template>
  <div v-if="can('view_process')">
    <ContentHeader>
      <template #actions>
        <router-link v-if="can('create_process')" :to="{ name: 'processes-create' }" class="btn btn-info">
          Ajouter
        </router-link>
      </template>
    </ContentHeader>
    <ContentBody>
      <NLDatatable
        :config="config" title="Liste des processus" namespace="processes" @show="show" @delete="destroy"
        @edit="edit"
      />
      <NLModal :show="rowSelected" @close="rowSelected = null">
        <template #title>
          Informations processus
        </template>
        <template #default>
          <div class="grid list">
            <div class="col-12 col-lg-6 list-item">
              <div class="list-item-label">
                Famille
              </div>
              <div class="list-item-content">
                {{ rowSelected?.familly?.name }}
              </div>
            </div>
            <div class="col-12 col-lg-6 list-item">
              <div class="list-item-label">
                Domaine
              </div>
              <div class="list-item-content">
                {{ rowSelected?.domain?.name }}
              </div>
            </div>
            <div class="col-12 col-lg-6 list-item">
              <div class="list-item-label">
                Processus
              </div>
              <div class="list-item-content">
                {{ rowSelected?.name }}
              </div>
            </div>
          </div>
        </template>
        <template #footer>
          <div v-if="can(['delete_process', 'edit_process'])" class="d-flex justify-end align-center gap-5 w-100">
            <button v-if="can('delete_process')" class="btn btn-danger has-icon" @click.prevent="destroy(rowSelected)">
              <i class="las la-trash icon" />
              <span class="icon-text">
                Supprimer
              </span>
            </button>
            <button v-if="can('edit_process')" class="btn btn-warning has-icon" @click.prevent="edit(rowSelected)">
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
    return { title: 'Processus' }
  },
  data () {
    return {
      rowSelected: null,
      config: {
        data: null,
        columns: [
          {
            label: 'Famille',
            field: 'familly_name'
          },
          {
            label: 'Domaine',
            field: 'domain_name'
          },
          {
            label: 'Nom',
            field: 'name',
            orderable: true
          },
          {
            label: 'Nombres de points de contrôle',
            field: 'control_points_count'
          }
        ],
        actions: {
          show: (item) => {
            return this.can('view_process')
          },
          edit: (item) => {
            return this.can('edit_process')
          },
          delete: (item) => {
            return this.can('delete_process')
          }
        }
      }
    }
  },
  computed: {
    ...mapGetters({
      processes: 'processes/paginated',
      process: 'processes/current'
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
      this.$store.dispatch('processes/fetch', { id: item.id }).then(() => { console.log(this.process); this.rowSelected = this.process.current })
    },

    /**
     * Redirige vers la page d'edition
     * @param {Object} item
     */
    edit (item) {
      this.$router.push({ name: 'processes-edit', params: { process: item.id } })
    },

    /**
     * Supprime la ressource
     * @param {Object} item
     */
    destroy (item) {
      this.$swal.confirm_destroy().then((action) => {
        if (action.isConfirmed) {
          this.$api.delete('processes/' + item.id).then(response => {
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
        console.log(error)
        this.$swal.alert_error()
      })
    },

    /**
     * Initialise les données
     */
    initData () {
      this.$store.dispatch('processes/fetchPaginated').then(() => {
        this.config.data = this.processes.paginated
      })
    }
  }
}
</script>
