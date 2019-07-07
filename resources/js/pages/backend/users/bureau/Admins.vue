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
                  <tr v-for="(user, index) in Users" :key="user.id">
                    <td >{{index+1}}</td>
                    <td style="width: 500px;">
                        <div class="row" style="width:100%" v-for="admin in user.bureauadmins" :key="admin.id">
                            <div class="col-sm-3" style="padding: 3px;">
                                 <img class="card-img-top" :src="bureauadminLoadPassPhoto(admin.pivot.photo)" style="width:100%" alt="Card image cap">
                            </div>
                            <div class="col-sm-9" style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                <div>{{user.full_name}},</div>
                                <div > Bureau,
                                    <span style="color:#9a009a;">
                                        {{admin.name}},
                                    </span>
                                </div>
                                <div> ID: ,<span style="color:#9a009a;">{{admin.pivot.id_no}}</span>,
                                    Phone: <span style="color:#9a009a;">{{admin.pivot.phone}},</span>
                                </div>
                                <div>
                                     Mail: <span style="color:#9a009a;">{{user.email}},</span>
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
                                <a href=""  @click.prevent="editBureauadminModal(user.id)">
                                    <i class="fa fa-edit blue"></i>
                                </a>
                                /
                                <a href=""  @click.prevent="deleteBureauadmin(user.id)">
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
                                  out of <span style="color:#9a009a;"> {{pagination.total}} </span> Bureauadmins
                              </div>
                              <button class="btn btn-info" v-on:click="fetchPaginatedBureauadmins(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">Prev</button>
                          </span>
                          <span class="float-right" style="margin-bottom:-0.5em" >
                              <div style="margin-bottom:0.25em">
                                  Page <span style="color:#9a009a;"> {{pagination.current_page}} </span>
                                  of <span style="color:#9a009a;"> {{pagination.last_page}} </span>
                              </div>
                              <button class="btn btn-info" v-on:click="fetchPaginatedBureauadmins(pagination.next_page_url)" :disabled="!pagination.next_page_url">Next</button>
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
                                    <label for="first_name" class="col-form-label"> Bureauadmin Passport</label>
                                    <img v-show="editmodeBureauadmin" :src="updateBureauadminPassPhoto(bureauadminform.photo)" alt="" width="100%" >
                                </div>
                                <div class="form-group col-md-8">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="first_name" class="col-form-label"> Bureauadmin First Name</label>
                                            <input v-model="bureauadminform.first_name" type="text" name="first_name" placeholder="Bureauadmin First Name"
                                                class="form-control" :class="{ 'is-invalid': bureauadminform.errors.has('first_name') }" >
                                            <has-error style="color: #e83e8c" :form="bureauadminform" field="first_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="last_name" class=" col-form-label">bureauadmin_Last Name </label>
                                            <input v-model="bureauadminform.last_name" type="bureauadmin_last_name" name="last_name" placeholder="Bureauadmin Last Name"
                                                class="form-control" :class="{ 'is-invalid': bureauadminform.errors.has('last_name') }" >
                                            <has-error style="color: #e83e8c" :form="bureauadminform" field="last_name"></has-error>
                                        </div>
                                    </div>
                                    <div class="row">
                                         <div class="form-group col-md-6">
                                            <label for="email" class=" col-form-label">Email </label>
                                            <input v-model="bureauadminform.email" type="email" name="email" placeholder="Email Address"
                                                class="form-control" :class="{ 'is-invalid': bureauadminform.errors.has('email') }" >
                                            <has-error style="color: #e83e8c" :form="bureauadminform" field="email"></has-error>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="password" class=" col-form-label">Password </label>
                                            <input v-model="bureauadminform.password" type="password" id="password" placeholder="Password"
                                                class="form-control" :class="{ 'is-invalid': bureauadminform.errors.has('password') }">
                                            <has-error :form="bureauadminform" field="password"></has-error>
                                        </div>
                                    </div>
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
        name:"Bureauadmins",
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
                        photo:'',
                }),
                url:'/api/bureauadmin/get',
                pagination:[],
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
            Users(){
                return this.$store.getters.BureauAdmins
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
                this.$Progress.start();
                return this.$store.dispatch( "bureauadmins", this.url)
                 .then((response)=>{
                     this.makingPagination(response.data.admins),
                    toast({
                     type: 'success',
                     title: 'Fetched the Bureaueadmin data successfully'
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
            fetchPaginatedBureauadmins(url){
                this.url = url;
                this.loadBureauadmins();
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
                            this.bureauadminform.fill(response.data.user)
                            this.bureauadminform.first_name = response.data.user.first_name;
                            this.bureauadminform.last_name = response.data.user.last_name;
                            this.bureauadminform.email = response.data.user.email;
                            this.bureauadminform.user_type = response.data.user.user_type;
                            this.bureauadminform.photo = response.data.user.bureauadmins[0].pivot.photo
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
                  this.$Progress.start();
                     this.bureauadminform.patch('/api/user/update/'+id)
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




