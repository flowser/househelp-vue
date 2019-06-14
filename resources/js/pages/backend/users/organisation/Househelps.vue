<template>
<div class="content-wrapper">
  <div class="container-fluid mt-5">
      <!-- Main content -->
    <section class="content">
      <div class="row justify-content-around">
        <div class="col-md">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Househelps Table</h3>
              <div class="card-tools">
                    <button class="btn btn-success"  @click.prevent="newHousehelpModal()">Add New Househelp
                         <i class="fas fa-plus fw"></i>
                     </button>

              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>S1</th>
                    <th>Househelp Details</th>
                    <th>Roles</th>
                    <th>Permissions</th>
                    <th style="padding-left: 14px">Actions</th>
                  </tr>

                </thead>
                <tbody>
                  <tr v-for="(user, index) in Users" :key="user.id">
                    <td style="width:1px">{{index+1}}</td>
                    <td style="width: 540px;">
                        <div class="row" style="width:100%" v-for="househelp in user.bureauhousehelps" :key="househelp.id">
                            <div class="col-sm-3" style="padding: 3px;">
                                 <img class="card-img-top" :src="househelpLoadPassPhoto(househelp.pivot.photo)" style="width:100%" alt="Card image cap">
                            </div>
                            <div class="col-sm-9" style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                <div> <span style="color:#9a009a;">{{user.full_name}}</span>,
                                      Bureau: <span style="color:#9a009a;">{{househelp.name}},</span></div>
                                <div> Phone: <span style="color:#9a009a;">{{househelp.pivot.phone}},</span></div>
                                <div> Mail: <span style="color:#9a009a;">{{user.email}},</span></div>
                                <div>P. O. Box , <span style="color:#9a009a;">{{househelp.pivot.address}}</span>,</div>
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
                    <td style="padding: 3px;">
                        <span v-for="role in user.roles" :key="role.id" class="pl-2">
                            <div class="btn btn-primary btn-sm ml-1 mb-2 " >{{role.name}} </div>
                        </span>
                    </td>
                    <td style="padding: 3px;">
                        <span v-for="permission in user.permissions" :key="permission.id" class="pl-2">
                            <div class="btn btn-primary btn-sm ml-1 mb-2 ">{{permission.name}} </div>
                        </span>
                    </td>
                    <td style="padding: 3px;" >
                        <div class="clearfix" style="font-weight:bold;font-size:0.7em;">
                            <span class="float-left" style="margin-bottom:-0.5em" >
                                <div style="margin-bottom:0.25em"> Updated at:
                                    <span style="color:#9a009a;">{{user.created_at | dateformat}} </span>
                                </div>
                            </span>
                            <span class="float-right">
                                <a href=""  @click.prevent="editHousehelpModal(user.id)">
                                    <i class="fa fa-edit blue"></i>
                                </a>
                                /
                                <a href=""  @click.prevent="deleteHousehelp(user.id)">
                                    <i class="fa fa-trash red"></i>
                                </a>
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
      <!-- /.row -->
    </section>

    <!-- Role Modal -->
        <div class="modal fade " id="HousehelpModal" tabindex="-1" role="dialog" aria-labelledby="HousehelpModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form role="form" @submit.prevent="editmodeHousehelp ? updateHousehelp(househelpform.id) : addHousehelp()" >
                        <div class="modal-body">
                            <h5 class="modal-title" v-show="editmodeHousehelp" id="HousehelpModalLabel">Update Househelp</h5>
                            <h5 class="modal-title" v-show="!editmodeHousehelp" id="HousehelpModalLabel">Add New Househelp</h5>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="first_name" class="col-form-label"> Househelp Passport</label>
                                    <img v-show="editmodeHousehelp" :src="updateHousehelpPassPhoto(househelpform.photo)" alt="" width="100%" >
                                </div>
                                <div class="form-group col-md-8">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="first_name" class="col-form-label"> Househelp First Name</label>
                                            <input v-model="househelpform.first_name" type="text" name="first_name" placeholder="Househelp First Name"
                                                class="form-control" :class="{ 'is-invalid': househelpform.errors.has('first_name') }" >
                                            <has-error style="color: #e83e8c" :form="househelpform" field="first_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="last_name" class=" col-form-label">househelp_Last Name </label>
                                            <input v-model="househelpform.last_name" type="househelp_last_name" name="last_name" placeholder="Househelp Last Name"
                                                class="form-control" :class="{ 'is-invalid': househelpform.errors.has('last_name') }" >
                                            <has-error style="color: #e83e8c" :form="househelpform" field="last_name"></has-error>
                                        </div>
                                    </div>
                                    <div class="row">
                                         <div class="form-group col-md-6">
                                            <label for="email" class=" col-form-label">Email </label>
                                            <input v-model="househelpform.email" type="email" name="email" placeholder="Email Address"
                                                class="form-control" :class="{ 'is-invalid': househelpform.errors.has('email') }" >
                                            <has-error style="color: #e83e8c" :form="househelpform" field="email"></has-error>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="password" class=" col-form-label">Password </label>
                                            <input v-model="househelpform.password" type="password" id="password" placeholder="Password"
                                                class="form-control" :class="{ 'is-invalid': househelpform.errors.has('password') }">
                                            <has-error :form="househelpform" field="password"></has-error>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editmodeHousehelp" type="submit" class="btn btn-success">Update</button>
                            <button v-show="!editmodeHousehelp" type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

  </div>
</div>

</template>

<script>
    export default {
        name:"Organisation-Househelps",
        data(){
            return{
                newHousehelp: false,
                editmodeHousehelp: false,
                imageUrl:'',
                househelpform: new Form({
                        id:'',
                        first_name:'',
                        last_name:'',
                        email:'',
                        password:'',
                        user_type:'',
                        photo:'',
                }),
                url:'/api/househelp/get/list',
                pagination:[],
            }
        },
        mounted() {
            this.loadCountries();
            this.loadCounties();
            this.loadConstituencies();
            this.loadWards();
            this.loadGenders();
            this.loadHousehelps();
        },
        computed:{
            Countries(){
                return this.$store.getters.Countries
            },
            Counties(){
               return this.$store.getters.CountryCounties
            },
            Constituencies(){
               return this.$store.getters.CountyConstituencies
            },
            Wards(){
               return this.$store.getters.ConstituencyWards
            },
            Genders(){
               return this.$store.getters.Genders
            },
            Users(){
                return this.$store.getters.HousehelpsList
            },
            Pagination(){
                return this.$store.getters.Pagination
            }
        },
        methods:{
             loadHousehelps(){
                this.$Progress.start();
                return this.$store.dispatch("househelpslist", this.url)
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
            },
            fetchPaginatedHousehelps(url){
                this.url = url;
                this.loadHousehelps();
            },
            //househelp
            InputPhone({ number, isValid, country }) {
            this.househelpform.phone = number;
            this.phone.isValid = isValid;
            this.phone.country = country && country.name;
            },
            InputLandline({ number, isValid, country }) {
            this.househelpform.landline = number;
            this.landline.isValid = isValid;
            this.landline.country = country && country.name;
            },
            countryCounties(country_id){
                this.$store.dispatch('countrycounties', country_id);
            },
            countyConstituencies(county_id){
                this.$store.dispatch('countyconstituencies', county_id);
            },
            constituencyWards(constituency_id){
                this.$store.dispatch('constituencywards', constituency_id); //send to store to the action with id
            },
            loadCountries(){
                return this.$store.dispatch( "countries")//get all from roles.index
            },
            loadCounties(){
                return this.$store.dispatch( "countrycounties")//get all from counties.index
            },
            loadConstituencies(){
                return this.$store.dispatch( "countyconstituencies")//get all from counties.index
            },
            loadWards(){
                return this.$store.dispatch( "constituencywards")//get all from towns.index
            },
            loadGenders(){
               return this.$store.dispatch("genders")
            },
            newHousehelpModal(){
                 this.editmodeHousehelp= false;
                 this.househelpform.reset()
                     $('#HousehelpModal').modal('show')
            },
            househelpLoadPassPhoto(househelppivot_photo){
                if(househelppivot_photo){
                    return "/assets/bureau/img/househelps/passports/"+househelppivot_photo;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            //househelp passport photo
            househelpChangePassPhoto(event){
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
                            this.househelpform.photo =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateHousehelpPassPhoto(organisationhousehelp_photo){
                console.log(organisationhousehelp_photo, 'edit')
                let img = this.househelpform.photo;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                        //  console.log('its reall null')
                      }else{
                          if(img.length>100){
                            return this.househelpform.photo;
                        }else{
                            if(organisationhousehelp_photo){
                                return "/assets/bureau/img/househelps/passports/"+organisationhousehelp_photo;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },
            househelpLoadIDFrontPhoto(househelppivot_id_photo_front){
                if(househelppivot_id_photo_front){
                    return "/assets/bureau/img/househelps/IDs/front/"+househelppivot_id_photo_front;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            househelpChangeIDFrontPhoto(event){
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
                            this.househelpform.id_photo_front =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateHousehelpIDFrontPhoto(househelpform_id_photo_front){
                let img = this.househelpform.id_photo_front;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.househelpform.id_photo_front;
                        }else{
                            if(househelpform_id_photo_front){
                                return "/assets/bureau/img/househelps/IDs/front/"+househelpform_id_photo_front;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },
            househelpLoadIDBackPhoto(househelpform_id_photo_back){
                if(househelpform_id_photo_back){
                    return "/assets/bureau/img/househelps/IDs/back/"+househelpform_id_photo_back;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            househelpChangeIDBackPhoto(event){
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
                            this.househelpform.id_photo_back =event.target.result
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateHousehelpIDBackPhoto(househelpform_id_photo_back){
                let img = this.househelpform.id_photo_back;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.househelpform.id_photo_back;
                        }else{
                            if(househelpform_id_photo_back){
                                return "/assets/bureau/img/househelps/IDs/back/"+househelpform_id_photo_back;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },
            househelpLoadWaitingCardPhoto(househelpform_waitingcard_photo){
                if(househelpform_waitingcard_photo){
                    return "/assets/bureau/img/househelps/waitingcards/"+househelpform_waitingcard_photo;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            househelpChangeWaitingCardPhoto(event){
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
                            this.househelpform.id_photo_back =event.target.result
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateHousehelpWaitingCardPhoto(househelpform_id_photo_back){
                let img = this.househelpform.id_photo_back;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.househelpform.id_photo_back;
                        }else{
                            if(househelpform_id_photo_back){
                                return "/assets/bureau/img/househelps/IDs/back/"+househelpform_id_photo_back;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },



            editHousehelpModal(id){
                 this.editmodeHousehelp = true;
                 this.househelpform.reset()
                    this.$Progress.start();
                      axios.get('/api/househelp/edit/'+id)
                        .then((response)=>{
                           $('#HousehelpModal').modal('show')
                           toast({
                            type: 'success',
                            title: 'Fetched the Househelp data successfully'
                            })
                            console.log(response.data.user)
                            this.househelpform.fill(response.data.user)
                            this.househelpform.first_name = response.data.user.first_name;
                            this.househelpform.last_name = response.data.user.last_name;
                            this.househelpform.email = response.data.user.email;
                            this.househelpform.user_type = response.data.user.user_type;
                            this.househelpform.photo = response.data.user.bureauhousehelps[0].pivot.photo

                            // this.househelpform.user_id = response.data.user.bureauhousehelps[0].pivot.user_id
                            // this.househelpform.organisation_id = response.data.user.bureauhousehelps[0].pivot.organisation_id
                            // this.househelpform.position_id = response.data.user.bureauhousehelps[0].pivot.position_id
                            // this.househelpform.gender_id = response.data.user.bureauhousehelps[0].pivot.gender_id
                            // this.househelpform.photo = response.data.user.bureauhousehelps[0].pivot.photo
                            // this.househelpform.id_no = response.data.user.bureauhousehelps[0].idstatus_id_number
                            // this.househelpform.id_photo_front = response.data.user.bureauhousehelps[0].idstatus_id_photo_front
                            // this.househelpform.id_photo_back = response.data.user.bureauhousehelps[0].idstatus_id_photo_back

                            // if(response.data.user.bureauhousehelps[0].idstatus_waiting_card_photo){
                            //     this.househelpform.id_photo_back = response.data.user.bureauhousehelps[0].idstatus_waiting_card_photo
                            // }


                            // this.househelpform.phone = response.data.user.bureauhousehelps[0].pivot.phone
                            // this.househelpform.address = response.data.user.bureauhousehelps[0].pivot.address

                            // this.househelpform.country_id = response.data.user.bureauhousehelps[0].pivot.country_id
                            // //get county id using the country id
                            // this.househelpform.county_id = response.data.user.bureauhousehelps[0].pivot.county_id
                            // this.$store.dispatch('countrycounties', response.data.user.bureauhousehelps[0].pivot.country_id);
                            // //get contituency using county id
                            // this.househelpform.constituency_id = response.data.user.bureauhousehelps[0].pivot.constituency_id
                            // this.$store.dispatch('countyconstituencies', response.data.user.bureauhousehelps[0].pivot.county_id);
                            // // //get ward usng constituency id
                            // this.househelpform.ward_id = response.data.user.bureauhousehelps[0].pivot.ward_id
                            // this.$store.dispatch('constituencywards', response.data.user.bureauhousehelps[0].pivot.constituency_id);
                            this.$Progress.finish();



                            // this.househelpform.user_id = response.data.user.bureauhousehelps[0].user_id;
                            // this.househelpform.bureau_id = response.data.user.bureauhousehelps[0].bureau_id;
                            // this.househelpform.photo = response.data.user.bureauhousehelps[0].photo;
                            // this.househelpform.about_me = response.data.user.bureauhousehelps[0].about_me;
                            // this.househelpform.phone = response.data.user.bureauhousehelps[0].phone;
                            // this.househelpform.address = response.data.user.bureauhousehelps[0].address;
                            // this.househelpform.country_id = response.data.user.bureauhousehelps[0].country_id;
                            // this.househelpform.county_id = response.data.user.bureauhousehelps[0].county_id;
                            // this.househelpform.constituency_id = response.data.user.bureauhousehelps[0].constituency_id;
                            // this.househelpform.ward_id = response.data.user.bureauhousehelps[0].ward_id;
                            // //extra
                            // this.househelpform.birth_date = response.data.user.bureauhousehelps[0].birth_date;
                            // this.househelpform.age = response.data.user.bureauhousehelps[0].age;
                            // this.househelpform.gender_id = response.data.user.bureauhousehelps[0].gender_id;
                            // this.househelpform.education_id = response.data.user.bureauhousehelps[0].education_id;
                            // this.househelpform.experience_id = response.data.user.bureauhousehelps[0].experience_id;
                            // this.househelpform.maritalstatus_id = response.data.user.bureauhousehelps[0].maritalstatus_id;
                            // this.househelpform.tribe_id = response.data.user.bureauhousehelps[0].tribe_id;
                            // this.househelpform.skill_id = response.data.user.bureauhousehelps[0].skill_id;
                            // this.househelpform.operation_id = response.data.user.bureauhousehelps[0].operation_id;
                            // this.househelpform.duration_id = response.data.user.bureauhousehelps[0].duration_id;
                            // this.househelpform.englishstatus_id = response.data.user.bureauhousehelps[0].englishstatus_id;
                            // this.househelpform.religion_id = response.data.user.bureauhousehelps[0].religion_id;
                            // this.househelpform.kid_id = response.data.user.bureauhousehelps[0].kid_id;
                            // //idstatus
                            // this.househelpform.IDstatus = response.data.user.bureauhousehelps[0].IDstatus;
                            // this.househelpform.idstatus_id = response.data.user.bureauhousehelps[0].idstatus_id;//id of idstatus row
                            // this.househelpform.bureau_househelp_id = response.data.user.bureauhousehelps[0].bureau_househelp_id;
                            // this.househelpform.id_status = response.data.user.bureauhousehelps[0].id_status;
                            // this.househelpform.id_number = response.data.user.bureauhousehelps[0].id_number;
                            // this.househelpform.ref_number = response.data.user.bureauhousehelps[0].ref_number;
                            // this.househelpform.id_photo_front = response.data.user.bureauhousehelps[0].id_photo_front;
                            // this.househelpform.id_photo_back = response.data.user.bureauhousehelps[0].id_photo_back;
                            // this.househelpform.waiting_card_photo = response.data.user.bureauhousehelps[0].waiting_card_photo;
                            // this.househelpform.reason = response.data.user.bureauhousehelps[0].reason;
                            // this.househelpform.status = response.data.user.bureauhousehelps[0].status;
                            // //health status
                            // this.househelpform.HealthStatus = response.data.user.bureauhousehelps[0];
                            // this.househelpform.health_status_id = response.data.user.bureauhousehelps[0];
                            // this.househelpform.bureau_househelp_id = response.data.user.bureauhousehelps[0];
                            // this.househelpform.health_status = response.data.user.bureauhousehelps[0];
                            // this.househelpform.HIV_status = response.data.user.bureauhousehelps[0];
                            // this.househelpform.allergy = response.data.user.bureauhousehelps[0];
                            // this.househelpform.chronic_details = response.data.user.bureauhousehelps[0];
                            // this.househelpform.other_chronics = response.data.user.bureauhousehelps[0];
                            // this.househelpform.specify = response.data.user.bureauhousehelps[0];
                            // this.househelpform.status = response.data.user.bureauhousehelps[0];

                        })
                        .catch(()=>{
                            this.$Progress.fail();
                            //errors
                            $('#HousehelpModal').modal('show');
                            toast({
                            type: 'error',
                            title: 'There was something Wrong'
                            })
                        })
            },
            addHousehelp() {
                this.househelpform.user_type = "Organisation Househelp";
                this.$Progress.start();
                this.househelpform.patch('/api/househelp')
                    .then((response)=>{
                        //  console.log(response.data)
                         toast({
                            type: 'success',
                            title: 'Househelp Created successfully'
                            })
                            this.loadHousehelps();
                            this.househelpform.reset()
                            $('#HousehelpModal').modal('hide')
                              this.$Progress.finish()
                    })
                    .catch((response)=>{
                        this.$Progress.fail()
                        //errors
                        console.log(response,'response')
                            $('#HousehelpModal').modal('show');
                            toast({
                                type: 'error',
                                title: 'There was something wrong.'
                                })
                    })
            },
            updateHousehelp(id){
                  console.log('update househelp')
                  this.$Progress.start();
                     this.househelpform.patch('/api/user/update/'+id)
                        .then(()=>{
                         $('#HousehelpModal').modal('hide')
                         this.loadHousehelps();
                         toast({
                            type: 'success',
                            title: 'Househelp Created successfully'
                            })
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            toast({
                            type: 'error',
                            title: 'There was something wrong'
                            })
                            $('#HousehelpModal').modal('show')
                            this.$Progress.fail();
                        })
            },
            deleteHousehelp(id){
                Swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                })
                .then((result) => {
                    if (result.value) {
                    //  console.log('delete househelp', id)
                        this.$Progress.start();
                        this.househelpform.get('/api/househelp/delete/'+id)
                            .then(()=>{
                            toast({
                            type: 'success',
                            title: 'Househelp Deleted successfully'
                            })
                            this.loadHousehelps();
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                            toast({
                            type: 'error',
                            title: 'There was something wrong'
                            })
                        })
                     }
                })
             }
        },

    }
</script>






