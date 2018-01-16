<script>
  import router from '@/router';

  export default {
    name: 'logout',
    mounted () {
      localStorage.removeItem('token');
      router.push('login');
    },
  }
</script>