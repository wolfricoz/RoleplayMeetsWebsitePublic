<script >
export default {
    data() {
        return {
            showModal: false,
        }
    },
}
</script>

<template>
    <button v-on:click="showModal = !showModal">test</button>

<div class="inset-0  justify-center" v-bind:class="{ 'hidden': !showModal, 'fixed': showModal }">
    test
</div>
</template>

<style scoped>

</style>
