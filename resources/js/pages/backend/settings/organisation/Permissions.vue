<template>
    <div class="container-fluid">
   <!-- Main content -->
    <section class="content">
      <div class="row justify-content-around mt-6">
        <div class="col-md">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Permissions Table</h3>
              <div class="card-tools">

                    <button class="btn btn-success"  @click.prevent="newPermissionModal()">Add New Permission
                         <i class="fas fa-plus fw"></i>
                     </button>
                  <!-- <router-link to="/add-permission" style="color:#ffff"> Add Permission</router-link> -->

              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>S1</th>
                    <th>Permission</th>
                    <th>Date</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(permission, index) in Permissions" :key="permission.id" >
                    <td>{{index+1}}</td>
                    <td>{{permission.name}}</td>
                    <td>{{permission.created_at | dateformat}}</td>

                    <td>
                         <a href="" @click.prevent="editPermissionModal(permission.id)">
                             <i class="fa fa-edit blue"></i>
                         </a>
                         /
                         <a href="" @click.prevent="deletePermission(permission.id)">
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
      </div>
      <div class="row justify-content-around mt-6">
        <div class="col-md">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Roles Table</h3>
              <div class="card-tools">
                    <button class="btn btn-success"  @click.prevent="newRoleModal()">Add New Role
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
                    <th>Ros</th>
                    <th>Permissions</th>
                    <th>Date</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>

                  <tr v-for="(role, index) in Roles" :key="role.id">
                    <td>{{index+1}}</td>
                    <td>{{role.name}}</td>
                    <td>
                        <span v-for="permission in role.permissions" :key="permission.id" class="pl-2">
                            <div class="btn btn-primary btn-sm ml-1 mb-2 ">{{permission.name}} </div>
                        </span>
                    </td>
                    <td>{{role.created_at | dateformat}}</td>
                    <td>
                         <a href="" @click.prevent="editRoleModal(role.id)" >
                             <i class="fa fa-edit blue"></i>
                         </a>
                         <router-link :to="`edit-role/${role.id}`" @click.prevent="editRoleModal(role.id)" >
                             <i class="fa fa-edit yellow"></i>
                         </router-link>
                         /
                         <a href="" @click.prevent="deleteRole(role.id)">
                             <i class="fa fa-trash red"></i>
                         </a>
                    </td>
                  </tr>
                  <!-- <tr v-for="(course, index) in getallCourse" :key="course.id">
                    <td>{{index+1}}</td>
                    <td v-if="course.user">{{course.user.name}}</td>
                    <td v-if="course.category">{{course.category.name}}</td>
                    <td>{{course.title | sortlength(20, "---")}}</td>
                    <td>{{course.description | sortlength(40, "....")}}</td>
                    <td><img :src="courseImage(course.photo)" alt="" width="150px"></td>
                    <td>
                         <router-link :to="`/edit-course/${course.id}`">Edit</router-link>
                         <a href="" @click.prevent="deleteCourse(course.id)">Delete</a>
                    </td>
                  </tr>               -->
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </section>

        <!-- Permission Modal -->
     <div class="modal fade" id="PermissionModal" tabindex="-1" role="dialog" aria-labelledby="PermissionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="editmodePermission" id="PermissionModalLabel">Uppdate Permission</h5>
                    <h5 class="modal-title" v-show="!editmodePermission" id="PermissionModalLabel">Add New Permission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form role="form" @submit.prevent="editmodePermission ? updatePermission(permissionform.id) : addPermission ()" >
                    <div class="modal-body">
                        <div class="form-group">
                            <input v-model="permissionform.name" type="text" name="name" placeholder="Permission Name"
                                class="form-control" :class="{ 'is-invalid': permissionform.errors.has('name') }">
                            <has-error :form="permissionform" field="name"></has-error>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button v-show="editmodePermission" type="submmit" class="btn btn-success">Update</button>
                        <button v-show="!editmodePermission" type="submmit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <!-- Role Modal -->
     <div class="modal fade" id="RoleModal" tabindex="-1" role="dialog" aria-labelledby="RoleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="editmodeRole" id="RoleModalLabel">Update Role</h5>
                    <h5 class="modal-title" v-show="!editmodeRole" id="RoleModalLabel">Add New Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="form" @submit.prevent="editmodeRole ? updateRole(roleform.id) : addRole ()" >
                    <div class="modal-body">
                        <div class="form-group">
                                <input v-model="roleform.name" type="text" name="name" placeholder="Role Name"
                                    class="form-control" :class="{ 'is-invalid': roleform.errors.has('name') }">
                                <has-error :form="roleform" field="name"></has-error>
                        </div>
                        <div class="form-group">
                            <div v-for="permission in Permissions" :key="permission.id">
                                <!-- <input type="checkbox" v-model="roleform.permission" :value="permission.name"/>{{ permission.name}} -->
                                <input type="checkbox"  v-model="roleform.permission" :value="permission.name"/>{{ permission.name}}
                            </div>
                            <hr>
                            <div> <span class="btn btn-info btn-sm ml-2 mb-2">{{ roleform.permission }}</span></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button v-show="editmodeRole" type="submit" class="btn btn-success">Update</button>
                        <button v-show="!editmodeRole" type="submit" class="btn btn-primary">Create</button>
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
                editmodePermission: false,
                permissionform: new Form({
                        id:'',
                        name:'',
                }),
                editmodeRole: false,
                roleform: new Form({
                        id:'',
                        name:'',
                        permission:[],
                }),
                checkedNames: [],
                selected: [],
            }
        },
        mounted() {
            this.loadRoles();
            this.loadPermissions();
            // this.editPermission();
        },
        computed:{
            Permissions(){

                return this.$store.getters.Permissions
            },
            Roles(){
                return this.$store.getters.Roles
            },
            checkedComputed () {
            return this.checkedNames
            }
        },
        methods:{
            //permissions
            loadPermissions(){
                return this.$store.dispatch("permissions")//get all from permision.index
            },
            newPermissionModal(){
                 this.editmodePermission = false;
                 this.permissionform.reset()
                     $('#PermissionModal').modal('show')
             },
             editPermissionModal(id){
                 this.editmodePermission = true;

                //  console.log('edit permiion', id)
                    this.$Progress.start();
                      axios.get('/permission/edit/'+id)
                        .then((response)=>{
                        // console.log(response.data)
                        this.permissionform.reset()
                           $('#PermissionModal').modal('show')
                             this.permissionform.fill(response.data.permission)
                                this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                        })
             },
            addPermission() {
                console.log('permision')

                this.$Progress.start();
                this.permissionform.post('/add-permission')
                    .then((response)=>{
                        // console.log(response.data.)
                        this.$store.dispatch( "roles")
                        this.$store.dispatch( "permissions")//like refresh
                         $('#PermissionModal').modal('hide') // <!--hide modael afterworks-->

                        this.$Progress.finish();
                    })

                    .catch((response)=>{
                            this.$Progress.fail()
                    })

            },
            updatePermission(id){
                  console.log('update perssion')
                  this.$Progress.start();
                     this.permissionform.patch('/permission/update/'+id)
                        .then((response)=>{
                             console.log(response.data)
                             this.permissionform.reset()
                            this.$store.dispatch( "roles")
                            this.$store.dispatch( "permissions")//like refresh
                            $('#PermissionModal').modal('hide')
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                        })
            },
            deletePermission(id){
                console.log('delete perssion', id)
                this.$Progress.start();
                     axios.get('/permission/delete/'+id)
                        .then(()=>{
                            this.$store.dispatch( "roles")
                            this.$store.dispatch( "permissions")//like refresh
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                        })
            },
            //Roles
            loadRoles(){
                return this.$store.dispatch( "roles")//get all from roles.index
            },
            newRoleModal(){
                 this.editmodeRole= false;
                 this.roleform.reset()
                     $('#RoleModal').modal('show')
             },
             editRoleModal(id){
                 this.editmodeRole = true;
                 this.roleform.reset()
                   console.log('edit role', id)
                    this.$Progress.start();
                      axios.get('/role/edit/'+id)
                        .then((response)=>{
                           $('#RoleModal').modal('show')
                            this.roleform.fill(response.data.role)
                               this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                        })
             },
            addRole() {
                console.log('Role')
                this.$Progress.start();
                this.roleform.post('/add-role')
                    .then((response)=>{
                         console.log(response.data)
                            this.$store.dispatch( "roles")
                            this.$store.dispatch( "permissions")//like refresh
                            //  this.$router.push('/role-list')
                            $('#RoleModal').modal('hide')
                              this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                    })
            },
            updateRole(id){
                  console.log('update role')
                  this.$Progress.start();
                     this.roleform.patch('/role/update/'+id)
                        .then(()=>{
                            this.$store.dispatch( "roles")
                            this.$store.dispatch( "permissions")//like refresh
                         $('#RoleModal').modal('hide')
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                        })
            },
            deleteRole(id){
                 console.log('delete role', id)
                 this.$Progress.start();
                    axios.get('/role/delete/'+id)
                        .then(()=>{
                            this.$store.dispatch( "roles")
                            this.$store.dispatch( "permissions")//like refresh
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                        })
            },
        },

    }
</script>
