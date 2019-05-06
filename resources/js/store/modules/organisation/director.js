
//director module

const state = {
    directors:[],
    director:[],
  };
const getters = {
    Directors(state){
      return state.directors;
    },
    director(state){
        return state.director;
      }
  };
const actions = {
    directors(context){//permission.index route laravel
      axios.get('/api/orgdirector/get')
      .then((response)=>{
        console.log(response.data)
        context.commit('directors', response.data.directors);
      });
    },
    DirectorById(context, payload){
        axios.get('/api/orgdirector/show/'+payload)
              .then((response)=>{
                  console.log(response.data);
                  context.commit('director', response.data.director);
              });
    }
  }
const mutations = {
    directors(state, data){
      return state.directors = data;
    },
    director(state, data){
        return state.director = data;
      }
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};

