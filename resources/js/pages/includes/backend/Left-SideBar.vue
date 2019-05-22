<template>
    <div class="backend-left-sidebar">
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <div v-if="User.organisationdirector" >
                <a  href="" class="brand-link">
                    <img :src="organisationLoadImage(User.organisationdirector.organisation_logo)" alt="organisation logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">{{User.organisationdirector.organisation_name}}</span>
                </a>
            </div>
            <div v-else-if="User.organisationadmin">
                <a href="" class="brand-link">
                    <img :src="organisationLoadImage(User.organisationadmin.organisation_logo)" alt="organisation logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">{{User.organisationadmin.organisation_name}}</span>
                </a>
            </div>
            <div v-else-if="User.organisationemployee">
                <a href="" class="brand-link">
                    <img :src="organisationLoadImage(User.organisationemployee.organisation_logo)" alt="organisation logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">{{User.organisationemployee.organisation_name}}</span>
                </a>
            </div>
            <div v-else-if="User.bureaudirector">
                <a href="" class="brand-link">
                    <img :src="bureauLoadImage(User.bureaudirector.bureau_logo)" alt="organisation logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">{{User.bureaudirector.bureau_name}}</span>
                </a>
            </div>
            <div v-else-if="User.bureauadmin">
                <a href="" class="brand-link">
                    <img :src="bureauLoadImage(User.bureauadmin.bureau_logo)" alt="organisation logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">{{User.bureauadmin.bureau_name}}</span>
                </a>
            </div>
            <div v-else-if="User.bureauemployee">
                <a href="" class="brand-link">
                    <img :src="bureauLoadImage(User.bureauemployee.bureau_logo)" alt="organisation logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">{{User.bureauemployee.bureau_name}}</span>
                </a>
            </div>

            <!-- Sidebar -->
            <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div v-if="User.organisationdirector" >
                    <a href="" class="image">
                        <img :src="directorLoadPassPhoto(User.organisationdirector.photo)" class="img-circle elevation-2" alt="User Image">
                        <span  class="brand-text font-weight-light">{{User.full_name}}</span>
                    </a>
                </div>
                <div v-else-if="User.organisationadmin">
                     <a href="" class="image">
                        <img :src="adminLoadPassPhoto(User.organisationadmin.photo)" class="img-circle elevation-2" alt="User Image">
                       <span class="brand-text font-weight-light">{{User.full_name}}</span>
                    </a>
                </div>
                <div v-else-if="User.organisationemployee">
                     <a href="" class="image">
                        <img :src="employeeLoadPassPhoto(User.organisationemployee.photo)" class="img-circle elevation-2" alt="User Image">
                       <span class="brand-text font-weight-light">{{User.full_name}}</span>
                    </a>
                </div>
                <div v-else-if="User.bureaudirector">
                     <a href="" class="image">
                        <img :src="bureaudirectorLoadPassPhoto(User.bureaudirector.photo)" class="img-circle elevation-2" alt="User Image">
                       <span class="brand-text font-weight-light">{{User.full_name}}</span>
                    </a>
                </div>
                <div v-else-if="User.bureauadmin">
                     <a href="" class="image">
                        <img :src="bureauadminLoadPassPhoto(User.bureauadmin.photo)" class="img-circle elevation-2" alt="User Image">
                        <span class="brand-text font-weight-light">{{User.full_name}}</span>
                    </a>
                </div>
                <div v-else-if="User.bureauemployee">
                     <a href="" class="image">
                        <img :src="bureauemployeeLoadPassPhoto(User.bureauemployee.photo)" class="img-circle elevation-2" alt="User Image">
                        <span class="brand-text font-weight-light">{{User.full_name}}</span>
                    </a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li v-if="$hasrole(['Superadmin','Director','Admin', 'Employee', 'Accountant'])" class="nav-item">
                    <router-link :to="`/B/dashboard`" class="nav-link active">
                        <i class="fa fa-circle-o purple nav-icon"></i>
                        <p>Dashboard</p>
                    </router-link>
                </li>
                <li v-if="$hasrole(['Bureau Director','Bureau Admin','Bureau Employee','Bureau Accountant'])" class="nav-item">
                    <router-link :to="`/B/bureau/dashboard`" class="nav-link active">
                        <i class="fa fa-circle-o purple nav-icon"></i>
                        <p>Dashboard</p>
                    </router-link>
                </li>
                    <!-- Superadmin -->
                <li v-if="$hasrole('Superadmin')" class="nav-item has-treeview">
                    <router-link :to="`/B/mails`" class="nav-link" title="Mails">
                        <i class="nav-icon purple fa fa-envelope-o"></i>
                        <p>Mailsbox</p>
                    </router-link>
                </li>
                <!-- own email box -->
                <li class="nav-item has-treeview">
                    <router-link :to="`/B/mail`" class="nav-link" title="Mails">
                        <i class="nav-icon purple fa fa-envelope-o"></i>
                        <p>Mailbox</p>
                    </router-link>
                </li>

                <!-- {{--  organisation View  --}} -->
                 <li  v-if="$hasrole(['Superadmin', 'Director', 'Admin'])" class="nav-item has-treeview">
                    <router-link :to="`/B/bureaus`" class="nav-link">
                        <i class="nav-icon purple fas fa-users"></i>
                        <p >
                                Bureaus
                        </p>
                    </router-link>
                </li>
                <li  v-if="$hasrole('Superadmin')" class="nav-item has-treeview">
                    <router-link :to="`/B/househelps`" class="nav-link">
                        <i class="nav-icon purple fas fa-users"></i>
                        <p >
                                Househelps
                        </p>
                    </router-link>
                </li>
                <!-- {{--  bureau View  --}} -->
                <li v-if="$hasrole(['Bureau Director','Bureau Admin','Bureau Employee','Bureau Accountant'])"
                      class="nav-item has-treeview">
                    <router-link :to="`/B/bureau/househelps`" class="nav-link">
                            <i class="nav-icon purple fas fa-users"></i>
                        <p>
                            Househelps
                        </p>
                    </router-link>
                </li>
                <li   v-if="$hasrole(['Bureau Director','Bureau Admin'])" class="nav-item has-treeview">
                    <router-link :to="`/B/bureau/searchorders`" class="nav-link">
                    <i class="nav-icon purple fas fa-school"></i>
                    <p>
                        Search Orders
                    </p>
                    </router-link>
                </li>
                <li v-if="$hasrole(['Bureau Director','Bureau Admin'])" class="nav-item has-treeview">
                    <router-link :to="`/B/bureau/househelps/reviews`" class="nav-link">
                        <i class="nav-icon purple fas fa-school"></i>
                        <p>
                            Househelp Reviews
                        </p>
                    </router-link>
                </li>
                <!-- {{--  Househelp adminstrator  --}} -->
                <li v-if="$hasrole(['Superadmin','Director','Admin'])" class="nav-item has-treeview">
                    <a href="" class="nav-link">
                        <i class="nav-icon purple fas fa-user"></i>
                        <p>
                            Adminstrator
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link :to="`/B/househelps/reviews`" class="nav-link">
                            <i class="fas fa-book purple nav-icon"></i>
                            <p>Househelps Reviews</p>
                            </router-link>
                        </li>
                    </ul>
                </li>

                <!-- {{--  accounts  --}} -->
                <li v-if="$hasrole(['Superadmin','Director','Admin','Accountant'])" class="nav-item has-treeview">
                    <a href="" class="nav-link">
                         <i class="nav-icon purple fa fa-book"></i>
                    <p>
                        Accounts
                        <i class="fa fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <router-link :to="`/B/searchorders`" class="nav-link">
                        <i class="fas fa-certificate green nav-icon"></i>
                        <!-- {{-- payment succsfull from the clients search --}} -->
                        <p>Payment Recieved</p>
                        </router-link>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>Expenses</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/examples/login.html" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>Transfers</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/examples/register.html" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>Transaction Report</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/examples/lockscreen.html" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>Balance Sheet</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/examples/lockscreen.html" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>Bank & Cash</p>
                        </a>
                    </li> -->
                    </ul>
                </li>
                <!-- {{--  human Resource  --}} -->
                <!-- <li class="nav-item has-treeview">
                    <a href="" class="nav-link">
                    <i class="nav-icon purple fa fa-book"></i>
                    <p>
                        Human Resource
                        <i class="fa fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>Jobs</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>Opportunities</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">
                        <p>Payroll
                            <i class="fa fa-angle-left right"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/examples/invoice.html" class="nav-link">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p>Salary Template</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/invoice.html" class="nav-link">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p>Affiliate Payment Template</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/invoice.html" class="nav-link">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p>Hourly Template</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/invoice.html" class="nav-link">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p>Afiliates Template</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/invoice.html" class="nav-link">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p>Salary List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/invoice.html" class="nav-link">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p>Make Payment</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/invoice.html" class="nav-link">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p>Payroll Summary</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/invoice.html" class="nav-link">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p>Advance Salary</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/invoice.html" class="nav-link">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p>Over Time</p>
                            </a>
                        </li>
                        </ul>
                    </li>
                    </ul>
                </li> -->
                <!-- {{-- Reports --}} -->
                <!-- <li class="nav-item has-treeview">
                    <a href="" class="nav-link">
                    <i class="nav-icon purple fa fa-book"></i>
                    <p>
                        Reports
                        <i class="fa fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>Orders</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                            <a href="pages/examples/invoice.html" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Orders Report</p>
                            </a>
                            </li>
                            <li class="nav-item">
                            <a href="pages/examples/invoice.html" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Clients Report</p>
                            </a>
                            </li>
                            <li class="nav-item">
                            <a href="pages/examples/invoice.html" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <!-- {{-- innovation projects --}} -->
                                <!-- <p>Househelps Report</p>
                            </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>Accounts</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                            <a href="pages/examples/invoice.html" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Accounts Statement</p>
                            </a>
                            </li>
                            <li class="nav-item">
                            <a href="pages/examples/invoice.html" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Transfer Report</p>
                            </a>
                            </li>
                            <li class="nav-item">
                            <a href="pages/examples/invoice.html" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Income Report</p>
                            </a>
                            </li>
                            <li class="nav-item">
                            <a href="pages/examples/invoice.html" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Expense Report</p>
                            </a>
                            </li>
                            <li class="nav-item">
                            <a href="pages/examples/invoice.html" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Income vs Expense Report</p>
                            </a>
                            </li>
                            <li class="nav-item">
                            <a href="pages/examples/invoice.html" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Report By Date</p>
                            </a>
                            </li>
                            <li class="nav-item">
                            <a href="pages/examples/invoice.html" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Report By Month</p>
                            </a>
                            </li>
                            <li class="nav-item">
                            <a href="pages/examples/invoice.html" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>All Income Report</p>
                            </a>
                            </li>
                            <li class="nav-item">
                            <a href="pages/examples/invoice.html" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>All Expense Report</p>
                            </a>
                            </li>
                            <li class="nav-item">
                            <a href="pages/examples/invoice.html" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>All Transaction Report</p>
                            </a>
                            </li>
                        </ul>
                    </li>
                    </ul> -->
                <!-- </li> -->
                <!-- {{--  Superadmin users  --}} -->
                <li v-if="$hasrole(['Superadmin'])" class="nav-item has-treeview">
                    <a href="" class="nav-link">
                    <i class="nav-icon purple fas fa-users"></i>
                    <p>
                        Users Logins
                        <i class="fa fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link :to="`/B/directors/credentials`" class="nav-link">
                            <i class="fas fa-users red fas fa-users"></i>
                            <p>Directors</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="`/B/admins/credentials`" class="nav-link">
                            <i class="fas fa-users blue fas fa-users"></i>
                            <p>Admins</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="`/B/employees/credentials`" class="nav-link">
                            <i class="fas fa-users purple fas fa-users"></i>
                            <p>Other Employees</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="`/B/affiliates/credentials`" class="nav-link">
                            <i class="fas fa-users yellow fas fa-users"></i>
                            <p>Affiliates</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="`/B/Bdirectors/credentials`" class="nav-link">
                            <i class="fas fa-users red fas fa-users"></i>
                            <p>Bureau Directors</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="`/B/Badmins/credentials`" class="nav-link">
                            <i class="fas fa-users blue fas fa-users"></i>
                            <p>Bureau Admins</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="`/B/Bemployees/credentials`" class="nav-link">
                            <i class="fas fa-users purple fas fa-users"></i>
                            <p>Bureau Other Employees</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="`/B/Bhousehelps/credentials`" class="nav-link">
                            <i class="fas fa-users yellow fas fa-users"></i>
                            <p>Househelps</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="`/B/clients/credentials`" class="nav-link">
                            <i class="fas fa-users yellow fas fa-users"></i>
                            <p>Clients</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="`/B/users/credentials`" class="nav-link">
                                  <i class="fas fa-users yellow fas fa-users"></i>
                                  <p>All Users</p>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li v-if="$hasrole(['Bureau Director','Bureau Admin'])" class="nav-item has-treeview">
                        <a href="" class="nav-link">
                            <i class="nav-icon purple fas fa-users"></i>
                            <p>
                                Users Logins
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                    <ul class="nav nav-treeview">
                        <!-- {{--  bureau  their view --}} -->
                        <li class="nav-item">
                            <router-link :to="`/B/bureau/directors/credentials`" class="nav-link">
                            <i class="fas fa-users red fas fa-users"></i>
                            <p>Directors</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="`/B/bureau/admins/credentials`" class="nav-link">
                            <i class="fas fa-users blue fas fa-users"></i>
                            <p>Admins</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="`/B/bureau/employees/credentials`" class="nav-link">
                            <i class="fas fa-users purple fas fa-users"></i>
                            <p>Other Employees</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="`/B/bureau/househelps/credentials`" class="nav-link">
                            <i class="fas fa-users yellow fas fa-users"></i>
                            <p>Househelps</p>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li v-if="$hasrole(['Bureau Director','Bureau Admin'])" class="nav-item has-treeview">
                    <router-link :to="`/B/bureau/settings`" class="nav-link">
                        <i class="fa fa-circle-o purple nav-icon"></i>
                        <p>Settings</p>
                    </router-link>
                </li>
                <!-- {{--Organisation settings --}} -->
                <li v-if="$hasrole(['Superadmin','Director'])"
                           class="nav-item has-treeview">
                    <router-link :to="`/B/settings`" class="nav-link">
                    <i class="fa fa-circle-o purple nav-icon"></i>
                    <p>Settings</p>
                    </router-link>
                </li>
              </ul>
            </nav>
            <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
    </div>
</template>

<script>
export default {
    name:"backend-left-sidebar",
     mounted() {
          this.fetchUser();

     },
     computed:{
            Organisation(){
               return this.$store.getters.Organisation
            },
            User(){
                return this.$store.getters.LoggedUser
            },
     },
     methods:{
         fetchUser(){
                this.$store.dispatch('getUserRoles')
            },
            organisationLoadImage(organisation_logo){
                if(organisation_logo){
                    return "/assets/organisation/img/logo/"+organisation_logo;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            bureauLoadImage(bureau_logo){
                if(bureau_logo){
                    return "/assets/bureau/img/logo/"+bureau_logo;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            //organisation
            directorLoadPassPhoto(director_photo){
                if(director_photo){
                    return "/assets/organisation/img/directors/passports/"+director_photo;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            adminLoadPassPhoto(admin_photo){
                if(admin_photo){
                    return "/assets/organisation/img/admins/passports/"+admin_photo;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            employeeLoadPassPhoto(employee_photo){
                if(employee_photo){
                    return "/assets/organisation/img/employees/passports/"+employee_photo;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            //bureau
            bureaudirectorLoadPassPhoto(bureaudirector_photo){
                if(bureaudirector_photo){
                    return "/assets/bureau/img/directors/passports/"+bureaudirector_photo;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            bureauadminLoadPassPhoto(bureauadmin_photo){
                if(bureauadmin_photo){
                    return "/assets/bureau/img/admins/passports/"+bureauadmin_photo;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            bureauemployeeLoadPassPhoto(bureauemployee_photo){
                if(bureauemployee_photo){
                    return "/assets/bureau/img/employees/passports/"+bureauemployee_photo;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },

     },



}
</script>

<style>

</style>
