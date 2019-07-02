
//bureaudirector module

const state = {
    bureaudirectors:[],
    bureaudirectorslist:[],
    bureaudirector:[],
    pagination:[],
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
    },
    BureauDirectorPagination(){
        return state.pagination;
    }
  };
const actions = {
    bureaudirectors({ dispatch, commit }, url){
        return new Promise((resolve, reject) =>{
            axios.get(url)
            .then((response)=>{
                commit('directors', response.data.users.data);
                commit('pagination', response.data.users)
                resolve(response)
            })
            .catch(error => {
                console.log(error, 'error')
                reject(error);
            });
        });
    },
    bureaudirectorslist({ dispatch, commit }, url){//permission.index route laravel
        return new Promise((resolve, reject) =>{
            axios.get(url)
            .then((response)=>{
                commit('directorslist', response.data.users.data)
                commit('pagination', response.data.users)
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
    },
    pagination(state, data){
        var pagination = {
            current_page: data.current_page,
            last_page: data.last_page,
            from: data.from,
            to: data.to,
            total: data.total,
            next_page_url: data.next_page_url,
            prev_page_url: data.prev_page_url,
        }
        return state.pagination = pagination;
    },
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};



