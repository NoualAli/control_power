function page(path) {
    return () => import(`~/pages/${path}`).then(m => m.default || m)
}

export default [
    /**
     * Home / Dashboard
     */
    {
        path: '/',
        name: 'home',
        component: page('home.vue'),
        meta: {
            breadcrumb: {
                label: 'Tableau de bord'
            }
        }
    },

    {
        path: '/admin',
        name: 'admin-dashboard',
        component: page('admin_dashboard.vue'),
        meta: {
            breadcrumb: {
                label: 'Tableau de bord'
            }
        }
    },

    /**
     * Database backups
     */
    {
        path: '/admin/backup/db',
        name: 'admin-backup-db',
        component: page('admin/database/index.vue'),
        meta: {
            breadcrumb: {
                label: 'Backup base de données'
            }
        }
    },

    /**
     * Uploaded and generated files
     */
    {
        path: '/admin/files',
        name: 'admin-server-files',
        component: page('admin/files/index.vue'),
        meta: {
            breadcrumb: {
                label: 'Fichiers'
            }
        }
    },

    /**
     * Auth
     */
    { path: '/login', name: 'login', component: page('auth/login.vue') },
    { path: '/password/reset', name: 'password.reset', component: page('auth/reset.vue') },

    /**
     * Profile settings
     */
    {
        path: '/profile',
        name: 'profile',
        component: page('settings/profile.vue'),
        meta: {
            breadcrumb: {
                label: 'Profil'
            }
        }
    },

    /**
     * Users
     */
    {
        path: '/admin/users',
        name: 'users-index',
        component: page('admin/users/index.vue'),
        meta: {
            breadcrumb: {
                parent: '',
                label: 'Utilisateurs'
            }
        }
    },
    {
        path: '/admin/users/create',
        name: 'users-create',
        component: page('admin/users/create.vue'),
        meta: {
            breadcrumb: {
                label: 'Nouvel utilisateur',
                parent: 'users-index'
            }
        }
    },
    {
        path: '/admin/users/edit/:user',
        name: 'users-edit',
        component: page('admin/users/edit.vue'),
        meta: {
            breadcrumb: {
                label: 'Edition utilisateur',
                parent: 'users-index'
            }
        }
    },

    /**
     * Roles
     */
    {
        path: '/admin/roles',
        name: 'roles-index',
        component: page('admin/roles/index.vue'),
        meta: {
            breadcrumb: {
                label: 'Rôles'
            }
        }
    },
    {
        path: '/admin/roles/create',
        name: 'roles-create',
        component: page('admin/roles/create.vue'),
        meta: {
            breadcrumb: {
                label: 'Nouveau rôle',
                parent: 'roles-index'
            }
        }
    },
    {
        path: '/admin/roles/edit/:role',
        name: 'roles-edit',
        component: page('admin/roles/edit.vue'),
        meta: {
            breadcrumb: {
                label: 'Edition rôle',
                parent: 'roles-index'
            }
        }
    },
    /**
    * Modules
    */
    {
        path: '/admin/modules',
        name: 'modules-index',
        component: page('admin/modules/index.vue'),
        meta: {
            breadcrumb: {
                parent: 'roles-index',
                label: 'Modules'
            }
        }
    },
    /**
     * Regional inspections
     */
    {
        path: '/admin/structures/regional-inspection',
        name: 'regional-inspection-index',
        component: page('admin/structures/regional-inspections/index.vue'),
        meta: {
            breadcrumb: {

                label: 'Inspections régionales'
            }
        }
    },
    {
        path: '/admin/structures/regional-inspection/create',
        name: 'regional-inspection-create',
        component: page('admin/structures/regional-inspections/create.vue'),
        meta: {
            breadcrumb: {
                label: 'Nouvelle inspection régionale',
                parent: 'regional-inspection-index'
            }
        }
    },
    {
        path: '/admin/structures/regional-inspection/edit/:regionalInspection',
        name: 'regional-inspection-edit',
        component: page('admin/structures/regional-inspections/edit.vue'),
        meta: {
            breadcrumb: {
                label: 'Edition inspection régionale',
                parent: 'regional-inspection-index'
            }
        }
    },
    /**
     * Dre
     */
    {
        path: '/admin/structures/dre',
        name: 'dre-index',
        component: page('admin/structures/dre/index.vue'),
        meta: {
            breadcrumb: {

                label: 'DRE'
            }
        }
    },
    {
        path: '/admin/structures/dre/create',
        name: 'dre-create',
        component: page('admin/structures/dre/create.vue'),
        meta: {
            breadcrumb: {
                label: 'Nouvelle DRE',
                parent: 'dre-index'
            }
        }
    },
    {
        path: '/admin/structures/dre/edit/:dre',
        name: 'dre-edit',
        component: page('admin/structures/dre/edit.vue'),
        meta: {
            breadcrumb: {
                label: 'Edition DRE',
                parent: 'dre-index'
            }
        }
    },
    /**
     * Agencies
     */
    {
        path: '/admin/structures/agencies',
        name: 'agencies-index',
        component: page('admin/structures/agencies/index.vue'),
        meta: {
            breadcrumb: {
                label: 'Agences'
            }
        }
    },
    {
        path: '/admin/structures/agencies/create',
        name: 'agencies-create',
        component: page('admin/structures/agencies/create.vue'),
        meta: {
            breadcrumb: {
                label: 'Nouvelle agence',
                parent: 'agencies-index'
            }
        }
    },
    {
        path: '/admin/structures/agencies/edit/:agency',
        name: 'agencies-edit',
        component: page('admin/structures/agencies/edit.vue'),
        meta: {
            breadcrumb: {
                label: 'Edition agence',
                parent: 'agencies-index'
            }
        }
    },
    /**
     * Categories
     */
    {
        path: '/admin/structures/categories',
        name: 'categories-index',
        component: page('admin/structures/categories/index.vue'),
        meta: {
            breadcrumb: {
                label: 'Catégories'
            }
        }
    },
    {
        path: '/admin/structures/categories/create',
        name: 'categories-create',
        component: page('admin/structures/categories/create.vue'),
        meta: {
            breadcrumb: {
                label: 'Nouvelle catégorie',
                parent: 'categories-index'
            }
        }
    },
    {
        path: '/admin/structures/categories/edit/:category',
        name: 'categories-edit',
        component: page('admin/structures/categories/edit.vue'),
        meta: {
            breadcrumb: {
                label: 'Edition catégorie',
                parent: 'categories-index'
            }
        }
    },
    /**
     * Families
     */
    {
        path: '/admin/families',
        name: 'families-index',
        component: page('admin/families/index.vue'),
        meta: {
            breadcrumb: {
                label: 'Familles'
            }
        }
    },
    {
        path: '/admin/families/create',
        name: 'families-create',
        component: page('admin/families/create.vue'),
        meta: {
            breadcrumb: {
                label: 'Nouvelle famille',
                parent: 'families-index'
            }
        }
    },
    {
        path: '/admin/families/edit/:family',
        name: 'families-edit',
        component: page('admin/families/edit.vue'),
        meta: {
            breadcrumb: {
                label: 'Edition famille',
                parent: 'families-index'
            }
        }
    },
    /**
    * Domains
    */
    {
        path: '/admin/domains',
        name: 'domains-index',
        component: page('admin/domains/index.vue'),
        meta: {
            breadcrumb: {
                label: 'Domaines'
            }
        }
    },
    {
        path: '/admin/domains/create',
        name: 'domains-create',
        component: page('admin/domains/create.vue'),
        meta: {
            breadcrumb: {
                label: 'Nouveau domaine',
                parent: 'domains-index'
            }
        }
    },
    {
        path: '/admin/domains/edit/:domain',
        name: 'domains-edit',
        component: page('admin/domains/edit.vue'),
        meta: {
            breadcrumb: {
                label: 'Edition domaine',
                parent: 'domains-index'
            }
        }
    },
    /**
    * Processes
    */
    {
        path: '/admin/processes',
        name: 'processes-index',
        component: page('admin/processes/index.vue'),
        meta: {
            breadcrumb: {
                label: 'Processus'
            }
        }
    },
    {
        path: '/admin/processes/create',
        name: 'processes-create',
        component: page('admin/processes/create.vue'),
        meta: {
            breadcrumb: {
                label: 'Nouveau processus',
                parent: 'processes-index'
            }
        }
    },
    {
        path: '/admin/processes/edit/:process',
        name: 'processes-edit',
        component: page('admin/processes/edit.vue'),
        meta: {
            breadcrumb: {
                label: 'Edition processus',
                parent: 'processes-index'
            }
        }
    },

    /**
    * Control points
    */
    {
        path: '/admin/control-points',
        name: 'control-points-index',
        component: page('admin/control-points/index.vue'),
        meta: {
            breadcrumb: {
                label: 'Points de contrôle'
            }
        }
    },
    {
        path: '/admin/control-points/create',
        name: 'control-points-create',
        component: page('admin/control-points/create.vue'),
        meta: {
            breadcrumb: {
                label: 'Nouveau point de contrôle',
                parent: 'control-points-index'
            }
        }
    },
    {
        path: '/admin/control-points/edit/:controlPoint',
        name: 'control-points-edit',
        component: page('admin/control-points/edit.vue'),
        meta: {
            breadcrumb: {
                label: 'Edition point de contrôle',
                parent: 'control-points-index'
            }
        }
    },

    /**
    * Control points
    */
    {
        path: '/admin/fields',
        name: 'fields-index',
        component: page('admin/fields/index.vue'),
        meta: {
            breadcrumb: {
                label: 'Champs'
            }
        }
    },
    {
        path: '/admin/fields/create',
        name: 'fields-create',
        component: page('admin/fields/create.vue'),
        meta: {
            breadcrumb: {
                label: 'Nouveau champs',
                parent: 'fields-index'
            }
        }
    },
    {
        path: '/admin/fields/edit/:field',
        name: 'fields-edit',
        component: page('admin/fields/edit.vue'),
        meta: {
            breadcrumb: {
                label: 'Edition champs',
                parent: 'fields-index'
            }
        }
    },

    /**
     * Control campaigns
     */
    {
        path: '/agency-level/campaigns',
        name: 'campaigns',
        component: page('agency_level/campaigns/index.vue'),
        meta: {
            breadcrumb: {
                label: 'Planning annuel'
            }
        }
    },
    {
        path: '/agency-level/campaigns/create',
        name: 'campaigns-create',
        component: page('agency_level/campaigns/create.vue'),
        meta: {
            breadcrumb: {
                label: 'Nouvelle Campgne',
                parent: 'campaigns'
            }
        }
    },
    {
        path: '/agency-level/campaigns/:campaignId',
        name: 'campaign',
        component: page('agency_level/campaigns/show.vue'),
        meta: {
            breadcrumb: {
                label: 'Détails campagne',
                parent: 'campaigns'
            }
        }
    },
    {
        path: '/agency-level/campaigns/edit/:campaignId',
        name: 'campaigns-edit',
        component: page('agency_level/campaigns/edit.vue'),
        meta: {
            breadcrumb: {
                label: 'Edition campagne',
                parent: 'campaigns',
            }
        }
    },
    {
        path: '/agency-level/campaigns/:campaignId/missions',
        name: 'campaign-missions',
        component: page('agency_level/missions/index.vue'),
        meta: {
            breadcrumb: {
                parent: 'campaign',
                label: 'Suivi des missions'
            }
        }
    },
    {
        path: '/agency-level/campaigns/:campaignId/statistics',
        name: 'campaign-statistics',
        component: page('agency_level/campaigns/statistics.vue'),
        meta: {
            breadcrumb: {
                label: 'Statistiques'
            }
        }
    },
    /**
     * Missions
     */
    {
        path: '/agency-level/missions/',
        name: 'missions',
        component: page('agency_level/missions/index.vue'),
        meta: {
            breadcrumb: {
                label: 'Suivi des missions'
            }
        }
    },
    {
        path: '/agency-level/missions/create/:campaignId?',
        name: 'missions-create',
        component: page('agency_level/missions/create.vue'),
        meta: {
            breadcrumb: {
                parent: 'missions',
                label: 'Répartition des missions'
            }
        }
    },
    {
        path: '/agency-level/missions/:missionId',
        name: 'mission',
        component: page('agency_level/missions/show.vue'),
        meta: {
            breadcrumb: {
                parent: 'missions',
                label: 'Mission'
            }
        }
    },
    {
        path: '/agency-level/missions/edit/:missionId',
        name: 'missions-edit',
        component: page('agency_level/missions/edit.vue'),
        meta: {
            breadcrumb: {
                parent: 'missions',
                label: 'Modification des informations de la mission'
            }
        }
    },
    {
        path: '/agency-level/missions/:missionId/details/:processId?',
        name: 'mission-details',
        component: page('agency_level/missions/details.vue'),
        meta: {
            breadcrumb: {
                parent: 'mission',
                label: 'Détails de mission'
            }
        }
    },

    /**
     * Global
     */
    {
        path: '/agency-level/anomalies',
        name: 'anomalies',
        component: page('agency_level/global/anomalies.vue'),
        meta: {
            breadcrumb: {
                label: 'Plans de redressement',
                parent: ''
            }
        }
    },
    {
        path: '/agency-level/major-facts',
        name: 'major-facts',
        component: page('agency_level/global/major_facts.vue'),
        meta: {
            breadcrumb: {
                label: 'Faits majeurs',
                parent: ''
            }
        }

    },

    /**
     * References
     */
    {
        path: '/references/pcf',
        name: 'references-pcf',
        component: page('reference/pcf.vue'),
        meta: {
            breadcrumb: {
                label: 'Références'
            }
        }
    },
    {
        path: '/admin/pcf/',
        name: 'pcf-management',
        component: page('admin/pcf/index.vue'),
        meta: {
            breadcrumb: {
                label: 'Textes réglementaires'
            }
        }
    },
    {
        path: '/admin/pcf/create',
        name: 'pcf-management-create',
        component: page('admin/pcf/create.vue'),
        meta: {
            breadcrumb: {
                parent: 'pcf-management',
                label: 'Ajouter un nouveau texte réglementaire'
            }
        }
    },
    {
        path: '/admin/pcf/edit/:pcf',
        name: 'pcf-management-edit',
        component: page('admin/pcf/edit.vue'),
        meta: {
            breadcrumb: {
                parent: 'pcf-management',
                label: 'Edition texte réglementaire'
            }
        }
    },
    /**
     * Notifications center
     */
    {
        path: '/notifications',
        name: 'notifications',
        component: page('notifications/index'),
        meta: {
            breadcrumb: {
                label: 'Centre des notifications'
            }
        }
    },
    {
        path: '/notifications/settings',
        name: 'notifications-settings',
        component: page('notifications/settings'),
        meta: {
            breadcrumb: {
                label: 'Paramètre du centre des notifications'
            }
        }
    },

    /**
     * Bugs
     */
    {
        path: '/bugs',
        name: 'bugs-index',
        component: page('bugs/index.vue'),
        meta: {
            breadcrumb: {
                label: 'Bugs'
            }
        }
    },
    {
        path: '/bugs/create',
        name: 'bugs-create',
        component: page('bugs/create.vue'),
        meta: {
            breadcrumb: {
                label: 'Signaler un bug'
            }
        }
    },

    /**
     * Errors
     */
    { path: '/:pathMatch(.*)*', name: '404', component: page('errors/404.vue') }

]
