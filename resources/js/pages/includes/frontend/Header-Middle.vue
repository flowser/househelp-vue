<template>
    <div id="middle-header">
        <div class="header-middle"><!--header-middle-->
			<div class="container" style="width: 100%;">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.html"><img src="themes/eshopper/images/home/logo.png" alt="" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
                                 <li class="dropdown">
                                        <a href="#" class="dropbtn">
                                            <i class="fa fa-shopping-cart"></i> Cart <span>(2)</span>
                                        </a>
                                        <div class="dropdown-content" style="width: 294px;left: -26px;">
                                            <div class="row" style="margin-right: 0px;margin-left: 0px;margin-top: 4px; padding-bottom: 0px; padding-top: 0px;">
                                                <div class="col-md-3 col-sm-3 col-xs-3" style="padding-left: 7px;padding-right: 0px;">
                                                    <img src="themes/eshopper/images/home/product1.jpg" alt="" style="width:100%" />
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-xs-3" style="padding-left: 20px;padding-right: 0px;">
                                                   <p>id</p>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left: 5px;padding-right: 0px;">
                                                    <div style="color: #fff; margin-top: 7px;">
                                                        search fee: Kshs.1234
                                                    </div>
                                                </div>
                                            </div>
                                         </a>
                                         <hr style="margin-top: 3px;margin-bottom: 3px;">
                                         <div class="row" style="margin-right: 0px;margin-left: 0px;margin-bottom:5px; padding-bottom: 0px;padding-top: 0px;">
                                                <div class="col-md-3 col-sm-3 col-xs-3" style="padding-left: 7px;padding-right: 0px;">
                                                    <el-button type="success" plain size="small"
                                                     class="col" title="Apply now" >Checkout</el-button>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-xs-3" style="padding-left: 20px;padding-right: 0px;">
                                                    <el-button type="danger" plain size="small"
                                                      title="Apply now" >Clear</el-button>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left: 5px;padding-right: 0px;">
                                                     <hr style="margin-top: 3px;margin-bottom: 3px;">
                                                    <div style="color: #fff; margin-top: 7px;">
                                                        Total: Kshs. 12345
                                                    </div>
                                                </div>
                                        </div>
                                        <hr style="margin-top: 3px;margin-bottom: 3px;">
                                        </div>
                                </li>
								<li v-if="loggedIn" ><router-link  :to="{name:'client.dashboard'}"><i class="fa fa-user"></i>Dashboard</router-link></li>
								<li v-if="!loggedIn"><a href="#" title="Login" @click.prevent="loginModal()"><i class="fa fa-lock"></i> Login</a></li>
								<li v-if="!loggedIn"><a href="#" title="Register" @click.prevent="registerClientModal()"><i class="fa fa-lock"></i> Register</a></li>
								<li v-if="loggedIn" ><a href="#" title="Logout" @click.prevent="logout"><i class="fa fa-unlock"></i> Logout</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
    </div>
</template>

<script>
export default {
    name:"Middle-Header",
    components:{
            // TopHeader,
            // SideBar,
            // Footer,
         },
         data(){
            return{

           };
        },
        mounted() {
            this.fetchAccessToken();
           console.log('top menu mounted.');
        },
        computed:{
            loggedIn(){
                return this.$store.getters.loggedIn
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
        },
        methods:{
            fetchAccessToken(){
                this.$store.dispatch('fetchAccessToken')
            },
            fetchUser(){
                this.$store.dispatch('getUserRoles')
                let k =  this.$store.getters.loggedIn
                console.log(k)
            },
            loadCartItems(){
                return this.$store.dispatch("cartItems")
            },
            househelpLoadImage(househelp_image){
                if(househelp_image){
                    return "/assets/organisation/img/househelps/"+househelp_image;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            registerClientModal(){
                 this.editmodeClient= false;
                //  this.clientform.reset()
                //  this.clientform.organisation_id;
                     $('#ClientModal').modal('show')
            },
            registerAffiliateModal(){
                 this.editmodeAffiliate= false;
                //  this.affiliateform.reset()
                     $('#AffiliateModal').modal('show')
            },
            loginModal(){
                //  this.loginform.reset()
                     $('#LoginModal').modal('show')
                     $('#ResetModal').modal('hide')
            },
            emailresetLinkModal(){
                //  this.loginform.reset()
                //  this.emaillinkform.reset()
                     $('#LoginModal').modal('hide')
                     $('#EmailResetLinkModal').modal('show')
            },
            resetPasswordModal(){
                //  this.loginform.reset()
                //  this.emaillinkform.reset()
                //  this.resetpasswordform.reset()

                var url = new URL(this.Url);
                console.log(url)
                var token = url.searchParams.get("token");
                if(token !=null){
                    axios.get('/password/reset/'+token)
                     .then((response)=>{
                       this.resetpasswordform.token = response.data.token
                       this.resetpasswordform.email = response.data.email
                        $('#LoginModal').modal('hide')
                        $('#EmailResetLinkModal').modal('hide')
                        $('#ResetPasswordModal').modal('show')
                        toast({
                            type: 'success',
                            title: 'You have successfully fetched your email to windup your passwod reset'
                        })
                        this.$Progress.finish()
                    })
                    .catch((response)=>{
                        this.$Progress.fail()
                        toast({
                            type: 'error',
                            title: 'Sorry there seems to be an issue check it your Email and try again.'
                        })
                    })
                }
            },
            Remove(cartItem_id){
                console.log(cartItem_id)
                axios.get('/cart/remove/'+cartItem_id)
                .then((response)=>{
                     toast({
                        type: 'success',
                        title: 'househelp Removed successful'
                        })
                        this.loadOrders();
                        this.loadCartItems();
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
                console.log(CartItems)
                axios.get('/cart/clear/'+CartItems)
                 .then((response)=>{
                     toast({
                        type: 'success',
                        title: 'househelp Cart was Cleared successful'
                        })
                        this.loadOrders();
                        this.loadCartItems();
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
                console.log(CartItems)
                this.loadCartItems()
                // this.transactionform.reset()
                 $('#CheckoutModal').modal('show')
            },
            Checkout(CartItems){
               this.transactionform.cartItems= CartItems
                console.log(this.transactionform)
                this.transactionform.patch('/order/checkout/'+CartItems)
                .then((response)=>{
                     toast({
                        type: 'success',
                        title: 'Payment was successful, wait, for verification'
                        })
                        this.loadCartItems();
                        $('#CheckoutModal').modal('hide')
                        // this.transactionform.reset()
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
            logout(){
                this.$store.dispatch("destroyToken")
                .then(({response}) => {
                        window.location.replace('/')
                        toast({
                                type: 'success',
                                title: 'You have been logged out successfully'
                        })
                        this.$Progress.finish();
                    })
                .catch(({response}) => {
                    this.$Progress.fail()
                    toast({
                        type: 'error',
                        title: "something is wrong"
                    })
                });
            },
        }

}
</script>

<style>
    .dropbtn {
    background-color: #4CAF50;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    }

    .dropdown {
    position: relative;
    display: inline-block;
    }

    .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    }

    .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    }

    /* .dropdown-content a:hover {background-color: #ddd;} */

    .dropdown:hover .dropdown-content {display: block;}

    .dropdown:hover .dropbtn {background-color: #3e8e4100}
</style>
