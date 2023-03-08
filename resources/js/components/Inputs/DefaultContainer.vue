<template>
  <div class="input-base-container">
    <label class="form-label" :for="id" :class="{ 'text-danger': form?.errors.has(name), 'is-required': labelRequired }"
      v-if="label">
      {{ $t(label) }}
    </label>
    <i class="las la-exclamation-circle text-medium help-text" :class="{ 'ml-4': labelRequired }" :title="helpText"
      v-if="helpText"></i>
    <slot></slot>
    <div class="d-flex justify-end align-center is-column is-lg-row"
      :class="{ 'justify-between': form?.errors.has(name) }">

      <!-- <div class="invalid-feedback d-block text-danger d-inline">
        <template v-for="error in getFieldErrors(name)">
          {{ error }}<br>
        </template>
      </div> -->
      <has-error :form="form" :field="name" class="text-danger d-inline" v-if="form" />
      <div class="text-small text-bold d-flex justify-end align-center"
        :class="{ 'text-danger': currentLength >= length }" v-if="length !== null && currentLength !== null">
        {{ currentLength }} / {{ length }}
      </div>

    </div>
  </div>
</template>

<script>
export default {
  name: 'DefaultContainer',
  props: {
    form: { type: Object, required: false },
    name: { type: String, required: true },
    id: { type: String, required: true },
    label: { type: String, default: '' },
    labelRequired: { type: Boolean, default: false },
    length: { type: Number | String, default: null },
    currentLength: { type: Number | String, default: null },
    helpText: { type: String, default: null },
  },
  methods: {
    getFieldErrors(fieldName) {
      const errors = this.form?.errors.any() ? this.form.errors.errors : false
      const fieldErrors = []
      console.log(errors);
      if (errors) {
        for (const error of errors) {
          console.log(error?.field?.startsWith(fieldName), error, fieldName);
          if (error?.field?.startsWith(fieldName)) {
            fieldErrors.push(error.msg)
          }
        }
      }
      return fieldErrors
    }
  }
}
</script>
