import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

export const asyncRoutes = [
    {
        path: '/shops',
        redirect: '/shops/nearby',
        component: () => import("@/pages/Shops/Shops"),

        children: [
            {
                path: 'nearby',
                name: 'nearby',
                component: () => import("@/pages/Shops/NearbyShops"),
                meta: {
                    title: 'Nearby Shops', icon: 'fa fa-map-marker'
                },
                hidden: false,
            },
            {
                path: 'favorite',
                name: 'favorite',
                component: () => import("@/pages/Shops/FavoriteShops"),
                meta: {
                    title: 'My Preferred Shops', icon: 'fa fa-heart'
                },
                hidden: false,
            },
        ],
    },

    {path: '*', redirect: '/404', hidden: true},
]

export const constantRoutes = [
    {
        path: '/',
        hidden: true,
        redirect: '/login'
    },
    {
        path: '/login',
        component: () => import("@/pages/Auth/UserAuth"),
        meta: {
            title: 'Login', icon: 'fa fa-heart'
        },
        hidden: true,
    },
    {
        path: '/404',
        hidden: true,
        name: 'notFound',
        meta: {
            title: 'Not Found | Error', icon: 'fa fa-heart'
        },
        component: () => import('@/pages/Errors/NotFound'),
    },
    // ...asyncRoutes
];

const createRouter = () => new Router({
    mode: 'history', // require service support
    scrollBehavior: () => ({y: 0}),
    routes: constantRoutes,
});

const router = createRouter();

// Detail see: https://github.com/vuejs/vue-router/issues/1234#issuecomment-357941465
export function resetRouter() {
    const newRouter = createRouter();
    router.matcher = newRouter.matcher; // reset router
}

export default router;
