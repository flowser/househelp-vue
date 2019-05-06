
//order module

const state = {
    orders:[],
    results:[],
    order:[],
  };
const getters = {
    Orders(state){
      return state.orders;
    },
    Results(state){
      return state.results;
    },
    Order(state){
      return state.order;
    }
  };
const actions = {
    orders(context){//permission.index route laravel
      axios.get('/api/order/get')
      .then((response)=>{
        // console.log(response.data)
        context.commit('orders', response.data.orders);
        context.commit('results', response.data.results);
      });
    },
    OrderById(context, payload){
        axios.get('/api/order/show/'+payload)
              .then((response)=>{
                //   console.log(response.data);
                  context.commit('order', response.data.order);
              });
    }

  }
const mutations = {
    orders(state, data){
      return state.orders = data;
    },
    results(state, data){
      return state.results = data;
    },
    order(state, data){
      return state.order = data;
    }
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};





