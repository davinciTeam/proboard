import Axios from 'axios';

const BaseUrl = 'http://proboard/';//Set base url

function GetAllMembers() {
  return new Promise((resolve, reject) => {
    const url = `${BaseUrl}members`;//Use base url To complete te full url
    //Get request to `Url` 
    Axios.get(url).then(response => {
      resolve(response);
    }).catch(err => {
      reject(err);
    });
  });
}

function editMember() {//Edit member
  // return new Promise((resolve, reject) => {
  // //Set Data
  // const data = {
  //     name: name,
  //     email: email
  //   };
  //   const url = `${BaseUrl}api/users/`+id;//set Url and add Slug/id for specified user
  //   Axios.post(url, data).then(response => {// Do a post request
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
