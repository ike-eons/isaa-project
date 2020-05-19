window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */


import router from './router/index.js'
import bar from './components/progress'
import store from './store/index.js';
import moment from 'moment';
import Chartkick from 'vue-chartkick';
import Chart from 'chart.js';
import Vue from 'vue';

Vue.use(Chartkick.use(Chart));


window.Vue = require('vue');

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

Vue.filter('datetime',function(created){
    return moment(created).format('MMMM Do YYYY, h:mm:ss a');
 });

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

router.beforeEach((to, from, next) => {
    bar.start()
    next()
  });

Vue.filter('formatMoney', (value) => {
return Number(value)
    .toFixed(2)
    .replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
})

//components registrations

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('invoice-index', require('./components/invoices/InvoiceIndex.vue').default);
Vue.component('invoice-form', require('./components/invoices/InvoiceForm.vue').default);
Vue.component('add-stock',require('./components/stocks/AddStock.vue').default);
Vue.component('stock-form',require('./components/stocks/StockForm.vue').default);
Vue.component('bar-chart',require('./components/customers/BarChart.vue').default);
Vue.component('line-chart',require('./components/analytics/LineChart.vue').default);
Vue.component('horinzontal-chart',require('./components/analytics/HorinzontalChart.vue').default);
Vue.component('stock-intake',require('./components/dashboard/StockIntakeChart.vue').default);



const app = new Vue({
    el: '#app',
    router,
    store
});
