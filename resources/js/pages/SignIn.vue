<template lang="pug">
    #log-in.container
        segment(title="Sign in")
            .row.justify-content-center
                form.col-9(v-on:submit.prevent="login")
                    .form-group
                        label(for='email') Email address
                        input#email.form-control(type='email' name='email' v-validate="'required|email'" v-model="user.email"  placeholder='Enter email')
                        small.form-text.text-danger {{errors.first('email')}}
                    .form-group
                        label(for='passwd') Password
                        input#passwd.form-control(type='password' v-validate="'required|min:6'" name="password" v-model="user.password" ref="password" placeholder='Password ...')
                        small.form-text.text-danger {{errors.first('password')}}
                    .form-check
                        .form-group.form-check
                            input#exampleCheck1.form-check-input(type='checkbox' v-model="user.remember_me")
                            label.form-check-label(for='exampleCheck1') Check me out
                    .row
                        .alert.alert-danger(v-if="errorConnection") {{errorConnection}}
                    button.btn.btn-fluid.btn-outline-primary.btn-block(type='submit') Sign up now

</template>

<script>
    import Segment from "@/layout/Segment";
    import {mapActions} from 'vuex'

    export default {
        name: "SignIn",
        data() {
            return {
                user: {
                    email: '',
                    password: '',
                    remember_me: true
                },
                errorConnection: null
            }
        },
        methods: {
            login() {
                this.signIn(this.user)
                    .then(() => {
                        this.$notification.success("is Connected !");

                        this.$router.push('/login')
                    })
                    .catch(err => {
                        console.log(err)
                        this.errorConnection = "Imposible de se connecter, votre mot de passe ou username est incorrect !"
                    })
            },
            ...mapActions({signIn: 'login'}),
        },
        components: {Segment}
    }
</script>

<style scoped>

</style>
