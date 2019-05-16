
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
    bureauadmins(context){//permission.index route laravel
      axios.get('/api/bureauadmin/get')
      .then((response)=>{
        console.log(response.data)
        context.commit('bureauadmins', response.data.bureauadmins);
      });
    },
    bureauadminslist(context){//permission.index route laravel
        axios.get('/api/bureauadmin/get/list')
        .then((response)=>{
          console.log(response.data)
          context.commit('adminslist', response.data.admins);
        });
      },
    BureauAdminById(context, payload){
        axios.get('/api/bureauadmin/show/'+payload)
              .then((response)=>{
                  console.log(response.data);
                  context.commit('bureauadmin', response.data.bureauadmin);
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





