import Vue from 'vue'
import Router from 'vue-router'
import VueResource from 'vue-resource'
import login from '@/components/auth/Login'
import logout from '@/components/auth/Logout'
import Dashboard from '@/components/Dashboard'
import UsersOverview from '@/components/UsersOverview'
import MembersOverview from '@/components/MembersOverview'
import activation from '@/components/Activation'
import ProjectsOverview from '@/components/ProjectsOverview'
import BootstrapVue from 'bootstrap-vue'
import Nav from '@/components/menu/navigation'
import { checkLogin, setAppCookie } from '@/utils/auth'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'vue-awesome/icons'

import Icon from 'vue-awesome/components/Icon'
 
Vue.component('icon', Icon)
Vue.component('navigation', Nav)

Vue.use(BootstrapVue)
Vue.use(Router)
Vue.use(VueResource)

const AppName = 'proboard '
const router = new Router({
  linkActiveClass: 'active',
  // mode: 'history',
  routes: [
    {
      path: '/login',
      name: 'login',
      component: login,
      meta: {
        title: 'inloggen'
      }
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
        requiresAuth: true,
        title: 'gebruikers'
      }
    },
    {
      path: '/activateUser/:hash',
      name: 'activateUser',
      component: activation,
      meta: {
        title: 'activatie'
      }
    },
    {
      path: '/projects',
      name: 'projects',
      component: ProjectsOverview,
      meta: {
        requiresAuth: true,
        title: 'projecten'
      }
    },
    {
      path: '/members',
      name: 'MembersOverview',
      component: MembersOverview,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: Dashboard,
      meta: {
        title: 'dashboard'
      }
    },
    {
      path: '*',
      redirect: '/dashboard'
    }
  ]
})

router.beforeEach((to, from, next) => {
 document.title = AppName+to.meta.title
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