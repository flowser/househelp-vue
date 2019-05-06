
//bureaudirector module

const state = {
    bureaudirectors:[],
    bureaudirector:[],
  };
const getters = {
    BureauDirectors(state){
      return state.bureaudirectors;
    },
    BureauDirector(state){
      return state.bureaudirector;
    }
  };
const actions = {
    bureaudirectors(context){//permission.index route laravel
      axios.get('/api/bureaudirector/get')
      .then((response)=>{
        console.log(response.data)
        context.commit('directors', response.data.directors);
      });
    },
    BureauDirectorById(context, payload){
        axios.get('/api/bureaudirector/show/'+payload)
              .then((response)=>{
                  console.log(response.data);
                  context.commit('director', response.data.director);
              });
    }
  }
const mutations = {
    directors(state, data){
      return state.bureaudirectors = data;
    },
    director(state, data){
      return state.bureaudirector = data;
    }
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};



