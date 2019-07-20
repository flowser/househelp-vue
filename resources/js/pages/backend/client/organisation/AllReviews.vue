<template>
<div class="content-wrapper">
  <div class="container-fluid mt-5">
      <!-- Main content -->
    <div class="col-md-12">
     <section class="content">
      <div class="row justify-content-around">
        <div class="col-md">
          <div class="card">
            <div class="card-header">
                <div v-if="Approved ==true && Pending ==false">
                    <el-button type="success">{{Status}} ({{ApprovedPagination.total}}) </el-button>
                    <el-button type="danger" v-on:click="getPendingReviews()" plain>Pending Reviews ({{PendingPagination.total}})</el-button>
                </div>
                <div v-else-if="Approved ==false && Pending ==true">
                    <el-button type="danger" v-on:click="getApprovedReviews()" plain>Approved Reviews ({{ApprovedPagination.total}})</el-button>
                    <el-button type="success">{{Status}} ({{PendingPagination.total}})</el-button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>S1</th>
                    <th>Househelp Reviews</th>
                  </tr>
                </thead>
                <tbody v-for="(review, index) in Reviews" :key="review.id">
                    <tr>
                    <td style="width: 1px;">{{index+1}}</td>
                    <td>
                        <div class="row">
                            <div class="col-sm-2" v-if="review.bureauhousehelp">
                                <div style="padding: 3px;">
                                    <img class="card-img-top" :src="househelpLoadPassPhoto(review.bureauhousehelp.photo)" style="width:100%; height:130px" alt="Card image cap">
                                </div>
                                <div style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                    <div>Name: <span style="color:#9a009a;">{{review.bureauhousehelp.user_first_name}} {{review.bureauhousehelp.user_last_name}}</span></div>
                                    <div>Phone: <span style="color:#9a009a;">{{review.bureauhousehelp.phone}}</span></div>
                                </div>
                                <div class="clearfix" style="font-weight:bold;font-size:0.7em;" v-if="review.bureauhousehelp">
                                    <span class="float-left" style="margin-bottom:-0.5em" >
                                        <div style="margin-bottom:0.25em"> Updated at:
                                            <span style="color:#9a009a;">{{review.bureauhousehelp.created_at | dateformat}} </span>
                                        </div>
                                    </span>
                                    <span class="float-right">
                                        <a href=""  @click.prevent="viewHousehelpModal(review.bureauhousehelp.id)">
                                            <i class="fa fa-eye purple"></i>
                                        </a>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-8" style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                <div class="row" >
                                    <div class="col-sm-6">
                                        <div>Review: <span style="color:#9a009a;"> {{review.review | sortlength(300, "...")}}</span>,</div>
                                        <div>What To improve <span style="color:#9a009a;"> {{review.what_to_improve | sortlength(300, "...")}}</span>,</div>
                                    <br>
                                    <div class="row" >
                                        <td style="padding: 0px; padding-left: 16px;"> Overall Rating:</td>
                                        <!-- call for calculation fuctnion on avrage -->
                                            {{averageRating(review)}}
                                            <td style="padding: 0px; padding-left: 16px;">
                                                <star-rating :read-only="true" :show-rating="true"
                                                            :max-rating="10" :star-size="20"
                                                            :rating="Number(Average_rating)">
                                                </star-rating>
                                            </td>
                                    </div>
                                    <div class="clearfix" >
                                        <span class="float-left" style="margin-bottom:-0.5em" >
                                            <div style="margin-bottom:0.25em"> Updated at:
                                                <span style="color:#9a009a;">{{review.created_at | dateformat}} </span>
                                            </div>
                                        </span>
                                        <span class="float-right">
                                            <a href=""  @click.prevent="viewReviewModal(review.id)">
                                                <i class="fa fa-eye purple"></i>
                                            </a>
                                        </span>
                                    </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <tr>
                                            <td style="padding: 0px; padding-left: 16px;">Hygiene:</td>
                                                <td style="padding: 0px; padding-left: 16px;">
                                                    <star-rating :read-only="true" :show-rating="true"
                                                                :max-rating="10" :star-size="20"
                                                                :rating="Number(review.hygiene_rating)">
                                                    </star-rating>
                                                </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 0px; padding-left: 16px;">Children Rapport:</td>
                                               <td style="padding: 0px; padding-left: 16px;">
                                                   <star-rating :read-only="true" :show-rating="true"
                                                             :max-rating="10" :star-size="20"
                                                             :rating="Number(review.children_rapport_rating)">
                                                   </star-rating>
                                                </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 0px; padding-left: 16px;">Truthfullness:</td>
                                                <td style="padding: 0px; padding-left: 16px;">
                                                    <star-rating :read-only="true" :show-rating="true"
                                                                :max-rating="10" :star-size="20"
                                                                :rating="Number(review.truthfullness_rating)">
                                                    </star-rating>
                                                </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 0px; padding-left: 16px;">Morality:</td>
                                                <td style="padding: 0px; padding-left: 16px;">
                                                    <star-rating :read-only="true" :show-rating="true"
                                                                :max-rating="10" :star-size="20"
                                                                :rating="Number(review.morality_rating)">
                                                    </star-rating>
                                                </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 0px; padding-left: 16px;">Truthfullness:</td>
                                                <td style="padding: 0px; padding-left: 16px;">
                                                    <star-rating :read-only="true" :show-rating="true"
                                                                :max-rating="10" :star-size="20"
                                                                :rating="Number(review.truthfullness_rating)">
                                                    </star-rating>
                                                </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 0px; padding-left: 16px;">Obedience:</td>
                                                <td style="padding: 0px; padding-left: 16px;">
                                                    <star-rating :read-only="true" :show-rating="true"
                                                                :max-rating="10" :star-size="20"
                                                                :rating="Number(review.obedience_rating)">
                                                    </star-rating>
                                                </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 0px; padding-left: 16px;">Approval Status:</td>
                                                <td style="padding: 0px; padding-left: 16px;">
                                                    <div v-if="review.approval_status == true">
                                                        <button type="button" class="btn btn-warning btn-sm"> Approved</button>
                                                    </div>
                                                    <div v-else-if="review.approval_status == false">
                                                        <button type="button" class="btn btn-danger btn-sm"> Pending</button>
                                                    </div>
                                                </td>
                                        </tr>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2" v-if="review.organisationclient">
                                <div style="padding: 3px;">
                                    <img class="card-img-top" :src="househelpLoadPassPhoto(review.organisationclient.photo)" style="width:100%; height:130px" alt="Card image cap">
                                </div>
                                <div style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                    <div>Name: <span style="color:#9a009a;">{{review.organisationclient.user_first_name}} {{review.organisationclient.user_last_name}}</span></div>
                                    <div>Phone: <span style="color:#9a009a;">{{review.organisationclient.phone}}</span></div>
                                </div>
                                <div class="clearfix" style="font-weight:bold;font-size:0.7em;" v-if="review.organisationclient">
                                    <span class="float-left" style="margin-bottom:-0.5em" >
                                        <div style="margin-bottom:0.25em"> Updated at:
                                            <span style="color:#9a009a;">{{review.organisationclient.created_at | dateformat}} </span>
                                        </div>
                                    </span>
                                    <span class="float-right">
                                        <a href=""  @click.prevent="viewClientModal(review.organisationclient.id)">
                                            <i class="fa fa-eye purple"></i>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div v-if="Reviews.length">
                  <div class="clearfix" style="font-weight:bold;font-size:0.7em;">
                        <span class="float-left" style="margin-bottom:-0.5em" >
                            <div style="margin-bottom:0.25em">
                                 Between <span style="color:#9a009a;"> {{ReviewPagination.from}} </span>
                                 & <span style="color:#9a009a;"> {{ReviewPagination.to}} </span>
                                out of <span style="color:#9a009a;"> {{ReviewPagination.total}} </span> Reviews
                            </div>
                            <button class="btn btn-info" v-on:click="fetchPaginatedReviews(ReviewPagination.prev_page_url)" :disabled="!ReviewPagination.prev_page_url">Prev</button>
                        </span>
                        <span class="float-right" style="margin-bottom:-0.5em" >
                            <div style="margin-bottom:0.25em">
                                 Page <span style="color:#9a009a;"> {{ReviewPagination.current_page}} </span>
                                 of <span style="color:#9a009a;"> {{ReviewPagination.last_page}} </span>
                            </div>
                             <button class="btn btn-info" v-on:click="fetchPaginatedReviews(ReviewPagination.next_page_url)" :disabled="!ReviewPagination.next_page_url">Next</button>
                        </span>
                  </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
    </section>
    </div>
  </div>
</div>
</template>
<script>
    export default {
        name:"Reviews",
        data(){
            return{
                Average_rating:'',
                Approved:'',
                Pending:'',
                Status:'',
                approvedstatus:false,
                pendingstatus:false,
                urlform: new Form({
                    bureau_id:'',
                          url:'/api/review/get/approved/',
                  approvedurl:'/api/review/get/approved/',
                   pendingurl:'/api/review/get/pending/',
                    bureauurl:'/api/bureaus/get/',
                }),
            }
        },
        mounted() {
            this.getApprovedReviews(); //from methods
        },
        computed:{
            Reviews(){
               return this.$store.getters.Reviews
            },
            ReviewPagination(){
                return this.$store.getters.ReviewPagination
            },
            ApprovedPagination(){
                return this.$store.getters.ApprovedReviewPagination
            },
            PendingPagination(){
                return this.$store.getters.PendingReviewPagination
            },
        },
        methods:{
            averageRating(review){
                console.log(review, 'review')
                var hygiene          = Number(review.hygiene_rating)
                var children_rapport = Number(review.children_rapport_rating)
                var truthfullness    = Number(review.truthfullness_rating)
                var morality         = Number(review.morality_rating)
                var truthfullness    = Number(review.truthfullness_rating)
                var obedience        = Number(review.obedience_rating)
                this.Average_rating =  (hygiene + children_rapport + truthfullness + morality + truthfullness + obedience)/6;
            },
            getApprovedReviews(){
                this.Approved = true;
                this.Pending = false;
                this.Status = 'Approved Reviews';
                this.approvedstatus = true;
                this.pendingstatus = false;
                this.urlform.url = '/api/review/get/approved/';
                this.$store.dispatch("approvedreviews", this.urlform)
                this.$store.dispatch("pendingreviews", this.urlform)
                this.loadReviews();
            },
            getPendingReviews(){
                this.Approved = false;
                this.Pending = true;
                this.Status = 'Pending Reviews';
                this.approvedstatus = false;
                this.pendingstatus = true;// pending
                this.urlform.url = '/api/review/get/pending/';
                this.$store.dispatch("approvedreviews", this.urlform)
                this.$store.dispatch("pendingreviews", this.urlform)
                this.loadReviews();
            },
            loadReviews(){
               this.$Progress.start();
                let approved = this.approvedstatus;
                let pending = this.pendingstatus;
               if(approved ==true && pending ==false){
                   return this.$store.dispatch( "reviews", this.urlform)
                    .then((response)=>{
                        toast({
                        type: 'success',
                        title: 'Fetched the Reviews data successfully'
                        })
                    })
                    .catch(()=>{
                        this.$Progress.fail();
                        toast({
                        type: 'error',
                        title: 'There was something Wrong'
                        })
                    })

               }else if(approved ==false && pending ==true){
                   return this.$store.dispatch( "reviews", this.urlform)
                    .then((response)=>{
                        toast({
                        type: 'success',
                        title: 'Fetched the Reviews data successfully'
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
            fetchPaginatedReviews(url){
                this.urlform.url = url;
                this.loadReviews();
            },
            viewHousehelpModal(){

            },
            viewReviewModal(){

            },
            viewClientModal(){

            },
            househelpLoadPassPhoto(househelppivot_photo){
                if(househelppivot_photo){
                    return "/assets/bureau/img/househelps/passports/"+househelppivot_photo;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            househelpLoadIDFrontPhoto(househelp_idstatus_id_photo_front){
                if(househelp_idstatus_id_photo_front){
                    return "/assets/bureau/img/househelps/IDs/front/"+househelp_idstatus_id_photo_front;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            househelpLoadIDBackPhoto(househelp_idstatus_id_photo_back){
                if(househelp_idstatus_id_photo_back){
                    return "/assets/bureau/img/househelps/IDs/back/"+househelp_idstatus_id_photo_back;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            househelpLoadWaitingCard(househelp_idstatus_waiting_card_photo){
                if(househelp_idstatus_waiting_card_photo){
                    return "/assets/bureau/img/househelps/waitingcards/"+househelp_idstatus_waiting_card_photo;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
        },
    }
</script>

