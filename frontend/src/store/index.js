import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex)

const getDefaultState = () => {
  return {
    loadingAction: false,
  };
};
export default new Vuex.Store({
  state: getDefaultState(),
  getters: {
    getLoading: (state) => {
      return state.loadingAction;
    },
  },
  mutations: {
    LOADING_SWITCH: (state) => {
      state.loadingAction=!state.loadingAction;
    },
    LOADING_DEACTIVATE: (state) => {
      state.loadingAction=false;
    },
  },
  actions: {
    loadingSwitch: ({ commit }) => {
      commit("LOADING_SWITCH", "");
    },
    loadingDeactivate: ({ commit }) => {
      commit("LOADING_DEACTIVATE", "");
    },
  },
  modules: {
    
  },
  plugins: [createPersistedState()],
})
