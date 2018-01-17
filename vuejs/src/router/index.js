import Vue from 'vue'
import Router from 'vue-router'
import VueResource from 'vue-resource'
import login from '@/components/auth/Login'
import logout from '@/components/auth/Logout'
import Dashboard from '@/components/Dashboard'
import UsersOverview from '@/components/UsersOverview'
import activation from '@/components/Activation'
import BootstrapVue from 'bootstrap-vue'
import { checkLogin, setAppCookie } from '@/utils/auth'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'vue-awesome/icons'

import Icon from 'vue-awesome/components/Icon'
 
Vue.component('icon', Icon)

Vue.use(BootstrapVue);
Vue.use(Router)
Vue.use(VueResource)

const router = new Router({
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
    	component: UsersOverview,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/activateUser/:hash',
      name: 'activateUser',
      component: activation
    },
    {
      path: '/',
      name: 'dashboard',
      component: Dashboard
    },
    {
      path: '*',
      redirect: '/'
    }
  ]
})



router.beforeEach((to, from, next) => {
 if (to.matched.some(record => record.meta.requiresAuth)) {
   if (!checkLogin()) {
    setAppCookie();
     next({
       path: '/login',
       query: { redirect: to.fullPath }
     });
   } else {
     next();
   }
 } else {
   next();
 }
});

export default router;