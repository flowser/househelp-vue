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
                  <tr v-for="(househelp, index) in Househelps" :key="househelp.id">
                    <td >{{index+1}}</td>
                    <td style="width: 500px;">
                        <div class="row" style="width:100%" v-for="bureau in househelp.bureauhousehelps" :key="bureau.id">
                            <div class="col-sm-3" style="padding: 3px;">
                                 <img class="card-img-top" :src="househelpLoadPassPhoto(bureau.pivot.photo)" style="width:100%" alt="Card image cap">
                            </div>
                            <div class="col-sm-3" style="padding: 3px;">
                                <!-- idstatus_id_number: null -->
                                <!-- idstatus_id_photo_back: null -->
                                <!-- idstatus_id_photo_front: null -->
                                <!-- idstatus_reason: "lost but applied" -->
                                <!-- idstatus_ref_number: "3556208185" -->
                                <!-- idstatus_status: "no" -->
                                <!-- idstatus_waiting_card_photo: "0177250569e5952679c41c39208d1320.jpg" -->
                                <div v-if="bureau.idstatus_id_photo_front">
                                    <img class="card-img-top" :src="househelpLoadIDFrontPhoto(bureau.idstatus_id_photo_front)" style="width:100%" alt="Card image cap"><br>
                                    <img class="card-img-top" :src="househelpLoadIDBackPhoto(bureau.idstatus_id_photo_back)" style="width:100%" alt="Card image cap">
                                </div>
                                <div v-if="bureau.idstatus_waiting_card_photo">
                                     <img class="card-img-top" :src="househelpLoadWaitingCardPhoto(bureau.idstatus_waiting_card_photo)" style="width:100%" alt="Card image cap">
                                </div>
                            </div>
                            <div class="col-sm-6" style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                <div>{{househelp.full_name}},</div>
                                <div v-for="position in househelp.positions" :key="position.id">
                                    {{position.name}},
                                    <span style="color:#9a009a;">
                                        {{bureau.name}},
                                    </span>
                                </div>
                                <div> ID: ,<span style="color:#9a009a;">{{bureau.pivot.id_no}}</span>,
                                    Phone: <span style="color:#9a009a;">{{bureau.pivot.phone}},</span>
                                </div>
                                <div>
                                     Mail: <span style="color:#9a009a;">{{househelp.email}},</span>
                                </div>
                                    <div>P. O. Box , <span style="color:#9a009a;">{{bureau.pivot.address}}</span>,
                                    </div>
                                <div v-for="ward in househelp.wards" :key="ward.id">
                                    <span style="color:#9a009a;">{{ward.name}}</span> ward,
                                    <span v-for="constituency in househelp.constituencies" :key="constituency.id" style="color:#9a009a;">
                                        {{constituency.name}}</span> constituency,
                                </div>
                                <div v-for="county in househelp.counties" :key="county.id" >
                                    <span style="color:#9a009a;">{{county.name}}</span> county,
                                    <span v-for="country in househelp.countries" :key="country.id" style="color:#9a009a;">
                                        {{country.name}},
                                    </span>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td style="padding: 3px;">
                        <span v-for="role in househelp.roles" :key="role.id" class="pl-2">
                            <div class="btn btn-primary btn-sm ml-1 mb-2 " >{{role.name}} </div>
                        </span>
                    </td>
                    <td style="padding: 3px;">
                        <span v-for="permission in househelp.permissions" :key="permission.id" class="pl-2">
                            <div class="btn btn-primary btn-sm ml-1 mb-2 ">{{permission.name}} </div>
                        </span>
                    </td>
                    <td style="padding: 3px;" >
                        <div class="clearfix" style="font-weight:bold;font-size:0.7em;">
                            <span class="float-left" style="margin-bottom:-0.5em" >
                                <div style="margin-bottom:0.25em"> Updated at:
                                    <span style="color:#9a009a;">{{househelp.created_at | dateformat}} </span>
                                </div>
                            </span>
                            <span class="float-right">
                                <a href=""  @click.prevent="editHousehelpModal(househelp.id)">
                                    <i class="fa fa-edit blue"></i>
                                </a>
                                /
                                <a href=""  @click.prevent="deleteHousehelp(househelp.id)">
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
                                            <label for="first_name" class="col-form-label"> Househelp First Name</label>
                                            <input v-model="househelpform.first_name" type="text" name="first_name" placeholder="Househelp First Name"
                                                class="form-control" :class="{ 'is-invalid': househelpform.errors.has('first_name') }" >
                                            <has-error style="color: #e83e8c" :form="househelpform" field="first_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="last_name" class=" col-form-label">househelp_Last Name </label>
                                            <input v-model="househelpform.last_name" type="househelp_last_name" name="last_name" placeholder="Househelp Last Name"
                                                class="form-control" :class="{ 'is-invalid': househelpform.errors.has('last_name') }" >
                                            <has-error style="color: #e83e8c" :form="househelpform" field="last_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="email" class=" col-form-label">Email </label>
                                            <input v-model="househelpform.email" type="email" name="email" placeholder="Email Address"
                                                class="form-control" :class="{ 'is-invalid': househelpform.errors.has('email') }" >
                                            <has-error style="color: #e83e8c" :form="househelpform" field="email"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <input v-model="househelpform.password" type="password" id="password" placeholder="Password"
                                                class="form-control" :class="{ 'is-invalid': househelpform.errors.has('password') }">
                                            <has-error :form="househelpform" field="password"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="phone" class="col-form-label"> Househelp Phone</label>
                                                <div>
                                                    <vue-tel-input v-model="househelpform.phone" name="phone" @onInput="InputPhone"
                                                    class="form-control" :class="{ 'is-invalid': househelpform.errors.has('phone') }">
                                                    </vue-tel-input>
                                                    <has-error style="color: #e83e8c" :form="househelpform" field="phone"></has-error>
                                                </div>
                                                <div v-if="househelpform.phone" style="color: #e83e8c">
                                                    <span>Is valid: <strong>{{phone.isValid}}</strong>,&nbsp;</span>
                                                    <span>Country: <strong>{{phone.country}}</strong></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="landline" class=" col-form-label">Landline</label>
                                                <vue-tel-input v-model="househelpform.landline" name="landline" @onInput="InputLandline"
                                                    class="form-control" :class="{ 'is-invalid': househelpform.errors.has('landline') }">
                                                </vue-tel-input>
                                                <has-error style="color: #e83e8c" :form="househelpform" field="landline"></has-error>

                                                <div v-if="househelpform.landline" style="color: #e83e8c">
                                                    <span>Is valid: <strong>{{landline.isValid}}</strong>,&nbsp;</span>
                                                    <span>Country: <strong>{{landline.country}}</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <label for="id_no" class="col-form-label">ID no.</label>
                                            <input v-model="househelpform.id_no" type="text" name="id_no" placeholder="ID NO"
                                                class="form-control" :class="{ 'is-invalid': househelpform.errors.has('id_no') }" >
                                            <has-error style="color: #e83e8c" :form="househelpform" field="id_no"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="address" class=" col-form-label">Address</label>
                                            <input v-model="househelpform.address" type="text" name="address" placeholder="Address"
                                                class="form-control" :class="{ 'is-invalid': househelpform.errors.has('address') }" >
                                            <has-error style="color: #e83e8c" :form="househelpform" field="country_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="gender_id">Select Gender</label>
                                            <select class="form-control" v-model="househelpform.gender_id"
                                                    :class="{ 'is-invalid':househelpform.errors.has('gender_id') }">
                                                    <option disabled value="">Select gender</option>
                                                    <option v-for="gender in Genders" :value="gender.id" :key="gender.id">{{gender.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="househelpform" field="gender_id"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-3">
                                            <label for="country_id">Select Country</label>
                                            <select class="form-control" @change="countryCounties(househelpform.country_id)"
                                            v-model="househelpform.country_id" :class="{ 'is-invalid': househelpform.errors.has('country_id') }">
                                                    <option disabled value="">Select Country</option>{{househelpform.country_id}}
                                                    <option v-for="country in Countries" :value="country.id" :key="country.id">{{country.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="househelpform" field="country_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="county_id" class=" col-form-label">County</label>
                                            <select class="form-control" @change="countyConstituencies(househelpform.county_id)"
                                            v-model="househelpform.county_id" :class="{ 'is-invalid': househelpform.errors.has('county_id') }">
                                                    <option disabled value="">Select County</option>
                                                    <option v-for="county in Counties" :value="county.id" :key="county.id">{{county.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="househelpform" field="county_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="constituency_id" class=" col-form-label">Constituency</label>
                                            <select class="form-control" @change="constituencyWards(househelpform.constituency_id)"
                                            v-model="househelpform.constituency_id" :class="{ 'is-invalid': househelpform.errors.has('constituency_id') }">
                                                    <option disabled value="">Select County</option>
                                                    <option v-for="constituency in Constituencies" :value="constituency.id" :key="constituency.id">{{constituency.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="househelpform" field="constituency_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="ward_id" class="col-form-label"> Ward </label>
                                            <select class="form-control"
                                            v-model="househelpform.ward_id" :class="{ 'is-invalid': househelpform.errors.has('ward_id') }">
                                                    <option disabled value="">Select Ward</option>
                                                    <option v-for="ward in Wards" :value="ward.id" :key="ward.id">{{ward.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="househelpform" field="ward_id"></has-error>
                                        </div>

                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <label for="photo" class=" col-form-label">Househelp PassPort Image</label><br>
                                                <input @change="househelpChangePassPhoto($event)" type="file" name="photo"
                                                    :class="{ 'is-invalid': househelpform.errors.has('photo') }">
                                                    <img v-show="editmodeHousehelp" :src="updateHousehelpPassPhoto(househelpform.photo)" alt="" width="100%" >
                                                    <img  v-show="!editmodeHousehelp" :src="househelpform.photo" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="househelpform" field="photo"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="id_photo_front" class=" col-form-label">Househelp FrontSide ID Photo</label><br>
                                                <input @change="househelpChangeIDFrontPhoto($event)" type="file" name="id_photo_front"
                                                    :class="{ 'is-invalid': househelpform.errors.has('id_photo_front') }">
                                                    <img v-show="editmodeHousehelp" :src="updateHousehelpIDFrontPhoto(househelpform.id_photo_front)" alt="" width="100%" >
                                                    <img  v-show="!editmodeHousehelp" :src="househelpform.id_photo_front" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="househelpform" field="id_photo_front"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="backside_i_photod" class=" col-form-label">BackSide ID Photo</label><br>
                                                <input @change="househelpChangeIDBackPhoto($event)" type="file" name="id_photo_back"
                                                    :class="{ 'is-invalid': househelpform.errors.has('backside_id') }">
                                                    <img v-show="editmodeHousehelp" :src="updateHousehelpIDBackPhoto(househelpform.id_photo_back)" alt="" width="100%" >
                                                    <img  v-show="!editmodeHousehelp" :src="househelpform.id_photo_back" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="househelpform" field="id_photo_back"></has-error>
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
                househelpform: new Form({
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
                 //househelp
                phone:{
                        isValid: false,
                        country: undefined,
                },
                landline:{
                        isValid: false,
                        country: undefined,
                },
                url:'/api/househelp/bureau/get',
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
            Househelps(){
                return this.$store.getters.HousehelpsList
            },
        },
        methods:{
             loadHousehelps(){
                this.$Progress.start();
                return this.$store.dispatch( "househelpsbureaulist", this.url)
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
                            console.log(response.data.househelp)
                            this.househelpform.fill(response.data.househelp)
                            this.househelpform.user_id = response.data.househelp.bureauhousehelps.pivot.user_id
                            this.househelpform.organisation_id = response.data.househelp.bureauhousehelps.pivot.organisation_id
                            this.househelpform.gender_id = response.data.househelp.bureauhousehelps.pivot.gender_id
                            this.househelpform.photo = response.data.househelp.bureauhousehelps.pivot.photo
                            this.househelpform.id_no = response.data.househelp.bureauhousehelps.pivot.id_no
                            this.househelpform.id_photo_front = response.data.househelp.bureauhousehelps.pivot.id_photo_front
                            this.househelpform.id_photo_back = response.data.househelp.bureauhousehelps.pivot.id_photo_back
                            this.househelpform.phone = response.data.househelp.bureauhousehelps.pivot.phone
                            this.househelpform.address = response.data.househelp.bureauhousehelps.pivot.address

                            this.househelpform.country_id = response.data.househelp.bureauhousehelps.pivot.country_id
                            //get county id using the country id
                            this.househelpform.county_id = response.data.househelp.bureauhousehelps.pivot.county_id
                            this.$store.dispatch('countrycounties', response.data.househelp.bureauhousehelps.pivot.country_id);
                            //get contituency using county id
                            this.househelpform.constituency_id = response.data.househelp.bureauhousehelps.pivot.constituency_id
                            this.$store.dispatch('countyconstituencies', response.data.househelp.bureauhousehelps.pivot.county_id);
                            // //get ward usng constituency id
                            this.househelpform.ward_id = response.data.househelp.bureauhousehelps.pivot.ward_id
                            this.$store.dispatch('constituencywards', response.data.househelp.bureauhousehelps.pivot.constituency_id);
                            this.$Progress.finish();
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
                this.househelpform.user_type = "Househelp";
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
                     this.househelpform.patch('/api/househelp/update/'+id)
                        .then(()=>{
                            this.loadHousehelps();
                         $('#HousehelpModal').modal('hide')
                         toast({
                            type: 'success',
                            title: 'Househelp Created successfully'
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






