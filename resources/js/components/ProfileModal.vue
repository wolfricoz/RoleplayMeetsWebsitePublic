<script>
export default {
    data() {
        return {
            showModal: false,

        }

    },
    props: ['user', 'image', 'posts'],

}
</script>

<template>
    <a v-on:click="showModal = !showModal">
        <slot></slot>
    </a>

    <div class="z-50 inset-0 justify-center" v-bind:class="{ 'hidden': !showModal, 'fixed': showModal }">
        <div class="absolute inset-0 bg-gray-300 w-1/3 h-fit mx-auto mt-10 rounded-xl p-5">
            <div class="flex justify-end">
                <div class="border border-black rounded-full px-2 hover:bg-indigo-800 cursor-pointer"
                     @click="showModal = !showModal">
                    X
                </div>
            </div>
            <img :src="image" class="w-1/3 mx-auto mb-2"/>
            <h1 class="text-xl font-bold border-b border-gray-400 mb-2 text-center" v-html="user.global_name"></h1>
            <article>
                <p>Username: {{ user.username }}</p>
                <p>Verified: {{ user.verified }}</p>
                <p>posts: {{ posts }}</p>
                <p>Created: {{ new Date(Date.parse(this.user.created_at)).toUTCString()}}</p>
            </article>


        </div>

    </div>
</template>

<style scoped>

</style>
