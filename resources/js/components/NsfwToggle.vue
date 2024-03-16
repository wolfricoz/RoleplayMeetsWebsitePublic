<template>
  <select
    v-model="selectedOption"
    class="w-full rounded-xl dark:bg-gray-600 dark:text-gray-200"
    @change.prevent="changeNSFW"
  >
    <option
      v-for="option in post_types"
      :key="option"
      :value="option"
      :selected="option === selectedOption"
      v-if="option !== 'all'"
    >
      {{ option }}
    </option>
  </select>
  <a class="block pt-2 text-xs" ref="feedback" v-html="status_message"></a>
</template>

<script>
import axios from "axios";

export default {
  name: "nsfwtoggle",
  props: ["post", "post_types"],
  data() {
    return {
      nsfw: Boolean(this.post.nsfw),
      status_message: "",
      status_message_show: false,
      selectedOption: this.post.nsfw,
      option: null,
    };
  },
  methods: {
    changeNSFW() {
      let response = axios
        .post(`/posts/nsfw/${this.post.id}`, { nsfw: this.selectedOption })
        .then((response) => {
          this.showStatusMessage("NSFW status updated!");
          this.$refs.feedback.classList.add("text-green-600");
        })
        .catch((error) => {
          this.showStatusMessage("Error updating NSFW status!");
          this.$refs.feedback.classList.add("text-red-600");
          console.log(error);
        });
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
