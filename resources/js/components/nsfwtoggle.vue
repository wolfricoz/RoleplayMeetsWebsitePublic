<template>
    <label :for="post.id" class="inline-flex items-center rounded-md cursor-pointer dark:text-gray-800">
        <input :id="post.id" type="checkbox" class="hidden peer" @click="toggleNSFW" v-model="nsfw">
        <span class="px-4  rounded-l-md dark:bg-violet-400 peer-checked:dark:bg-gray-300">SFW</span>
        <span class="px-4 rounded-r-md dark:bg-gray-300 peer-checked:dark:bg-red-400">NSFW</span>
    </label>
</template>


<style scoped>
input:checked {
    background-color: #22c55e; /* bg-green-500 */
}

input:checked ~ span:last-child {
    --tw-translate-x: 1.75rem; /* translate-x-7 */
}
</style>
<script>
import {router} from "@inertiajs/vue3"

export default {
    name: 'nsfwtoggle',
    props: ['post'],
    data() {
        return {
            nsfw: Boolean(this.post.nsfw)
        }
    },
    mounted() {
        console.log(this.post.nsfw)
    },
    methods: {
        // TODO: Fix the pop up of a modal, it should not do that and just alter the nsfw status.
        toggleNSFW() {
            throw router.post(`/admin/nsfw/${this.post.id}`, {post: this.post});

        }
    }
}
</script>
