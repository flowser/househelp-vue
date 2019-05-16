
//permission

const state = {
    positions:[],
  },
  getters = {
    Positions(state){
      return state.positions;
    }
  }
const actions = {
    positions(context,dispatch){
        axios.get('/api/position/get')
        .then((response)=>{
          console.log(response.data.positions);
          context.commit('positions', response.data.positions);
        })
        .catch((error) => {
            dispatch('positions');
        });
    }
  }
const mutations = {
    positions(state, data){
      return state.positions = data;
    }
  }

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
}


