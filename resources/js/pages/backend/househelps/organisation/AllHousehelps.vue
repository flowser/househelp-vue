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
              <h3 class="card-title">Welcome to All Househelps</h3>
              <!-- <div class="card-tools">
                    <button class="btn btn-success"  @click.prevent="newHousehelpKinModal()">Add New Househelp and Their Next of Kins                         <i class="fas fa-plus fw"></i>
                     </button>
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
                <tbody>
                  <tr v-for="(househelp, index) in Househelps" :key="househelp.id">
                    <td >{{index+1}}</td>
                    <td >
                         <div class="row" style="width:100%" v-for="bureauhousehelp in househelp.bureauhousehelps" :key="bureauhousehelp.id">
                           <div class="col" style="padding: 3px;">
                                        <img class="card-img-top" :src="househelpLoadPassPhoto(bureauhousehelp.pivot.photo)" style="width:100%; height:130px" alt="Card image cap">
                                    </div>
                                    <div class="col" style="padding: 3px;" v-if="bureauhousehelp.idstatus_id_photo_front !=null">
                                        <img class="card-img-top" :src="househelpLoadIDFrontPhoto(bureauhousehelp.idstatus_id_photo_front)" style="width:100%;height:65px" alt="Card image cap"><br>
                                        <img class="card-img-top" :src="househelpLoadIDBackPhoto(bureauhousehelp.idstatus_id_photo_back)" style="width:100%;height:65px" alt="Card image cap">
                                    </div>
                                    <div class="col" style="padding: 3px;" v-else>
                                        Waiting Card<br>
                                        <img class="card-img-top" :src="househelpLoadWaitingCard(bureauhousehelp.idstatus_waiting_card_photo)" style="width:100%;height:65px" alt="Card image cap"><br>
                                    </div>
                                    <div style="font-weight:bold;font-size:0.7em;min-width:210px;max-width:400px;margin-top:4px;padding-top:4px;font-style: italic ">
                                        <div>{{househelp.full_name}},</div>
                                        <div>
                                            Househelp,
                                            <!-- {{househelp.position_name}}, -->
                                            <!-- <span style="color:#9a009a;">
                                                {{Bureau.name}},
                                            </span> -->
                                        </div>
                                        <div>
                                             ID: ,<span style="color:#9a009a;">{{bureauhousehelp.idstatus_id_number}}</span>,
                                            Phone: <span style="color:#9a009a;">{{bureauhousehelp.pivot.phone}},</span>
                                        </div>
                                        <div>
                                            Mail: <span style="color:#9a009a;">{{househelp.email}},</span>
                                        </div>
                                            <div>P. O. Box , <span style="color:#9a009a;">{{bureauhousehelp.pivot.address}}</span>,
                                            </div>
                                        <div>
                                            <span style="color:#9a009a;">{{bureauhousehelp.ward_name}}</span> ward,
                                            <span style="color:#9a009a;">{{bureauhousehelp.constituency_name}}</span> constituency,
                                        </div>
                                        <div >
                                            <span style="color:#9a009a;">{{bureauhousehelp.county_name}}</span> county,
                                            <span style="color:#9a009a;">{{bureauhousehelp.country_name}},</span>
                                        </div>
                                    </div>
                        </div>
                    </td>
                    <td>
                        <div class="row" v-for="bureauhousehelp in househelp.bureauhousehelps" :key="bureauhousehelp.id">
                           <div class="col" style="padding: 3px;">
                               <div style="font-weight:bold;font-size:0.7em;min-width:210px;max-width:400px;margin-top:4px;padding-top:4px;font-style: italic ">
                                    <div>Gender: <span style="color:#9a009a;">{{bureauhousehelp.gender_name}}</span>,
                                         Age: <span style="color:#9a009a;">{{bureauhousehelp.age}} Years</span>,
                                    </div>
                                    <div>
                                        Marital Status: <span style="color:#9a009a;">{{bureauhousehelp.maritalstatus_name}}</span>,
                                    </div>
                                    <div>
                                        English Ability: <span style="color:#9a009a;">{{bureauhousehelp.englishstatus_name}}</span>,
                                    </div>
                                    <div>
                                        Education Level: <span style="color:#9a009a;">{{bureauhousehelp.education_name}}</span>,
                                    </div>
                                    <div>
                                        Experience Level: <span style="color:#9a009a;">{{bureauhousehelp.experience_name}}</span>,
                                    </div>
                                    <div>
                                         Duration: <span style="color:#9a009a;">{{bureauhousehelp.duration_name}}</span>,
                                    </div>
                                    <div>
                                        Employemnt Status:
                                         <span style="color:#9a009a;">
                                            <div v-if="bureauhousehelp.employementstatus == true">
                                                <a type="button" class="btn btn-success btn-md"> Employed</a>
                                            </div>
                                            <div v-else-if="bureauhousehelp.employementstatus == false">
                                                <a type="button" class="btn btn-success btn-md"> Unemployed</a>
                                            </div>
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
                                    <span style="color:#9a009a;">{{househelp.created_at | dateformat}} </span>
                                </div>
                            </span>
                        </div>
                        <br>
                        <div class="clearfix" style="font-weight:bold;font-size:0.7em;">
                            <span class="float-left">
                                <router-link  :to="`/househelp/${househelp.id}`">
                                        <i class="fa fa-eye "></i>
                                </router-link>
                            </span>
                            <span class="float-right">
                                <a href=""  @click.prevent="deleteHousehelp(househelp.user_id)">
                                    <i class="fa fa-trash red"></i>
                                </a>
                            </span>
                        </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div v-if="Househelps.length" >
                  <div class="clearfix" style="font-weight:bold;font-size:0.7em;">
                        <span class="float-left" style="margin-bottom:-0.5em" >
                            <div style="margin-bottom:0.25em">
                                 Between <span style="color:#9a009a;"> {{pagination.from}} </span>
                                 & <span style="color:#9a009a;"> {{pagination.to}} </span>
                                out of <span style="color:#9a009a;"> {{pagination.total}} </span> Househelps
                            </div>
                            <button class="btn btn-info" v-on:click="fetchPaginatedHousehelps(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">Prev</button>
                        </span>
                        <span class="float-right" style="margin-bottom:-0.5em" >
                            <div style="margin-bottom:0.25em">
                                 Page <span style="color:#9a009a;"> {{pagination.current_page}} </span>
                                 of <span style="color:#9a009a;"> {{pagination.last_page}} </span>
                            </div>
                             <button class="btn btn-info" v-on:click="fetchPaginatedHousehelps(pagination.next_page_url)" :disabled="!pagination.next_page_url">Next</button>
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
                url:'/api/househelp/get/list',
                pagination:[],
            }
        },
        mounted() {
            this.loadHousehelps(); //from methods
        },
        computed:{
            Househelps(){
               return this.$store.getters.HousehelpsList
            },
        },
        methods:{
            loadHousehelps(){
               this.$Progress.start();
                return this.$store.dispatch( "househelpslist", this.url)
                 .then((response)=>{
                     this.makingPagination(response.data.househelps),
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
            },
            makingPagination(data){
                let pagination = {
                    current_page : data.current_page,
                    last_page: data.last_page,
                    from: data.from,
                    to: data.to,
                    total: data.total,
                    next_page_url: data.next_page_url,
                    prev_page_url: data.prev_page_url,
                }
                this.pagination = pagination;
                console.log( this.pagination, 'pagination')
            },
            fetchPaginatedHousehelps(url){
                this.url = url;
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

