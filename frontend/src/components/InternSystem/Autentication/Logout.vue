<template>
  <div></div>
</template>

<script>
export default {
  methods: {
    logout() {
      this.$store.dispatch("loadingSwitch");
      setTimeout(() => {
        this.$store.dispatch("loadingSwitch");
        this.$router.push({ name: "Login" });
      }, 1000);
    },
  },
  created() {
    this.$bvModal
      .msgBoxConfirm("¿Estas seguro que quieres cerrar sesión?", {
        title: "Cerrar Sesión",
        okVariant: "success",
        cancelVariant: "danger",
        okTitle: "Si",
        cancelTitle: "No",
      })
      .then((value) => {
        if(value) this.logout();
        else history.back();
      });
  },
};
</script>

<style scoped>
</style>
