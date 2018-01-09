import Vue from 'vue';
import {Http} from 'vue-resource';
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

export {loginWithUsernameAndPassword}