import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Login from '../components/login/login'

// 2. Define some routes
// Each route should map to a component. The "component" can
const routes = [
    { path: '/login', component: Login },
]

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.

const router = new VueRouter({
    routes,
    hashbang:false,
    mode:'history'
})


export default router