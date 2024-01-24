<script>
export default {
  name: "countdown",
  data() {
    return {
      current_date: new Date()
    }
  },
  props: [
    'post'
  ],
  computed: {
    daysUntilDate() {
      if (this.post.bumped_at == null) {
        return 0
      }

      let date = new Date(this.post.bumped_at)
      date.setDate(date.getDate() + 1)
      let timeDiff = Math.abs(date.getTime() - this.current_date.getTime())
      let showDays = new Date(timeDiff)
      return + showDays.getHours() + ":" + showDays.getMinutes() + ":" + showDays.getSeconds() + " Hours"
    }
  },
  mounted() {
    this.intervalId = setInterval(() => {
      this.current_date = new Date()
      if (this.daysUntilDate <= 0) {
        clearInterval(this.intervalId)
      }
    }, 1000) // update every second
  },
  beforeDestroy() {
    clearInterval(this.intervalId) // clear interval when component is destroyed
  }
}

</script>

<template>
  <div>
    <p>You can bump in: {{ daysUntilDate }}</p>
  </div>
</template>

