<template>
<div class="content-wrapper">
  <div class="container-fluid mt-5">
      <!-- Main content -->
    <section class="content">
      <div class="row justify-content-around">
        <div class="col-md">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Bureauadmins Table</h3>
              <div class="card-tools">
                    <button class="btn btn-success"  @click.prevent="newBureauadminModal()">Add New Bureauadmin
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
                    <th>Bureauadmin Details</th>
                    <th>Roles</th>
                    <th>Permissions</th>
                    <th style="padding-left: 14px">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(bureauadmin, index) in Bureauadmins" :key="bureauadmin.id">
                    <td >{{index+1}}</td>
                    <td style="width: 500px;">
                        <div class="row" style="width:100%" v-for="bureau in bureauadmin.bureauadmins" :key="bureau.id">
                            <div class="col-sm-3" style="padding: 3px;">
                                 <img class="card-img-top" :src="bureauadminLoadPassPhoto(bureau.pivot.photo)" style="width:100%" alt="Card image cap">
                            </div>
                            <div class="col-sm-3" style="padding: 3px;">
                                <img class="card-img-top" :src="bureauadminLoadIDFrontPhoto(bureau.pivot.id_photo_front)" style="width:100%" alt="Card image cap"><br>
                                <img class="card-img-top" :src="bureauadminLoadIDBackPhoto(bureau.pivot.id_photo_back)" style="width:100%" alt="Card image cap">
                            </div>
                            <div class="col-sm-6" style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                <div>{{bureauadmin.full_name}},</div>
                                <div v-for="position in bureauadmin.positions" :key="position.id">
                                    {{position.name}},
                                    <span style="color:#9a009a;">
                                        {{bureau.name}},
                                    </span>
                                </div>
                                <div> ID: ,<span style="color:#9a009a;">{{bureau.pivot.id_no}}</span>,
                                    Phone: <span style="color:#9a009a;">{{bureau.pivot.phone}},</span>
                                </div>
                                <div>
                                     Mail: <span style="color:#9a009a;">{{bureauadmin.email}},</span>
                                </div>
                                    <div>P. O. Box , <span style="color:#9a009a;">{{bureau.pivot.address}}</span>,
                                    </div>
                                <div v-for="ward in bureauadmin.wards" :key="ward.id">
                                    <span style="color:#9a009a;">{{ward.name}}</span> ward,
                                    <span v-for="constituency in bureauadmin.constituencies" :key="constituency.id" style="color:#9a009a;">
                                        {{constituency.name}}</span> constituency,
                                </div>
                                <div v-for="county in bureauadmin.counties" :key="county.id" >
                                    <span style="color:#9a009a;">{{county.name}}</span> county,
                                    <span v-for="country in bureauadmin.countries" :key="country.id" style="color:#9a009a;">
                                        {{country.name}},
                                    </span>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td style="padding: 3px;">
                        <span v-for="role in bureauadmin.roles" :key="role.id" class="pl-2">
                            <div class="btn btn-primary btn-sm ml-1 mb-2 " >{{role.name}} </div>
                        </span>
                    </td>
                    <td style="padding: 3px;">
                        <span v-for="permission in bureauadmin.permissions" :key="permission.id" class="pl-2">
                            <div class="btn btn-primary btn-sm ml-1 mb-2 ">{{permission.name}} </div>
                        </span>
                    </td>
                    <td style="padding: 3px;" >
                        <div class="clearfix" style="font-weight:bold;font-size:0.7em;">
                            <span class="float-left" style="margin-bottom:-0.5em" >
                                <div style="margin-bottom:0.25em"> Updated at:
                                    <span style="color:#9a009a;">{{bureauadmin.created_at | dateformat}} </span>
                                </div>
                            </span>
                            <span class="float-right">
                                <a href=""  @click.prevent="editBureauadminModal(bureauadmin.id)">
                                    <i class="fa fa-edit blue"></i>
                                </a>
                                /
                                <a href=""  @click.prevent="deleteBureauadmin(bureauadmin.id)">
                                    <i class="fa fa-trash red"></i>
                                </a>
                            </span>
                        </div>
                    </td>
                  </tr>
                </tbody>
              </table>
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
        <div class="modal fade " id="BureauadminModal" tabindex="-1" role="dialog" aria-labelledby="BureauadminModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form role="form" @submit.prevent="editmodeBureauadmin ? updateBureauadmin(bureauadminform.id) : addBureauadmin()" >
                        <div class="modal-body">
                            <h5 class="modal-title" v-show="editmodeBureauadmin" id="BureauadminModalLabel">Update Bureauadmin</h5>
                            <h5 class="modal-title" v-show="!editmodeBureauadmin" id="BureauadminModalLabel">Add New Bureauadmin</h5>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="first_name" class="col-form-label"> Bureauadmin First Name</label>
                                            <input v-model="bureauadminform.first_name" type="text" name="first_name" placeholder="Bureauadmin First Name"
                                                class="form-control" :class="{ 'is-invalid': bureauadminform.errors.has('first_name') }" >
                                            <has-error style="color: #e83e8c" :form="bureauadminform" field="first_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="last_name" class=" col-form-label">bureauadmin_Last Name </label>
                                            <input v-model="bureauadminform.last_name" type="bureauadmin_last_name" name="last_name" placeholder="Bureauadmin Last Name"
                                                class="form-control" :class="{ 'is-invalid': bureauadminform.errors.has('last_name') }" >
                                            <has-error style="color: #e83e8c" :form="bureauadminform" field="last_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="email" class=" col-form-label">Email </label>
                                            <input v-model="bureauadminform.email" type="email" name="email" placeholder="Email Address"
                                                class="form-control" :class="{ 'is-invalid': bureauadminform.errors.has('email') }" >
                                            <has-error style="color: #e83e8c" :form="bureauadminform" field="email"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <input v-model="bureauadminform.password" type="password" id="password" placeholder="Password"
                                                class="form-control" :class="{ 'is-invalid': bureauadminform.errors.has('password') }">
                                            <has-error :form="bureauadminform" field="password"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="phone" class="col-form-label"> Bureauadmin Phone</label>
                                                <div>
                                                    <vue-tel-input v-model="bureauadminform.phone" name="phone" @onInput="InputPhone"
                                                    class="form-control" :class="{ 'is-invalid': bureauadminform.errors.has('phone') }">
                                                    </vue-tel-input>
                                                    <has-error style="color: #e83e8c" :form="bureauadminform" field="phone"></has-error>
                                                </div>
                                                <div v-if="bureauadminform.phone" style="color: #e83e8c">
                                                    <span>Is valid: <strong>{{phone.isValid}}</strong>,&nbsp;</span>
                                                    <span>Country: <strong>{{phone.country}}</strong></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="landline" class=" col-form-label">Landline</label>
                                                <vue-tel-input v-model="bureauadminform.landline" name="landline" @onInput="InputLandline"
                                                    class="form-control" :class="{ 'is-invalid': bureauadminform.errors.has('landline') }">
                                                </vue-tel-input>
                                                <has-error style="color: #e83e8c" :form="bureauadminform" field="landline"></has-error>

                                                <div v-if="bureauadminform.landline" style="color: #e83e8c">
                                                    <span>Is valid: <strong>{{landline.isValid}}</strong>,&nbsp;</span>
                                                    <span>Country: <strong>{{landline.country}}</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <label for="id_no" class="col-form-label">ID no.</label>
                                            <input v-model="bureauadminform.id_no" type="text" name="id_no" placeholder="ID NO"
                                                class="form-control" :class="{ 'is-invalid': bureauadminform.errors.has('id_no') }" >
                                            <has-error style="color: #e83e8c" :form="bureauadminform" field="id_no"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="address" class=" col-form-label">Address</label>
                                            <input v-model="bureauadminform.address" type="text" name="address" placeholder="Address"
                                                class="form-control" :class="{ 'is-invalid': bureauadminform.errors.has('address') }" >
                                            <has-error style="color: #e83e8c" :form="bureauadminform" field="country_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="gender_id">Select Gender</label>
                                            <select class="form-control" v-model="bureauadminform.gender_id"
                                                    :class="{ 'is-invalid':bureauadminform.errors.has('gender_id') }">
                                                    <option disabled value="">Select gender</option>
                                                    <option v-for="gender in Genders" :value="gender.id" :key="gender.id">{{gender.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="bureauadminform" field="gender_id"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-3">
                                            <label for="country_id">Select Country</label>
                                            <select class="form-control" @change="countryCounties(bureauadminform.country_id)"
                                            v-model="bureauadminform.country_id" :class="{ 'is-invalid': bureauadminform.errors.has('country_id') }">
                                                    <option disabled value="">Select Country</option>{{bureauadminform.country_id}}
                                                    <option v-for="country in Countries" :value="country.id" :key="country.id">{{country.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="bureauadminform" field="country_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="county_id" class=" col-form-label">County</label>
                                            <select class="form-control" @change="countyConstituencies(bureauadminform.county_id)"
                                            v-model="bureauadminform.county_id" :class="{ 'is-invalid': bureauadminform.errors.has('county_id') }">
                                                    <option disabled value="">Select County</option>
                                                    <option v-for="county in Counties" :value="county.id" :key="county.id">{{county.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="bureauadminform" field="county_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="constituency_id" class=" col-form-label">Constituency</label>
                                            <select class="form-control" @change="constituencyWards(bureauadminform.constituency_id)"
                                            v-model="bureauadminform.constituency_id" :class="{ 'is-invalid': bureauadminform.errors.has('constituency_id') }">
                                                    <option disabled value="">Select County</option>
                                                    <option v-for="constituency in Constituencies" :value="constituency.id" :key="constituency.id">{{constituency.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="bureauadminform" field="constituency_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="ward_id" class="col-form-label"> Ward </label>
                                            <select class="form-control"
                                            v-model="bureauadminform.ward_id" :class="{ 'is-invalid': bureauadminform.errors.has('ward_id') }">
                                                    <option disabled value="">Select Ward</option>
                                                    <option v-for="ward in Wards" :value="ward.id" :key="ward.id">{{ward.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="bureauadminform" field="ward_id"></has-error>
                                        </div>

                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <label for="photo" class=" col-form-label">Bureauadmin PassPort Image</label><br>
                                                <input @change="bureauadminChangePassPhoto($event)" type="file" name="photo"
                                                    :class="{ 'is-invalid': bureauadminform.errors.has('photo') }">
                                                    <img v-show="editmodeBureauadmin" :src="updateBureauadminPassPhoto(bureauadminform.photo)" alt="" width="100%" >
                                                    <img  v-show="!editmodeBureauadmin" :src="bureauadminform.photo" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="bureauadminform" field="photo"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="id_photo_front" class=" col-form-label">Bureauadmin FrontSide ID Photo</label><br>
                                                <input @change="bureauadminChangeIDFrontPhoto($event)" type="file" name="id_photo_front"
                                                    :class="{ 'is-invalid': bureauadminform.errors.has('id_photo_front') }">
                                                    <img v-show="editmodeBureauadmin" :src="updateBureauadminIDFrontPhoto(bureauadminform.id_photo_front)" alt="" width="100%" >
                                                    <img  v-show="!editmodeBureauadmin" :src="bureauadminform.id_photo_front" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="bureauadminform" field="id_photo_front"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="backside_i_photod" class=" col-form-label">BackSide ID Photo</label><br>
                                                <input @change="bureauadminChangeIDBackPhoto($event)" type="file" name="id_photo_back"
                                                    :class="{ 'is-invalid': bureauadminform.errors.has('backside_id') }">
                                                    <img v-show="editmodeBureauadmin" :src="updateBureauadminIDBackPhoto(bureauadminform.id_photo_back)" alt="" width="100%" >
                                                    <img  v-show="!editmodeBureauadmin" :src="bureauadminform.id_photo_back" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="bureauadminform" field="id_photo_back"></has-error>
                                        </div>
                                    </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editmodeBureauadmin" type="submit" class="btn btn-success">Update</button>
                            <button v-show="!editmodeBureauadmin" type="submit" class="btn btn-primary">Create</button>
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
        name:"Organisation-Bureauadmins",
        data(){
            return{
                newBureauadmin: false,
                editmodeBureauadmin: false,
                bureauadminform: new Form({
                        id:'',
                        first_name:'',
                        last_name:'',
                        email:'',
                        password:'',
                        user_type:'',
                        user_id:'',
                        organisation_id:'',
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
                 //bureauadmin
                phone:{
                        isValid: false,
                        country: undefined,
                },
                landline:{
                        isValid: false,
                        country: undefined,
                },
            }
        },
        mounted() {
            this.loadCountries();
            this.loadCounties();
            this.loadConstituencies();
            this.loadWards();
            this.loadGenders();
            this.loadBureauadmins();
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
            Bureauadmins(){
                return this.$store.getters.BureauAdminsList
            },

        },
        methods:{
            //bureauadmin
            InputPhone({ number, isValid, country }) {
            this.bureauadminform.phone = number;
            this.phone.isValid = isValid;
            this.phone.country = country && country.name;
            },
            InputLandline({ number, isValid, country }) {
            this.bureauadminform.landline = number;
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
            loadBureauadmins(){
                return this.$store.dispatch( "bureauadminslist")//get all from bureauadmins.index
            },
            newBureauadminModal(){
                 this.editmodeBureauadmin= false;
                 this.bureauadminform.reset()
                     $('#BureauadminModal').modal('show')
            },
            bureauadminLoadPassPhoto(bureauadminpivot_photo){
                if(bureauadminpivot_photo){
                    return "/assets/bureau/img/admins/passports/"+bureauadminpivot_photo;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            //bureauadmin passport photo
            bureauadminChangePassPhoto(event){
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
                            this.bureauadminform.photo =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateBureauadminPassPhoto(organisationbureauadmin_photo){
                console.log(organisationbureauadmin_photo, 'edit')
                let img = this.bureauadminform.photo;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                        //  console.log('its reall null')
                      }else{
                          if(img.length>100){
                            return this.bureauadminform.photo;
                        }else{
                            if(organisationbureauadmin_photo){
                                return "/assets/bureau/img/admins/passports/"+organisationbureauadmin_photo;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },
            bureauadminLoadIDFrontPhoto(bureauadminpivot_id_photo_front){
                if(bureauadminpivot_id_photo_front){
                    return "/assets/bureau/img/admins/IDs/front/"+bureauadminpivot_id_photo_front;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            bureauadminChangeIDFrontPhoto(event){
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
                            this.bureauadminform.id_photo_front =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateBureauadminIDFrontPhoto(bureauadminform_id_photo_front){
                let img = this.bureauadminform.id_photo_front;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.bureauadminform.id_photo_front;
                        }else{
                            if(bureauadminform_id_photo_front){
                                return "/assets/bureau/img/admins/IDs/front/"+bureauadminform_id_photo_front;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },
            bureauadminLoadIDBackPhoto(bureauadminform_id_photo_back){
                if(bureauadminform_id_photo_back){
                    return "/assets/bureau/img/admins/IDs/back/"+bureauadminform_id_photo_back;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            bureauadminChangeIDBackPhoto(event){
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
                            this.bureauadminform.id_photo_back =event.target.result
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateBureauadminIDBackPhoto(bureauadminform_id_photo_back){
                let img = this.bureauadminform.id_photo_back;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.bureauadminform.id_photo_back;
                        }else{
                            if(bureauadminform_id_photo_back){
                                return "/assets/bureau/img/admins/IDs/back/"+bureauadminform_id_photo_back;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },

            editBureauadminModal(id){
                 this.editmodeBureauadmin = true;
                 this.bureauadminform.reset()
                    this.$Progress.start();
                      axios.get('/api/bureauadmin/edit/'+id)
                        .then((response)=>{
                           $('#BureauadminModal').modal('show')
                           toast({
                            type: 'success',
                            title: 'Fetched the Bureauadmin data successfully'
                            })
                            console.log(response.data.admin)
                            this.bureauadminform.fill(response.data.admin)
                            this.bureauadminform.user_id = response.data.admin.bureauadmins[0].pivot.user_id
                            this.bureauadminform.organisation_id = response.data.admin.bureauadmins[0].pivot.organisation_id
                            this.bureauadminform.position_id = response.data.admin.bureauadmins[0].pivot.position_id
                            this.bureauadminform.gender_id = response.data.admin.bureauadmins[0].pivot.gender_id
                            this.bureauadminform.photo = response.data.admin.bureauadmins[0].pivot.photo
                            this.bureauadminform.id_no = response.data.admin.bureauadmins[0].pivot.id_no
                            this.bureauadminform.id_photo_front = response.data.admin.bureauadmins[0].pivot.id_photo_front
                            this.bureauadminform.id_photo_back = response.data.admin.bureauadmins[0].pivot.id_photo_back
                            this.bureauadminform.phone = response.data.admin.bureauadmins[0].pivot.phone
                            this.bureauadminform.landline = response.data.admin.bureauadmins[0].pivot.landline
                            this.bureauadminform.address = response.data.admin.bureauadmins[0].pivot.address

                            this.bureauadminform.country_id = response.data.admin.bureauadmins[0].pivot.country_id
                            //get county id using the country id
                            this.bureauadminform.county_id = response.data.admin.bureauadmins[0].pivot.county_id
                            this.$store.dispatch('countrycounties', response.data.admin.bureauadmins[0].pivot.country_id);
                            //get contituency using county id
                            this.bureauadminform.constituency_id = response.data.admin.bureauadmins[0].pivot.constituency_id
                            this.$store.dispatch('countyconstituencies', response.data.admin.bureauadmins[0].pivot.county_id);
                            // //get ward usng constituency id
                            this.bureauadminform.ward_id = response.data.admin.bureauadmins[0].pivot.ward_id
                            this.$store.dispatch('constituencywards', response.data.admin.bureauadmins[0].pivot.constituency_id);
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                            //errors
                            $('#BureauadminModal').modal('show');
                            toast({
                            type: 'error',
                            title: 'There was something Wrong'
                            })
                        })
            },
            addBureauadmin() {
                this.bureauadminform.user_type = "Organisation Bureauadmin";
                this.$Progress.start();
                this.bureauadminform.patch('/api/bureauadmin')
                    .then((response)=>{
                        //  console.log(response.data)
                         toast({
                            type: 'success',
                            title: 'Bureauadmin Created successfully'
                            })
                            this.loadBureauadmins();
                            this.bureauadminform.reset()
                            $('#BureauadminModal').modal('hide')
                              this.$Progress.finish()
                    })
                    .catch((response)=>{
                        this.$Progress.fail()
                        //errors
                        console.log(response,'response')
                            $('#BureauadminModal').modal('show');
                            toast({
                                type: 'error',
                                title: 'There was something wrong.'
                                })
                    })
            },
            updateBureauadmin(id){
                  console.log('update bureauadmin')
                  this.$Progress.start();
                     this.bureauadminform.patch('/api/bureauadmin/update/'+id)
                        .then(()=>{
                            this.loadBureauadmins();
                         $('#BureauadminModal').modal('hide')
                         toast({
                            type: 'success',
                            title: 'Bureauadmin Created successfully'
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
            deleteBureauadmin(id){
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
                    //  console.log('delete bureauadmin', id)
                        this.$Progress.start();
                        this.bureauadminform.get('/api/bureauadmin/delete/'+id)
                            .then(()=>{
                            toast({
                            type: 'success',
                            title: 'Bureauadmin Deleted successfully'
                            })
                            this.loadBureauadmins();
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




