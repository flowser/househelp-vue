
//bureauenglishstatus module

const state = {
    englishstatuses:[],
  };
const getters = {
    Englishstatuses(state){
      return state.englishstatuses;
    },
  };
const actions = {
    englishstatuses(context){//permission.index route laravel
      axios.get('/api/englishstatus/get')
      .then((response)=>{
        console.log(response.data)
        context.commit('englishstatuses', response.data.englishstatuses);
      });
    },
  };
const mutations = {
    englishstatuses(state, data){
      return state.englishstatuses = data;
    },
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};








