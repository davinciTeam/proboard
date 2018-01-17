<template>
	<nav>       
		<ul class="nav nav-tabs">
		  <li class="nav-item">
		  	<router-link class="nav-link" to="dashboard">dashboard</router-link>
		  </li>
		  <li class="nav-item">
		  	<router-link class="nav-link" to="users">gebruikers</router-link>
		  </li>
		</ul>
    </nav>
</template>

<script>
  export default {
    name: 'nav'
  }
</script>