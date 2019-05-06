
//bureauhousehelpkin module

const state = {
    househelpkins:[],
    househelpkin:[],
  };
const getters = {
    Househelpkins(state){
      return state.househelpkins;
    },
    Househelpkin(state){
      return state.househelpkin;
    }
  };
const actions = {
    househelpkins(context){//permission.index route laravel
      axios.get('/api/househelpkin/get')
      .then((response)=>{
        console.log(response.data)
        context.commit('househelpkins', response.data.househelpkins);
      });
    },
    HousehelpkinById(context, payload){
        axios.get('/api/househelpkin/show/'+payload)
              .then((response)=>{
                  console.log(response.data);
                  context.commit('househelpkin', response.data.househelpkin);
              });
    }
  }
const mutations = {
    househelpkins(state, data){
      return state.househelpkins = data;
    },
    househelpkin(state, data){
      return state.househelpkin = data;
    }
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};






