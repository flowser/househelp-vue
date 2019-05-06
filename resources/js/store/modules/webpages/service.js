
//permission

const state = {
    services:[],
    singleservice:[],
  },
  getters = {
    Services(state){
      return state.services;
    },
    SingleService(state){
        return state.singleservice;
    },
  }
const actions = {
    services(context){
        axios.get('/api/service/get')//based on authethicated id
        .then((response)=>{
          console.log(response.data);
          context.commit('services', response.data.services); //based on authethicated id
        });
    },
    ServiceById(context, payload){
        axios.get('/api/service/show/'+payload)
              .then((response)=>{
                  context.commit('singleservice', response.data.singleservice);
              });
    },
  }

const mutations = {
    services(state, data){
      return state.services = data;
    },
    singleservice(state, data){
      return state.singleservice = data;
    }
  }

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
}



