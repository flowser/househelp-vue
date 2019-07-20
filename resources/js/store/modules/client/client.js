
//client module

const state = {
    clients:[],
    client:[],
    clientspagination:[],
  };
const getters = {
    Clients(state){
      return state.clients;
    },
    Client(state){
      return state.client;
    },
    ClientPagination(state){
      return state.clientspagination;
    },
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
                commit('clients', response.data.users.data)
                commit('clientspagination', response.data.users)
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
    },
    clientspagination(state, data){
        var pagination = {
            current_page: data.current_page,
            last_page: data.last_page,
            from: data.from,
            to: data.to,
            total: data.total,
            next_page_url: data.next_page_url,
            prev_page_url: data.prev_page_url,
        }
        return state.clientspagination = pagination;
    },
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};




