<template lang="pug">
    #loading_page
        half-circle-spinner(color="#f83896", :size="30")
</template>

<script>
    import {HalfCircleSpinner} from "epic-spinners";

    export default {
        name: "LoadingPage",
        components: {HalfCircleSpinner}
    }
</script>

<style scoped>
    #loading_page {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: .25rem;
        padding: .25rem;
    }
</style>
