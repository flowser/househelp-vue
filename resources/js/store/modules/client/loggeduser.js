
//user module

const state = {
    user:[],
  };
const getters = {
    User(state){
      return state.user;
    }
  };
const actions = {
    logoutUser( { commit } ){
        // commit( 'setUserLoadStatus', 0 );
        commit( 'setAuthUser', {} );
    },
}
const mutations = {
    setAuthUser(state, data){
        // console.log('user', data)
      return state.user = data;
    }
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};





