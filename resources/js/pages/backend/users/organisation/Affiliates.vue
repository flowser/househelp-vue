<template>
<div class="content-wrapper">
  <div class="container-fluid mt-5">
      <!-- Main content -->
    <section class="content">
      <div class="row justify-content-around">
        <div class="col-md">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Affiliates Table</h3>
              <div class="card-tools">
                    <button class="btn btn-success"  @click.prevent="newAffiliateModal()">Add New Affiliate
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
                    <th>Affiliate Details</th>
                    <th>Roles</th>
                    <th>Permissions</th>
                    <th style="padding-left: 14px">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(affiliate, index) in Affiliates" :key="affiliate.id">
                    <td >{{index+1}}</td>
                    <td style="width: 550px;">
                        <div class="row" style="width:100%" v-for="organisation in affiliate.organisationaffiliates" :key="organisation.id">
                            <div class="col-sm-3" style="padding: 3px;">
                                 <img class="card-img-top" :src="affiliateLoadPassPhoto(organisation.pivot.photo)" style="width:100%" alt="Card image cap">
                            </div>
                            <div class="col-sm-3" style="padding: 3px;">
                                <img class="card-img-top" :src="affiliateLoadIDFrontPhoto(organisation.pivot.id_photo_front)" style="width:100%" alt="Card image cap"><br>
                                <img class="card-img-top" :src="affiliateLoadIDBackPhoto(organisation.pivot.id_photo_back)" style="width:100%" alt="Card image cap">
                            </div>
                            <div class="col-sm-6" style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                <div>{{affiliate.full_name}},</div>
                                <div v-for="position in affiliate.positions" :key="position.id">
                                    {{position.name}},
                                    <span style="color:#9a009a;">
                                        {{organisation.name}},
                                    </span>
                                </div>
                                <div> ID: ,<span style="color:#9a009a;">{{organisation.pivot.id_no}}</span>,
                                    Phone: <span style="color:#9a009a;">{{organisation.pivot.phone}},</span>
                                </div>
                                <div>
                                     Mail: <span style="color:#9a009a;">{{affiliate.email}},</span>
                                </div>
                                    <div>P. O. Box , <span style="color:#9a009a;">{{organisation.pivot.address}}</span>,
                                    </div>
                                <div v-for="ward in affiliate.wards" :key="ward.id">
                                    <span style="color:#9a009a;">{{ward.name}}</span> ward,
                                    <span v-for="constituency in affiliate.constituencies" :key="constituency.id" style="color:#9a009a;">
                                        {{constituency.name}}</span> constituency,
                                </div>
                                <div v-for="county in affiliate.counties" :key="county.id" >
                                    <span style="color:#9a009a;">{{county.name}}</span> county,
                                    <span v-for="country in affiliate.countries" :key="country.id" style="color:#9a009a;">
                                        {{country.name}},
                                    </span>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td style="padding: 3px;">
                        <span v-for="role in affiliate.roles" :key="role.id" class="pl-2">
                            <div class="btn btn-primary btn-sm ml-1 mb-2 " >{{role.name}} </div>
                        </span>
                    </td>
                    <td style="padding: 3px;">
                        <span v-for="permission in affiliate.permissions" :key="permission.id" class="pl-2">
                            <div class="btn btn-primary btn-sm ml-1 mb-2 ">{{permission.name}} </div>
                        </span>
                    </td>
                    <td style="padding: 3px;" >
                        <div class="clearfix" style="font-weight:bold;font-size:0.7em;">
                            <span class="float-left" style="margin-bottom:-0.5em" >
                                <div style="margin-bottom:0.25em"> Updated at:
                                    <span style="color:#9a009a;">{{affiliate.created_at | dateformat}} </span>
                                </div>
                            </span>
                            <span class="float-right">
                                <a href=""  @click.prevent="editAffiliateModal(affiliate.id)">
                                    <i class="fa fa-edit blue"></i>
                                </a>
                                /
                                <a href=""  @click.prevent="deleteAffiliate(affiliate.id)">
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
        <div class="modal fade " id="AffiliateModal" tabindex="-1" role="dialog" aria-labelledby="AffiliateModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form role="form" @submit.prevent="editmodeAffiliate ? updateAffiliate(affiliateform.id) : addAffiliate()" >
                        <div class="modal-body">
                            <h5 class="modal-title" v-show="editmodeAffiliate" id="AffiliateModalLabel">Update Affiliate</h5>
                            <h5 class="modal-title" v-show="!editmodeAffiliate" id="AffiliateModalLabel">Add New Affiliate</h5>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="first_name" class="col-form-label"> Affiliate First Name</label>
                                            <input v-model="affiliateform.first_name" type="text" name="first_name" placeholder="Affiliate First Name"
                                                class="form-control" :class="{ 'is-invalid': affiliateform.errors.has('first_name') }" >
                                            <has-error style="color: #e83e8c" :form="affiliateform" field="first_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="last_name" class=" col-form-label">affiliate_Last Name </label>
                                            <input v-model="affiliateform.last_name" type="affiliate_last_name" name="last_name" placeholder="Affiliate Last Name"
                                                class="form-control" :class="{ 'is-invalid': affiliateform.errors.has('last_name') }" >
                                            <has-error style="color: #e83e8c" :form="affiliateform" field="last_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="email" class=" col-form-label">Email </label>
                                            <input v-model="affiliateform.email" type="email" name="email" placeholder="Email Address"
                                                class="form-control" :class="{ 'is-invalid': affiliateform.errors.has('email') }" >
                                            <has-error style="color: #e83e8c" :form="affiliateform" field="email"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <input v-model="affiliateform.password" type="password" id="password" placeholder="Password"
                                                class="form-control" :class="{ 'is-invalid': affiliateform.errors.has('password') }">
                                            <has-error :form="affiliateform" field="password"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="phone" class="col-form-label"> Affiliate Phone</label>
                                                <div>
                                                    <vue-tel-input v-model="affiliateform.phone" name="phone" @onInput="InputPhone"
                                                    class="form-control" :class="{ 'is-invalid': affiliateform.errors.has('phone') }">
                                                    </vue-tel-input>
                                                    <has-error style="color: #e83e8c" :form="affiliateform" field="phone"></has-error>
                                                </div>
                                                <div v-if="affiliateform.phone" style="color: #e83e8c">
                                                    <span>Is valid: <strong>{{phone.isValid}}</strong>,&nbsp;</span>
                                                    <span>Country: <strong>{{phone.country}}</strong></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="landline" class=" col-form-label">Landline</label>
                                                <vue-tel-input v-model="affiliateform.landline" name="landline" @onInput="InputLandline"
                                                    class="form-control" :class="{ 'is-invalid': affiliateform.errors.has('landline') }">
                                                </vue-tel-input>
                                                <has-error style="color: #e83e8c" :form="affiliateform" field="landline"></has-error>

                                                <div v-if="affiliateform.landline" style="color: #e83e8c">
                                                    <span>Is valid: <strong>{{landline.isValid}}</strong>,&nbsp;</span>
                                                    <span>Country: <strong>{{landline.country}}</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <label for="id_no" class="col-form-label">ID no.</label>
                                            <input v-model="affiliateform.id_no" type="text" name="id_no" placeholder="ID NO"
                                                class="form-control" :class="{ 'is-invalid': affiliateform.errors.has('id_no') }" >
                                            <has-error style="color: #e83e8c" :form="affiliateform" field="id_no"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="address" class=" col-form-label">Address</label>
                                            <input v-model="affiliateform.address" type="text" name="address" placeholder="Address"
                                                class="form-control" :class="{ 'is-invalid': affiliateform.errors.has('address') }" >
                                            <has-error style="color: #e83e8c" :form="affiliateform" field="country_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="gender_id">Select Gender</label>
                                            <select class="form-control" v-model="affiliateform.gender_id"
                                                    :class="{ 'is-invalid':affiliateform.errors.has('gender_id') }">
                                                    <option disabled value="">Select gender</option>
                                                    <option v-for="gender in Genders" :value="gender.id" :key="gender.id">{{gender.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="affiliateform" field="gender_id"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-3">
                                            <label for="country_id">Select Country</label>
                                            <select class="form-control" @change="countryCounties(affiliateform.country_id)"
                                            v-model="affiliateform.country_id" :class="{ 'is-invalid': affiliateform.errors.has('country_id') }">
                                                    <option disabled value="">Select Country</option>{{affiliateform.country_id}}
                                                    <option v-for="country in Countries" :value="country.id" :key="country.id">{{country.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="affiliateform" field="country_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="county_id" class=" col-form-label">County</label>
                                            <select class="form-control" @change="countyConstituencies(affiliateform.county_id)"
                                            v-model="affiliateform.county_id" :class="{ 'is-invalid': affiliateform.errors.has('county_id') }">
                                                    <option disabled value="">Select County</option>
                                                    <option v-for="county in Counties" :value="county.id" :key="county.id">{{county.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="affiliateform" field="county_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="constituency_id" class=" col-form-label">Constituency</label>
                                            <select class="form-control" @change="constituencyWards(affiliateform.constituency_id)"
                                            v-model="affiliateform.constituency_id" :class="{ 'is-invalid': affiliateform.errors.has('constituency_id') }">
                                                    <option disabled value="">Select County</option>
                                                    <option v-for="constituency in Constituencies" :value="constituency.id" :key="constituency.id">{{constituency.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="affiliateform" field="constituency_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="ward_id" class="col-form-label"> Ward </label>
                                            <select class="form-control"
                                            v-model="affiliateform.ward_id" :class="{ 'is-invalid': affiliateform.errors.has('ward_id') }">
                                                    <option disabled value="">Select Ward</option>
                                                    <option v-for="ward in Wards" :value="ward.id" :key="ward.id">{{ward.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="affiliateform" field="ward_id"></has-error>
                                        </div>

                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <label for="photo" class=" col-form-label">Affiliate PassPort Image</label><br>
                                                <input @change="affiliateChangePassPhoto($event)" type="file" name="photo"
                                                    :class="{ 'is-invalid': affiliateform.errors.has('photo') }">
                                                    <img v-show="editmodeAffiliate" :src="updateAffiliatePassPhoto(affiliateform.photo)" alt="" width="100%" >
                                                    <img  v-show="!editmodeAffiliate" :src="affiliateform.photo" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="affiliateform" field="photo"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="id_photo_front" class=" col-form-label">Affiliate FrontSide ID Photo</label><br>
                                                <input @change="affiliateChangeIDFrontPhoto($event)" type="file" name="id_photo_front"
                                                    :class="{ 'is-invalid': affiliateform.errors.has('id_photo_front') }">
                                                    <img v-show="editmodeAffiliate" :src="updateAffiliateIDFrontPhoto(affiliateform.id_photo_front)" alt="" width="100%" >
                                                    <img  v-show="!editmodeAffiliate" :src="affiliateform.id_photo_front" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="affiliateform" field="id_photo_front"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="backside_i_photod" class=" col-form-label">BackSide ID Photo</label><br>
                                                <input @change="affiliateChangeIDBackPhoto($event)" type="file" name="id_photo_back"
                                                    :class="{ 'is-invalid': affiliateform.errors.has('backside_id') }">
                                                    <img v-show="editmodeAffiliate" :src="updateAffiliateIDBackPhoto(affiliateform.id_photo_back)" alt="" width="100%" >
                                                    <img  v-show="!editmodeAffiliate" :src="affiliateform.id_photo_back" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="affiliateform" field="id_photo_back"></has-error>
                                        </div>
                                    </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editmodeAffiliate" type="submit" class="btn btn-success">Update</button>
                            <button v-show="!editmodeAffiliate" type="submit" class="btn btn-primary">Create</button>
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
        name:"Organisation-Affiliates",
        data(){
            return{
                newAffiliate: false,
                editmodeAffiliate: false,
                affiliateform: new Form({
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
                 //affiliate
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
            this.loadAffiliates();
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
            Affiliates(){
                return this.$store.getters.Affiliates
            },

        },
        methods:{
            //affiliate
            InputPhone({ number, isValid, country }) {
            this.affiliateform.phone = number;
            this.phone.isValid = isValid;
            this.phone.country = country && country.name;
            },
            InputLandline({ number, isValid, country }) {
            this.affiliateform.landline = number;
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
            loadAffiliates(){
                return this.$store.dispatch( "affiliates")//get all from affiliates.index
            },
            newAffiliateModal(){
                 this.editmodeAffiliate= false;
                 this.affiliateform.reset()
                     $('#AffiliateModal').modal('show')
            },
            affiliateLoadPassPhoto(affiliatepivot_photo){
                console.log(affiliatepivot_photo)
                if(affiliatepivot_photo){
                    return "/assets/organisation/img/affiliates/passports/"+affiliatepivot_photo;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            //affiliate passport photo
            affiliateChangePassPhoto(event){
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
                            this.affiliateform.photo =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateAffiliatePassPhoto(organisationaffiliate_photo){
                console.log(organisationaffiliate_photo, 'edit')
                let img = this.affiliateform.photo;
                      if(img ==null){
                          return "/assets/organisation/img/website/empty.png";
                        //  console.log('its reall null')
                      }else{
                          if(img.length>100){
                            return this.affiliateform.photo;
                        }else{
                            if(organisationaffiliate_photo){
                                return "/assets/organisation/img/affiliates/passports/"+organisationaffiliate_photo;
                            }else{
                                return "/assets/organisation/img/website/empty.png";
                            }
                        }
                      }

            },
            affiliateLoadIDFrontPhoto(affiliatepivot_id_photo_front){
                if(affiliatepivot_id_photo_front){
                    return "/assets/organisation/img/affiliates/IDs/front/"+affiliatepivot_id_photo_front;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            affiliateChangeIDFrontPhoto(event){
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
                            this.affiliateform.id_photo_front =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateAffiliateIDFrontPhoto(affiliateform_id_photo_front){
                let img = this.affiliateform.id_photo_front;
                      if(img ==null){
                          return "/assets/organisation/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.affiliateform.id_photo_front;
                        }else{
                            if(affiliateform_id_photo_front){
                                return "/assets/organisation/img/affiliates/IDs/front/"+affiliateform_id_photo_front;
                            }else{
                                return "/assets/organisation/img/website/empty.png";
                            }
                        }
                      }

            },
            affiliateLoadIDBackPhoto(affiliateform_id_photo_back){
                if(affiliateform_id_photo_back){
                    return "/assets/organisation/img/affiliates/IDs/back/"+affiliateform_id_photo_back;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            affiliateChangeIDBackPhoto(event){
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
                            this.affiliateform.id_photo_back =event.target.result
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateAffiliateIDBackPhoto(affiliateform_id_photo_back){
                let img = this.affiliateform.id_photo_back;
                      if(img ==null){
                          return "/assets/organisation/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.affiliateform.id_photo_back;
                        }else{
                            if(affiliateform_id_photo_back){
                                return "/assets/organisation/img/affiliates/IDs/back/"+affiliateform_id_photo_back;
                            }else{
                                return "/assets/organisation/img/website/empty.png";
                            }
                        }
                      }

            },

            editAffiliateModal(id){
                 this.editmodeAffiliate = true;
                 this.affiliateform.reset()
                    this.$Progress.start();
                      axios.get('/api/affiliate/edit/'+id)
                        .then((response)=>{
                           $('#AffiliateModal').modal('show')
                           toast({
                            type: 'success',
                            title: 'Fetched the Affiliate data successfully'
                            })
                            console.log(response.data)
                            this.affiliateform.fill(response.data.affiliate)
                            this.affiliateform.user_id = response.data.affiliate.organisationaffiliates[0].pivot.user_id
                            this.affiliateform.organisation_id = response.data.affiliate.organisationaffiliates[0].pivot.organisation_id
                            this.affiliateform.position_id = response.data.affiliate.organisationaffiliates[0].pivot.position_id
                            this.affiliateform.gender_id = response.data.affiliate.organisationaffiliates[0].pivot.gender_id
                            console.log(this.affiliateform.gender_id,'gendr')
                            this.affiliateform.photo = response.data.affiliate.organisationaffiliates[0].pivot.photo
                            this.affiliateform.id_no = response.data.affiliate.organisationaffiliates[0].pivot.id_no
                            this.affiliateform.id_photo_front = response.data.affiliate.organisationaffiliates[0].pivot.id_photo_front
                            this.affiliateform.id_photo_back = response.data.affiliate.organisationaffiliates[0].pivot.id_photo_back
                            this.affiliateform.phone = response.data.affiliate.organisationaffiliates[0].pivot.phone
                            this.affiliateform.landline = response.data.affiliate.organisationaffiliates[0].pivot.landline
                            this.affiliateform.address = response.data.affiliate.organisationaffiliates[0].pivot.address

                            this.affiliateform.country_id = response.data.affiliate.organisationaffiliates[0].pivot.country_id
                            //get county id using the country id
                            this.affiliateform.county_id = response.data.affiliate.organisationaffiliates[0].pivot.county_id
                            this.$store.dispatch('countrycounties', response.data.affiliate.organisationaffiliates[0].pivot.country_id);
                            //get contituency using county id
                            this.affiliateform.constituency_id = response.data.affiliate.organisationaffiliates[0].pivot.constituency_id
                            this.$store.dispatch('countyconstituencies', response.data.affiliate.organisationaffiliates[0].pivot.county_id);
                            // //get ward usng constituency id
                            this.affiliateform.ward_id = response.data.affiliate.organisationaffiliates[0].pivot.ward_id
                            this.$store.dispatch('constituencywards', response.data.affiliate.organisationaffiliates[0].pivot.constituency_id);
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                            //errors
                            $('#AffiliateModal').modal('show');
                            toast({
                            type: 'error',
                            title: 'There was something Wrong'
                            })
                        })
            },
            addAffiliate() {
                 this.affiliateform.user_type = "Organisation Affiliate";
                this.$Progress.start();
                this.affiliateform.patch('/api/affiliate')
                    .then((response)=>{
                        //  console.log(response.data)
                         toast({
                            type: 'success',
                            title: 'Affiliate Created successfully'
                            })
                            this.$store.dispatch( "affiliates")
                            this.affiliateform.reset()
                            $('#AffiliateModal').modal('hide')
                              this.$Progress.finish()
                    })
                    .catch((response)=>{
                        this.$Progress.fail()
                        //errors
                        console.log(response,'response')
                            $('#AffiliateModal').modal('show');
                            toast({
                                type: 'error',
                                title: 'There was something wrong.'
                                })
                    })
            },
            updateAffiliate(id){
                  console.log('update affiliate')
                  this.$Progress.start();
                     this.affiliateform.patch('/api/affiliate/update/'+id)
                        .then(()=>{
                            this.$store.dispatch( "affiliates")
                         $('#AffiliateModal').modal('hide')
                         toast({
                            type: 'success',
                            title: 'Affiliate Created successfully'
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
            deleteAffiliate(id){
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
                    //  console.log('delete affiliate', id)
                        this.$Progress.start();
                        this.affiliateform.get('/affiliate/delete/'+id)
                            .then(()=>{
                            toast({
                            type: 'success',
                            title: 'Affiliate Deleted successfully'
                            })
                            this.$store.dispatch( "affiliates")
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




