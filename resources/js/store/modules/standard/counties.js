
//permission

const state = {
    counties:[],//general counties
    countrycounties:[],//counties per coutrt id and general counies without link with countyid
  },
  getters = {
    Counties(state){
      return state.counties;
    },
    CountryCounties(state){
      return state.countrycounties;
    }
  };
const actions = {
    counties(context, dispatch){
        axios.get('/api/county/get')
        .then((response)=>{
          context.commit('counties', response.data.counties);
        })
        .catch((error) => {
            dispatch('counties');
        });
    },
    countrycounties(context, payload, dispatch){
        axios.get('/api/county/get/list/'+payload)//counties by country id
        .then((response)=>{
          context.commit('countrycounties', response.data.counties);
        })
        .catch((error) => {
            dispatch('countrycounties');
        });
    }
  };
const mutations = {
    counties(state, data){
      return state.counties = data;
    },
    countrycounties(state, payload){
      return state.countrycounties = payload;
    }
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
}
