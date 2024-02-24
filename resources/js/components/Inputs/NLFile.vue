<template>
    <InputContainer :id="getId" :name="name" :form="form" :label="label" :label-required="labelRequired"
        :help-text="helpText">
        <template v-if="!readonly" #additional>
            <NLFlex gap="2" lgAlignItems="center" alignItems="center">
                <p class="text-bold" v-if="Object.values(this.files).length > 1">
                    Fichiers total ({{ Object.values(this.files).length }})
                </p>
                <NLIcon name="delete" extraClass="text-danger is-clickable" @click.stop="deleteItems"
                    v-if="!isDeletingMultiple && canDelete && !readonly && Object.values(this.files).length > 1" />
                <i class="las la-spinner la-spin icon" v-else-if="isDeletingMultiple"></i>
            </NLFlex>
        </template>
        <input v-if="!readonly" :id="getId" type="file" :name="name" :multiple="multiple" :accept="accept"
            class="file-input" @input="onChange($event)">
        <div :class="[{ 'is-danger': form?.errors.has(name), 'is-readonly': readonly, 'is-flat': isFlat, 'is-dragging': isDragging }, 'file-input-area']"
            :draggable="true" @dragover="dragover" @dragleave="dragleave" @drop="drop" @click.stop="openFileBrowser($event)"
            v-if="!readonly">
            <div v-if="!inProgress && !readonly" class="file-uploader">
                <NLFlex gap="1" lgJustifyContent="center" lgAlignItems="center" class="text-medium">
                    {{ placeholder }}
                    <NLIcon name="cloud_upload" />
                </NLFlex>
                <p class="text-small">{{ accepted }}</p>
            </div>
            <p v-if="inProgress" class="text-medium file-uploader">
                <i class="las la-spinner la-spin text-large" />
                {{ visibleLoadingText }}
            </p>
        </div>
        <p v-if="inProgress && readonly" class="text-medium file-uploader my-4">
            <i class="las la-spinner la-spin text-large" />
            {{ visibleLoadingText }}
            <!-- {{ progress }} {{ progress ? '%' : '' }} -->
        </p>
    </InputContainer>
    <div class="files-list text-medium mt-4" :class="[{ 'is-readonly': readonly }]" @click.stop="(e) => e.stopPropagation()"
        v-if="filesList.length">
        <div v-for="(file, index) in filesList" :key="name + '-' + index" class="list-file-item my-1" :class="[{
            'is-deleting': isDeleting == index, 'file-progress-overlay': !file.isUploaded
        }]" :data-progress="this.getProgress(index)">
            <NLTooltip type="top">
                <template #content>
                    <p class="mb-2"><b>Nom:</b> {{ file.name }}</p>
                    <p><b>Taille:</b> {{ file.size }}</p>
                </template>
                <NLGrid gap="1" extraClass="list-item-content w-100">
                    <NLColumn :lg="canDelete && file.isOwner && !readonly && file.isUploaded ? 11 : 12"
                        extraClass="d-flex justify-between align-center align-lg-center">
                        <a :href="file.link" target="_blank" class="file_name_link" :download="file.name"
                            v-if="file.isUploaded">
                            <i class="icon" :class="file.icon"></i>
                            {{ file.name.length > 20 ? file.name.slice(0, 20) + '...' : file.name }}
                        </a>
                        <p class="file_name_link" v-else>
                            <i class="icon" :class="file.icon"></i>
                            {{ file.name.length > 25 ? file.name.slice(0, 25) + '...' : file.name }}
                        </p>
                    </NLColumn>
                    <NLColumn lg="1" extraClass="d-flex justify-end align-center"
                        v-if="canDelete && file.isOwner && !readonly && file.isUploaded">
                        <NLIcon v-if="isDeleting !== index && !isDeletingMultiple" name="delete"
                            extraClass="text-danger is-clickable" @click.stop="deleteItem(file, index)" />
                        <i class="las la-spinner la-spin text-large text-danger" v-if="isDeleting == index" />
                    </NLColumn>
                </NLGrid>
            </NLTooltip>
        </div>
    </div>
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
        placeholder: { type: String, default: 'Glissez et déposez un ou plusieurs fichiers' },
        loadingText: { type: String, default: 'Téléversement en cours... ' },
        multiple: { type: Boolean, default: false },
        modelValue: { type: [ String, Array, Object, null ], default: () => { } },
        attachableType: { type: String, default: '' },
        attachableId: { type: [ String, Number ], default: '' },
        accepted: { type: String, default: 'jpg,jpeg,png,doc,docx,xls,xlsx,pdf,tif' },
        helpText: { type: String, default: null },
        canDelete: { type: Boolean, default: true },
        readonly: { type: Boolean, default: false },
        isFlat: { type: Boolean, default: false },
        folder: { type: String, default: '' }
    },
    emits: [ 'change:modelValue', 'deleted', 'loaded', 'uploaded' ],
    data() {
        return {
            isDragging: false,
            inProgress: false,
            progress: [],
            files: [],
            isReadonly: false,
            visibleLoadingText: this.loadingText,
            isDeletingMultiple: false,
            isDeleting: null,
            filesList: []
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
                    size: file?.size_str,
                    type: file?.type,
                    extension: file?.extension,
                    link: file?.storage_link,
                    icon: file?.icon,
                    isOwner: file?.is_owner,
                    isUploaded: true
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
            if (newVal !== oldVal) {
                if (this.multiple) {
                    this.loadFiles(newVal.join(','))
                } else {
                    this.loadFiles(newVal)
                }
            }
        },
    },
    mounted() {
        this.isReadonly = this.readonly
        if (Object.values(this.modelValue).length) {
            if (this.multiple) {
                this.loadFiles(Object.values(this.modelValue).join(','))
            } else {
                this.loadFiles(this.modelValue)
            }
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
            this.inProgress = true
            // this.progress = 0
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
            this.isDeletingMultiple = false
        },
        /**
         * Fetch exesting files
         *
         * @param {String} filesStr
         */
        loadFiles(filesStr) {
            if (!([ null, '', undefined ]).includes(filesStr) && filesStr.length) {
                // this.progress = '';
                this.isLoading = !this.isLoading;
                this.inProgress = !this.inProgress;
                this.visibleLoadingText = 'Récupération des fichiers en cours...';
                this.$api.get('media/' + filesStr + '?all', {
                    onDownloadProgress: progressEvent => this.setProgress(progressEvent)
                }).then(response => {
                    this.files = response?.data?.data || response?.data;
                    this.inProgress = !this.inProgress;
                    this.isLoading = !this.isLoading;
                    const files = { ...this.files.map((file) => file.id) }

                    this.files.forEach(file => {
                        let formattedFile = {
                            id: file?.id,
                            name: file?.original_name,
                            size: file?.size_str,
                            type: file?.type,
                            extension: file?.extension,
                            link: file?.storage_link,
                            icon: file?.icon,
                            isOwner: file?.is_owner,
                            isUploaded: true
                        }
                        this.filesList.push(formattedFile)
                    });
                    this.$emit('loaded', files);
                }).catch(error => {
                    this.$swal.catchError(error)
                })
            }
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
                        this.isLoading = true;
                        this.isDeleting = index
                        this.$api.delete('media/' + file.id).then(response => {
                            this.files.splice(index, 1);
                            this.filesList.splice(index, 1);
                            const files = { ...this.files.map((file) => file.id) }
                            this.$emit('deleted', files);
                            this.$swal.toast_success(response.data.message)
                            this.inProgress = false;
                            this.isLoading = false;
                            this.isDeleting = null
                        }).catch(error => {
                            this.inProgress = false
                            this.isLoading = false;
                            this.isDeleting = null
                            this.$swal.catchError(error)
                        })
                    }
                }
            });
        },
        /**
         * Delete all files from server
         */
        deleteItems() {
            this.$swal.confirm_destroy().then((action) => {
                if (action.isConfirmed) {
                    this.isDeletingMultiple = true
                    const files = Object.values(this.modelValue).join(',')
                    this.$api.delete('media/' + files + '/multiple').then(response => {
                        this.files = [];
                        this.filesList = []
                        this.$emit('deleted', this.files);
                        this.inProgress = false;
                        this.isDeletingMultiple = false
                        this.$swal.toast_success(response.data.message)
                    }).catch(error => {
                        this.inProgress = false
                        this.isDeletingMultiple = false
                        this.isLoading = false;
                        this.$swal.catchError(error)
                    })
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

                    // if (this.multiple) {
                    //     for (let i = 0; i < files.length; i++) {
                    //         data.append(`${this.name}[]`, files[ i ])
                    //     }
                    // } else {
                    //     data.append(this.name, files[ 0 ])
                    // }

                    files.forEach(file => this.uploadFile(file, $event))
                    // this.form.errors = {}
                    // if (files.length) {
                    //     data.append('accepted', this.accepted)
                    //     data.append('attachable[id]', this.attachableId)
                    //     data.append('attachable[type]', this.attachableType)
                    //     let folder = 'uploads'
                    //     if (this.folder.length) {
                    //         folder += '/' + this.folder
                    //     }
                    //     data.append('folder', folder)

                    //     // Show files while uploading
                    //     files.forEach(file => {
                    //         let formattedFile = {
                    //             id: null,
                    //             name: file?.name,
                    //             size: null,
                    //             type: file?.type,
                    //             extension: null,
                    //             link: null,
                    //             icon: 'las la-file',
                    //             isOwner: false,
                    //             isUploaded: false
                    //         }
                    //         this.filesList.push(formattedFile)
                    //     });
                    //     // Upload files
                    //     this.$api.post('media', data, {
                    //         onUploadProgress: (progressEvent) => this.setProgress(progressEvent)
                    //     }).then(response => {
                    //         this.inProgress = false
                    //         this.files.push(...response.data)
                    //         this.filesList = []
                    //         this.files.forEach(file => {
                    //             let formattedFile = {
                    //                 id: file?.id,
                    //                 name: file?.original_name,
                    //                 size: file?.size_str,
                    //                 type: file?.type,
                    //                 extension: file?.extension,
                    //                 link: file?.storage_link,
                    //                 icon: file?.icon,
                    //                 isOwner: file?.is_owner,
                    //                 isUploaded: true
                    //             }
                    //             this.filesList.push(formattedFile)
                    //         });
                    //         const files = { ...this.files.map((file) => file.id) }
                    //         this.$emit('uploaded', files)
                    //         $event.target.value = ''
                    //     }).catch(error => {
                    //         this.inProgress = false
                    //         let i = 0

                    //         for (const key in error?.response?.data?.errors) {
                    //             if (Object.hasOwnProperty.call(error.response.data.errors, key)) {
                    //                 const element = error.response.data.errors[ key ];
                    //                 this.form.errors.set(this.name, element[ 0 ].replace(`du champ ${this.name}.${i}`, `${i + 1} du champ ${this.label.toLowerCase()}`))
                    //                 i += 1
                    //             }
                    //         }
                    //     })
                    // }
                }
            } catch (error) {
                this.$swal.catchError(error)
            }
        },
        uploadFile(file, $event) {
            const data = new FormData()
            data.append(this.name, file)
            data.append('accepted', this.accepted)
            data.append('attachable[id]', this.attachableId)
            data.append('attachable[type]', this.attachableType)
            let folder = 'uploads'
            if (this.folder.length) {
                if (this.folder.startsWith('/')) {
                    folder = this.folder.slice(1)
                } else {
                    folder += '/' + this.folder
                }
            }
            data.append('folder', folder)
            // Show files while uploading
            let formattedFile = {
                id: null,
                name: file?.name,
                size: null,
                type: file?.type,
                extension: null,
                link: null,
                icon: 'las la-file',
                isOwner: false,
                isUploaded: false
            }
            this.filesList.push(formattedFile)
            let index = this.filesList.indexOf(formattedFile)
            this.progress.push({ [ index ]: 0 })
            // Upload files
            this.$api.post('media', data, {
                onUploadProgress: (progressEvent) => this.setProgress(progressEvent, index)
            }).then(response => {
                this.inProgress = false
                this.files.push(...response.data)
                this.filesList = []
                this.files.forEach(file => {
                    let formattedFile = {
                        id: file?.id,
                        name: file?.original_name,
                        size: file?.size_str,
                        type: file?.type,
                        extension: file?.extension,
                        link: file?.storage_link,
                        icon: file?.icon,
                        isOwner: file?.is_owner,
                        isUploaded: true
                    }
                    this.filesList.push(formattedFile)
                    if (this.multiple) {
                        this.form[ this.name ] = this.filesList.map((file) => file.id)
                    } else {
                        this.form[ this.name ] = this.filesList.map((file) => file.id)[ 0 ]
                    }
                });
                const files = { ...this.files.map((file) => file.id) }
                $event.target.value = ''
                this.$emit('uploaded', files)
            }).catch(error => {
                this.inProgress = false
                if (error?.response?.status == 413) {
                    this.$swal.alert_error(error?.response?.data, error.message)
                } else {
                    this.$swal.catchError(error)
                }
                let fileName = this.filesList[ index ].name
                for (const key in error?.response?.data?.errors) {
                    if (Object.hasOwnProperty.call(error?.response?.data?.errors, key)) {
                        const element = error?.response?.data?.errors[ key ];
                        this.form.errors.set(this.name, element[ 0 ].replace(`Le champ ${this.name}`, `Le fichier ${fileName}`))
                        // this.form.errors.set(this.name, element[ 0 ].replace(`du champ ${this.name}.${i}`, `${i + 1} du champ ${this.label.toLowerCase()}`))
                        // i += 1
                    }
                }
            })
        },
        /**
         * Handle upload progress status
         * @param {*} progressEvent
         */
        setProgress(progressEvent, index) {
            if (progressEvent?.total) {
                this.progress[ this.progress.indexOf(index) ] = Math.round((progressEvent.loaded * 100) / progressEvent?.total)
                // this.progress = Math.round((progressEvent.loaded * 100) / progressEvent?.total)
            } else {
                // this.progress = 0
                this.progress[ this.progress.indexOf(index) ] = 0
            }
        },
        getProgress(index) {
            return this.progress[ this.progress.indexOf(index) ] + '%'
        }
    }
}
</script>
