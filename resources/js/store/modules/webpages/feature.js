
//permission

const state = {
    features:[],
  },
  getters = {
    Features(state){
      return state.features;
    },
  }
const actions = {
    features(context){
        axios.get('/api/feature/get')//based on authethicated id
        .then((response)=>{
          console.log(response.data);
          context.commit('features', response.data.features); //based on authethicated id
        });
    },
  }

const mutations = {
    features(state, data){
      return state.features = data;
    },
  }

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
}




