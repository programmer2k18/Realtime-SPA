
require('./bootstrap');
window.Vue = require('vue');
import vuetify from './vuetify';
import 'vuetify/dist/vuetify.min.css';

//Registering components
Vue.component('app-home', require('./components/AppHome.vue').default);

const app = new Vue({
    vuetify,
    el: '#app'
});
