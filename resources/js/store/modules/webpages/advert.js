
//permission

const state = {
    adverts:[],
    singleadvert:[],
  },
  getters = {
    Adverts(state){
      return state.adverts;
    },
    SingleAdvert(state){
        return state.singleadvert;
    },
  }
const actions = {
    adverts(context){
        axios.get('/api/advert/get')
        .then((response)=>{
        //   console.log(response.data.adverts);
          context.commit('adverts', response.data.adverts);
        });
    },
    AdvertById(context, payload){
        axios.get('/api/advert/show/'+payload)
              .then((response)=>{
                  console.log('ffffffffffff');
                  context.commit('singleadvert', response.data.singleadvert);
              });
    },
  }

const mutations = {
    adverts(state, data){
      return state.adverts = data;
    },
    singleadvert(state, data){
      return state.singleadvert = data;
    }
  }

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
}


