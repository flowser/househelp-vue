
//bureauemployee module

const state = {
    bureauemployees:[],
    bureauemployeeslist:[],
    bureauemployee:[],
    bureauemployeespagination:[],
  };
const getters = {
    BureauEmployees(state){
      return state.bureauemployees;
    },
    BureauEmployeesList(state){
        return state.bureauemployeeslist;
    },
    BureauEmployee(state){
      return state.bureauemployee;
    },
    BureauEmployeePagination(){
        return state.bureauemployeespagination;
    }
  };
const actions = {
    bureauemployees({ dispatch, commit }, url){
        return new Promise((resolve, reject) =>{
            axios.get(url)
            .then((response)=>{
                commit('bureauemployees', response.data.users.data);
                commit('bureauemployeespagination', response.data.users)
                resolve(response)
            })
            .catch(error => {
                console.log(error, 'error')
                reject(error);
            });
        });
    },
    bureauemployeeslist({ dispatch, commit }, url){//permission.index route laravel
        return new Promise((resolve, reject) =>{
            axios.get(url)
            .then((response)=>{
                commit('employeeslist', response.data.users.data)
                commit('bureauemployeespagination', response.data.users)
                resolve(response)
            })
            .catch(error => {
                console.log(error, 'error')
                reject(error);
            });
        });


      },
    BureauEmployeeById(context, payload){
        axios.get('/api/bureauemployee/show/'+payload)
              .then((response)=>{
                  console.log(response.data);
                  context.commit('employee', response.data.user);
              });
    }
  }
const mutations = {
    bureauemployees(state, data){
      return state.bureauemployees = data;
    },
    employeeslist(state, data){
        return state.bureauemployeeslist = data;
    },
    employee(state, data){
      return state.bureauemployee = data;
    },
    bureauemployeespagination(state, data){
        var pagination = {
            current_page: data.current_page,
            last_page: data.last_page,
            from: data.from,
            to: data.to,
            total: data.total,
            next_page_url: data.next_page_url,
            prev_page_url: data.prev_page_url,
        }
        return state.bureauemployeespagination = pagination;
    },
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};





