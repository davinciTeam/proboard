<template>
	<nav>       
		<ul class="nav nav-tabs">
		  <li class="nav-item">
		  	<router-link class="nav-link" to="dashboard">dashboard</router-link>
		  </li>
		  <li v-if="!LoggedIn" class="nav-item">
		  	<router-link class="nav-link" to="login">Inloggen</router-link>
		  </li>
		  <li v-if="LoggedIn" class="nav-item">
		  	<router-link class="nav-link" to="users">Gebruikers</router-link>
		  </li>
		  <li v-if="LoggedIn" class="nav-item">
		  	<router-link class="nav-link" to="projects">Projecten</router-link>
		  </li>
		  <li v-if="LoggedIn" class="nav-item">
		  	<router-link class="nav-link" to="logout">Uitloggen</router-link>
		  </li>
		</ul>
    </nav>
</template>

<script>

  import {checkLogin} from '@/utils/auth';

  export default {
    name: 'navigation',
    data () {
      return {
        LoggedIn: false,
      }
    },
    created() {
      this.LoggedIn = checkLogin()
    }
  }
</script>