<template>
	<div class="login">
    <div class="container">
      <form class="form-signin">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button v-on:click="loginWithUsernameAndPassword" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div>
	</div>
</template>

<script>
  export default {
    name: 'login',
    data () {
      return {
        BasePath: 'http://proboard/',
        username: 'admin',
        password: 'admin'
      }
    },
    methods: {
      loginWithUsernameAndPassword: function(e) {
        // in the future must be moved to a separate file
        e.preventDefault();
        // this.$http.post(this.BasePath+'api/login', {login_string: this.username, login_pass: this.password}).then(response => {
        //   alert('success?');
        //   console.log(response);
        // }).catch(err => {
        //   console.log(err);
        // });

        this.$http.jsonp(this.BasePath+'api/login').then(response => {
        // get body data
        console.log(response.body)
        }, response => { // error callback 
          console.log('test');
        });
      }
    }
  }
</script>