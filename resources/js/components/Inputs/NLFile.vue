<template>
  <DefaultContainer :name="name" :id="getId" :form="form" :label="label" :labelRequired="labelRequired">
    <input type="file" :name="name" :id="getId" :multiple="multiple" class="file-input" @change="onChange($event)">
    <div :class="[{ 'is-danger': form?.errors.has(name), 'has-files': hasFiles }, 'file-input-area']" :draggable="true"
      @dragover="dragover" @dragleave="dragleave" @drop="drop">
      <p class="text-medium file-uploader" @click.stop="openFileBrowser($event)">
        {{ inProgress? 'Chargement en cours...': placeholder }} <i class="las la-cloud-upload-alt text-large"></i>
      </p>
      <div class="files-list list text-medium">
        <div class="list-item my-1" v-for="(file, index) in getFilesList" :key="name + '-' + index">
          <div class="grid gap-4 list-item-content" @click.stop="">
            <div class="col-11 d-flex justify-between align-center">
              <span>{{ file.name }}</span>
              <span>{{ file.size }}</span>
            </div>
            <div class="col-1 d-flex justify-end align-center">
              <i class="las la-trash text-danger icon delete-btn" @click.stop="deleteItem(file, index)"></i>
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
  components: { DefaultContainer },
  name: 'NLFile',
  props: {
    form: { type: Object, required: false },
    name: { type: String, required: true },
    id: { type: String, default: null },
    label: { type: String, default: '' },
    labelRequired: { type: Boolean, default: false },
    placeholder: { type: String, default: 'Téléverser des fichiers' },
    multiple: { type: Boolean, default: false },
    value: { type: String | Array, default: () => [] },
    attachableType: { type: String, default: '' },
    attachableId: { type: String | Number, default: '' },
    accepted: { type: String, default: 'jpg,jpeg,png,doc,docx,xls,xlsx,pdf' },
  },
  model: {
    prop: 'value',
    event: 'change'
  },
  data() {
    return {
      isDragging: false,
      inProgress: false,
      files: [],
    };
  },
  created() {
    if (this.value.length) {
      this.loadFiles(this.value.join(','))
    }
  },
  methods: {
    /**
     * Handle input change event
     *
     * @param {*} $event
     */
    onChange($event) {
      this.inProgress = true
      this.upload($event.target.files)
    },
    /**
     * Handle dragover event
     * @param {*} e
     */
    dragover(e) {
      e.preventDefault();
      this.isDragging = true;
    },
    /**
     * Handle drop leave event
     */
    dragleave() {
      this.isDragging = false;
    },
    /**
     * Handle drop event
     *
     * @param {*} $event
     */
    drop($event) {
      this.isDragging = false;
      $event.preventDefault()
      this.upload($event.dataTransfer.files)
    },
    /**
     * Open file browser programatically
     *
     * @param {*} $event
     */
    openFileBrowser($event) {
      $event.target.parentNode.parentNode.children[ 1 ].click();
    },
    /**
     * Parse mimetype to determine extension
     *
     * @param {string} type
     */
    getType(type) {
      return type.split('/')[ 1 ]
    },
    /**
     * Convert file size from byte to mb
     *
     * @param {Number} bytes
     */
    convertToMegabyte(bytes) {
      let value = (bytes / 1024 / 1024).toFixed(2)
      let suffix = 'Mb'
      if (value < 1) {
        value = (bytes / 1024).toFixed(2)
        suffix = 'Kb'
      }
      return value + ' ' + suffix
    },

    /**
     * Fetch exesting files
     *
     * @param {String} filesStr
     */
    loadFiles(filesStr) {
      api.get('upload?media=' + filesStr).then(response => {
        this.files = response.data
      }).catch(error => {
        console.error(error);
      })
    },
    /**
     * Delete file from serve
     *
     * @param {Object} file
     * @param {Number} index
     */
    deleteItem(file, index) {
      api.delete('upload/' + file.id).then(response => {
        this.files.splice(index, 1)
        this.inProgress = false
        this.$emit('change', this.files.map(file => file.id))
      }).catch(error => {
        this.inProgress = false
        console.error(error)
      })
    },
    /**
     * Upload files to server
     *
     * @param {Array} files
     */
    upload(files) {
      let data = new FormData()
      for (let i = 0; i < files.length; i++) {
        data.append("media[]", files[ i ]);
      }
      if (files.length) {
        data.append('accepted', this.accepted)
        data.append('attachable[id]', this.attachableId)
        data.append('attachable[type]', this.attachableType)
        api.post('upload', data, {
          // onUploadProgress: progressEvent => {
          //   // this.progress = Math.round((progressEvent.loaded * 100) / progressEvent.total);
          //   console.log(Math.round((progressEvent.loaded * 100) / progressEvent.total), progressEvent.loaded, progressEvent.total);
          // }
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
  },
  computed: {
    getId() {
      return this.id !== null && this.id !== '' ? this.id : this.name
    },
    hasFiles() {
      return this.files.length
    },
    getFilesList() {
      return [ ...this.files ].map((file) => {
        const size = this.convertToMegabyte(file.size)
        const type = this.getType(file.mimetype)
        return {
          id: file.id,
          name: file.original_name,
          size,
          type
        }
      })
    },
  },
}
</script>
