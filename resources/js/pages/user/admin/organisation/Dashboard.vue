<template>
    <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v2</li>
                        </ol>
                    </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
       <div class="container-fluid">
           <!-- Small boxes (Stat box) -->
           <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner" >
                                    <h3>{{BureauPagination.total}}</h3>
                                    <p>Bureaus </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <router-link :to="`/B/bureaus`" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </router-link>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner" >
                                    <h3>{{AllPagination.total}}</h3>
                                    <p>Househelps </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <router-link :to="`/B/househelps`" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </router-link>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner" >
                                    <h3 >{{ReviewPagination.total}}</h3>
                                    <p>Reviews</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <router-link :to="`/B/househelps/reviews`" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </router-link>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner" >
                                    <h3 >Bureau.bureauadmins.length</h3>
                                    <p>Admins </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <router-link :to="`/B/clients`" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </router-link>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <!-- <div class="inner" v-if="Bureau.bureauemployees">
                                    <h3>{{Bureau.bureauemployees.length}}</h3>
                                    <p>Employees </p>
                                </div> -->
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <!-- <a href="" class="small-box-footer"  @click.prevent="EmployeesModal()"> -->
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <!-- ./col -->
           </div>
       </div>
   </section>
            <!-- /.content -->
        </div>
</template>

<script>

export default {

    name:"Organisation-Dashboard",
     data(){
            return{
                Unemployed:'',
                Employed:'',
                Pending:'',
                Status:'',
                employmentstatus:false,
                hirestatus:false,
                urlform: new Form({
                    bureau_id:'',
                          url:'/api/househelp/get/unemployed/',
                       allurl:'/api/househelp/get/list/',//all houshelps without emploeyment or anything
                unemployedurl:'/api/househelp/get/unemployed/',
                  employedurl:'/api/househelp/get/employed/',
                   pendingurl:'/api/househelp/get/pending/',
                    bureauurl:'/api/bureaus/get/',
                    reviewurl:'/api/review/get/',
                }),
            }
        },
        mounted() {
            console.log('Organisation Dashboard');
            this.loadBureaus();
            this.allhousehelps(); //from methods
            this.getUnemployedHousehelps(); //from methods
            this.loadreviews();

        },
        computed:{
            Househelps(){
               return this.$store.getters.HousehelpsList
            },
            AllHousehelps(){
               return this.$store.getters.AllHousehelps
            },
            Pagination(){
                return this.$store.getters.Pagination
            },
            AllPagination(){
                return this.$store.getters.AllPagination
            },
            UnemployedPagination(){
                return this.$store.getters.UnemployedPagination
            },
            EmployedPagination(){
                return this.$store.getters.EmployedPagination
            },
            PendingPagination(){
                return this.$store.getters.PendingPagination
            },
            Bureaus(){
               return this.$store.getters.Bureaus
            },
            BureauPagination(){
                return this.$store.getters.BureausPagination
            },
            Reviews(){
               return this.$store.getters.Reviews
            },
            ReviewPagination(){
                return this.$store.getters.ReviewPagination
            },
            ApprovedReviewPagination(){
                return this.$store.getters.ApprovedReviewPagination
            },
            PendingReviewPagination(){
                return this.$store.getters.PendingReviewPagination
            },
        },
        methods:{
            loadreviews(){
                return this.$store.dispatch("reviews", this.urlform)
            },
            allhousehelps(){//no employed or anything
                return this.$store.dispatch("allhousehelps", this.urlform)
            },
            loadHousehelps(){
               this.$Progress.start();
                let employmentstatus = this.employmentstatus;
                let hirestatus = this.hirestatus;
               if(employmentstatus==false && hirestatus==false){
                //    console.log(employmentstatus,"false", hirestatus, "false geting unemployed")
                   return this.$store.dispatch( "househelpslist", this.urlform)
                    .then((response)=>{
                        toast({
                        type: 'success',
                        title: 'Fetched the Househelp data successfully'
                        })
                    })
                    .catch(()=>{
                        this.$Progress.fail();
                        toast({
                        type: 'error',
                        title: 'There was something Wrong'
                        })
                    })

               }else if(employmentstatus==true && hirestatus==false){
                //    console.log(employmentstatus,"true", hirestatus, "false geting employed")
                   return this.$store.dispatch( "househelpslist", this.urlform)
                    .then((response)=>{
                        toast({
                        type: 'success',
                        title: 'Fetched the Househelp data successfully'
                        })
                    })
                    .catch(()=>{
                        this.$Progress.fail();
                        toast({
                        type: 'error',
                        title: 'There was something Wrong'
                        })
                    })

               }else if(employmentstatus==false && hirestatus==true){
                //    console.log(employmentstatus,"false", hirestatus, "true geting pending employment")
                   return this.$store.dispatch( "househelpslist", this.urlform)
                    .then((response)=>{
                        toast({
                        type: 'success',
                        title: 'Fetched the Househelp data successfully'
                        })
                    })
                    .catch(()=>{
                        this.$Progress.fail();
                        toast({
                        type: 'error',
                        title: 'There was something Wrong'
                        })
                    })
               }
            },
            getUnemployedHousehelps(){
                this.Unemployed = true;
                this.Employed = false;
                this.Pending = false;
                this.Status = 'Unemployed';
                this.employmentstatus = false;
                this.hirestatus = false;//not pending
                this.urlform.url = '/api/househelp/get/unemployed/';
                this.$store.dispatch("unemployedhousehelps", this.urlform)
                this.$store.dispatch("employedhousehelps", this.urlform)
                this.$store.dispatch("pendinghousehelps", this.urlform)
                this.loadHousehelps();
            },
            getEmployedHousehelps(){
                this.Unemployed = false;
                this.Employed = true;
                this.Pending = false;
                this.Status = 'Employed';
                this.employmentstatus = true;
                this.hirestatus = false;//not pending
                this.urlform.url = '/api/househelp/get/employed/';
                this.$store.dispatch("unemployedhousehelps", this.urlform)
                this.$store.dispatch("employedhousehelps", this.urlform)
                this.$store.dispatch("pendinghousehelps", this.urlform)
                this.loadHousehelps();
            },
            getPendingEmployementHousehelps(){
                this.Unemployed = false;
                this.Employed = false;
                this.Pending = true;
                this.Status = 'Pending Employement';
                this.employmentstatus = false;
                this.hirestatus = true;// pending
                this.urlform.url = '/api/househelp/get/pending/';
                this.$store.dispatch("unemployedhousehelps", this.urlform)//for counting
                this.$store.dispatch("employedhousehelps", this.urlform)//for counting
                this.$store.dispatch("pendinghousehelps", this.urlform)//for counting
                this.loadHousehelps();
            },
            fetchPaginatedHousehelps(url){
                this.urlform.url = url;
                this.loadHousehelps();
            },
            househelpLoadPassPhoto(househelppivot_photo){
                if(househelppivot_photo){
                    return "/assets/bureau/img/househelps/passports/"+househelppivot_photo;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            househelpLoadIDFrontPhoto(househelp_idstatus_id_photo_front){
                if(househelp_idstatus_id_photo_front){
                    return "/assets/bureau/img/househelps/IDs/front/"+househelp_idstatus_id_photo_front;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            househelpLoadIDBackPhoto(househelp_idstatus_id_photo_back){
                if(househelp_idstatus_id_photo_back){
                    return "/assets/bureau/img/househelps/IDs/back/"+househelp_idstatus_id_photo_back;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            househelpLoadWaitingCard(househelp_idstatus_waiting_card_photo){
                if(househelp_idstatus_waiting_card_photo){
                    return "/assets/bureau/img/househelps/waitingcards/"+househelp_idstatus_waiting_card_photo;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            loadBureaus(){
                this.$Progress.start();
                return this.$store.dispatch("bureaus", this.urlform.bureauurl)
                 .then((response)=>{
                    toast({
                     type: 'success',
                     title: 'Fetched the Bureaus data successfully'
                    })
                    this.$Progress.finish();
                })
                .catch(()=>{
                    this.$Progress.fail();
                    toast({
                    type: 'error',
                    title: 'There was something Wrong'
                    })
                })
            },
            fetchPaginatedBureaus(url){
                this.urlform.bureauurl = url;
                this.loadBureaus();
            },
        },


}
</script>

<style>

</style>
