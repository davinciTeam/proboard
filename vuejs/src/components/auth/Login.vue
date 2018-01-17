<template>
	<div class="login">
    <div class="container">
      <form class="form-signin">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputUsername" class="sr-only">Email address</label>
        <input type="text" id="inputUsername" class="form-control" placeholder="username" required="" autofocus="" v-model="username">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="" v-model="password">
        <button v-on:click="login" class="btn btn-lg btn-primary btn-block">Sign in</button>
      </form>
      <div v-if="infoError" class="alert alert-danger" role="alert">
        <strong>{{errorMessage}}</strong>
      </div>
    </div>
	</div>
</template>

<script>
  import router from '@/router';
  import {loginWithUsernameAndPassword, checkLogin, setAppCookie} from '@/utils/auth';

  export default {
    name: 'login',

    data () {
      return {
        infoError: false,
        errorMessage: 'Wrong username or password',
        username: '',
        password: ''
      }
    },

    beforeCreate () {
      if (checkLogin()) {
        router.push('/dashboard');
      }
    },
    methods: {
      login (e) {
        e.preventDefault();
        loginWithUsernameAndPassword(this.username, this.password).then(token => {
          localStorage.setItem('token', token.jwt);
          setAppCookie();
          if (this.$route.query.redirect) {
            router.push(this.$route.query.redirect);
          } else {
            router.push('/');
          }
        }).catch(err => {
          console.log(err);
          this.infoError = true;
          this.password = '';
        });
      }
    }
  }
</script>