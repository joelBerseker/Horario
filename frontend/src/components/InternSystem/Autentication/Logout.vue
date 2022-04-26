<template>
  <div>
    <div class="text-center c3 mt-5">
      <b-spinner class="align-middle"></b-spinner>&nbsp;
      <span>Cerrando sesion ...</span>
    </div>
  </div>
</template>

<script>
export default {
   created() {
     setTimeout(() => {
    this.$router.push({ name: 'Login' });
    }, 1000);
  },
}
</script>

<style scoped>
</style>
