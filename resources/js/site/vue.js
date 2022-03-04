window.Vue = require('vue').default;
import VueToastify from 'vue-toastify';

Vue.use(VueToastify);
Vue.component('contact-component', require('./components/Contact.vue').default);

const app = new Vue({
    el: '#app'
});
