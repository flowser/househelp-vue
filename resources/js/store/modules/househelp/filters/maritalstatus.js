
//bureaumaritalstatus module

const state = {
    maritalstatuses:[],
  };
const getters = {
    Maritalstatuses(state){
      return state.maritalstatuses;
    },
  };
const actions = {
    maritalstatuses(context){//permission.index route laravel
      axios.get('/api/maritalstatus/get')
      .then((response)=>{
        console.log(response.data)
        context.commit('maritalstatuses', response.data.maritalstatuses);
      });
    },
  };
const mutations = {
    maritalstatuses(state, data){
      return state.maritalstatuses = data;
    },
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};







