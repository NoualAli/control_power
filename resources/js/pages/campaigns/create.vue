<template>
  <div v-can="'create_control_campaign'">
    <ContentBody>
      <form @submit.prevent="create" @keydown="form.onKeydown($event)">
        <!-- Control campaign base informations -->
        <div class="grid">
          <div class="col-12">
            <NLTextarea :form="form" v-model="form.description" name="description" label="Description"
              placeholder="Ajouter une description" labelRequired />
          </div>
          <div class="col-12 col-lg-4">
            <NLInput name="reference" :value="nextReference?.nextReference" :form="form" label="Référence" readonly
              labelRequired />
          </div>
          <div class="col-12 col-lg-4 col-tablet-6">
            <NLInput :form="form" v-model="form.start" name="start" label="Date début" type="date" labelRequired />
          </div>
          <div class="col-12 col-lg-4 col-tablet-6">
            <NLInput :form="form" v-model="form.end" name="end" label="Date fin" type="date" labelRequired />
          </div>
          <div class="col-12">
            <NLSelect :form="form" v-model="form.pcf" name="famillies" :options="pcfList" label="PCF" :multiple="true"
              placeholder="Choisissez un ou plusieurs PCF" noOptionsText="Aucun PCF disponible"
              loadingText="Chargement des PCF en cours..." labelRequired />
          </div>
        </div>

        <!-- Submit Button -->
        <div class="d-flex justify-end align-center">
          <NLButton :loading="form.busy" label="Add" class="is-radius" />
        </div>
      </form>
    </ContentBody>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import { Form } from 'vform';
export default {
  middleware: [ 'auth' ],
  layout: 'backend',
  data() {
    return {
      pcfList: [],
      form: new Form({
        description: '',
        start: null,
        end: null,
        pcf: [],
      }),
    }
  },
  computed: mapGetters({
    famillies: 'famillies/all',
    nextReference: 'campaigns/nextReference'
  }),
  methods: {
    /**
     * Ajoute une nouvelle campagne de contrôle
     */
    create() {
      this.form.post('/api/campaigns').then(response => {
        if (response.data.status) {
          swal.toast_success(response.data.message)
          this.form.reset()
          this.fetchNextReference()
        } else {
          swal.alert_error(response.data.message)
        }
      }).catch(error => {
        console.log(error);
      })
    },
    /**
     * Récupère la prochaine référence
     */
    fetchNextReference() {
      this.$store.dispatch('campaigns/fetchNextReference')
    },
    /**
     * Récupère la liste des familles -> domaines -> processus
     */
    loadPFC() {
      this.$store.dispatch('famillies/fetchAll').then(() => {
        this.pcfList = this.famillies.all
      });
    },
  },
  created() {
    this.fetchNextReference()
    this.loadPFC()
  },
}
</script>
