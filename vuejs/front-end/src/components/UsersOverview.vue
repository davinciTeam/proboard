<template>
  <div class="UserOverview">
    <div class="container">
      <div class="row">
        <nav>       
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link" href="#/dashboard">dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#/users">gebruikers</a>
            </li>
          </ul>
        </nav>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table class="table table-bordered table-hover">
            <thead class="thead-dark">
              <tr>
                <th>Gebruikersnaam</th>
                <th>Email adres</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Actief</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="user in users_data['body']['users']">
                <td>{{ user['name'] }}</td>
                <td>{{ user['email'] }}</td>
                <td><a href="#"><i class="ion-edit"></i></a></td>
                <td><a href="#"><i class="ion-trash-a"></i></a></td>
                <td><i v-if="user['active'] == '1'" class="ion-android-done text-success"></i><i v-else class="ion-close-round text-danger"></i></td>
              </tr>
              
            </tbody>
          </table>
        </div>
        <div id="app">
         
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: 'UserOverview',
  data () {
    return {
      users_data: 'UserOverview'
    }
  },
  created: function () {
    // `this` points to the vm instance
    this.$http.get('http://proboard/Users').then(response => {

      this.users_data = response;
      console.log(this.users_data['body']['users'])

    }, response => {
      this.users_data = 'failed';
    })
  }
}
</script>