import Axios from 'axios';

const BaseUrl = 'http://proboard/';

function GetAllUsers() {
  return new Promise((resolve, reject) => {
    const url = `${BaseUrl}api/users`;
    Axios.get(url).then(response => {
      resolve(response);
    }).catch(err => {
      reject(err);
    });
  });
}

function editUser(id, name, email) {
  return new Promise((resolve, reject) => {
    const data = {
      name: name,
      email: email
    };
    const url = `${BaseUrl}api/users/`+id;
    Axios.post(url, data).then(response => {
      resolve(response)
    }).catch(err => {
      reject(err);
    });
  });
}

function NewUserAction(username, name, email) {
  return new Promise((resolve, reject) => {
    const data = {
      name: name,
      email: email,
      username: username
    };
    const url = `${BaseUrl}api/users/NewUserAction`;
    Axios.post(url, data).then(response => {
      resolve(response)
    }).catch(err => {
      reject(err);
    });
  });
}

export {GetAllUsers, editUser, NewUserAction}
