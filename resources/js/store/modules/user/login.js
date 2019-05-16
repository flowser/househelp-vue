
//login
const state = {
    accessToken: localStorage.getItem('accessToken') || null,
    user:'',
    roles:'',
    permissions:'',
},
  getters = {
    Token(state){
      return state.accessToken;
    },
    loggedIn(state){
        return state.accessToken !== null
    },
    LoggedUser(state){
        return state.user;
    },
    UserRoles(state){
        return state.roles;
    },
    UserPermissions(state){
        return state.permissions;
    }
  };
const actions = {
    retrieveToken({ commit }, credentials) {
        return new Promise((resolve, reject) =>{
            axios.post('/api/login', credentials)
                .then(response => {
                    console.log(credentials,)
                    localStorage.setItem('accessToken', response.data.access_token);
                    commit('updateAccessToken', response.data.access_token);
                    resolve(response)
                })
                .catch(error => {
                   commit('updateAccessToken', null);
                   reject(error);
                });
        })
      },
      fetchAccessToken({ commit }) {
        commit('updateAccessToken', localStorage.getItem('accessToken'));
      },
      destroyToken(context){//done only whne logged in
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.state.accessToken;
        if(context.getters.loggedIn){
            return new Promise((resolve, reject) =>{
                axios.post('/api/logout')
                    .then(response => {
                        localStorage.removeItem('accessToken');
                        context.commit('destroyToken');
                        resolve(response);
                    })
                    .catch(error => {
                        localStorage.removeItem('accessToken');
                        context.commit('destroyToken');
                        context.commit('destroyUser');
                        reject(error);
                    });
            });
        }
      },
      getUserRoles(context,dispatch){
        if(context.getters.loggedIn){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.state.accessToken;
            return new Promise((resolve, reject) =>{
                axios.get('/api/get/user')
                    .then((response)=>{
                        console.log(response.data, 'user')
                        context.commit('user', response.data.user);
                        context.commit('roles', response.data.roles);
                        context.commit('permissions', response.data.permissions);
                        resolve(response)
                    })
                    .catch(error => {
                        context.commit('user', null);
                        context.commit('roles', null);
                        context.commit('permissions', null);
                        dispatch('fetchAccessToken');
                        dispatch('getUserRoles');
                        reject(error);
                    });
            });
        }
      }
};
const mutations = {
    updateAccessToken: (state, accessToken) => {
      state.accessToken = accessToken;
    },
    destroyToken(state){
        state.accessToken = null;
    },
    user(state, data){
        state.user = data;
    },
    roles(state, data){
        state.roles = data;
    },
    permissions(state, data){
        state.permissions = data;
    },
    destroyUser(state){
        state.user = null;
        state.roles = null;
        state.permissions = null;
    },
  };
export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations,
};
