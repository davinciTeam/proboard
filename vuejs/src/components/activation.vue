<template>
  <div class="activation">
    <div class="container">
      <form class="form-signin">
        <h2 class="form-signin-heading">activeer account</h2>
        <label for="inputUsername" class="sr-only">Username</label>
        <input type="text" id="inputUsername" class="form-control" placeholder="username" required="" v-model="username" disabled="">
        <label for="inputPassword" class="sr-only">wachwoord</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="voer een nieuw wachwoord in" required="" autofocus="" v-model="password">
        <button v-on:click="activate" class="btn btn-lg btn-primary btn-block">activeer</button>
      </form>
    </div>
  </div>
</template>

<script>
  import router from '@/router';
  import {getUserWithHash, activateUserWithHashAndPassword} from '@/utils/activation';
  import {loginWithUsernameAndPassword, setAppCookie} from '@/utils/auth';
  export default {
    name: 'activation',
    beforeCreate () {
      this.hash = this.$route.params.hash;
      getUserWithHash(this.hash).then(response => {
        if(response == false) {
          router.push('/')
        } else {
          this.username = response.username;
        }
      }).catch(err => {
        // IMPORTANTCHANGE
      });
    },
    data () {
      return {
        username: '' || username,
        password: '',
        hash: '' || hash
      }
    },
    methods: {
      activate (e) {
        e.preventDefault();
        console.log(this.username);
        console.log(this.hash);
        activateUserWithHashAndPassword(this.hash, this.password).then(response => {
          if(response) {
            loginWithUsernameAndPassword(this.username, this.password).then(token => {
            localStorage.setItem('token', token.jwt);
            setAppCookie();
            router.push('/');
          }).catch(err => {
            console.log(err);
          });

          } else {
            console.log('oops something went wrong');
          }
        }).catch(err => {
          // IMPORTANTCHANGE
        });
      }
    }
  }
</script>