export default {
  LOGIN_USER (state) {
    state.auth.isLogged = true;
  },
  LOGOUT_USER (state) {
    state.auth.isLogged = false;
  },
  SET_USER (state, payload) {
    state.auth.user = payload;
  },
  SET_USER_TOKEN (state, payload) {
    state.auth.token = payload;
  },
  REMOVE_USER (state) {
    state.auth.user = null;
  },
  REMOVE_USER_TOKEN (state) {
    state.auth.token = null;
  }
}