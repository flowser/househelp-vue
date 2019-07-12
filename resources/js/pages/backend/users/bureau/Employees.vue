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
                  <tr v-for="(user, index) in Users" :key="user.id">
                    <td >{{index+1}}</td>
                    <td style="width: 500px;">
                        <div class="row" style="width:100%" v-for="employee in user.bureauemployees" :key="employee.id">
                            <div class="col-sm-3" style="padding: 3px;">
                                 <img class="card-img-top" :src="bureauemployeeLoadPassPhoto(employee.pivot.photo)" style="width:100%" alt="Card image cap">
                            </div>
                            <div class="col-sm-9" style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                <div>{{user.full_name}},</div>
                                <div > Bureau
                                    <span style="color:#9a009a;">
                                        {{employee.name}},
                                    </span>
                                </div>
                                <div> ID: ,<span style="color:#9a009a;">{{employee.pivot.id_no}}</span>,
                                    Phone: <span style="color:#9a009a;">{{employee.pivot.phone}},</span>
                                </div>
                                <div>
                                     Mail: <span style="color:#9a009a;">{{user.email}},</span>
                                </div>
                                    <div>P. O. Box , <span style="color:#9a009a;">{{employee.pivot.address}}</span>,
                                    </div>
                                <div>
                                    <span style="color:#9a009a;">{{employee.ward_name}}</span> ward,
                                    <span style="color:#9a009a;">{{employee.constituency_name}}</span> constituency,
                                </div>
                                <div >
                                    <span style="color:#9a009a;">{{employee.county_name}}</span> county,
                                    <span style="color:#9a009a;">{{employee.country_name}},</span>
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
                                <a href=""  @click.prevent="editBureauemployeeModal(user.id)">
                                    <i class="fa fa-edit blue"></i>
                                </a>
                                /
                                <a href=""  @click.prevent="deleteBureauemployee(user.id)">
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
                                    <label for="first_name" class="col-form-label"> Bureauemployee Passport</label>
                                    <img v-show="editmodeBureauemployee" :src="updateBureauemployeePassPhoto(bureauemployeeform.photo)" alt="" width="100%" >
                                </div>
                                <div class="form-group col-md-8">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="first_name" class="col-form-label"> Bureauemployee First Name</label>
                                            <input v-model="bureauemployeeform.first_name" type="text" name="first_name" placeholder="Bureauemployee First Name"
                                                class="form-control" :class="{ 'is-invalid': bureauemployeeform.errors.has('first_name') }" >
                                            <has-error style="color: #e83e8c" :form="bureauemployeeform" field="first_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="last_name" class=" col-form-label">bureauemployee_Last Name </label>
                                            <input v-model="bureauemployeeform.last_name" type="bureauemployee_last_name" name="last_name" placeholder="Bureauemployee Last Name"
                                                class="form-control" :class="{ 'is-invalid': bureauemployeeform.errors.has('last_name') }" >
                                            <has-error style="color: #e83e8c" :form="bureauemployeeform" field="last_name"></has-error>
                                        </div>
                                    </div>
                                    <div class="row">
                                         <div class="form-group col-md-6">
                                            <label for="email" class=" col-form-label">Email </label>
                                            <input v-model="bureauemployeeform.email" type="email" name="email" placeholder="Email Address"
                                                class="form-control" :class="{ 'is-invalid': bureauemployeeform.errors.has('email') }" >
                                            <has-error style="color: #e83e8c" :form="bureauemployeeform" field="email"></has-error>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="password" class=" col-form-label">Password </label>
                                            <input v-model="bureauemployeeform.password" type="password" id="password" placeholder="Password"
                                                class="form-control" :class="{ 'is-invalid': bureauemployeeform.errors.has('password') }">
                                            <has-error :form="bureauemployeeform" field="password"></has-error>
                                        </div>
                                    </div>
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
                        photo:'',
                }),
                url:'/api/bureauemployee/get',
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
            Users(){
                return this.$store.getters.BureauEmployees
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
                return this.$store.dispatch( "bureauemployees", this.url)
                 .then((response)=>{
                     this.makingPagination(response.data.users),
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
                            this.bureauemployeeform.fill(response.data.user)
                            this.bureauemployeeform.first_name = response.data.user.first_name;
                            this.bureauemployeeform.last_name = response.data.user.last_name;
                            this.bureauemployeeform.email = response.data.user.email;
                            this.bureauemployeeform.user_type = response.data.user.user_type;
                            this.bureauemployeeform.photo = response.data.user.bureauemployees[0].pivot.photo
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
                  this.$Progress.start();
                     this.bureauemployeeform.patch('/api/user/update/'+id)
                        .then(()=>{
                            this.$store.dispatch( "bureauemployees", this.url)
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





