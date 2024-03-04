<template>
  <div class="w-full rounded-xl">
    <label
      class="mb-2 block text-sm font-bold tracking-wide"
      for="grid-state"
      v-html="title"
    >
    </label>
    <input type="hidden" :value="selected_values" name="permissions" />
    <Multiselect
      class="text-blue-600 border-none dark:bg-zinc-800"
      v-model="selected_values"
      mode="tags"
      :close-on-select="false"
      :allow-absent="true"
      :searchable="true"
      :resolve-on-load="false"
      :delay="0"
      :min-chars="1"
      :options="options"

    />
  </div>
</template>

<script>
import Multiselect from "@vueform/multiselect";
import 'tailwindcss/tailwind.css'
export default {
  components: {
    Multiselect,
  },
  props: ["values", "selected", "title"],
  beforeMount() {
    if (this.values != null) {
      for (let i = 0; i < this.values.length; i++) {
        this.options.push(this.values[i].name);
      }
    }
    if (this.selected != null) {
      for (let i = 0; i < this.selected.length; i++) {
        if (this.selected[i].name != null) {
          this.selected_values.push(this.selected[i].name);
        }
      }
    }
  },
  mounted() {},
  data() {
    return {
      selected_values: [],
      options: [],
    };
  },
};
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
