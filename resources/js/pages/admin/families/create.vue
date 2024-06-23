<template>
    <div v-if="can('create_family')">
        <ContentHeader title="Ajouter une nouvelle famille" />
        <ContentBody>
            <NLForm :action="create" :form="form">
                <!-- Name -->
                <NLColumn lg="4" md="4">
                    <NLInput v-model="form.name" :form="form" name="name" label="Nom" label-required
                        placeholder="Veuillez saisir le nom de famille" />
                </NLColumn>
                <!-- Code -->
                <!-- <NLColumn lg="4" md="4">
                    <NLInput v-model="form.code" :form="form" name="code" label="Code" label-required
                        placeholder="Veuillez saisir le code de la famille" />
                </NLColumn> -->
                <!-- Display priority -->
                <NLColumn lg="4" md="4">
                    <NLInput v-model="form.display_priority" :form="form" name="display_priority"
                        label="Priorité d'affichage" label-required
                        placeholder="Veuillez saisir la priorité d'affichage" type="number"
                        :max="max_display_priority" />
                </NLColumn>
                <NLColumn lg="4" md="4" />
                <!-- Is disabled -->
                <NLColumn lg="4" md="4">
                    <NLSwitch v-model="form.is_active" :form="form" name="is_active" label="Actif" label-required />
                </NLColumn>
                <!-- Usable for agency -->
                <!-- <NLColumn lg="4" md="4">
                    <NLSwitch v-model="form.usable_for_agency" :form="form" name="usable_for_agency"
                        label="Utilisable pour agence" label-required />
                </NLColumn> -->
                <!-- Usable for DRE -->
                <!-- <NLColumn lg="4" md="4">
                    <NLSwitch v-model="form.usable_for_dre" :form="form" name="usable_for_dre"
                        label="Utilisable pour DRE" label-required />
                </NLColumn> -->
                <NLColumn>
                    <NLFlex lgJustifyContent="end">
                        <NLButton :loading="form.busy" label="Ajouter" />
                    </NLFlex>
                </NLColumn>
            </NLForm>
        </ContentBody>
    </div>
</template>

<script>
import NLColumn from '../../../components/Grid/NLColumn'
import { Form } from 'vform'
export default {
    components: { NLColumn },
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            max_display_priority: null,
            url: 'families/concerns/config',
            form: new Form({
                name: null,
                code: null,
                usable_for_agency: true,
                usable_for_dre: false,
                display_priority: 1,
                is_active: false,
            })
        }
    },
    created() {
        this.initData()
    },
    watch: {
        'form.usable_for_agency'(newVal, oldVal) {
            if (newVal !== oldVal) {
                this.initMaxDisplayPriorityValue()
            }
        },
        'form.usable_for_dre'(newVal, oldVal) {
            if (newVal !== oldVal) {
                this.initMaxDisplayPriorityValue()
            }
        },
        'form.is_active'(newVal, oldVal) {
            if (newVal !== oldVal) {
                this.initMaxDisplayPriorityValue()
            }
        }
    },
    methods: {
        initData() {
            this.$store.dispatch('settings/updatePageLoading', true)
            this.initMaxDisplayPriorityValue()
        },
        initMaxDisplayPriorityValue() {
            this.$api.get(this.url, { params: { usable_for_agency: this.form.usable_for_agency, usable_for_dre: this.form.usable_for_dre, is_active: this.form.is_active } }).then((response) => {
                this.form.display_priority = response.data.display_priority
                this.max_display_priority = response.data.display_priority
                this.$store.dispatch('settings/updatePageLoading', false)
            }).catch(function (error) {
                this.$store.dispatch('settings/updatePageLoading', false)
                this.$swal.catchError(error)
            })
        },
        create() {
            this.form.post('families').then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.form.reset()
                    this.initData()
                } else {
                    this.$swal.alert_error(response.data.message)
                }
            })
        }
    }
}
</script>
