<template>
    <div v-if="can('view_module')">
        <ContentHeader>
            <template #actions>
                <button class="btn btn-office-excel has-icon" @click="this.excelExportIsOpen = true">
                    <i class="las la-file-excel icon" />
                    Exporter
                </button>
            </template>
        </ContentHeader>
        <ContentBody>
            <NLForm :action="update" :form="form" class="no-bg shadowless">
                <NLColumn>
                    <NLSelect name="role" v-model="form.role" :options="rolesList" label="Rôle"
                        placeholder="Choisissez un rôle" no-options-text="Aucun rôle disponible"
                        loading-text="Chargement des rôles en cours..." labelRequired />
                </NLColumn>
                <NLColumn v-if="form.role">
                    <!-- Submit Button -->
                    <NLFlex lgJustifyContent="between" alignItems="center">
                        <h2>Liste des modules</h2>
                        <NLButton :loading="form.busy" label="Enregistrer" />
                    </NLFlex>
                </NLColumn>
                <NLColumn v-for="(module, index) in  modules " v-if="modules && form?.role" :key="module?.id" md="6" lg="4"
                    extraClass="box">
                    <h2 @click="selectModule(module)" class="is-clickable">{{ module.name }}</h2>
                    <NLGrid extraClass="mt-5">
                        <NLColumn v-for="permission in module.permissions"
                            :class="[{ 'is-selected': this.form.permissions.includes(permission.id) }, 'select-box']"
                            @click="select(permission.id)">
                            {{ permission.name }}
                        </NLColumn>
                    </NLGrid>
                </NLColumn>
                <NLColumn v-if="form?.role">
                    <!-- Submit Button -->
                    <NLFlex lgJustifyContent="end">
                        <NLButton :loading="form.busy" label="Enregistrer" />
                    </NLFlex>
                </NLColumn>
            </NLForm>
            <ExcelExportModal v-if="excelExportIsOpen" :show="excelExportIsOpen" :route="this.currentUrl"
                @close="this.excelExportIsOpen = false" @success="this.excelExportIsOpen = false" />
        </ContentBody>
    </div>
</template>

<script>
import NLListItem from '../../../components/List/NLListItem'
import NLList from '../../../components/List/NLList'
import NLForm from '../../../components/NLForm'
import NLGrid from '../../../components/Grid/NLGrid'
import NLColumn from '../../../components/Grid/NLColumn'
import NLCheckableContainer from '../../../components/Inputs/NLCheckableContainer'
import ExcelExportModal from '../../../Modals/ExcelExportModal';
import Form from 'vform'
export default {
    components: {
        ExcelExportModal,
        NLCheckableContainer,
        NLListItem,
        NLList,
        NLForm,
        NLColumn, NLGrid
    },
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    metaInfo() {
        return { title: 'Modules' }
    },
    created() {
        this.initData()
    },
    data() {
        return {
            excelExportIsOpen: false,
            currentUrl: '/api/modules?export',
            form: new Form({
                role: null,
                permissions: [],
            }),
            modules: null,
            rolesList: [],
            currentRole: null,
            rolePermissions: null,
        }
    },

    watch: {
        "form.role"(newValue, oldValue) {
            this.$api.get('roles/' + this.form?.role).then((response) => {
                this.currentRole = response?.data
                this.permissions = this.currentRole.permissions.map((permission) => permission.id)
                this.form.permissions = this.permissions
            }).catch(error => {
                console.log(error);
            })
        }
    },
    methods: {
        /**
         * Init roles and all existing modules
         */
        initData() {
            this.$store.dispatch('settings/updatePageLoading', true)

            // Load roles
            this.$api.get('roles?fetchAll').then((response) => {
                this.rolesList = response?.data

                // Load modules
                this.$api.get('modules').then((response) => {
                    this.modules = response?.data?.data
                    this.$store.dispatch('settings/updatePageLoading', false)
                }).catch(error => {
                    console.log(error);
                    this.$store.dispatch('settings/updatePageLoading', false)
                })

            }).catch(error => {
                console.log(error);
                this.$store.dispatch('settings/updatePageLoading', false)
            })

        },

        /**
         * Update permissions of selected role
         */
        update() {
            this.$api.put('modules').then(response => {
                if (condition) {

                }
            }).catch(error => {
                console.log(error);
            })
            this.form.put('modules').then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                } else {
                    this.$swal.alert_error(response.data.message)
                }
            }).catch(error => {
                console.log(error)
            })
        },

        /**
         * Select single permission
         *
         * @param {integer} id
         */
        select(id) {
            if (this.form.permissions.includes(id)) {
                const index = this.form.permissions.indexOf(id);
                if (index !== -1) {
                    this.form.permissions.splice(index, 1);
                }
            } else {
                this.form.permissions.push(id);
            }
        },

        /**
         * Toggle module permissions
         *
         * @param {Object} module
         */
        selectModule(module) {
            const permissions = module.permissions.map((permission) => permission.id);

            // Check if all permissions from the module are already selected
            const allSelected = permissions.every((value) => this.form.permissions.includes(value));

            // If all permissions are already selected, unselect them
            if (allSelected) {
                this.form.permissions = this.form.permissions.filter((value) => !permissions.includes(value));
            } else {
                // If some or none are selected, select all permissions from the module
                permissions.forEach((value) => {
                    if (!this.form.permissions.includes(value)) {
                        this.form.permissions.push(value);
                    }
                });
            }
        }

    }
}
</script>
