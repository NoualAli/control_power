<template>
  <ContentBody>
    <NLDatatable :filters="filters" namespace="references" :config="config" />
  </ContentBody>
</template>

<script>
import NLDatatable from '../../components/NLDatatable'
import { mapGetters } from 'vuex'
export default {
  middleware: [ 'auth' ],
  layout: 'backend',
  components: { NLDatatable },
  metaInfo() {
    return { title: 'Références PCF' }
  },
  data() {
    return {
      config: {
        data: null,
        columns: [
          {
            label: 'Famille',
            field: 'familly_name',
            filterable: 'familly_id',
          },
          {
            label: 'Domaine',
            field: 'domain_name',
            filterable: 'domain_id',

          },
          {
            label: 'Processus',
            field: 'process_name',
            filterable: 'process_id',
          },
          {
            label: 'Point de contrôle',
            field: 'control_point_name',
          },
        ],
      },
      filters: {
        familly: {
          label: 'Famille',
          name: 'familly',
          multiple: true,
          data: null,
          value: null
        },
        domain: {
          label: 'Domaine',
          name: 'domain',
          multiple: true,
          data: null,
          value: null
        },
        processId: {
          label: 'Processus',
          name: 'process',
          multiple: true,
          data: null,
          value: null
        },
      }
    }
  },
  computed: {
    ...mapGetters({
      pcf: 'references/pcf',
      filtersData: 'references/filters'
    }),
  },
  created() {
    this.initData()
  },
  methods: {
    initData() {
      this.$store.dispatch('references/fetchPCF').then(() => {
        this.config.data = this.pcf.pcf
        this.initFilters()
      })
    },
    /**
     * Initialise les filtres
     */
    initFilters() {
      this.$store.dispatch('references/fetchPCF', true).then(() => {
        this.filters.familly.data = this.filtersData.filters.famillies
        this.filters.domain.data = this.filtersData.filters.domains
        this.filters.processId.data = this.filtersData.filters.processes
      })
    },
  }
}
</script>
