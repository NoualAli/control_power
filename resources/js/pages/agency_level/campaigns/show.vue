<template>
    <ContentHeader v-if="can('view_control_campaign')">
        <!-- <template #title>
            Informations de la campagne de contrôle
        </template> -->

        <template #left-actions>
            <NLColumn>
                <!-- Control campaign actions -->
                <NLFlex lgJustifyContent="start" gap="2" v-if="is('root') && campaign?.current?.is_validated">
                    <NLButton v-if="totalMissions" class="has-icon" @click.prevent="generateReports(true)"
                        label="Regénérer tous les rapports" :loading="reGenerateReportsIsLoading">
                        <!-- <i class="las la-file-pdf icon" /> -->
                        <NLIcon name="picture_as_pdf" />
                    </NLButton>
                    <NLButton v-if="totalMissions" class="has-icon" @click.prevent="generateReports(false)"
                        label="Regénérer les rapports manquants" :loading="generateMissingReportsIsLoading">
                        <NLIcon name="picture_as_pdf" />
                    </NLButton>
                </NLFlex>
                <NLFlex lgJustifyContent="start" gap="2"
                    v-if="Number(totalMissions) && Number(totalMissions) == Number(campaign?.current?.total_missions_validated_dre) && is(['dcp', 'cdcr', 'cdrcp', 'dg', 'dga', 'ig', 'sg', 'cdc'])">
                    <!-- Download files -->
                    <NLButton label="Pièces jointes" class="has-icon" @click="downloadZip()"
                        v-if="is(['cdrcp', 'dcp', 'cdcr']) && Number(totalMissions) == Number(totalValidatedMissions)">
                        <NLIcon name="folder_zip" />
                    </NLButton>
                    <NLButton v-if="Number(totalMissions) == Number(totalValidatedMissions) && is(['dcp', 'cdcr'])"
                        class="has-icon" @click.prevent="generateReports" label="Regénérer les rapports manquants"
                        :loading="reGenerateReportsIsLoading">
                        <NLIcon name="picture_as_pdf" />
                    </NLButton>
                    <NLButton
                        v-if="Number(totalMissions) == Number(totalValidatedMissions) && (is(['dcp', 'cdcr']) || (is(['cdrcp', 'dg', 'dga', 'ig', 'sg']) && campaign?.current?.synthesis?.length))"
                        class="has-icon" @click.prevent="handleUploadSynthesisBox"
                        :label="campaign?.current?.synthesis.length || is(['cdrcp', 'dg', 'dga', 'ig', 'sg']) ? 'Synthèse' : 'Téléversement synthèse'">
                        <NLIcon name="cloud_upload" />
                    </NLButton>
                    <NLButton
                        v-if="is(['cdcr', 'dcp', 'cdrcp']) && Number(totalMissions) == Number(campaign?.current?.total_missions_validated_dre) && !campaign?.current?.summary_scores?.path"
                        class="has-icon" @click.prevent="exportSummary()" :loading="summaryScoresIsLoading"
                        label="Récapitulatif des notations">
                        <NLIcon name="table" />
                    </NLButton>
                    <a :href="'\\' + campaign?.current?.summary_scores?.path" target="_blank"
                        :download="campaign?.current?.summary_scores?.hash_name" class="btn has-icon"
                        v-else-if="campaign?.current?.summary_scores?.path && is(['dcp', 'cdcr', 'cdrcp'])">
                        <NLIcon name="table" />
                        Récapitulatif des notations
                    </a>
                    <NLButton
                        v-if="is(['cdcr', 'dcp', 'cdrcp']) && Number(totalMissions) == Number(totalValidatedMissions) && !campaign?.current?.summary_reports?.path"
                        class="has-icon" @click.prevent="exportSummary(true)" :loading="summaryReportsIsLoading"
                        label="Récapitulatif des constats">
                        <NLIcon name="table" />
                    </NLButton>
                    <a :href="'\\' + campaign?.current?.summary_reports?.path" target="_blank"
                        :download="campaign?.current?.summary_reports?.hash_name" class="btn has-icon"
                        v-else-if="campaign?.current?.summary_reports?.path && is(['dcp', 'cdcr', 'cdrcp'])">
                        <NLIcon name="table" />
                        Récapitulatif des constats
                    </a>
                </NLFlex>
            </NLColumn>
        </template>

        <template #right-actions>
            <router-link v-if="can('view_mission') && Boolean(Number(campaign?.current?.is_validated))"
                :to="{ name: 'campaign-missions', params: { campaignId: campaign?.current?.id } }" class="btn has-icon">
                <!-- <i class="las la-eye icon"></i> -->
                <NLIcon name="visibility" />
                Missions
            </router-link>
            <router-link v-if="can('view_mission') && Boolean(Number(campaign?.current?.is_validated))"
                :to="{ name: 'campaign-statistics', params: { campaignId: campaign?.current?.id } }"
                class="btn has-icon">
                <NLIcon name="pie_chart" />
                <!-- <i class="las la-chart-bar icon"></i> -->
                Statistiques
            </router-link>
            <router-link v-if="(!Boolean(Number(campaign?.current?.is_validated)) && can('edit_control_campaign'))"
                class="btn btn-warning has-icon"
                :to="{ name: 'campaigns-edit', params: { campaignId: campaign?.current?.id } }">
                <NLIcon name="edit" />
                Modifier
            </router-link>
            <NLButton
                v-if="!Boolean(Number(campaign?.current?.is_validated)) && (user().id == campaign?.current?.created_by_id || is('dcp'))"
                class="btn btn-danger has-icon" @click.stop="destroy" :loading="destroyInProgress" label="Supprimer">
                <NLIcon name="delete" />
            </NLButton>
            <NLButton v-if="!campaign?.current?.validated_by_id && can('validate_control_campaign')"
                class="btn btn-info has-icon" @click.stop="validate(campaign?.current)" :loading="validationInProgress"
                label="Valider">
                <NLIcon name="check" />
            </NLButton>
            <NLButton @click.stop="() => initData()" class="btn has-icon">
                <NLIcon name="sync" />
            </NLButton>
        </template>
    </ContentHeader>

    <ContentBody v-if="can('view_control_campaign')">
        <NLGrid gap="6">
            <NLColumn>
                <NLGrid extraClass="box">
                    <NLColumn lg="4">
                        <span class="text-bold">
                            Référence:
                        </span>
                        <span>
                            {{ reference }}
                        </span>
                    </NLColumn>
                    <NLColumn v-if="is('cdcr,dcp,admin,root')" lg="4">
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
                    <NLColumn lg="12" v-if="Boolean(Number(campaign?.current?.is_validated))">
                        <NLGrid>
                            <NLColumn lg="4" v-if="!is(['da', 'cder', 'ci'])">
                                <span class="text-bold">
                                    Total missions:
                                </span>
                                <span>
                                    {{ totalMissions }}
                                </span>
                            </NLColumn>

                            <NLColumn lg="4" v-if="!is(['da', 'cder', 'ci'])">
                                <span class="text-bold">
                                    Total validées:
                                </span>
                                <span>
                                    {{ totalValidatedMissionsWithPercent }}
                                </span>
                            </NLColumn>

                            <NLColumn lg="4" v-if="!is(['da', 'cder', 'ci'])">
                                <span class="text-bold">
                                    Taux de couverture:
                                </span>
                                <span>
                                    {{ realisationRate }}
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
                                    {{ campaign?.current?.validator_full_name || '-' }}
                                </span>
                            </NLColumn>
                        </NLGrid>
                    </NLColumn>
                    <NLColumn>
                        <span class="text-bold">
                            Description:
                        </span>
                        <br>
                        <NLReadMore :value="campaign?.current?.description" maxDisplayLength="250"></NLReadMore>
                    </NLColumn>
                </NLGrid>
            </NLColumn>

            <NLColumn v-if="is(['dcp', 'cdcr', 'cdrcp', 'dg', 'dga', 'ig', 'sg']) && showUploadSynthesisBox">
                <NLGrid extraClass="box">
                    <NLColumn>
                        <NLFile @uploaded="handleMedia" @deleted="handleMedia" @loaded="handleMedia"
                            v-model="form.synthesis" :name="'media'" label="Synthèse"
                            attachable-type="App\Models\ControlCampaign" folder="Synthèses"
                            :attachable-id="campaign?.current?.id" :form="form" multiple
                            :readonly="is(['cdrcp', 'dg', 'dga', 'ig', 'sg'])" />
                    </NLColumn>
                </NLGrid>
            </NLColumn>
            <NLColumn>
                <!-- Processes List -->
                <NLDatatable :refresh="refresh" v-if="campaign?.current?.id" :columns="columns" :details="details"
                    :urlPrefix="'agency_level/campaigns/processes/' + campaign?.current?.id"
                    :detailsUrlPrefix="'agency_level/campaigns/processes/' + campaign?.current?.id"
                    @dataLoaded="() => this.$store.dispatch('settings/updatePageLoading', false)">

                    <template #actions-before="{ item, callback }"
                        v-if="can('edit_control_campaign') && !campaign?.current?.validated_by_id && (user().id == campaign?.current?.created_by_id || is('dcp'))">
                        <button class="btn btn-danger has-icon" @click.stop="callback(detachProcess, item)">
                            <i class="las la-unlink icon" />
                        </button>
                    </template>

                    <template #table-actions>
                        <NLButton @click.stop="refresh += 1" class="btn has-icon">
                            <NLIcon name="sync" />
                        </NLButton>
                    </template>
                </NLDatatable>
            </NLColumn>
        </NLGrid>
    </ContentBody>
</template>

<script>
import { mapGetters } from 'vuex'
import { hasRole } from '~/plugins/user'
import NLReadMore from '~/components/NLReadMore'
import axios from 'axios'
import { Form } from 'vform'
export default {
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    components: { NLReadMore },
    data() {
        return {
            destroyInProgress: false,
            generateMissingReportsIsLoading: false,
            reGenerateReportsIsLoading: false,
            summaryScoresIsLoading: false,
            summaryReportsIsLoading: false,
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
                    field: 'activated_control_points_count'
                }
            ],
            details: [
                {
                    label: 'Points de contrôle',
                    field: 'control_points.name',
                    hasMany: true
                }
            ],
            form: new Form({
                synthesis: [],
            }),
            canExportSynthesis: null,
            showUploadSynthesisBox: false,
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
            return Boolean(Number(this.campaign?.current?.is_validated)) ? 'Validé' : 'En attente de validation'
        },
        start() {
            let startDate = this.campaign?.current?.start_date
            let remainingDaysBeforeStart = this.campaign?.current?.remaining_days_before_start
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
            return hasRole([ 'dre', 'cdc', 'ci', 'ir' ]) ? this.campaign?.current?.total_missions_dre : this.campaign?.current?.total_missions
        },

        totalValidatedMissions() {
            return hasRole([ 'dre', 'cdc', 'ci', 'ir' ]) ? this.campaign?.current?.total_missions_validated_dre : this.campaign?.current?.total_missions_validated
        },

        realisationRate() {
            let rate = 0.00
            if (hasRole([ 'dre', 'cdc', 'ci', 'ir' ])) {
                rate = this.campaign?.current?.realisation_rate_dre
            } else {
                rate = this.campaign?.current?.realisation_rate
            }

            if (this.totalMissions) {
                return Number(rate).toFixed(2) + '%'
            }
            return '-'
        },

        totalValidatedMissionsWithPercent() {
            let totalValidatedMissions = this.totalValidatedMissions
            let totalMissions = this.totalMissions
            let percent = ((100 * totalValidatedMissions) / totalMissions).toFixed(2)
            return totalValidatedMissions > 0 ? totalValidatedMissions + ' (' + percent + '%)' : '0%'
        }
    },

    created() {
        this.initData()
    },
    methods: {
        handleMedia(files) {
            this.form.synthesis = files
        },
        handleUploadSynthesisBox() {
            this.showUploadSynthesisBox = !this.showUploadSynthesisBox
        },
        exportSummary(withReports) {
            let url = '/excel-export?'
            if (withReports) {
                this.summaryReportsIsLoading = true
                url += 'export=synthesis_reports'
            } else {
                this.summaryScoresIsLoading = true
                url += 'export=synthesis'
            }

            url += '&campaign=' + this.campaign?.current?.id

            axios.get(url).then(response => {
                let title = withReports ? "Génération du récapitulatif des constats" : "Génération du récapitulatif des notations"
                if (response.data.status) {
                    this.$swal.alert_success(response.data.message, title)
                } else {
                    this.$swal.alert_error(response.data.message, title)
                }
                if (withReports) {
                    this.summaryReportsIsLoading = false
                } else {
                    this.summaryScoresIsLoading = false
                }
            }).catch(error => {
                if (withReports) {
                    this.summaryReportsIsLoading = false
                } else {
                    this.summaryScoresIsLoading = false
                }
                this.$swal.catchError(error)
            })
        },
        /**
         * Export or Preview report
         */
        generateReports(forceAll = false) {
            let confirmTitle = forceAll ? 'Êtes-vous sûr de vouloir regénérer tous les rapports <b>existants / manquant</b> de la campagne de contrôle <b>' + this.campaign?.current?.reference + '</b>' : 'Êtes-vous sûr de vouloir générer tous les rapports manquants de la campagne de contrôle <b>' + this.campaign?.current?.reference + '</b>'
            this.$swal.confirm_update(confirmTitle).then(action => {
                if (action.isConfirmed) {
                    let url = 'agency_level/campaigns/' + this.campaign?.current?.id + '/reports?action=generate&all=0';
                    let successMessage = 'La génération des rapports des missions de la campagne de contrôle ' + this.campaign?.current?.reference + ' est en cours, vous recevrez une notification une fois la génération terminer.'
                    let errorMessage = 'On s\'excuse il y\'a eu un problème avec la fonction de génération des rapports concernant la campagne de contrôle ' + this.campaign?.current?.reference + ', veuilez réessayer plus tard, si le proboème perssiste veuillez contacter votre développeur.'
                    let title = 'Génération des rapports PDF'
                    if (forceAll) {
                        this.reGenerateReportsIsLoading = true
                        url = 'agency_level/campaigns/' + this.campaign?.current?.id + '/reports?action=generate&all=1';
                        successMessage = 'La re-génération des rapports des missions de la campagne de contrôle ' + this.campaign?.current?.reference + ' est en cours, vous recevrez une notification une fois la génération terminer.'
                        errorMessage = 'On s\'excuse il y\'a eu un problème avec la fonction de re-génération des rapports concernant la campagne de contrôle ' + this.campaign?.current?.reference + ', veuilez réessayer plus tard, si le proboème perssiste veuillez contacter votre développeur.'
                        title = 'Re-génération des rapports PDF'
                    } else {
                        this.generateMissingReportsIsLoading = true
                    }
                    this.$alapi.post(url).then((response) => {
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
                this.form.synthesis = Object.assign({}, this.campaign?.current?.synthesis?.map((file) => file.id))
                const length = this.$breadcrumbs.value.length
                if (this.$breadcrumbs.value[ length - 1 ].label === 'Détails campagne') {
                    this.$breadcrumbs.value[ length - 1 ].label = 'Détails campagne ' + this.campaign.current?.reference
                }
                this.$store.dispatch('settings/updatePageLoading', false)
            }).catch(error => {
                this.$swal.catchError(error)
                this.$store.dispatch('settings/updatePageLoading', false)
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
                    this.$alapi.put('campaigns/' + item.id + '/validate').then(response => {
                        if (response.data.status) {
                            this.initData()
                            this.$store.dispatch('settings/updatePageLoading', false)
                            this.$swal.toast_success(response.data.message)
                        } else {
                            this.$swal.toast_error(response.data.message)
                        }
                        this.validationInProgress = false
                    }).catch(error => {
                        this.validationInProgress = false
                        this.$swal.catchError(error)
                    })
                }
            })
        },

        /**
         * Delete campaign
         */
        destroy(e) {
            this.$swal.confirm_destroy().then((action) => {
                if (action.isConfirmed) {
                    this.destroyInProgress = true
                    this.$alapi.delete('campaigns/' + this.campaign?.current?.id).then(response => {
                        if (response.data.status) {
                            this.$swal.toast_success(response.data.message)
                            this.$router.push({ name: 'campaigns' })
                        } else {
                            this.$swal.alert_error(response.data.message)
                        }
                        this.destroyInProgress = false
                    }).catch(error => {
                        this.destroyInProgress = false
                        this.$swal.catchError(error)
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
                    return this.$alapi.delete('campaigns/' + this.campaign?.current?.id + '/process/' + item.id).then((response) => {
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
