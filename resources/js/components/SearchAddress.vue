<template lang="pug">
    #search_address.col-12
        .input-group.mb-2
            input.form-control.mr-sm-2(type='search' v-model="address" name="search" placeholder='Your address, city, ...' aria-label='Search'  v-validate="'required'" v-on:change="search")
            .input-group-append
                button.btn.btn-outline-success.my-2.my-sm-0(type='button' @click="search") Search now
        small.form-text.text-danger {{errors.first('search')}}

        .detail-search.mb-2(v-if="result!==null")
            loading-page(v-if="isLoading")
            .card(v-else)
                .card-header.text-center {{result.status === 'ZERO_RESULTS' ? 'Address not found !' : 'Result of your search'}}
                ul.list-group.list-group-flush(v-for=" (res,index) in result.results" :key="'key_'+index")
                    li.list-group-item
                        strong ADDRESS :
                        | {{res.formatted_address}}
                    li.list-group-item
                        strong Latitude :
                        | {{res.geometry.location.lat}}
                    li.list-group-item
                        strong Longitude :
                        | {{res.geometry.location.lng}}

</template>

<script>

    import LoadingPage from "@/components/LoadingPage";
    import axios from 'axios'

    export default {
        name: "SearchAddress",
        data() {
            return {
                result: null,
                address: '',
                key: 'AIzaSyA8b6efViAF0tBMjcMv4G1WxnvZ5fFCIPg',
                isLoading: false,
            }
        },
        methods: {
            search() {
                this.isLoading = true;
                // Empty the axios headers
                const go = axios.create();
                go.defaults.headers = {};

                go.get(`https://maps.googleapis.com/maps/api/geocode/json`,
                    {
                        params: {
                            key: this.key,
                            address: this.address
                        }
                    })
                    .then(({data}) => {
                        this.isLoading = false;
                        this.result = data
                        this.$emit('getResult', data)
                    })
                    .catch(err => {
                        this.isLoading = false;
                        console.log(err.response)
                    })
            }
        },
        components: {
            LoadingPage
        }
    }
</script>

<style scoped>
    #search_address {
        margin-bottom: 1.23em;
    }
</style>
