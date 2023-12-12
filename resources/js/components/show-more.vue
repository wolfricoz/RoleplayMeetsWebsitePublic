<!--This component needs to calculate the height of the text div and if its beyond a certain amount of pixels, it has to show 'read more'. The read more link leads to the full post.-->
<div>

    <div class="text" v-html="post.text" ref="text"></div>

    <div v-if="showMore" class="show-more">
        <a :href="{ name: 'post', params: { id: post.id } }">Read more</a>
    </div>
</div>

<script>
    export default {
        props: ['post'],
        data() {
            return {
                showMore: false
            }
        },
        mounted() {
            this.$nextTick(() => {
                if (this.$refs.text.clientHeight > 128) {
                    this.showMore = true;
                }
            });
        }
    }
</script>

