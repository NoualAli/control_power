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
            breadcrumb: false
        }
    },

    /**
     * Auth
     */
    { path: '/login', name: 'login', component: page('auth/login.vue') },
    { path: '/password/new', name: 'password.new', component: page('auth/password/new.vue') },

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
       * Permissions
       */
    {
        path: '/admin/permissions',
        name: 'permissions-index',
        component: page('admin/permissions/index.vue'),
        meta: {
            breadcrumb: {
                parent: 'roles-index',
                label: 'Permissions'
            }
        }
    },
    {
        path: '/admin/permissions/create',
        name: 'permissions-create',
        component: page('admin/permissions/create.vue'),
        meta: {
            breadcrumb: {
                label: 'Nouvelle permission',
                parent: 'permissions-index'
            }
        }
    },
    {
        path: '/admin/permissions/edit/:permission',
        name: 'permissions-edit',
        component: page('admin/permissions/edit.vue'),
        meta: {
            breadcrumb: {
                label: 'Edition permission',
                parent: 'permissions-index'
            }
        }
    },
    /**
     * Dre
     */
    {
        path: '/admin/dre',
        name: 'dre-index',
        component: page('admin/dre/index.vue'),
        meta: {
            breadcrumb: {

                label: 'DRE'
            }
        }
    },
    {
        path: '/admin/dre/create',
        name: 'dre-create',
        component: page('admin/dre/create.vue'),
        meta: {
            breadcrumb: {
                label: 'Nouvelle DRE',
                parent: 'dre-index'
            }
        }
    },
    {
        path: '/admin/dre/edit/:dre',
        name: 'dre-edit',
        component: page('admin/dre/edit.vue'),
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
        path: '/admin/agencies',
        name: 'agencies-index',
        component: page('admin/agencies/index.vue'),
        meta: {
            breadcrumb: {
                label: 'Agences'

            }
        }
    },
    {
        path: '/admin/agencies/create',
        name: 'agencies-create',
        component: page('admin/agencies/create.vue'),
        meta: {
            breadcrumb: {
                label: 'Nouvelle agence',
                parent: 'agencies-index'
            }
        }
    },
    {
        path: '/admin/agencies/edit/:agency',
        name: 'agencies-edit',
        component: page('admin/agencies/edit.vue'),
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
        path: '/admin/categories',
        name: 'categories-index',
        component: page('admin/categories/index.vue'),
        meta: {
            breadcrumb: {
                label: 'Catégorie'

            }
        }
    },
    {
        path: '/admin/categories/create',
        name: 'categories-create',
        component: page('admin/categories/create.vue'),
        meta: {
            breadcrumb: {
                label: 'Nouvelle catégorie',
                parent: 'categories-index'
            }
        }
    },
    {
        path: '/admin/categories/edit/:category',
        name: 'categories-edit',
        component: page('admin/categories/edit.vue'),
        meta: {
            breadcrumb: {
                label: 'Edition catégorie',
                parent: 'categories-index'
            }
        }
    },
    /**
     * Famillies
     */
    {
        path: '/admin/famillies',
        name: 'famillies-index',
        component: page('admin/famillies/index.vue'),
        meta: {
            breadcrumb: {
                label: 'Familles'

            }
        }
    },
    {
        path: '/admin/famillies/create',
        name: 'famillies-create',
        component: page('admin/famillies/create.vue'),
        meta: {
            breadcrumb: {
                label: 'Nouvelle famille',
                parent: 'famillies-index'
            }
        }
    },
    {
        path: '/admin/famillies/edit/:familly',
        name: 'famillies-edit',
        component: page('admin/famillies/edit.vue'),
        meta: {
            breadcrumb: {
                label: 'Edition famille',
                parent: 'famillies-index'
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
     * Control campaigns
     */
    {
        path: '/campaigns',
        name: 'campaigns',
        component: page('campaigns/index.vue'),
        meta: {
            breadcrumb: {
                label: 'Suivi du planning annuel'
            }
        }
    },
    {
        path: '/campaigns/create',
        name: 'campaigns-create',
        component: page('campaigns/create.vue'),
        meta: {
            breadcrumb: {
                label: 'Ajouter une nouvelle campagne de contrôle',
                parent: 'campaigns'
            }
        }
    },
    {
        path: '/campaigns/:campaignId',
        name: 'campaign',
        component: page('campaigns/show.vue'),
        meta: {
            breadcrumb: {
                label: 'Détails campagne',
                parent: 'campaigns'
            }
        }
    },
    {
        path: '/campaigns/edit/:campaignId',
        name: 'campaigns-edit',
        component: page('campaigns/edit.vue'),
        meta: {
            breadcrumb: {
                label: 'Edition campagne de contrôle',
                parent: 'campaign'
            }
        }
    },
    {
        path: '/campaigns/:campaignId/missions',
        name: 'campaign-missions',
        component: page('missions/index.vue'),
        meta: {
            breadcrumb: {
                parent: 'campaign',
                label: 'Missions'
            }
        }
    },
    /**
     * Missions
     */
    {
        path: '/missions/',
        name: 'missions',
        component: page('missions/index.vue'),
        meta: {
            breadcrumb: {
                label: 'Missions'
            }
        }
    },
    {
        path: '/missions/create/:campaignId?',
        name: 'missions-create',
        component: page('missions/create.vue'),
        meta: {
            breadcrumb: {
                parent: 'missions',
                label: 'Répartition des missions de contrôle'
            }
        }
    },
    {
        path: '/missions/:missionId',
        name: 'mission',
        component: page('missions/show.vue'),
        meta: {
            breadcrumb: {
                parent: 'missions',
                label: 'Mission'
            }
        }
    },
    {
        path: '/missions/edit/:missionId',
        name: 'missions-edit',
        component: page('missions/edit.vue'),
        meta: {
            breadcrumb: {
                parent: 'missions',
                label: 'Edition mission de contrôle'
            }
        }
    },
    {
        path: '/missions/:missionId/details/:processId?',
        name: 'mission-details',
        component: page('missions/details.vue'),
        meta: {
            breadcrumb: {
                parent: 'mission',
                label: 'Détails de la mission'
            }
        }
    },
    // {
    //     path: '/missions/:missionId/execute/:processId?',
    //     name: 'mission-details-execute',
    //     component: page('missions/execute.vue'),
    //     meta: {
    //         breadcrumb: {
    //             parent: 'mission',
    //             label: 'Exécution de la mission'
    //         }
    //     }
    // },

    /**
     * Global
     */
    {
        path: '/global/details',
        name: 'global-details',
        component: page('global/details.vue'),
        meta: {
            breadcrumb: {
                label: 'Anomalie • Notation • Plan de redressement',
                parent: ''
            }
        }
    },
    {
        path: '/major-facts',
        name: 'major-facts',
        component: page('global/major_facts.vue'),
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
                label: 'Références PCF'
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
                label: 'Centre de notification'
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
