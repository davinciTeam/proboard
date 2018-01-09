<template>
  <div class="userOverview">
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
          <form action="">
            <label for="text">Naam</label>
              <div class="input-group">            
                <input type="text" name="name">
              </div>
            <label for="email">Email</label>
              <div class="input-group">
                <input type="email" name="email">
              </div><br>
              <button type="submit">Aanmaken</button>
          </form>
          
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