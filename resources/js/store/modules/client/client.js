
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
    clients({ dispatch, commit }, url){//permission.index route laravel
        return new Promise((resolve, reject) =>{
            axios.get(url)
            .then((response)=>{
                commit('clients', response.data.clients.data)
                resolve(response)
            })
            .catch(error => {
                console.log(error, 'error')
                reject(error);
            });
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




