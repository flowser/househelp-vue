
//religion module

const state = {
    religions:[],
  };
const getters = {
    Religions(state){
      return state.religions;
    },
  };
const actions = {
    religions(context){//permission.index route laravel
      axios.get('/api/religion/get')
      .then((response)=>{
        console.log(response.data)
        context.commit('religions', response.data.religions);
      });
    },
  };
const mutations = {
    religions(state, data){
      return state.religions = data;
    },
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};








