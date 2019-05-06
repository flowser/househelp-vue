<template>
  <div id="Career">
      Career
  </div>
</template>


<script>
// import LeftSideBar from "../includes/frontend/LeftSidebar.vue";
    export default {
        name:"Career",
        components:{
            // LeftSideBar,
        },
        data(){
            return{

           }
        },
       mounted(){
            // this.loadClient();
            // this.singleCareer()
            // this.loadCartItems();
            // this.imageUrl = "/assets/organisation/img/background/background-1.jpg"
        },
        computed:{

        },
        methods:{
            // singleCareer(){
            //     this.$store.dispatch('CareerById', this.$route.params.id);
            // },
            // CareerLoadImage(Career_image){
            //     if(Career_image){
            //         return "/assets/organisation/img/Careers/"+Career_image;
            //     }else{
            //         return "/assets/organisation/img/website/empty.png";
            //     }
            // },
            // CareerCodeImage(codepen_ic_png){
            //     if(codepen_ic_png){
            //         return "/main_theme/images/"+codepen_ic_png;
            //     }else{
            //         return "/assets/organisation/img/website/empty.png";
            //     }
            // },
            // CareerPriceImage(dolar_ic_png){
            //      if(dolar_ic_png){
            //         return "/main_theme/images/"+dolar_ic_png;
            //     }else{
            //         return "/assets/organisation/img/website/empty.png";
            //     }
            // },
            // CareerLessonsImage(cup_ic_png){
            //    if(cup_ic_png){
            //         return "/main_theme/images/"+cup_ic_png;
            //     }else{
            //         return "/assets/organisation/img/website/empty.png";
            //     }
            // },
            // CareerDurationImage(clock_ic_png){
            //     if(clock_ic_png){
            //         return "/main_theme/images/"+clock_ic_png;
            //     }else{
            //         return "/assets/organisation/img/website/empty.png";
            //     }
            // },
            // CareerCertImage(cap_ic_png){
            //     if(cap_ic_png){
            //         return "/main_theme/images/"+cap_ic_png;
            //     }else{
            //         return "/assets/organisation/img/website/empty.png";
            //     }
            // },
            // CareerCareerStudentsImage(user_ic_png){
            //     if(user_ic_png){
            //         return "/main_theme/images/"+user_ic_png;
            //     }else{
            //         return "/assets/organisation/img/website/empty.png";
            //     }
            // },
            // RegularEnroll(Career){
            //      this.enrollform.fill(Career);
            //      this.enrollform.CareerType = "Regular";
            //      if(this.enrollform.CareerType == "Regular"){
            //         this.enrollform.parttime_fee = null;
            //     }
            //     this.enrollform.patch('/cart/')
            //     .then((response)=>{
            //          toast({
            //             type: 'success',
            //             title: response.data.code,
            //             title: response.data.message,
            //             })

            //             this.loadCareers()
            //             this.loadCartItems()
            //               this.$Progress.finish()
            //     })
            //     .catch((response)=>{

            //         this.$Progress.fail()
            //         toast({
            //             type: 'error',
            //             type: 'error',
            //             title: 'Career Alreaday exist in your cart'
            //         })
            //     })
            // },
            // ParttimeEnroll(Career){
            //     this.enrollform.fill(Career);
            //     this.enrollform.CareerType = "Parttime";
            //     if(this.enrollform.CareerType == "Parttime"){
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

            //             this.loadCareers()
            //             this.loadCartItems()
            //               this.$Progress.finish()
            //     })
            //     .catch((response)=>{
            //         // console.log(response)
            //         this.$Progress.fail()
            //         toast({
            //             type: 'error',
            //             title: 'Career Alreday exist in your cart'
            //         })
            //     })
            // },
            // Remove(cartItem_id){
            //     // console.log(cartItem_id)
            //     axios.get('/cart/remove/'+cartItem_id)
            //     .then((response)=>{
            //          toast({
            //             type: 'success',
            //             title: 'Career Removed successful'
            //             })
            //             this.loadCareers()
            //             this.loadCartItems()
            //               this.$Progress.finish()
            //     })
            //     .catch((response)=>{
            //         this.$Progress.fail()
            //         toast({
            //             type: 'error',
            //             title: 'Career Removal not successful.'
            //         })
            //     })
            // },
            // Clear(CartItems){
            //     // console.log(CartItems)
            //     axios.get('/cart/clear/'+CartItems)
            //      .then((response)=>{
            //          toast({
            //             type: 'success',
            //             title: 'Career Cart was Cleared successful'
            //             })
            //             this.loadCareers()
            //             this.loadCartItems()
            //               this.$Progress.finish()
            //     })
            //     .catch((response)=>{
            //         this.$Progress.fail()
            //         toast({
            //             type: 'error',
            //             title: 'Career Cart was not Cleared successful.'
            //         })
            //     })
            // },
            // openCheckoutModal(CartItems){
            //     // console.log(CartItems)
            //     this.loadCareers()
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
            //             this.loadCareers()
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
                  this.singleCareer();//method
            }
        }
    }
</script>
