/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import { Datetime } from 'vue-datetime';
import 'vue-datetime/dist/vue-datetime.css'

import Vue from 'vue';
import VueSweetalert2 from 'vue-sweetalert2';


Vue.component('datetime', Datetime);

Vue.use(VueSweetalert2);

import { Settings } from 'luxon'

import moment from 'moment'

Settings.defaultLocale = 'hr'



Vue.filter('date', function(value) {
    if (value) {
        return moment(String(value)).format('DD.MM.YYYY.')
    }
});

Vue.filter('time', function(value) {
    if (value) {
        return moment(String(value)).format('hh:mm')
    }
});




/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('transfers', require('./components/TransfersComponent.vue').default);
Vue.component('bakula', require('./components/BakulaComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
