
//bureautribe module

const state = {
    tribes:[],
  };
const getters = {
    Tribes(state){
      return state.tribes;
    },
  };
const actions = {
    tribes(context){//permission.index route laravel
      axios.get('/api/tribe/get')
      .then((response)=>{
        console.log(response.data)
        context.commit('tribes', response.data.tribes);
      });
    },
  };
const mutations = {
    tribes(state, data){
      return state.tribes = data;
    },
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};







