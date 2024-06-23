<template>
    <NLModal :show="show" @close="close" :isLoading="isLoading">
        <template #title>
            <div class="tags">
                <NLTooltip type="bottom">
                    <template #content>
                        <b>Famille</b>
                        <p class="mt-2">{{ row?.name }}</p>
                    </template>
                    <span class="tag is-start text-normal">
                        <NLIcon name="tenancy" /> {{ str_slice(row?.name, 40) }}
                    </span>
                </NLTooltip>
            </div>
        </template>

        <template #default>
            <NLGrid gap="6">
                <NLColumn>
                    <h3>Informations de base</h3>
                </NLColumn>
                <NLColumn class="box">
                    <NLGrid>
                        <NLColumn>
                            <NLFlex alignItems="center" lgAlignItems="center" justifyContent="start"
                                lgJustifyContent="start" gap="2">
                                <b>Actif</b>
                                <NLIcon :extraClass="row?.is_active ? 'text-success' : 'text-danger'"
                                    :name="row?.is_active ? 'check_circle' : 'cancel'" />
                            </NLFlex>
                        </NLColumn>
                        <NLColumn lg="3"><b>Nombre de domaines</b></NLColumn>
                        <NLColumn lg="1">{{ row.domains_count }}</NLColumn>

                        <NLColumn lg="3"><b>Nombre de processus</b></NLColumn>
                        <NLColumn lg="1">{{ row.processes_count }}</NLColumn>

                        <NLColumn lg="3"><b>Nombre de points de contrôle</b></NLColumn>
                        <NLColumn lg="1">{{ row.control_points_count }}</NLColumn>

                        <NLColumn lg="3"><b>Créer par</b></NLColumn>
                        <NLColumn lg="3">{{ row.creator_full_name || '-' }}</NLColumn>

                        <NLColumn lg="3"><b>Date de création</b></NLColumn>
                        <NLColumn lg="3">{{ row.created_at || '-' }}</NLColumn>

                        <NLColumn lg="3"><b>Modifier par</b></NLColumn>
                        <NLColumn lg="3">{{ row.updater_full_name || '-' }}</NLColumn>

                        <NLColumn lg="3"><b>Date de modification</b></NLColumn>
                        <NLColumn lg="3">{{ row.updated_at || '-' }}</NLColumn>

                        <NLColumn class="divider" />

                        <NLColumn>
                            <h3>Chiffres clés</h3>
                        </NLColumn>

                        <NLColumn lg="6"><b>Nombre de campagne de contrôle</b></NLColumn>
                        <NLColumn lg="6">{{ row.control_campaigns_count }}</NLColumn>

                        <NLColumn lg="6"><b>Nombre de missions</b></NLColumn>
                        <NLColumn lg="6">{{ row.missions_count }}</NLColumn>

                        <NLColumn lg="6"><b>Nombre d'anomalies</b></NLColumn>
                        <NLColumn lg="6">{{ row.anomalies_count }}</NLColumn>

                        <NLColumn lg="6"><b>Nombre d'anomalies régularisées</b></NLColumn>
                        <NLColumn lg="6">{{ row.regularizations_count }}</NLColumn>

                        <NLColumn lg="6"><b>Taux de régularisation</b></NLColumn>
                        <NLColumn lg="6">{{ row.regularizations_rate }}%</NLColumn>
                    </NLGrid>
                </NLColumn>
                <NLColumn class="divider" v-if="Object.values(row.domains).length" />
                <NLColumn v-if="Object.values(row.domains).length">
                    <h3>Liste des domaines</h3>
                </NLColumn>
                <NLColumn v-for="(domain, index) in row.domains" :key="'d-' + domain.id"
                    v-if="Object.values(row.domains).length">
                    <NLFlex lgAlignItems="center" alignItems="center">
                        <h4>
                            {{ domain.name }}
                        </h4>
                        <NLFlex extraClass="is-clickable text-small" gap="2" lgAlignItems="center" alignItems="center"
                            @click.stop="toggleRows(domain.id)">
                            <NLIcon :name="!rows.includes(domain.id) ? 'visibility' : 'visibility_off'"
                                :extraClass="!rows.includes(domain.id) ? 'text-success' : 'text-danger'" />
                            <b v-if="!rows.includes(domain.id)">Voir plus</b>
                            <b v-else>Voir moins</b>
                        </NLFlex>
                    </NLFlex>
                    <table class="box" v-if="rows.includes(domain.id)">
                        <thead>
                            <tr>
                                <th class="text-left">Processus</th>
                                <th class="text-center">Nombre de point de contrôle</th>
                                <th class="text-center">Nombre de campagne</th>
                                <th class="text-center">Nombre de mission</th>
                                <th class="text-center">Nombre d'anomalies</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="process in domain.processes">
                                <td class="text-left">
                                    {{ process.name }}
                                </td>
                                <td class="text-center">
                                    {{ process.control_points_count }}
                                </td>
                                <td class="text-center">
                                    {{ process.control_campaigns_count }}
                                </td>
                                <td class="text-center">
                                    {{ process.missions_count }}
                                </td>
                                <td class="text-center">
                                    {{ process.anomalies_count }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="w-100 divider" v-if="Object.values(row.domains).length > index + 1"></div>
                </NLColumn>
            </NLGrid>
        </template>

        <template #footer>
            <NLButton type="danger" label="Supprimer" v-if="can('delete_family') && row.is_deletable" @click="destroy">
                <NLIcon name="delete" />
            </NLButton>
            <NLButton type="danger" label="Désactiver" v-if="can('edit_family') && row.is_active" @click="toggleState">
                <NLIcon name="lock" />
            </NLButton>
            <NLButton type="success" label="Activer" v-if="can('edit_family') && !row.is_active" @click="toggleState">
                <NLIcon name="lock_open" />
            </NLButton>
        </template>
    </NLModal>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
    name: 'FamilyModal',
    emits: [ 'close', 'destroy', 'toggleState' ],
    props: {
        rowSelected: { type: Object, },
        show: { type: Boolean, required: true },
        refresh: { type: Number, required: true },
    },
    watch: {
        show(newValue, oldValue) {
            if (newValue && newValue !== oldValue) {
                this.initData()
            } else {
                this.row = null
                this.isLoading = false
            }
        }
    },
    data() {
        return {
            isLoading: false,
            row: null,
            rows: []
        }
    },
    computed: {
        ...mapGetters({
            family: 'families/current'
        }),
    },
    methods: {
        toggleState() {
            this.$emit('toggleState', this.row)
        },
        /**
         * Display / Hide specified domain processes
         *
         * @param {Object} row
         */
        toggleRows(row) {
            const index = this.rows.indexOf(row);
            if (index !== -1) {
                return this.rows.splice(index, 1); // Remove the row if it exists
            } else {
                return this.rows.push(row); // Add the row if it doesn't exist
            }
        },

        /**
         * Close actual modal
         */
        close(forceReload = false) {
            this.row = null
            this.isLoading = false
            this.$emit('close', forceReload)
        },

        /**
         * Emit event to destroy specified domain
         */
        destroy() {
            if (!Number(this.row?.control_campaigns_count)) {
                this.$emit('destroy', this.row)
            }
        },

        /**
         *  Initialize data
         */
        initData() {
            this.isLoading = true
            if (this.rowSelected?.id && this.isLoading) {
                this.$store.dispatch('families/fetch', { id: this.rowSelected.id }).then(() => {
                    this.row = this.family.current
                    this.isLoading = false
                }).catch(error => {
                    this.isLoading = false
                    this.$swal.catchError(error)
                })
            }
        },
    }
}
</script>
