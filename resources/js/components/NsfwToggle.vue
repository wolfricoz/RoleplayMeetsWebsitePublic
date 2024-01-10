<template>
    <label :for="post.id" class="inline-flex items-center rounded-md cursor-pointer dark:text-gray-800">
        <input :id="post.id" type="checkbox" class="hidden peer" @click="toggleNSFW" v-model="nsfw" ref="checkbox">
        <span class="px-4  rounded-l-md dark:bg-violet-400 peer-checked:dark:bg-gray-300">SFW</span>
        <span class="px-4 rounded-r-md dark:bg-gray-300 peer-checked:dark:bg-red-400">NSFW</span>
    </label>
    <span class="text-sm pt-2" ref="feedback"></span>
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
import axios from 'axios';

export default {
    name: 'nsfwtoggle',
    props: ['post'],
    data() {
        return {
            nsfw: Boolean(this.post.nsfw),
        }
    },
    mounted() {
    },
    methods: {
        toggleNSFW() {
            let response = axios.post(`/posts/nsfw/${this.post.id}`, {post: this.post}).then(response => {
                this.$refs.feedback.textContent = "NSFW status updated!";
                this.$refs.feedback.classList.add("text-green-600");
            }).catch(error => {
                this.nsfw = !this.nsfw;
                this.$refs.feedback.textContent = "Something went wrong!";
                this.$refs.feedback.classList.add("text-red-600");
                console.log(error);
            });
            console.log(this.nsfw);
        }
    }
}
</script>
