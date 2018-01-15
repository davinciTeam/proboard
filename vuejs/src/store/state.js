export default {
  auth: {
    // !! sets the state to false if undifined or null.
    token: localStorage.getItem('token'),
    user: JSON.parse(localStorage.getItem('user'))
  }
}
//!!!!!!!!!IMPORTANT