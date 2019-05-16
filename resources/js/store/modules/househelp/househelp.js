
//househelp module

const state = {
    househelps:{},
    househelpslist:[],
    househelp:[],
  };
const getters = {
    Househelps(state){
      return state.househelps;
    },
    HousehelpsList(state){
        return state.househelpslist;
    },
    Househelp(state){
      return state.househelp;
    }
  };
const actions = {
    househelps(context){//permission.index route laravel
      axios.get('/api/househelp/get')
      .then((response)=>{
        // console.log(response.data)
        context.commit('househelps', response.data.househelps);
      });
    },
    HousehelpsByPage(context, payload){//permission.index route laravel
      axios.get('/api/househelps/get/?page=' + payload)
      .then((response)=>{
        console.log(response.data, 'page')
        context.commit('househelps', response.data.househelps);
      });
    },

    HousehelpsByFilter(context, payload){//permission.index route laravel
        console.log(payload)
      axios.post('/api/househelpfilter/get', payload)
      .then((response)=>{
        // console.log(response.data)
        context.commit('househelps', response.data.househelps);
      });
    },
    househelpslist(context){//permission.index route laravel
        axios.get('/api/househelp/get/list')
        .then((response)=>{
          console.log(response.data)
          context.commit('househelpslist', response.data.househelps);
        });
      },
    HousehelpById(context, payload){
        // console.log(payload)
        axios.get('/api/househelp/show/'+payload)
              .then((response)=>{
                //   console.log(response.data, 'teiyo');
                  context.commit('househelp', response.data.househelp);
              });
    }
  };
const mutations = {
    househelps(state, data){
      return state.househelps = data;
    },
    househelpslist(state, data){
        return state.househelpslist = data;
    },
    househelp(state, data){
      return state.househelp = data;
    }
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};








