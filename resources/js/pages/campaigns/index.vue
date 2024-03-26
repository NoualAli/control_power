<template>
    <ContentBody v-if="can('view_control_campaign')">
        <NLDatatable :refresh="refresh" :columns="columns" :actions="actions" :filters="filters"
            title="Suivi du planning annuel" urlPrefix="agency_level/campaigns"
            @dataLoaded="() => this.$store.dispatch('settings/updatePageLoading', false)">
            <template #actions-before="{ item, callback }">
                <NLButton :loading="currentValidationBtnIsLoading == item.id" loadingLabel=""
                    v-if="!item?.validated_by_id && can('validate_control_campaign')" class="btn btn-info has-icon"
                    @click.stop="callback(validate, item)">
                    <NLIcon name="check" />
                </NLButton>
            </template>

            <template #table-actions>
                <router-link v-if="can('create_control_campaign')" class="btn has-icon"
                    :to="{ name: 'campaigns-create' }">
                    <NLIcon name="add" />
                    Ajouter
                </router-link>
                <NLButton class="has-icon" @click="refresh += 1">
                    <NLIcon name="sync" />
                </NLButton>
            </template>
        </NLDatatable>
        <NLFlex lgJustifyContent="end" lgAlignItems="center" mdJustifyContent="end" mdAlignItems="center"
            v-if="!is(['da', 'cder', 'ci'])">
            <p class="text-italic">* Pourcentage des agences couvertes par rapport au total des missions réalisées</p>
        </NLFlex>
    </ContentBody>
</template>

<script>
import { hasRole } from '../../plugins/user'
export default {
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            refresh: 0,
            yearsList: [],
            currentValidationBtnIsLoading: null,
            currentDestroyBtnIsLoading: null,
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
                    label: 'Créateur',
                    field: 'creator_full_name',
                    sortable: true,
                    hide: !hasRole([ 'dcp', 'cdcr' ])
                },
                {
                    label: 'Validateur',
                    field: 'validator_full_name',
                    sortable: true,
                    hide: !hasRole([ 'dcp', 'cdcr' ])
                },
                {
                    label: 'Missions planifiées',
                    field: 'total_missions',
                    align: 'center',
                    sortable: true,
                    hide: hasRole([ 'cdc', 'dre', 'ci', 'da', 'cder', 'ir' ]),
                    methods: {
                        showField(item) {
                            return item?.validated_by_id ? item?.total_missions : '-'
                        }
                    }
                },
                {
                    label: 'Missions réalisées',
                    field: 'total_missions_validated',
                    align: 'center',
                    sortable: true,
                    hide: hasRole([ 'cdc', 'dre', 'ci', 'da', 'cder', 'ir' ]),
                    methods: {
                        showField(item) {
                            return item?.validated_by_id ? item?.total_missions_validated : '-'
                        }
                    }
                },
                {
                    label: 'Missions planifiées',
                    field: 'total_missions_dre',
                    align: 'center',
                    sortable: true,
                    hide: !hasRole([ 'cdc', 'dre', 'ir' ])
                },
                {
                    label: 'Missions réalisées',
                    field: 'total_missions_validated_dre',
                    align: 'center',
                    sortable: true,
                    hide: !hasRole([ 'cdc', 'dre', 'ir' ])
                },
                {
                    label: '* couverture %',
                    field: 'realisation_rate_dre',
                    align: 'center',
                    sortable: true,
                    hide: !hasRole([ 'cdc', 'dre', 'ir' ]),
                    methods: {
                        showField(item) {
                            return parseFloat(item?.realisation_rate_dre).toFixed(2) + '%'
                        }
                    }
                },
                {
                    label: '* Couverture %',
                    field: 'realisation_rate',
                    align: 'center',
                    sortable: true,
                    hide: hasRole([ 'cdc', 'dre', 'ci', 'da', 'cder', 'ir' ]),
                    methods: {
                        showField(item) {
                            if (item?.validated_by_id) {
                                return parseFloat(item?.realisation_rate).toFixed(2) + '%'
                            } else {
                                return '-'
                            }
                        }
                    }
                },
                {
                    label: 'Etat',
                    field: 'validator_full_name',
                    // align: 'center',
                    hide: !hasRole([ 'dcp', 'cdcr' ]),
                    isHtml: true,
                    methods: {
                        showField(item) {
                            if (item.validated_by_id) {
                                return `<div class="tags is-centered"><span class="tag is-centered w-auto is-success" title="Validée">Validée</span></div>`
                            } else {
                                return `<div class="tags is-centered"><span class="tag is-centered w-auto is-warning" title="En attente">En attente</span></div>`
                            }
                        },
                    }
                },
            ],
            actions: {
                show: {
                    show: true,
                    apply: this.show
                },
                edit: {
                    show: (item) => {
                        return this.can('edit_control_campaign') && !Boolean(Number(item.is_validated))
                    },
                    apply: this.edit
                },
                delete: {
                    show: (item) => {
                        if (this.is('dcp')) {
                            return !Boolean(Number(item.is_validated))
                        } else {
                            return !Boolean(Number(item.is_validated)) && item.created_by_id == this.user().id
                        }
                    },
                    apply: this.destroy
                }
            },
            filters: {
                validated: {
                    label: 'Etat',
                    hide: !hasRole([ 'dcp', 'cdcr', 'root', 'admin' ]),
                    data: [
                        {
                            id: "En attente",
                            label: 'En attente'
                        },
                        {
                            id: "Validée",
                            label: 'Validée'
                        }
                    ],
                    value: null
                },
                // test: {
                //     label: 'Test',
                //     hide: !hasRole([ 'dcp', 'cdcr', 'root', 'admin' ]),
                //     data: [
                //         {
                //             id: "Non",
                //             label: 'Non'
                //         },
                //         {
                //             id: "Oui",
                //             label: 'Oui'
                //         }
                //     ],
                //     value: null
                // },
                start: {
                    type: 'date',
                    label: 'Début',
                    value: null
                },
                end: {
                    type: 'date',
                    label: 'Fin',
                    value: null
                },
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
            const campaignId = e.item.id
            window.open(this.$router.resolve({ name: 'campaign', params: { campaignId } }).href, '_blank')
        },

        /**
         *
         * @param {Object} e
         */
        edit(e) {
            const campaignId = e.item.id
            window.open(this.$router.resolve({ name: 'campaigns-edit', params: { campaignId } }).href, '_blank')
        },
        /**
         * Valide une campagne de contrôle
         *
         * @param {Object} item
         */
        validate(item) {
            return this.$swal.confirm({ title: 'Validation', message: 'Validation de la campagne de contrôle ' + item.reference, icon: 'success' }).then(action => {
                if (action.isConfirmed) {
                    this.currentValidationBtnIsLoading = item.id
                    return this.$api.put('campaigns/' + item.id + '/validate').then((response) => {
                        this.refresh += 1
                        this.currentValidationBtnIsLoading = null
                        this.$swal.toast_success(response?.data?.message)
                    }).catch(error => {
                        this.currentValidationBtnIsLoading = null
                        this.$swal.catchError(error, false)
                    })
                }
                this.currentValidationBtnIsLoading = null
                return response
            }).catch(error => {
                this.currentValidationBtnIsLoading = null
                this.$swal.catchError(error, false)
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
                    return this.$api.delete('campaigns/' + e.item.id).then(() => {
                        this.refresh += 1
                        this.$swal.toast_success(response?.data?.message)
                    }).catch(error => {
                        this.$swal.catchError(error)
                    })
                }
                return response
            }).catch(error => {
                this.$swal.catchError(error)
            })
        },
    }
}
</script>
