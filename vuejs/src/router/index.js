import Vue from 'vue'
import Router from 'vue-router'
import VueResource from 'vue-resource'
import login from '@/components/auth/Login'
import logout from '@/components/auth/Logout'
import Dashboard from '@/components/Dashboard'
import UsersOverview from '@/components/UsersOverview'
import BootstrapVue from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'vue-awesome/icons'

import Icon from 'vue-awesome/components/Icon'
 
Vue.component('icon', Icon)

Vue.use(BootstrapVue);
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
    	path: '/users',
    	name: 'UsersOverview',
    	component: UsersOverview
    },
    {
    //the dashboard should always be last in routes since otherwise it would override other routes
    //routes get priority by the order defined
      path: '/:page?',
      name: 'dashboard',
      component: Dashboard
    }
  ]
})
