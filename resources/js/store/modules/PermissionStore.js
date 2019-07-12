import {asyncRoutes, constantRoutes} from '@/routes';

const state = {
    routes: [],
    addRoutes: [],
};

const mutations = {
    SET_ROUTES: (state, routes) => {
        state.addRoutes = routes;
        state.routes = constantRoutes.concat(routes);
    },
};

const actions = {

    generateRoutes({commit}, role) {

        return new Promise(resolve => {
                let accessedRoutes;

                if (role === 'user')
                    accessedRoutes = asyncRoutes;
                else
                    accessedRoutes = []

                commit('SET_ROUTES', accessedRoutes);

                resolve(accessedRoutes);
            }
        );
    },
};

export default {
    // namespaced: true,
    state,
    mutations,
    actions,
}
