
//review module

const state = {
    reviews:{},
    approvedreviews:[],
    pendingreviews:[],
    review:[],
    reviewpagination:[],
    approvedreviewpagination:[],
    pendingreviewpagination:[],
  };
const getters = {
        Reviews(state){
        return state.reviews;
        },
        Approvedreviews(){
            return state.approvedreviews;
        },
        Pendingreviews(){
            return state.pendingreviews;
        },
        Review(state){
        return state.review;
        },
        ReviewPagination(){
            return state.reviewpagination;
        },
        ApprovedReviewPagination(){
            return state.approvedreviewpagination;
        },
        PendingReviewPagination(){
            return state.pendingreviewpagination;
        },
  };
const actions = {
    reviews({ dispatch, commit }, payload){ //for dashboards
        return new Promise((resolve, reject) =>{
            console.log(payload.url +payload.bureau_id, 'nnnnn')
            axios.get(payload.url +payload.bureau_id)
            .then((response)=>{
                commit('reviews', response.data.reviews.data);
                console.log('reviews', response.data.reviews.data)
                commit('reviewpagination', response.data.reviews)
                resolve(response)
            })
            .catch(error => {
                console.log(error, 'error')
                reject(error);
            });
        });
    },
    approvedreviews({dispatch,commit}, payload){
        axios.get(payload.approvedurl +payload.bureau_id)
              .then((response)=>{
                //   commit('approvedreviews', response.data.reviews.data);
                console.log(response.data.reviews, 'lllllll')
                  commit('approvedreviewpagination', response.data.reviews);
              });
    },
    pendingreviews({dispatch,commit}, payload){
        axios.get(payload.pendingurl +payload.bureau_id)
              .then((response)=>{
                //   commit('pendingreviews', response.data.reviews.data);
                  commit('pendingreviewpagination', response.data.reviews);
              });
    },
    ReviewById(context, payload){
        axios.get('/api/review/show/'+payload)
              .then((response)=>{
                  console.log(response.data)
                  context.commit('review', response.data.review);
              });
    }
  };
const mutations = {
    reviews(state, data){
      return state.reviews = data;
    },
    approvedreviews(state, data){
        return state.approvedreviews = data;
    },
    pendingreviews(state, data){
        return state.pendingreviews = data;
    },
    review(state, data){
      return state.review = data;
    },
    reviewpagination(state, data){
            var pagination = {
                current_page : data.current_page,
                last_page: data.last_page,
                from: data.from,
                to: data.to,
                total: data.total,
                next_page_url: data.next_page_url,
                prev_page_url: data.prev_page_url,
            }
        return state.reviewpagination = pagination;
    },
    approvedreviewpagination(state, data){
            var pagination = {
                current_page : data.current_page,
                last_page: data.last_page,
                from: data.from,
                to: data.to,
                total: data.total,
                next_page_url: data.next_page_url,
                prev_page_url: data.prev_page_url,
            }
        return state.approvedreviewpagination = pagination;
    },
    pendingreviewpagination(state, data){
            var pagination = {
                current_page : data.current_page,
                last_page: data.last_page,
                from: data.from,
                to: data.to,
                total: data.total,
                next_page_url: data.next_page_url,
                prev_page_url: data.prev_page_url,
            }
        return state.pendingreviewpagination = pagination;
    },
  };

export default {
  // namespaced: true,
  state,
  getters,
  actions,
  mutations
};









