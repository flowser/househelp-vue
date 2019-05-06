<template>
    <div class="backend-Master">
        <!-- Navbar -->
            <TopHeader/>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
            <SideBar/>
        <!-- Main Sidebar Container -->

        <!-- Content Wrapper. Contains page content -->
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
            console.log('Component backend master.')
        }
    }
</script>
