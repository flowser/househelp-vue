<template>
<div class="content-wrapper">
  <div class="container-fluid mt-5">
      <!-- Main content -->
    <section class="content">
      <div class="row justify-content-around">
        <div class="col-md">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Bureau Directors Table</h3>
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
                    <th>Bureaudirector Details</th>
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
                            <div class="col-sm-9" style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                <div>{{user.full_name}},</div>
                                <div>
                                     Bureau: <span style="color:#9a009a;">{{director.name}},</span>
                                </div>
                                <div> ID: ,<span style="color:#9a009a;">{{director.pivot.id_no}}</span>,
                                    Phone: <span style="color:#9a009a;">{{director.pivot.phone}},</span>
                                </div>
                                <div>
                                     Mail: <span style="color:#9a009a;">{{user.email}},</span>
                                </div>
                                    <div>P. O. Box , <span style="color:#9a009a;">{{director.pivot.address}}</span>,
                                    </div>

                                <div>
                                    <span style="color:#9a009a;">{{director.ward_name}}</span> ward,
                                    <span style="color:#9a009a;">{{director.constituency_name}}</span> constituency,
                                </div>
                                <div >
                                    <span style="color:#9a009a;">{{director.county_name}}</span> county,
                                    <span style="color:#9a009a;">{{director.country_name}},</span>
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
                                <a href=""  @click.prevent="editBureaudirectorModal(user.id)">
                                    <i class="fa fa-edit blue"></i>
                                </a>
                                /
                                <a href=""  @click.prevent="deleteBureaudirector(user.id)">
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
                                   out of <span style="color:#9a009a;"> {{Pagination.total}} </span> Bureaudirectors
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
                                    <label for="first_name" class="col-form-label"> Bureaudirector Passport</label>
                                    <img v-show="editmodeBureaudirector" :src="updateBureaudirectorPassPhoto(bureaudirectorform.photo)" alt="" width="100%" >
                                </div>
                                <div class="form-group col-md-8">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="first_name" class="col-form-label"> Bureaudirector First Name</label>
                                            <input v-model="bureaudirectorform.first_name" type="text" name="first_name" placeholder="Bureaudirector First Name"
                                                class="form-control" :class="{ 'is-invalid': bureaudirectorform.errors.has('first_name') }" >
                                            <has-error style="color: #e83e8c" :form="bureaudirectorform" field="first_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="last_name" class=" col-form-label">Bureaudirector Last Name </label>
                                            <input v-model="bureaudirectorform.last_name" type="bureaudirector_last_name" name="last_name" placeholder="Bureaudirector Last Name"
                                                class="form-control" :class="{ 'is-invalid': bureaudirectorform.errors.has('last_name') }" >
                                            <has-error style="color: #e83e8c" :form="bureaudirectorform" field="last_name"></has-error>
                                        </div>
                                    </div>
                                    <div class="row">
                                         <div class="form-group col-md-6">
                                            <label for="email" class=" col-form-label">Email </label>
                                            <input v-model="bureaudirectorform.email" type="email" name="email" placeholder="Email Address"
                                                class="form-control" :class="{ 'is-invalid': bureaudirectorform.errors.has('email') }" >
                                            <has-error style="color: #e83e8c" :form="bureaudirectorform" field="email"></has-error>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="password" class=" col-form-label">Password </label>
                                            <input v-model="bureaudirectorform.password" type="password" id="password" placeholder="Password"
                                                class="form-control" :class="{ 'is-invalid': bureaudirectorform.errors.has('password') }">
                                            <has-error :form="bureaudirectorform" field="password"></has-error>
                                        </div>
                                    </div>
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
        name:"Organisation-Bureaudirectors",
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
                        photo:'',
                }),
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
            }

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
                    title: 'There was something Wrong'
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
                            this.bureaudirectorform.fill(response.data.user)
                            this.bureaudirectorform.first_name = response.data.user.first_name;
                            this.bureaudirectorform.last_name = response.data.user.last_name;
                            this.bureaudirectorform.email = response.data.user.email;
                            this.bureaudirectorform.user_type = response.data.user.user_type;
                            this.bureaudirectorform.photo = response.data.user.bureaudirectors[0].pivot.photo
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
                     this.bureaudirectorform.patch('/api/user/update/'+id)
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



