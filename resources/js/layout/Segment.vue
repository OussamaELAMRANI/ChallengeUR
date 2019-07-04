<template lang="pug">
    .segment
        h3.head.text-center.text-uppercase {{title}}
        hr.mb-4
        slot
</template>

<script>
    export default {
        name: "Segment",
        props: ['title']
    }
</script>

<style lang="scss" scoped>
    .segment {
        position: relative;
        background: #fff;
        margin: 1rem 0;
        padding: 1em 1em;
        border-radius: .28571429rem;
        border: 1px solid rgba(34, 36, 38, .15);
        box-shadow: 0 2px 4px 0 rgba(34, 36, 38, .12), 0 2px 10px 0 rgba(34, 36, 38, .15);

        & > .header {
            border: none;
            margin: calc(2rem - .14285714em) 0 1rem;
            padding: 0 0;
            font-family: Lato, 'Helvetica Neue', Arial, Helvetica, sans-serif;
            font-weight: 700;
            line-height: 1.28571429em;
            text-transform: none;
            color: rgba(0, 0, 0, .87);
        }
    }


</style>
