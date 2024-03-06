<!--This component needs to calculate the height of the text div and if its beyond a certain amount of pixels, it has to show 'read more'. The read more link leads to the full post.-->
<template>
  <div class="overflow-hidden">
    <div
      class="collapsable text note-editable w-full break-words rounded-t-xl to-transparent p-4 dark:bg-slate-600"
      ref="text"
      v-bind:class="{ 'rounded-xl': !showMore }"
    >
      <slot />
    </div>

    <div
      v-if="showMore"
      class="show-more sticky z-10 w-full cursor-pointer rounded-b-xl pt-4 text-center font-bold text-blue-400 hover:text-blue-600 dark:bg-gradient-to-t dark:from-slate-600 dark:to-slate-600/60"
      @click="changeText"
    >
      <button ref="button">Read more</button>
    </div>
  </div>
</template>

<script>
export default {
  props: ["post"],
  data() {
    return {
      showMore: false,
      expanded: false,
    };
  },
  methods: {
    changeText() {
      if (!this.expanded) {
        this.expandText();
      } else {
        this.retractText();
      }
    },
    expandText() {
      this.expanded = !this.expanded;
      this.$refs.text.classList.toggle("collapsed");
      this.$refs.button.textContent = "Read Less";
    },
    retractText() {
      this.expanded = !this.expanded;
      this.$refs.text.classList.toggle("collapsed");
      this.$refs.button.textContent = "Read More";
    },
  },
  mounted() {
    this.$nextTick(() => {
      console.log(this.$refs.text.clientHeight);

      if (this.$refs.text.clientHeight > 120) {
        this.showMore = true;
      }
    });
  },
};
</script>

<style scoped>
div.collapsable {
  max-height: 128px;
  transition: all 500ms ease;
}

div.collapsed {
  max-height: 2000px;
  height: fit-content;
  transition: all 1000ms ease;
}
</style>
