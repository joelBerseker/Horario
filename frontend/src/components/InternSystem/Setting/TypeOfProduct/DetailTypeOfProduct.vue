<template>
  <div>
    <DeleteItem :item="item" :pathName="pathName" :modalName="modalName" />
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
        <div class="mb-2 row justify-content-center">
          <div
            class="image-product"
            :style="
              'background-image: url(' +
              selectImage +
              '); width: 25vh; height: 25vh;'
            "
          ></div>
        </div>
        <b-form-group
          class="mb-2"
          label="Nombre:"
          label-size="sm"
          label-class="mb-0"
        >
          <b-form-input
            :disabled="mode === 1"
            v-model="item.name"
            type="text"
            required
            :state="validationName.status"
          ></b-form-input>
          <small v-if="validationName.status == false" class="text-danger">
            <b-icon icon="exclamation-circle" variant="danger"></b-icon>&nbsp;
            {{ validationName.value }}
          </small>
        </b-form-group>
        <b-form-group
          class="mb-2"
          label="Descripcion:"
          label-size="sm"
          label-class="mb-0"
        >
          <b-form-input
            :disabled="mode === 1"
            v-model="item.description"
            type="text"
            required
            :state="validationDescription.status"
          ></b-form-input>
          <small
            v-if="validationDescription.status == false"
            class="text-danger"
          >
            <b-icon icon="exclamation-circle" variant="danger"></b-icon>&nbsp;
            {{ validationDescription.value }}
          </small>
        </b-form-group>

        <b-form-group
          v-if="mode !== 0"
          class="mb-2"
          label="Estado:"
          label-size="sm"
          label-class="mb-0"
        >
          <b-form-select
            :disabled="mode === 1"
            v-model="item.state"
            :options="status"
            :state="validationState.status"
          ></b-form-select>
          <small v-if="validationState.status == false" class="text-danger">
            <b-icon icon="exclamation-circle" variant="danger"></b-icon>&nbsp;
            {{ validationState.value }}
          </small>
        </b-form-group>

        <b-form-group
          v-if="mode === 0 || mode === 2"
          class="mb-2"
          label="Imagen:"
          label-class="mb-0"
          label-size="sm"
          description="No es necesario ingresar una imagen"
        >
          <b-form-file
            @change="obtainImage"
            accept="image/*"
            v-model="image"
            :state="validationImage.status"
            placeholder="Escoge una imagen..."
            drop-placeholder="Suelta una imagen aqui..."
          ></b-form-file>
        </b-form-group>
      </b-form>
      <template #modal-footer="{ ok }">
        <!----
        <b-button variant="outline-danger" @click="cancel()">
          Cancelar
        </b-button>--->
        <b-button v-if="mode === 1" variant="warning" @click="editItemButtom()">
          <b-icon icon="pen" scale="1"></b-icon>
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
          <b-icon icon="list" scale="1"></b-icon>
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
import UtilityFunctions from "@/mixin/UtilityFunctions.js";
import UtilityValidations from "@/mixin/UtilityValidations.js";
const url = process.env.VUE_APP_RUTA_API;
const url_public = process.env.VUE_APP_RUTA_PUBLIC;

export default {
  components: {
    DeleteItem,
  },
  mixins: [UtilityFunctions, UtilityValidations],
  props: [
    "item",
    "mode",
    "changeMode",
    "pathName",
    "modalName",
    "getTypeOfProductList",
  ],

  data() {
    return {
      activate_validation: false,
      title: ["Agregar registro", "Ver registro", "Editar registro"],
      image: null,
      previewImage: null,
    };
  },
  computed: {
    validationName() {
      var text = this.item.name;
      if ((text == null && !this.activate_validation) || this.mode == 1)
        return { status: null, value: "" };

      var resp = this.textEmpty(text);
      if (!resp.status) return resp;
      resp = this.onlyText(text);
      if (!resp.status) return resp;
      return resp;
    },
    validationDescription() {
      var text = this.item.description;
      if ((text == null && !this.activate_validation) || this.mode == 1)
        return { status: null, value: "" };

      var resp = this.textEmpty(text);
      if (!resp.status) return resp;

   

      return resp;
    },

    validationState() {
      var text = this.item.state;
      if ((text == 0 && !this.activate_validation) || this.mode == 1)
        return { status: null, value: "" };

      var resp = this.optionSelect(text);
      if (!resp.status) return resp;
      return resp;
    },
    validationImage() {
      var text = this.image;
      if (text === null || this.mode == 1) return { status: null, value: "" };

      var resp = this.fileUploaded(text);
      if (!resp.status) return resp;
      return resp;
    },

    selectImage() {
      switch (this.mode) {
        case 0:
          if (this.image) return this.previewImage;
          else return "/no_image.jpg";
        case 1:
          if (this.item.image == "") return "/no_image.jpg";
          else return url_public+this.item.image;
        case 2:
          if (this.image) return this.previewImage;
          else if (this.item.image != "") return url_public+this.item.image;
          else return "/no_image.jpg";
        default:
          return "/no_image.jpg";
      }
    },
  },
  methods: {
    closeModal() {
      this.image = null;
      this.previewImage = null;
      this.activate_validation = false;
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
      this.activate_validation = true;
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
      return (
        this.$refs.form.checkValidity() &&
        this.validationName.status &&
        this.validationDescription.status
      );
    },
    editItem() {
      console.log(this.item.id);
      var formData = new FormData();
      formData.append("name", this.item.name);
      formData.append("description", this.item.description);
      formData.append("state", this.item.state);
      var path = url + this.pathName + "/" + this.item.id;
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
            this.getTypeOfProductList();
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
            this.getTypeOfProductList();
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
      this.activate_validation = false;
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
