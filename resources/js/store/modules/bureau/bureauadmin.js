
//bureauadmin module

const state = {
    bureauadmins:[],
    bureauadminslist:[],
    bureauadmin:[],
    bureauadminspagination:[],
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
    },
    BureauAdminPagination(){
        return state.bureauadminspagination;
    }
  };
const actions = {
    bureauadmins({ dispatch, commit }, url){
        return new Promise((resolve, reject) =>{
            axios.get(url)
            .then((response)=>{
                console.log(response.data, 'bureau')
                commit('bureauadmins', response.data.users.data);
                commit('bureauadminspagination', response.data.users)
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
                commit('bureauadminspagination', response.data.users)
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
    },
    bureauadminspagination(state, data){
        var pagination = {
            current_page: data.current_page,
            last_page: data.last_page,
            from: data.from,
            to: data.to,
            total: data.total,
            next_page_url: data.next_page_url,
            prev_page_url: data.prev_page_url,
        }
        return state.bureauadminspagination = pagination;
    },
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};





