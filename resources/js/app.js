/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue';
import Buefy from 'buefy';
import VueRouter from 'vue-router';
import routes from './routes';
import 'buefy/dist/buefy.css';
import { library } from '@fortawesome/fontawesome-svg-core';
import { fas } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import Notifications from 'vue-notification';

export const bus = new Vue();

Vue.use(Notifications);
Vue.use(VueRouter);
library.add(fas);
Vue.component('vue-fontawesome', FontAwesomeIcon);


Vue.use(Buefy, {
  defaultIconComponent: "vue-fontawesome",
  defaultIconPack: "fas",
  customIconPacks: {
    fas: {
      sizes: {
        default: "lg",
        "is-small": "1x",
        "is-medium": "2x",
        "is-large": "3x"
      },
      iconPrefix: ""
    }
  }
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('navbar', require('./components/Navbar.vue').default);
Vue.component('sidebar', require('./components/Sidebar.vue').default);
Vue.component('flybutton', require('./components/FlyButton.vue').default);
Vue.component('app', require('./components/App.vue').default);
Vue.component('dashboard-table', require('./components/Dashboard_table.vue').default);
Vue.component('animated-integer', require('./components/AnimatedNumber.vue').default);
Vue.component('float-btn', require('./components/FloatButton.vue').default);
Vue.component('mail-form', require('./components/SendMailForm.vue').default);
Vue.component('employee-form', require('./components/AddEmployeeForm.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes)
});

 // Validate 
import { required, confirmed, length, email } from "vee-validate/dist/rules";
import { extend } from "vee-validate";

extend("required", {
  ...required,
  message: "This field is required"
});

extend("email", {
  ...email,
  message: "This field must be a valid email"
});

extend("confirmed", {
  ...confirmed,
  message: "This field confirmation does not match"
});

extend("length", {
  ...length,
  message: "This field must have 2 options"
});

extend('nochars', {
  validate(value, args) {
    const prohibited = '`1234567890=!@#$%^&_+~*(){}[]|/<>?,^:;!"№'.split('');
    let counter = 0;
    prohibited.forEach(char => {
      if(value.includes(char)) {
        counter++;
      } 
    })
    if (counter === 0)
      return true;
    },
    message: 'Letters only'
});


