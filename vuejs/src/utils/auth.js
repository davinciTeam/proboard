import Axios from 'axios';
import Cookies from 'js-cookie';

const BaseUrl = 'http://proboard/';

function loginWithUsernameAndPassword(username, password) {
  return new Promise((resolve, reject) => {
    const data = {
      login_string: username,
      login_pass: password
    };
    const url = `${BaseUrl}api/login/`;
    Axios.post(url, data).then(response => {
      let token = response.data;
      resolve(token);
    }).catch(err => {
      reject(err);
    });
  });
}

function jwtDecode(token) {
  const data = token.split(".");
  return atob(data[1]);
}

function setAppCookie() {
  Cookies.set('token', localStorage.getItem('token'))
}

function checkLogin() {
  const currentTime = Math.floor(new Date() / 1000);
  let isLogged = false;
  if(!!localStorage.getItem('token')) {
    const user = JSON.parse(jwtDecode(localStorage.getItem('token')));

    if (user !== null && typeof user != 'undefined') {
      if (user.exp <= currentTime) {
        isLogged = false;
      } else if(user.exp > currentTime) {
        isLogged = true;
      }
    }
  } else {
    isLogged = false;
  }
  console.log(isLogged);
  return isLogged;
}

export {loginWithUsernameAndPassword, checkLogin, setAppCookie}