import Axios from 'axios';

const BaseUrl = 'http://proboard/';

function GetDashboardInfo() {
  return new Promise((resolve, reject) => {
    const url = `${BaseUrl}dashboard`;
    Axios.get(url).then(response => {
      resolve(response);
    }).catch(err => {
      reject(err);
    });
  });
}


export {GetDashboardInfo}