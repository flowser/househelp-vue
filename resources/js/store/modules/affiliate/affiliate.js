
//affiliate module

const state = {
    affiliates:[],
    affiliate:[],
  };
const getters = {
    Affiliates(state){
      return state.affiliates;
    },
    Affiliate(state){
      return state.affiliate;
    }
  };
const actions = {
    affiliate(context){//permission.index route laravel
      axios.get('/api/affiliate/get')
      .then((response)=>{
        // console.log(response.data)
        context.commit('affiliate', response.data.affiliate);
      });
    },
    affiliates(context){//permission.index route laravel
      axios.get('/api/affiliate/get/list')
      .then((response)=>{
        // console.log(response.data)
        context.commit('affiliates', response.data.affiliates);
      });
    },
    AffiliateById(context, payload){
        axios.get('/api/affiliate/show/'+payload)
              .then((response)=>{
                //   console.log(response.data);
                  context.commit('affiliate', response.data.affiliate);
              });
    }

  }
const mutations = {
    affiliates(state, data){
      return state.affiliates = data;
    },
    affiliate(state, data){
      return state.affiliate = data;
    }
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};





