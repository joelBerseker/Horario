<template>
  <div>
    <DeleteItem
      :item="item"
      :pathName="pathName"
      :modalName="modalName"
      :getList="getProductList"
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
        <InputTextPersonalized
          :name="'Nombre'"
          :validation="validation_name"
          :disabled="mode === 1"
          v-model="item.name"
          type="text"
          :required="true"
        />
        <InputTextPersonalized
          name="Descripcion:"
          :validation="validation_description"
          :disabled="mode === 1"
          v-model="item.description"
          type="text"
          :required="true"
        />
        <InputTextPersonalized
          name="Precio:"
          :validation="validation_price"
          :disabled="mode === 1"
          v-model="item.price"
          type="number"
          :required="true"
        />
        <InputSelectPersonalized
          name="Tipo de producto:"
          :validation="validation_typeproid"
          :disabled="mode === 1"
          v-model="item.typeproid"
          :list="list_type_of_product"
          :editFirst="true"
          :required="true"
          valueField="id"
          textField="name"
        />
        <InputSelectPersonalized
          v-if="mode !== 0"
          name="Promoción:"
          :validation="validation_promotion"
          :disabled="mode === 1"
          v-model="item.promotion"
          :list="selections"
          :editFirst="false"
          :required="true"
          valueField="value"
          textField="text"
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
        <InputImagePersonalized
          v-if="mode === 0 || mode === 2"
          name="Imagen:"
          :validation="validation_image"
          :disabled="mode === 1"
          v-model="image"
          :required="false"
          :obtainImage="obtainImage"
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
          v-if="mode === 0 || mode === 2"
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
import InputImagePersonalized from "@/components/InternSystem/ReusableComponents/InputImagePersonalized";
import UtilityFunctions from "@/mixin/UtilityFunctions.js";
import UtilityValidations from "@/mixin/UtilityValidations.js";
const url = process.env.VUE_APP_RUTA_API;
const url_public = process.env.VUE_APP_RUTA_PUBLIC;

export default {
  components: {
    DeleteItem,
    InputTextPersonalized,
    InputSelectPersonalized,
    InputImagePersonalized,
  },
  mixins: [UtilityFunctions, UtilityValidations],
  props: [
    "item",
    "mode",
    "changeMode",
    "pathName",
    "modalName",
    "getProductList",
  ],

  data() {
    return {
      list_type_of_product: [],
      validated: false,
      title: ["Agregar registro", "Ver registro", "Editar registro"],
      image: null,
      previewImage: null,
    };
  },
  computed: {
    validation_name() {
      var text = this.item.name;
      var required = true;
      var validation_ = { status: null, value: "" };
      if (this.showValidation(text, required, this.validated, this.mode)) {
        validation_.status = true;
        if (validation_.status) validation_ = this.textEmpty(text);
    
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
    validation_typeproid() {
      var text = this.item.typeproid;
      var required = true;
      var validation_ = { status: null, value: "" };
      if (this.showValidation(text, required, this.validated, this.mode)) {
        validation_.status = true;
        if (validation_.status) validation_ = this.optionSelect(text);
      }
      return validation_;
    },
    validation_price() {
      var text = this.item.price;
      var required = true;
      var validation_ = { status: null, value: "" };
      if (this.showValidation(text, required, this.validated, this.mode)) {
        validation_.status = true;
        if (validation_.status) validation_ = this.textEmpty(text);
      }
      return validation_;
    },
    validation_promotion() {
      var text = this.item.promotion;
      var required = true;
      var validation_ = { status: null, value: "" };
      if (this.showValidation(text, required, this.validated, this.mode)) {
        validation_.status = true;
        if (validation_.status) validation_ = this.optionSelect(text);
      }
      return validation_;
    },
    validation_image() {
      var text = this.image;
      var required = false;
      var validation_ = { status: null, value: "" };
      if (this.showValidation(text, required, this.validated, this.mode)) {
        validation_.status = true;
        if (validation_.status) validation_ = this.fileUploaded(text);
      }
      return validation_;
    },

    selectImage() {
      switch (this.mode) {
        case 0:
          if (this.image) return this.previewImage;
          else return "/no_image.jpg";
        case 1:
          if (this.item.image == "") return "/no_image.jpg";
          else return url_public + this.item.image;
        case 2:
          if (this.image) return this.previewImage;
          else if (this.item.image != "") return url_public + this.item.image;
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
      var isOk = false;
      switch (this.mode) {
        case 0:
          if (this.formValidationAdd()) {
            isOk = true;
            this.addItem();
          }
          break;
        case 2:
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
      return (
        this.$refs.form.checkValidity() &&
        this.validation_name.status &&
        this.validation_description.status &&
        this.validation_price.status &&
        this.validation_typeproid.status
      );
    },
    formValidationEdit() {
      return (
        this.$refs.form.checkValidity() &&
        this.validation_name.status &&
        this.validation_description.status &&
        this.validation_state.status &&
        this.validation_price.status &&
        this.validation_typeproid.status &&
        this.validation_promotion.status
      );
    },
    editItem() {
      console.log(this.item.id);
      var formData = new FormData();
      formData.append("name", this.item.name);
      formData.append("description", this.item.description);
      formData.append("state", this.item.state);
      formData.append("typeproid", this.item.typeproid);
      formData.append("price", this.item.price);
      formData.append("promotion", this.item.promotion);
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
            this.getProductList();
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
      formData.append("typeproid", this.item.typeproid);
      formData.append("price", this.item.price);
      formData.append("image", this.image);
      var path = url + this.pathName + "/";
      console.log(path);
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
            this.getProductList();
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
    getTypeOfProductList() {
      var path = url + "typeproduct";

      axios
        .get(path)
        .then((response) => {
          this.list_type_of_product = response.data.data.typeProducts;
        })
        .catch((error) => {
          this.makeToast(error, "danger");
        });
    },
  },
  created() {
    this.getTypeOfProductList();
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
