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
                <!-- <div v-if="Unemployed ==true && Employed ==false && Pending ==false">
                    <el-button type="success">Unemployed ({{UnemployedPagination.total}}) </el-button>
                    <el-button type="danger" v-on:click="getEmployedHousehelps()" plain>Employed ({{EmployedPagination.total}})</el-button>
                    <el-button type="danger" v-on:click="getPendingEmployementHousehelps()" plain>Pending Employement ({{PendingPagination.total}})</el-button>
                </div>
                <div v-else-if="Unemployed ==false && Employed ==true && Pending ==false">
                    <el-button type="danger" v-on:click="getUnemployedHousehelps()" plain>Unemployed ({{UnemployedPagination.total}})</el-button>
                     <el-button type="success">Employed ({{EmployedPagination.total}}) </el-button>
                    <el-button type="danger" v-on:click="getPendingEmployementHousehelps()" plain>Pending Employement ({{PendingPagination.total}})</el-button>
                </div>
                <div v-else-if="Unemployed ==false && Employed ==false && Pending ==true">
                    <el-button type="danger" v-on:click="getUnemployedHousehelps()" plain>Unemployed ({{UnemployedPagination.total}})</el-button>
                    <el-button type="danger" v-on:click="getEmployedHousehelps()" plain>Employed ({{EmployedPagination.total}})</el-button>
                    <el-button type="success">Pending Employement ({{PendingPagination.total}})</el-button>
                </div> -->
              <!-- <div class="card-tools">
                    <button class="btn btn-success"  @click.prevent="newHousehelpKinModal()">Add New Househelp and Their Next of Kins                         <i class="fas fa-plus fw"></i>
                     </el-button>
              </div> -->
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
                                </div>
                                <br>
                                <div class="clearfix" style="font-weight:bold;font-size:0.7em;" v-if="review.bureauhousehelp">
                                    <span class="float-right">
                                        <a href=""  @click.prevent="ClientModal(review.bureauhousehelp.id)">
                                            <i class="fa fa-edit blue"></i>
                                        </a>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-8" style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                <div class="row" >
                                    <div class="col-sm-6">
                                        <div>Review: <span style="color:#9a009a;"> {{review.review | sortlength(300, "...")}}</span>,</div>
                                        <div>What To improve <span style="color:#9a009a;"> {{review.what_to_improve | sortlength(300, "...")}}</span>,</div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div> Hygiene: </div>
                                            <star-rating :read-only="true" :show-rating="false"
                                                         :max-rating="10" :star-size="20"
                                                         :rating="review.hygiene_rating">
                                            </star-rating>
                                        </div>
                                         <div class="row">
                                            <div>Children Rapport: </div>
                                                <star-rating :read-only="true" :show-rating="false"
                                                             :max-rating="10" :star-size="20"
                                                             :rating="review.children_rapport_rating">
                                                </star-rating>
                                        </div>
                                         <div class="row">
                                            <div>Truthfullness: </div>
                                                <star-rating :read-only="true" :show-rating="false"
                                                             :max-rating="10" :star-size="20"
                                                             :rating="review.truthfullness_rating">
                                                </star-rating>
                                        </div>
                                         <div class="row">
                                            <div>Morality: </div>
                                                <star-rating :read-only="true" :show-rating="false"
                                                             :max-rating="10" :star-size="20"
                                                             :rating="review.morality_rating">
                                                </star-rating>
                                        </div>
                                         <div class="row">
                                            <div>Obedience: </div>
                                                <star-rating :read-only="true" :show-rating="false"
                                                             :max-rating="10" :star-size="20"
                                                             :rating="review.obedience_rating">
                                                </star-rating>
                                        </div>
                                         <div class="row">
                                            <div>Approval Status: </div>
                                                <star-rating :read-only="true" :show-rating="false"
                                                             :max-rating="10" :star-size="20"
                                                             :rating="review.approval_status">
                                                </star-rating>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    Overall Rating
                                </div>
                            </div>
                            <div class="col-sm-2" v-if="review.bureauhousehelp">
                                <div style="padding: 3px;">
                                    <img class="card-img-top" :src="househelpLoadPassPhoto(review.bureauhousehelp.photo)" style="width:100%; height:130px" alt="Card image cap">
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
                                </div>
                                <br>
                                <div class="clearfix" style="font-weight:bold;font-size:0.7em;" v-if="review.organisationclient">
                                    <span class="float-right">
                                        <a href=""  @click.prevent="ClientModal(review.organisationclient.id)">
                                            <i class="fa fa-edit blue"></i>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                            <!-- <div class="row"> -->
                            <!-- <div class="col" style="padding: 3px;">
                                <div style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                        <div>Gender: <span style="color:#9a009a;">{{househelp.gender_name}}</span>,
                                            Age: <span style="color:#9a009a;">{{househelp.age}} Years</span>,
                                        </div>
                                        <div>
                                            Marital Status: <span style="color:#9a009a;">{{househelp.maritalstatus_name}}</span>,
                                        </div>
                                        <div>
                                            English Ability: <span style="color:#9a009a;">{{househelp.englishstatus_name}}</span>,
                                        </div>
                                        <div>
                                            Education Level: <span style="color:#9a009a;">{{househelp.education_name}}</span>,
                                        </div>
                                        <div>
                                            Experience Level: <span style="color:#9a009a;">{{househelp.experience_name}}</span>,
                                        </div>
                                        <div>
                                            Duration: <span style="color:#9a009a;">{{househelp.duration_name}}</span>,
                                        </div>
                                        <div>
                                            Status:
                                            <span style="color:#9a009a;">
                                                <span v-if="househelp.employmentstatus == true && househelp.hiredstatus == false">
                                                    <a type="button" class="btn btn-warning btn-sm"> Employed</a>
                                                </span>
                                                <span v-else-if="househelp.employmentstatus == false && househelp.hiredstatus == false">
                                                    <a type="button" class="btn btn-success btn-sm"> Unemployed</a>
                                                </span>
                                                <span v-else-if="househelp.employmentstatus == false && househelp.hiredstatus == true">
                                                    <a type="button" class="btn btn-success btn-sm"> pending</a>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                            </div> -->
                            <!-- </div>                     -->
                    </td>
                  </tr>
                </tbody>
              </table>
              <div v-if="Reviews.length" >
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
                Unemployed:'',
                Employed:'',
                Pending:'',
                Status:'',
                employmentstatus:false,
                hirestatus:false,
                urlform: new Form({
                    bureau_id:'',
                          url:'/api/househelp/get/unemployed/',
                       allurl:'/api/househelp/get/list/',//all houshelps without emploeyment or anything
                unemployedurl:'/api/househelp/get/unemployed/',
                  employedurl:'/api/househelp/get/employed/',
                   pendingurl:'/api/househelp/get/pending/',
                    bureauurl:'/api/bureaus/get/',
                    reviewurl:'/api/review/get/',
                }),
            }
        },
        mounted() {
            this.loadreviews(); //from methods
        },
        computed:{
            Reviews(){
               return this.$store.getters.Reviews
            },
            ReviewPagination(){
                return this.$store.getters.ReviewPagination
            },
            ApprovedReviewPagination(){
                return this.$store.getters.ApprovedReviewPagination
            },
            PendingReviewPagination(){
                return this.$store.getters.PendingReviewPagination
            },
        },
        methods:{
            loadreviews(){
                return this.$store.dispatch("reviews", this.urlform)
            },
            fetchPaginatedReviews(url){
                this.urlform.reviewurl = url;
                this.loadReviews();
            },
            loadHousehelps(){
               this.$Progress.start();
                let employmentstatus = this.employmentstatus;
                let hirestatus = this.hirestatus;
               if(employmentstatus==false && hirestatus==false){
                //    console.log(employmentstatus,"false", hirestatus, "false geting unemployed")
                   return this.$store.dispatch( "househelpslist", this.urlform)
                    .then((response)=>{
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

               }else if(employmentstatus==true && hirestatus==false){
                //    console.log(employmentstatus,"true", hirestatus, "false geting employed")
                   return this.$store.dispatch( "househelpslist", this.urlform)
                    .then((response)=>{
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
            getUnemployedHousehelps(){
                this.Unemployed = true;
                this.Employed = false;
                this.Pending = false;
                this.Status = 'Unemployed';
                this.employmentstatus = false;
                this.hirestatus = false;//not pending
                this.urlform.url = '/api/househelp/get/unemployed/';
                this.$store.dispatch("unemployedhousehelps", this.urlform)
                this.$store.dispatch("employedhousehelps", this.urlform)
                this.$store.dispatch("pendinghousehelps", this.urlform)
                this.loadHousehelps();
            },
            getEmployedHousehelps(){
                this.Unemployed = false;
                this.Employed = true;
                this.Pending = false;
                this.Status = 'Employed';
                this.employmentstatus = true;
                this.hirestatus = false;//not pending
                this.urlform.url = '/api/househelp/get/employed/';
                this.$store.dispatch("unemployedhousehelps", this.urlform)
                this.$store.dispatch("employedhousehelps", this.urlform)
                this.$store.dispatch("pendinghousehelps", this.urlform)
                this.loadHousehelps();
            },
            getPendingEmployementHousehelps(){
                this.Unemployed = false;
                this.Employed = false;
                this.Pending = true;
                this.Status = 'Pending Employement';
                this.employmentstatus = false;
                this.hirestatus = true;// pending
                this.urlform.url = '/api/househelp/get/pending/';
                this.$store.dispatch("unemployedhousehelps", this.urlform)//for counting
                this.$store.dispatch("employedhousehelps", this.urlform)//for counting
                this.$store.dispatch("pendinghousehelps", this.urlform)//for counting
                this.loadHousehelps();
            },
            fetchPaginatedHousehelps(url){
                this.urlform.url = url;
                this.loadHousehelps();
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

