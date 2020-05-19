import Api from '../../service/api.js'



const state = {
    stocks:{},
    // form:{}
};

const getters = {
    allStocks: state => state.invoices,
    // getForm: state => state.form
};


const mutations = {
    SET_STOCK(stocks) {
        state.stocks = stocks
    },
    // SET_FORM(state,form){
    //     state.form = form
        
    // },
    ADD_STOCK(state,stock){
        let stocks = state.stocks.push(stock);
        state.stocks = stocks;
    },
    SEARCH_INVOICE(state,stock){
        state.stocks = stocks
    }
};

const actions = {
    async fetchStocks({commit}) {
        // const response =await axios.get('/admin/products/loadproducts');
        let response = await Api().get('/stocks/loadStock');    
        console.log(response);         
        commit('SET_INVOICE',response.data.invoices.data)
    },
    async createStock({commit},stock){
        let response = await Api().post('/stocks/store',stock);
        const savedStock = response.data.stocks;
        commit('ADD_STOCK',savedStock);
        return savedStock;
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