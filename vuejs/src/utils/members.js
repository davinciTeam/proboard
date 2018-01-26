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

function editMember(ovnumber, name, insertion, lastname, slug) {//Edit member
  return new Promise((resolve, reject) => {
  // //Set Data
    const data = {
      ovnumber: ovnumber,
      name: name,
      insertion: insertion,
      slug: slug,
      lastname: lastname
    };
    const url = `${BaseUrl}api/members/editMemberAction/`;//set Url and add Slug/id for specified user
     Axios.post(url, data).then(response => {// Do a post request
       resolve(response)
    }).catch(err => {
       reject(err);
     });
  });
}

function NewMemberAction(ovnumber, name, insertion, lastname) { //Add new member
  return new Promise((resolve, reject) => {
    const data = {
      ovnumber: ovnumber,
      name: name,
      insertion: insertion,
      lastname: lastname
    };
    const url = `${BaseUrl}api/members/NewMemberAction`;
    Axios.post(url, data).then(response => {
      resolve(response)
    }).catch(err => {
      reject(err);
    });
  });
}

export {GetAllMembers, editMember, NewMemberAction}
