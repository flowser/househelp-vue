<template>
  <div id=menu-block>
      <!-- PageBanner -->
	<div class="container-fluid no-padding " :style="{ background: `url(${imageUrl}) no-repeat center` }" style="height: 220px" >
		<!-- background_image -->

        <div class="container">
			<div class="pagebanner-content" style="margin-top: 80px;">
                <div class="">
                    <div class="pull-left">
                        <h3 style="margin-top: 0px;margin-bottom: 0px;color: #ffff;">My Account</h3>
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
                            <h5 class="text-justify" v-if="Client.user">
                                Name: <span style="color:#2700ff;"></span>{{Client.user.full_name}}</span>
                            </h5>
                            <h5 class="text-justify" v-if="Client.user">
                                Email: <span style="color:#2700ff;">{{Client.user.email}}</span>
                            </h5>
                            <h5 class="text-justify">
                                Phone: <span style="color:#2700ff;">{{Client.phone}}</span>
                            </h5>
                            <h5 class="text-justify" v-if="Client.gender">
                                Gender: <span style="color:#2700ff;">{{Client.gender.name}}</span>
                            </h5>
                            <h5 class="text-justify" v-if="Client.education">
                                Education Level: <span style="color:#2700ff;">{{Client.education.name}}</span>
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <div class="image">
                                 <img :src="clientLoadImage(Client.photo)" alt="" class="img-circle">
                            </div>
                            <h5 class="text-justify" v-if="Client.user">
                                Name: <span style="color:#2700ff;">{{Client.user.full_name}}</span>
                            </h5>
                        </div>
                        <div class="col-md-4">
                             <h5 class="text-justify">
                                ID No.: <span style="color:#2700ff;">{{Client.id_no}}</span>
                            </h5>
                            <h5 class="text-justify">
                                About Me: <span style="color:#2700ff;">{{Client.about_me}}</span>
                            </h5>
                            <div class="text-justify">
                                Address:
                                <h5 class="widget-user-desc" style="margin-bottom:0">P.O. Box
                                    <span style="color:#2700ff;">{{Client.address}}</span>,</h5>
                                <h5 class="widget-user-desc" style="margin-bottom:0" v-if="Client.ward">
                                    <span style="color:#2700ff;">{{Client.ward.name}}</span> Ward,
                                    <span style="color:#2700ff;" v-if="Client.constituency">{{Client.constituency.name}}</span> Constituency,
                                </h5>
                                <h5 class="widget-user-desc" style="margin-bottom:0" v-if="Client.county">
                                    <span style="color:#2700ff;">{{Client.county.name}}</span> County,
                                    <span style="color:#2700ff;" v-if="Client.country"> {{Client.country.name}}</span>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top:22px" >
                    <div class="col-md-12 col-xs-12 col-sm-12" style="overflow-x:auto;">
                        <table id="example2" class="table table-bordered table-hover" style="margin-bottom: 0px;">
                            <thead>
                                <tr>
                                    <th>S1</th>
                                    <th>Method</th>
                                    <th>Amount</th>
                                    <th>Code</th>
                                    <th>Trans Image</th>
                                    <th>Courses</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(order, index) in Orders" :key="order.id">
                                    <td >{{index+1}}</td>
                                    <td style="width: 140px;">{{order.payment_method}} </td>
                                    <td style="width: 110px;"><span style="color: rgb(255, 199, 34);">Kshs.</span>
                                         <span style="color: rgb(255, 199, 34);">{{order.total}}</span></td>
                                    <td style="width: 140px;">{{order.transaction_code}}</td>
                                    <td style="width:150px;padding:1px;">
                                             <img :src="orderLoadImage(order.transaction_image)" style="width:100%; height:auto" alt="Card image cap">
                                             <br>Paid On <br>
                                             <span style="color: rgb(255, 199, 34);">{{order.created_at | dateformat}}</span>
                                    </td>
                                    <td>
                                      <table id="example2" class="table table-bordered table-hover" style="margin-bottom: 0px;">
                                        <thead>
                                            <tr>
                                                <th>S1</th>
                                                <th>Course Name</th>
                                                <th>Type</th>
                                                <th>Skill</th>
                                                <th>Fee</th>
                                                <th>Payment Confirmation</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(course, index) in order.courses" :key="course.id" >
                                                <td >{{index+1}}</td>
                                                <td >{{course.name}}</td>
                                                <td >{{course.pivot.courseType}}</td>
                                                <td >{{course.pivot.skill}}</td>
                                                <td >{{course.pivot.fee}}</td>
                                                <td >
                                                    <div class="clearfix" style="font-weight:bold;font-size:0.7em;">
                                                        <span style="color:#9a009a;">
                                                            <div v-if="course.pivot.payment_confirmation == true">
                                                                <a type="button" class="btn btn-success btn-sm"> Approved</a>
                                                            </div>
                                                            <div v-else-if="course.pivot.payment_confirmation == false">
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
                <div class="row" style="padding-top:22px" >
                    <div class="col-md-12 col-xs-12 col-sm-12" style="overflow-x:auto;">
                        <table id="example2" class="table table-bordered table-hover" style="margin-bottom: 0px;">
                            <thead>
                                <tr>
                                    <th>S1</th>
                                    <th>Course</th>
                                    <th>Status</th>
                                    <th>Certificate</th>
                                    <th>Collection Date</th>
                                    <th>Collection Method</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(result, index) in Results" :key="result.id">
                                    <td >{{index+1}}</td>
                                    <td style="width: 140px;" v-if="result.course">{{result.course.name}} </td>
                                    <td style="width: 110px;">
                                         <span style="color: rgb(255, 199, 34);">{{result.course_status}}</span></td>
                                    <td style="width: 140px;">
                                        <div v-if="result.certificate_status == null">
                                             <a type="button" class="btn btn-success btn-sm">Course in Progress</a>
                                         </div>
                                         <div v-else-if="result.certificate_status != null">
                                             {{result.certificate_status}}
                                         </div>
                                    </td>
                                    <td style="width:150px;">
                                        <div v-if="result.collection_date == null">
                                             <a type="button" class="btn btn-success btn-sm">Course in Progress</a>
                                         </div>
                                        <div v-else-if="result.collection_date != null">
                                             {{result.collection_date}}
                                         </div>
                                    </td>
                                    <td style="width:150px;">
                                        <div v-if="result.collection_method == null">
                                             <a type="button" class="btn btn-success btn-sm">Course in Progress</a>
                                         </div>
                                        <div v-else-if="result.collection_method == true">
                                             <a type="button" class="btn btn-success btn-sm">Manual</a>
                                         </div>
                                         <div v-else-if="result.collection_method == false">
                                             <a type="button" class="btn btn-danger btn-sm">Parcel</a>
                                         </div>
                                    </td>
                                    <td>
                                      <table id="example2" class="table table-bordered table-hover" style="margin-bottom: 0px;">
                                        <thead>
                                            <tr>
                                                <th>S1</th>
                                                <th>Collection Date</th>
                                                <th>Collector</th>
                                                <th>Details</th>
                                                <th>Cert Image</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(cert, index) in result.manualcollections" :key="cert.id" v-show="result.manualcollections">
                                                <td >{{index+1}}</td>
                                                <td >{{cert.collection_date}}</td>
                                                <td style="width: 110px;">
                                                     Name: <span style="color: rgb(255, 199, 34);">{{cert.collector_name}}</span><br>
                                                     ID No.:<span style="color: rgb(255, 199, 34);">{{cert.id_no}}</span><br>
                                                     Served By: <span style="color: rgb(255, 199, 34);" v-if="cert.user">{{cert.user}}</span><br>
                                                </td>
                                                <td style="width:150px;padding:1px;">
                                                    <img :src="collectorLoadImage(cert.id_photo_front)" style="width:100%; height:auto" alt="Card image cap">
                                                </td>
                                                <td style="width:150px;padding:1px;">
                                                    <img :src="certLoadImage(cert.certificate_image)" style="width:100%; height:auto" alt="Card image cap"><br>
                                                    Cert No.: <span style="color: rgb(255, 199, 34);">{{cert.certificate_number}}</span>
                                                </td>
                                            </tr>
                                            <tr v-for="(cert, index) in result.parcelcollections" :key="cert.id" v-show="result.parcelcollections">
                                                <td >{{index+1}}</td>
                                                <td >{{cert.collection_date}}</td>
                                                <td style="width: 110px;">
                                                     Name: <span style="color: rgb(255, 199, 34);">{{cert.collector_name}}</span><br>
                                                     ID No.:<span style="color: rgb(255, 199, 34);">{{cert.id_no}}</span><br>
                                                     Served By: <span style="color: rgb(255, 199, 34);" v-if="cert.user">{{cert.user}}</span><br>
                                                </td>
                                                <td style="width: 110px;">
                                                     Company: <span style="color: rgb(255, 199, 34);">{{cert.company_name}}</span><br>
                                                     Parcel No.:<span style="color: rgb(255, 199, 34);">{{cert.parcel_number}}</span><br>
                                                     Parcel Fees: <span style="color: rgb(255, 199, 34);">{{cert.parcel_fees}}</span><br>
                                                     Delivery Status:
                                                     <span style="color: rgb(255, 199, 34);">
                                                          <div class="clearfix" style="font-weight:bold;font-size:0.7em;">
                                                            <span style="color:#9a009a;">
                                                                <div v-if="cert.delivered == null">
                                                                    <a type="button" class="btn btn-success btn-sm">Course in Progress</a>
                                                                </div>
                                                                <div v-else-if="cert.delivered == true">
                                                                    <a type="button" class="btn btn-success btn-sm">Delivered</a>
                                                                </div>
                                                                <div v-else-if="cert.delivered == false">
                                                                    <a type="button" class="btn btn-danger btn-sm">OnTransit</a>
                                                                </div>
                                                            </span>
                                                          </div>
                                                     </span>
                                                </td>
                                                <td style="width:150px;padding:1px;">
                                                    <img :src="certLoadImage(cert.certificate_image)" style="width:100%; height:auto" alt="Card image cap"><br>
                                                    Cert No.: <span style="color: rgb(255, 199, 34);">{{cert.certificate_number}}</span>
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
            this.loadUser();
            this.loadClient();
            this.loadOrders();
            this.loadCourses();
            this.loadCartItems();
        },
        computed:{
            User(){
                return this.$store.getters.User
            },
            Client(){
                let Image = this.$store.getters.Client.background_image;
                 if(Image){
                        this.imageUrl = "/assets/organisation/img/clients/background/"+Image;
                    }else{
                        this.imageUrl = "/assets/organisation/img/background/background-1.jpg"
                 }
                return this.$store.getters.Client
            },
            Orders(){
                return this.$store.getters.Orders
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
            //logged in individuals
            loadUser(){
                return this.$store.commit('setAuthUser', window.logged_user);
            },
            loadClient(){
                return this.$store.dispatch("client")
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
            clientLoadImage(client_photo){
                if(client_photo){
                    return "/assets/organisation/img/clients/passports/"+client_photo;
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
                    return "/assets/organisation/img/clients/transactions/"+order_transaction_image;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            collectorLoadImage(cert_id_photo_front){
                if(cert_id_photo_front){
                    return "/assets/organisation/img/clients/collectors/IDs/front/"+cert_id_photo_front;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            certLoadImage(cert_certificate_image){
                if(cert_certificate_image){
                    return "/assets/organisation/img/clients/certs/"+cert_certificate_image;
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
                this.enrollform.patch('/cart/')
                .then((response)=>{
                     toast({
                        type: 'success',
                        title: response.data.code,
                        title: response.data.message,
                        })

                        this.loadOrders();
                        this.loadClient();
                        this.loadCourses();
                        this.loadCartItems();
                        this.loadCountries();
                        this.loadCounties();
                        this.loadConstituencies();
                        this.loadWards();
                        this.loadEducations();
                        this.loadGenders();
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
                    console.log(response)
                     toast({
                        type: 'success',
                        title: response.data.code,
                        title: response.data.message,
                        })

                        this.loadOrders();
                        this.loadClient();
                        this.loadCourses();
                        this.loadCartItems();
                        this.loadCountries();
                        this.loadCounties();
                        this.loadConstituencies();
                        this.loadWards();
                        this.loadEducations();
                        this.loadGenders();
                          this.$Progress.finish()
                })
                .catch((response)=>{
                    console.log(response)
                    this.$Progress.fail()
                    toast({
                        type: 'error',
                        title: 'Course Alreday exist in your cart'
                    })
                })
            },
            Remove(cartItem_id){
                console.log(cartItem_id)
                axios.get('/cart/remove/'+cartItem_id)
                .then((response)=>{
                     toast({
                        type: 'success',
                        title: 'Course Removed successful'
                        })
                        this.loadOrders();
                        this.loadClient();
                        this.loadCourses();
                        this.loadCartItems();
                        this.loadCountries();
                        this.loadCounties();
                        this.loadConstituencies();
                        this.loadWards();
                        this.loadEducations();
                        this.loadGenders();
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
                console.log(CartItems)
                axios.get('/cart/clear/'+CartItems)
                 .then((response)=>{
                     toast({
                        type: 'success',
                        title: 'Course Cart was Cleared successful'
                        })
                        this.loadOrders();
                        this.loadClient();
                        this.loadCourses();
                        this.loadCartItems();
                        this.loadCountries();
                        this.loadCounties();
                        this.loadConstituencies();
                        this.loadWards();
                        this.loadEducations();
                        this.loadGenders();
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
                console.log(CartItems)
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
                console.log(this.transactionform)
                this.transactionform.patch('/order/checkout/'+CartItems)
                .then((response)=>{
                     toast({
                        type: 'success',
                        title: 'Payment was successful, wait, for verification'
                        })
                        this.loadCartItems()
                        this.loadCourses();
                        this.loadCartItems();
                        this.loadCountries();
                        this.loadCounties();
                        this.loadConstituencies();
                        this.loadWards();
                        this.loadEducations();
                        this.loadGenders();
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
