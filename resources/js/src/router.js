/*=========================================================================================
  File Name: router.js
  Description: Routes for vue-router. Lazy loading is enabled.
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


import Vue from 'vue'
import Router from 'vue-router'
import store from './store/store';
import Ls from '@/services/ls'

Vue.use(Router)

const router = new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    scrollBehavior() {
        return {
            x: 0,
            y: 0
        }
    },
    routes: [
        // =============================================================================
        // Auth pages
        // =============================================================================
        {
            path: '/',
            component: () =>
                import ('@/layouts/full-page/FullPage.vue'),
            meta: {
                redirectIfAuthenticated: true
            },
            children: [
                // {
                //     path: '/',
                //     name: 'web.init',
                //     meta: {
                //         rule: 'public'
                //     },
                //     beforeEnter() {
                //         location.href = process.env.MIX_APP_URL
                //     }
                // },
                // =============================================================================
                // PAGES
                // =============================================================================
                {
                    path: '/login',
                    name: 'auth.login',
                    meta: {
                        rule: 'public'
                    },
                    component: () =>
                        import ('./views/auth/Login.vue')
                },
                {
                    path: '/register',
                    name: 'auth.register',
                    meta: {
                        rule: 'public'
                    },
                    component: () =>
                        import ('./views/auth/Register.vue')
                },
                {
                    path: '/tienda/nueva',
                    name: 'auth.nueva',
                    meta: {
                        rule: 'public',
                        pageTitle: 'Nuevo comercio'
                    },
                    component: () =>
                        import ('./views/auth/NewCompany.vue')
                },
                {
                    path: '/user/verify',
                    name: 'auth.verify',
                    meta: {
                        rule: 'public',
                        pageTitle: 'Verifica usuario'
                    },
                    component: () =>
                        import ('./views/auth/VerifyEmail.vue')
                },
                {
                    path: '/email/verify',
                    name: 'email.verify',
                    meta: {
                        rule: 'public',
                        pageTitle: 'Usuario verificado'
                    },
                    component: () =>
                        import ('./views/auth/VerifyEmail.vue')
                },
                {
                    path: '/error',
                    name: 'page-error-404',
                    component: () =>
                        import ('@/views/pages/Error404.vue')
                },
                {
                    path: '/pages/not-authorized',
                    name: 'page-not-authorized',
                    component: () =>
                        import ('@/views/pages/NotAuthorized.vue'),
                    meta: {
                        rule: 'Empresa'
                    }
                },
            ]
        },
        {
            // =============================================================================
            // MAIN LAYOUT ROUTES
            // =============================================================================
            path: '/company',
            component: () =>
                import ('./layouts/main/Main.vue'),
            meta: {
                requiresAuth: true
            },
            children: [
                // =============================================================================
                // Theme Routes
                // =============================================================================
                {
                    path: 'home',
                    name: 'company.home',
                    meta: {
                        rule: 'Comun'
                    },
                    component: () =>
                        import ('./views/Home.vue')
                },
                {
                    path: 'pedidos',
                    name: 'company.orders',
                    meta: {
                        rule: 'Empresa'
                    },
                    component: () =>
                        import ('./views/products/Products.vue')
                },
                // {
                //     path: 'products',
                //     name: 'company.products',
                //     meta: {
                //         rule: 'Empresa'
                //     },
                //     component: () =>
                //         import ('./views/categories/Categories.vue')
                // },
                {
                    path: 'products',
                    name: '',
                    meta: {
                        rule: 'Admin'
                    },
                    component: () =>
                        import ('./views/companies/CompanyMain.vue'),
                    children: [{
                            path: '',
                            name: 'company.products',
                            component: () =>
                                import ('./views/categories/Categories.vue')
                        },
                        {
                            path: 'subcategory/:id',
                            props: true,
                            name: 'company.categories.subcategory',
                            component: () =>
                                import ('./views/categories/Products.vue')
                        }, {
                            path: 'subcategory/:id/all',
                            props: true,
                            name: 'company.categories.subcategory.all',
                            component: () =>
                                import ('./views/categories/ProductsAll.vue')
                        }
                    ]

                },
                {
                    path: 'clients',
                    name: 'company.clients',
                    meta: {
                        rule: 'Empresa'
                    },
                    component: () =>
                        import ('./views/clients/Clients.vue')
                },
                {
                    path: '/help',
                    name: 'company.help',
                    meta: {
                        rule: 'Empresa'
                    },
                    component: () =>
                        import ('./views/help/Help.vue')
                },
                {
                    path: 'configurations',
                    name: 'company.configurations',
                    meta: {
                        rule: 'Empresa'
                    },
                    component: () =>
                        import ('./views/configurations/Configurations.vue')
                },
            ],
        },
        {
            // =============================================================================
            // MAIN LAYOUT ROUTES
            // =============================================================================
            path: '/admin',
            component: () =>
                import ('./layouts/main/Main.vue'),
            meta: {
                requiresAuth: true
            },
            children: [{
                    path: 'companies',
                    // name: 'admin.companies',
                    meta: {
                        rule: 'Empresa'
                    },
                    component: () =>
                        import ('./views/companies/CompanyMain.vue'),
                    children: [{
                        path: '',
                        name: 'admin.companies.list',
                        meta: {
                            rule: 'Empresa'
                        },
                        component: () =>
                            import ('./views/companies/Companies.vue')
                    }, {
                        path: 'details/:id',
                        props: true,
                        name: 'admin.companies.details',
                        meta: {
                            rule: 'Empresa'
                        },
                        component: () =>
                            import ('./views/companies/CompanyDetail.vue')
                    }]
                },
                {
                    path: 'users',
                    // name: 'admin.users',
                    meta: {
                        rule: 'Empresa'
                    },
                    component: () =>
                        import ('./views/companies/CompanyMain.vue'),
                    children: [{
                            path: '',
                            name: 'admin.users.list',
                            component: () =>
                                import ('./views/users/Users.vue')
                        },
                        {
                            path: ':id',
                            props: true,
                            name: 'admin.users.view',
                            component: () =>
                                import ('./views/users/UserView.vue')
                        }
                    ]
                },
                {
                    path: 'categories',
                    name: '',
                    meta: {
                        rule: 'Admin'
                    },
                    component: () =>
                        import ('./views/companies/CompanyMain.vue'),
                    children: [{
                            path: '',
                            name: 'admin.categories',
                            component: () =>
                                import ('./views/categories/Categories.vue')
                        },
                        {
                            path: 'subcategory/:id',
                            props: true,
                            name: 'admin.categories.subcategory',
                            component: () =>
                                import ('./views/categories/Products.vue')
                        }, {
                            path: 'subcategory/:id/all',
                            props: true,
                            name: 'admin.categories.subcategory.all',
                            component: () =>
                                import ('./views/categories/ProductsAll.vue')
                        }
                    ]

                },

            ]
        },
        {
            path: '/wizard',
            component: () =>
                import ('@/layouts/full-page/FullPage.vue'),
            meta: {
                requiresAuth: true
            },
            children: [
                // =============================================================================
                // PAGES
                // =============================================================================
                {
                    path: 'company',
                    name: 'wizard.company',
                    meta: {
                        rule: 'Comercio'
                    },
                    component: () =>
                        import ('./views/wizard/Company.vue')
                }
            ]
        },
        {
            path: '/home',
            component: () =>
                import ('@/layouts/main/Main.vue'),
            meta: {
                requiresAuth: true
            },
            children: [
                // =============================================================================
                // PAGES
                // =============================================================================
                {
                    path: '',
                    name: 'user.home',
                    meta: {
                        rule: 'Usuario'
                    },
                    component: () =>
                        import ('./views/home/User.vue')
                }
            ]
        },
        {
            path: '/shopping-client/:_type',
            meta: {
                requiresAuth: false
            },
            component: () =>
                import ('./views/companies/CompanyMain.vue'),
            children: [{
                    path: '',
                    props: true,
                    name: 'shop.products',
                    component: () =>
                        import ('./views/categories/Categories.vue')
                },
                {
                    path: 'subcategory/:id',
                    props: true,
                    name: 'shop.categories.subcategory',
                    component: () =>
                        import ('./views/categories/Products.vue')
                }, {
                    path: 'subcategory/:id/all',
                    props: true,
                    name: 'shop.categories.subcategory.all',
                    component: () =>
                        import ('./views/categories/ProductsAll.vue')
                }
            ]
        },
        {
            path: '/shopping-list',
            component: () =>
                import ('./views/shopping-car/ListShoppingCar.vue'),
            meta: {
                requiresAuth: false
            },
            children: []
        },
        {
            path: '/profile',
            component: () =>
                import ('@/layouts/main/Main.vue'),
            meta: {
                requiresAuth: true
            },
            children: [
                // =============================================================================
                // PAGES
                // =============================================================================
                {
                    path: '',
                    name: 'profile',
                    meta: {
                        rule: 'Usuario'
                    },
                    component: () =>
                        import ('./views/profile/Profile.vue')
                }
            ]
        },
        // Redirect to 404 page, if no match found
        {
            path: '*',
            redirect: '/error'
        }
    ],
})

router.beforeEach((to, from, next) => {
    //  Redirect if not authenticated on secured routes
    if (to.matched.some(m => m.meta.requiresAuth)) {
        if (!store.getters['auth/isAuthenticated']) {
            return next('/')
        }
    }

    if (to.matched.some(m => m.meta.redirectIfAuthenticated) && store.getters['auth/isAuthenticated']) {

        if (store.getters['auth/getRol'] == 'SuperAdministrador') {
            // if (from.name);
            // return next('/admin/companies');
        }
        return next()
            // return next('/company/home')
    }

    return next()
})

router.afterEach(() => {
    // Remove initial loading
    const appLoading = document.getElementById('loading-bg')
    if (appLoading) {
        appLoading.style.display = "none";
    }
})

export default router