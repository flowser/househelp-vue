
//permission

const state = {
    servicemodels:[],
    servicemodelsbyservid:[],
    singleservicemodel:[],
    latestservicemodels:[],
  },
  getters = {
    ServiceModels(state){
      return state.servicemodels; //by loggedin or not all service models bydefault or by service id
    },
    SingleServiceModel(state){
        return state.singleservicemodel;
    },
    ServiceModelsbyServID(state){
        return state.servicemodelsbyservid;
    },
    LatestServiceModels(state){
        return state.latestservicemodels;
    },
  }
const actions = {
    servicemodels(context){
        axios.get('/api/servicemodel/get')//based on authethicated id
        .then((response)=>{
          console.log('chionsi',response.data);
          context.commit('servicemodels', response.data.servicemodels); //all service models logged in
        });
    },
    ServiceModelById(context, payload){
        axios.get('/api/servicemodel/show/'+payload)
              .then((response)=>{
                  context.commit('singleservicemodel', response.data.singleservicemodel);//view one
              });
    },
    ServiceModelsByServiceID(context, payload){
        console.log('thispayload',payload)
        axios.get('/api/servicemodel/fetch/'+payload)
        .then((response)=>{
            console.log('inche', response.data.servicemodels);
            context.commit('servicemodelsbyservid', response.data.servicemodels);//loged in gets all servicemodels based by service id
        });
    },
    SearchServiceModel(context, payload){
        axios.get('/api/servicemodel/search?s='+payload)
            .then((response)=>{
                console.log(response.data)
                context.commit('SearchServiceModels', response.data.servicemodels)
            })
    },
    LatestServiceModels(context){
        axios.get('/api/servicemodel/latest/')
        .then((response)=>{
            console.log( response.data);
            context.commit('LatestServiceModels', response.data.servicemodels);
        });
    },
    LatestServiceModelsByServiceID(context, payload){
        console.log('laid',payload)
        axios.get('/api/servicemodel/fetch/latest/'+payload)
        .then((response)=>{
            console.log('latest by service i', response.data);
            context.commit('LatestServiceModels', response.data.servicemodels);//loged in gets all servicemodels based by service id
        });
    },
  }

const mutations = {
    servicemodels(state, data){
      return state.servicemodels = data;
    },
    singleservicemodel(state, data){
      return state.singleservicemodel = data;
    },
    servicemodelsbyservid(state, data){
      return state.servicemodelsbyservid = data;
    },
    SearchServiceModels(state, data){
      return state.servicemodelsbyservid = data;
    },
    LatestServiceModels(state, data){
        return state.latestservicemodels = data;
      },
  }

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
}




