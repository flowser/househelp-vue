
//permission

const state = {
    constituencies:[],
    countyconstituencies:[],
  },
  getters = {
    Constituencies(state){
      return state.constituencies;
    },
    CountyConstituencies(state){
      return state.countyconstituencies;
    }
  };
const actions = {
    constituencies(context,dispatch){
        axios.get('/api/constituencies/get')
        .then((response)=>{
          context.commit('constituencies', response.data.constituencies);
        })
        .catch((error) => {
            dispatch('constituencies');
        });
    },
    countyconstituencies(context, payload, dispatch){
        axios.get('/api/constituency/get/list/'+payload)//constituencies by countyconstituencies id
        .then((response)=>{
            // console.log(response.data);
          context.commit('countyconstituencies', response.data.constituencies);
          console.log(response.data.constituencies);
        })
        .catch((error) => {
            dispatch('countyconstituencies');

        });
    }
  };
const mutations = {
    constituencies(state, data){
      return state.towns = data;
    },
    countyconstituencies(state, payload){
      return state.countyconstituencies = payload;
    }
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
}
