<script >
export default {
    data() {
        return {
            showModal: false,
        }

    },
    props: ['values', 'title'],

}
</script>

<template>
    <button class="m-2.5 mx-0.5 text-sm bg-transparent  text-gray-700 font-semibold hover:text-white py-1 px-2 border border-gray-500
            hover:border-transparent hover:bg-indigo-900 rounded cursor-pointer whitespace-nowrap" v-on:click="showModal = !showModal">Create new role</button>

<div class="z-50 inset-0 justify-center" v-bind:class="{ 'hidden': !showModal, 'fixed': showModal }">
    <div class="absolute inset-0 bg-gray-300 w-1/3 h-fit mx-auto mt-10 rounded-xl p-5" >
        <div class="flex justify-end">
            <div class="border border-black rounded-full px-2 hover:bg-indigo-800 cursor-pointer" @click="showModal = !showModal">
                X
            </div>
        </div>
        <h1 class="text-xl font-bold border-b border-gray-400 mb-2" v-html="title"></h1>
        <slot></slot>

    </div>

</div>
</template>

<style scoped>

</style>
