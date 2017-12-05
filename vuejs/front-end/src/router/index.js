import Vue from 'vue'
import Router from 'vue-router'
import VueResource from 'vue-resource'
import Dashboard from '@/components/Dashboard'

Vue.use(Router)
Vue.use(VueResource)

export default new Router({
  routes: [
	{
      path: '/',
      name: 'dashboard',
      component: Dashboard
    }
  ]
})
