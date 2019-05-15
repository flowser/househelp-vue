
//permission

const state = {
      permissions:[],
    },
    getters = {
      Permissions(state){
        return state.permissions
      },
    }
const actions = {
      permissions(context){//permission.index route laravel
        axios.get('/api/permission-list')
        .then((response)=>{
          console.log(response.data.permissions)
          context.commit('permissions', response.data.permissions)
        })
      },
    }
const mutations = {
      permissions(state, data){
        return state.permissions = data
      },
    }

  export default {
    // namespaced: true,
    state,
    getters,
    actions,
    mutations
  }
