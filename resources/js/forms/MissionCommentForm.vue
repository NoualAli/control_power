<template>
    <NLModal :show="show" @isExpanded="handleDetailForm" @close="close">
        <template #title>
            <small>
                {{ title }}
            </small>
        </template>
        <template #default>
            <!-- Edit view -->
            <NLForm :form="form" :action="save" v-if="!isReadonly && !isLoading">
                <NLColumn>
                    <NLWyswyg :length="3000" v-model="form.content" :name="fields.content.name" :form="form"
                        :label="fields.content.label" :placeholder="fields.content.placeholder" labelRequired />
                </NLColumn>
                <NLColumn>
                    <!-- CDC -->
                    <NLFile v-if="form.currentMode == 2" @uploaded="handleMedia" @deleted="handleMedia"
                        @loaded="handleMedia" v-model="form.closing_report" :name="'closing_report'" label="PV de clôture"
                        attachable-type="App\Models\Mission" :attachable-id="mission.id" :form="form"
                        accepted="jpg,jpeg,png" :canDelete="canDeleteMedia()" :readonly="![1, 2].includes(form.currentMode)"
                        multiple labelRequired
                        :helpText="'- Uniquement les fichiers de type jpg,jpeg,png sont accéptés\n- Chaque fichier ne doit pas dépassé 2Mo soit 2048Ko'"
                        :folder="fields.file.folderName" />
                    <!-- CI -->
                    <NLFile v-if="form.currentMode == 1" @uploaded="handleMedia" @deleted="handleMedia"
                        @loaded="handleMedia" v-model="form.mission_order" name="mission_order" label="Ordre de mission"
                        attachable-type="App\Models\Mission" :attachable-id="mission.id" :form="form"
                        accepted="jpg,jpeg,png" placeholder="Téléverser votre ordre de mission"
                        :canDelete="canDeleteMedia()" :readonly="![1, 2].includes(form.currentMode)" multiple labelRequired
                        :helpText="'- Uniquement les fichiers de type jpg,jpeg,png sont accéptés\n- Chaque fichier ne doit pas dépassé 2Mo soit 2048Ko'"
                        :folder="fields.file.folderName" />
                </NLColumn>
                <NLColumn>
                    <NLSwitch type="is-success" v-model="form.validated" :name="fields.validated.name" :form="form"
                        :label="fields.validated.label" />
                </NLColumn>
            </NLForm>

            <!-- Readonly view -->
            <NLGrid v-if="isReadonly && !isLoading">
                <NLColumn>
                    <NLContainer class="content box text-normal" v-if="isReadonly && !isLoading" isFluid v-html="content()"
                        :key="forceReload">
                    </NLContainer>
                </NLColumn>
                <NLColumn>
                    <NLFile v-model="form[fields.file.name]" v-if="form[fields.file.name] && isReadonly && !isLoading"
                        :label="fields.file.label" :readonly="true" />
                </NLColumn>
            </NLGrid>

            <!-- Loader -->
            <NLComponentLoader :isLoading="isLoading" />
        </template>
        <template #footer>
            <NLFlex v-if="isValidated()">
                <span>
                    Date de validation:
                </span>
                <span>
                    {{ validatedAt() }}
                </span>
            </NLFlex>
            <!-- Submit Button -->
            <NLButton v-if="!isReadonly && !isLoading" :loading="form.busy" label="Enregistrer" @click="save" />
            <button
                v-if="type == 'ci_report' && !isValidated() && commentExists() && !editMode && canCreateComment() && isReadonly"
                class="btn btn-warning has-icon" @click.prevent="switchEditMode()">
                <NLIcon name="edit" />
                Editer le conclusion
            </button>
            <button
                v-if="type == 'cdc_report' && !isValidated() && commentExists() && !editMode && canCreateComment() && isReadonly"
                class="btn btn-warning has-icon" @click.prevent="switchEditMode()">
                <NLIcon name="edit" />
                Editer la conclusion
            </button>
        </template>
    </NLModal>
</template>

<script>
import NLForm from '../components/NLForm';
import { Form } from 'vform';
import api from '../plugins/api';
import NLComponentLoader from '../components/NLComponentLoader'
import { hasRole } from '../plugins/user';
import { slugify } from '../plugins/helpers';
export default {
    name: 'MissionDetailForm',
    emits: [ 'success', 'close' ],
    components: { NLForm, NLComponentLoader },
    props: {
        show: { type: Boolean, default: false },
        type: { type: [ String, null ], required: true },
        missionId: { type: [ String, null ], required: true },
        readonly: { type: Boolean, required: true },
    },
    watch: {
        show(newValue, oldValue) {
            if (newValue && newValue !== oldValue) {
                this.initData()
                this.forcedKey += 1
            } else {
                this.forcedKey += 1
                this.form.reset()
                this.mission = {}
                this.isLoading = false
            }
        },
    },
    data() {
        return {
            form: new Form({
                currentMode: 1,
                content: null,
                id: null,
                type: null,
                validated: false,
                mission_order: {},
                closing_report: {},
            }),
            mission: {},
            forcedKey: 1,
            isContainerExpanded: false,
            isLoading: false,
            isReadonly: this.readonly,
            editMode: false,
            comment: this.mission?.comment,
            forceReload: 1,
            fields: {
                content: {
                    label: 'Votre conclusion',
                    placeholder: 'Ecrivez votre conclusion',
                    name: 'content'
                },
                validated: {
                    label: 'Validé ?',
                    name: 'validated'
                },

                file: {
                    label: 'Ordre de mission',
                    name: 'mission_order'
                },
            },
            title: null,
        }
    },
    methods: {
        handleMedia(files) {
            if (this.form.currentMode == 1) {
                this.form.mission_order = files
            } else if (this.form.currentMode == 2) {
                this.form.closing_report = files
            }
        },
        canDeleteMedia() {
            if (this.form.currentMode == 1) {
                return !this.mission.is_validated_by_ci
            } else if (this.form.currentMode == 2) {
                return !this.mission.is_validated_by_cdc
            }
            return false
        },
        canCreateComment() {
            if (this.type == 'ci_report') {
                return this.can('create_ci_report')
            } else if (this.type == 'cdc_report') {
                return this.can('create_cdc_report')
            }
            return false
        },
        commentExists() {
            return !!this.mission[ this.type ]
        },
        content() {
            return this.mission[ this.type ]?.content
        },
        validatedAt() {
            if (this.type == 'ci_report') {
                return this.mission?.ci_validation_at
            } else if (this.type == 'cdc_report') {
                return this.mission?.cdc_validation_at
            }
            return false
        },
        isValidated() {
            if (this.type == 'ci_report') {
                return this.mission?.is_validated_by_ci ? true : false
            } else if (this.type == 'cdc_report') {
                return this.mission?.is_validated_by_cdc ? true : false
            }
            return false
        },
        /**
         * Handle container expansion
         *
         * @param {Object} e
         */
        handleDetailForm(e) {
            this.isContainerExpanded = e
        },

        /**
         * Initialize data
         */
        initData(forceReload = false) {
            this.isLoading = !this.isLoading
            this.isReadonly = true
            this.editMode = false
            api.get('missions/' + this.missionId).then((response) => {
                this.mission = response.data

                if (hasRole([ 'ci' ])) {
                    this.form.currentMode = 1 // Execution mode
                } else if (hasRole('cdc')) {
                    this.form.currentMode = 2 // Revision mode
                } else {
                    this.form.currentMode = 3
                }
                if (this.commentExists()) {
                    api.get('comments/' + this.mission[ this.type ]?.id).then((response) => {
                        this.comment = response.data
                        if (forceReload) {
                            this.forceReload += 1
                        }
                        this.isLoading = false
                    })
                } else {
                    this.isReadonly = false
                    this.editMode = true
                }
                this.showCommentForm(this.type, this.isReadonly, this.mission)
                this.isLoading = false
            })
        },

        /**
         * Show mission comment (ci opinion, cdc report)
         */
        showCommentForm(type, readonly = false, mission) {
            if (type == 'cdc_report') {
                this.showCdcReport(mission)
            }

            if (type == 'ci_report') {
                this.showCiReport(mission)
            }
        },

        /**
         * Initialize ci report data
         *
         */
        showCiReport(mission) {
            this.form.validated = mission?.is_validated_by_ci
            this.form.type = 'ci_report'
            this.form.id = this.commentExists() ? mission?.ci_report?.id : null
            this.form.content = this.content()
            this.form.mission_order = Object.assign({}, mission?.mission_order?.map((order) => order.id))

            this.title = 'Conclusion du contrôleur sur la mission ' + mission?.reference
            this.fields.content = {
                label: 'Conclusion',
                placeholder: 'Ecrivez votre conclusion',
                name: 'content'
            }
            this.fields.file = {
                label: 'Ordre de mission',
                name: 'mission_order',
                folderName: 'Ordres de mission' + '/' + this.slugify(this.mission?.campaign?.reference) + '/' + this.slugify(this.mission?.reference)
            }
        },
        /**
         * Initialize cdc report data
         *
         */
        showCdcReport(mission) {
            this.form.validated = mission?.is_validated_by_cdc
            this.form.type = 'cdc_report'
            this.form.id = this.commentExists() ? mission?.cdc_report?.id : null
            this.form.content = this.content()
            this.form.closing_report = Object.assign({}, mission?.closing_report?.map((report) => report.id))

            this.title = 'Conclusion du chef de département sur la mission ' + mission?.reference
            this.fields.content = {
                label: 'Votre conclusion',
                placeholder: 'Ecrivez votre conclusion',
                name: 'content'
            }

            this.fields.file = {
                label: 'PV de clôture',
                name: 'closing_report',
                folderName: 'Pv de clôture' + '/' + this.slugify(this.mission?.campaign?.reference) + '/' + this.slugify(this.mission?.reference)
            }
        },
        /**
         * Switch to edit mode
         *
         * @param {String} type
         */
        switchEditMode() {
            this.initData()
            this.editMode = true
            this.isReadonly = false
        },

        /**
         * Switch to edit mode
         *
         * @param {String} type
         */
        switchReadonlyMode() {
            this.initData(true)
            this.editMode = false
            this.isReadonly = true
        },

        /**
         * Save comment
         */
        save() {
            // console.log('test');
            // this.isLoading = true
            this.form.post('missions/' + this.mission?.id + '/comments').then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.switchReadonlyMode()
                    this.$emit('success')
                } else {
                    this.$swal.alert_error(response.data.message)
                }
                // this.isLoading = false
            }).catch(error => {
                // this.isLoading = false
                this.$swal.catchError(error)
            })
        },
        /**
         * Close modal
         *
         * @param {String} type
         * @param {Boolean} reload
         */
        close(type = null, reload = false) {
            this.isLoading = false
            this.$emit('close', { type, reload })
            this.form.reset()
        }
    }
}
</script>
