

//roles module

const state = {
      roles:[],
    }
const getters = {
      Roles(state){
        return state.roles
      }
    }
const actions = {
      roles(context){//permission.index route laravel
        axios.get('/api/role-list')
        .then((response)=>{
          console.log(response.data.roles)
          context.commit('roles', response.data.roles)
        })
      }
    }
const mutations = {
      roles(state, data){
        return state.roles = data
      }
    }


  export default {
    // namespaced: true,
    state,
    getters,
    actions,
    mutations
  }
