<script>
export default {
  data() {
    return {
      dropdown: false,
      dropdownid: "",
      position: { x: 0, y: 0 },
    };
  },
  methods: {
    showDropdown(event, postId) {
      this.dropdown = !this.dropdown;
      const postElement = document.getElementById(postId.toString());
      const postPosition = postElement.getBoundingClientRect();
      const dropdownElement = document.getElementById(this.dropdownid);
      const dropdownWidth = dropdownElement.offsetWidth;
      const dropdownHeight = dropdownElement.offsetHeight;
      const viewportWidth = window.innerWidth;
      const viewportHeight = window.innerHeight;
      console.log(postPosition.left + dropdownWidth > viewportWidth);
      // Adjust the x position if the dropdown goes off the right edge of the viewport
      if (postPosition.left + dropdownWidth > viewportWidth) {
        console.log("x position");
        this.position.x = viewportWidth - dropdownWidth;
      } else {
        this.position.x = postPosition.left - 120;
      }

      // Adjust the y position if the dropdown goes off the bottom edge of the viewport
      if (postPosition.top + dropdownHeight > viewportHeight) {
        console.log("y position");
        this.position.y = viewportHeight - dropdownHeight;
      } else {
        this.position.y = postPosition.top;
      }
    },
  },
  props: ["post"],
  mounted() {
    this.dropdownid = "dropdown" + this.post.id;
  },
};
</script>

<template>
  <div class="p-1" @mouseleave="dropdown = false" @scroll="dropdown = false">
    <a
      title="See more options"
      class="cursor-pointer rounded-full p-1 px-2 tracking-tighter transition-all hover:bg-gray-300 hover:tracking-normal hover:text-indigo-900 focus:tracking-normal"
      @click="showDropdown($event, dropdownid)"
    >
      •••
    </a>
    <div :id="dropdownid" x-cloak>
      <div
        class="fixed z-50 flex w-40 flex-col rounded-xl bg-gray-300 dark:bg-zinc-800 dark:text-gray-200"
        v-show="dropdown"
        :style="{ left: `${position.x}px`, top: `${position.y}px` }"
      >
        <slot></slot>
      </div>
    </div>
  </div>
</template>

<style scoped></style>
