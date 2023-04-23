<template>
  <DefaultContainer
    :id="id || name" :name="name" :form="form" :label="label" :label-required="labelRequired"
    :help-text="helpText"
  >
    <input
      v-if="!readonly" :id="id || name" type="file" :name="name" :multiple="multiple" :accept="accept"
      class="file-input" @change="onChange($event)"
    >
    <div
      :class="[{ 'is-danger': form?.errors.has(name), 'has-files': hasFiles, 'is-readonly': readonly }, 'file-input-area']"
      :draggable="true" @dragover="dragover" @dragleave="dragleave" @drop="drop"
    >
      <p v-if="!inProgress && !readonly" class="text-medium file-uploader" @click.stop="openFileBrowser($event)">
        {{ placeholder }} <i class="las la-cloud-upload-alt text-large" />
      </p>
      <p v-else-if="inProgress && !readonly" class="text-medium file-uploader">
        <i class="las la-spinner la-spin text-large" /> {{ loadingText }}{{ progress }} %
      </p>
      <div class="files-list list text-medium">
        <div v-for="(file, index) in getFilesList" :key="name + '-' + index" class="list-item my-1">
          <div class="grid gap-4 list-item-content" @click.stop="">
            <div class="col-11 d-flex justify-between align-center">
              <a :href="file.link" target="_blank" class="text-dark">
                {{ file.name }}
              </a>
              <span>{{ file.size }}</span>
            </div>
            <div class="col-1 d-flex justify-end align-center gap-4">
              <a :href="file.link" :download="file.name">
                <i class="las la-download text-info icon" />
              </a>
              <i
                v-if="canDelete && !readonly" class="las la-trash text-danger icon is-clickable"
                @click.stop="deleteItem(file, index)"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </DefaultContainer>
</template>

<script>
import DefaultContainer from './DefaultContainer'
export default {
  name: 'NLFile',
  components: { DefaultContainer },
  model: {
    prop: 'value',
    event: 'change'
  },
  props: {
    form: { type: Object, required: false },
    name: { type: String, required: true },
    id: { type: String, default: null },
    label: { type: String, default: '' },
    labelRequired: { type: Boolean, default: false },
    placeholder: { type: String, default: 'Téléverser des fichiers' },
    loadingText: { type: String, default: 'Téléversement en cours... ' },
    multiple: { type: Boolean, default: false },
    value: { type: [String, Array], default: () => [] },
    attachableType: { type: String, default: '' },
    attachableId: { type: [String, Number], default: '' },
    accepted: { type: String, default: 'jpg,jpeg,png,doc,docx,xls,xlsx,pdf' },
    helpText: { type: String, default: null },
    canDelete: { type: Boolean, default: true },
    readonly: { type: Boolean, default: false }
  },
  data () {
    return {
      isDragging: false,
      inProgress: false,
      progress: 0,
      files: []
    }
  },
  computed: {
    hasFiles () {
      return this.files.length
    },
    accept () {
      return this.accepted.split(',').map(accept => '.' + accept).join(',')
    },
    getFilesList () {
      return [...this.files].map((file) => {
        return {
          id: file.id,
          name: file.original_name,
          size: file.size,
          type: file.type,
          link: file.link
        }
      })
    }
  },
  watch: {
    value (newVal, oldVal) {
      if (newVal !== oldVal) this.loadFiles(newVal.join(','))
    }
  },
  created () {
    if (!this.files.length) {
      this.loadFiles(this.value.join(','))
    }
  },
  methods: {
    /**
     * Handle input change event
     *
     * @param {*} $event
     */
    onChange ($event) {
      this.inProgress = true
      this.upload($event.target.files)
    },
    /**
     * Handle dragover event
     * @param {*} e
     */
    dragover (e) {
      e.preventDefault()
      this.isDragging = true
    },
    /**
     * Handle drop leave event
     */
    dragleave () {
      this.isDragging = false
    },
    /**
     * Handle drop event
     *
     * @param {*} $event
     */
    drop ($event) {
      this.isDragging = false
      $event.preventDefault()
      this.upload($event.dataTransfer.files)
    },
    /**
     * Open file browser programatically
     *
     * @param {*} $event
     */
    openFileBrowser ($event) {
      $event.target.parentNode.parentNode.children[1].click()
    },
    /**
     * Fetch exesting files
     *
     * @param {String} filesStr
     */
    loadFiles (filesStr) {
      api.get('upload?media=' + filesStr).then(response => {
        this.files = response.data
      }).catch(error => {
        console.error(error)
      })
    },
    /**
     * Delete file from server
     *
     * @param {Object} file
     * @param {Number} index
     */
    deleteItem (file, index) {
      this.$swal.confirm_destroy().then((action) => {
        if (action.isConfirmed) {
          api.delete('upload/' + file.id).then(response => {
            this.files.splice(index, 1)
            this.inProgress = false
            this.$emit('change', this.files.map(file => file.id))
          }).catch(error => {
            this.inProgress = false
            console.error(error)
          })
        }
      })
    },
    /**
     * Upload files to server
     *
     * @param {Array} files
     */
    upload (files) {
      const data = new FormData()
      for (let i = 0; i < files.length; i++) {
        data.append('media[]', files[i])
      }
      if (files.length) {
        data.append('accepted', this.accepted)
        data.append('attachable[id]', this.attachableId)
        data.append('attachable[type]', this.attachableType)
        api.post('upload', data, {
          onUploadProgress: progressEvent => {
            this.progress = Math.round((progressEvent.loaded * 100) / progressEvent.total)
          }
        }).then(response => {
          this.inProgress = false
          this.files.push(...response.data)
          const files = this.files.map((file) => file.id)
          this.$emit('change', files)
        }).catch(error => {
          this.inProgress = false
          console.error(error)
        })
      }
    }
  }
}
</script>
