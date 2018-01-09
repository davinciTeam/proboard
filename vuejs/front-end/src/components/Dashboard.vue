<template>
  <div class="dashboard">
    <div class="bg-light container">
      <div class="row">
        <nav>       
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" href="#/dashboard">dashboard</a>
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
          <ol class="ist-group">
            <li class="list-group-item" aria-hidden="true"><i class="ion-stop text-danger"></i> = Is al geweest.</li> 
            <li class="list-group-item" aria-hidden="true"><i class="ion-stop text-warning"></i> = Is Vandaag.</li> 
            <li class="list-group-item" aria-hidden="true"><i class="ion-stop text-success"></i> = Moet nog komen.</li> 
          </ol>
        </div>
      </div> 
      <div class="row">
        <table class="table-bordered table table-striped">
          <thead>
            <tr>
              <th v-on:click="sort" data-field="name" class="ion-arrow-up-a">Projectnaam</th>
              <th v-on:click="sort" data-field="client" class="ion-arrow-up-a">Klant</th>
              <th v-on:click="sort" data-field="teacher" class="ion-arrow-up-a">Docent</th>
              <th>Leden</th>
              <th v-on:click="sort" data-field="iteration_start" class="ion-arrow-up-a">Datum iteratie</th>
              <th v-on:click="sort" data-field="code_review_start" class="ion-arrow-up-a">Datum code review</th>
            </tr>
          </thead>
          <tbody>        
            <tr v-for="project in projects['body']['projects']">
              <td>{{ project['name'] }}
                <i :title="project['description']" class="size-14 ion-android-textsms"></i>
              </td>
              <td>{{ project['client'] }}</td>
              <td>{{ project['teacher'] }}</td>
              <td>
                <span v-for="member in project['members']">{{ member['name'] }} {{ member['insertion'] }} {{ member['lastname'] }}
                </span>
              </td>
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
      projects: '',
      sorting: '',
      order: ''
    }
  },
  created: function () {
    // `this` points to the vm instance
    this.$http.get('http://proboard/dashboard').then(response => {

      this.projects = response;


      for (var x in this.projects['body']['projects']) {
        this.projects['body']['projects'][x]['iteration_start'] = new Date(this.projects['body']['projects'][x]['iteration_start']).toDateString();
        this.projects['body']['projects'][x]['code_review_start'] = new Date(this.projects['body']['projects'][x]['code_review_start']).toDateString();
      }

    }, response => {

    })
  },
  methods: {
    sort: function(event) {
      if (this.sorting !== event.originalTarget.attributes[0].value) {
        this.sorted = 'ASC';
        this.sorting = event.originalTarget.attributes[0].value
        
        this.projects['body']['projects'].sort(function(a, b){
          var sorting = event.originalTarget.attributes[0].value;
          if (a[sorting].toLowerCase() < b[sorting].toLowerCase()) return -1
          if (a[sorting].toLowerCase() > b[sorting].toLowerCase()) return 1
        })
      } else {
        this.projects['body']['projects'].reverse();
        this.order = 'DESC';
      }
    }
  }
}
</script>


