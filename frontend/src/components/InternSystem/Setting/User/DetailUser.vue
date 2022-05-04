<template>
  <div>
    <DeleteItem
      :item="item"
      :pathName="pathName"
      :modalName="modalName"
      :getList="getUserList"
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
          :name="'Nombre'"
          :validation="validation_name"
          :disabled="mode === 1"
          v-model="item.name"
          type="text"
          :required="true"
        />
        <InputTextPersonalized
          :name="'Usuario'"
          :validation="validation_nickname"
          :disabled="mode === 1"
          v-model="item.nickname"
          type="text"
          :required="true"
        />
         <InputTextPersonalized
          :name="'Contraseña'"
          :validation="validation_password"
          :disabled="mode === 1"
          v-model="item.password"
          type="password"
          :required="true"
        />
        <InputSelectPersonalized
          name="Rol:"
          :validation="validation_roleid"
          :disabled="mode === 1"
          v-model="item.roleid"
          :list="list_role"
          :editFirst="true"
          :required="true"
          valueField="id"
          textField="name"
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
import UtilityFunctions from "@/mixin/UtilityFunctions.js";
import UtilityValidations from "@/mixin/UtilityValidations.js";
const url = process.env.VUE_APP_RUTA_API;

export default {
  components: {
    DeleteItem,
    InputTextPersonalized,
    InputSelectPersonalized,
  },
  mixins: [UtilityFunctions, UtilityValidations],
  props: [
    "item",
    "mode",
    "changeMode",
    "pathName",
    "modalName",
    "getUserList",
  ],

  data() {
    return {
      list_role: [],
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
    validation_nickname() {
      var text = this.item.nickname;
      var required = true;
      var validation_ = { status: null, value: "" };
      if (this.showValidation(text, required, this.validated, this.mode)) {
        validation_.status = true;
        if (validation_.status) validation_ = this.textEmpty(text);
    
      }
      return validation_;
    },
    validation_password() {
      var text = this.item.password;
      var required = true;
      var validation_ = { status: null, value: "" };
      if (this.showValidation(text, required, this.validated, this.mode)) {
        validation_.status = true;
        if (validation_.status) validation_ = this.textEmpty(text);
    
      }
      return validation_;
    },
    validation_roleid() {
      var text = this.item.roleid;
      var required = true;
      var validation_ = { status: null, value: "" };
      if (this.showValidation(text, required, this.validated, this.mode)) {
        validation_.status = true;
        if (validation_.status) validation_ = this.optionSelect(text);
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
        this.validation_nickname.status &&
        this.validation_password.status &&
        this.validation_roleid.status
      );
    },
    formValidationEdit() {
      return (
        this.$refs.form.checkValidity() &&
        this.validation_name.status &&
        this.validation_nickname.status &&
        this.validation_password.status &&
        this.validation_roleid.status &&
        this.validation_state.status
      );
    },
    editItem() {
      console.log(this.item.id);
      var formData = new FormData();
      formData.append("name", this.item.name);
      formData.append("nickname", this.item.nickname);
      formData.append("password", this.item.password);
      formData.append("roleid", this.item.roleid);
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
            this.getUserList();
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
      formData.append("nickname", this.item.nickname);
      formData.append("password", this.item.password);
      formData.append("roleid", this.item.roleid);
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
            this.getUserList();
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
    getRolList() {
      var path = url + "role";

      axios
        .get(path)
        .then((response) => {
          this.list_role = response.data.data.roles;
        })
        .catch((error) => {
          this.makeToast(error, "danger");
        });
    },
  },
  created() {
    this.getRolList();
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
