
const getters = {
    token: state => state.UserStore.token,
    name: state => state.UserStore.user.name,
    user: state => state.UserStore.user,
};
export default getters;
