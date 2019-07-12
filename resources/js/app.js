
require('./bootstrap');
window.Vue = require('vue');

// Support vuex
import Vuex from 'vuex';
Vue.use(Vuex);

import storeData from "./store/index";
const store = new Vuex.Store(
    storeData
)
import StarRating from 'vue-star-rating';
Vue.component('star-rating', StarRating);



//support moemnt js
import {filter} from './filter';

//suport Phone input vue-tel-input
import VueTelInput from 'vue-tel-input';
Vue.use(VueTelInput);


import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
Vue.use(ElementUI);

//support date picker
import {Datetime} from 'vue-datetime';
// You need a specific loader for CSS files
import 'vue-datetime/dist/vue-datetime.css';
Vue.component('datetime', Datetime);

//vue-router support
import VueRouter from 'vue-router';
Vue.use(VueRouter);



//support laravel pagination
Vue.use(require('vue-resource'));
Vue.component('pagination', require('laravel-vue-pagination'));


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('backend', require('./components/BackendMaster.vue').default);
Vue.component('frontend', require('./components/FrontendMaster.vue').default);
//support pagination
Vue.component('pagination', require('laravel-vue-pagination'));

//Vue-progress bar
import VueProgressBar from 'vue-progressbar';
Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '4px',
})

//support linkk sharing
var SocialSharing = require('vue-social-sharing');
Vue.use(SocialSharing);
//sweet alert 2
import Swal from 'sweetalert2';
window.Swal = Swal;

const toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});

window.toast = toast;

//support laravel spartie persissions
import Roles from './components/spartiepermissions/Roles.vue';
Vue.mixin(Roles);

//vform
import { Form, HasError, AlertError } from 'vform';
//make global
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
window.Form = Form;

//global registration
import VueFormWizard from 'vue-form-wizard';
import 'vue-form-wizard/dist/vue-form-wizard.min.css';
Vue.use(VueFormWizard);

import routes from './router';

const router = new VueRouter({
    mode:'history',
    routes
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
      // this route requires auth, check if logged in
      // if not, redirect to login page.
      console.log(store.getters.loggedIn, 'route')
      if (!store.getters.loggedIn) {

        let reroute =  window.location.replace('/');
        next({
                reroute
        })
      } else {
        next()
      }
    }
    // else if (to.matched.some(record => record.meta.requiresAuth)) {
    //     // if you are logged in buton browser seem snot but if try to log
    //     // in you will be directed to dashoabrd
    //     // if logged in, redirect to specified page after loged in.
    //     if (store.getters.loggedIn) {
    //       next({
    //         name: 'About',
    //       })
    //     } else {
    //       next()
    //     }
    //   }
       else {
      next() // make sure to always call next()!
    }
  })




const app = new Vue({
    el: '#app',
    router: router,
    store: store,
});
