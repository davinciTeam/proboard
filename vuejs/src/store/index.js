import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

// Set the state at the start of the application.
const state = {
  // !! sets the state to false if undifined or null.
  isLogged: !!localStorage.getItem('token')
}

const mutations = {
  LOGIN_USER (state) {
    state.isLogged = true;
    return true
  },

  LOGOUT_USER (state) {
    state.isLogged = false;
  }
}
const actions = {
  logout({ commit, state }) {
    return new Promise((resolve, reject) => {
      while(state.isLogged) {
        commit('LOGOUT_USER')
        console.log(state.isLogged);
      }
      console.log(state.isLogged);
      resolve();
      
    });
  }
}

export default new Vuex.Store({
  strict: process.env.NODE_ENV !== 'production',
  state,
  mutations,
  actions
});