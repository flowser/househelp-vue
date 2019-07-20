
//affiliate module

const state = {
    affiliates:[],
    affiliate:[],
    affiliatespagination:[],
  };
const getters = {
    Affiliates(state){
      return state.affiliates;
    },
    Affiliate(state){
      return state.affiliate;
    },
    AffiliatePagination(state){
      return state.affiliatespagination;
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
                commit('affiliates', response.data.users.data)
                commit('affiliatespagination', response.data.users)
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
                  context.commit('affiliate', response.data.user);
              });
    }

  }
const mutations = {
    affiliates(state, data){
      return state.affiliates = data;
    },
    affiliate(state, data){
      return state.affiliate = data;
    },
    affiliatespagination(state, data){
        var pagination = {
            current_page: data.current_page,
            last_page: data.last_page,
            from: data.from,
            to: data.to,
            total: data.total,
            next_page_url: data.next_page_url,
            prev_page_url: data.prev_page_url,
        }
        return state.affiliatespagination = pagination;
    },
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};





