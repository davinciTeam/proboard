import Vue from 'vue'
import Router from 'vue-router'
import VueResource from 'vue-resource'
import login from '@/components/auth/Login'
import logout from '@/components/auth/Logout'
import Dashboard from '@/components/Dashboard'
import UsersOverview from '@/components/UsersOverview'

Vue.use(Router)
Vue.use(VueResource)

export default new Router({
  linkActiveClass: 'active',
  // mode: 'history',
  routes: [
    {
      path: '/login',
      name: 'login',
      component: login
    },
    {
      path: '/logout',
      name: 'logout',
      component: logout
    },
    {
      path: '/dashboard/:page?',
      name: 'dashboard',
      component: Dashboard
    },
    {
    	path: '/users',
    	name: 'UsersOverview',
    	component: UsersOverview
    }
  ]
})
