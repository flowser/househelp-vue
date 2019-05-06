<template>
  <div id=menu-block>
      <!-- PageBanner -->
    <div class="container-fluid no-padding " :style="{ background: `url(${imageUrl}) no-repeat center` }" style="height: 220px" >
        <!-- background_image -->

        <div class="container">
            <div class="pagebanner-content" style="margin-top: 80px;">
                <div class="">
                    <div class="pull-left">
                        <h3 style="margin-top: 0px;margin-bottom: 0px;color: #ffff;">My Affiliate Account</h3>
                    </div>
                    <div class="pull-right">
                        <ol class="breadcrumb" start="background-color: transparent;">
                            <li><router-link title="Home" :to="`/`" style="color: #ffc722;">Home</router-link></li>
                            <li style="color: #ffff;">My Account</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- PageBanner /- -->
        <!-- <img src="..." alt="..." class="img-circle"> -->
                <!-- border-bottom: 1px solid rgba(0, 0, 0, 13.125);
    border-left: 1px solid rgba(0, 0, 0, 13.125); -->
    <div class="container-fluid event-section">
        <div class="section-padding"></div>
        <div class="event-block">
            <div class="event-box">
                <div class="row">
                    <div class="profile">
                        <div class="col-md-4 col-xs-12 col-sm-12">
                            <h5 class="text-justify" v-if="Affiliate.user">
                                Name: <span style="color:#2700ff;">{{Affiliate.user.full_name}}</span>
                            </h5>
                            <h5 class="text-justify" v-if="Affiliate.user">
                                Email: <span style="color:#2700ff;">{{Affiliate.user.email}}</span>
                            </h5>
                            <h5 class="text-justify">
                                Phone: <span style="color:#2700ff;">{{Affiliate.phone}}</span>
                            </h5>
                            <h5 class="text-justify" v-if="Affiliate.gender">
                                Gender: <span style="color:#2700ff;">{{Affiliate.gender.name}}</span>
                            </h5>
                            <h5 class="text-justify" v-if="Affiliate.education">
                                Education Level: <span style="color:#2700ff;">{{Affiliate.education.name}}</span>
                            </h5>
                        </div>
                        <div class="col-md-4 col-xs-12 col-sm-12">
                            <div class="image">
                                 <img :src="affiliateLoadImage(Affiliate.photo)" alt="" class="img-circle">
                            </div>
                            <h5 class="text-justify" v-if="Affiliate.user">
                                Name: <span style="color:#2700ff;">{{Affiliate.user.full_name}}</span>
                            </h5>
                        </div>
                        <div class="col-md-4 col-xs-12 col-sm-12">
                             <h5 class="text-justify">
                                ID No.: <span style="color:#2700ff;">{{Affiliate.id_no}}</span>
                            </h5>
                            <h5 class="text-justify">
                                About Me: <span style="color:#2700ff;">{{Affiliate.about_me}}</span>
                            </h5>
                            <div class="text-justify">
                                Address:
                                <h5 class="widget-user-desc" style="margin-bottom:0;">P.O. Box
                                     <span style="color:#2700ff;">{{Affiliate.address}}</span>,</h5>
                                <h5 class="widget-user-desc" style="margin-bottom:0;" v-if="Affiliate.ward">
                                    <span style="color:#2700ff;">{{Affiliate.ward.name}}</span> Ward,
                                    <span style="color:#2700ff" v-if="Affiliate.constituency">{{Affiliate.constituency.name}}</span> Constituency,
                                </h5>
                                <h5 class="widget-user-desc" style="margin-bottom:0;" v-if="Affiliate.county">
                                    <span style="color:#2700ff;">{{Affiliate.county.name}}</span> County,
                                    <span style="color:#2700ff" v-if="Affiliate.country"> {{Affiliate.country.name}}</span>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top:22px" >
                    <div class="col-md-12">
                        <h3>Courses Links </h3>
                        <table id="example2" class="table table-bordered table-hover" style="margin-bottom: 0px;">
                            <thead>
                                <tr>
                                    <!-- <th>S1</th> -->
                                    <th>Course</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(referralCourse, index) in ReferralCourses" :key="referralCourse.id">
                                    <!-- <td style="width:1px">{{index+1}}</td> -->
                                    <td style="width:175px;padding:2px;color: blue;font-size: smaller;" v-if="referralCourse.course">
                                        <div>{{referralCourse.course.name}}</div>
                                        <div> Regular fee: Kshs    <span style="color:#ff0000;">{{referralCourse.course.regular_fee}}</span></div>
                                        <div> part time fee: Kshs  <span style="color:#ff0000;">{{referralCourse.course.parttime_fee}}</span></div>
                                        <div> Start Data:          <span style="color:#ff0000;"> {{referralCourse.course.start_date | dateformat}} </span></div>
                                        <div>Created:       <span style="color:#ff0000;">{{referralCourse.created_at | createdAt}}</span></div>
                                        <div>Days to Expiry <span style="color:#ff0000;">{{referralCourse.lifetime_days | PassedDaystoExpiry(referralCourse.created_at) }}</span> days</div>
                                        <div>Course Marketing Expires on: <span style="color:#ff0000;">{{referralCourse.lifetime_days | ExpiryDate(referralCourse.created_at) }}</span></div>
                                    </td>
                                    <td>
                                      <table id="example2" class="table table-bordered table-hover" style="margin-bottom: 0px;">
                                        <thead>
                                            <tr>
                                                <!-- <th>S1</th> -->
                                                <th>Share Links</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(refferallink, index) in referralCourse.refferallinks" :key="refferallink.id" >
                                                <!-- <td style="width:1px">{{index+1}}</td> -->
                                                <td>
                                                   <social-sharing
                                                        @open="Link(refferallink.id)"
                                                         v-bind:url="URL+ referralCourse.uri +'?ref='+ refferallink.code"
                                                         v-bind:title="'Welcome to' + Organisation.name + ', learn and experience master our technical short courses. Like, follow, share our page'"
                                                         v-bind:description="'Welcome to' + Organisation.name + ', learn and experience master our technical short courses. Like, follow, share our page.'"
                                                         v-bind:quote="'Welcome to' + Organisation.name + ', learn and experience master our technical short courses. Like, follow, share our page.'"
                                                          hashtags="teiffoundation"
                                                          twitter-user="TeifFoundation"
                                                          inline-template>
                                                   <div >
                                                       <div class="col-md-6 col-xs-6 col-sm-6">
                                                           <div class="row" style="padding-top: 3px;padding-bottom: 2px;">
                                                               <div class="btn btn-md btn-primary" style="width:48%;">
                                                                   <network network="facebook">
                                                                       <i class="fa fa-facebook" ></i>
                                                                   </network>
                                                               </div>
                                                               <div class="btn btn-md btn-info" style="width:48%;">
                                                                   <network network="twitter">
                                                                       <i class="fa fa-twitter"></i>
                                                                   </network>
                                                               </div>
                                                           </div>
                                                           <div class="row" style="padding-top: 3px;padding-bottom: 2px;">
                                                               <div class="btn btn-md btn-primary" style="width:48%;">
                                                                   <network network="linkedin">
                                                                       <i class="fa fa-linkedin"></i>
                                                                   </network>
                                                               </div>
                                                               <div class="btn btn-md btn-primary" style="width:48%;">
                                                                   <network network="skype">
                                                                       <i class="fa fa-skype"></i>
                                                                   </network>
                                                               </div>
                                                           </div>
                                                       </div>
                                                       <div class="col-md-6 col-xs-6 col-sm-6">
                                                           <div class="row" style="padding-top: 3px;padding-bottom: 2px;">
                                                               <div class="btn btn-md btn-success" style="width:48%;">
                                                                   <network network="whatsapp">
                                                                       <i class="fa fa-whatsapp"></i>
                                                                   </network>
                                                               </div>
                                                               <div class="btn btn-md btn-warning" style="width:48%;">
                                                                   <network network="email">
                                                                       <i class="fa fa-envelope"></i>
                                                                   </network>
                                                               </div>
                                                           </div>
                                                           <div class="row" style="padding-top: 3px;padding-bottom: 2px;">
                                                                <div class="btn btn-md btn-info" style="width:48%;">
                                                                   <network network="telegram">
                                                                       <i class="fa fa-telegram">Teleg</i>
                                                                   </network>
                                                               </div>
                                                                <div class="btn btn-md btn-danger" style="width:48%;">
                                                                   <network network="sms">
                                                                       <i class="fa fa-commenting-o"></i>
                                                                   </network>
                                                               </div>
                                                           </div>
                                                       </div>
                                                   </div>
                                                   </social-sharing>
                                                </td>
                                            </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row" style="padding-top:22px" >
                    <div class="col-md-12" style="overflow-x:auto;">
                        <table id="example2" class="table table-bordered table-hover" style="margin-bottom: 0px;">
                            <thead>
                                <tr>
                                    <th>Course</th>
                                    <!-- <th>Link</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(referrallink, index) in ReferralLinks" :key="referrallink.id">
                                    <td style="width: 140px;" v-if="referrallink.referralcourse">{{referrallink.referralcourse.name}} </td>
                                    <!-- <td style="width: 250px;padding:2px;font-size: smaller;">
                                        <span style="color: rgb(255, 199, 34);">
                                            <span>{{URL}}</span><span>{{referrallink.referralcourse.uri}}</span>?ref=<span>{{referrallink.code}}</span>
                                        </span>
                                    </td> -->
                                    <td>
                                      <table id="example2" class="table table-bordered table-hover" style="margin-bottom: 0px;">
                                        <thead>
                                            <tr>
                                                <th>S1</th>
                                                <!-- <th>Course Type</th> -->
                                                <!-- <th>Skill</th> -->
                                                <!-- <th>Fee</th>
                                                <th>Payment Date</th> -->
                                                <th>Com</th>
                                                <th>confirm</th>
                                                <!-- <th>Payment Release</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(commission, index) in referrallink.commissions" :key="commission.id" >
                                                <td>{{index+1}}</td>
                                                <!-- <td>{{commission.courseType}}</td> -->
                                                <!-- <td>{{commission.skill}}</td> -->
                                                <!-- <td>{{commission.fee}}</td> -->
                                                <!-- <td>{{commission.paid_at}}</td> -->
                                                <td>{{commission.commission}}</td>
                                                <td>
                                                    <div class="clearfix" style="font-weight:bold;font-size:0.7em;">
                                                        <span style="color:#9a009a;">
                                                            <div v-if="commission.payment_confirmation == true">
                                                                <a type="button" class="btn btn-success btn-sm"> Confirmed</a>
                                                            </div>
                                                            <div v-else-if="commission.payment_confirmation == false">
                                                                <a type="button" class="btn btn-danger btn-sm"> Pending</a>
                                                            </div>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="clearfix" style="font-weight:bold;font-size:0.7em;">
                                                        <span style="color:#9a009a;">
                                                            <div v-if="commission.payment_status == true">
                                                                <a type="button" class="btn btn-success btn-sm"> Paid</a>
                                                            </div>
                                                            <div v-else-if="commission.payment_status == false">
                                                                <a type="button" class="btn btn-danger btn-sm"> Pending</a>
                                                            </div>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <div class="section-padding"></div>
    </div><!-- Event Section /- -->

    </div>

</template>


<script>
    export default {
        name:"Full-Event",
        data(){
            return{
                linkform:new Form({
                referralCourse_id:'',
                }),
                shareform:new Form({
                refferallink_id:'',
                url:'',
                network:'',
                }),
                imageUrl:'',
                enrollform: new Form({
                        id:'',
                        name:'',
                        regular_fee:'',
                        parttime_fee:'',
                        courseType:'',
                }),
                transactionform: new Form({
                        image:'',
                        transaction_code:'',
                         cartItems:'',
                }),
           }
        },
        mounted(){
            this.$root.$on('social_shares_open', (network, url) =>this.Share(network, url));
            this.loadOrganisation();
            this.loadUser();
            this.loadURL();
            this.loadAffiliate();
            this.loadReferralLinks();
            this.loadOrders();
            this.loadCourses();
            this.loadCartItems();
        },
        computed:{
            Organisation(){
                return this.$store.getters.Organisation
            },
            User(){
                return this.$store.getters.User
            },
            URL(){
                return this.$store.getters.BasicURL
            },
            Affiliate(){
                let Image = this.$store.getters.Affiliate.background_image;
                 if(Image){
                        this.imageUrl = "/assets/organisation/img/affiliates/background/"+Image;
                    }else{
                        this.imageUrl = "/assets/organisation/img/background/background-1.jpg"
                 }
                return this.$store.getters.Affiliate
            },
            ReferralLinks(){
                return this.$store.getters.ReferralLinks
            },
            ReferralCourses(){
                return this.$store.getters.ReferralCourses
            },
            Results(){
                return this.$store.getters.Results
            },
            Courses(){
                return this.$store.getters.Courses
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

            Link(refferallink_id){
                this.shareform.refferallink_id = refferallink_id;
            },
            Share(network, url){
                    this.shareform.url = url;
                    this.shareform.network = network;
                     this.$nextTick(function () {
                             this.$Progress.start()
                             this.shareform.patch('sharelink')
                              .then((response)=>{
                                    toast({
                                        type: 'success',
                                        title: 'You have successfully shared your link'
                                    })
                                    this.loadURL();
                                    this.loadAffiliate();
                                    this.loadReferralLinks();
                                    this.shareform.reset();
                                    this.$Progress.finish();
                            })
                            .catch((response)=>{
                                this.$Progress.fail()
                                toast({
                                    type: 'error',
                                    title: 'Sorry there seems to be an issue check it link first and try again.'
                                })
                            })

                     })
            },
            CreateLink(referralCourse_id){
                this.linkform.referralCourse_id = referralCourse_id;
                     this.$nextTick(function () {
                        this.$Progress.start()
                        this.linkform.patch('referralLink')
                              .then((response)=>{
                                    toast({
                                        type: 'success',
                                        title: 'You have successfully created your share link'
                                    })
                                    this.loadAffiliate();
                                    this.loadReferralLinks();
                                    this.linkform.reset();
                                    this.$Progress.finish();
                            })
                            .catch((response)=>{
                                this.$Progress.fail()
                                toast({
                                    type: 'error',
                                    title: 'Sorry there seems to be an issue check it link first and try again.'
                                })
                            })

                     })

            },
            //logged in individuals
            loadUser(){
                this.$store.commit('setAuthUser', window.logged_user);
            },
            loadOrganisation(){
                return this.$store.dispatch( "organisation")//get a
            },
            loadURL(){
                this.$store.commit('setBasicURL', APP_URL);
            },
            loadAffiliate(){
                return this.$store.dispatch("affiliate")
            },
            loadReferralLinks(){
                return this.$store.dispatch("referralLinks")
            },
            loadOrders(){
                return this.$store.dispatch("orders")
            },
            loadCourses(){
                return this.$store.dispatch("courses")
            },
             loadCartItems(){
                return this.$store.dispatch("cartItems")
            },
            affiliateLoadImage(affiliate_photo){
                if(affiliate_photo){
                    return "/assets/organisation/img/affiliates/passports/"+affiliate_photo;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            courseLoadImage(course_image){
                if(course_image){
                    return "/assets/organisation/img/courses/"+course_image;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            orderLoadImage(order_transaction_image){
                if(order_transaction_image){
                    return "/assets/organisation/img/affiliates/transactions/"+order_transaction_image;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            collectorLoadImage(cert_id_photo_front){
                if(cert_id_photo_front){
                    return "/assets/organisation/img/affiliates/collectors/IDs/front/"+cert_id_photo_front;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            certLoadImage(cert_certificate_image){
                if(cert_certificate_image){
                    return "/assets/organisation/img/affiliates/certs/"+cert_certificate_image;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            RegularEnroll(course){
                 this.enrollform.fill(course);
                 this.enrollform.courseType = "Regular";
                 if(this.enrollform.courseType == "Regular"){
                    this.enrollform.parttime_fee = null;
                }
                this.$Progress.start()
                this.enrollform.patch('/cart/')
                .then((response)=>{
                     toast({
                        type: 'success',
                        title: response.data.code,
                        title: response.data.message,
                        })

                        this.loadCourses()
                        this.loadCartItems()
                          this.$Progress.finish()
                })
                .catch((response)=>{
                    // console.log(response.data)
                    this.$Progress.fail()
                    toast({
                        type: 'error',
                        type: 'error',
                        title: 'Course Alreaday exist in your cart'
                    })
                })
            },
            ParttimeEnroll(course){
                this.enrollform.fill(course);
                this.enrollform.courseType = "Parttime";
                if(this.enrollform.courseType == "Parttime"){
                    this.enrollform.regular_fee = null;
                }
                this.enrollform.patch('/cart/')
                .then((response)=>{
                    // console.log(response)
                     toast({
                        type: 'success',
                        title: response.data.code,
                        title: response.data.message,
                        })

                        this.loadCourses()
                        this.loadCartItems()
                          this.$Progress.finish()
                })
                .catch((response)=>{
                    // console.log(response)
                    this.$Progress.fail()
                    toast({
                        type: 'error',
                        title: 'Course Alreday exist in your cart'
                    })
                })
            },
            Remove(cartItem_id){
                // console.log(cartItem_id)
                axios.get('/cart/remove/'+cartItem_id)
                .then((response)=>{
                     toast({
                        type: 'success',
                        title: 'Course Removed successful'
                        })
                        this.loadCourses()
                        this.loadCartItems()
                          this.$Progress.finish()
                })
                .catch((response)=>{
                    this.$Progress.fail()
                    toast({
                        type: 'error',
                        title: 'Course Removal not successful.'
                    })
                })
            },
            Clear(CartItems){
                // console.log(CartItems)
                axios.get('/cart/clear/'+CartItems)
                 .then((response)=>{
                     toast({
                        type: 'success',
                        title: 'Course Cart was Cleared successful'
                        })
                        this.loadCourses()
                        this.loadCartItems()
                          this.$Progress.finish()
                })
                .catch((response)=>{
                    this.$Progress.fail()
                    toast({
                        type: 'error',
                        title: 'Course Cart was not Cleared successful.'
                    })
                })
            },
            openCheckoutModal(CartItems){
                // console.log(CartItems)
                this.loadCourses()
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
                // console.log(this.transactionform)
                this.transactionform.patch('/order/checkout/'+CartItems)
                .then((response)=>{
                     toast({
                        type: 'success',
                        title: 'Payment was successful, wait, for verification'
                        })
                        this.loadCourses()
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


