const getters = {
    token: state => state.userStore.token,
    user: state => state.userStore.user,

    permission_routes: state => state.permissionStore.routes,
    addRoutes: state => state.permissionStore.addRoutes,
};
export default getters;
