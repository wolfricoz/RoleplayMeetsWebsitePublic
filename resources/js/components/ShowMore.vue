<!--This component needs to calculate the height of the text div and if its beyond a certain amount of pixels, it has to show 'read more'. The read more link leads to the full post.-->
<template>
    <div>

        <div class="collapsable text p-4 overflow-hidden to-transparent note-editable break-words" ref="text">
            <slot/>
        </div>

        <div v-if="showMore"
             class="show-more w-full text-center text-blue-500 p-2 border-t border-gray-300 hover:bg-gray-200">
            <button @click="changeText" ref="button">Read more</button>
        </div>
    </div>
</template>

<script>
export default {
    props: ['post'],
    data() {
        return {
            showMore: false,
            expanded: false,
        }
    },
    methods: {
        changeText() {
            if (!this.expanded) {
                this.expandText()

            } else {
                this.retractText()
            }
        },
        expandText() {
            this.expanded = !this.expanded
            this.$refs.text.classList.toggle("collapsed")
            this.$refs.button.textContent = "Read Less"
        },
        retractText() {
            this.expanded = !this.expanded
            this.$refs.text.classList.toggle("collapsed")
            this.$refs.button.textContent = "Read More"
        },
    },
    mounted() {
        this.$nextTick(() => {
            console.log(this.$refs.text.clientHeight);

            if (this.$refs.text.clientHeight > 120) {
                this.showMore = true;
            }
        });
    }
}
</script>

<style scoped>
div.collapsable {
    max-height: 128px;
    transition: all 500ms ease;
    overflow: hidden;
}

div.collapsed {
    max-height: 2000px;
    height: fit-content;
    transition: all 1000ms ease;

}
</style>
