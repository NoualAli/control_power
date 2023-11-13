<template>
    <InputContainer :id="getId" :name="name" :form="form" :label="label" :label-required="labelRequired"
        :help-text="helpText">
        <input v-if="!readonly" :id="getId" type="file" :name="name" :multiple="multiple" :accept="accept"
            class="file-input" @input="onChange($event)">
        <div :class="[{ 'is-danger': form?.errors.has(name), 'has-files': hasFiles, 'is-readonly': readonly, 'is-flat': isFlat }, 'file-input-area']"
            :draggable="true" @dragover="dragover" @dragleave="dragleave" @drop="drop"
            @click.stop="openFileBrowser($event)">
            <p v-if="!inProgress && !readonly" class="text-medium file-uploader">
                {{ placeholder }} <i class="las la-cloud-upload-alt text-large" />
            </p>
            <p v-if="inProgress" class="text-medium file-uploader">
                <i class="las la-spinner la-spin text-large" /> {{ visibleLoadingText }}{{ progress }} %
            </p>
            <div class="files-list list text-medium" @click.stop="(e) => e.stopPropagation()" v-if="getFilesList.length">
                <div v-for="(file, index) in getFilesList" :key="name + '-' + index" class="list-item my-1">
                    <div class="grid gap-4 list-item-content" @click.stop="">
                        <div class="col-11 d-flex justify-between align-center">
                            <a :href="file.link" target="_blank" class="text-dark">
                                <i class="icon" :class="file.icon"></i>
                                {{ file.name }}
                            </a>
                            <span>{{ file.size }}</span>
                        </div>
                        <div class="col-1 d-flex justify-end align-center gap-4">
                            <a :href="file.link" :download="file.name">
                                <i class="las la-download text-info icon" />
                            </a>
                            <i v-if="canDelete && file.isOwner && !readonly"
                                class="las la-trash text-danger icon is-clickable" @click.stop="deleteItem(file, index)" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <p v-if="!readonly">
            Les extensions de fichiers acceptés sont: {{ accepted }}
        </p> -->
    </InputContainer>
</template>

<script>
import InputContainer from './InputContainer'
export default {
    name: 'NLFile',
    components: { InputContainer },
    props: {
        form: { type: Object, required: false },
        name: { type: String },
        id: { type: String },
        label: { type: String, default: '' },
        labelRequired: { type: Boolean, default: false },
        placeholder: { type: String, default: 'Téléverser des fichiers' },
        loadingText: { type: String, default: 'Téléversement en cours... ' },
        multiple: { type: Boolean, default: false },
        modelValue: { type: [ String, Array, Object, null ], default: () => { } },
        attachableType: { type: String, default: '' },
        attachableId: { type: [ String, Number ], default: '' },
        accepted: { type: String, default: 'jpg,jpeg,png,doc,docx,xls,xlsx,pdf' },
        helpText: { type: String, default: null },
        canDelete: { type: Boolean, default: true },
        readonly: { type: Boolean, default: false },
        isFlat: { type: Boolean, default: false },
        folder: { type: String, default: '' }
    },
    emits: [ 'change:modelValue' ],
    data() {
        return {
            isDragging: false,
            inProgress: false,
            progress: 0,
            files: [],
            isReadonly: false,
            visibleLoadingText: this.loadingText,
        }
    },
    computed: {
        hasFiles() {
            return this.files.length
        },
        accept() {
            return this.accepted.split(',').map(accept => '.' + accept).join(',')
        },
        getFilesList() {
            let files = Object.values(this.files).map((file) => {
                return {
                    id: file?.id,
                    name: file?.original_name,
                    size: file?.size,
                    type: file?.type,
                    link: file?.link,
                    icon: file?.icon,
                    isOwner: file?.is_owner,
                };
            });
            return files
        },
        getId() {
            if (this.id) {
                return this.id
            } else if (!this.id && this.name) {
                return this.name
            } else {
                return ''
            }
        },
    },
    watch: {
        modelValue(newVal, oldVal) {
            if (newVal !== oldVal) this.loadFiles(newVal.join(','))
        },
    },
    // created() {
    //     if (Object.values(this.modelValue).length) {
    //         this.loadFiles(Object.values(this.modelValue).join(','))
    //         this.switchToReadonly()
    //     }
    // },

    mounted() {
        this.isReadonly = this.readonly
        if (Object.values(this.modelValue).length) {
            this.loadFiles(Object.values(this.modelValue).join(','))
        }
    },
    methods: {
        /**
         * Handle input change event
         *
         * @param {*} $event
         */
        onChange($event) {
            if ($event.target.files.length && !this.readonly) {
                this.inProgress = true
                this.upload($event.target.files, $event)
            }
        },
        /**
         * Handle dragover event
         * @param {*} e
         */
        dragover(e) {
            e.preventDefault()
            this.isDragging = true
        },
        /**
         * Handle drop leave event
         */
        dragleave() {
            this.isDragging = false
        },
        /**
         * Handle drop event
         *
         * @param {*} $event
         */
        drop($event) {
            this.isDragging = false
            $event.preventDefault()
            if (!this.readonly) {
                this.upload($event.dataTransfer.files)
            }
        },
        /**
         * Open file browser programatically
         *
         * @param {*} $event
         */
        openFileBrowser($event) {
            if (!this.readonly) {
                $event.target.parentNode.parentNode.querySelector('input[type=file]').click()
            }
        },
        /**
         * Fetch exesting files
         *
         * @param {String} filesStr
         */
        loadFiles(filesStr) {
            this.progress = '';
            this.isLoading = !this.isLoading;
            this.inProgress = !this.inProgress;
            this.visibleLoadingText = 'Récupération des fichiers en cours...';
            let url = 'upload';
            if (!([ null, '', undefined ]).includes(filesStr)) {
                url += '?media=' + filesStr;
            }
            this.$api.get(url, {
                onDownloadProgress: progressEvent => this.setProgress(progressEvent)
            }).then(response => {
                this.files = response.data;
                this.inProgress = !this.inProgress;
                this.isLoading = !this.isLoading;
                const files = { ...this.files.map((file) => file.id) }
                this.$emit('loaded', files);
            }).catch(error => {
                console.error(error);
            });
        },
        /**
         * Delete file from server
         *
         * @param {Object} file
         * @param {Number} index
         */
        deleteItem(file, index) {
            this.$swal.confirm_destroy().then((action) => {
                if (action.isConfirmed) {
                    if (index !== -1) {
                        this.$api.delete('upload/' + file.id).then(response => {
                            this.files.splice(index, 1);
                            const files = { ...this.files.map((file) => file.id) }
                            this.$emit('deleted', files);
                            this.inProgress = false;
                        }).catch(error => {
                            this.inProgress = false
                            console.error(error)
                        })
                    }
                }
            });
        },
        /**
         * Upload files to server
         *
         * @param {Array} files
         */
        upload(files, $event) {
            try {
                if (!this.readonly) {
                    this.visibleLoadingText = this.loadingText
                    const data = new FormData()

                    if (this.multiple) {
                        for (let i = 0; i < files.length; i++) {
                            data.append(`${this.name}[]`, files[ i ])
                        }
                    } else {
                        data.append(this.name, files[ 0 ])
                    }

                    if (files.length) {
                        data.append('accepted', this.accepted)
                        data.append('attachable[id]', this.attachableId)
                        data.append('attachable[type]', this.attachableType)
                        data.append('folder', 'uploads/' + this.folder)
                        this.$api.post('upload', data, {
                            onUploadProgress: (progressEvent) => this.setProgress(progressEvent)
                        }).then(response => {
                            this.inProgress = false
                            this.files.push(...response.data)
                            const files = { ...this.files.map((file) => file.id) }
                            this.$emit('uploaded', files)
                            $event.target.value = ''

                        }).catch(error => {
                            this.inProgress = false
                            let i = 0

                            for (const key in error?.response?.data?.errors) {
                                if (Object.hasOwnProperty.call(error.response.data.errors, key)) {
                                    const element = error.response.data.errors[ key ];
                                    console.log(element[ 0 ].replace(`du champ ${this.name}.${i}`, `${i + 1} du champ ${this.label.toLowerCase()}`));
                                    this.form.errors.set(this.name, element[ 0 ].replace(`du champ ${this.name}.${i}`, `${i + 1} du champ ${this.label.toLowerCase()}`))
                                    i += 1
                                }
                            }
                        })
                    }
                }
            } catch (error) {
                alert(error)
            }
        },

        /**
         * Handle upload progress status
         * @param {*} progressEvent
         */
        setProgress(progressEvent) {
            if (progressEvent?.total) {
                this.progress = Math.round((progressEvent.loaded * 100) / progressEvent?.total)
            } else {
                this.progress = '0'
            }
        }
    }
}
</script>
