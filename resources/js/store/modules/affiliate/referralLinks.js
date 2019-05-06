
//referralLink module

const state = {
    referralLinks:[],
    referralCourses:[],
    referralLink:[],
    basicURL:[],
  };
const getters = {
    ReferralLinks(state){
      return state.referralLinks;
    },
    ReferralCourses(state){
      return state.referralCourses;
    },
    ReferralLink(state){
      return state.referralLink;
    },
    BasicURL(state){
      return state.basicURL;
    }
  };
const actions = {
    referralLinks(context){//permission.index route laravel
      axios.get('/api/referralLink/get')
      .then((response)=>{
        console.log(response.data)
        context.commit('referralCourses', response.data.referralCourses);
        context.commit('referralLinks', response.data.referralLinks);
      });
    },
    ReferralLinkById(context, payload){
        axios.get('/api/referralLink/show/'+payload)
              .then((response)=>{
                //   console.log(response.data);
                  context.commit('referralLink', response.data.referralLink);
              });
    },

  }
const mutations = {
    referralLinks(state, data){
      return state.referralLinks = data;
    },
    referralCourses (state, data){
      return state.referralCourses = data;
    },
    referralLink(state, data){
      return state.referralLink = data;
    },
    setBasicURL(state, URL){ //URL as data passed from myaffiliate account
        console.log(URL, 'url')
        return state.basicURL = URL;
    }
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};






