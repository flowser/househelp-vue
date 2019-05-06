
//bureauemployee module

const state = {
    bureauemployees:[],
    bureauemployee:[],
  };
const getters = {
    BureauEmployees(state){
      return state.bureauemployees;
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
        context.commit('bureauemployees', response.data.bureauemployees);
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




