/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

 import Vue from 'vue';
 import Vuex from 'vuex';
 import BootstrapVue from 'bootstrap-vue';

 import Quotes from './components/Quotes.vue';
 import Navheader from './components/Navheader.vue';

 Vue.use(BootstrapVue);
 Vue.use(Vuex);


 /**
  * Next, we will create a fresh Vue application instance and attach it to
  * the page. Then, you may begin adding components to this application
  * or customize the JavaScript scaffolding to fit your unique needs.
  */

 Vue.component('quotes', Quotes);
 Vue.component('navheader', Navheader);

 const store = new Vuex.Store({
     state: {
         filter: ''
     },
     mutations: {
        updateFilter (state, message) {
            state.filter = message;
        }
    }
 })

 const app = new Vue({
     el: '#app',
     store: store,
     components: { Quotes, Navheader }
 });
