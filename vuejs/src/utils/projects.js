import Axios from 'axios';

const BaseUrl = 'http://proboard/';

function getProjects() {
  return new Promise((resolve, reject) => {
    const url = `${BaseUrl}api/projects`;
    Axios.get(url).then(response => {
      resolve(response);
    }).catch(err => {
      reject(err);
    });
  });
}


export {getProjects}