<script>
export default {
  name: "countdown",
  data() {
    return {
      current_date: new Date(),
    };
  },
  props: ["post"],
  computed: {
    daysUntilDate() {
      if (this.post.bumped_at == null) {
        return 0;
      }

      let date = new Date(this.post.bumped_at);
      date.setDate(date.getDate() + 1);
      let timeDiff = Math.abs(
        date.getTime() - this.current_date.getTime() + 3600000,
      ); // time difference in milliseconds

      let hours = Math.floor(timeDiff / (1000 * 60 * 60));
      let minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
      let seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);
      if (timeDiff <= 1000) {
        clearInterval(this.intervalId);
        return "Refresh to bump!";
      }
      return hours + ":" + minutes + ":" + seconds + " Hours";
    },
  },
  mounted() {
    this.intervalId = setInterval(() => {
      this.current_date = new Date();
      if (this.daysUntilDate <= 1000) {
        clearInterval(this.intervalId);
      }
    }, 1000); // update every second
  },
  beforeDestroy() {
    clearInterval(this.intervalId); // clear interval when component is destroyed
  },
};
</script>

<template>
  <div>
    Bump cooldown: <br />
    {{ daysUntilDate }}
  </div>
</template>
