import Api from '../../service/api.js'



const state = {
    products:[]
};

const getters = {
    allProducts: state => state.products
};

const mutations = {
    SET_PRODUCT(state,products) {
        state.products = products
    },
    ADD_PRODUCT(state,product){
        let products = state.products.push(product);
        state.products = products;
    },
    SEARCH_PRODUCT(state,product){
        state.products = products
    }
};

const actions = {
    async fetchProducts({commit}) {
        // const response =await axios.get('/admin/products/loadproducts');
        let response = await Api().get('/products/loadproducts');    
        console.log(response);         
        commit('SET_PRODUCT',response.data.products)
    },
    async createproduct({commit},product){
        let response = await Api().post('/products/store',product);
        const savedProduct = response.data.products;
        commit('ADD_PRODUCT',savedProduct);
        return savedProduct;
    },
    async searchProduct({commit}) {
        let response = await Api().get('/products/search');    
        console.log(response);         
        commit('SEARCH_PRODUCT',response.data.products)
    }
};

export default {
    state,
    getters,
    mutations,
    actions
}