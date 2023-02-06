<template>
  <ContentBody>
    <NLDatatable :config="config" />
  </ContentBody>
</template>

<script>
import { mapGetters } from 'vuex';
import api from '../../plugins/api';
export default {
  layout: 'backend',
  middleware: [ 'auth' ],
  computed: {
    ...mapGetters({
      'notifications': 'notifications/paginated'
    })
  },
  created() {
    this.initData()
  },
  data: () => {
    return {
      config: {
        data: null,
        namespace: 'notifications',
        state_key: 'paginated',
        rowKey: 'id',
        columns: [
          {
            label: 'Titre',
            field: 'title',
            methods: {
              style(item) {
                if (item.read_at == '-') {
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
                if (item.read_at == '-') {
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
                if (item.read_at == '-') {
                  return 'bg-primary-extra-light'
                }
              }
            }
          },
        ],
      }
    }
  },
  methods: {
    initData() {
      this.$store.dispatch('notifications/fetchPaginated').then(() => {
        this.config.data = this.notifications.paginated
        if (Object.entries(this.notifications.paginated).length) {
          this.markAsRead()
        }
      })
    },
    async markAsRead() {
      await api.put('notifications')
    }
  },
}
</script>
