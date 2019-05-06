
//client module

const state = {
    clients:[],
    client:[],
  };
const getters = {
    Clients(state){
      return state.clients;
    },
    Client(state){
      return state.client;
    }
  };
const actions = {
    client(context){//permission.index route laravel
      axios.get('/api/client/get')
      .then((response)=>{
        // console.log(response.data)
        context.commit('client', response.data.client);
      });
    },
    clients(context){//permission.index route laravel
      axios.get('/api/client/get/list')
      .then((response)=>{
        // console.log(response.data)
        context.commit('clients', response.data.clients);
      });
    },
    ClientById(context, payload){
        axios.get('/api/client/show/'+payload)
              .then((response)=>{
                //   console.log(response.data);
                  context.commit('client', response.data.client);
              });
    }

  }
const mutations = {
    clients(state, data){
      return state.clients = data;
    },
    client(state, data){
      return state.client = data;
    }
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};




