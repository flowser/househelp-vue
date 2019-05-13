
//permission

const state = {
    bureaus:[],
    bureau:[],
  },
  getters = {
    Bureaus(state){
      return state.bureaus;
    },

    Bureau(state){
      return state.bureau;
    }
  }
const actions = {
    bureaus(context){
        axios.get('/api/bureaus/get')
        .then((response)=>{
        //   console.log(response.data.bureau);
          context.commit('bureaus', response.data.bureaus);
        })
    },

    BureauById(context, payload){
        axios.get('/api/bureau/show/'+payload)
              .then((response)=>{
                  console.log(response.data);
                  context.commit('bureau', response.data.bureau);
              });
    },
    bureauByUserID(context){
        axios.get('/api/bureau/get')
              .then((response)=>{
                  console.log(response.data, 'bueauby userid');
                  context.commit('bureau', response.data.bureau);
              });
    },
  }
const mutations = {
    bureaus(state, data){
      return state.bureaus = data;
    },
    bureau(state, data){
      return state.bureau = data;
    },
  }

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
}


