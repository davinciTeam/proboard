import Vue from 'vue'
import Router from 'vue-router'
import VueResource from 'vue-resource'
import login from '@/components/auth/login'
import Dashboard from '@/components/Dashboard'
import UsersOverview from '@/components/UsersOverview'
import AddUser from '@/components/AddUser'

Vue.use(Router)
Vue.use(VueResource)

export default new Router({
  linkActiveClass: 'active',
  routes: [
    {
      path: '/login',
      name: 'login',
      component: login
    },
    {
      path: '/dashboard/:page?',
      name: 'dashboard',
      component: Dashboard
    },
    {
      path: '/AddUser',
      name: 'AddUser',
      component: AddUser
    },
    {
    	path: '/users',
    	name: 'UsersOverview',
    	component: UsersOverview
    }
  ]
})
