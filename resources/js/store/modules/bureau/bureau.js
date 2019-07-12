
//permission

const state = {
    bureaus:[],
    bureau:[],
    bureaupagination:[],
    
  },
  getters = {
    Bureaus(state){
      return state.bureaus;
    },

    Bureau(state){
      return state.bureau;
    },
    BureausPagination(){        
        return state.bureaupagination;
    }
  }
const actions = {
    bureaus({ dispatch, commit }, url){
        return new Promise((resolve, reject) =>{
            axios.get(url)
            .then((response)=>{
                commit('bureaus', response.data.bureaus.data);
                commit('bureaupagination', response.data.bureaus)
                resolve(response)
            })
            .catch(error => {
                console.log(error, 'error')
                reject(error);
            });
        });
    },


    BureauById(context, payload){
        axios.get('/api/bureau/show/'+payload)
              .then((response)=>{
                  context.commit('bureau', response.data.bureau);
              });
    },
    bureauByUserID(context){
        axios.get('/api/bureau/get')
              .then((response)=>{
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
    bureaupagination(state, data){
            var pagination = {
                current_page : data.current_page,
                last_page: data.last_page,
                from: data.from,
                to: data.to,
                total: data.total,
                next_page_url: data.next_page_url,
                prev_page_url: data.prev_page_url,
            }
        return state.bureaupagination = pagination;
    },
  }

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
}


