
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
    affiliates({ dispatch, commit }, url){//permission.index route laravel
        return new Promise((resolve, reject) =>{
            axios.get(url)
            .then((response)=>{
                commit('affiliates', response.data.affiliates.data)
                resolve(response)
            })
            .catch(error => {
                console.log(error, 'error')
                reject(error);
            });
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





