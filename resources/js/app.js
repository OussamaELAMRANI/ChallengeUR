import './bootstrap'

import Vue from 'vue'

import App from './run'
// Local
import router from '@/routes'
import store from './store'
//
import VeeValidate from 'vee-validate';
// import VueNotification from "@kugatsu/vuenotification";


/**
 * Plug all Plugins
 */
Vue.use(VeeValidate);
// Vue.use(VueNotification, {timer: 20});

new Vue(Vue.util.extend({router, store}, App)).$mount('#app');
