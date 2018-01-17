import Axios from 'axios';

const BaseUrl = 'http://proboard/';

function getUserWithHash(hash) {
  return new Promise((resolve, reject) => {
    const url = `${BaseUrl}api/users/activateUser/${hash}`;
    Axios.get(url).then(response => {
      let user = response.data;
      resolve(user);
    }).catch(err => {
      reject(err);
    });
  });
}

function activateUserWithHashAndPassword(hash, password) {
  return new Promise((resolve, reject) => {
    const url = `${BaseUrl}api/users/activateUser/${hash}`;
    let data = {
      password
    }
    Axios.post(url, data).then(response => {
      let user = response.data;
      resolve(user);
    }).catch(err => {
      reject(err);
    });
  });
}

export {getUserWithHash, activateUserWithHashAndPassword}