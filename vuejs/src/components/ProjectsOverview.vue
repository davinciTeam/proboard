<template>
  <div class="ProjectsOverview">
    <div class="container">
      <div class="row">
        <navigation></navigation>
      </div>
      <div class="row">
        <table class="table-bordered table table-striped">
          <thead>
            <tr>
              <th>Projectnaam</th>
              <th>Klant</th>
              <th>Docent</th>
              <th>Leden</th>
              <th>Links</th>
              <th>Acties</th>
              <th>Actief</th>
            </tr>
          </thead>
          <tbody>        
            <tr v-for="(project, index) in projects['projects']">
              <td>{{ project['name'] }}<b-btn variant="light" v-b-popover.hover="project['description']" title="Beschrijving"><icon name="comment"></icon> <span v-for="tags in project['tags']"><b-badge variant="info">{{ tags['name'] }}</b-badge></span></b-btn>
              </td>
              <td>{{ project['client'] }}</td>
              <td>{{ project['teacher'] }}</td>
              <td><p v-for="member in project['members']"> {{ member['name'] }} {{ member['insertion'] }} {{ member['lastname'] }}</p></td>
              <td>
                <a target="_blank" :href="project['bug_url']">Bug tracking url</a><br>
                <a target="_blank" :href="project['trello_url']">Trello url</a><br>
                <a target="_blank" :href="project['git_url']">Repository url</a><br>
                <a target="_blank" :href="project['project_url']">Project url</a>
              </td>
              <td><b-button variant="primary" @click="openModalEditProject(index)"><icon name="pencil"></icon></b-button></td>
              <td><icon name="check" class="text-success" v-if="project['active'] == '1'"></icon><icon v-else name="times" class="text-danger"></icon></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div>
      <b-modal hide-footer=true ref="editProject" id="edit_user" title="Project bewerken">
        <label>Naam</label><b-form-input v-model="projects['projects'][index].name" type="text" placeholder="Vul een naam in"></b-form-input>
        <label>Klant</label><b-form-input v-model="projects['projects'][index].client" type="text" placeholder="Vul een email in"></b-form-input>
        <label>Docent</label><b-form-input v-model="projects['projects'][index].teacher" type="text" placeholder="Vul een email in"></b-form-input>
        <label>Actief</label> <b-form-checkbox v-model="projects['projects'][index].active"></b-form-checkbox><br>
        <label>Bug tracking url</label><b-form-input v-model="projects['projects'][index].bug_url" type="url" placeholder="Vul een email in"></b-form-input>
        <label>Trello url</label><b-form-input type="url" v-model="projects['projects'][index].trello_url" placeholder="Vul een email in"></b-form-input>
        <label>Repository url</label><b-form-input v-model="projects['projects'][index].git_url" type="url" placeholder="Vul een email in"></b-form-input>
        <label>Project url</label><b-form-input v-model="projects['projects'][index].project_url" type="url" placeholder="Vul een email in"></b-form-input>
        <label>Beschrijving</label><b-form-textarea id="textarea1" v-model="projects['projects'][index].description" placeholder="Enter something" :rows="3" :max-rows="6"></b-form-textarea>
        <b-button class="mx-auto" variant="success" @click="closeModalEditUser()">Opslaan</b-button>
      </b-modal>
    </div>
  </div>
</template>

<script>
  import {getProjects, editProjects} from '@/utils/projects';
 
  export default {
    name: 'ProjectsOverview',
    data () {
      return {
        projects: {},
        index: 0
      }
    },
    created() {
      getProjects().then(response => {
        this.projects = response.data
        console.log(this.projects['projects'][0])
      }).catch(err => {
        console.log(err);
      })
    },
    methods: {
      openModalEditProject (index) {
        this.index = index;
        this.$refs.editProject.show();
      },
      closeModalEditUser () {
        editProjects(this.projects['projects'][index]).then(response => {
          this.$refs.editProject.hide()
        }).catch(err => {
          console.log(err);
        })
      }
    }
  }
</script>

