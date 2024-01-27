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
    <span class="rounded-l-md bg-violet-400 px-4 peer-checked:bg-gray-400"
      >SFW</span
    >
    <span class="rounded-r-md bg-gray-400 px-4 peer-checked:bg-red-400"
      >NSFW</span
    >
  </label>
  <a class="block pt-2 text-xs" ref="feedback" v-html="status_message"></a>
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
      status_message: "",
      status_message_show: false,
    };
  },
  mounted() {},
  methods: {
    toggleNSFW() {
      let response = axios
        .post(`/posts/nsfw/${this.post.id}`, { post: this.post })
        .then((response) => {
          this.showStatusMessage("NSFW status updated!");
          this.$refs.feedback.classList.add("text-green-600");
        })
        .catch((error) => {
          this.nsfw = !this.nsfw;
          this.showStatusMessage("Error updating NSFW status!");
          this.$refs.feedback.classList.add("text-red-600");
          console.log(error);
        });
      console.log(this.nsfw);
    },
    showStatusMessage(message) {
      this.status_message = message;
      this.status_message_show = true;
      setTimeout(() => {
        this.status_message = "";
        this.status_message_show = false;
      }, 1000);
    },
  },
};
</script>
