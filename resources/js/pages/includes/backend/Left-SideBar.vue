<template>
    <div class="backend-left-sidebar">
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
            <!-- @if($organisation->logo != null) -->
                <img src="assets/organisation/img/logo/$organisation->logo" alt="$organisation->name"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <!-- @else/ -->
                <link rel="shortcut icon" type="image/ico" href="assets/organisation/img/website/empty.png"/>
            <!-- @endif -->
            <span class="brand-text font-weight-light">$organisation->name</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                <img src="themes/adminlte3/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <router-link :to="`/dashboard`" class="nav-link active">
                        <i class="fa fa-circle-o purple nav-icon"></i>
                        <p>Dashboard</p>
                    </router-link>
                </li>
                <li class="nav-item has-treeview">
                    <router-link :to="`/mails`" class="nav-link" title="Mails">
                        <i class="nav-icon purple fa fa-envelope-o"></i>
                        <p>Mailsbox</p>
                    </router-link>
                </li>
                <li class="nav-item has-treeview">
                    <router-link :to="`/mail`" class="nav-link" title="Mails">
                        <i class="nav-icon purple fa fa-envelope-o"></i>
                        <p>Mailbox</p>
                    </router-link>
                </li>

                <!-- {{--  users  --}} -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="nav-icon purple fas fa-users"></i>
                    <p>
                        Users Logins
                        <i class="fa fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <router-link :to="`/directors/credentials`" class="nav-link">
                        <i class="fas fa-users red fas fa-users"></i>
                        <p>Directors</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="`/admins/credentials`" class="nav-link">
                        <i class="fas fa-users blue fas fa-users"></i>
                        <p>Admins</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="`/employees/credentials`" class="nav-link">
                        <i class="fas fa-users purple fas fa-users"></i>
                        <p>Other Employees</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="`/affiliates/credentials`" class="nav-link">
                        <i class="fas fa-users yellow fas fa-users"></i>
                        <p>Affiliates</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="`/househelps/credentials`" class="nav-link">
                        <i class="fas fa-users yellow fas fa-users"></i>
                        <p>Househelps</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="`/clients/credentials`" class="nav-link">
                        <i class="fas fa-users yellow fas fa-users"></i>
                        <p>Clients</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="`/users/credentials`" class="nav-link">
                              <i class="fas fa-users yellow fas fa-users"></i>
                              <p>All Users</p>
                        </router-link>
                    </li>
                    <!-- {{--  bureau  their view --}} -->
                    <li class="nav-item">
                        <router-link :to="`/bureau/househelps/credentials`" class="nav-link">
                        <i class="fas fa-users yellow fas fa-users"></i>
                        <p>Househelps</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="`/bureau/admins/credentials`" class="nav-link">
                        <i class="fas fa-users blue fas fa-users"></i>
                        <p>Admins</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="`/bureau/employees/credentials`" class="nav-link">
                        <i class="fas fa-users purple fas fa-users"></i>
                        <p>Other Employees</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="`/bureau/directors/credentials`" class="nav-link">
                        <i class="fas fa-users red fas fa-users"></i>
                        <p>Directors</p>
                        </router-link>
                    </li>
                    </ul>
                </li>
                <!-- {{--  organisation View  --}} -->
                <li class="nav-item has-treeview">
                    <router-link :to="`/househelps`" class="nav-link">
                    <i class="nav-icon purple fas fa-users"></i>
                    <p>
                        Househelps Details
                    </p>
                    </router-link>
                </li>
                <!-- {{--  bureau View  --}} -->
                <li class="nav-item has-treeview">
                    <router-link :to="`/bureau/househelps`" class="nav-link">
                    <i class="nav-icon purple fas fa-users"></i>
                    <p>
                        Househelps Details bureau
                    </p>
                    </router-link>
                </li>
                <li class="nav-item has-treeview">
                    <router-link :to="`/bureau/searchorders`" class="nav-link">
                    <i class="nav-icon purple fas fa-school"></i>
                    <p>
                        Search Orders
                    </p>
                    </router-link>
                </li>
                <li class="nav-item has-treeview">
                    <router-link :to="`/bureau/househelps/reviews`" class="nav-link">
                    <i class="nav-icon purple fas fa-school"></i>
                    <p>
                        Househelp Reviews
                    </p>
                    </router-link>
                </li>
                <li class="nav-item has-treeview">
                    <router-link :to="`/bureau/settings`" class="nav-link">
                    <i class="fa fa-circle-o purple nav-icon"></i>
                    <p>Settings</p>
                    </router-link>
                </li>

                <!-- {{--  Househelp adminstrator  --}} -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="nav-icon purple fas fa-user"></i>
                    <p>
                        Adminstrator
                        <i class="fa fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <router-link :to="`/househelps/reviews`" class="nav-link">
                        <i class="fas fa-book purple nav-icon"></i>
                        <p>Househelps Reviews</p>
                        </router-link>
                    </li>
                    </ul>
                </li>

                <!-- {{--  accounts  --}} -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="nav-icon purple fa fa-book"></i>
                    <p>
                        Accounts
                        <i class="fa fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <router-link :to="`/searchorders`" class="nav-link">
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
                    <a href="#" class="nav-link">
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
                    <a href="#" class="nav-link">
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
                <!-- {{--Organisation settings --}} -->
                <li class="nav-item has-treeview">
                    <router-link :to="`/settings`" class="nav-link">
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
           console.log('backend-left-sidebar');
        },

}
</script>

<style>

</style>
