<template>
    <div>
        <div class="sidebar-body">
            <div class="sidebar-title"></div>

            <NLSidebarItem label="Tableau de bord" route="home" iconName="dashboard" />

            <DCPSidebar v-if="is('dcp')" />
            <CDCRSidebar v-else-if="is('cdcr')" />
            <CCSidebar v-else-if="is('cc')" />
            <CDCSidebar v-else-if="is('cdc')" />
            <CISidebar v-else-if="is('ci')" />
            <DASidebar v-else-if="is('da')" />
            <InspectionSidebar v-else-if="is('iga', 'ir')" />
            <GenericSidebar v-else />

            <NLSidebarItem label="Références" route="references-pcf" iconName="quick_reference_all" />

            <NLSidebarSubmenu iconName="manage_accounts" label="Gestion utilisateurs"
                v-if="(can('view_user') || can('view_role') || can('view_module')) && is(['root', 'admin'])">
                <NLSidebarItem label="Utilisateurs" route="users-index" iconName="group" v-if="can('view_user')" />
                <NLSidebarItem label="Roles" route="roles-index" iconName="shield_person" v-if="can('view_role')" />
                <NLSidebarItem label="Modules" route="modules-index" iconName="shield_lock" v-if="can('view_module')" />
            </NLSidebarSubmenu>

            <NLSidebarItem label="Utilisateurs" route="users-index" iconName="group"
                v-if="can('view_user') && !is(['root', 'admin'])">
            </NLSidebarItem>

            <NLSidebarSubmenu iconName="apartment" label="Structures"
                v-if="can('view_dre') || can('view_agency') || can('view_category') || can('view_regional_inspection')">
                <NLSidebarItem label="Inspections régionales" route="regional-inspection-index" iconName="location_city"
                    v-if="can('view_regional_inspection')" />
                <NLSidebarItem label="DRE" route="dre-index" iconName="domain" v-if="can('view_dre')" />
                <NLSidebarItem label="Agences" route="agencies-index" iconName="account_balance"
                    v-if="can('view_agency')" />
                <NLSidebarItem label="Catégories d'agences" route="categories-index" iconName="tag"
                    v-if="can('view_category')" />
            </NLSidebarSubmenu>

            <NLSidebarSubmenu iconName="tune" label="Gestion PCF"
                v-if="can('view_family') || can('view_domain') || can('view_process') || can('view_control_point') || can('view_field')">
                <NLSidebarItem label="Familles" route="families-index" iconName="tenancy" v-if="can('view_family')" />
                <NLSidebarItem label="Domaines" route="domains-index" iconName="network_node"
                    v-if="can('view_domain')" />
                <NLSidebarItem label="Processus" route="processes-index" iconName="account_tree"
                    v-if="can('view_process')" />
                <NLSidebarItem label="Points de contrôle" route="control-points-index" iconName="list"
                    v-if="can('view_control_point')" />
                <NLSidebarItem label="Champs" route="fields-index" iconName="dataset" v-if="can('view_field')" />
                <NLSidebarItem label="Textes réglementaires" route="pcf-management" iconName="quick_reference_all"
                    v-if="can('view_field')" />
            </NLSidebarSubmenu>

            <NLSidebarSubmenu iconName="dns" label="Gestion serveur" v-if="is('root')">
                <NLSidebarItem label="Backup DB" route="admin-backup-db" v-if="is('root')" iconName="database" />
                <NLSidebarItem label="Fichiers" route="admin-server-files" v-if="is('root')" iconName="storage" />
                <a class="sidebar-item" href="/log-viewer" target="_blank" v-if="is('root')">
                    <NLIcon name="description" />
                    <span class="sidebar-icon_text">
                        Logs
                    </span>
                </a>
                <a class="sidebar-item" href="/env-editor" target="_blank" v-if="is('root')">
                    <NLIcon name="settings_applications" />
                    <span class="sidebar-icon_text">
                        Variables d'environnement
                    </span>
                </a>
            </NLSidebarSubmenu>
        </div>
    </div>
</template>

<script>
import NLIcon from '../NLIcon'
import NLSidebarItem from './NLSidebarItem.vue'
import NLSidebarSubmenu from './NLSidebarSubmenu.vue'
import DCPSidebar from '../../menus/AgencyLevel/DCPSidebar.vue'
import CDCRSidebar from '../../menus/AgencyLevel/CDCRSidebar.vue'
import CCSidebar from '../../menus/AgencyLevel/CCSidebar.vue'
import CDCSidebar from '../../menus/AgencyLevel/CDCSidebar.vue'
import CISidebar from '../../menus/AgencyLevel/CISidebar.vue'
import DASidebar from '../../menus/AgencyLevel/DASidebar.vue'
import InspectionSidebar from '../../menus/AgencyLevel/InspectionSidebar.vue'
import GenericSidebar from '../../menus/AgencyLevel/GenericSidebar.vue'
export default {
    name: "NLSidebarBody",
    components: {
        DASidebar, DCPSidebar, CDCRSidebar, CCSidebar, CDCSidebar, CISidebar, GenericSidebar, InspectionSidebar,
        NLIcon, NLSidebarItem, NLSidebarSubmenu
    },
}
</script>
