
//operation module

const state = {
    operations:[],
  };
const getters = {
    Operations(state){
      return state.operations;
    },
  };
const actions = {
    operations(context){//permission.index route laravel
      axios.get('/api/operation/get')
      .then((response)=>{
        console.log(response.data)
        context.commit('operations', response.data.operations);
      });
    },
  };
const mutations = {
    operations(state, data){
      return state.operations = data;
    },
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};








