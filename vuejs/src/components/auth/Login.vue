<template>
	<div class="login">
    <div class="container">
      <div class="form-signin">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputUsername" class="sr-only">Email address</label>
        <input type="text" id="inputUsername" class="form-control" placeholder="username" required="" autofocus="" v-model="username">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="" v-model="password">
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button v-on:click="login" class="btn btn-lg btn-primary btn-block">Sign in</button>
      </div>
      <div v-if="infoError" class="alert alert-danger" role="alert">
        <strong>{{errorMessage}}</strong>
      </div>
    </div>
	</div>
</template>

<script>
  import router from '@/router';
  import store from '@/store';
  import {loginWithUsernameAndPassword} from '../../utils/auth';

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
      if (store.state.isLogged) {
        router.push('/dashboard');
      }
    },
    methods: {
      login (e) {
        // e.preventDefault();
        loginWithUsernameAndPassword(this.username, this.password).then(token => {
          localStorage.setItem('token', token.jwt);
          store.commit('LOGIN_USER'); //!!!!!!IMPORTANT
          router.push('/dashboard');
        }).catch(err => {
          this.infoError = true;
          this.password = '';
        });
      }
    }
  }
</script>