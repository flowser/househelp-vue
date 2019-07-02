
//admin module

const state = {
    admins:[],
    admin:[],
    pagination:[],
  };
const getters = {
    Admins(state){
      return state.admins;
    },
    Admin(state){
      return state.admin;
    },
    AdminPagination(){
        return state.pagination;
    },
  };
const actions = {
    admins({ dispatch, commit }, url){//permission.index route laravel
        return new Promise((resolve, reject) =>{
            axios.get(url)
            .then((response)=>{
                commit('admins', response.data.users.data);
                commit('pagination', response.data.users);
                resolve(response);
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
    },
    pagination(state, data){
        var pagination = {
            current_page: data.current_page,
            last_page: data.last_page,
            from: data.from,
            to: data.to,
            total: data.total,
            next_page_url: data.next_page_url,
            prev_page_url: data.prev_page_url,
        }
        return state.pagination = pagination;
    },
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};


