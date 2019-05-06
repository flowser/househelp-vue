
//age module

const state = {
    ages:[],
  };
const getters = {
    Ages(state){
      return state.ages;
    },
  };
const actions = {
    ages(context){//permission.index route laravel
      axios.get('/api/agehousehelps/get')
      .then((response)=>{
        console.log(response.data, 'ages')
        context.commit('ages', response.data.ages);
      });
    },
  };
const mutations = {
    ages(state, data){
      return state.ages = data;
    },
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};








