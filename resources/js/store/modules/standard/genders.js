
//permission

const state = {
    genders:[],
  },
  getters = {
    Genders(state){
      return state.genders;
    }
  }
const actions = {
    genders(context){
        axios.get('/api/gender/get')
        .then((response)=>{
          console.log(response.data.genders);
          context.commit('genders', response.data.genders);
        })
    }
  }
const mutations = {
    genders(state, data){
      return state.genders = data;
    }
  }

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
}


