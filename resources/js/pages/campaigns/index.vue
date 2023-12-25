<template>
    <div v-if="can('view_control_campaign')">
        <ContentHeader>
            <template #actions>
                <router-link v-if="can('create_control_campaign')" class="btn btn-info" :to="{ name: 'campaigns-create' }">
                    Ajouter
                </router-link>
            </template>
        </ContentHeader>
        <ContentBody>
            <NLDatatable :refresh="refresh" :columns="columns" :actions="actions" :filters="filters"
                title="Suivi du planning annuel" urlPrefix="campaigns"
                @dataLoaded="() => this.$store.dispatch('settings/updatePageLoading', false)">
                <template #actions-before="{ item, callback }">
                    <button v-if="!item?.validated_by_id && can('validate_control_campaign')" class="btn btn-info has-icon"
                        @click.stop="callback(validate, item)">
                        <i class="las la-check icon" />
                    </button>
                </template>
            </NLDatatable>
        </ContentBody>
    </div>
</template>

<script>
import { hasRole } from '../../plugins/user'
// import api from '../../plugins/api'
export default {
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            refresh: 0,
            yearsList: [],
            columns: [
                {
                    label: 'Référence',
                    field: 'reference',
                    sortable: true
                },
                {
                    label: 'Date début',
                    field: 'start_date',
                    sortable: true
                },
                {
                    label: 'Date fin',
                    field: 'end_date',
                    sortable: true
                },
                {
                    label: 'Début',
                    field: 'remaining_days_before_start_str'
                },
                {
                    label: 'Fin',
                    field: 'remaining_days_before_end_str'
                },
                {
                    label: 'Etat',
                    field: 'validated_by_id',
                    hide: !hasRole([ 'dcp', 'cdcr' ]),
                    methods: {
                        showField(item) {
                            return item.validated_by_id ? 'Validé' : 'En attente de validation'
                        }
                    }
                },
                {
                    label: 'Test',
                    field: 'is_for_testing'
                },
            ],
            actions: {
                show: {
                    show: true,
                    apply: this.show
                },
                edit: {
                    show: (item) => {
                        return this.can('edit_control_campaign') && item.remaining_days_before_start > 5
                    },
                    apply: this.edit
                },
                delete: {
                    show: (item) => {
                        return this.can('delete_control_campaign') && item.remaining_days_before_start > 5
                    },
                    apply: this.destroy
                }
            },
            filters: {
                validated: {
                    label: 'Etat',
                    hide: !hasRole([ 'dcp', 'cdcr' ]),
                    data: [
                        {
                            id: "En attente de validation",
                            label: 'En attente de validation'
                        },
                        {
                            id: "Validé",
                            label: 'Validé'
                        }
                    ],
                    value: null
                },
                // between: {
                //     value: null,
                //     type: 'date-range',
                //     cols: '6',
                //     attributes: {
                //         start: {
                //             cols: 'col-lg-4',
                //             label: 'De',
                //             value: null
                //         },
                //         end: {
                //             cols: 'col-lg-4',
                //             label: 'À',
                //             value: null
                //         }
                //     }
                // }
            },
        }
    },
    created() {
        this.initYearsList()
        this.$store.dispatch('settings/updatePageLoading', true)
    },
    computed: {
    },
    methods: {
        initYearsList() {
            let start = 2023
            const currentYear = this.currentYear
            this.yearsList = []
            for (start; start <= currentYear; start++) {
                this.yearsList.push({ id: start, label: start })
            }

            return this.yearsList
        },
        /**
         * Affiche une campagne de contrôle
         *
         * @param {Object} e
         */
        show(e) {
            // return this.$router.push({ name: 'campaign', params: { campaignId: e.item.id } })
            window.open(this.$router.resolve({ name: 'campaign', params: { campaignId: e.item.id } }).href, '_blank')
        },

        /**
         *
         * @param {Object} e
         */
        edit(e) {
            // return this.$router.push({ name: 'campaigns-edit', params: { campaignId: e.item.id } })
            window.open(this.$router.resolve({ name: 'campaigns-edit', params: { campaignId: e.item.id } }), '_blank')
        },
        /**
         * Valide une campagne de contrôle
         *
         * @param {Object} item
         */
        validate(item) {
            return this.$swal.confirm({ title: 'Validation', message: 'Validation de la campagne de contrôle ' + item.reference, icon: 'success' }).then(response => {
                if (response.isConfirmed) {
                    return this.$api.put('campaigns/' + item.id + '/validate').then(() => this.refresh += 1)
                }
                return response
            }).catch(error => {
                this.$swal.alert_error(error)
            })
        },
        /**
         * Supprime une campagne de contrôle
         *
         * @param {Object} item
         */
        destroy(e) {
            return this.$swal.confirm_destroy().then(response => {
                e.element.classList.add('is-loading')
                e.element.disabled = true
                if (response.isConfirmed) {
                    return this.$api.delete('campaigns/' + e.item.id).then(() => {
                        this.refresh += 1
                        e.element.classList.remove('is-loading')
                        e.element.disabled = false
                    })
                } else {
                    e.element.classList.remove('is-loading')
                    e.element.disabled = false
                }
                return response
            }).catch(error => {
                return error
            })
        },
    }
}
</script>
