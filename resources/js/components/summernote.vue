<script>
    export default {
        name: "summernote",
        props: ['name'],
        mounted() {
            $('#summernote').summernote({
                height: 128,
                toolbar: [
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['forecolor','backcolor']],
                    ['para', ['ul', 'ol']],
                    ['para', ['ul', 'ol']],
                    // ['table', ['table']],
                    ['insert', ['link']],
                    // ['view', ['fullscreen', 'codeview', 'help']],
                    ['back', ['undo', 'redo']]
                ],
                shortcuts: false,
                disableDragAndDrop: true,
                codeviewFilter: false,
                codeviewIframeFilter: true

            });
        },
        beforeDestroy() {
            $('#summernote').summernote('destroy');
        }
    }
</script>


<template>
    <div class="bg-white my-2">
        <textarea id="summernote" v-bind:name="name" class="h-32" required></textarea>
    </div>

</template>

<style scoped>

</style>
