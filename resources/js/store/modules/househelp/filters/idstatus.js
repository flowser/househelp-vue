
//idstatuses module

const state = {
    idstatuses:[],
  };
const getters = {
    Idstatuses(state){
      return state.idstatuses;
    },
  };
const actions = {
    idstatuses(context){//permission.index route laravel
      axios.get('/api/idstatus/get')
      .then((response)=>{
        console.log(response.data.idstatuses, 'idstatuses')
        context.commit('idstatuses', response.data.idstatuses);
      });
    },
  };
const mutations = {
    idstatuses(state, data){
      return state.idstatuses = data;
    },
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};









