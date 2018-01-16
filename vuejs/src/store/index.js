import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

// Set the state at the start of the application.
const state = {
}

const mutations = {
}
const actions = {
}

export default new Vuex.Store({
  strict: process.env.NODE_ENV !== 'production',
  state,
  mutations,
  actions
});