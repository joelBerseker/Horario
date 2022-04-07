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
import axios from "axios";
const url = process.env.VUE_APP_RUTA_API;
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
      var path =
        url + "api/typeproduct/"+this.item.id;
        axios.delete(path).then((response) => {
          //this.userAliments = response.data.results;
          //this.functionLoading();
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
          this.functionLoading();
        });
      console.log("documento eliminado");
      this.$bvModal.hide("detail-typeofdish-modal");
      
    },
  },
};
</script>

<style scoped>
</style>
