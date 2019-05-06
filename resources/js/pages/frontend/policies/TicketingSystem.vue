<template>
  <div id="TicketingSystem">
      TicketingSystem
  </div>
</template>


<script>
// import LeftSideBar from "../includes/frontend/LeftSidebar.vue";
    export default {
        name:"TicketingSystem",
        components:{
            // LeftSideBar,
        },
        data(){
            return{

           }
        },
       mounted(){
            // this.loadClient();
            // this.singleTicketingSystem()
            // this.loadCartItems();
            // this.imageUrl = "/assets/organisation/img/background/background-1.jpg"
        },
        computed:{

        },
        methods:{
            // singleTicketingSystem(){
            //     this.$store.dispatch('TicketingSystemById', this.$route.params.id);
            // },
            // TicketingSystemLoadImage(TicketingSystem_image){
            //     if(TicketingSystem_image){
            //         return "/assets/organisation/img/TicketingSystems/"+TicketingSystem_image;
            //     }else{
            //         return "/assets/organisation/img/website/empty.png";
            //     }
            // },
            // TicketingSystemCodeImage(codepen_ic_png){
            //     if(codepen_ic_png){
            //         return "/main_theme/images/"+codepen_ic_png;
            //     }else{
            //         return "/assets/organisation/img/website/empty.png";
            //     }
            // },
            // TicketingSystemPriceImage(dolar_ic_png){
            //      if(dolar_ic_png){
            //         return "/main_theme/images/"+dolar_ic_png;
            //     }else{
            //         return "/assets/organisation/img/website/empty.png";
            //     }
            // },
            // TicketingSystemLessonsImage(cup_ic_png){
            //    if(cup_ic_png){
            //         return "/main_theme/images/"+cup_ic_png;
            //     }else{
            //         return "/assets/organisation/img/website/empty.png";
            //     }
            // },
            // TicketingSystemDurationImage(clock_ic_png){
            //     if(clock_ic_png){
            //         return "/main_theme/images/"+clock_ic_png;
            //     }else{
            //         return "/assets/organisation/img/website/empty.png";
            //     }
            // },
            // TicketingSystemCertImage(cap_ic_png){
            //     if(cap_ic_png){
            //         return "/main_theme/images/"+cap_ic_png;
            //     }else{
            //         return "/assets/organisation/img/website/empty.png";
            //     }
            // },
            // TicketingSystemTicketingSystemStudentsImage(user_ic_png){
            //     if(user_ic_png){
            //         return "/main_theme/images/"+user_ic_png;
            //     }else{
            //         return "/assets/organisation/img/website/empty.png";
            //     }
            // },
            // RegularEnroll(TicketingSystem){
            //      this.enrollform.fill(TicketingSystem);
            //      this.enrollform.TicketingSystemType = "Regular";
            //      if(this.enrollform.TicketingSystemType == "Regular"){
            //         this.enrollform.parttime_fee = null;
            //     }
            //     this.enrollform.patch('/cart/')
            //     .then((response)=>{
            //          toast({
            //             type: 'success',
            //             title: response.data.code,
            //             title: response.data.message,
            //             })

            //             this.loadTicketingSystems()
            //             this.loadCartItems()
            //               this.$Progress.finish()
            //     })
            //     .catch((response)=>{

            //         this.$Progress.fail()
            //         toast({
            //             type: 'error',
            //             type: 'error',
            //             title: 'TicketingSystem Alreaday exist in your cart'
            //         })
            //     })
            // },
            // ParttimeEnroll(TicketingSystem){
            //     this.enrollform.fill(TicketingSystem);
            //     this.enrollform.TicketingSystemType = "Parttime";
            //     if(this.enrollform.TicketingSystemType == "Parttime"){
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

            //             this.loadTicketingSystems()
            //             this.loadCartItems()
            //               this.$Progress.finish()
            //     })
            //     .catch((response)=>{
            //         // console.log(response)
            //         this.$Progress.fail()
            //         toast({
            //             type: 'error',
            //             title: 'TicketingSystem Alreday exist in your cart'
            //         })
            //     })
            // },
            // Remove(cartItem_id){
            //     // console.log(cartItem_id)
            //     axios.get('/cart/remove/'+cartItem_id)
            //     .then((response)=>{
            //          toast({
            //             type: 'success',
            //             title: 'TicketingSystem Removed successful'
            //             })
            //             this.loadTicketingSystems()
            //             this.loadCartItems()
            //               this.$Progress.finish()
            //     })
            //     .catch((response)=>{
            //         this.$Progress.fail()
            //         toast({
            //             type: 'error',
            //             title: 'TicketingSystem Removal not successful.'
            //         })
            //     })
            // },
            // Clear(CartItems){
            //     // console.log(CartItems)
            //     axios.get('/cart/clear/'+CartItems)
            //      .then((response)=>{
            //          toast({
            //             type: 'success',
            //             title: 'TicketingSystem Cart was Cleared successful'
            //             })
            //             this.loadTicketingSystems()
            //             this.loadCartItems()
            //               this.$Progress.finish()
            //     })
            //     .catch((response)=>{
            //         this.$Progress.fail()
            //         toast({
            //             type: 'error',
            //             title: 'TicketingSystem Cart was not Cleared successful.'
            //         })
            //     })
            // },
            // openCheckoutModal(CartItems){
            //     // console.log(CartItems)
            //     this.loadTicketingSystems()
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
            //             this.loadTicketingSystems()
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
                  this.singleTicketingSystem();//method
            }
        }
    }
</script>
