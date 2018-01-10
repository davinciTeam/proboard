<template>
  <div class="dashboard">
    <div class="bg-light container">
      <div class="row">
        <nav>       
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" href="#/">dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#/users">gebruikers</a>
            </li>
          </ul>
        </nav>
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
            <tr v-for="project in projects['body']['projects']">
              <td>{{ project['name'] }}<b-btn variant="light" v-b-popover.hover="project['description']" title="Beschrijving"><icon name="comment" title=""></icon></b-btn></td>
              <td>{{ project['client'] }}</td>
              <td>{{ project['teacher'] }}</td>
              <td><p v-for="member in project['members']"> {{ member['name'] }} {{ member['insertion'] }} {{ member['lastname'] }}</p></td>
              <td>{{ project['iteration_start'] }}</td>
              <td>{{ project['code_review_start'] }}</td>
            </tr>
          </tbody>
        </table>
      </div>
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


