<template>
  <div id="AffiliateProgram">
      AffiliateProgram
  </div>
</template>


<script>
// import LeftSideBar from "../includes/frontend/LeftSidebar.vue";
    export default {
        name:"AffiliateProgram",
        components:{
            // LeftSideBar,
        },
        data(){
            return{

           }
        },
       mounted(){
            // this.loadClient();
            // this.singleAffiliateProgram()
            // this.loadCartItems();
            // this.imageUrl = "/assets/organisation/img/background/background-1.jpg"
        },
        computed:{

        },
        methods:{
            // singleAffiliateProgram(){
            //     this.$store.dispatch('AffiliateProgramById', this.$route.params.id);
            // },
            // AffiliateProgramLoadImage(AffiliateProgram_image){
            //     if(AffiliateProgram_image){
            //         return "/assets/organisation/img/AffiliatePrograms/"+AffiliateProgram_image;
            //     }else{
            //         return "/assets/organisation/img/website/empty.png";
            //     }
            // },
            // AffiliateProgramCodeImage(codepen_ic_png){
            //     if(codepen_ic_png){
            //         return "/main_theme/images/"+codepen_ic_png;
            //     }else{
            //         return "/assets/organisation/img/website/empty.png";
            //     }
            // },
            // AffiliateProgramPriceImage(dolar_ic_png){
            //      if(dolar_ic_png){
            //         return "/main_theme/images/"+dolar_ic_png;
            //     }else{
            //         return "/assets/organisation/img/website/empty.png";
            //     }
            // },
            // AffiliateProgramLessonsImage(cup_ic_png){
            //    if(cup_ic_png){
            //         return "/main_theme/images/"+cup_ic_png;
            //     }else{
            //         return "/assets/organisation/img/website/empty.png";
            //     }
            // },
            // AffiliateProgramDurationImage(clock_ic_png){
            //     if(clock_ic_png){
            //         return "/main_theme/images/"+clock_ic_png;
            //     }else{
            //         return "/assets/organisation/img/website/empty.png";
            //     }
            // },
            // AffiliateProgramCertImage(cap_ic_png){
            //     if(cap_ic_png){
            //         return "/main_theme/images/"+cap_ic_png;
            //     }else{
            //         return "/assets/organisation/img/website/empty.png";
            //     }
            // },
            // AffiliateProgramAffiliateProgramStudentsImage(user_ic_png){
            //     if(user_ic_png){
            //         return "/main_theme/images/"+user_ic_png;
            //     }else{
            //         return "/assets/organisation/img/website/empty.png";
            //     }
            // },
            // RegularEnroll(AffiliateProgram){
            //      this.enrollform.fill(AffiliateProgram);
            //      this.enrollform.AffiliateProgramType = "Regular";
            //      if(this.enrollform.AffiliateProgramType == "Regular"){
            //         this.enrollform.parttime_fee = null;
            //     }
            //     this.enrollform.patch('/cart/')
            //     .then((response)=>{
            //          toast({
            //             type: 'success',
            //             title: response.data.code,
            //             title: response.data.message,
            //             })

            //             this.loadAffiliatePrograms()
            //             this.loadCartItems()
            //               this.$Progress.finish()
            //     })
            //     .catch((response)=>{

            //         this.$Progress.fail()
            //         toast({
            //             type: 'error',
            //             type: 'error',
            //             title: 'AffiliateProgram Alreaday exist in your cart'
            //         })
            //     })
            // },
            // ParttimeEnroll(AffiliateProgram){
            //     this.enrollform.fill(AffiliateProgram);
            //     this.enrollform.AffiliateProgramType = "Parttime";
            //     if(this.enrollform.AffiliateProgramType == "Parttime"){
            //         this.enrollform.regular_fee = null;
            //     }
            //     this.enrollform.patch('/cart/')
            //     .then((response)=>{
            //         // console.log(response)
            //          toast({
            //             type: 'success',
            //             title: response.data.code,
            //             title: response.data.message,
            //             })

            //             this.loadAffiliatePrograms()
            //             this.loadCartItems()
            //               this.$Progress.finish()
            //     })
            //     .catch((response)=>{
            //         // console.log(response)
            //         this.$Progress.fail()
            //         toast({
            //             type: 'error',
            //             title: 'AffiliateProgram Alreday exist in your cart'
            //         })
            //     })
            // },
            // Remove(cartItem_id){
            //     // console.log(cartItem_id)
            //     axios.get('/cart/remove/'+cartItem_id)
            //     .then((response)=>{
            //          toast({
            //             type: 'success',
            //             title: 'AffiliateProgram Removed successful'
            //             })
            //             this.loadAffiliatePrograms()
            //             this.loadCartItems()
            //               this.$Progress.finish()
            //     })
            //     .catch((response)=>{
            //         this.$Progress.fail()
            //         toast({
            //             type: 'error',
            //             title: 'AffiliateProgram Removal not successful.'
            //         })
            //     })
            // },
            // Clear(CartItems){
            //     // console.log(CartItems)
            //     axios.get('/cart/clear/'+CartItems)
            //      .then((response)=>{
            //          toast({
            //             type: 'success',
            //             title: 'AffiliateProgram Cart was Cleared successful'
            //             })
            //             this.loadAffiliatePrograms()
            //             this.loadCartItems()
            //               this.$Progress.finish()
            //     })
            //     .catch((response)=>{
            //         this.$Progress.fail()
            //         toast({
            //             type: 'error',
            //             title: 'AffiliateProgram Cart was not Cleared successful.'
            //         })
            //     })
            // },
            // openCheckoutModal(CartItems){
            //     // console.log(CartItems)
            //     this.loadAffiliatePrograms()
            //     this.loadCartItems()
            //     this.transactionform.reset()
            //      $('#CheckoutModal').modal('show')
            // },
            // transactionChangeImage($event){
            //      let file = event.target.files[0];
            //     if(file.size>1048576){
            //         Swal.fire({
            //                 type: 'error',
            //                 title: 'Oops...',
            //                 text: 'The File you are uploading is larger than 2mbs!',
            //                 // footer: '<a href>Why do I have this issue? Reduce the Logo Size</a>'
            //             })
            //     }else{
            //         let reader = new FileReader();
            //             reader.onload = event=> {
            //                 this.transactionform.image =event.target.result
            //                 };
            //             reader.readAsDataURL(file);
            //     }
            // },
            // Checkout(CartItems){
            //    this.transactionform.cartItems= CartItems
            //     this.transactionform.patch('/order/checkout/'+CartItems)
            //     .then((response)=>{
            //          toast({
            //             type: 'success',
            //             title: 'Payment was successful, wait, for verification'
            //             })
            //             this.loadAffiliatePrograms()
            //             this.loadCartItems()
            //             $('#CheckoutModal').modal('hide')
            //             this.transactionform.reset()
            //               this.$Progress.finish()
            //     })
            //     .catch((response)=>{
            //          $('#CheckoutModal').modal('show')
            //         this.$Progress.fail()
            //         toast({
            //             type: 'error',
            //             title: 'Payment was not successful.'
            //         })
            //     })

            // },
        },
        watch:{
            $route(to, from){
                  this.singleAffiliateProgram();//method
            }
        }
    }
</script>
