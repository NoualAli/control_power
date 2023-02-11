<template>
  <div>
    <div class="d-flex justify-between align-center">
      <div>
        <button class="btn btn-success has-icon" :class="{ 'is-active': showFilters }"
          @click.prevent="(showFilters = !showFilters)">
          <div class="las la-filter icon"></div>
        </button>
      </div>
      <div>
      </div>
    </div>
    <div class="filter-bar" v-if="showFilters">
      <div class="grid mt-6">
        <div class="col-12 col-lg-4">
          <label for="filter-famillies" class="form-label">Famille</label>
          <select name="filter[familly_id]" id="filter-famillies" class="nl-select" v-model="currentFamilly">
            <option value="" seleted="selected">Filtre Famille</option>
            <option :value="familly.id" v-for="familly in famillies?.all" :key="familly.id">{{ familly.name }}</option>
          </select>
        </div>
        <div class="col-12 col-lg-4" v-if="currentFamilly">
          <label for="filter-domains" class="form-label">Domaine</label>
          <select name="filter[domain_id]" id="filter-domains" class="nl-select" v-model="currentDomain">
            <option value="" seleted="selected">Filtre Domaine</option>
            <option :value="domain.id" v-for="domain in domains?.domains?.data" :key="domain.id">
              {{ domain.name }}
            </option>
          </select>
        </div>
        <div class="col-12 col-lg-4" v-if="currentDomain">
          <label for="filter-processes">Processus</label>
          <select name="filter[process_id]" id="filter-processes" class="nl-select" v-model="currentProcess">
            <option value="" seleted="selected">Filtre Processus</option>
            <option :value="process.id" v-for="process in processes?.processes?.data" :key="process.id">
              {{ process.name }}
            </option>
          </select>
        </div>
      </div>
      <button class="btn btn-danger" @click="resetFilter">
        Annuler
      </button>
    </div>
    <NLDatatable namespace="references" :config="config" :filters="{
      familly_id: this.currentFamilly,
      domain_id: this.currentDomain,
      process_id: this.currentProcess
    }" />
  </div>
</template>

<script>
import NLDatatable from '../../components/NLDatatable'
import { mapGetters } from 'vuex'
import { setTitle } from '../../plugins/settings'
export default {
  middleware: [ 'auth' ],
  layout: 'backend',
  components: { NLDatatable },
  metaInfo() {
    return { title: 'Références PCF' }
  },
  data() {
    return {
      showFilters: false,
      currentFamilly: null,
      currentDomain: null,
      currentProcess: null,
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
    }
  },
  computed: {
    ...mapGetters({
      pcf: 'references/pcf',
      famillies: 'famillies/all',
      domains: 'famillies/domains',
      processes: 'domains/processes',
    }),
  },
  watch: {
    currentFamilly(value) {
      if (value) {
        this.$store.dispatch('famillies/fetchDomains', value)
      } else {
        this.resetFilter()
      }
      this.currentDomain = null
    },
    currentDomain(value) {
      if (value) {
        this.$store.dispatch('domains/fetchProcesses', value)
      }
      this.currentProcess = null
      this.filter()
      this.getFilters()
    },
    currentProcess(value) {
      if (value) {
        this.filter()
      }
      this.getFilters()
    }
  },
  created() {
    setTitle('Références PCF')
    this.$store.dispatch('references/fetchPCF').then(() => this.config.data = this.pcf.pcf)
    this.$store.dispatch('famillies/fetchAll')
  },
  methods: {
    resetFilter() {
      this.currentFamilly = null
      this.currentDomain = null
      this.currentProcess = null
      this.$store.dispatch('references/fetchPCF').then(() => this.config.data = this.pcf.pcf)
    },
    getFilters() {
      return {
        familly_id: this.currentFamilly,
        domain_id: this.currentDomain,
        process_id: this.currentProcess
      }
    },
    filter() {
      if (this.currentFamilly) {
        this.$store.dispatch('references/filterPCF', { famillyId: this.currentFamilly, domainId: this.currentDomain, process: this.currentProcess }).then(() => this.config.data = this.pcf.pcf)
      }
    }
  }
}
</script>
