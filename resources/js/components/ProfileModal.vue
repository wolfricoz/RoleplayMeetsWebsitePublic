<script>
export default {
  data() {
    return {
      showModal: false,
    };
  },
  props: ["user", "image", "posts"],
};
</script>

<template>
  <a v-on:click="showModal = !showModal">
    <slot></slot>
  </a>

  <div
    class="inset-0 z-50 justify-center"
    v-bind:class="{ hidden: !showModal, fixed: showModal }"
  >
    <div
      class="absolute inset-0 mx-auto mt-10 h-fit w-1/3 rounded-xl bg-gray-300 p-5"
    >
      <div class="flex justify-end">
        <div
          class="cursor-pointer rounded-full border border-black px-2 hover:bg-indigo-800"
          @click="showModal = !showModal"
        >
          X
        </div>
      </div>
      <img :src="image" class="mx-auto mb-2 w-1/3" />
      <h1
        class="mb-2 border-b border-gray-400 text-center text-xl font-bold"
        v-html="user.global_name"
      ></h1>
      <article>
        <p>Username: {{ user.username }}</p>
        <p>Verified: {{ user.verified }}</p>
        <p>posts: {{ posts }}</p>
        <p>
          Created:
          {{ new Date(Date.parse(this.user.created_at)).toUTCString() }}
        </p>
      </article>
    </div>
  </div>
</template>

<style scoped></style>
