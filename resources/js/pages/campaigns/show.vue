<template>
    <ContentHeader v-if="can('view_control_campaign')">
        <template #title>
            Informations de la campagne de contrôle
        </template>
        <template #actions>
            <router-link v-if="can('view_mission')"
                :to="{ name: 'campaign-missions', params: { campaignId: campaign?.current?.id } }" class="btn has-icon">
                <i class="las la-eye icon"></i>
                Missions
            </router-link>
            <router-link v-if="can('view_mission')"
                :to="{ name: 'campaign-statistics', params: { campaignId: campaign?.current?.id } }" class="btn has-icon">
                <i class="las la-chart-bar icon"></i>
                Statistiques
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
                <NLColumn lg="12">
                    <NLGrid>
                        <NLColumn lg="4">
                            <span class="text-bold">
                                Crée par:
                            </span>
                            <span>
                                {{ campaign?.current?.creator_full_name }}
                            </span>
                        </NLColumn>

                        <NLColumn lg="4">
                            <span class="text-bold">
                                Validée par:
                            </span>
                            <span>
                                {{ campaign?.current?.validator_full_name }}
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
        <NLFlex lgJustifyContent="start" gap="2" v-if="is('root')">
            <NLButton v-if="totalMissions" class="btn btn-pdf has-icon" @click.prevent="generateReports(true)"
                label="Regénérer tous les rapports" :loading="reGenerateReportsIsLoading">
                <i class="las la-file-pdf icon" />
            </NLButton>
            <NLButton v-if="totalMissions" class="btn btn-pdf has-icon" @click.prevent="generateReports(false)"
                label="Regénérer les rapports manquants" :loading="generateMissingReportsIsLoading">
                <i class="las la-file-pdf icon" />
            </NLButton>
        </NLFlex>

        <NLFlex lgJustifyContent="start" gap="2"
            v-if="canExportSynthesis && totalMissions == totalValidatedMissions && totalMissions > 0 && totalValidatedMissions > 0 && !is('root')">
            <!-- Download files -->
            <button v-if="!is(['ci', 'da', 'cc', 'admin'])" class="btn btn-info has-icon" @click="downloadZip()">
                <i class="las la-file-archive icon" />
                Pièces jointes
            </button>
            <NLButton v-if="totalMissions && is(['dcp', 'cdcr'])" class="btn btn-pdf has-icon"
                @click.prevent="generateReports" label="Regénérer les rapports manquants"
                :loading="reGenerateReportsIsLoading">
                <i class="las la-file-pdf icon" />
            </NLButton>

            <a :href="'/excel-export?export=synthesis&campaign=' + campaign?.current?.id" target="_blank"
                class="btn btn-office-excel has-icon">
                <i class="las la-file-excel icon" />
                Récapitulatif des notations
            </a>
            <a :href="'/excel-export?export=synthesis_reports&campaign=' + campaign?.current?.id" target="_blank"
                class="btn btn-office-excel has-icon">
                <i class="las la-file-excel icon" />
                Récapitulatif des constats
            </a>
        </NLFlex>
        <!-- Processes List -->
        <NLDatatable :refresh="refresh" v-if="campaign?.current?.id" :columns="columns" :details="details"
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
            generateMissingReportsIsLoading: false,
            reGenerateReportsIsLoading: false,
            refresh: 0,
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
            canExportSynthesis: null,
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
        /**
         * Export or Preview report
         */
        generateReports(forceAll = false) {
            let confirmTitle = forceAll ? 'Voulez-vous vraiment regénérer tous les rapports <b>existants / manquant</b> de la campagne de contrôle <b>' + this.campaign?.current?.reference + '</b>' : 'Voulez-vous vraiment générer tous les rapports manquants de la campagne de contrôle <b>' + this.campaign?.current?.reference + '</b>'
            this.$swal.confirm_update(confirmTitle).then(action => {
                if (action.isConfirmed) {
                    let url = 'campaigns/' + this.campaign?.current?.id + '/reports?action=generate&all=0';
                    let successMessage = 'La génération des rapports des missions de la campagne de contrôle ' + this.campaign?.current?.reference + ' est en cours, vous recevrez une notification une fois la génération terminer.'
                    let errorMessage = 'On s\'excuse il y\'a eu un problème avec la fonction de génération des rapports concernant la campagne de contrôle ' + this.campaign?.current?.reference + ', veuilez réessayer plus tard, si le proboème perssiste veuillez contacter votre développeur.'
                    let title = 'Génération des rapports PDF'
                    if (forceAll) {
                        this.reGenerateReportsIsLoading = true
                        url = 'campaigns/' + this.campaign?.current?.id + '/reports?action=generate&all=1';
                        successMessage = 'La re-génération des rapports des missions de la campagne de contrôle ' + this.campaign?.current?.reference + ' est en cours, vous recevrez une notification une fois la génération terminer.'
                        errorMessage = 'On s\'excuse il y\'a eu un problème avec la fonction de re-génération des rapports concernant la campagne de contrôle ' + this.campaign?.current?.reference + ', veuilez réessayer plus tard, si le proboème perssiste veuillez contacter votre développeur.'
                        title = 'Re-génération des rapports PDF'
                    } else {
                        this.generateMissingReportsIsLoading = true
                    }
                    this.$api.post(url).then((response) => {
                        if (forceAll) {
                            this.reGenerateReportsIsLoading = false
                        } else {
                            this.generateMissingReportsIsLoading = false
                        }
                        if (response.data.status) {
                            this.$swal.alert_success(successMessage, title)
                        } else {
                            this.$swal.alert_success(errorMessage, title)
                        }
                    }).catch((error) => {
                        if (forceAll) {
                            this.reGenerateReportsIsLoading = false
                        } else {
                            this.generateMissingReportsIsLoading = false
                        }

                        this.$swal.catchError(error);
                    })
                }
            })
        },
        /**
         * Download mission's and detail's media
         *
         */
        downloadZip() {
            window.open('/zip/ControlCampaign/' + this.campaign?.current?.id)
        },
        initData() {
            this.$store.dispatch('settings/updatePageLoading', true)
            this.canExportSynthesis = hasRole([ 'dcp', 'cdcr' ])
            this.close()
            const campaignId = this.$route.params.campaignId
            this.$store.dispatch('campaigns/fetch', { campaignId }).then(() => {
                const length = this.$breadcrumbs.value.length
                if (this.$breadcrumbs.value[ length - 1 ].label === 'Détails campagne') {
                    this.$breadcrumbs.value[ length - 1 ].label = 'Détails campagne ' + this.campaign.current?.reference
                }
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
                            this.validationInProgress = false
                            this.$swal.toast_success(response.data.message)
                        } else {
                            this.validationInProgress = false
                            this.$swal.toast_error(response.data.message)
                        }
                    })
                }
            }).catch(error => {
                this.validationInProgress = false
                this.$swal.alert_error(error)
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
                    return api.delete('campaigns/' + this.campaign?.current?.id + '/process/' + item.id).then((response) => {
                        if (response?.data?.status) {
                            this.refresh += 1
                        }
                    })
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
