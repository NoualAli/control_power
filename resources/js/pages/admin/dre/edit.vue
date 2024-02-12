<template>
    <div v-if="can('edit_dre')">
        <ContentBody>
            <NLForm :action="update" :form="form">
                <NLColumn>
                    <NLSwitch v-model="form.is_for_testing" name="is_for_testing" :form="form" label="DRE TEST"
                        type="is-success" />
                </NLColumn>
                <!-- Code -->
                <NLColumn lg="6" md="6">
                    <NLInput v-model="form.code" type="number" :form="form" name="code" label="Code" label-required />
                </NLColumn>
                <!-- Name -->
                <NLColumn lg="6" md="6">
                    <NLInput v-model="form.name" :form="form" name="name" label="Nom" label-required />
                </NLColumn>

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
    computed: {
        ...mapGetters({
            dre: 'dre/current'
        })
    },
    created() {
        this.$store.dispatch('settings/updatePageLoading', true)
        this.$store.dispatch('dre/fetch', this.$route.params.dre).then(() => {
            const data = this.dre.current
            this.form.fill(data)
            this.$store.dispatch('settings/updatePageLoading', false)
        })
    },
    data() {
        return {
            form: new Form({
                name: null,
                code: null,
                is_for_testing: false,
            })
        }
    },
    methods: {
        update() {
            this.form.put('dre/' + this.$route.params.dre).then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.$router.push({ name: 'dre-index' })
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
