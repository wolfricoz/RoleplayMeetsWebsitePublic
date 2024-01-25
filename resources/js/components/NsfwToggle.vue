<template>
    <label
        :for="post.id"
        class="inline-flex cursor-pointer items-center rounded-md dark:text-gray-800"
    >
        <input
            :id="post.id"
            type="checkbox"
            class="peer hidden"
            @click="toggleNSFW"
            v-model="nsfw"
            ref="checkbox"
        />
        <span
            class="rounded-l-md px-4 bg-violet-400 peer-checked:bg-gray-400"
            >SFW</span
        >
        <span
            class="rounded-r-md px-4 bg-gray-400 peer-checked:bg-red-400"
            >NSFW</span
        >
    </label>
    <a class="block pt-2 text-xs" ref="feedback" ></a>
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
import axios from "axios";

export default {
    name: "nsfwtoggle",
    props: ["post"],
    data() {
        return {
            nsfw: Boolean(this.post.nsfw),
        };
    },
    mounted() {},
    methods: {
        toggleNSFW() {
            let response = axios
                .post(`/posts/nsfw/${this.post.id}`, { post: this.post })
                .then((response) => {
                    this.$refs.feedback.textContent = "NSFW status updated!";
                    setTimeout(() => {
                        this.$refs.feedback.textContent = "";
                    }, 1000);
                    this.$refs.feedback.classList.add("text-green-600");
                })
                .catch((error) => {
                    this.nsfw = !this.nsfw;
                    this.$refs.feedback.textContent = "Something went wrong!";
                    this.$refs.feedback.classList.add("text-red-600");
                    console.log(error);
                });
            console.log(this.nsfw);
        },
    },

};
</script>
