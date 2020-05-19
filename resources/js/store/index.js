import Vue from 'vue';
import Vuex from 'vuex';

import customer from './modules/customer.js';
import product from './modules/product.js';
import invoice from './modules/invoice.js';
import stock from './modules/stock.js';
import distributor from './modules/distributor.js'

Vue.use(Vuex);

export default new Vuex.Store({
    modules:{
        customer,
        product,
        invoice,
        stock,
        distributor
    }
});