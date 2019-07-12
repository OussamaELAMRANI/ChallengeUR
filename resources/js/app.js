import './bootstrap'

import Vue from 'vue'

import App from './run'
// Local
import router from '@/routes'
import store from './store'
import '@/permission'; // permission control

//
import VeeValidate from 'vee-validate';

import VueNotification from "@kugatsu/vuenotification";


/**
 * Plug all Plugins
 */
const vee_config = {
    aria: true,
    classNames: {},
    classes: false,
    delay: 500,
    dictionary: null,
    errorBagName: 'errors', // change if property conflicts
    events: 'input|blur',
    fieldsBagName: 'fields',
    locale: 'en',
    validity: false,
    useConstraintAttrs: true
};
Vue.use(VeeValidate, vee_config);
Vue.use(VueNotification, {timer: 20, showCloseIcn: true});

new Vue(Vue.util.extend({router, store}, App)).$mount('#app');
