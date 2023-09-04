<template>
    <NLModal :show="show" @isExpanded="handleDetailForm" @close="close">
        <template #title>
            <small>
                {{ title }}
            </small>
        </template>
        <template #default>
            <NLForm :form="form" :action="save" v-if="!isReadonly && !isLoading">
                <NLColumn>
                    <NLWyswyg :length="3000" v-model="form.content" :name="fields.content.name" :form="form"
                        :label="fields.content.label" :placeholder="fields.content.placeholder" labelRequired />
                </NLColumn>
                <NLColumn>
                    <NLSwitch type="is-success" v-model="form.validated" :name="fields.validated.name" :form="form"
                        :label="fields.validated.label" />
                </NLColumn>
            </NLForm>
            <NLContainer class="content box text-normal" v-if="isReadonly && !isLoading" isFluid v-html="content"
                :key="forceReload">
            </NLContainer>

            <!-- Loader -->
            <NLComponentLoader :isLoading="isLoading" />
        </template>
        <template #footer>
            <NLFlex v-if="isValidated">
                <span>
                    Date de validation:
                </span>
                <span>
                    {{ validatedAt }}
                </span>
            </NLFlex>
            <!-- Submit Button -->
            <NLButton v-if="!isReadonly && !isLoading" :loading="form.busy" label="Enregistrer" @click="save" />
            <button
                v-if="type == 'ci_report' && !isValidated && commentExists && !editMode && canCreateComment && isReadonly"
                class="btn btn-warning has-icon" @click.prevent="switchEditMode()">
                <i class="las la-edit icon" />
                Editer le compte-rendu
            </button>
            <button
                v-if="type == 'cdc_report' && !isValidated && commentExists && !editMode && canCreateComment && isReadonly"
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
import NLComponentLoader from '../components/NLComponentLoader'
export default {
    name: 'MissionDetailForm',
    emits: [ 'success', 'close' ],
    components: { NLForm, NLComponentLoader },
    props: {
        show: { type: Boolean, default: false },
        type: { type: [ String, null ], required: true },
        mission: { type: [ Object, null ], required: true },
        readonly: { type: Boolean, required: true },
    },
    watch: {
        show(newValue, oldValue) {
            if (newValue && newValue !== oldValue) {
                this.initData()
            } else {
                this.form.reset()
                this.isLoading = false
            }
        }
    },
    computed: {
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
        }
    },
    data() {
        return {
            form: new Form({
                content: null,
                id: null,
                type: null,
                validated: false,
            }),
            isContainerExpanded: false,
            isLoading: false,
            isReadonly: this.readonly,
            editMode: false,
            comment: this.mission?.comment,
            forceReload: 1,
            fields: {
                content: {
                    label: 'Votre compte-rendu',
                    placeholder: 'Ecrivez votre compte-rendu',
                    name: 'content'
                },
                validated: {
                    label: 'Validé ?',
                    name: 'validated'
                },
            },
            title: null,
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
        initData(forceReload = false) {
            this.isLoading = true
            this.isReadonly = true
            this.editMode = false
            // console.log(this.mission[ this.type ], this.type, this.mission);
            if (this.commentExists) {
                api.get('comments/' + this.mission[ this.type ]?.id).then((response) => {
                    this.comment = response.data
                    console.log(this.comment);
                    if (forceReload) {
                        this.forceReload += 1
                    }
                    this.isLoading = false
                })
            } else {
                this.isReadonly = false
                this.editMode = true
            }

            this.showCommentForm(this.type, this.isReadonly)
            this.isLoading = !this.isLoading
        },

        /**
         * Show mission comment (ci opinion, cdc report)
         */
        showCommentForm(type, readonly = false) {
            if (type == 'cdc_report') {
                this.showCdcReport(readonly)
            }

            if (type == 'ci_report') {
                this.showCiReport(readonly)
            }
        },

        /**
         * Initialize ci report data
         *
         */
        showCiReport() {
            this.form.validated = this.mission?.is_validated_by_ci
            this.form.type = 'ci_report'
            this.form.id = this.commentExists ? this.mission?.ci_report?.id : null
            this.form.content = this.content

            this.title = 'Compte-rendu du contrôleur sur la mission ' + this.mission?.reference
            this.fields.content = {
                label: 'Votre compte-rendu',
                placeholder: 'Ecrivez votre compte-rendu',
                name: 'content'
            }
        },
        /**
         * Initialize cdc report data
         *
         */
        showCdcReport() {
            this.form.validated = this.mission?.is_validated_by_cdc
            this.form.type = 'cdc_report'
            this.form.id = this.commentExists ? this.mission?.cdc_report?.id : null
            this.form.content = this.content

            this.title = 'Rapport du chef de département sur la mission ' + this.mission?.reference
            this.fields.content = {
                label: 'Votre rapport',
                placeholder: 'Ecrivez votre rapport',
                name: 'content'
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
            this.isLoading = true
            this.form.post('missions/' + this.mission?.id + '/comments').then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.switchReadonlyMode()
                    this.$emit('success')
                } else {
                    this.$swal.alert_error(response.data.message)
                }
                this.isLoading = false
            }).catch(error => {
                this.isLoading = false
                console.log(error)
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
