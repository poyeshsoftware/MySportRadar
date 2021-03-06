/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import axios from 'axios'

window.Vue = require('vue');
Vue.use(VueRouter);

import routes from './routes'

import App from './App'
import store from './store/index'
// import Vuetify from './plugins/vuetify'

// import {Datetime} from 'vue-datetime'
//
// Vue.use(Datetime);

// import Vuetify from 'vuetify';
// Vue.use(Vuetify);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// vuetify: Vuetify,

// vuetify: new Vuetify(),
const app = new Vue({
    el: '#app',
    store,
    components: {App},
    router: new VueRouter(routes)
});
