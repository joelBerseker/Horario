//const url = process.env.VUE_APP_RUTA_API;

export default {
  methods: {
    makeToast(message, variant) {
      var title_ = "";
      switch (variant) {
        case "danger":
          title_ = "Ocurrio un error";
          break;
        case "success":
          title_ = "Operacion exitosa";
          break;
        default:
          title_ = "Variante no reconocida";
          break;
      }
      this.$bvToast.toast(message, {
        title: title_,
        autoHideDelay: 4000,
        appendToast: true,
        variant: variant,
      });
    },
  },
  data() {
    return {
      status: [
        { value: 0, text: "Seleccione una opción" },
        { value: 1, text: "Activo" },
        { value: 2, text: "Inactivo" },
      ],
      selections: [
        { value: 0, text: "Seleccione una opción" },
        { value: 1, text: "Si" },
        { value: 2, text: "No" },
      ],
      state_validation: [
        { value: 0, text: "Seleccione una opción", class:"free"},
        { value: 1, text: "Libre", class:"free" },
        { value: 2, text: "Reservado", class:"reserved" },
        { value: 3, text: "Ocupado", class:"occupied" },
      ],
    };
  },
};
