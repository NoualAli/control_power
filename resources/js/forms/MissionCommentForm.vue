<template>
    <NLModal :show="show" @isExpanded="handleDetailForm" @close="() => this.$emit('close')">
        <template #title>
            <small>
                {{ config.title }}
            </small>
        </template>
        <template #default>
            <div v-if="!isLoading">
                <NLForm :form="form" :action="save" v-if="!readonly">
                    <NLColumn>
                        <NLWyswyg v-model="form.content" :name="config.fields.content.name" :form="form"
                            :label="config.fields.content.label" :placeholder="config.fields.content.placeholder"
                            labelRequired />
                    </NLColumn>
                    <NLColumn>
                        <NLSwitch type="is-success" v-model="form.validated" :name="config.fields.validated.name"
                            :form="form" :label="config.fields.validated.label" />
                    </NLColumn>
                </NLForm>
                <NLGrid extraClass="content" v-else>
                    <NLColumn v-html="content"></NLColumn>
                    <NLColumn>
                        <div class="tags" v-if="!isValidated">
                            <div class="tag is-warning">En attente de validation</div>
                        </div>
                        <span v-if="isValidated">
                            Date de validation:
                        </span>
                        <span v-if="isValidated">
                            {{ validatedAt }}
                        </span>
                    </NLColumn>

                </NLGrid>
            </div>

            <!-- Loader -->
            <div class="component-loader-container" v-else>
                <div class="component-loader"></div>
                <div class="component-loader-text">
                    Chargement en cours
                </div>
            </div>
        </template>
        <template #footer>
            <!-- Submit Button -->
            <NLButton v-if="!config.readonly" :loading="form.busy" label="Enregistrer" class="is-radius" @click="save" />
            <button
                v-if="type == 'ci_opinion' && !isValidated && commentExists && !editMode && canCreateComment && readonly"
                class="btn btn-warning has-icon" @click.prevent="switchEditMode()">
                <i class="las la-edit icon" />
                Editer l'avis
            </button>
            <button
                v-if="type == 'cdc_report' && !isValidated && commentExists && !editMode && canCreateComment && readonly"
                class="btn btn-warning has-icon" @click.prevent="switchEditMode()">
                <i class="las la-edit icon" />
                Editer le rapport
            </button>
        </template>
    </NLModal>
</template>

<script>
import NLForm from '../components/NLForm';
import { Form } from 'vform';
import api from '../plugins/api';
export default {
    name: 'MissionDetailForm',
    emits: [ 'success', 'close' ],
    components: { NLForm },
    props: {
        config: { type: [ Object ], required: true },
        show: { type: Boolean, default: false },
    },
    watch: {
        show(newValue, oldValue) {
            if (newValue && newValue !== oldValue) {
                this.initData()
                const data = {
                    type: this.type,
                    isValidated: this.isValidated,
                    commentExists: this.commentExists,
                    editMode: this.editMode,
                    canCreateComment: this.canCreateComment,
                    readonly: this.readonly,
                }
            } else {
                this.config.comment = {}
                this.config.data = {}
                this.data = {
                    comment: null,
                    mission: null
                }
                this.form.reset()
                this.isLoading = false
            }
        }
    },
    computed: {
        mission() {
            return this.data?.mission
        },
        readonly() {
            return this.config?.readonly
        },
        editMode() {
            return this.form?.edit_mode
        },
        comment() {
            return this.data?.comment
        },
        canCreateComment() {
            if (this.type == 'ci_opinion') {
                return this.can('create_ci_opinion')
            } else if (this.type == 'cdc_report') {
                return this.can('create_cdc_report')
            }
            return false
        },
        commentExists() {
            return !!this.comment
        },
        content() {
            return this.form?.content
        },
        validatedAt() {
            if (this.type == 'ci_opinion') {
                return this.config?.data?.ci_validation_at
            } else if (this.type == 'cdc_report') {
                return this.config?.data?.cdc_validation_at
            }
            return false
        },
        isValidated() {
            if (this.type == 'ci_opinion') {
                return this.mission?.ci_validation_at ? true : false
            } else if (this.type == 'cdc_report') {
                return this.mission?.cdc_validation_at ? true : false
            }
            return false
        },
        type() {
            return this.config?.type
        }
    },
    data() {
        return {
            form: new Form({
                content: null,
                id: null,
                type: null,
                validated: false,
                edit_mode: false,
            }),
            isContainerExpanded: false,
            isLoading: false,
            data: {
                mission: null,
                comment: null,
            }
        }
    },
    methods: {
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
        initData() {
            if (this.comment?.id) {
                this.isLoading = true
                api.get('comments/' + this.comment?.id).then((response) => {
                    this.data.comment = response.data
                    this.isLoading = false
                })
            } else {
                this.data.comment = this.config?.data[ this.type ] ? this.config?.data[ this.type ][ 0 ] : null
            }
            this.data.mission = this.config.data
            this.form.content = this.data?.comment?.content ?? null
            this.form.type = this.config.type
            this.form.id = this.data?.comment?.id ?? null
            this.form.validated = this.isValidated

        },
        /**
         * Switch to edit mode
         *
         * @param {String} type
         */
        switchEditMode() {
            this.initData()
            this.form.edit_mode = true
            this.config.readonly = false
        },
        /**
         * Save comment
         */
        save() {
            this.form.post('/api/missions/' + this.config?.data?.id + '/comments').then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.form.edit_mode = false
                    this.config.readonly = true
                    this.$emit('success')
                    this.initData()
                } else {
                    this.$swal.alert_error(response.data.message)
                }
            }).catch(error => {
                console.log(error)
            })
        },
    }
}
</script>
