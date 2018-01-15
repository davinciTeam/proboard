<template>
	<div class="login">
    <div class="container">
      <form class="form-signin">
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
      </form>
      <div v-if="infoError" class="alert alert-danger" role="alert">
        <strong>{{errorMessage}}</strong>
      </div>
    </div>
	</div>
</template>

<script>
  import router from '@/router';
  import { mapGetters, mapActions } from 'vuex';
  import { loginWithUsernameAndPassword, checkLogin} from '../../utils/auth';

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

    created () {
      // if (this.$store.isLogged()) {
      //   setTimeout(() => {
      //     router.push('/dashboard');
      //   }, 2000);
      // }
      console.log(this.getUser);
    },
    computed: {
      ...mapGetters()
    },
    methods: {
      jwtDecode(token) {
        const data = token.split(".");
        return atob(data[1]);
      },
      login (e) {
        e.preventDefault();
        loginWithUsernameAndPassword(this.username, this.password).then(token => {
          const user = this.jwtDecode(token.jwt);

          localStorage.setItem('token', token.jwt);
          localStorage.setItem('user', user);



          this.$store.dispatch('login', {user: user, token: token.jwt}); //!!!!!!IMPORTANTCHANGE
          // router.push('/dashboard');
        }).catch(err => {
          console.log(err); // IMPORTANTCHANGE
          this.infoError = true;
          this.password = '';
        });
      }
    }
  }
</script>