import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex)

const getDefaultState = () => {
  return {
    loadingAction: false,
    permises:[],
  };
};
export default new Vuex.Store({
  state: getDefaultState(),
  getters: {
    getLoading: (state) => {
      return state.loadingAction;
    },
    getPermisos: (state) => {
      return state.permises;
    },
  },
  mutations: {
    LOADING_SWITCH: (state) => {
      state.loadingAction=!state.loadingAction;
    },
    LOADING_DEACTIVATE: (state) => {
      state.loadingAction=false;
    },
    SET_PERMISOS: (state, p) => {
      state.permises = p;
    },
  },
  actions: {
    loadingSwitch: ({ commit }) => {
      commit("LOADING_SWITCH", "");
    },
    loadingDeactivate: ({ commit }) => {
      commit("LOADING_DEACTIVATE", "");
    },
    permisos: ({ commit }, { p }) => {
      commit('SET_PERMISOS', p);
    },
  },
  modules: {
    
  },
  plugins: [createPersistedState()],
})
