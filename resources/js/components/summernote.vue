<script>
    export default {
        name: "summernote",
        props: ['name'],
        mounted() {
            $('#summernote').summernote({
                height: 128,
            });
        },
        beforeDestroy() {
            $('#summernote').summernote('destroy');
        }
    }
</script>


<template>
    <div class="bg-white my-2">
        <textarea id="summernote" v-bind:name="name" class="h-32 "></textarea>
    </div>

</template>

<style scoped>

</style>
