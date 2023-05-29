<template>
    <div v-if="can('view_control_campaign')">
        <div class="d-flex justify-between align-center">
            <div class="w-100 d-flex justify-end align-center">
                <router-link v-if="can('create_control_campaign')" class="btn btn-info" :to="{ name: 'campaigns-create' }">
                    Ajouter
                </router-link>
            </div>
        </div>
        <ContentBody>
            <NLDatatable :columns="columns" :actions="actions" :filters="filters" title="Suivi du planning annuel"
                urlPrefix="campaigns">
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
import ContentBody from '../../components/ContentBody'
import { hasRole } from '../../plugins/user'
import api from '../../plugins/api'
import NLDatatable from '../../components/Datatable/NLDatatable'
export default {
    components: {
        ContentBody, NLDatatable
    },
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            columns: [
                {
                    label: 'Référence',
                    field: 'reference',
                    sortable: true
                },
                {
                    label: 'Date début',
                    field: 'start',
                    sortable: true
                },
                {
                    label: 'Date fin',
                    field: 'end',
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
                }
            ],
            actions: {
                show: {
                    show: true,
                    apply: this.show
                },
                edit: {
                    show: (item) => {
                        return (this.can('edit_control_campaign') && item.remaining_days_before_start > 5) || !item.validated_by_id
                    },
                    apply: this.edit
                },
                delete: {
                    show: (item) => {
                        return (this.can('delete_control_campaign') && item.remaining_days_before_start > 5) || !item.validated_by_id
                    },
                    apply: this.destroy
                }
            },
            filters: {
                reference: {
                    label: 'Année',
                    data: this.yearsList,
                    value: null,
                },
                validated: {
                    label: 'Etat',
                    hide: !hasRole([ 'dcp', 'cdcr' ]),
                    data: [
                        {
                            id: 0,
                            label: 'En attente de validation'
                        },
                        {
                            id: 1,
                            label: 'Validé'
                        }
                    ],
                    value: null
                },
                between: {
                    value: [],
                    type: 'date-range',
                    cols: 'col-lg-4',
                    attributes: {
                        start: {
                            cols: 'col-lg-6',
                            label: 'De',
                            value: null
                        },
                        end: {
                            cols: 'col-lg-6',
                            label: 'À',
                            value: null
                        }
                    }
                }
            },
        }
    },
    computed: {
        yearsList() {
            let start = 2023
            const currentYear = this.currentYear
            const years = []
            for (start; start <= currentYear; start++) {
                years.push({ id: start, label: start })
            }
            return years
        }
    },
    methods: {
        /**
         * Affiche une campagne de contrôle
         *
         * @param {Object} e
         */
        show(e) {
            return this.$router.push({ name: 'campaign', params: { campaignId: e.item.id } })
        },

        /**
         *
         * @param {Object} e
         */
        edit(e) {
            return this.$router.push({ name: 'campaigns-edit', params: { campaignId: e.item.id } })
        },
        /**
         * Valide une campagne de contrôle
         *
         * @param {Object} item
         */
        validate(item) {
            return this.$swal.confirm({ title: 'Validation', message: 'Validation de la campagne de contrôle ' + item.reference, icon: 'success' }).then(response => {
                if (response.isConfirmed) {
                    return api.put('campaigns/' + item.id + '/validate')
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
                if (response.isConfirmed) {
                    return api.delete('campaigns/' + e.item.id)
                }
                return response
            }).catch(error => {
                return error
            })
        },
    }
}
</script>
