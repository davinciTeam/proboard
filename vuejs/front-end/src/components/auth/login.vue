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
        loader: false,
        infoError: false,
        username: '',
        password: ''
      }
    },

    beforeCreate () {
      if (store.state.isLogged) {
        router.push('/');
      }
    },
    methods: {
      login (e) {
        // e.preventDefault();
        loginWithUsernameAndPassword(this.username, this.password).then(token => {
          // localStorage.setItem('token', token.jwt);
          // router.push('/dashboard');
          console.log(token);
        }).catch(err => {
          console.log(err);
          this.password = '';
        });
      }
    }
  }
</script>