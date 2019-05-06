
//bureaueducation module

const state = {
    educations:[],
  };
const getters = {
    Educations(state){
      return state.educations;
    },
  };
const actions = {
    educations(context){//permission.index route laravel
      axios.get('/api/education/get')
      .then((response)=>{
        console.log(response.data)
        context.commit('educations', response.data.educations);
      });
    },
  };
const mutations = {
    educations(state, data){
      return state.educations = data;
    },
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};






