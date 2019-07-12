<template>
<div class="content-wrapper">
  <div class="container-fluid mt-5">
      <!-- Main content -->
    <section class="content">
      <div class="row justify-content-around">
        <div class="col-md">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Admins Table</h3>
              <div class="card-tools">
                    <!-- <button class="btn btn-success"  @click.prevent="newAdminModal()">Add New Admin
                         <i class="fas fa-plus fw"></i>
                     </button> -->
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>S1</th>
                    <th>Admin Details</th>
                    <th>Roles</th>
                    <th>Permissions</th>
                    <th style="padding-left: 14px">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(user, index) in Users" :key="user.id">
                    <td >{{index+1}}</td>
                    <td style="width: 550px;">
                        <div class="row" style="width:100%" v-for="admin in user.organisationadmins" :key="admin.id">
                            <div class="col-sm-3" style="padding: 3px;">
                                 <img class="card-img-top" :src="adminLoadPassPhoto(admin.pivot.photo)" style="width:100%" alt="Card image cap">
                            </div>
                            <!-- <div class="col-sm-3" style="padding: 3px;">
                                <img class="card-img-top" :src="adminLoadIDFrontPhoto(admin.pivot.id_photo_front)" style="width:100%" alt="Card image cap"><br>
                                <img class="card-img-top" :src="adminLoadIDBackPhoto(admin.pivot.id_photo_back)" style="width:100%" alt="Card image cap">
                            </div> -->
                            <div class="col-sm-9" style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                <div>{{user.full_name}},</div>
                                <div>
                                     Organisation: <span style="color:#9a009a;">{{admin.name}},</span>
                                </div>
                                <div> ID: ,<span style="color:#9a009a;">{{admin.pivot.id_no}}</span>,
                                    Phone: <span style="color:#9a009a;">{{admin.pivot.phone}},</span>
                                </div>
                                <div>
                                     Mail: <span style="color:#9a009a;">{{user.email}},</span>s
                                </div>
                                    <div>P. O. Box , <span style="color:#9a009a;">{{admin.pivot.address}}</span>,
                                    </div>
                               <div>
                                    <span style="color:#9a009a;">{{admin.ward_name}}</span> ward,
                                    <span style="color:#9a009a;">{{admin.constituency_name}}</span> constituency,
                                </div>
                                <div >
                                    <span style="color:#9a009a;">{{admin.county_name}}</span> county,
                                    <span style="color:#9a009a;">{{admin.country_name}},</span>
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
                                <a href=""  @click.prevent="editAdminModal(user.id)">
                                    <i class="fa fa-edit blue"></i>
                                </a>
                                /
                                <a href=""  @click.prevent="deleteAdmin(user.id)">
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
                                    out of <span style="color:#9a009a;"> {{Pagination.total}} </span> Admins
                                </div>
                                <button class="btn btn-info" v-on:click="fetchPaginatedAdmins(Pagination.prev_page_url)" :disabled="!Pagination.prev_page_url">Prev</button>
                            </span>
                            <span class="float-right" style="margin-bottom:-0.5em" >
                                <div style="margin-bottom:0.25em">
                                    Page <span style="color:#9a009a;"> {{Pagination.current_page}} </span>
                                    of <span style="color:#9a009a;"> {{Pagination.last_page}} </span>
                                </div>
                                <button class="btn btn-info" v-on:click="fetchPaginatedAdmins(Pagination.next_page_url)" :disabled="!Pagination.next_page_url">Next</button>
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
    <div class="modal fade " id="AdminModal" tabindex="-1" role="dialog" aria-labelledby="AdminModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form role="form" @submit.prevent="editmodeAdmin ? updateAdmin(adminform.id) : addAdmin()" >
                        <div class="modal-body">
                            <h5 class="modal-title" v-show="editmodeAdmin" id="AdminModalLabel">Update Admin</h5>
                            <h5 class="modal-title" v-show="!editmodeAdmin" id="AdminModalLabel">Add New Admin</h5>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="first_name" class="col-form-label"> Admin Passport</label>
                                    <img v-show="editmodeAdmin" :src="updateAdminPassPhoto(adminform.photo)" alt="" width="100%" >
                                </div>
                                <div class="form-group col-md-8">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="first_name" class="col-form-label"> Admin First Name</label>
                                            <input v-model="adminform.first_name" type="text" name="first_name" placeholder="Admin First Name"
                                                class="form-control" :class="{ 'is-invalid': adminform.errors.has('first_name') }" >
                                            <has-error style="color: #e83e8c" :form="adminform" field="first_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="last_name" class=" col-form-label">admin_Last Name </label>
                                            <input v-model="adminform.last_name" type="admin_last_name" name="last_name" placeholder="Admin Last Name"
                                                class="form-control" :class="{ 'is-invalid': adminform.errors.has('last_name') }" >
                                            <has-error style="color: #e83e8c" :form="adminform" field="last_name"></has-error>
                                        </div>
                                    </div>
                                    <div class="row">
                                         <div class="form-group col-md-6">
                                            <label for="email" class=" col-form-label">Email </label>
                                            <input v-model="adminform.email" type="email" name="email" placeholder="Email Address"
                                                class="form-control" :class="{ 'is-invalid': adminform.errors.has('email') }" >
                                            <has-error style="color: #e83e8c" :form="adminform" field="email"></has-error>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="password" class=" col-form-label">Password </label>
                                            <input v-model="adminform.password" type="password" id="password" placeholder="Password"
                                                class="form-control" :class="{ 'is-invalid': adminform.errors.has('password') }">
                                            <has-error :form="adminform" field="password"></has-error>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editmodeAdmin" type="submit" class="btn btn-success">Update</button>
                            <button v-show="!editmodeAdmin" type="submit" class="btn btn-primary">Create</button>
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
        name:"Organisation-Admins",
        data(){
            return{
                newAdmin: false,
                editmodeAdmin: false,
                adminform: new Form({
                        id:'',
                        first_name:'',
                        last_name:'',
                        email:'',
                        password:'',
                        user_type:'',
                        photo:'',
                }),
                 url:'/api/orgadmin/get',
                pagination:[],
            }
        },
        mounted() {
            this.loadCountries();
            this.loadCounties();
            this.loadConstituencies();
            this.loadWards();
            this.loadGenders();
            this.loadAdmins();
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
                return this.$store.getters.Admins
            },
            Pagination(){
                return this.$store.getters.AdminPagination
            }

        },
        methods:{
            //admin
            InputPhone({ number, isValid, country }) {
            this.adminform.phone = number;
            this.phone.isValid = isValid;
            this.phone.country = country && country.name;
            },
            InputLandline({ number, isValid, country }) {
            this.adminform.landline = number;
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
            loadAdmins(){
                this.$Progress.start();
                return this.$store.dispatch( "admins", this.url)
                 .then((response)=>{
                    toast({
                     type: 'success',
                     title: 'Fetched the Admin data successfully'
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
            fetchPaginatedAdmins(url){
                this.url = url;
                this.loadAdmins();
            },
            newAdminModal(){
                 this.editmodeAdmin= false;
                 this.adminform.reset()
                     $('#AdminModal').modal('show')
            },
            adminLoadPassPhoto(adminpivot_photo){
                console.log(adminpivot_photo)
                if(adminpivot_photo){
                    return "/assets/organisation/img/admins/passports/"+adminpivot_photo;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            //admin passport photo
            adminChangePassPhoto(event){
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
                            this.adminform.photo =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateAdminPassPhoto(organisationadmin_photo){
                console.log(organisationadmin_photo, 'edit')
                let img = this.adminform.photo;
                      if(img ==null){
                          return "/assets/organisation/img/website/empty.png";
                        //  console.log('its reall null')
                      }else{
                          if(img.length>100){
                            return this.adminform.photo;
                        }else{
                            if(organisationadmin_photo){
                                return "/assets/organisation/img/admins/passports/"+organisationadmin_photo;
                            }else{
                                return "/assets/organisation/img/website/empty.png";
                            }
                        }
                      }

            },
            adminLoadIDFrontPhoto(adminpivot_id_photo_front){
                if(adminpivot_id_photo_front){
                    return "/assets/organisation/img/admins/IDs/front/"+adminpivot_id_photo_front;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            adminChangeIDFrontPhoto(event){
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
                            this.adminform.id_photo_front =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateAdminIDFrontPhoto(adminform_id_photo_front){
                let img = this.adminform.id_photo_front;
                      if(img ==null){
                          return "/assets/organisation/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.adminform.id_photo_front;
                        }else{
                            if(adminform_id_photo_front){
                                return "/assets/organisation/img/admins/IDs/front/"+adminform_id_photo_front;
                            }else{
                                return "/assets/organisation/img/website/empty.png";
                            }
                        }
                      }

            },
            adminLoadIDBackPhoto(adminform_id_photo_back){
                if(adminform_id_photo_back){
                    return "/assets/organisation/img/admins/IDs/back/"+adminform_id_photo_back;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            adminChangeIDBackPhoto(event){
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
                            this.adminform.id_photo_back =event.target.result
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateAdminIDBackPhoto(adminform_id_photo_back){
                let img = this.adminform.id_photo_back;
                      if(img ==null){
                          return "/assets/organisation/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.adminform.id_photo_back;
                        }else{
                            if(adminform_id_photo_back){
                                return "/assets/organisation/img/admins/IDs/back/"+adminform_id_photo_back;
                            }else{
                                return "/assets/organisation/img/website/empty.png";
                            }
                        }
                      }

            },

            editAdminModal(id){
                 this.editmodeAdmin = true;
                 this.adminform.reset()
                    this.$Progress.start();
                      axios.get('/api/orgadmin/edit/'+id)
                        .then((response)=>{
                           $('#AdminModal').modal('show')
                           toast({
                            type: 'success',
                            title: 'Fetched the Admin data successfully'
                            })
                            this.adminform.fill(response.data.user)
                            this.adminform.first_name = response.data.user.first_name;
                            this.adminform.last_name = response.data.user.last_name;
                            this.adminform.email = response.data.user.email;
                            this.adminform.user_type = response.data.user.user_type;
                            this.adminform.photo = response.data.user.organisationadmins[0].pivot.photo
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                            //errors
                            $('#AdminModal').modal('show');
                            toast({
                            type: 'error',
                            title: 'There was something Wrong'
                            })
                        })
            },
            addAdmin() {
                 this.adminform.user_type = "Organisation Admin";
                this.$Progress.start();
                this.adminform.patch('/api/orgadmin')
                    .then((response)=>{
                        //  console.log(response.data)
                         toast({
                            type: 'success',
                            title: 'Admin Created successfully'
                            })
                            this.$store.dispatch( "admins")
                            this.adminform.reset()
                            $('#AdminModal').modal('hide')
                              this.$Progress.finish()
                    })
                    .catch((response)=>{
                        this.$Progress.fail()
                        //errors
                        console.log(response,'response')
                            $('#AdminModal').modal('show');
                            toast({
                                type: 'error',
                                title: 'There was something wrong.'
                                })
                    })
            },
            updateAdmin(id){
                  console.log('update admin')
                  this.$Progress.start();
                     this.adminform.patch('/api/user/update/'+id)
                        .then(()=>{
                            this.loadAdmins();
                         $('#AdminModal').modal('hide')
                         toast({
                            type: 'success',
                            title: 'Admin Created successfully'
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
            deleteAdmin(id){
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
                    //  console.log('delete admin', id)
                        this.$Progress.start();
                        this.adminform.get('/orgadmin/delete/'+id)
                            .then(()=>{
                            toast({
                            type: 'success',
                            title: 'Admin Deleted successfully'
                            })
                            this.$store.dispatch( "admins")
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



