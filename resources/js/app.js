

require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes';

// import sweet alert
import Swal from 'sweetalert2';

window.Swal = Swal;

// save toast
const Toast = Swal.mixin({
  toast: true,
  position: 'top-center',
  showConfirmButton: false,
  timer: 1000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

window.Toast = Toast;

Vue.use(VueRouter);

import HeaderComponent from './components/HeaderComponent.vue';
// import RegisterComponent from './components/RegisterComponent.vue';

// Vue.component('pagination',require('laravel-vue-pagination'))
Vue.component('my-header', HeaderComponent); //component name should be in camel-case
// Vue.component('register', HeaderComponent); //component name should be in camel-case

const router = new VueRouter({
  mode:'history',
  routes
  })

const app = new Vue({

    el:'#app',
    router
  
}).$mount("#app");


