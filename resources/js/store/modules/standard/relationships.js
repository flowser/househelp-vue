
//permission

const state = {
    relationships:[],
  },
  getters = {
    Relationships(state){
      return state.relationships;
    }
  }
const actions = {
    relationships(context){
        axios.get('/api/relationship/get')
        .then((response)=>{
          console.log(response.data.relationships);
          context.commit('relationships', response.data.relationships);
        })
    }
  }
const mutations = {
    relationships(state, data){
      return state.relationships = data;
    }
  }

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
}



