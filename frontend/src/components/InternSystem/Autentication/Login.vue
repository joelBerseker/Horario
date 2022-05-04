<template>
  <div class="mx-auto center justify-content-center">
    <b-container>
      <b-row align-h="center">
        <b-col xl="5" lg="6" md="8" sm="11">
          <b-card class="login-card" body-class="mx-3 my-2">
            <Logo size="1.6" />
            <b-form @submit="onSubmit" ref="form">
              <b-form-group
                class="mb-2"
                label="Usuario"
                label-size="sm"
                label-class="c1"
              >
                <b-row>
                  <b-col>
                    <b-input-group>
                      <template #prepend>
                        <b-input-group-text class="login-input-icon">
                          <b-icon
                            icon="person-fill"
                            scale="1.2"
                            class="align-middle"
                          ></b-icon
                        ></b-input-group-text>
                      </template>
                      <b-form-input
                        class="login-input"
                        v-model="item.user"
                        type="text"
                        required
                        autocomplete="username"
                      ></b-form-input>
                    </b-input-group>
                  </b-col>
                </b-row>
              </b-form-group>
              <b-form-group
                class="mb-4"
                label="Contraseña"
                label-size="sm"
                label-class="c1"
              >
                <b-row align-h="center">
                  <b-col>
                    <b-input-group>
                      <template #prepend>
                        <b-input-group-text class="login-input-icon">
                          <b-icon icon="lock-fill" scale="1.1"></b-icon
                        ></b-input-group-text>
                      </template>
                      <b-form-input
                        class="login-input"
                        type="password"
                        v-model="item.password"
                        required
                        autocomplete="current-password"
                      >
                      </b-form-input>
                    </b-input-group>
                  </b-col>
                </b-row>
              </b-form-group>
              <b-row>
                <b-col>
                  <b-button
                    :disabled="butom_loading"
                    block
                    variant="primary"
                    class="float-right"
                    type="submit"
                  >
                    <b-spinner
                      small
                      v-if="butom_loading"
                      class="mr-2"
                    ></b-spinner>
                    Ingresar</b-button
                  >
                </b-col>
              </b-row>
            </b-form>
          </b-card>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
import UtilityFunctions from "@/mixin/UtilityFunctions.js";
import UtilityValidations from "@/mixin/UtilityValidations.js";
import Logo from "@/components/InternSystem/ReusableComponents/Logo";
export default {
  components: { Logo },
  mixins: [UtilityFunctions, UtilityValidations],
  data() {
    return {
      butom_loading: false,
      item: {
        user: "",
        password: "",
      },
    };
  },
  computed: {
    validation_user() {
      var text = this.item.user;
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
  },
  methods: {
    onSubmit(evt) {
      evt.preventDefault();
      if (this.formValidation()) this.login();
    },
    formValidation() {
      return (
        this.$refs.form.checkValidity() &&
        this.validation_user.status &&
        this.validation_password.status
      );
    },
    login() {
      this.butom_loading = true;
      setTimeout(() => {
        this.$router.push({ name: "Sidebar" });
        this.butom_loading = false;
      }, 500);
    },
  },
};
</script>

<style>
.center {
  height: 100%;
  height: 100vh;
  display: flex;
  align-items: center;
  margin: 0;
  overflow-x: hidden;
  overflow-y: hidden;
  min-height: 100%;
}

.login-card {
  background-color: var(--color-2) !important;
  border: none !important;
}
.login-input {
  border-left-color: transparent !important;
  background-color: #fff !important;
}
.login-input-icon {
  border-right-color: transparent !important;
  background-color: #fff !important;
}
</style>
