<template>
  <div class="container">
    <h1>{{ msg }}</h1>
    <div class="row">
      <div class="col-md-12">
        One of three columns
      </div>
      <div id="app">
        {{ template }}
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: 'UsersOverview',
  data () {
    return {
      msg: 'Gebruikers overzicht',
      template:'<thead><tr><th>Gebruikersnaam</th><th>Email adres</th><th>Edit</th><th>Delete</th></tr></thead>'
    }
  },
  methods: {
    ajaxCall: function()
    {
      this.$http.get('http://proboard/dashboard').then(response => {

      this.msg = 'test';

      }, response => {
        this.msg = 'failed';
      })
    }
  }
}
</script>