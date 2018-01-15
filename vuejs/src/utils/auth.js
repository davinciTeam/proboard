import Axios from 'axios';

const BaseUrl = 'http://proboard/';

function loginWithUsernameAndPassword(username, password) {
  return new Promise((resolve, reject) => {
    const data = {
      login_string: username,
      login_pass: password
    };
    const url = `${BaseUrl}login/`;
    Axios.post(url, data).then(response => {
      let token = response.data;
      resolve(token);
    }).catch(err => {
      reject(err);
    });
  });
}

function checkLogin(user) {
  const currentTime = Math.floor(new Date() / 1000);
  let isLogged = false;

  if (user !== null && typeof user != 'undefined') {
    if (user.exp <= currentTime) {
      isLogged = false;
      console.log('test');
    } else if(user.exp > currentTime) {
      isLogged = true;
      console.log('test2');
    }
  }

  console.log(isLogged);
  return isLogged;
}

export {loginWithUsernameAndPassword, checkLogin}