
//bureauadmin module

const state = {
    bureauadmins:[],
    bureauadminslist:[],
    bureauadmin:[],
  };
const getters = {
    BureauAdmins(state){
      return state.bureauadmins;
    },
    BureauAdminsList(state){
        return state.bureauadminslist;
      },
    BureauAdmin(state){
      return state.bureauadmin;
    }
  };
const actions = {
    bureauadmins({ dispatch, commit }, url){
        return new Promise((resolve, reject) =>{
            axios.get(url)
            .then((response)=>{
                console.log(response.data, 'bureau')
                commit('bureauadmins', response.data.users.data);
                resolve(response)
            })
            .catch(error => {
                console.log(error, 'error')
                reject(error);
            });
        });
    },
    bureauadminslist({ dispatch, commit }, url){//permission.index route laravel
        return new Promise((resolve, reject) =>{
            axios.get(url)
            .then((response)=>{
                commit('adminslist', response.data.users.data)
                resolve(response)
            })
            .catch(error => {
                console.log(error, 'error')
                reject(error);
            });
        });
    },
    BureauAdminById(context, payload){
        axios.get('/api/bureauadmin/show/'+payload)
              .then((response)=>{
                  console.log(response.data);
                  context.commit('bureauadmin', response.data.user);
              });
    }
  }
const mutations = {
    bureauadmins(state, data){
      return state.bureauadmins = data;
    },
    adminslist(state, data){
        return state.bureauadminslist = data;
    },
    bureauadmin(state, data){
      return state.bureauadmin = data;
    }
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};





