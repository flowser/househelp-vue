<template>
  <div id="home">

    <PhotoSlider/>

	<section>
		<div class="container" style="width: 100%;">
			<div class="row">
                <div class="col-md-2 col-sm-12 col-xs-12">
			        <LeftSideBar/>
                </div>

				<div class="col-sm-10 col-sm-12 col-xs-12 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center"><span>({{Househelps.length}})</span> Featured Househelps </h2>
						<div class="col-md-2 col-sm-6 col-xs-6" v-for="househelp in Househelps" :key="househelp.id">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-justified">
										<img class="card-img-top" :src="househelpLoadPassPhoto(househelp.photo)"
                                               style="width:100%; height:130px" alt="Card image cap"/>
                                        <p>Work Experience: {{househelp.experience.name}}</p>
										<p>Gender:{{househelp.gender.name}}</p>
                                        <p>Religion:{{househelp.religion.name}}</p>
									</div>
									<div class="product-overlay">
										<div class="overlay-content text-justified">
											<p>Work Experience: {{househelp.experience.name}}</p>
											<p>Gender:{{househelp.gender.name}}</p>
                                            <p>Religion:{{househelp.religion.name}}</p>
											<a href="#" class="btn btn-default add-to-cart" style="color: #9a009a;"><i class="fa fa-shopping-cart"></i>Add to Your Search</a>
										</div>
									</div>
								</div>
                                <div class="choose">
                                    <router-link  :to="`/househelp/details/${househelp.id}`" style="color:#9a009a;"><i class="fa fa-info-circle"></i> Read More</router-link>
                                 </div>
							</div>
						</div>
					</div><!--features_items-->
                    <div v-if="Househelps.length" style="margin-left: 4px; margin-right: 4px;">
                        <div class="clearfix" style="font-weight:bold;font-size:0.7em;">
                                <span class="pull-left" style="margin-bottom:-0.5em" >
                                    <div style="margin-bottom:0.25em">
                                        Between <span style="color:#9a009a;"> {{Pagination.from}} </span>
                                        & <span style="color:#9a009a;"> {{Pagination.to}} </span>
                                        out of <span style="color:#9a009a;"> {{Pagination.total}} </span> Househelps
                                    </div>
                                    <button class="btn btn-info" v-on:click="fetchPaginatedHousehelps(Pagination.prev_page_url)" :disabled="!Pagination.prev_page_url">Prev</button>
                                </span>
                                <span class="pull-right" style="margin-bottom:-0.5em" >
                                    <div style="margin-bottom:0.25em">
                                        Page <span style="color:#9a009a;"> {{Pagination.current_page}} </span>
                                        of <span style="color:#9a009a;"> {{Pagination.last_page}} </span>
                                    </div>
                                    <button class="btn btn-info" v-on:click="fetchPaginatedHousehelps(Pagination.next_page_url)" :disabled="!Pagination.next_page_url">Next</button>
                                </span>
                        </div>
                    </div>
				</div>
			</div>
		</div>
    </section>

    <RecommendedHousehelps/>
  </div>
</template>

<script>
import PhotoSlider from "./includes/frontend/Slider";
import LeftSideBar from "./includes/frontend/Left-Sidebar";
import RecommendedHousehelps from "./includes/frontend/Recommended-Items";
    export default {
        name:"Home",
        components:{
            PhotoSlider,
            LeftSideBar,
            RecommendedHousehelps,
        },
        data(){
            return{
                filter:false,
                imageUrl:'',
                searchform: new Form({
                        id:'',
                }),
                 filterform:new Form({
                    filter:false,
                    url:'/api/househelp/get',
                }),
                pagination:[],
           }
        },
        mounted() {
            this.loadCartItems();
            this.loadHousehelps();
        },
        computed:{
            Househelps(){
                return this.$store.getters.Househelps
            },
            CartItems(){
                return this.$store.getters.CartItems
            },
            subTotal(){
                return this.$store.getters.subTotal
            },
            Total(){
                return this.$store.getters.Total
            },
            Count(){
                return this.$store.getters.Count
            },
            Pagination(){
                return this.$store.getters.Pagination
            }
        },
        methods:{
            loadCartItems(){
                return this.$store.dispatch("cartItems")
            },
            loadHousehelps(){
                let filter = this.$store.getters.Filter;
                if(filter == true){
                    this.filterform.filter = true;
                    this.$store.dispatch( "househelps", this.filterform,)
                    .then((response)=>{
                        this.filterform.reset();
                        toast({
                        type: 'success',
                        title: 'Fetched the Househelp data with filters successfully'
                        })
                    })
                    .catch(()=>{
                        this.$Progress.fail();
                        toast({
                        type: 'error',
                        title: 'There was something Wrong'
                        })
                    })
                }else if(filter == false){
                    this.filterform.filter = false;
                    this.$store.dispatch("filterstatus", this.filterform.filter)
                    this.$store.dispatch("househelps", this.filterform)
                    .then((response)=>{
                        this.filterform.reset();
                        toast({
                        type: 'success',
                        title: 'Fetched the Househelp data successfully'
                        })
                    })
                    .catch(()=>{
                        this.$Progress.fail();
                        toast({
                        type: 'error',
                        title: 'There was something Wrong'
                        })
                    })
                }
            },
            fetchPaginatedHousehelps(url){
                let filterform = this.$store.getters.FilterForm
                let filter = this.$store.getters.Filter;
                if(filter == true){
                    filterform.url = url;
                    this.loadHousehelps();
                }else if (filter == false){
                    this.filterform.url = url;
                    this.loadHousehelps();
                }
            },
            househelpLoadPassPhoto(househelp_photo){
                if(househelp_photo){
                    return "/assets/bureau/img/househelps/passports/"+househelp_photo;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            HousehelpSearch(househelp){
                this.searchform.fill(househelp);
                this.searchform.patch('/api/cart/')
                .then((response)=>{
                     toast({
                        type: 'success',
                        title: response.data.code,
                        title: response.data.message,
                        })

                        this.loadhousehelps()
                        this.loadCartItems()
                          this.$Progress.finish()
                })
                .catch((response)=>{

                    this.$Progress.fail()
                    toast({
                        type: 'error',
                        type: 'error',
                        title: 'househelp Alreaday exist in your cart'
                    })
                })
            },
            Remove(cartItem_id){
                axios.get('/api/cart/remove/'+cartItem_id)
                .then((response)=>{
                     toast({
                        type: 'success',
                        title: 'househelp Removed successful'
                        })
                        this.loadhousehelps()
                        this.loadCartItems()
                          this.$Progress.finish()
                })
                .catch((response)=>{
                    this.$Progress.fail()
                    toast({
                        type: 'error',
                        title: 'househelp Removal not successful.'
                    })
                })
            },
            Clear(CartItems){
                axios.get('/api/cart/clear/'+CartItems)
                 .then((response)=>{
                     toast({
                        type: 'success',
                        title: 'househelp Cart was Cleared successful'
                        })
                        this.loadhousehelps()
                        this.loadCartItems()
                          this.$Progress.finish()
                })
                .catch((response)=>{
                    this.$Progress.fail()
                    toast({
                        type: 'error',
                        title: 'househelp Cart was not Cleared successful.'
                    })
                })
            },
            openCheckoutModal(CartItems){
                this.loadhousehelps()
                this.loadCartItems()
                this.transactionform.reset()
                 $('#CheckoutModal').modal('show')
            },
            transactionChangeImage($event){
                 let file = event.target.files[0];
                if(file.size>1048576){
                    Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'The File you are uploading is larger than 2mbs!',
                            // footer: '<a href>Why do I have this issue? Reduce the Logo Size</a>'
                        })
                }else{
                    let reader = new FileReader();
                        reader.onload = event=> {
                            this.transactionform.image =event.target.result
                            };
                        reader.readAsDataURL(file);
                }
            },
            Checkout(CartItems){
               this.transactionform.cartItems= CartItems
                this.transactionform.patch('/api/order/checkout/'+CartItems)
                .then((response)=>{
                     toast({
                        type: 'success',
                        title: 'Payment was successful, wait, for verification'
                        })
                        this.loadhousehelps()
                        this.loadCartItems()
                        $('#CheckoutModal').modal('hide')
                        this.transactionform.reset()
                          this.$Progress.finish()
                })
                .catch((response)=>{
                     $('#CheckoutModal').modal('show')
                    this.$Progress.fail()
                    toast({
                        type: 'error',
                        title: 'Payment was not successful.'
                    })
                })

            },
        },
    }
</script>
