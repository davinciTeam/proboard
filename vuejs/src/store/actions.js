export default {
  login({commit, state}, payload) {
    return new Promise((resolve, reject) => {
      commit('SET_USER', JSON.parse(payload.user));
      commit('SET_USER_TOKEN', payload.token);
      resolve();
    });
    
  },
  logout({ commit, state }, payload) {
    return new Promise((resolve, reject) => {
      commit('REMOVE_USER');
      commit('REMOVE_USER_TOKEN');
      resolve();
    });
  }
}