<template>
  <div class="container-fluid mt-5">
      <!-- Main content -->
    <section class="content">
      <div class="row justify-content-around">
        <div class="col-md">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Users Table</h3>
              <div class="card-tools">
                    <button class="btn btn-success"  @click.prevent="newUserModal()">Add New User
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
                    <th>users</th>
                    <th>Roles</th>
                    <th>Permissions</th>
                    <th>Date</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>

                  <tr v-for="(user, index) in Users" :key="user.id">
                    <td>{{index+1}}</td>
                    <td>{{user.full_name}}</td>
                    <td>
                        <span v-for="role in user.roles" :key="role.id" class="pl-2">
                            <div class="btn btn-primary btn-sm ml-1 mb-2 ">{{role.name}} </div>
                        </span>
                    </td>
                    <td>
                        <span v-for="permission in user.permissions" :key="permission.id" class="pl-2">
                            <div class="btn btn-primary btn-sm ml-1 mb-2 ">{{permission.name}} </div>
                        </span>
                    </td>
                    <!-- {{user.created_at | dateformat}} -->
                    <td>{{user.created_at | dateformat}} </td>
                    <td>
                         <a href="" @click.prevent="editUserModal(user.id)" >
                             <i class="fa fa-edit blue"></i>
                         </a>
                         /
                         <a href="" @click.prevent="deleteUser(user.id)">
                             <i class="fa fa-trash red"></i>
                         </a>
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
     <div class="modal fade" id="UserModal" tabindex="-1" role="dialog" aria-labelledby="UserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="editmodeUser" id="UserModalLabel">Update Organisation User</h5>
                    <h5 class="modal-title" v-show="!editmodeUser" id="UserModalLabel">Add New Organisation User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="form" @submit.prevent="editmodeUser ? updateUser(userform.id) : addUser ()" >
                    <div class="modal-body">
                        <!-- <div class="form-group">
                                <input v-model="userform.first_name" type="text" name="name" placeholder="Role Name"
                                    class="form-control" :class="{ 'is-invalid': userform.errors.has('name') }">
                                <has-error :form="userform" field="name"></has-error>
                        </div> -->
                        <div class=" row">
                            <div class="form-group col-md-6">
                                <label for="first_name" class="col-form-label"> First Name</label>
                                <input v-model="userform.first_name" type="text" name="first_name" placeholder="First Name"
                                    class="form-control" :class="{ 'is-invalid': userform.errors.has('first_name') }" >
                                <has-error :form="userform" field="first_name"></has-error>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="last_name" class=" col-form-label">Last Name</label>
                                <input v-model="userform.last_name" type="text" name="last_name" placeholder="Last Name"
                                    class="form-control" :class="{ 'is-invalid': userform.errors.has('last_name') }" >
                                <has-error :form="userform" field="last_name"></has-error>
                            </div>
                        </div>

                        <div class=" row">
                                <div class="form-group col-md-12">
                                    <label for="email" class="col-form-label">E-Mail Address</label>
                                    <input v-model="userform.email" type="email" name="email" placeholder="E-Mail Address"
                                    class="form-control" :class="{ 'is-invalid': userform.errors.has('email') }" >
                                <has-error :form="userform" field="email"></has-error>
                                </div>
                        </div>
                        <div class=" row">
                            <div class="form-group col-md-6">
                                <select name="user_type" v-model="userform.user_type" id="user_type" class="form-control"
                                :class="{ 'is-invalid': userform.errors.has('user_type') }">
                                    <option value="">Select User Role</option>
                                    <option value="Director">Director</option>
                                    <option value="Admin"> Admin</option>
                                    <option value="Accounts"> Accounts</option>
                                </select>
                                <has-error :form="userform" field="user_type"></has-error>
                            </div>
                            <div class="form-group col-md-6">
                                <input v-model="userform.password" type="password" id="password" placeholder="Password"
                                    class="form-control" :class="{ 'is-invalid': userform.errors.has('password') }">
                                <has-error :form="userform" field="password"></has-error>
                            </div>
                        </div>


                        <div class="form-group">
                            <!-- Roles -->
                            <label>Select Roles</label>
                            <div v-for="role in Roles" :key="role.id">
                                <input type="checkbox" v-model="userform.roles" :value="role.name">{{ role.name}}
                            </div>
                            <hr>
                            <div> <span class="btn btn-info btn-sm ml-2 mb-2">{{ userform.roles }}</span></div>

                        </div>
                        <div class="form-group">
                            <!-- {{ Permissions }} -->
                            <label>Select Permissions</label>
                            <div v-for="permission in Permissions" :key="permission.id">
                                <input type="checkbox" v-model="userform.permissions" :value="permission.name"/>{{ permission.name}}
                            </div>
                            <hr>
                            <div> <span class="btn btn-info btn-sm ml-2 mb-2">{{ userform.permissions }}</span></div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button v-show="editmodeUser" type="submit" class="btn btn-success">Update</button>
                        <button v-show="!editmodeUser" type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


  </div>

</template>


<script>
    export default {
        name:"List",
        data(){
            return{
                editmodeUser: false,
                userform: new Form({
                        id:'',
                        first_name:'',
                        last_name:'',
                        email:'',
                        password:'',
                        user_type:'',
                        permissions:[],
                        roles:[],
                }),
                selected_permissions: [],
                selected_roles: [],
            }
        },
        mounted() {
            this.loadUsers();
            this.loadRoles();
            this.loadPermissions();
        },
        computed:{
            Users(){
                //  console.log('edit permiion')
                return this.$store.getters.Users
            },
            Permissions(){
                return this.$store.getters.Permissions
            },
            Roles(){
                return this.$store.getters.Roles
            },
            selectedRoles () {
            return this.selected_roles
            },
            selectedPermissions () {
            return this.selected_permissions
            }
        },
        methods:{
            loadUsers(){
                return this.$store.dispatch( "users")//get all from users.index
            },
            //Permissions
            loadPermissions(){
                return this.$store.dispatch( "permissions")//get all from roles.index
            },
            //Roles
            loadRoles(){
                return this.$store.dispatch( "roles")//get all from roles.index
            },
            newUserModal(){
                console.log('new user modal')
                 this.editmodeUser= false;
                 this.userform.reset()
                     $('#UserModal').modal('show')
             },
             editUserModal(id){
                 this.editmodeUser = true;
                 this.userform.reset()
                   console.log('edit user', id)
                    this.$Progress.start();
                      axios.get('/user/edit/'+id)
                        .then((response)=>{
                           $('#UserModal').modal('show')
                           toast({
                            type: 'success',
                            title: 'Fetched the User data successfully'
                            })
                            this.userform.fill(response.data.user)
                               this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                            //errors
                            $('#UserModal').modal('show');
                            toast({
                            type: 'error',
                            title: 'There was something Wrong'
                            })
                        })
             },
            addUser() {
                console.log('add user new')
                this.$Progress.start();
                this.userform.post('/user')
                    .then((response)=>{
                        //  console.log(response.data)
                         toast({
                            type: 'success',
                            title: 'User Created successfully'
                            })
                            this.$store.dispatch( "users")
                            $('#UserModal').modal('hide')
                              this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        //errors
                            $('#UserModal').modal('show');
                            toast({
                                type: 'error',
                                title: 'There was something wrong.'
                                })
                    })
            },
            updateUser(id){
                  console.log('update user')
                  this.$Progress.start();
                     this.userform.patch('/user/update/'+id)
                        .then(()=>{
                            this.$store.dispatch( "users")
                         $('#UserModal').modal('hide')
                         toast({
                            type: 'success',
                            title: 'User Created successfully'
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
            deleteUser(id){
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
                    //  console.log('delete user', id)
                        this.$Progress.start();
                        this.userform.get('/user/delete/'+id)
                            .then(()=>{
                            toast({
                            type: 'success',
                            title: 'User Deleted successfully'
                            })
                            this.$store.dispatch( "users")
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

