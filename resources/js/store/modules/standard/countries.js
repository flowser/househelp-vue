
//permission

const state = {
    countries:[],
  },
  getters = {
    Countries(state){
      return state.countries;
    }
  }
const actions = {
    countries(context,dispatch){
        axios.get('/api/country/get')
        .then((response)=>{
          console.log(response.data.countries);
          context.commit('countries', response.data.countries);
        })
        .catch((error) => {
            dispatch('countries');
        });

    }
  }
const mutations = {
    countries(state, data){
      return state.countries = data;
    }
  }

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
}
