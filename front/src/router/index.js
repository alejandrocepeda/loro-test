import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({		
	routes: [
		{
            path: '/',			
            redirect: {name:'register'},		
            component: () => import('@/App'),
			children: [								
				{
					path: 'customers',
					name: 'customers',					
					component: () => import('@/components/Customers'),
				},
				{
					path: 'register',
					name: 'register',					
					component: () => import('@/components/Register'),
				}
			]
		}
  ]
})

