<template>
    <div v-if="can('edit_family')">
        <ContentBody>
            <NLForm :action="update" :form="form">
                <!-- Name -->
                <NLColumn lg="4" md="4">
                    <NLInput v-model="form.name" :form="form" name="name" label="Nom" label-required
                        placeholder="Veuillez saisir le nom de famille"
                        :readonly="!Boolean(Number(family?.current.is_deletable))" />
                </NLColumn>
                <!-- Code -->
                <!-- <NLColumn lg="4" md="4">
                    <NLInput v-model="form.code" :form="form" name="code" label="Code" label-required
                        placeholder="Veuillez saisir le code de la famille"
                        :readonly="!Boolean(Number(family?.current.is_deletable))" />
                </NLColumn> -->
                <!-- Display priority -->
                <NLColumn lg="4" md="4">
                    <NLInput v-model="form.display_priority" :form="form" name="display_priority"
                        label="Priorité d'affichage" label-required
                        placeholder="Veuillez saisir la priorité d'affichage" type="number" />
                </NLColumn>
                <NLColumn lg="4" md="4"></NLColumn>
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
import NLInput from '../../../components/Inputs/NLInput'
import { Form } from 'vform'
import { mapGetters } from 'vuex'
export default {
    components: { NLInput },
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    computed: {
        ...mapGetters({
            family: 'families/current'
        })
    },
    created() {
        this.initData()
    },
    data() {
        return {
            form: new Form({
                name: null,
                code: null,
                usable_for_agency: false,
                usable_for_dre: false,
                display_priority: 1,
                is_active: false,
                update_others_priority: false,
            })
        }
    },
    methods: {
        initData() {
            this.$store.dispatch('settings/updatePageLoading', true)
            this.$store.dispatch('families/fetch', { id: this.$route.params.family }).then(() => {
                const data = this.family?.current
                this.url += `/${data.id}`
                data.usable_for_agency = Boolean(Number(data.usable_for_agency))
                data.usable_for_dre = Boolean(Number(data.usable_for_dre))
                data.is_active = Boolean(Number(data.is_active))
                data.update_others_priority = Boolean(Number(data.update_others_priority))
                this.form.fill(data)
                this.$store.dispatch('settings/updatePageLoading', false)
            }).catch((error) => {
                this.$store.dispatch('settings/updatePageLoading', false)
                this.$swal.catchError(error)
            })
        },
        update() {
            this.$swal.confirm_update("Vous souhaitez mettre à jour l'ordre d'affichage des autres familles ?").then(action => {
                this.form.update_others_priority = action.isConfirmed
                this.form.put('families/' + this.$route.params.family).then(response => {
                    if (response.data.status) {
                        this.$swal.toast_success(response.data.message)
                        this.$router.push({ name: 'families-index' })
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
