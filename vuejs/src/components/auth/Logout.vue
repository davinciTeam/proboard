<script>
  import router from '@/router';
  import { mapActions } from 'vuex';

  export default {
    name: 'logout',
    mounted () {
      localStorage.removeItem('token');
      this.logout().then( () => {
        // router.push('login');
      });
    },
    methods: {
      ...mapActions({logout: 'logout'})
    }
  }
</script>