<template>
    <NLModal :show="show" @isExpanded="handleDetailForm" @close="() => this.$emit('close')">
        <template #title>
            <small>
                {{ data?.control_point.name }}
            </small>
        </template>
        <template #default>
            <NLForm :form="form" :action="save" v-if="!isLoading">
                <NLColumn>
                    <NLSwitch v-model="form.regularized" type="is-success" :name="'regularized'" :form="form"
                        label="Levée" />
                </NLColumn>
                <NLColumn>
                    <NLSelect v-if="!form.regularized" v-model="form.type" name="type" :options="regularizationTypes"
                        :form="form" label="Choisissez un type" label-required placeholder="Choisissez un type" />
                </NLColumn>
                <!-- Recovery plan -->
                <NLColumn v-if="form.regularized">
                    <NLTextarea v-model="form.committed_action" :name="'committed_action'" label="Action engagée"
                        placeholder="Décrivez l'action engagée" :form="form" length="3000" label-required />
                </NLColumn>
                <NLColumn v-if="!form.regularized && form.type === 'Cause'">
                    <NLTextarea v-model="form.reason" :name="'reason'" label="Cause" :form="form" length="1000"
                        placeholder="Décrivez la cause" label-required />
                </NLColumn>
                <NLColumn v-if="!form.regularized && form.type == 'Action à engagée'">
                    <NLTextarea v-model="form.action_to_be_taken" :name="'action_to_be_taken'" label="Action à engagée"
                        placeholder="Décrivez l'action à engagée" :form="form" length="3000" label-required />
                </NLColumn>
            </NLForm>
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
            <div class="col-12 d-flex justify-end align-center">
                <NLButton :loading="form.busy" label="Enregistrer" class="is-radius" @click="save" />
            </div>
        </template>
    </NLModal>
</template>

<script>
import { Form } from 'vform';
import NLForm from '../components/NLForm'
import { mapGetters } from 'vuex';
export default {
    name: 'MissionRegularizationForm',
    components: { NLForm },
    props: {
        data: { type: [ Object, null ], required: true },
        show: { type: Boolean, default: false },
    },
    watch: {
        show(newValue, oldValue) {
            if (newValue && newValue !== oldValue) {
                this.initData()
            } else {
                this.isLoading = false
            }
        }
    },
    computed: {
        ...mapGetters({
            detail: 'details/detail',
        }),
    },
    data() {
        return {
            regularizationTypes: [
                {
                    id: 'Cause',
                    label: 'Cause'
                },
                {
                    id: 'Action à engagée',
                    label: 'Action à engagée'
                }
            ],
            form: new Form({
                regularization_id: null,
                detail_id: null,
                regularized: false,
                reason: null,
                committed_action: null,
                action_to_be_taken: null,
                type: null
            }),
            isContainerExpanded: false,
            isLoading: false,
        }
    },
    methods: {
        handleDetailForm(e) {
            this.isContainerExpanded = e
        },
        initData() {
            // console.log("test");
            // console.log(this.data?.id, this.data?.mission_id, this.data?.process?.id);
            // console.log({ missionId: this.data?.mission_id, processId: this.process?.id, detailId: this.data?.id });
            this.isLoading = !this.isLoading
            this.$store.dispatch('details/fetch', this.data?.id).then(() => {
                const detail = this.detail.detail
                console.log(detail?.id);
                this.form.detail_id = detail?.id
                this.form.id = detail?.regularization?.id
                this.form.regularized = !!detail?.regularization?.regularized_at
                this.form.reason = detail?.regularization?.reason || null
                this.form.committed_action = detail?.regularization?.committed_action || null
                this.form.action_to_be_taken = detail?.regularization?.action_to_be_taken || null
                if (detail?.regularization?.reason) {
                    this.form.type = 'Cause'
                } else if (detail?.regularization?.action_to_be_taken) {
                    this.form.type = 'Action à engagé'
                }
                console.log(this.form);
                this.isLoading = !this.isLoading
            }).catch(error => console.log(error))
        },
        /**
         * Save regularization
         */
        save() {
            this.form.post('/api/regularize/' + this.data.id).then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.$emit('success', response)
                } else {
                    this.$swal.alert_error(response.data.message)
                }
            }).catch(error => {
                let message = error.message
                if (error.response.status === 422) {
                    message = 'Les données fournies sont invalides.'
                }
                this.$swal.toast_error(message)
            })
        },
    }
}
</script>
