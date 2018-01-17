<template>
  <div class="dashboard">
    <div class="bg-light container">
      <div class="row">
        <navigation></navigation>
      </div>
      <div class="row"> 
        <h4>Legenda</h4>
        <div class="col-md-12">
            <icon name="stop" class="text-danger" aria-hidden="true"></icon> = Is al geweest.
            <icon name="stop" class="text-warning" aria-hidden="true"></icon> = Is Vandaag.
            <icon name="stop" class="text-success" aria-hidden="true"></icon> = Moet nog komen.
        </div>
      </div> 
      <div class="row">
        <table class="table-bordered table table-striped">
          <thead>
            <tr>
              <th>Projectnaam</th>
              <th>Klant</th>
              <th>Docent</th>
              <th>Leden</th>
              <th>Datum code review</th>
              <th>Datum iteratie</th>
            </tr>
          </thead>
          <tbody>        
            <tr v-for="project in projects['projects']">
              <td>{{ project['name'] }}<b-btn variant="light" v-b-popover.hover="project['description']" title="Beschrijving"><icon name="comment" title=""></icon></b-btn></td>
              <td>{{ project['client'] }}</td>
              <td>{{ project['teacher'] }}</td>
              <td><p v-for="member in project['members']"> {{ member['name'] }} {{ member['insertion'] }} {{ member['lastname'] }}</p></td>
              <td><p v-if="project['iteration_start'] != '0000-00-00 00:00:00'">{{ project['iteration_start'] }}<p v-else>Geen afspraak ingepland</p></td>
              <td><p v-if="project['code_review_start'] != '0000-00-00 00:00:00'">{{ project['code_review_start'] }}<p v-else>Geen afspraak ingepland</p></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
              
<script>

import {GetDashboardInfo} from '../utils/dashboard';

export default {
  name: 'dashboard',
  data () {
    return {
      projects: {}
    }
  },
  created() {
    GetDashboardInfo().then(response => {
      this.projects = response.data
    }).catch(err => {
      console.log(err);
    })
  }
}
</script>


