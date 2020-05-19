import Api from '../../service/api.js'



const state = {
    invoices:{},
    // form:{}
};

const getters = {
    allInvoices: state => state.invoices,
    // getForm: state => state.form
};


const mutations = {
    SET_INVOICE(state,invoices) {
        state.invoices = invoices
    },
    // SET_FORM(state,form){
    //     state.form = form
        
    // },
    ADD_INVOICE(state,invoice){
        let invoices = state.invoices.push(invoice);
        state.invoices = invoices;
    },
    SEARCH_INVOICE(state,invoice){
        state.invoices = invoices
    }
};

const actions = {
    async fetchInvoices({commit}) {
        // const response =await axios.get('/admin/products/loadproducts');
        let response = await Api().get('/invoices/loadInvoice');    
        console.log(response);         
        commit('SET_INVOICE',response.data.invoices.data)
    },
    async createinvoice({commit},invoice){
        let response = await Api().post('/invoices/store',invoice);
        const savedInvoice = response.data.invoices;
        commit('ADD_INVOICE',savedInvoice);
        return savedInvoice;
    },
    // async loadInvoiceForm({commit}){
    //     let response = await Api().get('/invoices/loadinvoiceform');
    //     console.log(response);
    //     this.from = response;
    //     commit('SET_FORM',response.data.form)
    // },

};

export default {
    state,
    getters,
    mutations,
    actions
}