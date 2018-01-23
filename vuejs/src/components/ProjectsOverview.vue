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
            <tr v-for="project in projects['projects']">
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
              <td><b-button variant="primary" @click="openModalEditProject(project['id'])"><icon name="pencil"></icon></b-button></td>
              <td><icon name="check" class="text-success" v-if="project['active'] == '1'"></icon><icon v-else name="times" class="text-danger" ></icon></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div>
      <b-modal hide-footer=true ref="editProject" id="edit_user" title="Gebruiker bewerken">
        <label>gebruikersnaam</label><b-form-input v-model="name" type="text" placeholder="Vul een gebruikersNaam in"></b-form-input>
        <label>email</label><b-form-input v-model="email" type="text" placeholder="Vul een email in"></b-form-input>
        <b-button class="mx-auto" variant="success" @click="closeModalEditUser">Opslaan</b-button>
      </b-modal>
    </div>
  </div>
</template>

<script>
  import {getProjects} from '@/utils/projects';
 
  export default {
    name: 'ProjectsOverview',
    data () {
      return {
        projects: {}
      }
    },
    created() {
      getProjects().then(response => {
        this.projects = response.data
        console.log(this.projects['projects'])
      }).catch(err => {
        console.log(err);
      })
    },
    methods: {
      openModalEditProject (id) {      
        this.$refs.editProject.show()
      },
      closeModalEditUser () {
        this.$refs.editProject.hide()
      }
    }
  }
</script>

