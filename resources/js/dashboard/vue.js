window.Vue = require('vue').default;
import VueToastify from 'vue-toastify';

Vue.use(VueToastify);
Vue.component('orders-tenant', require('./components/Orders/OrdersTenant.vue').default);

const app = new Vue({
    el: '#app'
});
