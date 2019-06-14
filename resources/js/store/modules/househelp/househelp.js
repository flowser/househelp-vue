
//househelp module

const state = {
    househelps:{},
    househelpslist:[],
    unemployedhousehelps:[],
    employedhousehelps:[],
    pendinghousehelps:[],
    househelp:[],
    filter:[],
    filterform:[],
    pagination:[],
  };
const getters = {
        Househelps(state){
        return state.househelps;
        },
        HousehelpsList(state){
            return state.househelpslist;
        },
        unemployedhousehelps(){
            return state.unemployedhousehelps;
        },
        employedhousehelps(){
            return state.employedhousehelps;
        },
        pendinghousehelps(){
            return state.pendinghousehelps;
        },
        Househelp(state){
        return state.househelp;
        },
        Filter(){
            return state.filter;
        },
        FilterForm(){
            return state.filterform;
        },
        Pagination(){
            return state.pagination;
        }
  };
const actions = {
    househelps({ dispatch, commit, getters }, payload){
        if(getters.Filter === false){
            return new Promise((resolve, reject) =>{
                axios.get(payload.url)
                .then((response)=>{
                    commit('househelps', response.data.househelps.data);
                    commit('pagination', response.data.househelps)
                    commit('filter', false)
                    resolve(response)
                })
                .catch(error => {
                    console.log(error, 'error')
                    commit('filter', false)
                    reject(error);
                });
            });
        }else if(getters.Filter === true){
            return new Promise((resolve, reject) =>{
                if(getters.FilterForm){
                    axios.post(getters.FilterForm.url, getters.FilterForm)
                    .then((response)=>{
                        commit('househelps', response.data.househelps.data);
                        commit('pagination', response.data.househelps)
                        commit('filter', true)// maintains the status
                        resolve(response)
                    })
                    .catch(error => {
                        console.log(error, 'error')
                        commit('filter', false)
                        reject(error);
                    });
                }
            });
        }
    },
    filterform({ dispatch, commit }, payload){
        commit('filterform', payload)
    },
    househelpslist({ dispatch, commit }, url){
        return new Promise((resolve, reject) =>{
            axios.get(url)
            .then((response)=>{
                commit('househelpslist', response.data.users.data);
                commit('pagination', response.data.users)
                resolve(response)
            })
            .catch(error => {
                console.log(error, 'error')
                reject(error);
            });
        });
    },
    unemployedhousehelps({dispatch,commit}, url){
        axios.get('/api/househelp/get/unemployed')
              .then((response)=>{
                  commit('unemployedhousehelps', response.data.users.data);
              });
    },
    employedhousehelps({dispatch,commit}, url){
        axios.get('/api/househelp/get/employed')
              .then((response)=>{
                  commit('employedhousehelps', response.data.users.data);
              });
    },
    pendinghousehelps({dispatch,commit}, url){
        axios.get('/api/househelp/get/pending')
              .then((response)=>{
                  commit('pendinghousehelps', response.data.users.data);
              });
    },
    househelpsbureaulist({ dispatch, commit }, url){
        return new Promise((resolve, reject) =>{
            axios.get(url)
            .then((response)=>{
                commit('househelpslist', response.data.users.data);
                commit('pagination', response.data.users)

                resolve(response)
            })
            .catch(error => {
                console.log(error, 'error')
                reject(error);
            });
        });
    },
    filterstatus({ dispatch, commit }, payload){
        commit('filter', payload);
    },
    HousehelpById(context, payload){
        axios.get('/api/househelp/show/'+payload)
              .then((response)=>{
                  console.log(response.data)
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
    unemployedhousehelps(state, data){
        return state.unemployedhousehelps = data;
    },
    employedhousehelps(state, data){
        return state.employedhousehelps = data;
    },
    pendinghousehelps(state, data){
        return state.pendinghousehelps = data;
    },
    househelp(state, data){
      return state.househelp = data;
    },
    filter(state, data){
       return state.filter = data;
    },
    filterform(state, data){
        return state.filterform = data;
    },
    pagination(state, data){
            var pagination = {
                current_page : data.current_page,
                last_page: data.last_page,
                from: data.from,
                to: data.to,
                total: data.total,
                next_page_url: data.next_page_url,
                prev_page_url: data.prev_page_url,
            }
        return state.pagination = pagination;
    },
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};








