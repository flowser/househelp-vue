
//healthstatuses module

const state = {
    healthstatuses:[],
  };
const getters = {
    Healthstatuses(state){
      return state.healthstatuses;
    },
  };
const actions = {
    healthstatuses(context){//permission.index route laravel
      axios.get('/api/healthstatus/get')
      .then((response)=>{
        console.log(response.data)
        context.commit('healthstatuses', response.data.healthstatuses);
      });
    },
  };
const mutations = {
    healthstatuses(state, data){
      return state.healthstatuses = data;
    },
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};








