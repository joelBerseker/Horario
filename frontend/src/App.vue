<template>
  <div id="app">
    <router-view />
  </div>
</template>
<script>
export default {
  created() {
    this.$store.dispatch("loadingDeactivate");
  },
}
</script>
<style>
@import "style.css";
</style>
