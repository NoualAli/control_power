<template>
    <ContentHeader v-if="can('view_control_campaign')">
        <template #title>
            Informations de la campagne de contrôle
        </template>
        <template #actions>
            <router-link v-if="can('view_mission')"
                :to="{ name: 'campaign-missions', params: { campaignId: campaign?.current?.id } }" class="btn">
                Missions
            </router-link>
            <router-link
                v-if="(campaign?.current?.remaining_days_before_start > 5 && can('edit_control_campaign')) && !campaign?.current.is_validated"
                class="btn btn-warning" :to="{ name: 'campaigns-edit', params: { campaignId: campaign?.current?.id } }">
                <i class="las la-edit icon" />
            </router-link>
            <button
                v-if="(campaign?.current?.remaining_days_before_start > 5 && can('delete_control_campaign')) && !campaign?.current.is_validated"
                class="btn btn-danger has-icon" @click.stop="destroy" :loading="destroyInProgress" label="Supprimer">
                <i class="las la-trash icon" />
            </button>
            <NLButton v-if="!campaign?.current?.validated_by_id && can('validate_control_campaign')" class="btn btn-info"
                @click.stop="validate(campaign?.current)" :loading="validationInProgress" label="Valider">
                <i class="las la-check icon has-icon" />
            </NLButton>
        </template>
    </ContentHeader>
    <ContentBody v-if="can('view_control_campaign')">
        <!-- Control campaign informations -->
        <div class="box mb-10">
            <NLGrid class="grid gap-12">
                <NLColumn lg="4">
                    <span class="text-bold">
                        Référence:
                    </span>
                    <span>
                        {{ reference }}
                    </span>
                </NLColumn>
                <NLColumn v-if="is('cdcr,dcp')" lg="4">
                    <span class="text-bold">
                        Etat:
                    </span>
                    <span>
                        {{ state }}
                    </span>
                </NLColumn>
                <NLColumn lg="4">
                    <NLGrid class="grid">
                        <NLColumn>
                            <NLGrid>
                                <NLColumn lg="6">
                                    <span class="text-bold">
                                        Début:
                                    </span>
                                    <span>
                                        {{ start }}
                                    </span>
                                </NLColumn>
                                <NLColumn lg="6">
                                    <span class="text-bold">
                                        Fin:
                                    </span>
                                    <span>
                                        {{ end }}
                                    </span>
                                </NLColumn>
                            </NLGrid>
                        </NLColumn>
                    </NLGrid>
                </NLColumn>
                <NLColumn lg="12">
                    <NLGrid>
                        <NLColumn lg="4">
                            <span class="text-bold">
                                Total missions:
                            </span>
                            <span>
                                {{ totalMissions }}
                            </span>
                        </NLColumn>

                        <NLColumn lg="4">
                            <span class="text-bold">
                                Total validées:
                            </span>
                            <span>
                                {{ totalValidatedMissionsWithPercent }}
                            </span>
                        </NLColumn>
                    </NLGrid>
                </NLColumn>
                <NLColumn>
                    <span class="text-bold">
                        Description:
                    </span>
                    <br>
                    <div v-if="campaign?.current?.description !== '-'" class="mt-2 content text-normal"
                        v-html="campaign?.current?.description" />
                    <span v-else />
                </NLColumn>
            </NLGrid>
        </div>
        <div class="d-flex align-items gap-2" v-if="isDcp && totalMissions == totalValidatedMissions">
            <a :href="'/excel-export?export=synthesis' + campaign?.current?.id" target="_blank"
                class="btn btn-excel has-icon">
                <i class="las la-file-excel icon" />
                Exporter la synthèse
            </a>
        </div>
        <!-- Processes List -->
        <NLDatatable :key="renderKey" v-if="campaign?.current?.id" :columns="columns" :details="details"
            title="Liste des processus" :urlPrefix="'campaigns/processes/' + campaign?.current?.id"
            detailsUrlPrefix="processes" @dataLoaded="() => this.$store.dispatch('settings/updatePageLoading', false)">
            <template #actions-before="{ item, callback }"
                v-if="can('edit_control_campaign') && !campaign?.current.validated_by_id && is(['dcp'])">
                <button class="btn btn-danger has-icon" @click.stop="callback(detachProcess, item)">
                    <i class="las la-unlink icon" />
                </button>
            </template>
        </NLDatatable>
    </ContentBody>
</template>

<script>
import { mapGetters } from 'vuex'
import api from '../../plugins/api'
import { hasRole } from '../../plugins/user'
export default {
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            renderKey: 0,
            validationInProgress: false,
            columns: [
                {
                    label: 'Famille',
                    field: 'family_name'
                },
                {
                    label: 'Domaine',
                    field: 'domain_name'
                },
                {
                    label: 'Processus',
                    field: 'name'
                },
                {
                    label: 'Total points de contrôle',
                    field: 'control_points_count'
                }
            ],
            details: [
                {
                    label: 'Points de contrôle',
                    field: 'control_points.name',
                    hasMany: true
                }
            ],
            // filters: {
            //     family: {
            //         label: 'Famille',
            //         name: 'family',
            //         multiple: true,
            //         data: null,
            //         value: null
            //     },
            //     domain: {
            //         label: 'Domaine',
            //         name: 'domain',
            //         multiple: true,
            //         data: null,
            //         value: null,
            //         dependsOn: 'family'
            //     },
            // },
            isDcp: null,
        }
    },
    computed: {
        ...mapGetters({
            campaign: 'campaigns/current'
        }),
        reference() {
            return this.campaign?.current?.reference
        },
        state() {
            return this.campaign?.current?.is_validated ? 'Validé' : 'En attente de validation'
        },
        start() {
            let startDate = this.campaign?.current?.start_date
            let remainingDaysBeforeStart = Math.abs(this.campaign?.current?.remaining_days_before_start)
            let sufix = ''

            if (remainingDaysBeforeStart == 1) {
                sufix = ' / ' + remainingDaysBeforeStart + ' jour'
            } else if (remainingDaysBeforeStart > 1) {
                sufix = ' / ' + remainingDaysBeforeStart + ' jours'
            } else if (remainingDaysBeforeStart == 0) {
                sufix = ' / Aujourd\'hui'
            }

            return startDate + sufix
        },

        end() {
            let endDate = this.campaign?.current?.end_date
            let remainingDaysBeforeEnd = this.campaign?.current?.remaining_days_before_end
            let sufix = ''
            if (remainingDaysBeforeEnd == 1) {
                sufix = ' / ' + remainingDaysBeforeEnd + ' jour'
            } else if (remainingDaysBeforeEnd > 1) {
                sufix = ' / ' + remainingDaysBeforeEnd + ' jours'
            } else if (remainingDaysBeforeEnd == 0) {
                sufix = ' / Aujourd\'hui'
            }

            return endDate + sufix
        },

        totalMissions() {
            return this.campaign?.current?.total_missions
        },

        totalValidatedMissions() {
            return this.campaign?.current?.total_mission_validated
        },

        totalValidatedMissionsWithPercent() {
            let totalValidatedMissions = this.campaign?.current?.total_mission_validated
            let totalMissions = this.campaign?.current?.total_missions
            let percent = ((100 * totalValidatedMissions) / totalMissions).toFixed(2)
            return totalValidatedMissions > 0 ? totalValidatedMissions + ' (' + percent + '%)' : '0%'
        }
    },

    created() {
        this.initData()
    },
    methods: {
        initData() {
            this.$store.dispatch('settings/updatePageLoading', true)
            this.isDcp = hasRole('dcp')
            this.close()
            const campaignId = this.$route.params.campaignId
            this.$store.dispatch('campaigns/fetch', { campaignId }).then(() => {
                const length = this.$breadcrumbs.value.length
                if (this.$breadcrumbs.value[ length - 1 ].label === 'Détails campagne') {
                    this.$breadcrumbs.value[ length - 1 ].label = 'Détails campagne ' + this.campaign.current?.reference
                }
                this.renderKey += 1
                // this.$store.dispatch('settings/updatePageLoading', false)
            })
        },
        loadControlPoints(process) {
            this.$store.dispatch('processes/fetch', { id: process.id, onlyControlPoints: true }).then(() => { this.control_points = this.process.controlPoints })
        },
        /**
         * Valide une campagne de contrôle
         *
         * @param {Object} item
         */
        validate(item) {
            this.$swal.confirm({ title: 'Validation', message: 'Validation de la campagne de contrôle ' + item.reference, icon: 'success' }).then(response => {
                if (response.isConfirmed) {
                    this.validationInProgress = true
                    api.put('campaigns/' + item.id + '/validate').then(response => {
                        if (response.data.status) {
                            this.initData()
                            this.$store.dispatch('settings/updatePageLoading', false)
                            this.$swal.toast_success(response.data.message)
                            this.validationInProgress = false
                        } else {
                            this.$swal.toast_error(response.data.message)
                            this.validationInProgress = false
                        }
                    })
                }
            }).catch(error => {
                this.$swal.alert_error(error)
                this.validationInProgress = false
            })
        },

        /**
         * Delete campaign
         */
        destroy(e) {
            this.destroyInProgress = true
            this.$swal.confirm_destroy().then((action) => {
                if (action.isConfirmed) {
                    api.delete('campaigns/' + this.campaign?.current?.id).then(response => {
                        if (response.data.status) {
                            this.$swal.toast_success(response.data.message)
                            this.$router.push({ name: 'campaigns' })
                            this.destroyInProgress = false
                        } else {
                            this.$swal.alert_error(response.data.message)
                            this.destroyInProgress = false
                        }
                    }).catch(error => {
                        console.log(error)
                        this.destroyInProgress = false
                    })
                }
            })
        },

        /**
         * Detach specific process from campaign
         *
         * @param {Object} process
         */
        detachProcess(item) {
            return this.$swal.confirm_destroy().then((action) => {
                if (action.isConfirmed) {
                    return api.delete('campaigns/' + this.campaign?.current?.id + '/process/' + item.id)
                }
            })
        },
        show(item) {
            this.rowSelected = item
            this.loadControlPoints(item)
        },
        close() {
            this.rowSelected = null
        }
    }
}
</script>
