<template>
<div class="content-wrapper">
  <div class="container-fluid mt-5">
      <!-- Main content -->
    <section class="content">
      <div class="row justify-content-around">
        <div class="col-md">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Clients Table</h3>
              <div class="card-tools">
                    <button class="btn btn-success"  @click.prevent="newClientModal()">Add New Client
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
                    <th>Client Details</th>
                    <th>Roles</th>
                    <th>Permissions</th>
                    <th style="padding-left: 14px">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(client, index) in Clients" :key="client.id">
                    <td >{{index+1}}</td>
                    <td style="width: 550px;">
                        <div class="row" style="width:100%" v-for="organisation in client.organisationclients" :key="organisation.id">
                            <div class="col-sm-3" style="padding: 3px;">
                                 <img class="card-img-top" :src="clientLoadPassPhoto(organisation.pivot.photo)" style="width:100%" alt="Card image cap">
                            </div>
                            <div class="col-sm-3" style="padding: 3px;">
                                <img class="card-img-top" :src="clientLoadIDFrontPhoto(organisation.pivot.id_photo_front)" style="width:100%" alt="Card image cap"><br>
                                <img class="card-img-top" :src="clientLoadIDBackPhoto(organisation.pivot.id_photo_back)" style="width:100%" alt="Card image cap">
                            </div>
                            <div class="col-sm-6" style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                <div>{{client.full_name}},</div>
                                <div v-for="position in client.positions" :key="position.id">
                                    {{position.name}},
                                    <span style="color:#9a009a;">
                                        {{organisation.name}},
                                    </span>
                                </div>
                                <div> ID: ,<span style="color:#9a009a;">{{organisation.pivot.id_no}}</span>,
                                    Phone: <span style="color:#9a009a;">{{organisation.pivot.phone}},</span>
                                </div>
                                <div>
                                     Mail: <span style="color:#9a009a;">{{client.email}},</span>
                                </div>
                                    <div>P. O. Box , <span style="color:#9a009a;">{{organisation.pivot.address}}</span>,
                                    </div>
                                <div v-for="ward in client.wards" :key="ward.id">
                                    <span style="color:#9a009a;">{{ward.name}}</span> ward,
                                    <span v-for="constituency in client.constituencies" :key="constituency.id" style="color:#9a009a;">
                                        {{constituency.name}}</span> constituency,
                                </div>
                                <div v-for="county in client.counties" :key="county.id" >
                                    <span style="color:#9a009a;">{{county.name}}</span> county,
                                    <span v-for="country in client.countries" :key="country.id" style="color:#9a009a;">
                                        {{country.name}},
                                    </span>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td style="padding: 3px;">
                        <span v-for="role in client.roles" :key="role.id" class="pl-2">
                            <div class="btn btn-primary btn-sm ml-1 mb-2 " >{{role.name}} </div>
                        </span>
                    </td>
                    <td style="padding: 3px;">
                        <span v-for="permission in client.permissions" :key="permission.id" class="pl-2">
                            <div class="btn btn-primary btn-sm ml-1 mb-2 ">{{permission.name}} </div>
                        </span>
                    </td>
                    <td style="padding: 3px;" >
                        <div class="clearfix" style="font-weight:bold;font-size:0.7em;">
                            <span class="float-left" style="margin-bottom:-0.5em" >
                                <div style="margin-bottom:0.25em"> Updated at:
                                    <span style="color:#9a009a;">{{client.created_at | dateformat}} </span>
                                </div>
                            </span>
                            <span class="float-right">
                                <a href=""  @click.prevent="editClientModal(client.id)">
                                    <i class="fa fa-edit blue"></i>
                                </a>
                                /
                                <a href=""  @click.prevent="deleteClient(client.id)">
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
        <div class="modal fade " id="ClientModal" tabindex="-1" role="dialog" aria-labelledby="ClientModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form role="form" @submit.prevent="editmodeClient ? updateClient(clientform.id) : addClient()" >
                        <div class="modal-body">
                            <h5 class="modal-title" v-show="editmodeClient" id="ClientModalLabel">Update Client</h5>
                            <h5 class="modal-title" v-show="!editmodeClient" id="ClientModalLabel">Add New Client</h5>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="first_name" class="col-form-label"> Client First Name</label>
                                            <input v-model="clientform.first_name" type="text" name="first_name" placeholder="Client First Name"
                                                class="form-control" :class="{ 'is-invalid': clientform.errors.has('first_name') }" >
                                            <has-error style="color: #e83e8c" :form="clientform" field="first_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="last_name" class=" col-form-label">client_Last Name </label>
                                            <input v-model="clientform.last_name" type="client_last_name" name="last_name" placeholder="Client Last Name"
                                                class="form-control" :class="{ 'is-invalid': clientform.errors.has('last_name') }" >
                                            <has-error style="color: #e83e8c" :form="clientform" field="last_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="email" class=" col-form-label">Email </label>
                                            <input v-model="clientform.email" type="email" name="email" placeholder="Email Address"
                                                class="form-control" :class="{ 'is-invalid': clientform.errors.has('email') }" >
                                            <has-error style="color: #e83e8c" :form="clientform" field="email"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <input v-model="clientform.password" type="password" id="password" placeholder="Password"
                                                class="form-control" :class="{ 'is-invalid': clientform.errors.has('password') }">
                                            <has-error :form="clientform" field="password"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="phone" class="col-form-label"> Client Phone</label>
                                                <div>
                                                    <vue-tel-input v-model="clientform.phone" name="phone" @onInput="InputPhone"
                                                    class="form-control" :class="{ 'is-invalid': clientform.errors.has('phone') }">
                                                    </vue-tel-input>
                                                    <has-error style="color: #e83e8c" :form="clientform" field="phone"></has-error>
                                                </div>
                                                <div v-if="clientform.phone" style="color: #e83e8c">
                                                    <span>Is valid: <strong>{{phone.isValid}}</strong>,&nbsp;</span>
                                                    <span>Country: <strong>{{phone.country}}</strong></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="landline" class=" col-form-label">Landline</label>
                                                <vue-tel-input v-model="clientform.landline" name="landline" @onInput="InputLandline"
                                                    class="form-control" :class="{ 'is-invalid': clientform.errors.has('landline') }">
                                                </vue-tel-input>
                                                <has-error style="color: #e83e8c" :form="clientform" field="landline"></has-error>

                                                <div v-if="clientform.landline" style="color: #e83e8c">
                                                    <span>Is valid: <strong>{{landline.isValid}}</strong>,&nbsp;</span>
                                                    <span>Country: <strong>{{landline.country}}</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <label for="id_no" class="col-form-label">ID no.</label>
                                            <input v-model="clientform.id_no" type="text" name="id_no" placeholder="ID NO"
                                                class="form-control" :class="{ 'is-invalid': clientform.errors.has('id_no') }" >
                                            <has-error style="color: #e83e8c" :form="clientform" field="id_no"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="address" class=" col-form-label">Address</label>
                                            <input v-model="clientform.address" type="text" name="address" placeholder="Address"
                                                class="form-control" :class="{ 'is-invalid': clientform.errors.has('address') }" >
                                            <has-error style="color: #e83e8c" :form="clientform" field="country_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="gender_id">Select Gender</label>
                                            <select class="form-control" v-model="clientform.gender_id"
                                                    :class="{ 'is-invalid':clientform.errors.has('gender_id') }">
                                                    <option disabled value="">Select gender</option>
                                                    <option v-for="gender in Genders" :value="gender.id" :key="gender.id">{{gender.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="clientform" field="gender_id"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-3">
                                            <label for="country_id">Select Country</label>
                                            <select class="form-control" @change="countryCounties(clientform.country_id)"
                                            v-model="clientform.country_id" :class="{ 'is-invalid': clientform.errors.has('country_id') }">
                                                    <option disabled value="">Select Country</option>{{clientform.country_id}}
                                                    <option v-for="country in Countries" :value="country.id" :key="country.id">{{country.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="clientform" field="country_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="county_id" class=" col-form-label">County</label>
                                            <select class="form-control" @change="countyConstituencies(clientform.county_id)"
                                            v-model="clientform.county_id" :class="{ 'is-invalid': clientform.errors.has('county_id') }">
                                                    <option disabled value="">Select County</option>
                                                    <option v-for="county in Counties" :value="county.id" :key="county.id">{{county.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="clientform" field="county_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="constituency_id" class=" col-form-label">Constituency</label>
                                            <select class="form-control" @change="constituencyWards(clientform.constituency_id)"
                                            v-model="clientform.constituency_id" :class="{ 'is-invalid': clientform.errors.has('constituency_id') }">
                                                    <option disabled value="">Select County</option>
                                                    <option v-for="constituency in Constituencies" :value="constituency.id" :key="constituency.id">{{constituency.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="clientform" field="constituency_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="ward_id" class="col-form-label"> Ward </label>
                                            <select class="form-control"
                                            v-model="clientform.ward_id" :class="{ 'is-invalid': clientform.errors.has('ward_id') }">
                                                    <option disabled value="">Select Ward</option>
                                                    <option v-for="ward in Wards" :value="ward.id" :key="ward.id">{{ward.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="clientform" field="ward_id"></has-error>
                                        </div>

                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <label for="photo" class=" col-form-label">Client PassPort Image</label><br>
                                                <input @change="clientChangePassPhoto($event)" type="file" name="photo"
                                                    :class="{ 'is-invalid': clientform.errors.has('photo') }">
                                                    <img v-show="editmodeClient" :src="updateClientPassPhoto(clientform.photo)" alt="" width="100%" >
                                                    <img  v-show="!editmodeClient" :src="clientform.photo" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="clientform" field="photo"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="id_photo_front" class=" col-form-label">Client FrontSide ID Photo</label><br>
                                                <input @change="clientChangeIDFrontPhoto($event)" type="file" name="id_photo_front"
                                                    :class="{ 'is-invalid': clientform.errors.has('id_photo_front') }">
                                                    <img v-show="editmodeClient" :src="updateClientIDFrontPhoto(clientform.id_photo_front)" alt="" width="100%" >
                                                    <img  v-show="!editmodeClient" :src="clientform.id_photo_front" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="clientform" field="id_photo_front"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="backside_i_photod" class=" col-form-label">BackSide ID Photo</label><br>
                                                <input @change="clientChangeIDBackPhoto($event)" type="file" name="id_photo_back"
                                                    :class="{ 'is-invalid': clientform.errors.has('backside_id') }">
                                                    <img v-show="editmodeClient" :src="updateClientIDBackPhoto(clientform.id_photo_back)" alt="" width="100%" >
                                                    <img  v-show="!editmodeClient" :src="clientform.id_photo_back" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="clientform" field="id_photo_back"></has-error>
                                        </div>
                                    </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editmodeClient" type="submit" class="btn btn-success">Update</button>
                            <button v-show="!editmodeClient" type="submit" class="btn btn-primary">Create</button>
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
        name:"Organisation-Clients",
        data(){
            return{
                newClient: false,
                editmodeClient: false,
                clientform: new Form({
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
                 //client
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
            this.loadClients();
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
            Clients(){
                return this.$store.getters.Clients
            },

        },
        methods:{
            //client
            InputPhone({ number, isValid, country }) {
            this.clientform.phone = number;
            this.phone.isValid = isValid;
            this.phone.country = country && country.name;
            },
            InputLandline({ number, isValid, country }) {
            this.clientform.landline = number;
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
            loadClients(){
                return this.$store.dispatch( "clients")//get all from clients.index
            },
            newClientModal(){
                 this.editmodeClient= false;
                 this.clientform.reset()
                     $('#ClientModal').modal('show')
            },
            clientLoadPassPhoto(clientpivot_photo){
                console.log(clientpivot_photo)
                if(clientpivot_photo){
                    return "/assets/organisation/img/clients/passports/"+clientpivot_photo;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            //client passport photo
            clientChangePassPhoto(event){
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
                            this.clientform.photo =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateClientPassPhoto(organisationclient_photo){
                console.log(organisationclient_photo, 'edit')
                let img = this.clientform.photo;
                      if(img ==null){
                          return "/assets/organisation/img/website/empty.png";
                        //  console.log('its reall null')
                      }else{
                          if(img.length>100){
                            return this.clientform.photo;
                        }else{
                            if(organisationclient_photo){
                                return "/assets/organisation/img/clients/passports/"+organisationclient_photo;
                            }else{
                                return "/assets/organisation/img/website/empty.png";
                            }
                        }
                      }

            },
            clientLoadIDFrontPhoto(clientpivot_id_photo_front){
                if(clientpivot_id_photo_front){
                    return "/assets/organisation/img/clients/IDs/front/"+clientpivot_id_photo_front;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            clientChangeIDFrontPhoto(event){
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
                            this.clientform.id_photo_front =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateClientIDFrontPhoto(clientform_id_photo_front){
                let img = this.clientform.id_photo_front;
                      if(img ==null){
                          return "/assets/organisation/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.clientform.id_photo_front;
                        }else{
                            if(clientform_id_photo_front){
                                return "/assets/organisation/img/clients/IDs/front/"+clientform_id_photo_front;
                            }else{
                                return "/assets/organisation/img/website/empty.png";
                            }
                        }
                      }

            },
            clientLoadIDBackPhoto(clientform_id_photo_back){
                if(clientform_id_photo_back){
                    return "/assets/organisation/img/clients/IDs/back/"+clientform_id_photo_back;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            clientChangeIDBackPhoto(event){
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
                            this.clientform.id_photo_back =event.target.result
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateClientIDBackPhoto(clientform_id_photo_back){
                let img = this.clientform.id_photo_back;
                      if(img ==null){
                          return "/assets/organisation/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.clientform.id_photo_back;
                        }else{
                            if(clientform_id_photo_back){
                                return "/assets/organisation/img/clients/IDs/back/"+clientform_id_photo_back;
                            }else{
                                return "/assets/organisation/img/website/empty.png";
                            }
                        }
                      }

            },

            editClientModal(id){
                 this.editmodeClient = true;
                 this.clientform.reset()
                    this.$Progress.start();
                      axios.get('/api/client/edit/'+id)
                        .then((response)=>{
                           $('#ClientModal').modal('show')
                           toast({
                            type: 'success',
                            title: 'Fetched the Client data successfully'
                            })
                            console.log(response.data)
                            this.clientform.fill(response.data.client)
                            this.clientform.user_id = response.data.client.organisationclients[0].pivot.user_id
                            this.clientform.organisation_id = response.data.client.organisationclients[0].pivot.organisation_id
                            this.clientform.position_id = response.data.client.organisationclients[0].pivot.position_id
                            this.clientform.gender_id = response.data.client.organisationclients[0].pivot.gender_id
                            this.clientform.photo = response.data.client.organisationclients[0].pivot.photo
                            this.clientform.id_no = response.data.client.organisationclients[0].pivot.id_no
                            this.clientform.id_photo_front = response.data.client.organisationclients[0].pivot.id_photo_front
                            this.clientform.id_photo_back = response.data.client.organisationclients[0].pivot.id_photo_back
                            this.clientform.phone = response.data.client.organisationclients[0].pivot.phone
                            this.clientform.landline = response.data.client.organisationclients[0].pivot.landline
                            this.clientform.address = response.data.client.organisationclients[0].pivot.address

                            this.clientform.country_id = response.data.client.organisationclients[0].pivot.country_id
                            //get county id using the country id
                            this.clientform.county_id = response.data.client.organisationclients[0].pivot.county_id
                            this.$store.dispatch('countrycounties', response.data.client.organisationclients[0].pivot.country_id);
                            //get contituency using county id
                            this.clientform.constituency_id = response.data.client.organisationclients[0].pivot.constituency_id
                            this.$store.dispatch('countyconstituencies', response.data.client.organisationclients[0].pivot.county_id);
                            // //get ward usng constituency id
                            this.clientform.ward_id = response.data.client.organisationclients[0].pivot.ward_id
                            this.$store.dispatch('constituencywards', response.data.client.organisationclients[0].pivot.constituency_id);
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                            //errors
                            $('#ClientModal').modal('show');
                            toast({
                            type: 'error',
                            title: 'There was something Wrong'
                            })
                        })
            },
            addClient() {
                this.$Progress.start(); this.clientform.user_type = "Client";
                this.clientform.user_type = "Client";
                this.clientform.patch('/api/client')
                    .then((response)=>{
                        //  console.log(response.data)
                         toast({
                            type: 'success',
                            title: 'Client Created successfully'
                            })
                            this.$store.dispatch( "clients")
                            this.clientform.reset()
                            $('#ClientModal').modal('hide')
                              this.$Progress.finish()
                    })
                    .catch((response)=>{
                        this.$Progress.fail()
                        //errors
                        console.log(response,'response')
                            $('#ClientModal').modal('show');
                            toast({
                                type: 'error',
                                title: 'There was something wrong.'
                                })
                    })
            },
            updateClient(id){
                  console.log('update client')
                  this.$Progress.start();
                     this.clientform.patch('/api/client/update/'+id)
                        .then(()=>{
                            this.$store.dispatch( "clients")
                         $('#ClientModal').modal('hide')
                         toast({
                            type: 'success',
                            title: 'Client Created successfully'
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
            deleteClient(id){
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
                    //  console.log('delete client', id)
                        this.$Progress.start();
                        this.clientform.get('/client/delete/'+id)
                            .then(()=>{
                            toast({
                            type: 'success',
                            title: 'Client Deleted successfully'
                            })
                            this.$store.dispatch( "clients")
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




