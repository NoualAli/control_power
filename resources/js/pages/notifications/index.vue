<template>
  <ContentBody>
    <NLDatatable namespace="notifications" :searchable="false" :config="config" @show="show" />
  </ContentBody>
</template>

<script>
import { mapGetters } from 'vuex'
import api from '../../plugins/api'
export default {
  layout: 'MainLayout',
  middleware: [ 'auth' ],
  metaInfo() {
    return { title: 'Centre de notification' }
  },
  data: () => {
    return {
      config: {
        data: null,
        columns: [
          {
            label: 'Titre',
            field: 'title',
            methods: {
              style(item) {
                if (item.read_at === '-') {
                  return 'bg-primary-extra-light'
                }
              }
            }
          },
          {
            label: 'Contenu',
            field: 'content',
            methods: {
              style(item) {
                if (item.read_at === '-') {
                  return 'bg-primary-extra-light'
                }
              }
            }
          },
          {
            label: 'Date',
            field: 'created_at',
            methods: {
              style(item) {
                if (item.read_at === '-') {
                  return 'bg-primary-extra-light'
                }
              }
            }
          }
        ],
        actions: {
          show: (item) => !!item.url
        }
      }
    }
  },
  computed: {
    ...mapGetters({
      notifications: 'notifications/paginated'
    })
  },
  created() {
    this.initData()
  },
  methods: {
    /**
     * Initialise les données
     */
    initData() {
      this.$store.dispatch('notifications/fetchPaginated').then(() => {
        this.config.data = this.notifications.paginated
        if (Object.entries(this.notifications.paginated).length) {
          this.markAsRead()
        }
      })
    },
    /**
     * Affiche l'élément seléctionner
     *
     * @param {Object} item
     */
    show(item) {
      const { pathname, search } = new URL(item.url)
      this.$router.push({ path: pathname, query: Object.fromEntries(new URLSearchParams(search)) })
    },
    /**
     * Formate les différentes informations pour créer la route d'action
     *
     * @param {Object} item
     */
    getRoute(item) {
      if (item.url) {
        return item.url
      } else {
        const paramName = item.paramName
        const id = item.modelId
        const routeName = item.routeName
        return { name: routeName, params: { [ paramName ]: id } }
      }
    },
    /**
     * Marque les notifications comme lu
     */
    async markAsRead() {
      await api.put('notifications')
    }
  }
}
</script>
