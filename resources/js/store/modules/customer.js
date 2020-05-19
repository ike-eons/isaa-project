import Api from '../../service/api.js'



const state = {
    customers:[]
};

const getters = {
    allCustomers: state => state.customers
};

const mutations = {
    setCustomers(state,customers) {
        state.customers = customers
    },
    ADD_CUSTOMER(state,customer){
        let customers = state.customers.push(customer);
        state.customers = customers;
    }
};

const actions = {
    async fetchCustomers({commit}) {

         let response = await Api().get('/customers/loadcustomers'); 
        console.log(response.data.customers);         
        commit('setCustomers',response.data.customers)
    },
    async createCustomer({commit},customer){
        let response = await Api().post('/customers/store',customer);
        const savedCustomer = response.data.customers;
        commit('ADD_CUSTOMER',savedCustomer);
        return savedCustomer;
    }
};

export default {
    state,
    getters,
    mutations,
    actions
}