<template lang="pug">
    #FavoriteShops.container
        store-base(title="My favorite Shops", type="favorite")

</template>

<script>
    import StoreBase from "@/layout/StoreBase";
    export default {
        name: "FavoriteShops",
        components: {StoreBase}
    }
</script>

<style scoped>

</style>
