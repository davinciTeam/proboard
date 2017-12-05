<template>
  <div class="dashboard">
    <div class="container">
        <table class="table table-striped">
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
            <tr v-for="project in projects['body']['projects']">
              <td>{{ project['name'] }}<span data-toggle="tooltip" title="test" class="glyphicon glyphicon-comment"></span></td>
              <td>{{ project['client'] }}</td>
              <td>{{ project['teacher'] }}</td>
              <td><p v-for="member in project['members']"> {{ member['name'] }} {{ member['insertion'] }} {{ member['lastname'] }},</p></td>
              <td>{{ project['iteration_start'] }}</td>
              <td>{{ project['code_review_start'] }}</td>
            </tr>
          </tbody>
        </table>
    </div>
  </div>
</template>
              
<script>

export default {
  name: 'dashboard',
  data () {
    return {
      projects: 'loading'
    }
  },
  created: function () {
    // `this` points to the vm instance
    this.$http.get('http://proboard/dashboard').then(response => {

      this.projects = response;

    }, response => {
      this.projects = 'failed';
    })
  }
}
</script>