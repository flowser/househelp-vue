<template>
<div class="content-wrapper">
  <div class="container-fluid mt-5">
      <!-- Main content -->
    <section class="content">
      <div class="row justify-content-around">
        <div class="col-md">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Bureaudirectors Table</h3>
              <div class="card-tools">
                    <button class="btn btn-success"  @click.prevent="newBureaudirectorModal()">Add New Bureaudirector
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
                    <th>Bureau Directors Details</th>
                    <th>Roles</th>
                    <th>Permissions</th>
                    <th style="padding-left: 14px">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(user, index) in Users" :key="user.id">
                    <td >{{index+1}}</td>
                    <td style="width: 500px;">
                        <div class="row" style="width:100%" v-for="director in user.bureaudirectors" :key="director.id">
                            <div class="col-sm-3" style="padding: 3px;">
                                 <img class="card-img-top" :src="bureaudirectorLoadPassPhoto(director.pivot.photo)" style="width:100%" alt="Card image cap">
                            </div>
                            <div class="col-sm-3" style="padding: 3px;">
                                <img class="card-img-top" :src="bureaudirectorLoadIDFrontPhoto(director.pivot.id_photo_front)" style="width:100%" alt="Card image cap"><br>
                                <img class="card-img-top" :src="bureaudirectorLoadIDBackPhoto(director.pivot.id_photo_back)" style="width:100%" alt="Card image cap">
                            </div>
                            <div class="col-sm-6" style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                <div>{{bureaudirector.full_name}},</div>
                                <div v-for="position in bureaudirector.positions" :key="position.id">
                                    {{position.name}},
                                    <span style="color:#9a009a;">
                                        {{bureau.name}},
                                    </span>
                                </div>
                                <div> ID: ,<span style="color:#9a009a;">{{bureau.pivot.id_no}}</span>,
                                    Phone: <span style="color:#9a009a;">{{bureau.pivot.phone}},</span>
                                </div>
                                <div>
                                     Mail: <span style="color:#9a009a;">{{bureaudirector.email}},</span>
                                </div>
                                    <div>P. O. Box , <span style="color:#9a009a;">{{bureau.pivot.address}}</span>,
                                    </div>
                                <div v-for="ward in bureaudirector.wards" :key="ward.id">
                                    <span style="color:#9a009a;">{{ward.name}}</span> ward,
                                    <span v-for="constituency in bureaudirector.constituencies" :key="constituency.id" style="color:#9a009a;">
                                        {{constituency.name}}</span> constituency,
                                </div>
                                <div v-for="county in bureaudirector.counties" :key="county.id" >
                                    <span style="color:#9a009a;">{{county.name}}</span> county,
                                    <span v-for="country in bureaudirector.countries" :key="country.id" style="color:#9a009a;">
                                        {{country.name}},
                                    </span>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td style="padding: 3px;">
                        <span v-for="role in bureaudirector.roles" :key="role.id" class="pl-2">
                            <div class="btn btn-primary btn-sm ml-1 mb-2 " >{{role.name}} </div>
                        </span>
                    </td>
                    <td style="padding: 3px;">
                        <span v-for="permission in bureaudirector.permissions" :key="permission.id" class="pl-2">
                            <div class="btn btn-primary btn-sm ml-1 mb-2 ">{{permission.name}} </div>
                        </span>
                    </td>
                    <td style="padding: 3px;" >
                        <div class="clearfix" style="font-weight:bold;font-size:0.7em;">
                            <span class="float-left" style="margin-bottom:-0.5em" >
                                <div style="margin-bottom:0.25em"> Updated at:
                                    <span style="color:#9a009a;">{{bureaudirector.created_at | dateformat}} </span>
                                </div>
                            </span>
                            <span class="float-right">
                                <a href=""  @click.prevent="editBureaudirectorModal(bureaudirector.id)">
                                    <i class="fa fa-edit blue"></i>
                                </a>
                                /
                                <a href=""  @click.prevent="deleteBureaudirector(bureaudirector.id)">
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
                                   out of <span style="color:#9a009a;"> {{Pagination.total}} </span> Bureau Directors
                               </div>
                               <button class="btn btn-info" v-on:click="fetchPaginatedBureaudirectors(Pagination.prev_page_url)" :disabled="!Pagination.prev_page_url">Prev</button>
                           </span>
                           <span class="float-right" style="margin-bottom:-0.5em" >
                               <div style="margin-bottom:0.25em">
                                   Page <span style="color:#9a009a;"> {{Pagination.current_page}} </span>
                                   of <span style="color:#9a009a;"> {{Pagination.last_page}} </span>
                               </div>
                               <button class="btn btn-info" v-on:click="fetchPaginatedBureaudirectors(Pagination.next_page_url)" :disabled="!Pagination.next_page_url">Next</button>
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
        <div class="modal fade " id="BureaudirectorModal" tabindex="-1" role="dialog" aria-labelledby="BureaudirectorModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form role="form" @submit.prevent="editmodeBureaudirector ? updateBureaudirector(bureaudirectorform.id) : addBureaudirector()" >
                        <div class="modal-body">
                            <h5 class="modal-title" v-show="editmodeBureaudirector" id="BureaudirectorModalLabel">Update Bureaudirector</h5>
                            <h5 class="modal-title" v-show="!editmodeBureaudirector" id="BureaudirectorModalLabel">Add New Bureaudirector</h5>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="first_name" class="col-form-label"> Bureaudirector First Name</label>
                                            <input v-model="bureaudirectorform.first_name" type="text" name="first_name" placeholder="Bureaudirector First Name"
                                                class="form-control" :class="{ 'is-invalid': bureaudirectorform.errors.has('first_name') }" >
                                            <has-error style="color: #e83e8c" :form="bureaudirectorform" field="first_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="last_name" class=" col-form-label">bureaudirector_Last Name </label>
                                            <input v-model="bureaudirectorform.last_name" type="bureaudirector_last_name" name="last_name" placeholder="Bureaudirector Last Name"
                                                class="form-control" :class="{ 'is-invalid': bureaudirectorform.errors.has('last_name') }" >
                                            <has-error style="color: #e83e8c" :form="bureaudirectorform" field="last_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="email" class=" col-form-label">Email </label>
                                            <input v-model="bureaudirectorform.email" type="email" name="email" placeholder="Email Address"
                                                class="form-control" :class="{ 'is-invalid': bureaudirectorform.errors.has('email') }" >
                                            <has-error style="color: #e83e8c" :form="bureaudirectorform" field="email"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <input v-model="bureaudirectorform.password" type="password" id="password" placeholder="Password"
                                                class="form-control" :class="{ 'is-invalid': bureaudirectorform.errors.has('password') }">
                                            <has-error :form="bureaudirectorform" field="password"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="phone" class="col-form-label"> Bureaudirector Phone</label>
                                                <div>
                                                    <vue-tel-input v-model="bureaudirectorform.phone" name="phone" @onInput="InputPhone"
                                                    class="form-control" :class="{ 'is-invalid': bureaudirectorform.errors.has('phone') }">
                                                    </vue-tel-input>
                                                    <has-error style="color: #e83e8c" :form="bureaudirectorform" field="phone"></has-error>
                                                </div>
                                                <div v-if="bureaudirectorform.phone" style="color: #e83e8c">
                                                    <span>Is valid: <strong>{{phone.isValid}}</strong>,&nbsp;</span>
                                                    <span>Country: <strong>{{phone.country}}</strong></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="landline" class=" col-form-label">Landline</label>
                                                <vue-tel-input v-model="bureaudirectorform.landline" name="landline" @onInput="InputLandline"
                                                    class="form-control" :class="{ 'is-invalid': bureaudirectorform.errors.has('landline') }">
                                                </vue-tel-input>
                                                <has-error style="color: #e83e8c" :form="bureaudirectorform" field="landline"></has-error>

                                                <div v-if="bureaudirectorform.landline" style="color: #e83e8c">
                                                    <span>Is valid: <strong>{{landline.isValid}}</strong>,&nbsp;</span>
                                                    <span>Country: <strong>{{landline.country}}</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <label for="id_no" class="col-form-label">ID no.</label>
                                            <input v-model="bureaudirectorform.id_no" type="text" name="id_no" placeholder="ID NO"
                                                class="form-control" :class="{ 'is-invalid': bureaudirectorform.errors.has('id_no') }" >
                                            <has-error style="color: #e83e8c" :form="bureaudirectorform" field="id_no"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="address" class=" col-form-label">Address</label>
                                            <input v-model="bureaudirectorform.address" type="text" name="address" placeholder="Address"
                                                class="form-control" :class="{ 'is-invalid': bureaudirectorform.errors.has('address') }" >
                                            <has-error style="color: #e83e8c" :form="bureaudirectorform" field="country_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="gender_id">Select Gender</label>
                                            <select class="form-control" v-model="bureaudirectorform.gender_id"
                                                    :class="{ 'is-invalid':bureaudirectorform.errors.has('gender_id') }">
                                                    <option disabled value="">Select gender</option>
                                                    <option v-for="gender in Genders" :value="gender.id" :key="gender.id">{{gender.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="bureaudirectorform" field="gender_id"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-3">
                                            <label for="country_id">Select Country</label>
                                            <select class="form-control" @change="countryCounties(bureaudirectorform.country_id)"
                                            v-model="bureaudirectorform.country_id" :class="{ 'is-invalid': bureaudirectorform.errors.has('country_id') }">
                                                    <option disabled value="">Select Country</option>{{bureaudirectorform.country_id}}
                                                    <option v-for="country in Countries" :value="country.id" :key="country.id">{{country.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="bureaudirectorform" field="country_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="county_id" class=" col-form-label">County</label>
                                            <select class="form-control" @change="countyConstituencies(bureaudirectorform.county_id)"
                                            v-model="bureaudirectorform.county_id" :class="{ 'is-invalid': bureaudirectorform.errors.has('county_id') }">
                                                    <option disabled value="">Select County</option>
                                                    <option v-for="county in Counties" :value="county.id" :key="county.id">{{county.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="bureaudirectorform" field="county_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="constituency_id" class=" col-form-label">Constituency</label>
                                            <select class="form-control" @change="constituencyWards(bureaudirectorform.constituency_id)"
                                            v-model="bureaudirectorform.constituency_id" :class="{ 'is-invalid': bureaudirectorform.errors.has('constituency_id') }">
                                                    <option disabled value="">Select County</option>
                                                    <option v-for="constituency in Constituencies" :value="constituency.id" :key="constituency.id">{{constituency.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="bureaudirectorform" field="constituency_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="ward_id" class="col-form-label"> Ward </label>
                                            <select class="form-control"
                                            v-model="bureaudirectorform.ward_id" :class="{ 'is-invalid': bureaudirectorform.errors.has('ward_id') }">
                                                    <option disabled value="">Select Ward</option>
                                                    <option v-for="ward in Wards" :value="ward.id" :key="ward.id">{{ward.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="bureaudirectorform" field="ward_id"></has-error>
                                        </div>

                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <label for="photo" class=" col-form-label">Bureaudirector PassPort Image</label><br>
                                                <input @change="bureaudirectorChangePassPhoto($event)" type="file" name="photo"
                                                    :class="{ 'is-invalid': bureaudirectorform.errors.has('photo') }">
                                                    <img v-show="editmodeBureaudirector" :src="updateBureaudirectorPassPhoto(bureaudirectorform.photo)" alt="" width="100%" >
                                                    <img  v-show="!editmodeBureaudirector" :src="bureaudirectorform.photo" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="bureaudirectorform" field="photo"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="id_photo_front" class=" col-form-label">Bureaudirector FrontSide ID Photo</label><br>
                                                <input @change="bureaudirectorChangeIDFrontPhoto($event)" type="file" name="id_photo_front"
                                                    :class="{ 'is-invalid': bureaudirectorform.errors.has('id_photo_front') }">
                                                    <img v-show="editmodeBureaudirector" :src="updateBureaudirectorIDFrontPhoto(bureaudirectorform.id_photo_front)" alt="" width="100%" >
                                                    <img  v-show="!editmodeBureaudirector" :src="bureaudirectorform.id_photo_front" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="bureaudirectorform" field="id_photo_front"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="backside_i_photod" class=" col-form-label">BackSide ID Photo</label><br>
                                                <input @change="bureaudirectorChangeIDBackPhoto($event)" type="file" name="id_photo_back"
                                                    :class="{ 'is-invalid': bureaudirectorform.errors.has('backside_id') }">
                                                    <img v-show="editmodeBureaudirector" :src="updateBureaudirectorIDBackPhoto(bureaudirectorform.id_photo_back)" alt="" width="100%" >
                                                    <img  v-show="!editmodeBureaudirector" :src="bureaudirectorform.id_photo_back" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="bureaudirectorform" field="id_photo_back"></has-error>
                                        </div>
                                    </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editmodeBureaudirector" type="submit" class="btn btn-success">Update</button>
                            <button v-show="!editmodeBureaudirector" type="submit" class="btn btn-primary">Create</button>
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
        name:"Bureaudirectors",
        data(){
            return{
                newBureaudirector: false,
                editmodeBureaudirector: false,
                bureaudirectorform: new Form({
                        id:'',
                        first_name:'',
                        last_name:'',
                        email:'',
                        password:'',
                        user_type:'',
                        user_id:'',
                        bureau_id:'',
                        position_id:'',
                        gender_id:'',
                        photo:'',
                        active:'',
                        id_no:'',
                        id_photo_front:'',
                        id_photo_back:'',
                        about_me:'',
                        phone:'',
                        landline:'',
                        address:'',
                        country_id:'',
                        county_id:'',
                        constituency_id:'',
                        ward_id:'',
                }),
                 //bureaudirector
                phone:{
                        isValid: false,
                        country: undefined,
                },
                landline:{
                        isValid: false,
                        country: undefined,
                },
                 url:'/api/bureaudirector/get',
                pagination:[],
            }
        },
        mounted() {
            this.loadCountries();
            this.loadCounties();
            this.loadConstituencies();
            this.loadWards();
            this.loadGenders();
            this.loadBureaudirectors();
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
                return this.$store.getters.BureauDirectors
            },
            Pagination(){
                return this.$store.getters.BureauDirectorPagination
            },

        },
        methods:{
            //bureaudirector
            InputPhone({ number, isValid, country }) {
            this.bureaudirectorform.phone = number;
            this.phone.isValid = isValid;
            this.phone.country = country && country.name;
            },
            InputLandline({ number, isValid, country }) {
            this.bureaudirectorform.landline = number;
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
            loadBureaudirectors(){
                this.$Progress.start();
                return this.$store.dispatch( "bureaudirectors", this.url)
                 .then((response)=>{
                    toast({
                     type: 'success',
                     title: 'Fetched the Bureauedirector data successfully'
                    })
                })
                .catch((response)=>{
                    this.$Progress.fail();
                    toast({
                    type: 'error',
                    title: 'There was something fffWrong'
                    })
                })
            },
            fetchPaginatedBureaudirectors(url){
                this.url = url;
                this.loadBureaudirectors();
            },
            newBureaudirectorModal(){
                 this.editmodeBureaudirector= false;
                 this.bureaudirectorform.reset()
                     $('#BureaudirectorModal').modal('show')
            },
            bureaudirectorLoadPassPhoto(bureaudirectorpivot_photo){
                if(bureaudirectorpivot_photo){
                    return "/assets/bureau/img/directors/passports/"+bureaudirectorpivot_photo;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            //bureaudirector passport photo
            bureaudirectorChangePassPhoto(event){
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
                            this.bureaudirectorform.photo =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateBureaudirectorPassPhoto(organisationbureaudirector_photo){
                console.log(organisationbureaudirector_photo, 'edit')
                let img = this.bureaudirectorform.photo;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                        //  console.log('its reall null')
                      }else{
                          if(img.length>100){
                            return this.bureaudirectorform.photo;
                        }else{
                            if(organisationbureaudirector_photo){
                                return "/assets/bureau/img/directors/passports/"+organisationbureaudirector_photo;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },
            bureaudirectorLoadIDFrontPhoto(bureaudirectorpivot_id_photo_front){
                if(bureaudirectorpivot_id_photo_front){
                    return "/assets/bureau/img/directors/IDs/front/"+bureaudirectorpivot_id_photo_front;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            bureaudirectorChangeIDFrontPhoto(event){
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
                            this.bureaudirectorform.id_photo_front =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateBureaudirectorIDFrontPhoto(bureaudirectorform_id_photo_front){
                let img = this.bureaudirectorform.id_photo_front;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.bureaudirectorform.id_photo_front;
                        }else{
                            if(bureaudirectorform_id_photo_front){
                                return "/assets/bureau/img/directors/IDs/front/"+bureaudirectorform_id_photo_front;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },
            bureaudirectorLoadIDBackPhoto(bureaudirectorform_id_photo_back){
                if(bureaudirectorform_id_photo_back){
                    return "/assets/bureau/img/directors/IDs/back/"+bureaudirectorform_id_photo_back;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            bureaudirectorChangeIDBackPhoto(event){
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
                            this.bureaudirectorform.id_photo_back =event.target.result
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateBureaudirectorIDBackPhoto(bureaudirectorform_id_photo_back){
                let img = this.bureaudirectorform.id_photo_back;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.bureaudirectorform.id_photo_back;
                        }else{
                            if(bureaudirectorform_id_photo_back){
                                return "/assets/bureau/img/directors/IDs/back/"+bureaudirectorform_id_photo_back;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },

            editBureaudirectorModal(id){
                 this.editmodeBureaudirector = true;
                 this.bureaudirectorform.reset()
                    this.$Progress.start();
                      axios.get('/api/bureaudirector/edit/'+id)
                        .then((response)=>{
                           $('#BureaudirectorModal').modal('show')
                           toast({
                            type: 'success',
                            title: 'Fetched the Bureaudirector data successfully'
                            })
                            console.log(response.data.director)
                            this.bureaudirectorform.fill(response.data.director)
                            this.bureaudirectorform.user_id = response.data.director.bureaudirectors[0].pivot.user_id
                            this.bureaudirectorform.organisation_id = response.data.director.bureaudirectors[0].pivot.organisation_id
                            this.bureaudirectorform.position_id = response.data.director.bureaudirectors[0].pivot.position_id
                            this.bureaudirectorform.gender_id = response.data.director.bureaudirectors[0].pivot.gender_id
                            this.bureaudirectorform.photo = response.data.director.bureaudirectors[0].pivot.photo
                            this.bureaudirectorform.id_no = response.data.director.bureaudirectors[0].pivot.id_no
                            this.bureaudirectorform.id_photo_front = response.data.director.bureaudirectors[0].pivot.id_photo_front
                            this.bureaudirectorform.id_photo_back = response.data.director.bureaudirectors[0].pivot.id_photo_back
                            this.bureaudirectorform.phone = response.data.director.bureaudirectors[0].pivot.phone
                            this.bureaudirectorform.landline = response.data.director.bureaudirectors[0].pivot.landline
                            this.bureaudirectorform.address = response.data.director.bureaudirectors[0].pivot.address

                            this.bureaudirectorform.country_id = response.data.director.bureaudirectors[0].pivot.country_id
                            //get county id using the country id
                            this.bureaudirectorform.county_id = response.data.director.bureaudirectors[0].pivot.county_id
                            this.$store.dispatch('countrycounties', response.data.director.bureaudirectors[0].pivot.country_id);
                            //get contituency using county id
                            this.bureaudirectorform.constituency_id = response.data.director.bureaudirectors[0].pivot.constituency_id
                            this.$store.dispatch('countyconstituencies', response.data.director.bureaudirectors[0].pivot.county_id);
                            // //get ward usng constituency id
                            this.bureaudirectorform.ward_id = response.data.director.bureaudirectors[0].pivot.ward_id
                            this.$store.dispatch('constituencywards', response.data.director.bureaudirectors[0].pivot.constituency_id);
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                            //errors
                            $('#BureaudirectorModal').modal('show');
                            toast({
                            type: 'error',
                            title: 'There was something Wrong'
                            })
                        })
            },
            addBureaudirector() {
                this.bureaudirectorform.user_type = "Bureaudirector";
                this.$Progress.start();
                this.bureaudirectorform.patch('/api/bureaudirector')
                    .then((response)=>{
                        //  console.log(response.data)
                         toast({
                            type: 'success',
                            title: 'Bureaudirector Created successfully'
                            })
                            this.loadBureaudirectors();
                            this.bureaudirectorform.reset()
                            $('#BureaudirectorModal').modal('hide')
                              this.$Progress.finish()
                    })
                    .catch((response)=>{
                        this.$Progress.fail()
                        //errors
                        console.log(response,'response')
                            $('#BureaudirectorModal').modal('show');
                            toast({
                                type: 'error',
                                title: 'There was something wrong.'
                                })
                    })
            },
            updateBureaudirector(id){
                  console.log('update bureaudirector')
                  this.$Progress.start();
                     this.bureaudirectorform.patch('/api/bureaudirector/update/'+id)
                        .then(()=>{
                            this.loadBureaudirectors();
                         $('#BureaudirectorModal').modal('hide')
                         toast({
                            type: 'success',
                            title: 'Bureaudirector Created successfully'
                            })
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                            toast({
                            type: 'error',
                            title: 'There was something wrong'
                            })
                        })
            },
            deleteBureaudirector(id){
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
                    //  console.log('delete bureaudirector', id)
                        this.$Progress.start();
                        this.bureaudirectorform.get('/api/bureaudirector/delete/'+id)
                            .then(()=>{
                            toast({
                            type: 'success',
                            title: 'Bureaudirector Deleted successfully'
                            })
                            this.loadBureaudirectors();
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



