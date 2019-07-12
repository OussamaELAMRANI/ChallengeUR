<template lang="pug">
    #register.container
        segment(title="Sign Up")
            .row.justify-content-center
                form.col-9(v-on:submit.prevent="save")
                    .form-group
                        label(for='fullname') Full name
                        input#fullname.form-control(type='text' name="fullname"  v-validate="'required'" v-model="user.name" placeholder='Full name ...')
                        small.form-text.text-danger {{errors.first('fullname')}}
                    .row
                        search-address(@getResult="getAddress")
                    hr
                    .form-group
                        label(for='email') Email address
                        input#email.form-control(type='email' name='email' v-validate="'required|email'" v-model="user.email"  placeholder='Enter email')
                        small.form-text.text-danger {{errors.first('email')}}
                    .row
                        .col-lg-6.col-12
                            .form-group
                                label(for='passwd') Password
                                input#passwd.form-control(type='password' v-validate="'required|min:6'" name="password" v-model="user.password" ref="password" placeholder='Password ...')
                                small.form-text.text-danger {{errors.first('password')}}
                        .col-lg-6.col-12
                            .form-group
                                label(for='password_2') Confirm your password
                                input#password_2.form-control(type='password' name="password_2" v-model="user.password_confirmation" v-validate="'required|confirmed:password'" placeholder=' Confirm your password ...')
                                small.form-text.text-danger {{errors.first('password_2')}}
                    .form-check
                    button.btn.btn-outline-primary.float-right(type='submit') Sign up now

</template>

<script>
    import Segment from "@/layout/Segment";
    import SearchAddress from "@/components/SearchAddress";
    import {mapActions} from 'vuex'

    export default {
        name: "SignUp",
        data() {
            return {
                address: {},
                status: 'ZERO_RESULTS',
                user: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                }
            }
        },
        methods: {
            getAddress(data) {
                let address, location = ''
                const {results, status} = data
                this.status = status

                _.forEach(results, (res) => {
                    address = res.formatted_address
                    location = res.geometry.location
                })
                this.address = {address, ...location}
            },
            save() {
                this.$validator.validateAll().then((isValid) => {
                    if (!isValid)
                        this.$notification.error('You should fill all fields')
                    else if (this.status === 'ZERO_RESULTS')
                        this.$notification.error('Your address is not valid !')

                    else {
                        this.sendUser()
                    }
                })
            },
            sendUser() {
                const newUser = {...this.user, ...this.address}
                this.SignUp(newUser)
                    .then(() => {
                        this.$notification.success("Saved successfully !");
                        this.$emit('switchUser')
                    })
                    .catch(err => {
                        this.$notification.error(err.response)
                    })
            },
            ...mapActions({SignUp: 'sign_up'}),

        },
        components: {SearchAddress, Segment}
    }
</script>

<style scoped>

</style>
