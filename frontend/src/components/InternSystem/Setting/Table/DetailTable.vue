<template>
  <div>
    <DeleteItem
      :item="item"
      :pathName="pathName"
      :modalName="modalName"
      :getList="getTableList"
    />
    <b-modal
      :id="'detail-' + this.modalName + '-modal'"
      ref="modal"
      :title="title[mode]"
      scrollable
      no-close-on-backdrop
      @ok="handleOk"
      ok-title="Agregar"
      cancel-title="Cancelar"
      @hidden="closeModal"
    >
      <b-form ref="form" @submit="handleSubmit">
        <InputTextPersonalized
          name="Numero:"
          :validation="validation_id"
          :disabled="mode === 1"
          v-model="item.id"
          type="number"
          :required="true"
        />
        <InputSelectPersonalized
        v-if="mode !== 0"
          name="Estado de mesa:"
          :validation="validation_state_table"
          :disabled="mode === 1"
          v-model="item.reserved"
          :list="state_validation"
          :editFirst="false"
          :required="true"
          valueField="value"
          textField="text"
        />
        <InputTimePersonalized
          v-if="item.reserved === 2"
          name="Reservado para:"
          :validation="validation_description"
          :disabled="mode === 1"
          v-model="item.description"
          type="text"
          :required="true"
        />
        <InputSelectPersonalized
          v-if="mode !== 0"
          name="Estado:"
          :validation="validation_state"
          :disabled="mode === 1"
          v-model="item.state"
          :list="status"
          :editFirst="false"
          :required="true"
          valueField="value"
          textField="text"
        />
      </b-form>
      <template #modal-footer="{ ok }">
        <!----
        <b-button variant="outline-danger" @click="cancel()">
          Cancelar
        </b-button>--->
        <b-button v-if="mode === 1" variant="warning" @click="editItemButtom()">
          <b-icon icon="pencil-square" scale="1"></b-icon>
          &nbsp;Editar
        </b-button>
        <b-button
          v-if="mode === 1"
          variant="danger"
          @click="deleteItemButtom()"
        >
          <b-icon icon="trash" scale="1"></b-icon>
          &nbsp;Eliminar
        </b-button>
        <b-button
          v-if="mode === 2"
          variant="secondary"
          @click="detailItemButtom()"
        >
          <b-icon icon="eye" scale="1"></b-icon>
          &nbsp;Ver
        </b-button>

        <b-button
          v-if="mode === 0 || mode === 2"
          variant="primary"
          @click="ok()"
        >
          <b-icon icon="check2" scale="1.1"></b-icon>
          &nbsp;Aceptar
        </b-button>
      </template>
    </b-modal>
  </div>
</template>

<script>
import axios from "axios";
import DeleteItem from "@/components/InternSystem/ReusableComponents/DeleteItem";
import InputTextPersonalized from "@/components/InternSystem/ReusableComponents/InputTextPersonalized";
import InputSelectPersonalized from "@/components/InternSystem/ReusableComponents/InputSelectPersonalized";
import InputTimePersonalized from "@/components/InternSystem/ReusableComponents/InputTimePersonalized";
import UtilityFunctions from "@/mixin/UtilityFunctions.js";
import UtilityValidations from "@/mixin/UtilityValidations.js";
const url = process.env.VUE_APP_RUTA_API;

export default {
  components: {
    DeleteItem,
    InputTextPersonalized,
    InputSelectPersonalized,
    InputTimePersonalized
  },
  mixins: [UtilityFunctions, UtilityValidations],
  props: [
    "item",
    "mode",
    "changeMode",
    "pathName",
    "modalName",
    "getTableList",
  ],

  data() {
    return {
      validated: false,
      title: ["Agregar registro", "Ver registro", "Editar registro"],
      image: null,
      previewImage: null,
    };
  },
  computed: {
    validation_id() {
      var text = this.item.name;
      var required = true;
      var validation_ = { status: null, value: "" };
      if (this.showValidation(text, required, this.validated, this.mode)) {
        validation_.status = true;
      }
      return validation_;
    },
    validation_description() {
      var text = this.item.description;
      var required = true;
      var validation_ = { status: null, value: "" };
      if (this.showValidation(text, required, this.validated, this.mode)) {
        validation_.status = true;
        if (validation_.status) validation_ = this.textEmpty(text);
      }
      return validation_;
    },

    validation_state() {
      var text = this.item.state;
      var required = true;
      var validation_ = { status: null, value: "" };
      if (this.showValidation(text, required, this.validated, this.mode)) {
        validation_.status = true;
        if (validation_.status) validation_ = this.optionSelect(text);
      }
      return validation_;
    },
    validation_state_table() {
      var text = this.item.reserved;
      var required = true;
      var validation_ = { status: null, value: "" };
      if (this.showValidation(text, required, this.validated, this.mode)) {
        validation_.status = true;
        if (validation_.status) validation_ = this.optionSelect(text);
      }
      return validation_;
    },

  
  },
  methods: {
    closeModal() {
      this.image = null;
      this.previewImage = null;
      this.validated = false;
    },
    obtainImage(e) {
      const file = e.target.files[0];
      this.previewImage = URL.createObjectURL(file);
    },
    handleOk(evt) {
      evt.preventDefault();
      this.handleSubmit();
    },
    handleSubmit() {
      this.validated = true;
      if (this.formValidation()) {
        switch (this.mode) {
          case 0:
            this.addItem();
            break;
          case 2:
            this.editItem();
            break;
          default:
            console.log("Ocurrio un error");
            break;
        }
      } else {
        this.makeToast(
          "Revise que todos los campos se llenaron correctamente",
          "danger"
        );
      }
    },
    formValidation() {
      var state = true;
      if (this.mode == 2) state = this.validation_state.status;
      return (
        this.$refs.form.checkValidity() &&
        this.validation_id.status &&
        this.validation_description.status &&
        state
      );
    },
    editItem() {
      console.log(this.item.id);
      var formData = new FormData();
      formData.append("name", this.item.name);
      formData.append("description", this.item.description);
      formData.append("state", this.item.state);
      var path = url + this.pathName + "/edit/" + this.item.id;
      this.$store.dispatch("loadingSwitch");
      setTimeout(() => {
        axios
          .post(path, formData)
          .then(() => {
            this.$store.dispatch("loadingSwitch");
            this.makeToast("Se edito correctamente", "success");
            this.$nextTick(() => {
              this.$bvModal.hide("detail-" + this.modalName + "-modal");
            });
            this.getTableList();
          })
          .catch(() => {
            this.$store.dispatch("loadingSwitch");
            this.makeToast("No se edito correctamente", "danger");
          });
      }, 500);
    },
    addItem() {
      var formData = new FormData();
      formData.append("name", this.item.name);
      formData.append("description", this.item.description);
      formData.append("image", this.image);
      var path = url + this.pathName + "/";
      this.$store.dispatch("loadingSwitch");
      setTimeout(() => {
        axios
          .post(path, formData)
          .then(() => {
            this.$store.dispatch("loadingSwitch");
            this.makeToast("Se agrego correctamente", "success");
            this.$nextTick(() => {
              this.$bvModal.hide("detail-" + this.modalName + "-modal");
            });
            this.getTableList();
          })
          .catch(() => {
            this.$store.dispatch("loadingSwitch");
            this.makeToast("No se agrego correctamente", "danger");
          });
      }, 500);
    },

    detailItemButtom() {
      this.image = null;
      this.previewImage = null;
      this.validated = false;
      this.changeMode(1);
    },
    editItemButtom() {
      this.changeMode(2);
    },
    deleteItemButtom() {
      this.$bvModal.show("delete-" + this.modalName + "-modal");
    },
  },
};
</script>

<style scoped>
.image-product {
  position: relative;
  z-index: 1;
  display: block;
  overflow: hidden;
  background-repeat: no-repeat;
  background-position: center center;
  background-size: cover;
}
</style>
