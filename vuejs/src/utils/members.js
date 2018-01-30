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

/* Const data 
Ov number: ov number of the member
name: name of the member
insertion: insertion of the member
slug: slug of the member exist out the `name` 
 lastname: lastname of the member
This function edits a member we use the `url` to do a post request.
We set url by using the base url that is set above an complete the rest of the url by setting it in the function
  */

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
