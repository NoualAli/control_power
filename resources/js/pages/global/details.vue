<template>
  <ContentBody>
    <NLDatatable :config="config" @show="show" />
    <NLModal :show="rowSelected" @close="close">
      <template v-slot:title>
        <small class="tag is-primary-dark text-small">
          {{ rowSelected?.cdc_reference }}
        </small>
        <small class="tag is-primary-extra-light text-small mx-1">
          {{ rowSelected?.mission_reference }}
        </small>
        <small class="tag text-small text-white text-white mx-1"
          :class="{ 'is-danger': rowSelected?.major_fact_str == 'Oui', 'is-success': rowSelected?.major_fact_str == 'Non' }">
          Fait majeur: {{ rowSelected?.major_fact_str }}
        </small>
      </template>
      <template v-slot>
        <div class="grid gap-6">
          <div class="col-12 col-lg-6">
            <span class="label">Dre: </span>
            <span>{{ rowSelected?.dre_full_name }}</span>
          </div>
          <div class="col-12 col-lg-6">
            <span class="label">Agence: </span>
            <span>{{ rowSelected?.agency_full_name }}</span>
          </div>
          <div class="col-12 col-lg-6">
            <span class="label">Famille: </span>
            <span>{{ rowSelected?.familly_name }}</span>
          </div>
          <div class="col-12 col-lg-6">
            <span class="label">Domaine: </span>
            <span>{{ rowSelected?.domain_name }}</span>
          </div>
          <div class="col-12">
            <span class="label">Processus: </span>
            <span>{{ rowSelected?.process_name }}</span>
          </div>
          <div class="col-12">
            <span class="label">Point de contrôle: </span>
            <span>{{ rowSelected?.control_point_name }}</span>
          </div>
          <div class="col-12 col-lg-6">
            <span class="label">Appréciation: </span>
            <span>{{ rowSelected?.appreciation }}</span>
          </div>
          <div class="col-12 col-lg-6">
            <span class="label">Notation: </span>
            <span>{{ rowSelected?.score }}</span>
          </div>
          <div class="col-12" :class="{ 'col-lg-4': !rowSelected?.metadata }">
            <span class="label">
              Informations supplémentaires:
            </span>
          </div>
          <div class="col-12" :class="{ 'col-lg-8': !rowSelected?.parsed_metadata }" v-if="rowSelected?.metadata">
            <table v-if="rowSelected?.parsed_metadata">
              <thead>
                <tr>
                  <th class="text-left" v-for="heading in Object.keys(rowSelected?.parsed_metadata)">
                    {{ heading }}
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(data, row) in rowSelected?.metadata" :key="'metadata-row-' + row">
                  <td class="text-left" v-for="(items, index) in data" :key="'metadata-row-' + row + '-item-' + index">
                    <span v-for="(item, key) in items" :key="'metadata-row-' + row + '-item-' + index + '-content'"
                      v-if="key !== 'label'">
                      {{ item }}
                    </span>
                  </td>
                </tr>
              </tbody>
            </table>
            <span v-else>-</span>
          </div>
          <div class="col-8" v-else>
            -
          </div>
          <div class="col-12">
            <span class="label">Constat: </span>
            <span>{{ rowSelected?.report || '-' }}</span>
          </div>
          <div class="col-12">
            <span class="label">Plan de redressement: </span>
            <span>{{ rowSelected?.recovery_plan || '-' }}</span>
          </div>
        </div>
      </template>
    </NLModal>
  </ContentBody>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
  layout: 'backend',
  middleware: [ 'auth' ],
  computed: {
    ...mapGetters({
      details: 'details/global'
    }),
  },
  data: () => {
    return {
      rowSelected: null,
      config: {
        data: null,
        namespace: 'details',
        state_key: 'global',
        rowKey: 'id',
        columns: [
          {
            label: 'CDC-ID',
            field: 'cdc_reference',
          },
          {
            label: 'RAP-ID',
            field: 'mission_reference',
          },
          {
            label: 'DRE',
            field: 'dre_full_name',
          },
          {
            label: 'Agence',
            field: 'agency_full_name',
          },
          {
            label: 'Famille',
            field: 'familly_name',
          },
          {
            label: 'Domaine',
            field: 'domain_name',
          },
          {
            label: 'Processus',
            field: 'process_name',
          },
          {
            label: 'Point de contrôle',
            field: 'control_point_name',
          },
          {
            label: 'Fait majeur',
            field: 'major_fact_str',
            methods: {
              style() {
                return 'text-center'
              }
            }
          },
          {
            label: 'Notation',
            field: 'score',
            methods: {
              style() {
                return 'text-center'
              }
            }
          },
        ],
        actions: {
          show: true,
        }
      }
    }
  },
  created() {
    this.initData()
  },
  methods: {
    /**
     * Initialise les données
     */
    initData() {
      this.$store.dispatch('details/fetchGlobal').then(() => this.config.data = this.details.global)
    },
    /**
       * Affiche l'élément seléctionner
       *
       * @param {Object} item
       */
    show(item) {
      this.rowSelected = item
    },
    /**
     * Ferme le modal
     */
    close() {
      this.rowSelected = null
    }
  }
}
</script>
