
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
    employees(context){//permission.index route laravel
      axios.get('/api/orgemployee/get')
      .then((response)=>{
        console.log(response.data)
        context.commit('employees', response.data.employees);
      });
    },
    EmployeeById(context, payload){
        axios.get('/api/orgemployee/show/'+payload)
              .then((response)=>{
                  console.log(response.data);
                  context.commit('employee', response.data.employee);
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



