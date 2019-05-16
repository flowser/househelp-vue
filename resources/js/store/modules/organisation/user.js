

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
    users(context){//permission.index route laravel
      axios.get('/api/user/get')
      .then((response)=>{
        // console.log(response.data.users)
        context.commit('users', response.data.users)
      })
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
