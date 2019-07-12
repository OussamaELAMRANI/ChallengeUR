<template lang="pug">
    nav.navbar.navbar-expand-lg.navbar-dark.bg-dark.mb-4
        a.navbar-brand.text-white Challenge UR />

        button.navbar-toggler.ml-auto(type='button' data-toggle='collapse' data-target='#collapseBar' aria-controls='collapseBar' aria-expanded='false' aria-label='Toggle navigation')
            span.navbar-toggler-icon
        #collapseBar.collapse.navbar-collapse
            hr
            ul.navbar-nav.ml-auto.text-center
                li.nav-item(v-for="link in links" )
                    router-link.nav-link(:to="{name:link.name}" active-class="active") {{link.meta.title}}
                li.nav-item
                    a.nav-link(href='#' @click="logout") log out

</template>

<script>
    import {mapActions} from 'vuex'
    import store from '@/store'

    export default {
        name: "TopBar",
        data() {
            return {
                menu: []
            }
        },
        created() {
            this.menu = store.getters.permission_routes
        },
        computed: {
            links() {
                let links = []
                const r = _.filter(this.menu, route => !route.hidden)
                _.forEach(r, route => {
                    if (!route.hidden) links.push(...route.children)
                })
                return links
            }
        },
        methods: {
            logout() {
                this.logOut()
                    .then(() => {
                        this.$router.push('/login')
                    }).catch(err => console.log(err))
            },
            ...mapActions({logOut: 'logout'}),
        }
    }
</script>

<style scoped>

</style>
