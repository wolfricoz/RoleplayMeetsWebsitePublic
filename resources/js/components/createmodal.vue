<script>
export default {
    data() {
        return {
            showModal: false,
        };
    },
    props: ["button", "title"],
};
</script>

<template>
    <button
        class="m-2.5 mx-0.5 cursor-pointer whitespace-nowrap rounded border border-gray-500 bg-transparent px-2 py-1 text-sm font-semibold text-gray-700 hover:border-transparent hover:bg-indigo-900 hover:text-white"
        v-on:click="showModal = !showModal"
        v-html="button"
    ></button>

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
            <h1
                class="mb-2 border-b border-gray-400 text-xl font-bold"
                v-html="title"
            ></h1>
            <slot></slot>
        </div>
    </div>
</template>

<style scoped></style>
