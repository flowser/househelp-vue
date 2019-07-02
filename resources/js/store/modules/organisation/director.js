
//director module

const state = {
    directors:[],
    director:[],
    pagination:[],
  };
const getters = {
    Directors(state){
      return state.directors;
    },
    director(state){
        return state.director;
    },
    DirectorPagination(){
        return state.pagination;
    }
  };
const actions = {
    directors({ dispatch, commit }, url){//permission.index route laravel
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

