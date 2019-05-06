
//kid module

const state = {
    kids:[],
  };
const getters = {
    Kids(state){
      return state.kids;
    },
  };
const actions = {
    kids(context){//permission.index route laravel
      axios.get('/api/kid/get')
      .then((response)=>{
        console.log(response.data)
        context.commit('kids', response.data.kids);
      });
    },
  };
const mutations = {
    kids(state, data){
      return state.kids = data;
    },
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};








