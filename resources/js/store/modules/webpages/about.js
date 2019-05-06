
//permission

const state = {
    about:[],
    abouts:[],
  },
  getters = {
    About(state){
      return state.about;
    },
    Abouts(state){
      return state.abouts;
    }
  }
const actions = {
    about(context){
        axios.get('/api/about/get')//based on authethicated id
        .then((response)=>{
        //   console.log(response.data.about);
          context.commit('about', response.data.about); //based on authethicated id
        })
    },
    abouts(context){
        axios.get('/api/abouts/get')
        .then((response)=>{
        //   console.log(response.data.abouts);
          context.commit('abouts', response.data.abouts);
        })
    }
  }
const mutations = {
    about(state, data){
      return state.about = data;
    },
    abouts(state, data){
      return state.abouts = data;
    }
  }

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
}
