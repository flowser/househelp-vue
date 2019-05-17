
//bureaudirector module

const state = {
    bureaudirectors:[],
    bureaudirectorslist:[],
    bureaudirector:[],
  };
const getters = {
    BureauDirectors(state){
      return state.bureaudirectors;
    },
    BureauDirectorsList(state){
      return state.bureaudirectorslist;
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
    bureaudirectorslist({ dispatch, commit }, url){//permission.index route laravel
        return new Promise((resolve, reject) =>{
            axios.get(url)
            .then((response)=>{
                commit('directorslist', response.data.directors.data)
                resolve(response)
            })
            .catch(error => {
                console.log(error, 'error')
                reject(error);
            });
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
    directorslist(state, data){
      return state.bureaudirectorslist = data;
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



