
//employee module

const state = {
    employees:[],
    employee:[],
  };
const getters = {
    Employees(state){
      return state.employees;
    },
    Employee(state){
      return state.employee;
    }
  };
const actions = {
    employees({ dispatch, commit }, url){//permission.index route laravel
        return new Promise((resolve, reject) =>{
            axios.get(url)
            .then((response)=>{
                commit('employees', response.data.users.data)
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
    }
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};



