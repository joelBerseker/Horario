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
      :scrollable="mode !== 3"
      no-close-on-backdrop
      @ok="handleOk"
      ok-title="Agregar"
      cancel-title="Cancelar"
      @hidden="closeModal"
    >
      <b-form ref="form" @submit="handleSubmit">
        <InputTextPersonalized
          v-if="mode === 0 || mode === 1"
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
          :validation="validation_hour"
          :disabled="mode === 1"
          v-model="item.hour"
          type="text"
          :required="true"
        />
        <InputSelectPersonalized
          v-if="mode !== 0 && mode !== 3"
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
          variant="info"
          @click="detailItemButtom()"
        >
          <b-icon icon="eye" scale="1"></b-icon>
          &nbsp;Ver
        </b-button>

        <b-button
          v-if="mode === 0 || mode === 2 || mode === 3"
          variant="success"
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
    InputTimePersonalized,
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
      title: [
        "Agregar registro",
        "Ver registro",
        "Editar registro",
        "Cambiar estado",
      ],
      image: null,
      previewImage: null,
    };
  },
  computed: {
    validation_id() {
      var text = this.item.id;
      var required = true;
      var validation_ = { status: null, value: "" };
      if (this.showValidation(text, required, this.validated, this.mode)) {
        validation_.status = true;
        if (validation_.status) validation_ = this.textEmpty(text);
      }
      return validation_;
    },
    validation_hour() {
      var text = this.item.hour;
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
    handleOk(evt) {
      evt.preventDefault();
      this.handleSubmit();
    },
    handleSubmit() {
      this.validated = true;
      var isOk = false;
      switch (this.mode) {
        case 0:
          if (this.formValidationAdd()) {
            isOk = true;
            this.addItem();
          }
          break;
        case 2:
        case 3:
          if (this.formValidationEdit()) {
            isOk = true;
            this.editItem();
          }
          break;
        default:
          console.log("Ocurrio un error");
          break;
      }
      if (!isOk)
        this.makeToast(
          "Revise que todos los campos se llenaron correctamente",
          "danger"
        );
    },
    formValidationAdd() {
      return this.$refs.form.checkValidity() && this.validation_id.status;
    },
    formValidationEdit() {
      var state = true;
      if (this.mode == 2) state = this.validation_state.status;
      return (
        this.$refs.form.checkValidity() &&
        this.validation_id.status &&
        this.validation_hour.status &&
        state
      );
    },
    editItem() {
      var formData = new FormData();
      formData.append("reserved", this.item.reserved);
      formData.append("hour", this.item.hour);
      console.log(this.item.hour);
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
      formData.append("id", this.item.id);
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
