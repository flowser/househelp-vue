
//permission

const state = {
    wards:[],
    constituencywards:[],
  },
  getters = {
    Wards(state){
      return state.wards;
    },
    ConstituencyWards(state){
      return state.constituencywards;
    }
  };
const actions = {
    wards(context,dispatch){
        axios.get('/api/wards/get')
        .then((response)=>{
          context.commit('wards', response.data.wards);
        })
        .catch((error) => {
            dispatch('wards');
        });
    },
    constituencywards(context, payload,dispatch){
        axios.get('/api/ward/get/list/'+payload)//wards by constituencyward id
        .then((response)=>{
          context.commit('constituencywards', response.data.wards);
          console.log(response.data.wards);
        })
        .catch((error) => {
            dispatch('constituencywards');
        });
    }
  };
const mutations = {
    wards(state, data){
      return state.wards = data;
    },
    constituencywards(state, payload){
      return state.constituencywards = payload;
    }
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
}
