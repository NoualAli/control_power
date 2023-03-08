<template>
  <div v-if="can('edit_agency')">
    <ContentBody>
      <form @submit.prevent="update" @keydown="form.onKeydown($event)">
        <div class="grid gap-10 my-4">
          <!-- Code -->
          <div class="col-12 col-md-6">
            <NLInput type="number" :form="form" name="code" label="Code" v-model="form.code" labelRequired />
          </div>
          <!-- Name -->
          <div class="col-12 col-md-6">
            <NLInput :form="form" name="name" label="Name" v-model="form.name" labelRequired />
          </div>
          <!-- Dre -->
          <div class="col-12 col-md-6">
            <NLSelect :form="form" name="dre_id" v-model="form.dre_id" label="Dre" :options="dresList" labelRequired
              :multiple="false" />
          </div>
          <!-- Categories -->
          <div class="col-12 col-md-6">
            <NLSelect :form="form" name="category_id" v-model="form.category_id" label="Catégorie"
              :options="categoriesList" labelRequired :multiple="false" />
          </div>
          <!-- PCF -->
          <div class="col-12 col-md-6">
            <NLSelect :form="form" name="pcf_usable" v-model="form.pcf_usable" label="PCF exceptionnel (à utiliser)"
              :options="pcfList" :multiple="true" />
          </div>
          <div class="col-12 col-md-6">
            <NLSelect :form="form" name="pcf_unusable" v-model="form.pcf_unusable"
              label="PCF exceptionnel (à ne pas utiliser)" :options="pcfList" :multiple="true" />
          </div>
        </div>
        <!-- Submit Button -->
        <div class="d-flex justify-end align-center">
          <NLButton :loading="form.busy" label="Update" class="is-radius" />
        </div>
      </form>
    </ContentBody>
  </div>
</template>

<script>
import { Form } from 'vform';
import { mapGetters } from 'vuex'
export default {
  middleware: [ 'auth', 'admin' ],
  layout: 'backend',
  computed: {
    ...mapGetters({
      config: 'agencies/config',
    }),
  },
  created() {
    this.initData()
  },
  data() {
    return {
      dresList: [],
      categoriesList: [],
      pcfList: [],
      agency: null,
      form: new Form({
        name: null,
        code: null,
        dre_id: null,
        category_id: null,
        pcf_usable: [],
        pcf_unusable: [],
      }),
    }
  },
  methods: {
    initData() {
      this.$store.dispatch('agencies/fetchConfig', this.$route.params.agency).then(() => {
        this.agency = this.config.config.agency
        this.dresList = this.config.config.dres
        this.categoriesList = this.config.config.categories
        this.pcfList = this.config.config.pcf

        this.form.name = this.agency.name
        this.form.code = this.agency.code
        this.form.dre_id = this.agency.dre_id
        this.form.category_id = this.agency.category_id
        this.form.pcf_usable = this.agency.usableProcesses.map(process => process.id)
        this.form.pcf_unusable = this.agency.unusableProcesses.map(process => process.id)
      })
    },
    update() {
      this.form.put('/api/agencies/' + this.$route.params.agency).then(response => {
        if (response.data.status) {
          swal.toast_success(response.data.message)
          this.initData()
          // this.$router.push({ name: 'agencies-index' })
        } else {
          swal.alert_error(response.data.message)
        }
      }).catch(error => {
        console.log(error);
      })

    }
  }
}
</script>
