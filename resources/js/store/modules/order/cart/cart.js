
//cartItem module

const state = {
    cartItems:[],
    cartItem:[],
    subTotal:[],
    Total:[],
    Count:[],
  };
const getters = {
    CartItems(state){
      return state.cartItems;
    },
    Cart(state){
      return state.cartItem;
    },
    subTotal(state){
      return state.subTotal;
    },
    Total(state){
      return state.Total;
    },
    Count(state){
      return state.Count;
    }
  };
const actions = {
    cartItems(context){//permission.index route laravel
      axios.get('/api/cart/get')
      .then((response)=>{
        // console.log(response.data, 'jj')
        context.commit('cartItems', response.data.cartItems);
        context.commit('subTotal', response.data.subTotal);
        context.commit('Total', response.data.Total);
        context.commit('Count', response.data.Count);
      });
    },
    CartItemById(context, payload){
        axios.get('/api/cart/show/'+payload)
              .then((response)=>{
                //   console.log(response.data);
                  context.commit('cartItem', response.data.cartItem);
              });
    }

  }
const mutations = {
    cartItems(state, data){
      return state.cartItems = data;
    },
    cartItem(state, data){
      return state.cartItem = data;
    },
    subTotal(state, data){
      return state.subTotal = data;
    },
    Total(state, data){
      return state.Total = data;
    },
    Count(state, data){
      return state.Count = data;
    }
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};





