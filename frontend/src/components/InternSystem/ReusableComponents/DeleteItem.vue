<template>
  <div>
    <b-modal
      :id="'delete-' + modalName + '-modal'"
      ref="modal"
      title="Eliminar registro"
      @ok="handleOk"
    >
      ¿Está seguro que quiere eliminar el registro?
      <template #modal-footer="{ cancel, ok }">
        <b-button variant="danger" @click="cancel()"> No </b-button>
        <b-button variant="primary" @click="ok()"> Si </b-button>
      </template>
    </b-modal>
  </div>
</template>

<script>
import axios from "axios";
import UtilityFunctions from "@/mixin/UtilityFunctions.js";
const url = process.env.VUE_APP_RUTA_API;

export default {
  mixins: [UtilityFunctions],
  props: ["item", "pathName", "modalName"],

  methods: {
    handleOk(evt) {
      evt.preventDefault();
      this.deleteItem();
    },
    deleteItem() {
      var path = url + this.pathName + "/" + this.item.id;
      this.$store.dispatch("loadingSwitch");
      setTimeout(() => {
        axios
          .delete(path)
          .then((response) => {
            this.$store.dispatch("loadingSwitch");
            this.makeToast(response, "success");
            this.$nextTick(() => {
              this.$bvModal.hide("delete-" + this.modalName + "-modal");
            });
            this.$bvModal.hide("detail-" + this.modalName + "-modal");
          })
          .catch((error) => {
            this.$store.dispatch("loadingSwitch");
            this.makeToast(error, "danger");
          });
      }, 500);
      console.log("documento eliminado");
      
    },
  },
};
</script>

<style scoped>
</style>
