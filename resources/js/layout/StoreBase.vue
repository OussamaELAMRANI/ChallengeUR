<template lang="pug">
    #stores
        h2 {{title}}
        hr
        .row
            .col-12(v-if="stores === null")
                loading-page(:size="100")
            .col-3.mb-4(v-for="store in stores" v-else)
                shop( :title="store.title" :url="store.image" :type="type" :id="store.id" @onAction="getEvent")
</template>

<script>
    import LoadingPage from "@/components/LoadingPage";
    import Shop from "@/pages/Shops/Shop";

    export default {
        name: "StoreBase",
        props: {
            title: {
                default: 'ALL NEARBY STORES'
            },
            type: {
                default: 'nearby'
            }
        },
        data() {
            return {
                stores: null
            }
        },
        mounted() {
            axios.get(`/api/stores/${this.type}`)
                .then(({data}) => {
                    this.stores = data
                })
        },
        methods: {
            getEvent(id) {
                const shops = _.filter(this.stores, (shop) => shop.id !== id)
                this.stores = shops

            }
        },
        components: {LoadingPage, Shop}

    }
</script>

<style scoped>

</style>
