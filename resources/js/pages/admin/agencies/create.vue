<template>
  <div v-if="can('create_agency')">
    <ContentHeader title="Ajouter une nouvelle agence" />
    <ContentBody>
      <form @submit.prevent="create" @keydown="form.onKeydown($event)">
        <div class="grid gap-10 my-4">
          <!-- Code -->
          <div class="col-12 col-md-6">
            <NLInput v-model="form.code" type="number" :form="form" name="code" label="Code" label-required />
          </div>
          <!-- Name -->
          <div class="col-12 col-md-6">
            <NLInput v-model="form.name" :form="form" name="name" label="Name" label-required />
          </div>
          <!-- Dre -->
          <div class="col-12 col-md-6">
            <NLSelect
              v-model="form.dre_id" :form="form" name="dre_id" label="Dre" :options="dresList" label-required
              :multiple="false"
            />
          </div>
          <!-- Category -->
          <div class="col-12 col-md-6">
            <NLSelect
              v-model="form.category_id" :form="form" name="category_id" label="Catégorie"
              :options="categoriesList" label-required :multiple="false"
            />
          </div>
          <!-- PCF -->
          <div class="col-12 col-md-6">
            <NLSelect
              v-model="form.pcf_usable" :form="form" name="pcf_usable" label="PCF exceptionnel (à utiliser)"
              :options="pcfList" :multiple="true"
            />
          </div>
          <div class="col-12 col-md-6">
            <NLSelect
              v-model="form.pcf_unusable" :form="form" name="pcf_unusable"
              label="PCF exceptionnel (à ne pas utiliser)" :options="pcfList" :multiple="true"
            />
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
import { Form } from 'vform'
import { mapGetters } from 'vuex'

export default {
  layout: 'backend',
  middleware: ['auth', 'admin'],
  data () {
    return {
      dresList: [],
      categoriesList: [],
      pcfList: [],
      form: new Form({
        name: null,
        code: null,
        dre_id: null,
        category_id: null,
        pcf_usable: [],
        pcf_unusable: []
      })
    }
  },
  computed: {
    ...mapGetters({
      config: 'agencies/config'
    })
  },
  created () {
    this.$store.dispatch('agencies/fetchConfig').then(() => {
      this.dresList = this.config.config.dres
      this.categoriesList = this.config.config.categories
      this.pcfList = this.config.config.pcf
    })
  },
  methods: {
    create () {
      this.form.post('/api/agencies').then(response => {
        if (response.data.status) {
          this.$swal.toast_success(response.data.message)
          this.form.reset()
        } else {
          this.$swal.alert_error(response.data.message)
        }
      }).catch(error => {
        console.log(error)
      })
    }
  }
}
</script>
