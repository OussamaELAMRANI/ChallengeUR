import {getToken} from '@/utils/auth'; // get token from cookie
import router from '@/routes';
import store from '@/store';

import NProgress from 'nprogress'; // progress bar
import 'nprogress/nprogress.css'; // progress bar style
NProgress.configure({showSpinner: false}); // NProgress Configuration

const whiteList = ['/login']; // no redirect whitelist

router.beforeEach(async (to, from, next) => {
        // start progress bar
        NProgress.start();
        // set page title
        document.title = to.meta.title;

        // Test Auth
        const hasToken = getToken();

        if (hasToken) {
            if (to.path === '/login') {
                // if is logged in, redirect to the home page
                next({path: '/shops'});
                NProgress.done();
            } else {
                // determine whether the user has obtained his permission roles through getInfo
                // && store.getters.roles.length > 0;
                const hasRoles = store.getters.user
                // console.log(hasRoles)
                if (hasRoles) {
                    next();
                } else {
                    store.dispatch('userInfos')
                        .then(infos => {

                            store.dispatch('generateRoutes', infos.role)
                                .then(accessRoutes => {
                                    // dynamically add accessible routes
                                    router.addRoutes(accessRoutes);
                                    next({...to, replace: true});
                                    NProgress.done();
                                }).catch(err => console.log(err))

                        }).catch(err => {
                        // remove token and go to login page to re-login
                        store.dispatch('resetToken')
                            .then(res => {
                                next('/login');
                                NProgress.done();
                            });
                    })
                }
            }
        } else {
            /* has no token*/
            if (whiteList.indexOf(to.path) !== -1) {
                // in the free login whitelist, go directly
                next();
            } else {
                // other pages that do not have permission to access are redirected to the login page.
                next('/login');
                NProgress.done();
            }
        }
    }
);

router.afterEach(() => {
    // finish progress bar
    NProgress.done();
});
