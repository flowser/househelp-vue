<template>
    <div class="backend-Master">
        <!-- Navbar -->
            <TopHeader/>

        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
            <SideBar/>
        <!-- Main Sidebar Container -->

        <!-- Content Wrapper. Contains page content -->
        {{loggedIn}},<br>
        {{LoggedUser}}
            <vue-progress-bar></vue-progress-bar>
            <router-view></router-view>
        <!-- /.content-wrapper -->

        <!-- /.footer -->
            <Footer/>
        <!-- /.footer -->
    </div>
</template>

<script>
import TopHeader from "../pages/includes/backend/Header-Top";
import SideBar from "../pages/includes/backend/Left-SideBar";
import Footer from "../pages/includes/backend/Footer";
    export default {
        name:"BackedMaster",
         components:{
            TopHeader,
            SideBar,
            Footer,
         },
        mounted() {
            console.log('Component backend master.');
             this.fetchAccessToken();
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
            LoggedUser(){
                return this.$store.getters.LoggedUser
            },
            loggedIn(){
                this.$store.getters.loggedIn
            },
            Permissions(){
                    return this.$store.getters.UserPermissions
            },
            Roles(){
                    return this.$store.getters.UserRoles
            }
        },
         methods:{
            fetchAccessToken(){
                this.$store.dispatch('fetchAccessToken')
            },
         }

    }
</script>
