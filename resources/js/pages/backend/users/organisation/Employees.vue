<template>
<div class="content-wrapper">
  <div class="container-fluid mt-5">
      <!-- Main content -->
    <section class="content">
      <div class="row justify-content-around">
        <div class="col-md">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Employees Table</h3>
              <div class="card-tools">
                    <button class="btn btn-success"  @click.prevent="newEmployeeModal()">Add New Employee
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
                    <th>Employee Details</th>
                    <th>Roles</th>
                    <th>Permissions</th>
                    <th style="padding-left: 14px">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(employee, index) in Employees" :key="employee.id">
                    <td >{{index+1}}</td>
                    <td style="width: 550px;">
                        <div class="row" style="width:100%" v-for="organisation in employee.organisationemployees" :key="organisation.id">
                            <div class="col-sm-3" style="padding: 3px;">
                                 <img class="card-img-top" :src="employeeLoadPassPhoto(organisation.pivot.photo)" style="width:100%" alt="Card image cap">
                            </div>
                            <div class="col-sm-3" style="padding: 3px;">
                                <img class="card-img-top" :src="employeeLoadIDFrontPhoto(organisation.pivot.id_photo_front)" style="width:100%" alt="Card image cap"><br>
                                <img class="card-img-top" :src="employeeLoadIDBackPhoto(organisation.pivot.id_photo_back)" style="width:100%" alt="Card image cap">
                            </div>
                            <div class="col-sm-6" style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                <div>{{employee.full_name}},</div>
                                <div v-for="position in employee.positions" :key="position.id">
                                    {{position.name}},
                                    <span style="color:#9a009a;">
                                        {{organisation.name}},
                                    </span>
                                </div>
                                <div> ID: ,<span style="color:#9a009a;">{{organisation.pivot.id_no}}</span>,
                                    Phone: <span style="color:#9a009a;">{{organisation.pivot.phone}},</span>
                                </div>
                                <div>
                                     Mail: <span style="color:#9a009a;">{{employee.email}},</span>
                                </div>
                                    <div>P. O. Box , <span style="color:#9a009a;">{{organisation.pivot.address}}</span>,
                                    </div>
                                <div v-for="ward in employee.wards" :key="ward.id">
                                    <span style="color:#9a009a;">{{ward.name}}</span> ward,
                                    <span v-for="constituency in employee.constituencies" :key="constituency.id" style="color:#9a009a;">
                                        {{constituency.name}}</span> constituency,
                                </div>
                                <div v-for="county in employee.counties" :key="county.id" >
                                    <span style="color:#9a009a;">{{county.name}}</span> county,
                                    <span v-for="country in employee.countries" :key="country.id" style="color:#9a009a;">
                                        {{country.name}},
                                    </span>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td style="padding: 3px;">
                        <span v-for="role in employee.roles" :key="role.id" class="pl-2">
                            <div class="btn btn-primary btn-sm ml-1 mb-2 " >{{role.name}} </div>
                        </span>
                    </td>
                    <td style="padding: 3px;">
                        <span v-for="permission in employee.permissions" :key="permission.id" class="pl-2">
                            <div class="btn btn-primary btn-sm ml-1 mb-2 ">{{permission.name}} </div>
                        </span>
                    </td>
                    <td style="padding: 3px;" >
                        <div class="clearfix" style="font-weight:bold;font-size:0.7em;">
                            <span class="float-left" style="margin-bottom:-0.5em" >
                                <div style="margin-bottom:0.25em"> Updated at:
                                    <span style="color:#9a009a;">{{employee.created_at | dateformat}} </span>
                                </div>
                            </span>
                            <span class="float-right">
                                <a href=""  @click.prevent="editEmployeeModal(employee.id)">
                                    <i class="fa fa-edit blue"></i>
                                </a>
                                /
                                <a href=""  @click.prevent="deleteEmployee(employee.id)">
                                    <i class="fa fa-trash red"></i>
                                </a>
                            </span>
                        </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div v-if="Employees.length" >
                    <div class="clearfix" style="font-weight:bold;font-size:0.7em;">
                        <span class="float-left" style="margin-bottom:-0.5em" >
                            <div style="margin-bottom:0.25em">
                                Between <span style="color:#9a009a;"> {{pagination.from}} </span>
                                & <span style="color:#9a009a;"> {{pagination.to}} </span>
                                out of <span style="color:#9a009a;"> {{pagination.total}} </span> Employees
                            </div>
                            <button class="btn btn-info" v-on:click="fetchPaginatedEmployees(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">Prev</button>
                        </span>
                        <span class="float-right" style="margin-bottom:-0.5em" >
                            <div style="margin-bottom:0.25em">
                                Page <span style="color:#9a009a;"> {{pagination.current_page}} </span>
                                of <span style="color:#9a009a;"> {{pagination.last_page}} </span>
                            </div>
                            <button class="btn btn-info" v-on:click="fetchPaginatedEmployees(pagination.next_page_url)" :disabled="!pagination.next_page_url">Next</button>
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

    <div class="modal fade " id="EmployeeModal" tabindex="-1" role="dialog" aria-labelledby="EmployeeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form role="form" @submit.prevent="editmodeEmployee ? updateEmployee(employeeform.id) : addEmployee()" >
                        <div class="modal-body">
                            <h5 class="modal-title" v-show="editmodeEmployee" id="EmployeeModalLabel">Update Employee</h5>
                            <h5 class="modal-title" v-show="!editmodeEmployee" id="EmployeeModalLabel">Add New Employee</h5>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="first_name" class="col-form-label"> Employee Passport</label>
                                    <img v-show="editmodeEmployee" :src="updateEmployeePassPhoto(employeeform.photo)" alt="" width="100%" >
                                </div>
                                <div class="form-group col-md-8">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="first_name" class="col-form-label"> Employee First Name</label>
                                            <input v-model="employeeform.first_name" type="text" name="first_name" placeholder="Employee First Name"
                                                class="form-control" :class="{ 'is-invalid': employeeform.errors.has('first_name') }" >
                                            <has-error style="color: #e83e8c" :form="employeeform" field="first_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="last_name" class=" col-form-label">employee_Last Name </label>
                                            <input v-model="employeeform.last_name" type="employee_last_name" name="last_name" placeholder="Employee Last Name"
                                                class="form-control" :class="{ 'is-invalid': employeeform.errors.has('last_name') }" >
                                            <has-error style="color: #e83e8c" :form="employeeform" field="last_name"></has-error>
                                        </div>
                                    </div>
                                    <div class="row">
                                         <div class="form-group col-md-6">
                                            <label for="email" class=" col-form-label">Email </label>
                                            <input v-model="employeeform.email" type="email" name="email" placeholder="Email Address"
                                                class="form-control" :class="{ 'is-invalid': employeeform.errors.has('email') }" >
                                            <has-error style="color: #e83e8c" :form="employeeform" field="email"></has-error>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="password" class=" col-form-label">Password </label>
                                            <input v-model="employeeform.password" type="password" id="password" placeholder="Password"
                                                class="form-control" :class="{ 'is-invalid': employeeform.errors.has('password') }">
                                            <has-error :form="employeeform" field="password"></has-error>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editmodeEmployee" type="submit" class="btn btn-success">Update</button>
                            <button v-show="!editmodeEmployee" type="submit" class="btn btn-primary">Create</button>
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
        name:"Organisation-Employees",
        data(){
            return{
                newEmployee: false,
                editmodeEmployee: false,
                employeeform: new Form({
                        id:'',
                        first_name:'',
                        last_name:'',
                        email:'',
                        password:'',
                        user_type:'',
                        photo:'',
                }),
                url:'/api/orgemployee/get',
                pagination:[],
            }
        },
        mounted() {
            this.loadCountries();
            this.loadCounties();
            this.loadConstituencies();
            this.loadWards();
            this.loadGenders();
            this.loadEmployees();
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
            Employees(){
                return this.$store.getters.Employees
            },

        },
        methods:{
            //employee
            InputPhone({ number, isValid, country }) {
            this.employeeform.phone = number;
            this.phone.isValid = isValid;
            this.phone.country = country && country.name;
            },
            InputLandline({ number, isValid, country }) {
            this.employeeform.landline = number;
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
            loadEmployees(){
                this.$Progress.start();
                return this.$store.dispatch( "employees", this.url)
                 .then((response)=>{
                     this.makingPagination(response.data.employees),
                    toast({
                     type: 'success',
                     title: 'Fetched the Employee data successfully'
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
            fetchPaginatedEmployees(url){
                this.url = url;
                this.loadEmployees();
            },
            newEmployeeModal(){
                 this.editmodeEmployee= false;
                 this.employeeform.reset()
                     $('#EmployeeModal').modal('show')
            },
            employeeLoadPassPhoto(employeepivot_photo){
                console.log(employeepivot_photo)
                if(employeepivot_photo){
                    return "/assets/organisation/img/employees/passports/"+employeepivot_photo;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            //employee passport photo
            employeeChangePassPhoto(event){
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
                            this.employeeform.photo =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateEmployeePassPhoto(organisationemployee_photo){
                console.log(organisationemployee_photo, 'edit')
                let img = this.employeeform.photo;
                      if(img ==null){
                          return "/assets/organisation/img/website/empty.png";
                        //  console.log('its reall null')
                      }else{
                          if(img.length>100){
                            return this.employeeform.photo;
                        }else{
                            if(organisationemployee_photo){
                                return "/assets/organisation/img/employees/passports/"+organisationemployee_photo;
                            }else{
                                return "/assets/organisation/img/website/empty.png";
                            }
                        }
                      }

            },
            employeeLoadIDFrontPhoto(employeepivot_id_photo_front){
                if(employeepivot_id_photo_front){
                    return "/assets/organisation/img/employees/IDs/front/"+employeepivot_id_photo_front;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            employeeChangeIDFrontPhoto(event){
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
                            this.employeeform.id_photo_front =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateEmployeeIDFrontPhoto(employeeform_id_photo_front){
                let img = this.employeeform.id_photo_front;
                      if(img ==null){
                          return "/assets/organisation/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.employeeform.id_photo_front;
                        }else{
                            if(employeeform_id_photo_front){
                                return "/assets/organisation/img/employees/IDs/front/"+employeeform_id_photo_front;
                            }else{
                                return "/assets/organisation/img/website/empty.png";
                            }
                        }
                      }

            },
            employeeLoadIDBackPhoto(employeeform_id_photo_back){
                if(employeeform_id_photo_back){
                    return "/assets/organisation/img/employees/IDs/back/"+employeeform_id_photo_back;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            employeeChangeIDBackPhoto(event){
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
                            this.employeeform.id_photo_back =event.target.result
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateEmployeeIDBackPhoto(employeeform_id_photo_back){
                let img = this.employeeform.id_photo_back;
                      if(img ==null){
                          return "/assets/organisation/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.employeeform.id_photo_back;
                        }else{
                            if(employeeform_id_photo_back){
                                return "/assets/organisation/img/employees/IDs/back/"+employeeform_id_photo_back;
                            }else{
                                return "/assets/organisation/img/website/empty.png";
                            }
                        }
                      }

            },

            editEmployeeModal(id){
                 this.editmodeEmployee = true;
                 this.employeeform.reset()
                    this.$Progress.start();
                      axios.get('/api/orgemployee/edit/'+id)
                        .then((response)=>{
                           $('#EmployeeModal').modal('show')
                           toast({
                            type: 'success',
                            title: 'Fetched the Employee data successfully'
                            })
                            this.employeeform.fill(response.data.user)
                            this.employeeform.first_name = response.data.user.first_name;
                            this.employeeform.last_name = response.data.user.last_name;
                            this.employeeform.email = response.data.user.email;
                            this.employeeform.user_type = response.data.user.user_type;
                            this.employeeform.photo = response.data.user.organisationemployees[0].pivot.photo
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                            //errors
                            $('#EmployeeModal').modal('show');
                            toast({
                            type: 'error',
                            title: 'There was something Wrong'
                            })
                        })
            },
            addEmployee() {
                this.employeeform.user_type = "Organisation Employee";
                this.$Progress.start();
                this.employeeform.patch('/api/orgemployee')
                    .then((response)=>{
                        //  console.log(response.data)
                         toast({
                            type: 'success',
                            title: 'Employee Created successfully'
                            })
                            this.$store.dispatch( "employees")
                            this.employeeform.reset()
                            $('#EmployeeModal').modal('hide')
                              this.$Progress.finish()
                    })
                    .catch((response)=>{
                        this.$Progress.fail()
                        //errors
                        console.log(response,'response')
                            $('#EmployeeModal').modal('show');
                            toast({
                                type: 'error',
                                title: 'There was something wrong.'
                                })
                    })
            },
            updateEmployee(id){
                  console.log('update employee')
                  this.$Progress.start();
                     this.employeeform.patch('/api/user/update/'+id)
                        .then(()=>{
                            this.loadEmployees();
                         $('#EmployeeModal').modal('hide')
                         toast({
                            type: 'success',
                            title: 'Employee Created successfully'
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
            deleteEmployee(id){
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
                    //  console.log('delete employee', id)
                        this.$Progress.start();
                        this.employeeform.get('/orgemployee/delete/'+id)
                            .then(()=>{
                            toast({
                            type: 'success',
                            title: 'Employee Deleted successfully'
                            })
                            this.$store.dispatch( "employees")
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




