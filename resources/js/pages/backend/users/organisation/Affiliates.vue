<template>
<div class="content-wrapper">
  <div class="container-fluid mt-5">
      <!-- Main content -->
    <section class="content">
      <div class="row justify-content-around">
        <div class="col-md">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Affiliates Table</h3>
              <div class="card-tools">
                    <button class="btn btn-success"  @click.prevent="newAffiliateModal()">Add New Affiliate
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
                    <th>Affiliate Details</th>
                    <th>Roles</th>
                    <th>Permissions</th>
                    <th style="padding-left: 14px">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(user, index) in Users" :key="user.id">
                    <td >{{index+1}}</td>
                    <td style="width: 550px;">
                        <div class="row" style="width:100%" v-for="affiliate in user.organisationaffiliates" :key="affiliate.id">
                            <div class="col-sm-3" style="padding: 3px;">
                                 <img class="card-img-top" :src="affiliateLoadPassPhoto(affiliate.pivot.photo)" style="width:100%" alt="Card image cap">
                            </div>
                            <div class="col-sm-9" style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                <div>{{user.full_name}},</div>
                                <div >Organisation
                                    <span style="color:#9a009a;">
                                        {{affiliate.name}},
                                    </span>
                                </div>
                                <div> ID: ,<span style="color:#9a009a;">{{affiliate.pivot.id_no}}</span>,
                                    Phone: <span style="color:#9a009a;">{{affiliate.pivot.phone}},</span>
                                </div>
                                <div>
                                     Mail: <span style="color:#9a009a;">{{user.email}},</span>
                                </div>
                                    <div>P. O. Box , <span style="color:#9a009a;">{{affiliate.pivot.address}}</span>,
                                    </div>
                               <div>
                                    <span style="color:#9a009a;">{{affiliate.ward_name}}</span> ward,
                                    <span style="color:#9a009a;">{{affiliate.constituency_name}}</span> constituency,
                                </div>
                                <div >
                                    <span style="color:#9a009a;">{{affiliate.county_name}}</span> county,
                                    <span style="color:#9a009a;">{{affiliate.country_name}},</span>
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
                                <a href=""  @click.prevent="editAffiliateModal(user.id)">
                                    <i class="fa fa-edit blue"></i>
                                </a>
                                /
                                <a href=""  @click.prevent="deleteAffiliate(user.id)">
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
                                  out of <span style="color:#9a009a;"> {{pagination.total}} </span> Affiliates
                              </div>
                              <button class="btn btn-info" v-on:click="fetchPaginatedAffiliates(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">Prev</button>
                          </span>
                          <span class="float-right" style="margin-bottom:-0.5em" >
                              <div style="margin-bottom:0.25em">
                                  Page <span style="color:#9a009a;"> {{pagination.current_page}} </span>
                                  of <span style="color:#9a009a;"> {{pagination.last_page}} </span>
                              </div>
                              <button class="btn btn-info" v-on:click="fetchPaginatedAffiliates(pagination.next_page_url)" :disabled="!pagination.next_page_url">Next</button>
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
    <div class="modal fade " id="AffiliateModal" tabindex="-1" role="dialog" aria-labelledby="AffiliateModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form role="form" @submit.prevent="editmodeAffiliate ? updateAffiliate(affiliateform.id) : addAffiliate()" >
                        <div class="modal-body">
                            <h5 class="modal-title" v-show="editmodeAffiliate" id="AffiliateModalLabel">Update Affiliate</h5>
                            <h5 class="modal-title" v-show="!editmodeAffiliate" id="AffiliateModalLabel">Add New Affiliate</h5>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="first_name" class="col-form-label"> Affiliate Passport</label>
                                    <img v-show="editmodeAffiliate" :src="updateAffiliatePassPhoto(affiliateform.photo)" alt="" width="100%" >
                                </div>
                                <div class="form-group col-md-8">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="first_name" class="col-form-label"> Affiliate First Name</label>
                                            <input v-model="affiliateform.first_name" type="text" name="first_name" placeholder="Affiliate First Name"
                                                class="form-control" :class="{ 'is-invalid': affiliateform.errors.has('first_name') }" >
                                            <has-error style="color: #e83e8c" :form="affiliateform" field="first_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="last_name" class=" col-form-label">affiliate_Last Name </label>
                                            <input v-model="affiliateform.last_name" type="affiliate_last_name" name="last_name" placeholder="Affiliate Last Name"
                                                class="form-control" :class="{ 'is-invalid': affiliateform.errors.has('last_name') }" >
                                            <has-error style="color: #e83e8c" :form="affiliateform" field="last_name"></has-error>
                                        </div>
                                    </div>
                                    <div class="row">
                                         <div class="form-group col-md-6">
                                            <label for="email" class=" col-form-label">Email </label>
                                            <input v-model="affiliateform.email" type="email" name="email" placeholder="Email Address"
                                                class="form-control" :class="{ 'is-invalid': affiliateform.errors.has('email') }" >
                                            <has-error style="color: #e83e8c" :form="affiliateform" field="email"></has-error>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="password" class=" col-form-label">Password </label>
                                            <input v-model="affiliateform.password" type="password" id="password" placeholder="Password"
                                                class="form-control" :class="{ 'is-invalid': affiliateform.errors.has('password') }">
                                            <has-error :form="affiliateform" field="password"></has-error>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editmodeAffiliate" type="submit" class="btn btn-success">Update</button>
                            <button v-show="!editmodeAffiliate" type="submit" class="btn btn-primary">Create</button>
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
        name:"Organisation-Affiliates",
        data(){
            return{
                newAffiliate: false,
                editmodeAffiliate: false,
                affiliateform: new Form({
                        id:'',
                        first_name:'',
                        last_name:'',
                        email:'',
                        password:'',
                        user_type:'',
                        photo:'',
                }),
                url:'/api/affiliate/get/list',
                pagination:[],
            }
        },
        mounted() {
            this.loadCountries();
            this.loadCounties();
            this.loadConstituencies();
            this.loadWards();
            this.loadGenders();
            this.loadAffiliates();
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
                return this.$store.getters.Affiliates
            },

        },
        methods:{
            //affiliate
            InputPhone({ number, isValid, country }) {
            this.affiliateform.phone = number;
            this.phone.isValid = isValid;
            this.phone.country = country && country.name;
            },
            InputLandline({ number, isValid, country }) {
            this.affiliateform.landline = number;
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
            loadAffiliates(){
                this.$Progress.start();
                return this.$store.dispatch( "affiliates", this.url)
                 .then((response)=>{
                     this.makingPagination(response.data.affiliates),
                    toast({
                     type: 'success',
                     title: 'Fetched the Affiliate data successfully'
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
            fetchPaginatedAffiliates(url){
                this.url = url;
                this.loadAffiliates();
            },
            newAffiliateModal(){
                 this.editmodeAffiliate= false;
                 this.affiliateform.reset()
                     $('#AffiliateModal').modal('show')
            },
            affiliateLoadPassPhoto(affiliatepivot_photo){
                console.log(affiliatepivot_photo)
                if(affiliatepivot_photo){
                    return "/assets/organisation/img/affiliates/passports/"+affiliatepivot_photo;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            //affiliate passport photo
            affiliateChangePassPhoto(event){
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
                            this.affiliateform.photo =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateAffiliatePassPhoto(organisationaffiliate_photo){
                console.log(organisationaffiliate_photo, 'edit')
                let img = this.affiliateform.photo;
                      if(img ==null){
                          return "/assets/organisation/img/website/empty.png";
                        //  console.log('its reall null')
                      }else{
                          if(img.length>100){
                            return this.affiliateform.photo;
                        }else{
                            if(organisationaffiliate_photo){
                                return "/assets/organisation/img/affiliates/passports/"+organisationaffiliate_photo;
                            }else{
                                return "/assets/organisation/img/website/empty.png";
                            }
                        }
                      }

            },
            affiliateLoadIDFrontPhoto(affiliatepivot_id_photo_front){
                if(affiliatepivot_id_photo_front){
                    return "/assets/organisation/img/affiliates/IDs/front/"+affiliatepivot_id_photo_front;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            affiliateChangeIDFrontPhoto(event){
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
                            this.affiliateform.id_photo_front =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateAffiliateIDFrontPhoto(affiliateform_id_photo_front){
                let img = this.affiliateform.id_photo_front;
                      if(img ==null){
                          return "/assets/organisation/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.affiliateform.id_photo_front;
                        }else{
                            if(affiliateform_id_photo_front){
                                return "/assets/organisation/img/affiliates/IDs/front/"+affiliateform_id_photo_front;
                            }else{
                                return "/assets/organisation/img/website/empty.png";
                            }
                        }
                      }

            },
            affiliateLoadIDBackPhoto(affiliateform_id_photo_back){
                if(affiliateform_id_photo_back){
                    return "/assets/organisation/img/affiliates/IDs/back/"+affiliateform_id_photo_back;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            affiliateChangeIDBackPhoto(event){
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
                            this.affiliateform.id_photo_back =event.target.result
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateAffiliateIDBackPhoto(affiliateform_id_photo_back){
                let img = this.affiliateform.id_photo_back;
                      if(img ==null){
                          return "/assets/organisation/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.affiliateform.id_photo_back;
                        }else{
                            if(affiliateform_id_photo_back){
                                return "/assets/organisation/img/affiliates/IDs/back/"+affiliateform_id_photo_back;
                            }else{
                                return "/assets/organisation/img/website/empty.png";
                            }
                        }
                      }

            },

            editAffiliateModal(id){
                 this.editmodeAffiliate = true;
                 this.affiliateform.reset()
                    this.$Progress.start();
                      axios.get('/api/affiliate/edit/'+id)
                        .then((response)=>{
                           $('#AffiliateModal').modal('show')
                           toast({
                            type: 'success',
                            title: 'Fetched the Affiliate data successfully'
                            })
                            this.affiliateform.fill(response.data.user)
                            this.affiliateform.first_name = response.data.user.first_name;
                            this.affiliateform.last_name = response.data.user.last_name;
                            this.affiliateform.email = response.data.user.email;
                            this.affiliateform.user_type = response.data.user.user_type;
                            this.affiliateform.photo = response.data.user.organisationaffiliates[0].pivot.photo
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                            //errors
                            $('#AffiliateModal').modal('show');
                            toast({
                            type: 'error',
                            title: 'There was something Wrong'
                            })
                        })
            },
            addAffiliate() {
                 this.affiliateform.user_type = "Organisation Affiliate";
                this.$Progress.start();
                this.affiliateform.patch('/api/affiliate')
                    .then((response)=>{
                        //  console.log(response.data)
                         toast({
                            type: 'success',
                            title: 'Affiliate Created successfully'
                            })
                            this.$store.dispatch( "affiliates")
                            this.affiliateform.reset()
                            $('#AffiliateModal').modal('hide')
                              this.$Progress.finish()
                    })
                    .catch((response)=>{
                        this.$Progress.fail()
                        //errors
                        console.log(response,'response')
                            $('#AffiliateModal').modal('show');
                            toast({
                                type: 'error',
                                title: 'There was something wrong.'
                                })
                    })
            },
            updateAffiliate(id){
                  this.$Progress.start();
                     this.affiliateform.patch('/api/user/update/'+id)
                        .then(()=>{
                            this.loadAffiliates();
                         $('#AffiliateModal').modal('hide')
                         toast({
                            type: 'success',
                            title: 'Affiliate Created successfully'
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
            deleteAffiliate(id){
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
                    //  console.log('delete affiliate', id)
                        this.$Progress.start();
                        this.affiliateform.get('/affiliate/delete/'+id)
                            .then(()=>{
                            toast({
                            type: 'success',
                            title: 'Affiliate Deleted successfully'
                            })
                            this.$store.dispatch( "affiliates")
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




