

//user module

const state = {
    users:[],
    usertypes:[],
  }
const getters = {
    Users(state){
      return state.users
    },
    UserTypes(state){
      return state.usertypes
    }
  }
const actions = {
    userslist({ dispatch, commit }, url){//permission.index route laravel
        return new Promise((resolve, reject) =>{
            axios.get(url)
            .then((response)=>{
                commit('users', response.data.users.data)
                resolve(response)
            })
            .catch(error => {
                console.log(error, 'error')
                reject(error);
            });
        });
    },
    usertypes(context){//permission.index route laravel
      axios.get('/api/usertypes/get')
      .then((response)=>{
        // console.log(response.data.users)
        context.commit('usertypes', response.data.usertypes)
      })
    }
  }
const mutations = {
    users(state, data){
      return state.users = data
    },
    usertypes(state, usertypes){
      return state.usertypes = usertypes
    }
  }


export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
}
