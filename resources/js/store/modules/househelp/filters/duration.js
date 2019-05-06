
//duration module

const state = {
    durations:[],
  };
const getters = {
    Durations(state){
      return state.durations;
    },
  };
const actions = {
    durations(context){//permission.index route laravel
      axios.get('/api/duration/get')
      .then((response)=>{
        console.log(response.data)
        context.commit('durations', response.data.durations);
      });
    },
  };
const mutations = {
    durations(state, data){
      return state.durations = data;
    },
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};








