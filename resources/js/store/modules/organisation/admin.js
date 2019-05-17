
//admin module

const state = {
    admins:[],
    admin:[],
  };
const getters = {
    Admins(state){
      return state.admins;
    },
    Admin(state){
      return state.admin;
    }
  };
const actions = {
    admins({ dispatch, commit }, url){//permission.index route laravel
        return new Promise((resolve, reject) =>{
            axios.get(url)
            .then((response)=>{
                commit('admins', response.data.admins.data)
                resolve(response)
            })
            .catch(error => {
                console.log(error, 'error')
                reject(error);
            });
        });
    },
    AdminById(context, payload){
        axios.get('/api/orgadmin/show/'+payload)
              .then((response)=>{
                  console.log(response.data);
                  context.commit('admin', response.data.admin);
              });
    }


  }
const mutations = {
    admins(state, data){
      return state.admins = data;
    },
    admin(state, data){
      return state.admin = data;
    }
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};


