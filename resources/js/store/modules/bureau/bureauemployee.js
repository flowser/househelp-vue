
//bureauemployee module

const state = {
    bureauemployees:[],
    bureauemployeeslist:[],
    bureauemployee:[],
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
    }
  };
const actions = {
    bureauemployees(context){//permission.index route laravel
      axios.get('/api/bureauemployee/get')
      .then((response)=>{
        console.log(response.data)
        context.commit('bureauemployees', response.data.employees);
      });
    },
    bureauemployeeslist({ dispatch, commit }, url){//permission.index route laravel
        return new Promise((resolve, reject) =>{
            axios.get(url)
            .then((response)=>{
                commit('employeeslist', response.data.employees.data)
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
                  context.commit('employee', response.data.employee);
              });
    }
  }
const mutations = {
    employees(state, data){
      return state.bureauemployees = data;
    },
    employeeslist(state, data){
        return state.bureauemployeeslist = data;
    },
    employee(state, data){
      return state.bureauemployee = data;
    }
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};





