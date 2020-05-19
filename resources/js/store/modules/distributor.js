import Api from '../../service/api.js'



const state = {
    distributors:[]
};

const getters = {
    allDistributors: state => state.distributors
};

const mutations = {
    setDistributors(state,distributors) {
        state.distributors = distributors
    },
    ADD_DISTRIBUTOR(state,distributor){
        let distributors = state.distributors.push(distributor);
        state.distributors = distributors;
    }
};

const actions = {
    async fetchDistributors({commit}) {

        let response = await Api().get('/distributors/loaddistributors');
        console.log(response.data.distributors);         
        commit('setDistributors',response.data.distributors)
    },
};

export default {
    state,
    getters,
    mutations,
    actions
}