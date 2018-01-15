<script>
  import router from '@/router';
  import { mapActions } from 'vuex';

  export default {
    name: 'logout',
    mounted () {
      localStorage.removeItem('token');
      localStorage.removeItem('user');
      this.logout().then(setTimeout(() => {
        router.push('login');
      }, 100));
      
    },
    methods: {
      ...mapActions({logout: 'logout'})
    }
  }
</script>