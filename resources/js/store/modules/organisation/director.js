
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
    directors({ dispatch, commit }, url){//permission.index route laravel
        return new Promise((resolve, reject) =>{
            axios.get(url)
            .then((response)=>{
                commit('directors', response.data.directors.data)
                resolve(response)
            })
            .catch(error => {
                console.log(error, 'error')
                reject(error);
            });
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

