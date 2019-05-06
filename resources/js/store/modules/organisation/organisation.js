
//permission

const state = {
    organisation:[],
    organisations:[],
  },
  getters = {
    Organisation(state){
      return state.organisation;
    },
    Organisations(state){
      return state.organisations;
    }
  }
const actions = {
    organisation(context){
        axios.get('/api/organisation/get')
        .then((response)=>{
        //   console.log(response.data.organisation);
          context.commit('organisation', response.data.organisation);
        })
    },
    organisations(context){
        axios.get('/api/organisations/get')
        .then((response)=>{
        //   console.log(response.data.organisations);
          context.commit('organisations', response.data.organisations);
        })
    }
  }
const mutations = {
    organisation(state, data){
      return state.organisation = data;
    },
    organisations(state, data){
      return state.organisations = data;
    }
  }

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
}
