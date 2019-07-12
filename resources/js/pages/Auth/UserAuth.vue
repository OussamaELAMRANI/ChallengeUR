<template lang="pug">
    #auth-users
        sign-in(v-show='isMember')
        sign-up(@switchUser='switchLogin' v-show="!isMember")
        .text-center.pt-5
            button.txt2.btn.btn-link(type='button' v-if='!isMember' @click='isMember= !isMember')
                | I have an account
                i.fa.fa-user.ml-5(aria-hidden='true')
            button.txt2.btn.btn-link(type='button' v-else @click='isMember= !isMember')
                | Create new account
                i.fa.fa-address-card.ml-5(aria-hidden='true')
</template>

<script>
    import SignIn from "@/pages/SignIn";
    import SignUp from "@/pages/SignUp";

    export default {
        name: "UserAuth",
        data() {
            return {
                isMember: true,
            }
        },
        methods: {
            switchLogin() {
                this.isMember = true
            },
        },
        components: {SignUp, SignIn},

    }
</script>

<style scoped>

</style>
