
//bureauexperience module

const state = {
    experiences:[],
  };
const getters = {
    Experiences(state){
      return state.experiences;
    },
  };
const actions = {
    experiences(context){//permission.index route laravel
      axios.get('/api/experience/get')
      .then((response)=>{
        console.log(response.data)
        context.commit('experiences', response.data.experiences);
      });
    },
  };
const mutations = {
    experiences(state, data){
      return state.experiences = data;
    },
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};







