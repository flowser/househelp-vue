
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
    admins(context){//permission.index route laravel
      axios.get('/api/orgadmin/get')
      .then((response)=>{
        console.log(response.data)
        context.commit('admins', response.data.admins);
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


