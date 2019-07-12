<template lang="pug">
    #shops
        top-bar
        router-view
</template>

<script>
    import TopBar from "@/components/TopBar";

    export default {
        name: "Shops",
        components: {TopBar}
    }
</script>

<style scoped>

</style>
