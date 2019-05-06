<template>
    <div id="frond-master">
        <header id="header"><!--header-->
            <TopHeader/>
            <MiddleHeader/>
            <BottomHeader/>
        </header><!--/header-->

        <!-- content -->
            <vue-progress-bar></vue-progress-bar>
            <router-view></router-view>
        <!-- content -->

        <footer id="footer"><!--Footer-->
            <TopFooter/>
            <MiddleFooter/>
            <BottomFooter/>
        </footer><!--/Footer-->
    </div>
</template>

<script>
// import TopHeader from "../pages/includes/frontend/Top-Header.vue";
import TopHeader from "../pages/includes/frontend/Header-Top";
import MiddleHeader from "../pages/includes/frontend/Header-Middle";
import BottomHeader from "../pages/includes/frontend/Header-Bottom";
import TopFooter from "../pages/includes/frontend/Footer-Top";
import MiddleFooter from "../pages/includes/frontend/Footer-Widget";
import BottomFooter from "../pages/includes/frontend/Footer-Bottom";
    export default {
        name:"Front-Master",
        components:{
            TopHeader,
            MiddleHeader,
            BottomHeader,
            TopFooter,
            MiddleFooter,
            BottomFooter,
        },
        mounted() {
            console.log('Component frontend master.')
        }
    }
</script>
