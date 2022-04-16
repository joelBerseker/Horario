//const url = process.env.VUE_APP_RUTA_API;

export default {
  methods: {
    showValidation(text, required, activated, mode) {
      if (mode==2) activated = true;
      if (!required) activated = false;
      return !(((text == null || text === 0) && !activated) || mode == 1);
    },
    onlyText(text) {
      var status_ = this.regular_expressions.onlyText.test(text);
      var value_ = "Solo se permite texto";
      return { status: status_, value: value_ };
    },
    textEmpty(text) {
      var status_ = text == "" || text == null;
      var value_ = "Por favor ingrese un valor";
      return { status: !status_, value: value_ };
    },
    optionSelect(text) {
      var status_ = text == 0 || text == null;
      var value_ = "Por favor seleccione un valor";
      return { status: !status_, value: value_ };
    },
    fileUploaded(text) {
      var status_ = text == null;
      var value_ = "Por favor suba un archivo";
      return { status: !status_, value: value_ };
    },
  },
  data() {
    return {
      regular_expressions: {
        onlyNumber: /^[0-9].*$/,
        onlyTextAndNumber: /^[a-zá-úÁ-ÚA-Z0-9 _.,:;"#%&~^/(){}!¡¿?/\\/]*$/,
        onlyText: /^[a-zá-úÁ-ÚA-Z ]*$/,
        onlyTextAndNumber1: /^[a-zá-úÁ-ÚA-Z0-9 ]*$/,
        onlyTextAndNumber2:
          /^[a-zá-úÁ-ÚA-Z0-9/{/},.:;_!"#$%?¿&()\- //+-/*/[\]]*$/,
      },
    };
  },
};
