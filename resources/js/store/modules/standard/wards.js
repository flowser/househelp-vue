
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
    wards(context){
        axios.get('/api/wards/get')
        .then((response)=>{
          context.commit('wards', response.data.wards);
        });
    },
    constituencywards(context, payload){
        axios.get('/api/ward/get/list/'+payload)//wards by constituencyward id
        .then((response)=>{
          context.commit('constituencywards', response.data.wards);
          console.log(response.data.wards);
        })
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
