
require('./bootstrap');
window.Vue = require('vue');

//importing vuetify file configuration
import vuetify from './vuetify';
import 'vuetify/dist/vuetify.min.css';

//importing vue-router file
import router from './router/router.js'

//importing user
import User from './Helpers/User.js'
window.User = User

//Registering components
Vue.component('app-home', require('./components/AppHome.vue').default);

const app = new Vue({
    vuetify,
    router,
    el: '#app'
});
