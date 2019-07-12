<template lang="pug">
    .card.text-center(:id="id")
        .card-header {{title}}
        img.card-img-top(:src='url' alt='Card image cap')
        .card-footer
            template(v-if="type==='nearby'")
                button.btn.btn-danger.btn-sm.mr-2(type='submit' @click="likeIt(id,0)") DISLIKE
                button.btn.btn-success.btn-sm(type='submit' @click="likeIt(id,1)") LIKE
            template(v-else)
                button.btn.btn-danger.btn-sm.btn-secondary(type='button' @click="deleteIt(id)") REMOVE


</template>

<script>
    export default {
        name: "Shop",
        props: ['title', 'url', 'type', 'id'],
        methods: {
            likeIt(shopId, isLiked) {
                axios.post('/api/stores/like', {shopId, isLiked})
                    .then(({data}) => {
                        console.log(data)
                        this.$emit('onAction', shopId)
                    })
                    .catch(err => console.log(err.response))
            },
            deleteIt(shopId) {
                axios.delete('/api/stores', {data: {shopId}})
                    .then(({data}) => {
                        console.log(data)
                        this.$emit('onAction', shopId)

                    })
                    .catch(err => console.log(err.response))
            }
        }
    }
</script>

<style scoped>

</style>
