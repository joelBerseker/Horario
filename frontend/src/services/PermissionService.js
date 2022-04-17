//import Vue from 'vue'
import store from "../store";
import axios from "axios";
const url = process.env.VUE_APP_RUTA_API;
//import AuthService from "@/services/AuthService.js";
//Vue.store.getters.appSettings

//store.getters.appSettings

export const PermissionService = {

  /**
   * @param {number} a Permiso ingresado
   * @param {number} b Modulo ingresado
   * @description Verifica si existe el permiso ingresado en los argumentos en la variable userPermissions
   * @return {boolean}
   */
  findPermission(a, b) {
    return store.getters.getPermisos.some(
      (x) => x.permission == a && x.module == b
    );

    // return true;
  },

  /**
   * @description Obtiene los permisos del usuario logueado
   */
  async setUserActive() {
    const path = url + `user/active/`;
    axios
      .get(path)
      .then((response) => {
        console.log(response.data);
        //const p = response.data.role.permissions;
        //store.dispatch("permisos", { p });
      })
      .catch((error) => {
        console.log(error);
      });
  },
};
