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
                <div v-if="Unemployed ==true && Employed ==false && Pending ==false">
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
                </div>
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
                    <th>Househelp Details</th>
                    <th>Househelp Attributes</th>
                    <th style="padding-left: 14px">Actions</th>
                  </tr>
                </thead>
                <tbody v-for="(user, index) in Users" :key="user.id">
                  <tr v-for="househelp in user.bureauhousehelps" :key="househelp.id">
                    <td >{{index+1}}</td>
                    <td style="width: 540px;">
                         <div class="row" style="width:100%" >
                                     <div class="col-sm-3" style="padding: 3px;">
                                        <img class="card-img-top" :src="househelpLoadPassPhoto(househelp.pivot.photo)" style="width:100%; height:130px" alt="Card image cap">
                                    </div>
                                    <div class="col-sm-3" style="padding: 3px;" v-if="househelp.idstatus_id_photo_front !=null">
                                        <img class="card-img-top" :src="househelpLoadIDFrontPhoto(househelp.idstatus_id_photo_front)" style="width:100%;height:65px" alt="Card image cap"><br>
                                        <img class="card-img-top" :src="househelpLoadIDBackPhoto(househelp.idstatus_id_photo_back)" style="width:100%;height:65px" alt="Card image cap">
                                    </div>
                                    <div class="col-sm-3" style="padding: 3px;" v-else>
                                        Waiting Card<br>
                                        <img class="card-img-top" :src="househelpLoadWaitingCard(househelp.idstatus_waiting_card_photo)" style="width:100%;height:82%" alt="Card image cap"><br>
                                    </div>
                                    <div class="col-sm-6" style="font-weight:bold;font-size:0.7em;min-width:210px;max-width:400px;margin-top:4px;padding-top:4px;font-style: italic ">
                                        <div> <span style="color:#9a009a;">{{user.full_name}}</span>,
                                               Bureau: <span style="color:#9a009a;">{{househelp.name}},</span>
                                       </div>
                                        <div>
                                             <span v-if="househelp.idstatus_id_photo_front !=null" >
                                                 ID: <span style="color:#9a009a;">{{househelp.idstatus_id_number}}</span>
                                             </span>
                                             <span v-else> Ref NO.: <span style="color:#9a009a;">{{househelp.idstatus_ref_number}}</span></span>,
                                            Phone: <span style="color:#9a009a;">{{househelp.pivot.phone}},</span>
                                        </div>
                                        <div>
                                            Mail: <span style="color:#9a009a;">{{user.email}},</span>
                                        </div>
                                            <div>P. O. Box , <span style="color:#9a009a;">{{househelp.pivot.address}}</span>,
                                            </div>
                                        <div>
                                            <span style="color:#9a009a;">{{househelp.ward_name}}</span> ward,
                                            <span style="color:#9a009a;">{{househelp.constituency_name}}</span> constituency,
                                        </div>
                                        <div >
                                            <span style="color:#9a009a;">{{househelp.county_name}}</span> county,
                                            <span style="color:#9a009a;">{{househelp.country_name}},</span>
                                        </div>
                                    </div>
                        </div>
                    </td>
                    <td>
                        <div class="row">
                           <div class="col" style="padding: 3px;">
                               <div style="font-weight:bold;font-size:0.7em;min-width:210px;max-width:400px;margin-top:4px;padding-top:4px;font-style: italic ">
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
                           </div>
                        </div>
                    </td>
                    <td style="padding: 3px; width:130px" >
                        <div class="clearfix" style="font-weight:bold;font-size:0.7em;">
                            <span class="float-left" style="margin-bottom:-0.5em" >
                                <div style="margin-bottom:0.25em"> Updated at:
                                    <span style="color:#9a009a;">{{user.created_at | dateformat}} </span>
                                </div>
                            </span>
                        </div>
                        <br>
                        <div class="clearfix" style="font-weight:bold;font-size:0.7em;">
                            <span class="float-left">
                                <router-link  :to="`/B/househelp/${user.id}`">
                                        <i class="fa fa-eye "> View Details</i>
                                </router-link>
                            </span>
                        </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div v-if="Users.length" >
                  <div class="clearfix" style="font-weight:bold;font-size:0.7em;">
                        <span class="float-left" style="margin-bottom:-0.5em" >
                            <div style="margin-bottom:0.25em">
                                 Between <span style="color:#9a009a;"> {{Pagination.from}} </span>
                                 & <span style="color:#9a009a;"> {{Pagination.to}} </span>
                                out of <span style="color:#9a009a;"> {{Pagination.total}} </span> Househelps
                            </div>
                            <button class="btn btn-info" v-on:click="fetchPaginatedHousehelps(Pagination.prev_page_url)" :disabled="!Pagination.prev_page_url">Prev</button>
                        </span>
                        <span class="float-right" style="margin-bottom:-0.5em" >
                            <div style="margin-bottom:0.25em">
                                 Page <span style="color:#9a009a;"> {{Pagination.current_page}} </span>
                                 of <span style="color:#9a009a;"> {{Pagination.last_page}} </span>
                            </div>
                             <button class="btn btn-info" v-on:click="fetchPaginatedHousehelps(Pagination.next_page_url)" :disabled="!Pagination.next_page_url">Next</button>
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
        name:"Househelps",
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
                unemployedurl: '/api/househelp/get/unemployed/',
                  employedurl: '/api/househelp/get/employed/',
                   pendingurl: '/api/househelp/get/pending/',
                }),
            }
        },
        mounted() {
            this.getUnemployedHousehelps(); //from methods
        },
        computed:{
            Users(){
               return this.$store.getters.HousehelpsList
            },
            // unemployed(){
            //    return this.$store.getters.unemployedhousehelps
            // },
            // employed(){
            //    return this.$store.getters.employedhousehelps
            // },
            // pending(){
            //    return this.$store.getters.pendinghousehelps
            // },
            Pagination(){
                return this.$store.getters.Pagination
            },
            UnemployedPagination(){
                return this.$store.getters.UnemployedPagination
            },
            EmployedPagination(){
                return this.$store.getters.EmployedPagination
            },
            PendingPagination(){
                return this.$store.getters.PendingPagination
            },
        },
        methods:{
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

               }else if(employmentstatus==false && hirestatus==true){
                //    console.log(employmentstatus,"false", hirestatus, "true geting pending employment")
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

