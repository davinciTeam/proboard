import Vue from 'vue'
import Router from 'vue-router'
import Restfull from 'vue-resource'
import HelloWorld from '@/components/HelloWorld'
import UsersOverview from '@/components/UsersOverview'

Vue.use(Router)
Vue.use(Restfull)

export default new Router({
  routes: [
	{
      path: '/',
      name: 'HelloWorld',
      component: HelloWorld
    },
    {
    	path: '/users',
    	name: 'UsersOverview',
    	component: UsersOverview
    }
  ]
})
