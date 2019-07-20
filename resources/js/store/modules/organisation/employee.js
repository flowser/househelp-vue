
//employee module

const state = {
    employees:[],
    employee:[],
    employeespagination:[],
  };
const getters = {
    Employees(state){
      return state.employees;
    },
    Employee(state){
      return state.employee;
    },
    EmployeePagination(state){
      return state.employeespagination;
    }
  };
const actions = {
    employees({ dispatch, commit }, url){//permission.index route laravel
        return new Promise((resolve, reject) =>{
            axios.get(url)
            .then((response)=>{
                commit('employees', response.data.users.data)
                commit('employeespagination', response.data.users)
                resolve(response)
            })
            .catch(error => {
                console.log(error, 'error')
                reject(error);
            });
        });
    },
    EmployeeById(context, payload){
        axios.get('/api/orgemployee/show/'+payload)
              .then((response)=>{
                  console.log(response.data);
                  context.commit('employee', response.data.user);
              });
    }

  }
const mutations = {
    employees(state, data){
      return state.employees = data;
    },
    employee(state, data){
      return state.employee = data;
    },
    employeespagination(state, data){
        var pagination = {
            current_page: data.current_page,
            last_page: data.last_page,
            from: data.from,
            to: data.to,
            total: data.total,
            next_page_url: data.next_page_url,
            prev_page_url: data.prev_page_url,
        }
        return state.employeespagination = pagination;
    },
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};



