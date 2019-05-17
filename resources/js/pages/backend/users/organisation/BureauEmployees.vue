<template>
<div class="content-wrapper">
  <div class="container-fluid mt-5">
      <!-- Main content -->
    <section class="content">
      <div class="row justify-content-around">
        <div class="col-md">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Bureauemployees Table</h3>
              <div class="card-tools">
                    <button class="btn btn-success"  @click.prevent="newBureauemployeeModal()">Add New Bureauemployee
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
                    <th>Bureauemployee Details</th>
                    <th>Roles</th>
                    <th>Permissions</th>
                    <th style="padding-left: 14px">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(bureauemployee, index) in Bureauemployees" :key="bureauemployee.id">
                    <td >{{index+1}}</td>
                    <td style="width: 500px;">
                        <div class="row" style="width:100%" v-for="bureau in bureauemployee.bureauemployees" :key="bureau.id">
                            <div class="col-sm-3" style="padding: 3px;">
                                 <img class="card-img-top" :src="bureauemployeeLoadPassPhoto(bureau.pivot.photo)" style="width:100%" alt="Card image cap">
                            </div>
                            <div class="col-sm-3" style="padding: 3px;">
                                <img class="card-img-top" :src="bureauemployeeLoadIDFrontPhoto(bureau.pivot.id_photo_front)" style="width:100%" alt="Card image cap"><br>
                                <img class="card-img-top" :src="bureauemployeeLoadIDBackPhoto(bureau.pivot.id_photo_back)" style="width:100%" alt="Card image cap">
                            </div>
                            <div class="col-sm-6" style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                <div>{{bureauemployee.full_name}},</div>
                                <div v-for="position in bureauemployee.positions" :key="position.id">
                                    {{position.name}},
                                    <span style="color:#9a009a;">
                                        {{bureau.name}},
                                    </span>
                                </div>
                                <div> ID: ,<span style="color:#9a009a;">{{bureau.pivot.id_no}}</span>,
                                    Phone: <span style="color:#9a009a;">{{bureau.pivot.phone}},</span>
                                </div>
                                <div>
                                     Mail: <span style="color:#9a009a;">{{bureauemployee.email}},</span>
                                </div>
                                    <div>P. O. Box , <span style="color:#9a009a;">{{bureau.pivot.address}}</span>,
                                    </div>
                                <div v-for="ward in bureauemployee.wards" :key="ward.id">
                                    <span style="color:#9a009a;">{{ward.name}}</span> ward,
                                    <span v-for="constituency in bureauemployee.constituencies" :key="constituency.id" style="color:#9a009a;">
                                        {{constituency.name}}</span> constituency,
                                </div>
                                <div v-for="county in bureauemployee.counties" :key="county.id" >
                                    <span style="color:#9a009a;">{{county.name}}</span> county,
                                    <span v-for="country in bureauemployee.countries" :key="country.id" style="color:#9a009a;">
                                        {{country.name}},
                                    </span>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td style="padding: 3px;">
                        <span v-for="role in bureauemployee.roles" :key="role.id" class="pl-2">
                            <div class="btn btn-primary btn-sm ml-1 mb-2 " >{{role.name}} </div>
                        </span>
                    </td>
                    <td style="padding: 3px;">
                        <span v-for="permission in bureauemployee.permissions" :key="permission.id" class="pl-2">
                            <div class="btn btn-primary btn-sm ml-1 mb-2 ">{{permission.name}} </div>
                        </span>
                    </td>
                    <td style="padding: 3px;" >
                        <div class="clearfix" style="font-weight:bold;font-size:0.7em;">
                            <span class="float-left" style="margin-bottom:-0.5em" >
                                <div style="margin-bottom:0.25em"> Updated at:
                                    <span style="color:#9a009a;">{{bureauemployee.created_at | dateformat}} </span>
                                </div>
                            </span>
                            <span class="float-right">
                                <a href=""  @click.prevent="editBureauemployeeModal(bureauemployee.id)">
                                    <i class="fa fa-edit blue"></i>
                                </a>
                                /
                                <a href=""  @click.prevent="deleteBureauemployee(bureauemployee.id)">
                                    <i class="fa fa-trash red"></i>
                                </a>
                            </span>
                        </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div v-if="Bureauemployees.length" >
                <div class="clearfix" style="font-weight:bold;font-size:0.7em;">
                        <span class="float-left" style="margin-bottom:-0.5em" >
                            <div style="margin-bottom:0.25em">
                                Between <span style="color:#9a009a;"> {{pagination.from}} </span>
                                & <span style="color:#9a009a;"> {{pagination.to}} </span>
                                out of <span style="color:#9a009a;"> {{pagination.total}} </span> Bureauemployees
                            </div>
                            <button class="btn btn-info" v-on:click="fetchPaginatedBureauemployees(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">Prev</button>
                        </span>
                        <span class="float-right" style="margin-bottom:-0.5em" >
                            <div style="margin-bottom:0.25em">
                                Page <span style="color:#9a009a;"> {{pagination.current_page}} </span>
                                of <span style="color:#9a009a;"> {{pagination.last_page}} </span>
                            </div>
                            <button class="btn btn-info" v-on:click="fetchPaginatedBureauemployees(pagination.next_page_url)" :disabled="!pagination.next_page_url">Next</button>
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
        <div class="modal fade " id="BureauemployeeModal" tabindex="-1" role="dialog" aria-labelledby="BureauemployeeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form role="form" @submit.prevent="editmodeBureauemployee ? updateBureauemployee(bureauemployeeform.id) : addBureauemployee()" >
                        <div class="modal-body">
                            <h5 class="modal-title" v-show="editmodeBureauemployee" id="BureauemployeeModalLabel">Update Bureauemployee</h5>
                            <h5 class="modal-title" v-show="!editmodeBureauemployee" id="BureauemployeeModalLabel">Add New Bureauemployee</h5>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="first_name" class="col-form-label"> Bureauemployee First Name</label>
                                            <input v-model="bureauemployeeform.first_name" type="text" name="first_name" placeholder="Bureauemployee First Name"
                                                class="form-control" :class="{ 'is-invalid': bureauemployeeform.errors.has('first_name') }" >
                                            <has-error style="color: #e83e8c" :form="bureauemployeeform" field="first_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="last_name" class=" col-form-label">bureauemployee_Last Name </label>
                                            <input v-model="bureauemployeeform.last_name" type="bureauemployee_last_name" name="last_name" placeholder="Bureauemployee Last Name"
                                                class="form-control" :class="{ 'is-invalid': bureauemployeeform.errors.has('last_name') }" >
                                            <has-error style="color: #e83e8c" :form="bureauemployeeform" field="last_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="email" class=" col-form-label">Email </label>
                                            <input v-model="bureauemployeeform.email" type="email" name="email" placeholder="Email Address"
                                                class="form-control" :class="{ 'is-invalid': bureauemployeeform.errors.has('email') }" >
                                            <has-error style="color: #e83e8c" :form="bureauemployeeform" field="email"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <input v-model="bureauemployeeform.password" type="password" id="password" placeholder="Password"
                                                class="form-control" :class="{ 'is-invalid': bureauemployeeform.errors.has('password') }">
                                            <has-error :form="bureauemployeeform" field="password"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="phone" class="col-form-label"> Bureauemployee Phone</label>
                                                <div>
                                                    <vue-tel-input v-model="bureauemployeeform.phone" name="phone" @onInput="InputPhone"
                                                    class="form-control" :class="{ 'is-invalid': bureauemployeeform.errors.has('phone') }">
                                                    </vue-tel-input>
                                                    <has-error style="color: #e83e8c" :form="bureauemployeeform" field="phone"></has-error>
                                                </div>
                                                <div v-if="bureauemployeeform.phone" style="color: #e83e8c">
                                                    <span>Is valid: <strong>{{phone.isValid}}</strong>,&nbsp;</span>
                                                    <span>Country: <strong>{{phone.country}}</strong></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="landline" class=" col-form-label">Landline</label>
                                                <vue-tel-input v-model="bureauemployeeform.landline" name="landline" @onInput="InputLandline"
                                                    class="form-control" :class="{ 'is-invalid': bureauemployeeform.errors.has('landline') }">
                                                </vue-tel-input>
                                                <has-error style="color: #e83e8c" :form="bureauemployeeform" field="landline"></has-error>

                                                <div v-if="bureauemployeeform.landline" style="color: #e83e8c">
                                                    <span>Is valid: <strong>{{landline.isValid}}</strong>,&nbsp;</span>
                                                    <span>Country: <strong>{{landline.country}}</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <label for="id_no" class="col-form-label">ID no.</label>
                                            <input v-model="bureauemployeeform.id_no" type="text" name="id_no" placeholder="ID NO"
                                                class="form-control" :class="{ 'is-invalid': bureauemployeeform.errors.has('id_no') }" >
                                            <has-error style="color: #e83e8c" :form="bureauemployeeform" field="id_no"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="address" class=" col-form-label">Address</label>
                                            <input v-model="bureauemployeeform.address" type="text" name="address" placeholder="Address"
                                                class="form-control" :class="{ 'is-invalid': bureauemployeeform.errors.has('address') }" >
                                            <has-error style="color: #e83e8c" :form="bureauemployeeform" field="country_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="gender_id">Select Gender</label>
                                            <select class="form-control" v-model="bureauemployeeform.gender_id"
                                                    :class="{ 'is-invalid':bureauemployeeform.errors.has('gender_id') }">
                                                    <option disabled value="">Select gender</option>
                                                    <option v-for="gender in Genders" :value="gender.id" :key="gender.id">{{gender.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="bureauemployeeform" field="gender_id"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-3">
                                            <label for="country_id">Select Country</label>
                                            <select class="form-control" @change="countryCounties(bureauemployeeform.country_id)"
                                            v-model="bureauemployeeform.country_id" :class="{ 'is-invalid': bureauemployeeform.errors.has('country_id') }">
                                                    <option disabled value="">Select Country</option>{{bureauemployeeform.country_id}}
                                                    <option v-for="country in Countries" :value="country.id" :key="country.id">{{country.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="bureauemployeeform" field="country_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="county_id" class=" col-form-label">County</label>
                                            <select class="form-control" @change="countyConstituencies(bureauemployeeform.county_id)"
                                            v-model="bureauemployeeform.county_id" :class="{ 'is-invalid': bureauemployeeform.errors.has('county_id') }">
                                                    <option disabled value="">Select County</option>
                                                    <option v-for="county in Counties" :value="county.id" :key="county.id">{{county.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="bureauemployeeform" field="county_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="constituency_id" class=" col-form-label">Constituency</label>
                                            <select class="form-control" @change="constituencyWards(bureauemployeeform.constituency_id)"
                                            v-model="bureauemployeeform.constituency_id" :class="{ 'is-invalid': bureauemployeeform.errors.has('constituency_id') }">
                                                    <option disabled value="">Select County</option>
                                                    <option v-for="constituency in Constituencies" :value="constituency.id" :key="constituency.id">{{constituency.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="bureauemployeeform" field="constituency_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="ward_id" class="col-form-label"> Ward </label>
                                            <select class="form-control"
                                            v-model="bureauemployeeform.ward_id" :class="{ 'is-invalid': bureauemployeeform.errors.has('ward_id') }">
                                                    <option disabled value="">Select Ward</option>
                                                    <option v-for="ward in Wards" :value="ward.id" :key="ward.id">{{ward.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="bureauemployeeform" field="ward_id"></has-error>
                                        </div>

                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <label for="photo" class=" col-form-label">Bureauemployee PassPort Image</label><br>
                                                <input @change="bureauemployeeChangePassPhoto($event)" type="file" name="photo"
                                                    :class="{ 'is-invalid': bureauemployeeform.errors.has('photo') }">
                                                    <img v-show="editmodeBureauemployee" :src="updateBureauemployeePassPhoto(bureauemployeeform.photo)" alt="" width="100%" >
                                                    <img  v-show="!editmodeBureauemployee" :src="bureauemployeeform.photo" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="bureauemployeeform" field="photo"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="id_photo_front" class=" col-form-label">Bureauemployee FrontSide ID Photo</label><br>
                                                <input @change="bureauemployeeChangeIDFrontPhoto($event)" type="file" name="id_photo_front"
                                                    :class="{ 'is-invalid': bureauemployeeform.errors.has('id_photo_front') }">
                                                    <img v-show="editmodeBureauemployee" :src="updateBureauemployeeIDFrontPhoto(bureauemployeeform.id_photo_front)" alt="" width="100%" >
                                                    <img  v-show="!editmodeBureauemployee" :src="bureauemployeeform.id_photo_front" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="bureauemployeeform" field="id_photo_front"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="backside_i_photod" class=" col-form-label">BackSide ID Photo</label><br>
                                                <input @change="bureauemployeeChangeIDBackPhoto($event)" type="file" name="id_photo_back"
                                                    :class="{ 'is-invalid': bureauemployeeform.errors.has('backside_id') }">
                                                    <img v-show="editmodeBureauemployee" :src="updateBureauemployeeIDBackPhoto(bureauemployeeform.id_photo_back)" alt="" width="100%" >
                                                    <img  v-show="!editmodeBureauemployee" :src="bureauemployeeform.id_photo_back" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="bureauemployeeform" field="id_photo_back"></has-error>
                                        </div>
                                    </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editmodeBureauemployee" type="submit" class="btn btn-success">Update</button>
                            <button v-show="!editmodeBureauemployee" type="submit" class="btn btn-primary">Create</button>
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
        name:"Organisation-Bureauemployees",
        data(){
            return{
                newBureauemployee: false,
                editmodeBureauemployee: false,
                bureauemployeeform: new Form({
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
                 //bureauemployee
                phone:{
                        isValid: false,
                        country: undefined,
                },
                landline:{
                        isValid: false,
                        country: undefined,
                },
                 url:'/api/bureauemployee/get/list',
                pagination:[],
            }
        },
        mounted() {
            this.loadCountries();
            this.loadCounties();
            this.loadConstituencies();
            this.loadWards();
            this.loadGenders();
            this.loadBureauemployees();
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
            Bureauemployees(){
                return this.$store.getters.BureauEmployeesList
            },

        },
        methods:{
            //bureauemployee
            InputPhone({ number, isValid, country }) {
            this.bureauemployeeform.phone = number;
            this.phone.isValid = isValid;
            this.phone.country = country && country.name;
            },
            InputLandline({ number, isValid, country }) {
            this.bureauemployeeform.landline = number;
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
            loadBureauemployees(){
               this.$Progress.start();
                return this.$store.dispatch( "bureauemployeeslist", this.url)
                 .then((response)=>{
                     this.makingPagination(response.data.employees),
                    toast({
                     type: 'success',
                     title: 'Fetched the Bureauemployee data successfully'
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
            fetchPaginatedBureauemployees(url){
                this.url = url;
                this.loadBureauemployees();
            },
            newBureauemployeeModal(){
                 this.editmodeBureauemployee= false;
                 this.bureauemployeeform.reset()
                     $('#BureauemployeeModal').modal('show')
            },
            bureauemployeeLoadPassPhoto(bureauemployeepivot_photo){
                if(bureauemployeepivot_photo){
                    return "/assets/bureau/img/employees/passports/"+bureauemployeepivot_photo;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            //bureauemployee passport photo
            bureauemployeeChangePassPhoto(event){
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
                            this.bureauemployeeform.photo =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateBureauemployeePassPhoto(organisationbureauemployee_photo){
                console.log(organisationbureauemployee_photo, 'edit')
                let img = this.bureauemployeeform.photo;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                        //  console.log('its reall null')
                      }else{
                          if(img.length>100){
                            return this.bureauemployeeform.photo;
                        }else{
                            if(organisationbureauemployee_photo){
                                return "/assets/bureau/img/employees/passports/"+organisationbureauemployee_photo;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },
            bureauemployeeLoadIDFrontPhoto(bureauemployeepivot_id_photo_front){
                if(bureauemployeepivot_id_photo_front){
                    return "/assets/bureau/img/employees/IDs/front/"+bureauemployeepivot_id_photo_front;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            bureauemployeeChangeIDFrontPhoto(event){
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
                            this.bureauemployeeform.id_photo_front =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateBureauemployeeIDFrontPhoto(bureauemployeeform_id_photo_front){
                let img = this.bureauemployeeform.id_photo_front;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.bureauemployeeform.id_photo_front;
                        }else{
                            if(bureauemployeeform_id_photo_front){
                                return "/assets/bureau/img/employees/IDs/front/"+bureauemployeeform_id_photo_front;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },
            bureauemployeeLoadIDBackPhoto(bureauemployeeform_id_photo_back){
                if(bureauemployeeform_id_photo_back){
                    return "/assets/bureau/img/employees/IDs/back/"+bureauemployeeform_id_photo_back;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            bureauemployeeChangeIDBackPhoto(event){
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
                            this.bureauemployeeform.id_photo_back =event.target.result
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateBureauemployeeIDBackPhoto(bureauemployeeform_id_photo_back){
                let img = this.bureauemployeeform.id_photo_back;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.bureauemployeeform.id_photo_back;
                        }else{
                            if(bureauemployeeform_id_photo_back){
                                return "/assets/bureau/img/employees/IDs/back/"+bureauemployeeform_id_photo_back;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },

            editBureauemployeeModal(id){
                 this.editmodeBureauemployee = true;
                 this.bureauemployeeform.reset()
                    this.$Progress.start();
                      axios.get('/api/bureauemployee/edit/'+id)
                        .then((response)=>{
                           $('#BureauemployeeModal').modal('show')
                           toast({
                            type: 'success',
                            title: 'Fetched the Bureauemployee data successfully'
                            })
                            console.log(response.data.employee)
                            this.bureauemployeeform.fill(response.data.employee)
                            this.bureauemployeeform.user_id = response.data.employee.bureauemployees[0].pivot.user_id
                            this.bureauemployeeform.organisation_id = response.data.employee.bureauemployees[0].pivot.organisation_id
                            this.bureauemployeeform.position_id = response.data.employee.bureauemployees[0].pivot.position_id
                            this.bureauemployeeform.gender_id = response.data.employee.bureauemployees[0].pivot.gender_id
                            this.bureauemployeeform.photo = response.data.employee.bureauemployees[0].pivot.photo
                            this.bureauemployeeform.id_no = response.data.employee.bureauemployees[0].pivot.id_no
                            this.bureauemployeeform.id_photo_front = response.data.employee.bureauemployees[0].pivot.id_photo_front
                            this.bureauemployeeform.id_photo_back = response.data.employee.bureauemployees[0].pivot.id_photo_back
                            this.bureauemployeeform.phone = response.data.employee.bureauemployees[0].pivot.phone
                            this.bureauemployeeform.landline = response.data.employee.bureauemployees[0].pivot.landline
                            this.bureauemployeeform.address = response.data.employee.bureauemployees[0].pivot.address

                            this.bureauemployeeform.country_id = response.data.employee.bureauemployees[0].pivot.country_id
                            //get county id using the country id
                            this.bureauemployeeform.county_id = response.data.employee.bureauemployees[0].pivot.county_id
                            this.$store.dispatch('countrycounties', response.data.employee.bureauemployees[0].pivot.country_id);
                            //get contituency using county id
                            this.bureauemployeeform.constituency_id = response.data.employee.bureauemployees[0].pivot.constituency_id
                            this.$store.dispatch('countyconstituencies', response.data.employee.bureauemployees[0].pivot.county_id);
                            // //get ward usng constituency id
                            this.bureauemployeeform.ward_id = response.data.employee.bureauemployees[0].pivot.ward_id
                            this.$store.dispatch('constituencywards', response.data.employee.bureauemployees[0].pivot.constituency_id);
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                            //errors
                            $('#BureauemployeeModal').modal('show');
                            toast({
                            type: 'error',
                            title: 'There was something Wrong'
                            })
                        })
            },
            addBureauemployee() {
                this.bureauemployeeform.user_type = "Organisation Bureauemployee";
                this.$Progress.start();
                this.bureauemployeeform.patch('/api/bureauemployee')
                    .then((response)=>{
                        //  console.log(response.data)
                         toast({
                            type: 'success',
                            title: 'Bureauemployee Created successfully'
                            })
                            this.loadBureauemployees();
                            this.bureauemployeeform.reset()
                            $('#BureauemployeeModal').modal('hide')
                              this.$Progress.finish()
                    })
                    .catch((response)=>{
                        this.$Progress.fail()
                        //errors
                        console.log(response,'response')
                            $('#BureauemployeeModal').modal('show');
                            toast({
                                type: 'error',
                                title: 'There was something wrong.'
                                })
                    })
            },
            updateBureauemployee(id){
                  console.log('update bureauemployee')
                  this.$Progress.start();
                     this.bureauemployeeform.patch('/api/bureauemployee/update/'+id)
                        .then(()=>{
                            this.loadBureauemployees();
                         $('#BureauemployeeModal').modal('hide')
                         toast({
                            type: 'success',
                            title: 'Bureauemployee Created successfully'
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
            deleteBureauemployee(id){
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
                    //  console.log('delete bureauemployee', id)
                        this.$Progress.start();
                        this.bureauemployeeform.get('/api/bureauemployee/delete/'+id)
                            .then(()=>{
                            toast({
                            type: 'success',
                            title: 'Bureauemployee Deleted successfully'
                            })
                            this.loadBureauemployees();
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





