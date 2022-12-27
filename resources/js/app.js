import Vue from 'vue'
import App from './App.vue'
import router from './routes'
import VueSweetalert2 from 'vue-sweetalert2';
import { http } from './api.js'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.prototype.$http = http;

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(VueSweetalert2);

const app = new Vue({
    el: '#app',
    router,
    template: '<App/>',
    components: { App },
});
