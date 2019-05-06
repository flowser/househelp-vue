

//user module

const state = {
    users:[],
  }
const getters = {
    Users(state){
      return state.users
    }
  }
const actions = {
    users(context){//permission.index route laravel
      axios.get('/api/user/get')
      .then((response)=>{
        // console.log(response.data.users)
        context.commit('users', response.data.users)
      })
    }
  }
const mutations = {
    users(state, data){
      return state.users = data
    }
  }


export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
}
