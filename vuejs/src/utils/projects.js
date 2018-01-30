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

function editProjects(data) {
  return new Promise((resolve, reject) => {
  	const input = {
      name: data.name,
      client: data.client,
      teacher: data.teacher,
      bug_url: data.bug_url,
      trello_url: data.trello_url,
      git_url: data.git_url,
      project_url: data.project_url,
      description: data.description,
      active: data.active
    };
    const url = `${BaseUrl}api/projects/`+data.id;

    Axios.post(url, input).then(response => {
      resolve(response);
    }).catch(err => {
      reject(err);
    });

  });
}


export {getProjects, editProjects}