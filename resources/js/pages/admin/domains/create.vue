<template>
    <div v-if="can('create_domain')">
        <ContentHeader title="Ajouter un nouveau domaine" />
        <ContentBody>
            <NLForm :action="create" :form="form">
                <!-- Familliies -->
                <NLColumn lg="4" md="4">
                    <NLSelect v-model="form.family_id" :form="form" name="family_id" label="Famille"
                        :options="familliesList" label-required :multiple="false"
                        placeholder="Veuillez choisir une famille" />
                </NLColumn>
                <!-- Name -->
                <NLColumn lg="4" md="4">
                    <NLInput v-model="form.name" :form="form" name="name" label="Nom" label-required
                        placeholder="Veuillez saisir le nom de domaine" />
                </NLColumn>
                <!-- Display priority -->
                <NLColumn lg="4" md="4">
                    <NLInput v-model="form.display_priority" :form="form" name="display_priority"
                        label="Priorité d'affichage" label-required
                        placeholder="Veuillez saisir la priorité d'affichage" type="number"
                        :max="max_display_priority" />
                </NLColumn>
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
import { Form } from 'vform'
import { mapGetters } from 'vuex'
export default {
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            url: 'domains/concerns/config',
            max_display_priority: 1,
            familliesList: [],
            form: new Form({
                name: null,
                family_id: null,
                usable_for_agency: true,
                usable_for_dre: false,
                display_priority: 1,
                is_active: false,
            })
        }
    },
    watch: {
        'form.family_id'(newVal, oldVal) {
            if (newVal !== oldVal && newVal) {
                this.initMaxDisplayPriorityValue()
            }
        },
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
    computed: {
        ...mapGetters({
            families: 'families/all'
        })
    },
    created() {
        this.$store.dispatch('settings/updatePageLoading', true)
        this.$store.dispatch('families/fetchAll', { withChildren: false, usableForAgencies: true, usableForDres: true }).then(() => {
            this.familliesList = this.families.all
            this.$store.dispatch('settings/updatePageLoading', false)
        })
    },
    methods: {
        initMaxDisplayPriorityValue() {
            this.$api.get(this.url, { params: { family: this.form.family_id, usable_for_agency: this.form.usable_for_agency, usable_for_dre: this.form.usable_for_dre, is_active: this.form.is_active } }).then((response) => {
                this.form.display_priority = response.data.display_priority
                this.max_display_priority = response.data.display_priority
                this.$store.dispatch('settings/updatePageLoading', false)
            }).catch(function (error) {
                this.$store.dispatch('settings/updatePageLoading', false)
                this.$swal.catchError(error)
            })
        },
        create() {
            this.form.post('domains').then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.form.reset()
                } else {
                    this.$swal.alert_error(response.data.message)
                }
            }).catch(error => {
                this.$swal.catchError(error)
            })
        }
    }
}
</script>
