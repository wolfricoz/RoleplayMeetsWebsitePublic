<script>
export default {
  name: "summernote",
  props: {
    name: {
      type: String,
      required: true,
    },
    value: {
      type: String,
      default: "",
    },
    maxlength: {
      type: Number,
      default: 1000,
    },
    id: {
      type: String,
      default: "summernote",
    },
  },
  data() {
    return {
      charCount: 0,
    };
  },
  mounted() {
    $(`#${this.id}`)
      .summernote({
        height: 128,
        toolbar: [
          ["font", ["bold", "underline", "clear"]],
          ["fontname", ["fontname"]],
          ["fontsize", ["fontsize"]],
          ["color", ["forecolor", "backcolor"]],
          ["para", ["ul", "ol"]],
          ["para", ["ul", "ol"]],
          ["insert", ["link"]],
          ["back", ["undo", "redo"]],
        ],
        shortcuts: false,
        disableDragAndDrop: true,
        codeviewFilter: false,
        codeviewIframeFilter: true,
        placeholder: this.value,
        callbacks: {
          onKeyup: (e) => {
            let text = $("#summernote").summernote("code");
            let plainText = text.replace(/<[^>]*>?/gm, ""); // remove HTML tags
            if (plainText.length > this.maxlength) {
              // If the text is longer than the limit, truncate it
              plainText = text.substring(0, this.maxlength);
              $("#summernote").summernote("code", plainText);
            }
            this.charCount = plainText.length;
          },
        },
      })
      .summernote("code", this.value);
  },

  beforeDestroy() {
    $(".summernote").summernote("destroy");
  },
};
</script>

<!--TODO: Add a character counter-->
<template>
  <div class="my-2 bg-white">
    <textarea :id="id" class="h-32" v-bind:name="name"> </textarea>
  </div>
  <div class="text-right text-xs text-gray-500">
    <span>{{ charCount }}</span> / {{ maxlength }} characters
  </div>
</template>

<style scoped></style>
