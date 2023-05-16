<template>
    <div v-if="can('view_agency')">
        <ContentHeader>
            <template #actions>
                <router-link v-if="can(['create_agency'])" :to="{ name: 'agencies-create' }" class="btn btn-info">
                    Ajouter
                </router-link>
            </template>
        </ContentHeader>
        <ContentBody>
            <NLDatatable :config="config" title="Liste des agences" namespace="agencies" @show="show" @delete="destroy"
                @edit="edit" />
            <NLModal :show="rowSelected" @close="rowSelected = null">
                <template #title>
                    Informations agence
                </template>
                <template #default>
                    <div class="grid list">
                        <div class="col-12 col-lg-6 list-item">
                            <div class="list-item-label">
                                Agence
                            </div>
                            <div class="list-item-content">
                                {{ rowSelected?.full_name }}
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 list-item">
                            <div class="list-item-label">
                                Dre
                            </div>
                            <div class="list-item-content">
                                {{ rowSelected?.dre?.full_name }}
                            </div>
                        </div>
                    </div>
                </template>
                <template #footer>
                    <div v-if="can(['delete_agency', 'edit_agency'])" class="d-flex justify-end align-center gap-5 w-100">
                        <button v-if="can(['delete_agency'])" class="btn btn-danger has-icon"
                            @click.prevent="destroy(rowSelected)">
                            <i class="las la-trash icon" />
                            <span class="icon-text">
                                Supprimer
                            </span>
                        </button>
                        <button v-if="can(['edit_agency'])" class="btn btn-warning has-icon"
                            @click.prevent="edit(rowSelected)">
                            <i class="las la-edit icon" />
                            <span class="icon-text">
                                Modifier
                            </span>
                        </button>
                    </div>
                </template>
            </NLModal>
        </ContentBody>
    </div>
</template>

<script>
import NLDatatable from '../../../components/NLDatatable'
import { mapGetters } from 'vuex'
export default {
    components: { NLDatatable },
    layout: 'MainLayout',
    middleware: [ 'auth', 'admin' ],
    metaInfo() {
        return { title: 'Agences' }
    },
    computed: {
        ...mapGetters({
            agencies: 'agencies/paginated',
            agency: 'agencies/current'
        })
    },
    data() {
        return {
            rowSelected: null,
            config: {
                data: null,
                columns: [
                    {
                        label: 'Code',
                        field: 'code',
                        orderable: true
                    },
                    {
                        label: 'Nom',
                        field: 'name',
                        orderable: true
                    },
                    {
                        label: 'Categorie',
                        field: 'category'
                    },
                    {
                        label: 'Dre',
                        field: 'dre_full_name'
                    }
                ],
                actions: {
                    show: (item) => {
                        return this.can('view_agency')
                    },
                    edit: (item) => {
                        return this.can('edit_agency')
                    },
                    delete: (item) => {
                        return this.can('delete_agency')
                    }
                }
            }
        }
    },
    created() {
        this.initData()
    },
    methods: {
        /**
         * Affiche les détailles de la resource
         * @param {Object} item
         */
        show(item) {
            this.$store.dispatch('agencies/fetch', item.id).then(() => this.rowSelected = this.agency.current)
        },

        /**
         * Redirige vers la page d'edition
         * @param {Object} item
         */
        edit(item) {
            this.$router.push({ name: 'agencies-edit', params: { agency: item.id } })
        },

        /**
         * Supprime la ressource
         * @param {Object} item
         */
        destroy(item) {
            this.$swal.confirm_destroy().then((action) => {
                if (action.isConfirmed) {
                    api.delete('agencies/' + item.id).then(response => {
                        if (response.data.status) {
                            this.rowSelected = null
                            this.initData()
                            this.$swal.toast_success(response.data.message)
                        } else {
                            this.$swal.toast_error(response.data.message)
                        }
                    })
                }
            }).catch(error => {
                this.$swal.alert_error()
            })
        },

        /**
         * Initialise les données
         */
        initData() {
            this.$store.dispatch('agencies/fetchPaginated').then(() => {
                this.config.data = this.agencies.paginated
            })
        }
    }
}
</script>
