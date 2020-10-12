import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Login from '../components/login/login'
import Logout from '../components/login/logout'
import Signup from '../components/login/signup'
import Forum from '../components/forum/Forum'
import SingleQuestion from '../components/forum/ReadSingleQuestion'
import CreateQuestion from '../components/forum/createQuestion'
import EditQuestion from '../components/forum/EditQuestion'
import CreateCategory from '../components/category/CreateCategory'
import Parallex from '../components/parallex'

// 2. Define some routes
// Each route should map to a component. The "component" can
const routes = [
    { path: '/', component: Parallex},
    { path: '/login', component: Login,},
    { path: '/logout', component: Logout,},
    { path: '/signup', component: Signup},
    { path: '/forum', component: Forum, name:'forum'},
    { path: '/question/:slug', component: SingleQuestion, name:'readQuestion'},
    { path: '/question/question/:questionSlug', component: EditQuestion, name:'editQuestion'},
    { path: '/ask', component: CreateQuestion},
    { path: '/Category/Create', component: CreateCategory},
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