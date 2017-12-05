<template>
  <div class="container">
    <h1>{{ msg }}</h1>
    <div class="row">
      <div class="col-sm">
        One of three columns
      </div>
      <div class="col-sm">
        One of three columns
      </div>
      <div class="col-sm">
        One of three columns
        <button v-on:click="ajaxCall">hallo</button>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: 'HelloWorld',
  data () {
    return {
      msg: 'Welcome to Your Vue.js App'
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