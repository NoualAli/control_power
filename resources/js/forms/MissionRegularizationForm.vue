<template>
    <NLModal :show="show" @isExpanded="handleDetailForm" @close="() => this.$emit('close')">
        <template #title>
            <small>
                {{ detail?.control_point.name }}
            </small>
        </template>
        <template #default>
            <NLForm :form="form" :action="save" v-if="!isLoading">
                <NLColumn>
                    <NLSwitch v-model="form.is_regularized" type="is-success" name="is_regularized" :form="form"
                        label="Levée ?" />
                </NLColumn>
                <NLColumn>
                    <NLWyswyg v-model="form.action_to_be_taken" name="action_to_be_taken" label="Action à engager"
                        placeholder="Décrivez l'action à engagée" :form="form" :length="1000" label-required />
                </NLColumn>
                <NLColumn>
                    <NLFile @uploaded="handleMedia" @deleted="handleMedia" @loaded="handleMedia" v-model="form.media"
                        name="media" label="Pièces jointes" attachableType="App\Models\MissionDetailRegularization"
                        :form="form" multiple :folder="folderName" />
                </NLColumn>
            </NLForm>
            <!-- Loader -->
            <NLComponentLoader :isLoading="isLoading" v-if="isLoading" />
        </template>
        <template #footer>
            <!-- Submit Button -->
            <div class="col-12 d-flex justify-end align-center">
                <NLButton :loading="formIsLoading" label="Enregistrer" @click="save" v-if="!isLoading" />
            </div>
        </template>
    </NLModal>
</template>

<script>
import { Form } from 'vform';
import NLForm from '../components/NLForm.vue'
import NLComponentLoader from '../components/NLComponentLoader.vue'
import { slugify } from '../plugins/helpers';
export default {
    name: 'MissionRegularizationForm',
    components: { NLForm, NLComponentLoader },
    props: {
        show: { type: Boolean, default: false },
        detail: { type: [ Object, null ] }
    },
    watch: {
        show(newValue, oldValue) {
            if (newValue && newValue !== oldValue) {
                this.initData()
            } else {
                this.isLoading = false
            }
        },
    },
    computed: {
        folderName() {
            return 'Régularisations/' + this.slugify(this.detail?.campaign?.reference) + '/' + this.slugify(this.detail?.mission?.reference);
        }
    },
    data() {
        return {
            formIsLoading: false,
            form: new Form({
                mission_detail_id: null,
                action_to_be_taken: null,
                is_regularized: false,
                media: {}
            }),
            isContainerExpanded: false,
            isLoading: false,
        }
    },
    created() {
        this.initData()
    },
    methods: {
        handleMedia(files) {
            this.form.media = files
        },
        handleDetailForm(e) {
            this.isContainerExpanded = e
        },
        initData() {
            this.isLoading = true
            this.form.reset()
            this.form.errors.errors = {}
            this.form.mission_detail_id = this.detail?.id
            this.isLoading = false
        },
        /**
         * Save regularization
         */
        save() {
            this.formIsLoading = true
            this.form.post('regularize/' + this.detail?.id).then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.$emit('success', response)
                } else {
                    this.$swal.alert_error(response.data.message)
                }
                this.formIsLoading = false
            }).catch(error => {
                let message = error.message
                if (error.response.status === 422) {
                    message = 'Les données fournies sont invalides.'
                }
                this.$swal.toast_error(message)
                this.formIsLoading = false
            })
        },
    }
}
</script>
