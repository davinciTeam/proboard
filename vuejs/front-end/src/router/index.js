import Vue from 'vue'
import Router from 'vue-router'
import vueResource from 'vue-resource'
import HelloWorld from '@/components/HelloWorld'
import login from '@/components/auth/login'

Vue.use(Router)
Vue.use(vueResource)

export default new Router({
  routes: [
  	{
      path: '/',
      name: 'HelloWorld',
      component: HelloWorld
    },
    {
      path: '/login',
      name: 'login',
      component: login
    }
  ]
})
