<template>
    <NLModal :show="show" @close="close" :isLoading="isLoading">
        <template #title>
            <div class="tags">
                <NLTooltip type="bottom">
                    <template #content>
                        <b>Famille</b>
                        <p class="mt-2">{{ row?.family_name }}</p>
                    </template>
                    <span class="tag is-start text-normal">
                        <NLIcon name="tenancy" /> {{ str_slice(row?.family_name, 40) }}
                    </span>
                </NLTooltip>
                <NLTooltip type="bottom">
                    <template #content>
                        <b>Domaine</b>
                        <p class="mt-2">{{ row?.domain_name }}</p>
                    </template>
                    <span class="tag is-start text-normal">
                        <NLIcon name="network_node" /> {{ str_slice(row?.domain_name, 40) }}
                    </span>
                </NLTooltip>
                <NLTooltip title="Processus" type="bottom">
                    <template #content>
                        <b>Processus</b>
                        <p class="mt-2">{{ row?.name }}</p>
                    </template>
                    <span class="tag is-start text-normal">
                        <NLIcon name="account_tree" /> {{ str_slice(row?.name) }}
                    </span>
                </NLTooltip>
            </div>
        </template>

        <template #default>
            <NLGrid gap="6" v-if="is(['root', 'admin', 'cdcr', 'dcp', 'cdrcp'])">
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

                        <NLColumn lg="6"><b>Nombre de points de contrôle</b></NLColumn>
                        <NLColumn lg="6">{{ row.control_points_count }}</NLColumn>

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

                    </NLGrid>
                </NLColumn>
                <NLColumn class="divider" />
                <NLColumn>
                    <h3>Liste des points de contrôle</h3>
                </NLColumn>
                <NLColumn>
                    <table class="box">
                        <thead>
                            <tr>
                                <th class="text-left">Point de contrôle</th>
                                <th class="text-center">Nombre de campagne</th>
                                <th class="text-center">Nombre de mission</th>
                                <th class="text-center">Nombre d'anomalies</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="control_point in row.control_points" :key="'cp-' + control_point.id">
                                <td class="text-left">
                                    {{ control_point.name }}
                                </td>
                                <td class="text-center">
                                    {{ control_point.control_campaigns_count }}
                                </td>
                                <td class="text-center">
                                    {{ control_point.missions_count }}
                                </td>
                                <td class="text-center">
                                    {{ control_point.anomalies_count }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </NLColumn>

                <NLColumn class="divider" v-if="Object.values(row.formatted_media).length" />
                <NLColumn>
                    <h3>
                        Documentation
                    </h3>
                </NLColumn>
                <NLColumn class="box" v-if="Object.values(row.formatted_media).length"
                    v-for="(files, category) in row?.formatted_media">
                    <NLGrid gap="1">
                        <NLColumn>
                            <h4 class="my-2">{{ category }}</h4>
                        </NLColumn>
                        <NLColumn v-for="file in files">
                            <NLColumn class="text-bold">
                                {{ file?.payload?.object }}
                            </NLColumn>
                            <NLColumn>
                                <a :href="file.link" target="_blank" class="text-dark" :download="file.original_name">
                                    <i class="icon" :class="file.icon"></i>
                                    {{ file.original_name }}
                                </a>
                            </NLColumn>
                            <NLColumn class="divider"></NLColumn>
                        </NLColumn>
                    </NLGrid>
                </NLColumn>
            </NLGrid>
            <div class="content" v-else>
                <h2>
                    Points de contrôle
                </h2>
                <ul class="text-normal">
                    <li class="my-2" v-for="control_point in row?.control_points">
                        {{ control_point.name }}
                    </li>
                </ul>
                <NLGrid class="text-normal">
                    <NLColumn v-if="Object.values(row.formatted_media).length">
                        <h2>
                            Documentation
                        </h2>
                    </NLColumn>
                    <NLColumn v-for="(files, category) in row?.formatted_media">
                        <NLGrid gap="1">
                            <NLColumn>
                                <h3 class="my-2">{{ category }}</h3>
                            </NLColumn>
                            <NLColumn v-for="file in files">
                                <NLColumn class="text-bold text-normal">
                                    {{ file?.payload?.object }}
                                </NLColumn>
                                <NLColumn>
                                    <a :href="file.link" target="_blank" class="text-dark"
                                        :download="file.original_name">
                                        <i class="icon" :class="file.icon"></i>
                                        {{ file.original_name }}
                                    </a>
                                </NLColumn>
                                <NLColumn class="divider"></NLColumn>
                            </NLColumn>
                        </NLGrid>
                    </NLColumn>
                </NLGrid>
            </div>
        </template>
        <template #footer>
            <NLButton type="danger" label="Supprimer" v-if="can('delete_process') && row.is_deletable" @click="destroy">
                <NLIcon name="delete" />
            </NLButton>
            <NLButton type="danger" label="Désactiver" v-if="can('edit_process') && row.is_active" @click="toggleState">
                <NLIcon name="lock" />
            </NLButton>
            <NLButton type="success" label="Activer" v-if="can('edit_process') && !row.is_active" @click="toggleState">
                <NLIcon name="lock_open" />
            </NLButton>
        </template>
    </NLModal>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
    name: 'ProcessModal',
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
        }
    },
    computed: {
        ...mapGetters({
            process: 'processes/current'
        }),
    },
    methods: {
        toggleState() {
            this.$emit('toggleState', this.row)
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
         * Emit event to destroy specified process
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
                this.$store.dispatch('processes/fetch', { id: this.rowSelected.id }).then(() => {
                    this.row = this.process.current
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
