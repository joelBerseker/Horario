<template>
  <div>
    <b-modal
      id="delete-typeofdish-modal"
      ref="modal"
      title="Eliminar registro"
      @ok="handleOk"
      ok-title="Si"
      cancel-title="No"
    >
      ¿Está seguro que quiere eliminar el registro?
    </b-modal>
  </div>
</template>

<script>
export default {
  props: ["item"],

  methods: {
    handleOk(evt) {
      evt.preventDefault();
      this.deleteItem();
      this.$nextTick(() => {
        this.$bvModal.hide("delete-typeofdish-modal");
      });
    },
    deleteItem() {
      console.log("documento eliminado");
      this.$bvModal.hide("detail-typeofdish-modal");
      
    },
  },
};
</script>

<style scoped>
</style>
