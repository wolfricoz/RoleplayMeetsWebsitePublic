<script>
export default {
    name: "summernote",
    props: ['name', 'value', 'maxlength'],
    data() {
        return {
            charCount: 0
        }
    },
    mounted() {
        $('#summernote').summernote({
            height: 128,
            toolbar: [
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['forecolor', 'backcolor']],
                ['para', ['ul', 'ol']],
                ['para', ['ul', 'ol']],
                ['insert', ['link']],
                ['back', ['undo', 'redo']]
            ],
            shortcuts: false,
            disableDragAndDrop: true,
            codeviewFilter: false,
            codeviewIframeFilter: true,
            placeholder: this.value,
            callbacks: {
                onKeyup: (e) => {
                    let text = $('#summernote').summernote('code');
                    let plainText = text.replace(/<[^>]*>?/gm, ''); // remove HTML tags
                    if (plainText.length > this.maxlength) {
                        // If the text is longer than the limit, truncate it
                        plainText = plainText.substring(0, this.maxlength);
                        $('#summernote').summernote('code', plainText);
                    }
                    this.charCount = plainText.length;
                }

            }
        }).summernote('code', this.value);

    },

    beforeDestroy() {
        $('#summernote').summernote('destroy');
    }
}
</script>

<!--TODO: Add a character counter-->
<template>
    <div class="bg-white my-2">
        <textarea id="summernote" class="h-32" required v-bind:name="name">

        </textarea>
    </div>
    <div class="text-right text-xs text-gray-500">
        <span>{{ charCount }}</span> / {{maxlength}} characters
    </div>

</template>

<style scoped>

</style>
