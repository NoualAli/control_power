<!-- eslint-disable vue/multi-word-component-names -->
<template>
    <div v-if="can('edit_domain')">
        <ContentBody>
            <NLForm :action="update" :form="form">
                <!-- Familliies -->
                <NLColumn lg="4" md="4">
                    <NLSelect v-model="form.family_id" :form="form" name="family_id" label="Famille"
                        :options="familliesList" label-required :multiple="false"
                        placeholder="Veuillez choisir une famille"
                        :readonly="!Boolean(Number(domain?.current.is_deletable))" />
                </NLColumn>
                <!-- Name -->
                <NLColumn lg="4" md="4">
                    <NLInput v-model="form.name" :form="form" name="name" label="Nom" label-required
                        placeholder="Veuillez saisir le nom de domaine"
                        :readonly="!Boolean(Number(domain?.current.is_deletable))" />
                </NLColumn>
                <!-- Display priority -->
                <NLColumn lg="4" md="4">
                    <NLInput v-model="form.display_priority" :form="form" name="display_priority"
                        label="Priorité d'affichage" label-required
                        placeholder="Veuillez saisir la priorité d'affichage" type="number" />
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
                        <NLButton :loading="form.busy" label="Mettre à jour" />
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
            familliesList: [],
            form: new Form({
                name: null,
                family_id: null,
                usable_for_agency: false,
                usable_for_dre: false,
                display_priority: 1,
                is_active: false,
                update_others_priority: false,
            })
        }
    },
    computed: {
        ...mapGetters({
            domain: 'domains/current',
            families: 'families/all'
        })
    },
    created() {
        this.$store.dispatch('settings/updatePageLoading', true)
        this.$store.dispatch('families/fetchAll', { withChildren: false, usableForAgencies: true, usableForDres: true }).then(() => {
            this.familliesList = this.families.all
            this.$store.dispatch('domains/fetch', { id: this.$route.params.domain }).then(() => {
                const data = this.domain.current
                data.usable_for_agency = Boolean(Number(data.usable_for_agency))
                data.usable_for_dre = Boolean(Number(data.usable_for_dre))
                data.is_active = Boolean(Number(data.is_active))
                data.update_others_priority = Boolean(Number(data.update_others_priority))
                this.form.fill(data)
                this.$store.dispatch('settings/updatePageLoading', false)
            })
        })
    },
    methods: {
        update() {
            this.$swal.confirm_update("Vous souhaitez mettre à jour l'ordre d'affichage des autres familles ?").then(action => {
                this.form.update_others_priority = action.isConfirmed
                this.form.put('domains/' + this.$route.params.domain).then(response => {
                    if (response.data.status) {
                        this.$swal.toast_success(response.data.message)
                        this.$router.push({ name: 'domains-index' })
                    } else {
                        this.$swal.alert_error(response.data.message)
                    }
                }).catch(error => {
                    this.$swal.catchError(error)
                })

            })
        }
    }
}
</script>
