import Axios from 'axios';

const BaseUrl = 'http://proboard/';

function GetAllMembers() {
  return new Promise((resolve, reject) => {
    const url = `${BaseUrl}members`;
    Axios.get(url).then(response => {
      resolve(response);
    }).catch(err => {
      reject(err);
    });
  });
}

function editMember() {//Edit member
  // return new Promise((resolve, reject) => {
  //   const data = {
  //     name: name,
  //     email: email
  //   };
  //   const url = `${BaseUrl}api/users/`+id;
  //   Axios.post(url, data).then(response => {
  //     resolve(response)
  //   }).catch(err => {
  //     reject(err);
  //   });
  // });
}

function NewMemberAction() { //Add new member
  // return new Promise((resolve, reject) => {
  //   const data = {
  //     name: name,
  //     email: email,
  //     username: username
  //   };
  //   const url = `${BaseUrl}api/users/NewUserAction`;
  //   Axios.post(url, data).then(response => {
  //     resolve(response)
  //   }).catch(err => {
  //     reject(err);
  //   });
  // });
}

export {GetAllMembers, editMember, NewMemberAction}
