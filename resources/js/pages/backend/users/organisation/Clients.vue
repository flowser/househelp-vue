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
              <!-- <div class="card-tools">
                    <button class="btn btn-success"  @click.prevent="newClientModal()">Add New Client
                         <i class="fas fa-plus fw"></i>
                     </button>
              </div> -->
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
                  <tr v-for="(user, index) in Users" :key="user.id">
                    <td >{{index+1}}</td>
                    <td style="width: 550px;">
                        <div class="row" style="width:100%" v-for="client in user.organisationclients" :key="client.id">
                            <div class="col-sm-3" style="padding: 3px;">
                                 <img class="card-img-top" :src="clientLoadPassPhoto(client.pivot.photo)" style="width:100%" alt="Card image cap">
                            </div>
                            <div class="col-sm-3" style="padding: 3px;">
                                <img class="card-img-top" :src="clientLoadIDFrontPhoto(client.pivot.id_photo_front)" style="width:100%" alt="Card image cap"><br>
                                <img class="card-img-top" :src="clientLoadIDBackPhoto(client.pivot.id_photo_back)" style="width:100%" alt="Card image cap">
                            </div>
                            <div class="col-sm-6" style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                <div>{{client.full_name}},</div>
                                <div> Organisation
                                    <span style="color:#9a009a;">
                                        {{client.name}},
                                    </span>
                                </div>
                                <div> ID: ,<span style="color:#9a009a;">{{client.pivot.id_no}}</span>,
                                    Phone: <span style="color:#9a009a;">{{client.pivot.phone}},</span>
                                </div>
                                <div>
                                     Mail: <span style="color:#9a009a;">{{user.email}},</span>
                                </div>
                                    <div>P. O. Box , <span style="color:#9a009a;">{{client.pivot.address}}</span>,
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
                                    <span style="color:#9a009a;">{{client.created_at | dateformat}} </span>
                                </div>
                            </span>
                            <span class="float-right">
                                <a href=""  @click.prevent="editClientModal(user.id)">
                                    <i class="fa fa-edit blue"></i>
                                </a>
                                /
                                <a href=""  @click.prevent="deleteClient(user.id)">
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
                                  Between <span style="color:#9a009a;"> {{pagination.from}} </span>
                                  & <span style="color:#9a009a;"> {{pagination.to}} </span>
                                  out of <span style="color:#9a009a;"> {{pagination.total}} </span> Clients
                              </div>
                              <button class="btn btn-info" v-on:click="fetchPaginatedClients(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">Prev</button>
                          </span>
                          <span class="float-right" style="margin-bottom:-0.5em" >
                              <div style="margin-bottom:0.25em">
                                  Page <span style="color:#9a009a;"> {{pagination.current_page}} </span>
                                  of <span style="color:#9a009a;"> {{pagination.last_page}} </span>
                              </div>
                              <button class="btn btn-info" v-on:click="fetchPaginatedClients(pagination.next_page_url)" :disabled="!pagination.next_page_url">Next</button>
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
                                    <label for="first_name" class="col-form-label"> Client Passport</label>
                                    <img v-show="editmodeClient" :src="updateClientPassPhoto(clientform.photo)" alt="" width="100%" >
                                </div>
                                <div class="form-group col-md-8">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="first_name" class="col-form-label"> Client First Name</label>
                                            <input v-model="clientform.first_name" type="text" name="first_name" placeholder="Client First Name"
                                                class="form-control" :class="{ 'is-invalid': clientform.errors.has('first_name') }" >
                                            <has-error style="color: #e83e8c" :form="clientform" field="first_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="last_name" class=" col-form-label">client_Last Name </label>
                                            <input v-model="clientform.last_name" type="client_last_name" name="last_name" placeholder="Client Last Name"
                                                class="form-control" :class="{ 'is-invalid': clientform.errors.has('last_name') }" >
                                            <has-error style="color: #e83e8c" :form="clientform" field="last_name"></has-error>
                                        </div>
                                    </div>
                                    <div class="row">
                                         <div class="form-group col-md-6">
                                            <label for="email" class=" col-form-label">Email </label>
                                            <input v-model="clientform.email" type="email" name="email" placeholder="Email Address"
                                                class="form-control" :class="{ 'is-invalid': clientform.errors.has('email') }" >
                                            <has-error style="color: #e83e8c" :form="clientform" field="email"></has-error>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="password" class=" col-form-label">Password </label>
                                            <input v-model="clientform.password" type="password" id="password" placeholder="Password"
                                                class="form-control" :class="{ 'is-invalid': clientform.errors.has('password') }">
                                            <has-error :form="clientform" field="password"></has-error>
                                        </div>
                                    </div>
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
                        photo:'',
                }),
                url:'/api/client/get/list',
                pagination:[],
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
            Users(){
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
                this.$Progress.start();
                return this.$store.dispatch( "clients", this.url)
                 .then((response)=>{
                     this.makingPagination(response.data.clients),
                    toast({
                     type: 'success',
                     title: 'Fetched the Client data successfully'
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
            fetchPaginatedClients(url){
                this.url = url;
                this.loadClients();
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
                            this.clientform.fill(response.data.user)
                            this.clientform.first_name = response.data.user.first_name;
                            this.clientform.last_name = response.data.user.last_name;
                            this.clientform.email = response.data.user.email;
                            this.clientform.user_type = response.data.user.user_type;
                            this.clientform.photo = response.data.user.organisationclients[0].pivot.photo
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
                     this.clientform.patch('/api/user/update/'+id)
                        .then(()=>{
                            this.loadClients();
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




