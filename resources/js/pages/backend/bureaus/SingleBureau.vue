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
   <div class="container-fluid">
      <!-- Main content -->
        <div class="col-md-12">
                <div class="card card-widget widget-user" >
                   <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header text-white" style="background-color: #070075c4; center center;width:100%;height:190px">
                    <div class="clearfix">
                                <span class="float-left">
                                    <h3 class="widget-user-username">{{Bureau.name}}</h3>
                                    <h5 class="widget-user-desc " style="margin-bottom:0">Phone: {{Bureau.phone}}, <span>{{Bureau.landline}}</span> </h5>
                                    <h5 class="widget-user-desc" style="margin-bottom:0">P.O. Box {{Bureau.address}},</h5>
                                    <h5 class="widget-user-desc" style="margin-bottom:0" v-if="Bureau.ward">{{Bureau.ward.name}} Ward,
                                        <span v-if="Bureau.constituency">{{Bureau.constituency.name}} Constituency,</span>
                                    </h5>
                                    <h5 class="widget-user-desc" style="margin-bottom:0" v-if="Bureau.county">{{Bureau.county.name}} County,
                                         <span v-if="Bureau.country"> {{Bureau.country.name}}</span>
                                    </h5>
                                </span>
                                <span class="float-right">
                                    <h5 class="widget-user-desc" style="margin-bottom:0">{{Bureau.email}}</h5>
                                    <h5 class="widget-user-desc" style="margin-bottom:0">{{Bureau.website}}</h5>
                                    <!-- <p style="margin-bottom:-0.5em">
                                        <small class="text-muted">Updated By: {{bureau.user.full_name}}</small>
                                    </p> -->
                                    <p style="margin-bottom:0.25em">
                                        <small class="text-muted">Last updated On: {{Bureau.updated_at | dateformat}}</small>
                                    </p>
                                    <a href=""  @click.prevent="editBureauModal(Bureau.id)">
                                            <i class="fa fa-edit red"> Edit</i>
                                    </a>
                                    <!-- / -->
                                    <!-- <a href=""  @click.prevent="deleteBureau(Bureau.id)">
                                        <i class="fa fa-trash red"></i>
                                    </a> -->
                                </span>
                            </div>

                    </div>
                    <div class="widget-user-image" style="top:5px;">
                        <img :src="bureauLoadLogo(Bureau.logo)"  class="border-0" alt="" style="width:160px;">
                        <h3 class="card-title text-center text-white">{{Bureau.name}}</h3>
                    </div>
                </div>
        </div>
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
                                <div class="inner" v-if="Bureau.bureauhousehelps">
                                    <h3 >{{Bureau.bureauhousehelps.length}}</h3>
                                    <p>Househelps </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="" class="small-box-footer"  @click.prevent="loadHousehelps()">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner" v-if="Bureau.bureaudirectors">
                                    <h3 >{{Bureau.bureaudirectors.length}}</h3>
                                    <p>Directors</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="" class="small-box-footer"  @click.prevent="DirectorsModal()">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner" v-if="Bureau.bureauadmins">
                                    <h3 >{{Bureau.bureauadmins.length}}</h3>
                                    <p>Admins </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="" class="small-box-footer"  @click.prevent="AdminsModal()">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner" v-if="Bureau.bureauemployees">
                                    <h3>{{Bureau.bureauemployees.length}}</h3>
                                    <p>Employees </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="" class="small-box-footer"  @click.prevent="EmployeesModal()">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- ./col -->
           </div>
       </div>
   </section>

   <!-- Bureau Modal -->
        <div class="modal fade " id="BureauModal" tabindex="-1" role="dialog" aria-labelledby="BureauModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form-wizard role="form" @on-complete="editmodeBureau ? updateBureau(bureauform.id) : addBureau ()" >
                            <h5 class="modal-title" v-show="editmodeBureau" id="BureauModalLabel">Update Bureau</h5>
                            <!-- <h5 class="modal-title" v-show="!editmodeBureau" id="BureauModalLabel">Add New Bureau & Director</h5> -->
                            <tab-content title="Bureau Details" icon="fa fa-building" :before-change="editmodeBureau ? validateBureauUpdate : validateBureau" >
                                {{bureauform.id}}
                                <div class=" row">
                                    <div class="form-group col-md-4">
                                        <label for="name" class="col-form-label"> Bureau Name</label>
                                        <input v-model="bureauform.name" type="text" name="name" placeholder="Bureau Name"
                                            class="form-control" :class="{ 'is-invalid': bureauform.errors.has('name') }" >
                                        <has-error style="color: #e83e8c" :form="bureauform" field="name"></has-error>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="bureau_email" class=" col-form-label">Email </label>
                                        <input v-model="bureauform.bureau_email" type="email" name="bureau_email" placeholder="Email Address"
                                            class="form-control" :class="{ 'is-invalid': bureauform.errors.has('bureau_email') }" >
                                        <has-error style="color: #e83e8c" :form="bureauform" field="bureau_email"></has-error>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="phone" class="col-form-label"> Bureau Phone</label>
                                            <div>
                                                <vue-tel-input v-model="bureauform.phone" name="phone" @onInput="BureauInputPhone"
                                                class="form-control" :class="{ 'is-invalid': bureauform.errors.has('phone') }">
                                                </vue-tel-input>
                                                <has-error style="color: #e83e8c" :form="bureauform" field="phone"></has-error>
                                            </div>
                                            <div v-if="bureauform.phone" style="color: #e83e8c">
                                                <span>Is valid: <strong>{{phone1.isValid}}</strong>,&nbsp;</span>
                                                <span>Country: <strong>{{phone1.country}}</strong></span>
                                        </div>
                                    </div>
                                </div>
                                <div class=" row">
                                    <div class="form-group col-md-4">
                                        <label for="landline" class=" col-form-label">Landline</label>
                                            <vue-tel-input v-model="bureauform.landline" name="landline" @onInput="BureauInputLandline"
                                                class="form-control" :class="{ 'is-invalid': bureauform.errors.has('landline') }">
                                            </vue-tel-input>
                                            <has-error style="color: #e83e8c" :form="bureauform" field="landline"></has-error>

                                            <div v-if="bureauform.landline" style="color: #e83e8c">
                                                <span>Is valid: <strong>{{landline1.isValid}}</strong>,&nbsp;</span>
                                                <span>Country: <strong>{{landline1.country}}</strong></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="website" class="col-form-label">Website</label>
                                        <input v-model="bureauform.website" type="text" name="website" placeholder="Website"
                                            class="form-control" :class="{ 'is-invalid': bureauform.errors.has('website') }" >
                                        <has-error style="color: #e83e8c" :form="bureauform" field="website"></has-error>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="address" class=" col-form-label">address</label>
                                        <input v-model="bureauform.address" type="text" name="Address" placeholder="Address"
                                            class="form-control" :class="{ 'is-invalid': bureauform.errors.has('address') }" >
                                        <has-error style="color: #e83e8c" :form="bureauform" field="address"></has-error>
                                    </div>
                                </div>
                                <div class=" row">
                                    <div class="form-group col-md-3">
                                        <label for="country_id">Select Country</label>
                                        <select class="form-control" @change="countryCounties(bureauform.country_id)"
                                        v-model="bureauform.country_id" :class="{ 'is-invalid': bureauform.errors.has('country_id') }">
                                                <option disabled value="">Select Country</option>
                                                <option v-for="country in Countries" :value="country.id" :key="country.id">{{country.name}}</option>
                                        </select>
                                            <has-error style="color: #e83e8c" :form="bureauform" field="country_id"></has-error>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="county_id" class=" col-form-label">County</label>
                                        <select class="form-control" @change="countyConstituencies(bureauform.county_id)"
                                        v-model="bureauform.county_id" :class="{ 'is-invalid': bureauform.errors.has('county_id') }">
                                                <option disabled value="">Select County</option>
                                                <option v-for="county in Counties" :value="county.id" :key="county.id">{{county.name}}</option>
                                        </select>
                                        <has-error style="color: #e83e8c" :form="bureauform" field="county_id"></has-error>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="constituency_id" class=" col-form-label">Constituency</label>
                                        <select class="form-control" @change="constituencyWards(bureauform.constituency_id)"
                                        v-model="bureauform.constituency_id" :class="{ 'is-invalid': bureauform.errors.has('constituency_id') }">
                                                <option disabled value="">Select County</option>
                                                <option v-for="constituency in Constituencies" :value="constituency.id" :key="constituency.id">{{constituency.name}}</option>
                                        </select>
                                        <has-error style="color: #e83e8c" :form="bureauform" field="constituency_id"></has-error>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="ward_id" class="col-form-label"> Ward </label>
                                        <select class="form-control"
                                        v-model="bureauform.ward_id" :class="{ 'is-invalid': bureauform.errors.has('ward_id') }">
                                                <option disabled value="">Select Town</option>
                                                <option v-for="ward in Wards" :value="ward.id" :key="ward.id">{{ward.name}}</option>
                                        </select>
                                        <has-error style="color: #e83e8c" :form="bureauform" field="ward_id"></has-error>
                                    </div>
                                </div>
                                <div class=" row">
                                    <div class="form-group col-md-6">
                                        <label for="logo" class=" col-form-label">Bureau Logo</label><br>
                                            <input @change="bureauChangeLogo($event)" type="file" name="logo"
                                                :class="{ 'is-invalid': bureauform.errors.has('logo') }">
                                                <img v-show="editmodeBureau" :src="updateBureauLogo(bureauform.logo)" alt="" width="100%" >
                                                <img  v-show="!editmodeBureau" :src="bureauform.logo" alt="" width="100%" >
                                            <has-error style="color: #e83e8c" :form="bureauform" field="logo"></has-error>
                                    </div>
                                </div>
                            </tab-content>

                            <tab-content title="Last step">
                                Bureau Information
                                <div class=" row">
                                    <div class="form-group col-md-4">
                                        <label for="name" class="col-form-label"> Bureau Name</label>
                                        <input v-model="bureauform.name" class="form-control" :readonly="true">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="bureau_email" class=" col-form-label">Email </label>
                                        <input v-model="bureauform.bureau_email" class="form-control" :readonly="true">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="phone" class="col-form-label"> Bureau Phone</label>
                                            <div>
                                                <vue-tel-input v-model="bureauform.phone" class="form-control" :readonly="true">
                                                </vue-tel-input>
                                            </div>
                                            <div v-if="bureauform.phone" style="color: #e83e8c">
                                                <span>Is valid: <strong>{{phone1.isValid}}</strong>,&nbsp;</span>
                                                <span>Country: <strong>{{phone1.country}}</strong></span>
                                        </div>
                                    </div>
                                </div>
                                <div class=" row">
                                    <div class="form-group col-md-4">
                                        <label for="landline" class=" col-form-label">Landline</label>
                                            <vue-tel-input v-model="bureauform.landline" class="form-control" :readonly="true">
                                            </vue-tel-input>
                                            <div v-if="bureauform.landline" style="color: #e83e8c">
                                                <span>Is valid: <strong>{{landline1.isValid}}</strong>,&nbsp;</span>
                                                <span>Country: <strong>{{landline1.country}}</strong></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="website" class="col-form-label">Website</label>
                                        <input v-model="bureauform.website" class="form-control" :readonly="true" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="address" class=" col-form-label">address</label>
                                        <input v-model="bureauform.address" class="form-control" :readonly="true" >
                                    </div>
                                </div>
                                <div class=" row">
                                    <div class="form-group col-md-3">
                                        <label for="country_id" class=" col-form-label">Country</label>
                                        <select class="form-control" v-model="bureauform.country_id" :readonly="true">
                                                <option v-for="country in Countries" :value="country.id" :key="country.id">{{country.name}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="county_id" class=" col-form-label">County</label>
                                        <select class="form-control" v-model="bureauform.county_id" :readonly="true">
                                                <option v-for="county in Counties" :value="county.id" :key="county.id">{{county.name}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="constituency_id" class=" col-form-label">Constituency</label>
                                        <select class="form-control" v-model="bureauform.constituency_id" :readonly="true">
                                                <option v-for="constituency in Constituencies" :value="constituency.id" :key="constituency.id">{{constituency.name}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="ward_id" class="col-form-label"> Ward </label>
                                        <select class="form-control" v-model="bureauform.ward_id" :readonly="true">
                                                <option v-for="ward in Wards" :value="ward.id" :key="ward.id">{{ward.name}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class=" row">
                                    <div class="form-group col-md-6">
                                        <label for="logo" class=" col-form-label">Bureau Logo</label><br>
                                            <input type="file" name="logo" :readonly="true">
                                                <img v-show="editmodeBureau" :src="updateBureauLogo(bureauform.logo)" alt="" width="100%" >
                                                <img  v-show="!editmodeBureau" :src="bureauform.logo" alt="" width="100%" >
                                            <has-error style="color: #e83e8c" :form="bureauform" field="logo"></has-error>
                                    </div>
                                </div>
                            </tab-content>
                        </form-wizard>
                    </div>
                </div>
            </div>
        </div>

        <!-- Househelps modal -->
        <div class="modal fade " id="HousehelpsModal" tabindex="-1" role="dialog" aria-labelledby="HousehelpsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title"  id="HousehelpsModalLabel">Welcome to All {{Status}}</h3>
                        <span>
                            <button class="btn btn-success"  @click.prevent="newHousehelpModal(Bureau.id)">Add  <i class="fas fa-plus fw"></i></button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </span>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div v-if="Unemployed ==true && Employed ==false && Pending ==false">
                                <el-button type="success">Unemployed ({{UnemployedPagination.total}}) </el-button>
                                <el-button type="danger" v-on:click="getEmployedHousehelps()" plain>Employed ({{EmployedPagination.total}})</el-button>
                                <el-button type="danger" v-on:click="getPendingEmployementHousehelps()" plain>Pending Employement ({{PendingPagination.total}})</el-button>
                            </div>
                            <div v-else-if="Unemployed ==false && Employed ==true && Pending ==false">
                                <el-button type="danger" v-on:click="getUnemployedHousehelps()" plain>Unemployed ({{UnemployedPagination.total}})</el-button>
                                <el-button type="success">Employed ({{EmployedPagination.total}}) </el-button>
                                <el-button type="danger" v-on:click="getPendingEmployementHousehelps()" plain>Pending Employement ({{PendingPagination.total}})</el-button>
                            </div>
                            <div v-else-if="Unemployed ==false && Employed ==false && Pending ==true">
                                <el-button type="danger" v-on:click="getUnemployedHousehelps()" plain>Unemployed ({{UnemployedPagination.total}})</el-button>
                                <el-button type="danger" v-on:click="getEmployedHousehelps()" plain>Employed ({{EmployedPagination.total}})</el-button>
                                <el-button type="success">Pending Employement ({{PendingPagination.total}})</el-button>
                            </div>
                        </div>
                        <div class="row" v-for="user in Users" :key="user.id">
                            <div class="row" v-for="househelp in user.bureauhousehelps" :key="househelp.id">
                                <div class="col-sm-2" style="padding: 3px;">
                                        <img class="card-img-top" :src="househelpLoadPassPhoto(househelp.pivot.photo)" style="width:100%; height:130px" alt="Card image cap">
                                </div>
                                <div class="col-sm-2" style="padding: 3px;">
                                        <div v-if="househelp.idstatus_id_photo_front !=null">
                                            <img class="card-img-top" :src="househelpLoadIDFrontPhoto(househelp.idstatus_id_photo_front)" style="width:100%;height:65px" alt="Card image cap"><br>
                                            <img class="card-img-top" :src="househelpLoadIDBackPhoto(househelp.idstatus_id_photo_back)" style="width:100%;height:65px" alt="Card image cap">
                                        </div>
                                         <div  style="padding: 3px;" v-else-if="househelp.idstatus_waiting_card_photo !=null">
                                            Waiting Card<br>
                                            <img class="card-img-top" :src="househelpLoadWaitingCard(househelp.idstatus_waiting_card_photo)" style="width:100%;height:65px" alt="Card image cap"><br>
                                        </div>
                                         <div  style="padding: 3px;" v-else>
                                            No ID nor Applied<br>
                                            <img class="card-img-top" :src="househelpLoadWaitingCard(househelp.idstatus_waiting_card_photo)" style="width:100%;height:65px" alt="Card image cap"><br>
                                        </div>
                                </div>
                                <div class="col-sm-4" style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                        <div> Househelp: <span style="color:#9a009a;">{{user.full_name}},</span></div>
                                        <div>
                                               Bureau: <span style="color:#9a009a;">{{househelp.name}},</span>
                                       </div>
                                        <div v-if="househelp.idstatus_id_photo_front !=null">
                                            ID: ,<span style="color:#9a009a;">{{househelp.idstatus_id_number}}</span>,
                                            Phone: <span style="color:#9a009a;">{{househelp.pivot.phone}},</span>
                                        </div>
                                        <div style="padding: 3px;" v-else-if="househelp.idstatus_waiting_card_photo !=null">
                                            Waiting No.: ,<span style="color:#9a009a;">{{househelp.idstatus_ref_number}}</span>,
                                            Phone: <span style="color:#9a009a;">{{househelp.pivot.phone}},</span>
                                        </div>
                                        <div style="padding: 3px;" v-else>
                                            ID.:<span style="color:#9a009a;"> No ID Nor Applied</span>,
                                            Phone: <span style="color:#9a009a;">{{househelp.pivot.phone}},</span>
                                        </div>
                                        <div>
                                            Mail: <span style="color:#9a009a;">{{user.email}},</span>
                                        </div>
                                            <div>P. O. Box , <span style="color:#9a009a;">{{househelp.pivot.address}}</span>,
                                            </div>
                                        <div>
                                            <span style="color:#9a009a;">{{househelp.ward_name}}</span> ward,
                                            <span style="color:#9a009a;">{{househelp.constituency_name}}</span> constituency,
                                        </div>
                                        <div >
                                            <span style="color:#9a009a;">{{househelp.county_name}}</span> county,
                                            <span style="color:#9a009a;">{{househelp.country_name}},</span>
                                        </div>
                                </div>
                                <div class="col-sm-4" style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                    <div>Gender: <span style="color:#9a009a;">{{househelp.gender_name}}</span>,
                                         Age: <span style="color:#9a009a;">{{househelp.age}} Years</span>,
                                    </div>
                                    <div>
                                        Marital Status: <span style="color:#9a009a;">{{househelp.maritalstatus_name}}</span>,
                                    </div>
                                    <div>
                                        English Ability: <span style="color:#9a009a;">{{househelp.englishstatus_name}}</span>,
                                        <span>Education Level: <span style="color:#9a009a;">{{househelp.education_name}}</span></span>,
                                    </div>
                                    <div>
                                        Experience Level: <span style="color:#9a009a;">{{househelp.experience_name}}</span>,
                                    </div>
                                    <div>
                                         Duration: <span style="color:#9a009a;">{{househelp.duration_name}}</span>,
                                    </div>
                                    <div>
                                        Status:
                                         <span style="color:#9a009a;">
                                            <span v-if="househelp.employmentstatus == true && househelp.hiredstatus == false">
                                                <a type="button" class="btn btn-warning btn-sm"> Employed</a>
                                            </span>
                                            <span v-else-if="househelp.employmentstatus == false && househelp.hiredstatus == false">
                                                <a type="button" class="btn btn-success btn-sm"> Unemployed</a>
                                            </span>
                                            <span v-else-if="househelp.employmentstatus == false && househelp.hiredstatus == true">
                                                <a type="button" class="btn btn-success btn-sm"> pending</a>
                                            </span>
                                        </span>
                                    </div>
                                         <div class="clearfix" style="font-weight:bold;font-size:0.9em;">
                                            <span class="float-left" style="margin-bottom:-0.5em" >
                                                <div style="margin-bottom:0.25em"> Updated at:
                                                    <span style="color:#9a009a;">{{user.created_at | dateformat}} </span>
                                                </div>
                                            </span>
                                            <span class="float-right">
                                                <a href=""  @click.prevent="viewHousehelpModal(househelp.id)">
                                                    <i class="fa fa-eye purple"></i>
                                                </a>
                                            </span>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div v-if="Users.length" >
                            <div class="clearfix" style="font-weight:bold;font-size:0.7em;">
                                <span class="float-left" style="margin-bottom:-0.5em" >
                                    <div style="margin-bottom:0.25em">
                                        Between <span style="color:#9a009a;"> {{Pagination.from}} </span>
                                        & <span style="color:#9a009a;"> {{Pagination.to}} </span>
                                        out of <span style="color:#9a009a;"> {{Pagination.total}} </span> Househelps
                                    </div>
                                    <button class="btn btn-info" v-on:click="fetchPaginatedHousehelps(Pagination.prev_page_url)" :disabled="!Pagination.prev_page_url">Prev</button>
                                </span>
                                <span class="float-right" style="margin-bottom:-0.5em" >
                                    <div style="margin-bottom:0.25em">
                                        Page <span style="color:#9a009a;"> {{Pagination.current_page}} </span>
                                        of <span style="color:#9a009a;"> {{Pagination.last_page}} </span>
                                    </div>
                                    <button class="btn btn-info" v-on:click="fetchPaginatedHousehelps(Pagination.next_page_url)" :disabled="!Pagination.next_page_url">Next</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- view househelp -->
        <div class="modal fade " id="ViewHousehelpModal" tabindex="-1" role="dialog" aria-labelledby="ViewHousehelpModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row" >
                            <div class="col-sm-6">
                                <div class="row">
                                     <div class="col-sm-4" style="padding: 3px;">
                                        <img class="card-img-top" :src="househelpLoadPassPhoto(Househelp.photo)" style="width:100%; height:130px" alt="Card image cap">
                                    </div>
                                    <!-- <div class="col-sm-2" style="padding: 3px;" v-if="Househelp.idstatus">
                                            <div v-if="Househelp.idstatus !=null">
                                                <img class="card-img-top" :src="househelpLoadIDFrontPhoto(Househelp.idstatus.id_photo_front)" style="width:100%;height:65px" alt="Card image cap"><br>
                                                <img class="card-img-top" :src="househelpLoadIDBackPhoto(Househelp.idstatus.id_photo_back)" style="width:100%;height:65px" alt="Card image cap">
                                            </div>
                                            <div  style="padding: 3px;" v-else-if="Househelp.idstatus.waiting_card_photo !=null">
                                                Waiting Card<br>
                                                <img class="card-img-top" :src="househelpLoadWaitingCard(Househelp.idstatus.waiting_card_photo)" style="width:100%;height:65px" alt="Card image cap"><br>
                                            </div>
                                            <div  style="padding: 3px;" v-else>
                                                No ID nor Applied<br>
                                                <img class="card-img-top" :src="househelpLoadWaitingCard(Househelp.idstatus.waiting_card_photo)" style="width:100%;height:65px" alt="Card image cap"><br>
                                            </div>
                                    </div> -->
                                    <div class="col-sm-8" style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                            <div v-if="Househelp.user"> Househelp: <span style="color:#9a009a;" >{{Househelp.user.full_name}},</span></div>
                                            <div v-if="Househelp.idstatus">
                                                    <div v-if="Househelp.idstatus.id_photo_front !=null">
                                                        ID: ,<span style="color:#9a009a;">{{Househelp.idstatus.id_number}}</span>,
                                                        Phone: <span style="color:#9a009a;">{{Househelp.phone}},</span>
                                                    </div>
                                                    <div style="padding: 3px;" v-else-if="Househelp.idstatus.waiting_card_photo !=null">
                                                        Waiting No.: ,<span style="color:#9a009a;">{{Househelp.idstatus.ref_number}}</span>,
                                                        Phone: <span style="color:#9a009a;">{{Househelp.phone}},</span>
                                                    </div>
                                                    <div style="padding: 3px;" v-else>
                                                        ID.:<span style="color:#9a009a;"> No ID Nor Applied</span>,
                                                        Phone: <span style="color:#9a009a;">{{Househelp.phone}},</span>
                                                    </div>
                                            </div>
                                            <div>
                                                Mail: <span style="color:#9a009a;" v-if="Househelp.user">{{Househelp.user.email}},</span>
                                            </div>
                                                <div>P. O. Box , <span style="color:#9a009a;">{{Househelp.address}}</span>,
                                                </div>
                                            <div>
                                                <span style="color:#9a009a;" v-if="Househelp.ward">{{Househelp.ward.name}}</span> ward,
                                                <span style="color:#9a009a;" v-if="Househelp.constituency">{{Househelp.constituency.name}}</span> constituency,
                                            </div>
                                            <div>
                                                <span style="color:#9a009a;" v-if="Househelp.county">{{Househelp.county.name}}</span> county,
                                                <span style="color:#9a009a;" v-if="Househelp.country">{{Househelp.country.name}},</span>
                                            </div>
                                            <div class="clearfix" style="font-weight:bold;font-size:0.9em;">
                                                    <span class="float-left" style="margin-bottom:-0.5em" >
                                                        <div style="margin-bottom:0.25em"> Updated at:
                                                            <span style="color:#9a009a;">{{Househelp.created_at | dateformat}} </span>
                                                        </div>
                                                    </span>
                                                    <span class="float-right">
                                                        <!-- <a href=""  @click.prevent="viewHousehelpModal(househelp.id)">
                                                            <i class="fa fa-eye purple"></i>
                                                        </a> -->
                                                        <a href=""  @click.prevent="editHousehelpModal(Househelp.user_id)">
                                                            <i class="fa fa-edit blue"></i>
                                                        </a>
                                                        <!-- /
                                                        <a href=""  @click.prevent="deleteHousehelp(Househelp.id)">
                                                            <i class="fa fa-trash red"></i>
                                                        </a> -->
                                                    </span>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row" v-for="househelpkin in Househelp.househelpkins" :key="househelpkin.id">
                                    <div class="col-sm-4" style="padding: 3px;">
                                        <img class="card-img-top" :src="househelpkinLoadPassPhoto(househelpkin.pivot.photo)" style="width:100%; height:130px" alt="Card image cap">
                                    </div>
                                    <div class="col-sm-8" style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                        <div> HousehelpKin: <span style="color:#9a009a;" >{{househelpkin.full_name}},</span></div>
                                        <div>
                                            Kin,
                                            <span style="color:#9a009a;">
                                                {{househelpkin.relationship_name}}, to
                                            </span>
                                            <span style="color:#9a009a;">
                                                {{Househelp.user.full_name}},
                                            </span>
                                        </div>
                                        <div> ID: ,<span style="color:#9a009a;">{{househelpkin.pivot.id_no}}</span>,
                                            Phone: <span style="color:#9a009a;">{{househelpkin.pivot.phone}},</span>
                                        </div>
                                        <div>
                                            Mail: <span style="color:#9a009a;" v-if="househelpkin.email">{{househelpkin.email}},</span>
                                        </div>
                                            <div>P. O. Box , <span style="color:#9a009a;">{{househelpkin.pivot.address}}</span>,
                                            </div>
                                        <div>
                                            <span style="color:#9a009a;">{{househelpkin.ward_name}}</span> ward,
                                            <span style="color:#9a009a;">{{househelpkin.constituency_name}}</span> constituency,
                                        </div>
                                        <div >
                                            <span style="color:#9a009a;">{{househelpkin.county_name}}</span> county,
                                            <span style="color:#9a009a;">{{househelpkin.country_name}},</span>
                                        </div>
                                         <div class="clearfix" style="font-weight:bold;font-size:0.9em;">
                                            <span class="float-left" style="margin-bottom:-0.5em" >
                                                <div style="margin-bottom:0.25em"> Updated at:
                                                    <span style="color:#9a009a;">{{househelpkin.created_at | dateformat}} </span>
                                                </div>
                                            </span>
                                            <span class="float-right">
                                                <!-- <a href=""  @click.prevent="viewHousehelpkinModal(househelpkin.user_id)">
                                                    <i class="fa fa-eye purple"></i>
                                                </a> -->
                                                <a href=""  @click.prevent="editHousehelpkinModal(househelpkin.user_id)">
                                                    <i class="fa fa-edit blue"></i>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- create & edit Househelp modal -->
        <div class="modal fade " id="HousehelpModal" tabindex="-1" role="dialog" aria-labelledby="HousehelpModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4> Update Househelp Demographic data</h4>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form-wizard role="form" @on-complete="updateHousehelp(househelpform.id)" ref="wizard">
                            <h5 class="modal-title" id="HousehelpModalLabel">Uppdate Current Househelp Demographic data</h5>
                            <tab-content title="Househelp Househelp Info" :before-change="validateupdateHousehelpDemograhic">
                                      <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="first_name" class="col-form-label"> Househelp First Name</label>
                                            <input v-model="househelpform.first_name" type="text" name="first_name" placeholder="Househelp First Name"
                                                class="form-control" :class="{ 'is-invalid': househelpform.errors.has('first_name') }" >
                                            <has-error style="color: #e83e8c" :form="househelpform" field="first_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="last_name" class=" col-form-label">Last Name </label>
                                            <input v-model="househelpform.last_name" type="last_name" name="last_name" placeholder="Last Name"
                                                class="form-control" :class="{ 'is-invalid': househelpform.errors.has('last_name') }" >
                                            <has-error style="color: #e83e8c" :form="househelpform" field="last_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="email" class=" col-form-label">Email </label>
                                            <input v-model="househelpform.email" type="email" name="email" placeholder="Email Address"
                                                class="form-control" :class="{ 'is-invalid': househelpform.errors.has('email') }" >
                                            <has-error style="color: #e83e8c" :form="househelpform" field="email"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <input v-model="househelpform.password" type="password" id="password" placeholder="Househelp Password"
                                                class="form-control" :class="{ 'is-invalid': househelpform.errors.has('password') }">
                                            <has-error style="color: #e83e8c" :form="househelpform" field="password"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div> Current Age is {{this.househelpform.age}} Years</div>
                                            <label for="birth_date" class="col-form-label">Househelp Birth Date</label>
                                                <datetime  v-model="househelpform.birth_date" v-on:input="househelpChangeDOB($event)" type="text" id="birth_date" placeholder="Househelp Birth Date"
                                                class="form-control"  input-class="form-control border-0" style="padding-top: 0px;"  :class="{ 'is-invalid': househelpform.errors.has('birth_date') }"></datetime>
                                            <has-error style="color: #e83e8c" :form="househelpform" field="birth_date"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="address" class=" col-form-label">Househelp Address</label>
                                            <input v-model="househelpform.address" type="text" name="Address" placeholder="Househelp Address"
                                                class="form-control" :class="{ 'is-invalid': househelpform.errors.has('address') }" >
                                            <has-error style="color: #e83e8c" :form="househelpform" field="address"></has-error>
                                        </div>

                                    </div>
                                    <div class=" row">
                                         <div class="form-group col-md-4">
                                            <label for="gender_id">Select Gender</label>
                                            <select class="form-control" v-model="househelpform.gender_id"
                                                    :class="{ 'is-invalid': househelpform.errors.has('gender_id') }">
                                                    <option disabled value="">Select gender</option>
                                                    <option v-for="gender in Genders" :value="gender.id" :key="gender.id">{{gender.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="househelpform" field="gender_id"></has-error>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="phone" class="col-form-label"> Househelp Phone</label>
                                                <div>
                                                    <vue-tel-input v-model="househelpform.phone" name="phone" @onInput="HousehelpInputPhone5"
                                                    class="form-control" :class="{ 'is-invalid': househelpform.errors.has('phone') }">
                                                    </vue-tel-input>
                                                    <has-error style="color: #e83e8c" :form="househelpform" field="phone"></has-error>
                                                </div>
                                                <div v-if="househelpform.phone" style="color: #e83e8c">
                                                    <span>Is valid: <strong>{{phone5.isValid}}</strong>,&nbsp;</span>
                                                    <span>Country: <strong>{{phone5.country}}</strong></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="photo" class=" col-form-label">Househelp PassPort Image</label><br>
                                                <input @change="househelpChangePassPhoto($event)" type="file" name="photo"
                                                    :class="{ 'is-invalid': househelpform.errors.has('photo') }"
                                                    class="form-control" style=" border: 1px solid #ffffff; padding-left: 0px;">
                                                    <img :src="updateHousehelpPassPhoto(househelpform.photo)" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="househelpform" field="photo"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-3">
                                            <label for="country_id">Select Country</label>
                                            <select class="form-control" @change="countryCounties(househelpform.country_id)"
                                            v-model="househelpform.country_id" :class="{ 'is-invalid': househelpform.errors.has('country_id') }">
                                                    <option disabled value="">Select Country</option>
                                                    <option v-for="country in Countries" :value="country.id" :key="country.id">{{country.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="househelpform" field="country_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="county_id" class=" col-form-label">County</label>
                                            <select class="form-control" @change="countyConstituencies(househelpform.county_id)"
                                            v-model="househelpform.county_id" :class="{ 'is-invalid': househelpform.errors.has('county_id') }">
                                                    <option disabled value="">Select County</option>
                                                    <option v-for="county in Counties" :value="county.id" :key="county.id">{{county.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="househelpform" field="county_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="constituency_id" class=" col-form-label">Constituency</label>
                                            <select class="form-control" @change="constituencyWards(househelpform.constituency_id)"
                                            v-model="househelpform.constituency_id" :class="{ 'is-invalid': househelpform.errors.has('constituency_id') }">
                                                    <option disabled value="">Select County</option>
                                                    <option v-for="constituency in Constituencies" :value="constituency.id" :key="constituency.id">{{constituency.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="househelpform" field="constituency_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="ward_id" class="col-form-label"> Ward </label>
                                            <select class="form-control"
                                            v-model="househelpform.ward_id" :class="{ 'is-invalid': househelpform.errors.has('ward_id') }">
                                                    <option disabled value="">Select Ward</option>
                                                    <option v-for="ward in Wards" :value="ward.id" :key="ward.id">{{ward.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="househelpform" field="ward_id"></has-error>
                                        </div>

                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <div>Househelp ID status</div>
                                            <div>
                                                <input type="radio" v-model="IDstatus" value="HasID">
                                                <label for="IDstatus" class="col-form-label"> Has ID card</label>
                                            </div>
                                            <div>
                                                <input type="radio" v-model="IDstatus" value="HASIDbutlost" checked>
                                                <label for="IDstatus" class="col-form-label"> Has ID (lost, waiting card)</label>
                                            </div>
                                            <div>
                                                <input type="radio" v-model="IDstatus" value="NOIDbutapplied">
                                                <label for="IDstatus" class="col-form-label"> NO ID (new, waiting card)</label>
                                            </div>
                                            <div>
                                                <input type="radio" v-model="IDstatus" value="NOID">
                                                <label for="IDstatus" class="col-form-label"> NO ID (completely) </label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <div v-show="IDstatus === 'HasID'">
                                               <label for="id_photo_front" class=" col-form-label">Househelp FrontSide ID Photo</label><br>
                                                <input @change="househelpChangeIDFrontPhoto($event)" type="file" name="id_photo_front"
                                                    :class="{ 'is-invalid': househelpform.errors.has('id_photo_front') }"
                                                     class="form-control" style=" border: 1px solid #ffffff;padding-left: 0px;">

                                                    <img :src="updateHousehelpIDFrontPhoto(househelpform.id_photo_front)" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="househelpform" field="id_photo_front"></has-error>
                                            </div>
                                            <div v-show="IDstatus === 'HASIDbutlost'">
                                                <label for="id_number" class="col-form-label">Househelp ID NO.</label>
                                                    <input v-model="househelpform.id_number" type="text" name="id_number" placeholder="Househelp ID NO"
                                                    class="form-control" :class="{ 'is-invalid': househelpform.errors.has('id_number') }" >
                                                   <has-error style="color: #e83e8c" :form="househelpform" field="id_number"></has-error>
                                            </div>
                                            <div v-show="IDstatus === 'NOIDbutapplied'">
                                                <label for="ref_number" class="col-form-label">Househelp Waiting Card Rer NO.</label>
                                                    <input v-model="househelpform.ref_number" type="text" name="ref_number" placeholder="Househelp Waiting card ref NO"
                                                    class="form-control" :class="{ 'is-invalid': househelpform.errors.has('ref_number') }" >
                                                   <has-error style="color: #e83e8c" :form="househelpform" field="ref_number"></has-error>
                                            </div>
                                            <div v-show="IDstatus === 'NOID'">
                                                <h5 class="text-center">This Househelp has No ID card Whatsoever,
                                                     but you can register and later update if Gets ID card</h5>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                             <div v-show="IDstatus === 'HasID'">
                                                <label for="id_photo_back" class=" col-form-label">Househelp BackSide ID Photo</label><br>
                                                    <input @change="househelpChangeIDBackPhoto($event)" type="file" name="id_photo_back"
                                                        :class="{ 'is-invalid': househelpform.errors.has('id_photo_back') }"
                                                        class="form-control" style=" border: 1px solid #ffffff;padding-left: 0px;">
                                                         <img :src="updateHousehelpIDBackPhoto(househelpform.id_photo_back)" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="househelpform" field="id_photo_back"></has-error>

                                               <div>
                                                   <label for="id_number" class="col-form-label">Househelp ID NO.</label>
                                                    <input v-model="househelpform.id_number" type="text" name="id_number" placeholder="Househelp ID NO"
                                                    class="form-control" :class="{ 'is-invalid': househelpform.errors.has('id_number') }" >
                                                   <has-error style="color: #e83e8c" :form="househelpform" field="id_number"></has-error>
                                               </div>
                                            </div>
                                            <div v-show="IDstatus === 'HASIDbutlost'">
                                                  <label for="waiting_card_photo" class="col-form-label">Househelp Waiting Card Photo</label>
                                                 <input @change="househelpChangeWaitingCardPhoto($event)" type="file" name="waiting_card_photo"
                                                    :class="{ 'is-invalid': househelpform.errors.has('waiting_card_photo') }"
                                                     class="form-control" style=" border: 1px solid #ffffff;padding-left: 0px;">
                                                     <img :src="updateHousehelpWaitingCardPhoto(househelpform.waiting_card_photo)" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="househelpform" field="waiting_card_photo"></has-error>
                                            </div>
                                            <div v-show="IDstatus === 'NOIDbutapplied'">
                                                <label for="waiting_card_photo" class=" col-form-label">Househelp Waiting Card Photo</label><br>
                                                <input @change="househelpChangeWaitingCardPhoto($event)" type="file" name="waiting_card_photo"
                                                    :class="{ 'is-invalid': househelpform.errors.has('waiting_card_photo') }"
                                                     class="form-control" style=" border: 1px solid #ffffff;padding-left: 0px;">
                                                    <img :src="updateHousehelpWaitingCardPhoto(househelpform.waiting_card_photo)" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="househelpform" field="waiting_card_photo"></has-error>
                                            </div>
                                        </div>
                                    </div>
                            </tab-content>
                            <tab-content title="Househelp Features Info" :before-change="validateupdateHousehelpAttributes">
                                    <div class=" row">
                                         <div class="form-group col-md-3">
                                            <label for="education_id">Select Education Level</label>
                                            <select class="form-control" v-model="househelpform.education_id"
                                                    :class="{ 'is-invalid': househelpform.errors.has('education_id') }">
                                                    <option disabled value="">Select education</option>
                                                    <option v-for="education in Educations" :value="education.id" :key="education.id">{{education.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="househelpform" field="education_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="experience_id">Select Experience</label>
                                            <select class="form-control" v-model="househelpform.experience_id"
                                                    :class="{ 'is-invalid': househelpform.errors.has('experience_id') }">
                                                    <option disabled value="">Select experience</option>
                                                    <option v-for="experience in Experiences" :value="experience.id" :key="experience.id">{{experience.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="househelpform" field="experience_id"></has-error>
                                        </div>
                                         <div class="form-group col-md-3">
                                            <label for="maritalstatus_id">Select Maritalstatus</label>
                                            <select class="form-control" v-model="househelpform.maritalstatus_id"
                                                    :class="{ 'is-invalid': househelpform.errors.has('maritalstatus_id') }">
                                                    <option disabled value="">Select maritalstatus</option>
                                                    <option v-for="maritalstatus in Maritalstatuses" :value="maritalstatus.id" :key="maritalstatus.id">{{maritalstatus.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="househelpform" field="maritalstatus_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="tribe_id">Select Tribe</label>
                                            <select class="form-control" v-model="househelpform.tribe_id"
                                                    :class="{ 'is-invalid': househelpform.errors.has('tribe_id') }">
                                                    <option disabled value="">Select tribe</option>
                                                    <option v-for="tribe in Tribes" :value="tribe.id" :key="tribe.id">{{tribe.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="househelpform" field="tribe_id"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                         <div class="form-group col-md-3">
                                            <label for="skill_id">Select Skill Level</label>
                                            <select class="form-control" v-model="househelpform.skill_id"
                                                    :class="{ 'is-invalid': househelpform.errors.has('skill_id') }">
                                                    <option disabled value="">Select skill</option>
                                                    <option v-for="skill in Skills" :value="skill.id" :key="skill.id">{{skill.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="househelpform" field="skill_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="operation_id">Select Operation</label>
                                            <select class="form-control" v-model="househelpform.operation_id"
                                                    :class="{ 'is-invalid': househelpform.errors.has('operation_id') }">
                                                    <option disabled value="">Select operation</option>
                                                    <option v-for="operation in Operations" :value="operation.id" :key="operation.id">{{operation.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="househelpform" field="operation_id"></has-error>
                                        </div>
                                         <div class="form-group col-md-3">
                                            <label for="duration_id">Select Duration</label>
                                            <select class="form-control" v-model="househelpform.duration_id"
                                                    :class="{ 'is-invalid': househelpform.errors.has('duration_id') }">
                                                    <option disabled value="">Select duration</option>
                                                    <option v-for="duration in Durations" :value="duration.id" :key="duration.id">{{duration.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="househelpform" field="duration_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="englishstatus_id">Select Englishstatus</label>
                                            <select class="form-control" v-model="househelpform.englishstatus_id"
                                                    :class="{ 'is-invalid': househelpform.errors.has('englishstatus_id') }">
                                                    <option disabled value="">Select englishstatus</option>
                                                    <option v-for="englishstatus in Englishstatuses" :value="englishstatus.id" :key="englishstatus.id">{{englishstatus.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="househelpform" field="englishstatus_id"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-3">
                                            <label for="religion_id">Select Religion Level</label>
                                            <select class="form-control" v-model="househelpform.religion_id"
                                                    :class="{ 'is-invalid': househelpform.errors.has('religion_id') }">
                                                    <option disabled value="">Select religion</option>
                                                    <option v-for="religion in Religions" :value="religion.id" :key="religion.id">{{religion.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="househelpform" field="religion_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="kid_id">Select Kid Level</label>
                                            <select class="form-control" v-model="househelpform.kid_id"
                                                    :class="{ 'is-invalid': househelpform.errors.has('kid_id') }">
                                                    <option disabled value="">Select kid</option>
                                                    <option v-for="kid in Kids" :value="kid.id" :key="kid.id">{{kid.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="househelpform" field="kid_id"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <div>Househelp Health Status</div>
                                            <div >
                                                <input type="radio" v-model="Healthstatus" value="HEALTHY">
                                                <label for="Healthstatus" class="col-form-label"> Is Healthy</label>
                                            </div>
                                            <div>
                                                <input type="radio" v-model="Healthstatus" value="HASMINOR">
                                                <label for="Healthstatus" class="col-form-label">Has Minor Health Issues</label>
                                            </div>

                                            <div>
                                                <input type="radio" v-model="Healthstatus" value="HASCHRONIC">
                                                <label for="Healthstatus" class="col-form-label">Has Other Chronic</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div v-show="Healthstatus === 'HEALTHY'">
                                                   <label for="health_HIV_status" class="col-form-label">HIV status</label>
                                                    <input v-model="househelpform.health_HIV_status" type="text" name="health_HIV_status" placeholder="HIV status"
                                                    class="form-control" :class="{ 'is-invalid': househelpform.errors.has('health_HIV_status') }" >
                                                   <has-error style="color: #e83e8c" :form="househelpform" field="health_HIV_status"></has-error>
                                            </div>
                                            <div v-show="Healthstatus === 'HASMINOR'">
                                                <label for="health_HIV_status" class="col-form-label">HIV status</label>
                                                    <input v-model="househelpform.health_HIV_status" type="text" name="health_HIV_status" placeholder="HIV status"
                                                    class="form-control" :class="{ 'is-invalid': househelpform.errors.has('health_HIV_status') }" >
                                                   <has-error style="color: #e83e8c" :form="househelpform" field="health_HIV_status"></has-error>
                                            </div>
                                            <div v-show="Healthstatus === 'HASCHRONIC'">
                                                <label for="health_HIV_status" class="col-form-label"> HIV status</label>
                                                    <input v-model="househelpform.health_HIV_status" type="text" name="health_HIV_status" placeholder="HIV status"
                                                    class="form-control" :class="{ 'is-invalid': househelpform.errors.has('health_HIV_status') }" >
                                                   <has-error style="color: #e83e8c" :form="househelpform" field="health_HIV_status"></has-error>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div v-show="Healthstatus === 'HASMINOR'">
                                                <label for="health_specify" class="col-form-label">Allergies Specification</label>
                                                <input v-model="househelpform.health_specify" type="text" name="health_specify" placeholder="Allergies Specification"
                                                   class="form-control" :class="{ 'is-invalid': househelpform.errors.has('health_specify') }" >
                                               <has-error style="color: #e83e8c" :form="househelpform" field="health_specify"></has-error>
                                            </div>
                                            <div v-show="Healthstatus === 'HASCHRONIC'">
                                                   <label for="health_chronic_details" class="col-form-label">Chronic Issues</label>
                                                    <input v-model="househelpform.health_chronic_details" type="text" name="health_chronic_details" placeholder="Chronic Issues"
                                                    class="form-control" :class="{ 'is-invalid': househelpform.errors.has('health_chronic_details') }" >
                                                   <has-error style="color: #e83e8c" :form="househelpform" field="health_chronic_details"></has-error>
                                            </div>
                                        </div>
                                    </div>
                            </tab-content>
                            <tab-content>
                                Update Houshelp
                            </tab-content>
                        </form-wizard>
                    </div>
                </div>
            </div>
        </div>



                <!-- Directors modal -->
        <div class="modal fade " id="DirectorsModal" tabindex="-1" role="dialog" aria-labelledby="DirectorsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title"  id="DirectorsModalLabel">Directors</h3>
                        <span>
                            <button class="btn btn-success"  @click.prevent="newDirectorModal(Bureau.id)">Add  <i class="fas fa-plus fw"></i></button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </span>
                    </div>
                    <div class="modal-body">
                        <div class="row" v-for="director in Bureau.bureaudirectors" :key="director.id">
                             <div class="col-sm-2" style="padding: 3px;">
                                 <img class="card-img-top" :src="directorLoadPassPhoto(director.pivot.photo)" style="width:100%; height:130px" alt="Card image cap">
                             </div>
                             <div class="col-sm-2" style="padding: 3px;">
                                 <img class="card-img-top" :src="directorLoadIDFrontPhoto(director.pivot.id_photo_front)" style="width:100%;height:65px" alt="Card image cap"><br>
                                 <img class="card-img-top" :src="directorLoadIDBackPhoto(director.pivot.id_photo_back)" style="width:100%;height:65px" alt="Card image cap">
                             </div>
                             <div class="col-sm-8" style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                        <div>{{director.full_name}},</div>
                                        <div>
                                            {{director.position_name}},
                                            <span style="color:#9a009a;">
                                                {{Bureau.name}},
                                            </span>
                                        </div>
                                        <div> ID: ,<span style="color:#9a009a;">{{director.pivot.id_no}}</span>,
                                            Phone: <span style="color:#9a009a;">{{director.pivot.phone}},</span>
                                        </div>
                                        <div>
                                            Mail: <span style="color:#9a009a;">{{director.email}},</span>
                                        </div>
                                            <div>P. O. Box , <span style="color:#9a009a;">{{director.pivot.address}}</span>,
                                            </div>
                                        <div>
                                            <span style="color:#9a009a;">{{director.ward_name}}</span> ward,
                                            <span style="color:#9a009a;">{{director.constituency_name}}</span> constituency,
                                        </div>
                                        <div >
                                            <span style="color:#9a009a;">{{director.county_name}}</span> county,
                                            <span style="color:#9a009a;">{{director.country_name}},</span>
                                        </div>
                                         <div class="clearfix" style="font-weight:bold;font-size:0.9em;">
                                            <span class="float-left" style="margin-bottom:-0.5em" >
                                                <div style="margin-bottom:0.25em"> Updated at:
                                                    <span style="color:#9a009a;">{{director.created_at | dateformat}} </span>
                                                </div>
                                            </span>
                                            <span class="float-right">
                                                <a href=""  @click.prevent="viewDirectorModal(director.user_id)">
                                                    <i class="fa fa-eye purple"></i>
                                                </a>
                                                <!-- <a href=""  @click.prevent="editDirectorModal(director.user_id)">
                                                    <i class="fa fa-edit blue"></i>
                                                </a>
                                                /
                                                <a href=""  @click.prevent="deleteDirector(director.user_id)">
                                                    <i class="fa fa-trash red"></i>
                                                </a> -->
                                            </span>
                                        </div>
                             </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
                <!-- view director -->
        <div class="modal fade " id="ViewDirectorModal" tabindex="-1" role="dialog" aria-labelledby="ViewDirectorModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" v-for="director in Director.bureaudirectors" :key="director.id">
                        <div class="row" >
                             <div class="row">
                                    <div class="col-sm-2" style="padding: 3px;">
                                        <img class="card-img-top" :src="directorLoadPassPhoto(director.pivot.photo)" style="width:100%; height:130px" alt="Card image cap">
                                    </div>
                                    <div class="col-sm-2" style="padding: 3px;">
                                        <img class="card-img-top" :src="directorLoadIDFrontPhoto(director.pivot.id_photo_front)" style="width:100%;height:65px" alt="Card image cap"><br>
                                        <img class="card-img-top" :src="directorLoadIDBackPhoto(director.pivot.id_photo_back)" style="width:100%;height:65px" alt="Card image cap">
                                    </div>
                                    <div class="col-sm-8" style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                        <div > Director: <span style="color:#9a009a;" >{{Director.full_name}},</span></div>
                                        <div>
                                            <div style="padding: 3px;">
                                                ID.:<span style="color:#9a009a;"> {{director.pivot.id_no}}</span>,
                                                Phone: <span style="color:#9a009a;">{{director.pivot.phone}},</span>
                                            </div>
                                        </div>
                                        <div> ID: ,<span style="color:#9a009a;">{{director.pivot.id_no}}</span>,
                                            Phone: <span style="color:#9a009a;">{{director.pivot.phone}},</span>
                                        </div>
                                        <div>
                                            Mail: <span style="color:#9a009a;">{{Director.email}},</span>
                                        </div>
                                            <div>P. O. Box , <span style="color:#9a009a;">{{director.pivot.address}}</span>,
                                            </div>
                                        <div>
                                            <span style="color:#9a009a;">{{director.ward_name}}</span> ward,
                                            <span style="color:#9a009a;">{{director.constituency_name}}</span> constituency,
                                        </div>
                                        <div >
                                            <span style="color:#9a009a;">{{director.county_name}}</span> county,
                                            <span style="color:#9a009a;">{{director.country_name}},</span>
                                        </div>
                                        <div class="clearfix" style="font-weight:bold;font-size:0.9em;">
                                            <span class="float-left" style="margin-bottom:-0.5em" >
                                                <div style="margin-bottom:0.25em"> Updated at:
                                                    <span style="color:#9a009a;">{{director.created_at | dateformat}} </span>
                                                </div>
                                            </span>
                                            <span class="float-right">
                                                <!-- <a href=""  @click.prevent="viewDirectorModal(director.user_id)">
                                                    <i class="fa fa-eye purple"></i>
                                                </a> -->
                                                <a href=""  @click.prevent="editDirectorModal(director.user_id)">
                                                    <i class="fa fa-edit blue"></i>
                                                </a>
                                                <!-- /
                                                <a href=""  @click.prevent="deleteDirector(director.user_id)">
                                                    <i class="fa fa-trash red"></i>
                                                </a> -->
                                            </span>
                                        </div>
                                    </div>
                             </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

                        <!-- Admins modal -->
        <div class="modal fade " id="AdminsModal" tabindex="-1" role="dialog" aria-labelledby="AdminsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title"  id="AdminsModalLabel">Admins</h3>
                        <span>
                            <button class="btn btn-success"  @click.prevent="newAdminModal(Bureau.id)">Add  <i class="fas fa-plus fw"></i></button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </span>
                    </div>
                    <div >
                        <div class="modal-body">
                            <div class="row" v-for="admin in Bureau.bureauadmins" :key="admin.id">
                                    <div class="col-sm-2" style="padding: 3px;">
                                        <img class="card-img-top" :src="adminLoadPassPhoto(admin.pivot.photo)" style="width:100%; height:130px" alt="Card image cap">
                                    </div>
                                    <div class="col-sm-2" style="padding: 3px;">
                                        <img class="card-img-top" :src="adminLoadIDFrontPhoto(admin.pivot.id_photo_front)" style="width:100%;height:65px" alt="Card image cap"><br>
                                        <img class="card-img-top" :src="adminLoadIDBackPhoto(admin.pivot.id_photo_back)" style="width:100%;height:65px" alt="Card image cap">
                                    </div>
                                    <div class="col-sm-8" style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                        <div>{{admin.full_name}},</div>
                                        <div>
                                            {{admin.position_name}},
                                            <span style="color:#9a009a;">
                                                {{Bureau.name}},
                                            </span>
                                        </div>
                                        <div> ID: ,<span style="color:#9a009a;">{{admin.pivot.id_no}}</span>,
                                            Phone: <span style="color:#9a009a;">{{admin.pivot.phone}},</span>
                                        </div>
                                        <div>
                                            Mail: <span style="color:#9a009a;">{{admin.email}},</span>
                                        </div>
                                            <div>P. O. Box , <span style="color:#9a009a;">{{admin.pivot.address}}</span>,
                                            </div>
                                        <div>
                                            <span style="color:#9a009a;">{{admin.ward_name}}</span> ward,
                                            <span style="color:#9a009a;">{{admin.constituency_name}}</span> constituency,
                                        </div>
                                        <div >
                                            <span style="color:#9a009a;">{{admin.county_name}}</span> county,
                                            <span style="color:#9a009a;">{{admin.country_name}},</span>
                                        </div>
                                         <div class="clearfix" style="font-weight:bold;font-size:0.9em;">
                                            <span class="float-left" style="margin-bottom:-0.5em" >
                                                <div style="margin-bottom:0.25em"> Updated at:
                                                    <span style="color:#9a009a;">{{admin.created_at | dateformat}} </span>
                                                </div>
                                            </span>
                                            <span class="float-right">
                                                <a href=""  @click.prevent="viewAdminModal(admin.user_id)">
                                                    <i class="fa fa-eye purple"></i>
                                                </a>
                                                <!-- <a href=""  @click.prevent="editAdminModal(admin.user_id)">
                                                    <i class="fa fa-edit blue"></i>
                                                </a>
                                                /
                                                <a href=""  @click.prevent="deleteAdmin(admin.user_id)">
                                                    <i class="fa fa-trash red"></i>
                                                </a> -->
                                            </span>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- view admin -->
        <div class="modal fade " id="ViewAdminModal" tabindex="-1" role="dialog" aria-labelledby="ViewAdminModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div  class="modal-body">
                      <div class="row" v-for="admin in Admin.bureauadmins" :key="admin.id">
                         <div class="col-sm-2" style="padding: 3px;">
                            <img class="card-img-top" :src="adminLoadPassPhoto(admin.pivot.photo)" style="width:100%; height:130px" alt="Card image cap">
                        </div>
                        <div class="col-sm-2" style="padding: 3px;">
                            <img class="card-img-top" :src="adminLoadIDFrontPhoto(admin.pivot.id_photo_front)" style="width:100%;height:65px" alt="Card image cap"><br>
                            <img class="card-img-top" :src="adminLoadIDBackPhoto(admin.pivot.id_photo_back)" style="width:100%;height:65px" alt="Card image cap">
                        </div>
                         <div class="col-sm-8" style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                            <div > Admin: <span style="color:#9a009a;" >{{Admin.full_name}},</span></div>
                            <div>
                                 {{admin.position_name}},
                                 <span style="color:#9a009a;">
                                     <!-- bureau name -->
                                     {{admin.name}},
                                 </span>
                             </div>
                             <div> ID: ,<span style="color:#9a009a;">{{admin.pivot.id_no}}</span>,
                                 Phone: <span style="color:#9a009a;">{{admin.pivot.phone}},</span>
                             </div>
                             <div>
                                 Mail: <span style="color:#9a009a;">{{Admin.email}},</span>
                             </div>
                                 <div>P. O. Box , <span style="color:#9a009a;">{{admin.pivot.address}}</span>,
                                 </div>
                             <div>
                                 <span style="color:#9a009a;">{{admin.ward_name}}</span> ward,
                                 <span style="color:#9a009a;">{{admin.constituency_name}}</span> constituency,
                             </div>
                             <div >
                                 <span style="color:#9a009a;">{{admin.county_name}}</span> county,
                                 <span style="color:#9a009a;">{{admin.country_name}},</span>
                             </div>
                             <div class="clearfix" style="font-weight:bold;font-size:0.9em;">
                                 <span class="float-left" style="margin-bottom:-0.5em" >
                                     <div style="margin-bottom:0.25em"> Updated at:
                                         <span style="color:#9a009a;">{{admin.created_at | dateformat}} </span>
                                     </div>
                                 </span>
                                 <span class="float-right">
                                     <!-- <a href=""  @click.prevent="viewAdminModal(admin.user_id)">
                                         <i class="fa fa-eye purple"></i>
                                     </a> -->
                                     <a href=""  @click.prevent="editAdminModal(admin.user_id)">
                                         <i class="fa fa-edit blue"></i>
                                     </a>
                                     <!-- /
                                     <a href=""  @click.prevent="deleteAdmin(admin.user_id)">
                                         <i class="fa fa-trash red"></i>
                                     </a> -->
                                 </span>
                             </div>
                        </div>
                       </div>
                     </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

                        <!-- Employees modal -->
        <div class="modal fade " id="EmployeesModal" tabindex="-1" role="dialog" aria-labelledby="EmployeesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title"  id="EmployeesModalLabel">Employees</h3>
                        <span>
                            <button class="btn btn-success"  @click.prevent="newEmployeeModal(Bureau.id)">Add  <i class="fas fa-plus fw"></i></button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </span>
                    </div>
                    <div >
                        <div class="modal-body">
                            <div class="row" v-for="employee in Bureau.bureauemployees" :key="employee.id">
                                    <div class="col-sm-2" style="padding: 3px;">
                                        <img class="card-img-top" :src="employeeLoadPassPhoto(employee.pivot.photo)" style="width:100%; height:130px" alt="Card image cap">
                                    </div>
                                    <div class="col-sm-2" style="padding: 3px;">
                                        <img class="card-img-top" :src="employeeLoadIDFrontPhoto(employee.pivot.id_photo_front)" style="width:100%;height:65px" alt="Card image cap"><br>
                                        <img class="card-img-top" :src="employeeLoadIDBackPhoto(employee.pivot.id_photo_back)" style="width:100%;height:65px" alt="Card image cap">
                                    </div>
                                    <div class="col-sm-8" style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                        <div>{{employee.full_name}},</div>
                                        <div>
                                            {{employee.position_name}},
                                            <span style="color:#9a009a;">
                                                {{Bureau.name}},
                                            </span>
                                        </div>
                                        <div> ID: ,<span style="color:#9a009a;">{{employee.pivot.id_no}}</span>,
                                            Phone: <span style="color:#9a009a;">{{employee.pivot.phone}},</span>
                                        </div>
                                        <div>
                                            Mail: <span style="color:#9a009a;">{{employee.email}},</span>
                                        </div>
                                            <div>P. O. Box , <span style="color:#9a009a;">{{employee.pivot.address}}</span>,
                                            </div>
                                        <div>
                                            <span style="color:#9a009a;">{{employee.ward_name}}</span> ward,
                                            <span style="color:#9a009a;">{{employee.constituency_name}}</span> constituency,
                                        </div>
                                        <div >
                                            <span style="color:#9a009a;">{{employee.county_name}}</span> county,
                                            <span style="color:#9a009a;">{{employee.country_name}},</span>
                                        </div>
                                         <div class="clearfix" style="font-weight:bold;font-size:0.9em;">
                                            <span class="float-left" style="margin-bottom:-0.5em" >
                                                <div style="margin-bottom:0.25em"> Updated at:
                                                    <span style="color:#9a009a;">{{employee.created_at | dateformat}} </span>
                                                </div>
                                            </span>
                                            <span class="float-right">
                                                <a href=""  @click.prevent="viewEmployeeModal(employee.user_id)">
                                                    <i class="fa fa-eye purple"></i>
                                                </a>
                                                <!-- <a href=""  @click.prevent="editEmployeeModal(employee.user_id)">
                                                    <i class="fa fa-edit blue"></i>
                                                </a>
                                                /
                                                <a href=""  @click.prevent="deleteEmployee(employee.user_id)">
                                                    <i class="fa fa-trash red"></i>
                                                </a> -->
                                            </span>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- view employee -->
        <div class="modal fade " id="ViewEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="ViewEmployeeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" >
                        <div class="row" v-for="employee in Employee.bureauemployees" :key="employee.id">
                            <div class="col-sm-2" style="padding: 3px;">
                                <img class="card-img-top" :src="employeeLoadPassPhoto(employee.pivot.photo)" style="width:100%; height:130px" alt="Card image cap">
                            </div>
                            <div class="col-sm-2" style="padding: 3px;">
                                <img class="card-img-top" :src="employeeLoadIDFrontPhoto(employee.pivot.id_photo_front)" style="width:100%;height:65px" alt="Card image cap"><br>
                                <img class="card-img-top" :src="employeeLoadIDBackPhoto(employee.pivot.id_photo_back)" style="width:100%;height:65px" alt="Card image cap">
                            </div>
                            <div class="col-sm-8" style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                <div > Employee: <span style="color:#9a009a;" >{{Employee.full_name}},</span></div>
                                <div> ID: ,<span style="color:#9a009a;">{{employee.pivot.id_no}}</span>,
                                    Phone: <span style="color:#9a009a;">{{employee.pivot.phone}},</span>
                                </div>
                                <div>
                                    Mail: <span style="color:#9a009a;">{{Employee.email}},</span>
                                </div>
                                    <div>P. O. Box , <span style="color:#9a009a;">{{employee.pivot.address}}</span>,
                                    </div>
                                <div>
                                    <span style="color:#9a009a;">{{employee.ward_name}}</span> ward,
                                    <span style="color:#9a009a;">{{employee.constituency_name}}</span> constituency,
                                </div>
                                <div >
                                    <span style="color:#9a009a;">{{employee.county_name}}</span> county,
                                    <span style="color:#9a009a;">{{employee.country_name}},</span>
                                </div>
                                <div class="clearfix" style="font-weight:bold;font-size:0.9em;">
                                    <span class="float-left" style="margin-bottom:-0.5em" >
                                        <div style="margin-bottom:0.25em"> Updated at:
                                            <span style="color:#9a009a;">{{employee.created_at | dateformat}} </span>
                                        </div>
                                    </span>
                                    <span class="float-right">
                                        <!-- <a href=""  @click.prevent="viewEmployeeModal(employee.user_id)">
                                            <i class="fa fa-eye purple"></i>
                                        </a> -->
                                        <a href=""  @click.prevent="editEmployeeModal(employee.user_id)">
                                            <i class="fa fa-edit blue"></i>
                                        </a>
                                        <!-- /
                                        <a href=""  @click.prevent="deleteEmployee(employee.user_id)">
                                            <i class="fa fa-trash red"></i>
                                        </a> -->
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- edit -->



        <!-- edit househelkin modal -->
        <div class="modal fade " id="HousehelpKinModal" tabindex="-1" role="dialog" aria-labelledby="HousehelpKinModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4> Update Househelp Kin data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form role="form" @submit.prevent="updateHousehelpKin(househelpkinform.id)" >
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="first_name" class="col-form-label"> Househelpkin First Name</label>
                                    <input v-model="househelpkinform.first_name" type="text" name="first_name" placeholder="Househelpkin First Name"
                                        class="form-control" :class="{ 'is-invalid': househelpkinform.errors.has('first_name') }" >
                                    <has-error style="color: #e83e8c" :form="househelpkinform" field="first_name"></has-error>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="last_name" class=" col-form-label">Last Name </label>
                                    <input v-model="househelpkinform.last_name" type="last_name" name="last_name" placeholder="Last Name"
                                        class="form-control" :class="{ 'is-invalid': househelpkinform.errors.has('last_name') }" >
                                    <has-error style="color: #e83e8c" :form="househelpkinform" field="last_name"></has-error>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="id_no" class="col-form-label">Househelpkin ID no.</label>
                                    <input v-model="househelpkinform.id_no" type="text" name="id_no" placeholder="Househelpkin ID NO"
                                        class="form-control" :class="{ 'is-invalid': househelpkinform.errors.has('id_no') }" >
                                    <has-error style="color: #e83e8c" :form="househelpkinform" field="id_no"></has-error>
                                </div>
                            </div>
                            <div class=" row">
                                <div class="form-group col-md-3">
                                    <label for="relationship_id">Select Relationship </label>
                                    <select class="form-control" v-model="househelpkinform.relationship_id"
                                            :class="{ 'is-invalid': househelpkinform.errors.has('relationship_id') }">
                                            <option disabled value="">Select relationship</option>
                                            <option v-for="relationship in Relationships" :value="relationship.id" :key="relationship.id">{{relationship.name}}</option>
                                    </select>
                                        <has-error style="color: #e83e8c" :form="househelpkinform" field="gender_id"></has-error>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="gender_id">Select Gender</label>
                                    <select class="form-control" v-model="househelpkinform.gender_id"
                                            :class="{ 'is-invalid': househelpkinform.errors.has('gender_id') }">
                                            <option disabled value="">Select gender</option>
                                            <option v-for="gender in Genders" :value="gender.id" :key="gender.id">{{gender.name}}</option>
                                    </select>
                                        <has-error style="color: #e83e8c" :form="househelpkinform" field="gender_id"></has-error>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="address" class=" col-form-label">Househelpkin Address</label>
                                    <input v-model="househelpkinform.address" type="text" name="Address" placeholder="Househelpkin Address"
                                        class="form-control" :class="{ 'is-invalid': househelpkinform.errors.has('address') }" >
                                    <has-error style="color: #e83e8c" :form="househelpkinform" field="address"></has-error>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="phone" class="col-form-label"> Househelpkin Phone</label>
                                        <div>
                                            <vue-tel-input v-model="househelpkinform.phone" name="phone" @onInput="HousehelpkinInputPhone6"
                                            class="form-control" :class="{ 'is-invalid': househelpkinform.errors.has('phone') }">
                                            </vue-tel-input>

                                            <has-error style="color: #e83e8c" :form="househelpkinform" field="phone"></has-error>
                                        </div>
                                        <div v-if="househelpkinform.phone" style="color: #e83e8c">
                                            <span>Is valid: <strong>{{phone6.isValid}}</strong>,&nbsp;</span>
                                            <span>Country: <strong>{{phone6.country}}</strong></span>
                                    </div>
                                </div>
                            </div>
                            <div class=" row">
                                <div class="form-group col-md-3">
                                    <label for="country_id">Select Country</label>
                                    <select class="form-control" @change="countryCounties(househelpkinform.country_id)"
                                    v-model="househelpkinform.country_id" :class="{ 'is-invalid': househelpkinform.errors.has('country_id') }">
                                            <option disabled value="">Select Country</option>
                                            <option v-for="country in Countries" :value="country.id" :key="country.id">{{country.name}}</option>
                                    </select>
                                        <has-error style="color: #e83e8c" :form="househelpkinform" field="country_id"></has-error>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="county_id" class=" col-form-label">County</label>
                                    <select class="form-control" @change="countyConstituencies(househelpkinform.county_id)"
                                    v-model="househelpkinform.county_id" :class="{ 'is-invalid': househelpkinform.errors.has('county_id') }">
                                            <option disabled value="">Select County</option>
                                            <option v-for="county in Counties" :value="county.id" :key="county.id">{{county.name}}</option>
                                    </select>
                                    <has-error style="color: #e83e8c" :form="househelpkinform" field="county_id"></has-error>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="constituency_id" class=" col-form-label">Constituency</label>
                                    <select class="form-control" @change="constituencyWards(househelpkinform.constituency_id)"
                                    v-model="househelpkinform.constituency_id" :class="{ 'is-invalid': househelpkinform.errors.has('constituency_id') }">
                                            <option disabled value="">Select County</option>
                                            <option v-for="constituency in Constituencies" :value="constituency.id" :key="constituency.id">{{constituency.name}}</option>
                                    </select>
                                    <has-error style="color: #e83e8c" :form="househelpkinform" field="constituency_id"></has-error>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="ward_id" class="col-form-label"> Ward </label>
                                    <select class="form-control"
                                    v-model="househelpkinform.ward_id" :class="{ 'is-invalid': househelpkinform.errors.has('ward_id') }">
                                            <option disabled value="">Select Ward</option>
                                            <option v-for="ward in Wards" :value="ward.id" :key="ward.id">{{ward.name}}</option>
                                    </select>
                                    <has-error style="color: #e83e8c" :form="househelpkinform" field="ward_id"></has-error>
                                </div>
                            </div>
                            <div class=" row">
                                <div class="form-group col-md-4">
                                    <label for="photo" class=" col-form-label">Househelpkin PassPort Image</label><br>
                                        <input @change="househelpkinChangePassPhoto($event)" type="file" name="photo"
                                            :class="{ 'is-invalid': househelpkinform.errors.has('photo') }">
                                            <img :src="updateHousehelpKinPassPhoto(househelpkinform.photo)" alt="" width="100%" >
                                        <has-error style="color: #e83e8c" :form="househelpkinform" field="photo"></has-error>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="id_photo_front" class=" col-form-label">Househelpkin FrontSide ID Photo</label><br>
                                        <input @change="househelpkinChangeIDFrontPhoto($event)" type="file" name="id_photo_front"
                                            :class="{ 'is-invalid': househelpkinform.errors.has('id_photo_front') }">
                                            <img :src="updateHousehelpKinIDFrontPhoto(househelpkinform.id_photo_front)" alt="" width="100%" >
                                        <has-error style="color: #e83e8c" :form="househelpkinform" field="id_photo_front"></has-error>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="id_photo_back" class=" col-form-label">Househelpkin BackSide ID Photo</label><br>
                                        <input @change="househelpkinChangeIDBackPhoto($event)" type="file" name="id_photo_back"
                                            :class="{ 'is-invalid': househelpkinform.errors.has('id_photo_back') }">
                                            <img :src="updateHousehelpKinIDBackPhoto(househelpkinform.id_photo_back)" alt="" width="100%" >
                                        <has-error style="color: #e83e8c" :form="househelpkinform" field="id_photo_back"></has-error>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- create & edit Director modal -->
        <div class="modal fade " id="DirectorModal" tabindex="-1" role="dialog" aria-labelledby="DirectorModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form role="form" @submit.prevent="editmodeDirector ? updateDirector(directorform.id) : addDirector(Bureau.id)" >
                        <div class="modal-body">
                            <h5 class="modal-title" v-show="editmodeDirector" id="DirectorModalLabel">Update Director</h5>
                            <h5 class="modal-title" v-show="!editmodeDirector" id="DirectorModalLabel">Add New Director</h5>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="first_name" class="col-form-label"> Director First Name</label>
                                            <input v-model="directorform.first_name" type="text" name="first_name" placeholder="Director First Name"
                                                class="form-control" :class="{ 'is-invalid': directorform.errors.has('first_name') }" >
                                            <has-error style="color: #e83e8c" :form="directorform" field="first_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="last_name" class=" col-form-label">director_Last Name </label>
                                            <input v-model="directorform.last_name" type="director_last_name" name="last_name" placeholder="Director Last Name"
                                                class="form-control" :class="{ 'is-invalid': directorform.errors.has('last_name') }" >
                                            <has-error style="color: #e83e8c" :form="directorform" field="last_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="email" class=" col-form-label">Email </label>
                                            <input v-model="directorform.email" type="email" name="email" placeholder="Email Address"
                                                class="form-control" :class="{ 'is-invalid': directorform.errors.has('email') }" >
                                            <has-error style="color: #e83e8c" :form="directorform" field="email"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-3">
                                            <input v-model="directorform.password" type="password" id="password" placeholder="Password"
                                                class="form-control" :class="{ 'is-invalid': directorform.errors.has('password') }">
                                            <has-error :form="directorform" field="password"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="phone" class="col-form-label"> Director Phone</label>
                                                <div>
                                                    <vue-tel-input v-model="directorform.phone" name="phone" @onInput="DirectorInputPhone"
                                                    class="form-control" :class="{ 'is-invalid': directorform.errors.has('phone') }">
                                                    </vue-tel-input>
                                                    <has-error style="color: #e83e8c" :form="directorform" field="phone"></has-error>
                                                </div>
                                                <div v-if="directorform.phone" style="color: #e83e8c">
                                                    <span>Is valid: <strong>{{phone2.isValid}}</strong>,&nbsp;</span>
                                                    <span>Country: <strong>{{phone2.country}}</strong></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="landline" class=" col-form-label">Landline</label>
                                                <vue-tel-input v-model="directorform.landline" name="landline" @onInput="DirectorInputLandline"
                                                    class="form-control" :class="{ 'is-invalid': directorform.errors.has('landline') }">
                                                </vue-tel-input>
                                                <has-error style="color: #e83e8c" :form="directorform" field="landline"></has-error>

                                                <div v-if="directorform.landline" style="color: #e83e8c">
                                                    <span>Is valid: <strong>{{landline2.isValid}}</strong>,&nbsp;</span>
                                                    <span>Country: <strong>{{landline2.country}}</strong></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="gender_id">Select Gender</label>
                                            <select class="form-control" v-model="directorform.gender_id"
                                                    :class="{ 'is-invalid': directorform.errors.has('gender_id') }">
                                                    <option disabled value="">Select gender</option>
                                                    <option v-for="gender in Genders" :value="gender.id" :key="gender.id">{{gender.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="directorform" field="gender_id"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <label for="id_no" class="col-form-label">ID no.</label>
                                            <input v-model="directorform.id_no" type="text" name="id_no" placeholder="ID NO"
                                                class="form-control" :class="{ 'is-invalid': directorform.errors.has('id_no') }" >
                                            <has-error style="color: #e83e8c" :form="directorform" field="id_no"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="address" class=" col-form-label">Address</label>
                                            <input v-model="directorform.address" type="text" name="address" placeholder="Address"
                                                class="form-control" :class="{ 'is-invalid': directorform.errors.has('address') }" >
                                            <has-error style="color: #e83e8c" :form="directorform" field="country_id"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-3">
                                            <label for="country_id">Select Country</label>
                                            <select class="form-control" @change="countryCounties(directorform.country_id)"
                                            v-model="directorform.country_id" :class="{ 'is-invalid': directorform.errors.has('country_id') }">
                                                    <option disabled value="">Select Country</option>{{directorform.country_id}}
                                                    <option v-for="country in Countries" :value="country.id" :key="country.id">{{country.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="directorform" field="country_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="county_id" class=" col-form-label">County</label>
                                            <select class="form-control" @change="countyConstituencies(directorform.county_id)"
                                            v-model="directorform.county_id" :class="{ 'is-invalid': directorform.errors.has('county_id') }">
                                                    <option disabled value="">Select County</option>
                                                    <option v-for="county in Counties" :value="county.id" :key="county.id">{{county.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="directorform" field="county_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="constituency_id" class=" col-form-label">Constituency</label>
                                            <select class="form-control" @change="constituencyWards(directorform.constituency_id)"
                                            v-model="directorform.constituency_id" :class="{ 'is-invalid': directorform.errors.has('constituency_id') }">
                                                    <option disabled value="">Select County</option>
                                                    <option v-for="constituency in Constituencies" :value="constituency.id" :key="constituency.id">{{constituency.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="directorform" field="constituency_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="ward_id" class="col-form-label"> Ward </label>
                                            <select class="form-control"
                                            v-model="directorform.ward_id" :class="{ 'is-invalid': directorform.errors.has('ward_id') }">
                                                    <option disabled value="">Select Ward</option>
                                                    <option v-for="ward in Wards" :value="ward.id" :key="ward.id">{{ward.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="directorform" field="ward_id"></has-error>
                                        </div>

                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <label for="photo" class=" col-form-label">Director PassPort Image</label><br>
                                                <input @change="directorChangePassPhoto($event)" type="file" name="photo"
                                                    :class="{ 'is-invalid': directorform.errors.has('photo') }">
                                                    <img v-show="editmodeDirector" :src="updateDirectorPassPhoto(directorform.photo)" alt="" width="100%" >
                                                    <img  v-show="!editmodeDirector" :src="directorform.photo" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="directorform" field="photo"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="id_photo_front" class=" col-form-label">Director FrontSide ID Photo</label><br>
                                                <input @change="directorChangeIDFrontPhoto($event)" type="file" name="id_photo_front"
                                                    :class="{ 'is-invalid': directorform.errors.has('id_photo_front') }">
                                                    <img v-show="editmodeDirector" :src="updateDirectorIDFrontPhoto(directorform.id_photo_front)" alt="" width="100%" >
                                                    <img  v-show="!editmodeDirector" :src="directorform.id_photo_front" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="directorform" field="id_photo_front"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="backside_i_photod" class=" col-form-label">BackSide ID Photo</label><br>
                                                <input @change="directorChangeIDBackPhoto($event)" type="file" name="id_photo_back"
                                                    :class="{ 'is-invalid': directorform.errors.has('backside_id') }">
                                                    <img v-show="editmodeDirector" :src="updateDirectorIDBackPhoto(directorform.id_photo_back)" alt="" width="100%" >
                                                    <img  v-show="!editmodeDirector" :src="directorform.id_photo_back" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="directorform" field="id_photo_back"></has-error>
                                        </div>
                                    </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editmodeDirector" type="submit" class="btn btn-success">Update</button>
                            <button v-show="!editmodeDirector" type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
     <!-- create & edit Admin modal -->
        <div class="modal fade " id="AdminModal" tabindex="-1" role="dialog" aria-labelledby="AdminModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form role="form" @submit.prevent="editmodeAdmin ? updateAdmin(adminform.id) : addAdmin(Bureau.id)" >
                        <div class="modal-body">
                            <h5 class="modal-title" v-show="editmodeAdmin" id="AdminModalLabel">Update Admin</h5>
                            <h5 class="modal-title" v-show="!editmodeAdmin" id="AdminModalLabel">Add New Admin</h5>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="first_name" class="col-form-label"> Admin First Name</label>
                                            <input v-model="adminform.first_name" type="text" name="first_name" placeholder="Admin First Name"
                                                class="form-control" :class="{ 'is-invalid': adminform.errors.has('first_name') }" >
                                            <has-error style="color: #e83e8c" :form="adminform" field="first_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="last_name" class=" col-form-label">admin_Last Name </label>
                                            <input v-model="adminform.last_name" type="admin_last_name" name="last_name" placeholder="Admin Last Name"
                                                class="form-control" :class="{ 'is-invalid': adminform.errors.has('last_name') }" >
                                            <has-error style="color: #e83e8c" :form="adminform" field="last_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="email" class=" col-form-label">Email </label>
                                            <input v-model="adminform.email" type="email" name="email" placeholder="Email Address"
                                                class="form-control" :class="{ 'is-invalid': adminform.errors.has('email') }" >
                                            <has-error style="color: #e83e8c" :form="adminform" field="email"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-3">
                                            <input v-model="adminform.password" type="password" id="password" placeholder="Password"
                                                class="form-control" :class="{ 'is-invalid': adminform.errors.has('password') }">
                                            <has-error :form="adminform" field="password"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="phone" class="col-form-label"> Admin Phone</label>
                                                <div>
                                                    <vue-tel-input v-model="adminform.phone" name="phone" @onInput="AdminInputPhone"
                                                    class="form-control" :class="{ 'is-invalid': adminform.errors.has('phone') }">
                                                    </vue-tel-input>
                                                    <has-error style="color: #e83e8c" :form="adminform" field="phone"></has-error>
                                                </div>
                                                <div v-if="adminform.phone" style="color: #e83e8c">
                                                    <span>Is valid: <strong>{{phone3.isValid}}</strong>,&nbsp;</span>
                                                    <span>Country: <strong>{{phone3.country}}</strong></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="landline" class=" col-form-label">Landline</label>
                                                <vue-tel-input v-model="adminform.landline" name="landline" @onInput="AdminInputLandline"
                                                    class="form-control" :class="{ 'is-invalid': adminform.errors.has('landline') }">
                                                </vue-tel-input>
                                                <has-error style="color: #e83e8c" :form="adminform" field="landline"></has-error>

                                                <div v-if="adminform.landline" style="color: #e83e8c">
                                                    <span>Is valid: <strong>{{landline3.isValid}}</strong>,&nbsp;</span>
                                                    <span>Country: <strong>{{landline3.country}}</strong></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="gender_id">Select Gender</label>
                                            <select class="form-control" v-model="adminform.gender_id"
                                                    :class="{ 'is-invalid': adminform.errors.has('gender_id') }">
                                                    <option disabled value="">Select gender</option>
                                                    <option v-for="gender in Genders" :value="gender.id" :key="gender.id">{{gender.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="adminform" field="gender_id"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <label for="id_no" class="col-form-label">ID no.</label>
                                            <input v-model="adminform.id_no" type="text" name="id_no" placeholder="ID NO"
                                                class="form-control" :class="{ 'is-invalid': adminform.errors.has('id_no') }" >
                                            <has-error style="color: #e83e8c" :form="adminform" field="id_no"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="address" class=" col-form-label">Address</label>
                                            <input v-model="adminform.address" type="text" name="address" placeholder="Address"
                                                class="form-control" :class="{ 'is-invalid': adminform.errors.has('address') }" >
                                            <has-error style="color: #e83e8c" :form="adminform" field="country_id"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-3">
                                            <label for="country_id">Select Country</label>
                                            <select class="form-control" @change="countryCounties(adminform.country_id)"
                                            v-model="adminform.country_id" :class="{ 'is-invalid': adminform.errors.has('country_id') }">
                                                    <option disabled value="">Select Country</option>{{adminform.country_id}}
                                                    <option v-for="country in Countries" :value="country.id" :key="country.id">{{country.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="adminform" field="country_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="county_id" class=" col-form-label">County</label>
                                            <select class="form-control" @change="countyConstituencies(adminform.county_id)"
                                            v-model="adminform.county_id" :class="{ 'is-invalid': adminform.errors.has('county_id') }">
                                                    <option disabled value="">Select County</option>
                                                    <option v-for="county in Counties" :value="county.id" :key="county.id">{{county.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="adminform" field="county_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="constituency_id" class=" col-form-label">Constituency</label>
                                            <select class="form-control" @change="constituencyWards(adminform.constituency_id)"
                                            v-model="adminform.constituency_id" :class="{ 'is-invalid': adminform.errors.has('constituency_id') }">
                                                    <option disabled value="">Select County</option>
                                                    <option v-for="constituency in Constituencies" :value="constituency.id" :key="constituency.id">{{constituency.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="adminform" field="constituency_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="ward_id" class="col-form-label"> Ward </label>
                                            <select class="form-control"
                                            v-model="adminform.ward_id" :class="{ 'is-invalid': adminform.errors.has('ward_id') }">
                                                    <option disabled value="">Select Ward</option>
                                                    <option v-for="ward in Wards" :value="ward.id" :key="ward.id">{{ward.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="adminform" field="ward_id"></has-error>
                                        </div>

                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <label for="photo" class=" col-form-label">Admin PassPort Image</label><br>
                                                <input @change="adminChangePassPhoto($event)" type="file" name="photo"
                                                    :class="{ 'is-invalid': adminform.errors.has('photo') }">
                                                    <img v-show="editmodeAdmin" :src="updateAdminPassPhoto(adminform.photo)" alt="" width="100%" >
                                                    <img  v-show="!editmodeAdmin" :src="adminform.photo" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="adminform" field="photo"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="id_photo_front" class=" col-form-label">Admin FrontSide ID Photo</label><br>
                                                <input @change="adminChangeIDFrontPhoto($event)" type="file" name="id_photo_front"
                                                    :class="{ 'is-invalid': adminform.errors.has('id_photo_front') }">
                                                    <img v-show="editmodeAdmin" :src="updateAdminIDFrontPhoto(adminform.id_photo_front)" alt="" width="100%" >
                                                    <img  v-show="!editmodeAdmin" :src="adminform.id_photo_front" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="adminform" field="id_photo_front"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="backside_i_photod" class=" col-form-label">BackSide ID Photo</label><br>
                                                <input @change="adminChangeIDBackPhoto($event)" type="file" name="id_photo_back"
                                                    :class="{ 'is-invalid': adminform.errors.has('backside_id') }">
                                                    <img v-show="editmodeAdmin" :src="updateAdminIDBackPhoto(adminform.id_photo_back)" alt="" width="100%" >
                                                    <img  v-show="!editmodeAdmin" :src="adminform.id_photo_back" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="adminform" field="id_photo_back"></has-error>
                                        </div>
                                    </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editmodeAdmin" type="submit" class="btn btn-success">Update</button>
                            <button v-show="!editmodeAdmin" type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- create & edit Employee modal -->
        <div class="modal fade " id="EmployeeModal" tabindex="-1" role="dialog" aria-labelledby="EmployeeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form role="form" @submit.prevent="editmodeEmployee ? updateEmployee(employeeform.id) : addEmployee(Bureau.id)" >
                        <div class="modal-body">
                            <h5 class="modal-title" v-show="editmodeEmployee" id="EmployeeModalLabel">Update Employee</h5>
                            <h5 class="modal-title" v-show="!editmodeEmployee" id="EmployeeModalLabel">Add New Employee</h5>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="first_name" class="col-form-label"> Employee First Name</label>
                                            <input v-model="employeeform.first_name" type="text" name="first_name" placeholder="Employee First Name"
                                                class="form-control" :class="{ 'is-invalid': employeeform.errors.has('first_name') }" >
                                            <has-error style="color: #e83e8c" :form="employeeform" field="first_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="last_name" class=" col-form-label">employee_Last Name </label>
                                            <input v-model="employeeform.last_name" type="employee_last_name" name="last_name" placeholder="Employee Last Name"
                                                class="form-control" :class="{ 'is-invalid': employeeform.errors.has('last_name') }" >
                                            <has-error style="color: #e83e8c" :form="employeeform" field="last_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="email" class=" col-form-label">Email </label>
                                            <input v-model="employeeform.email" type="email" name="email" placeholder="Email Address"
                                                class="form-control" :class="{ 'is-invalid': employeeform.errors.has('email') }" >
                                            <has-error style="color: #e83e8c" :form="employeeform" field="email"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-3">
                                            <input v-model="employeeform.password" type="password" id="password" placeholder="Password"
                                                class="form-control" :class="{ 'is-invalid': employeeform.errors.has('password') }">
                                            <has-error :form="employeeform" field="password"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="phone" class="col-form-label"> Employee Phone</label>
                                                <div>
                                                    <vue-tel-input v-model="employeeform.phone" name="phone" @onInput="EmployeeInputPhone"
                                                    class="form-control" :class="{ 'is-invalid': employeeform.errors.has('phone') }">
                                                    </vue-tel-input>
                                                    <has-error style="color: #e83e8c" :form="employeeform" field="phone"></has-error>
                                                </div>
                                                <div v-if="employeeform.phone" style="color: #e83e8c">
                                                    <span>Is valid: <strong>{{phone4.isValid}}</strong>,&nbsp;</span>
                                                    <span>Country: <strong>{{phone4.country}}</strong></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="landline" class=" col-form-label">Landline</label>
                                                <vue-tel-input v-model="employeeform.landline" name="landline" @onInput="EmployeeInputLandline"
                                                    class="form-control" :class="{ 'is-invalid': employeeform.errors.has('landline') }">
                                                </vue-tel-input>
                                                <has-error style="color: #e83e8c" :form="employeeform" field="landline"></has-error>

                                                <div v-if="employeeform.landline" style="color: #e83e8c">
                                                    <span>Is valid: <strong>{{landline4.isValid}}</strong>,&nbsp;</span>
                                                    <span>Country: <strong>{{landline4.country}}</strong></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="gender_id">Select Gender</label>
                                            <select class="form-control" v-model="employeeform.gender_id"
                                                    :class="{ 'is-invalid': employeeform.errors.has('gender_id') }">
                                                    <option disabled value="">Select gender</option>
                                                    <option v-for="gender in Genders" :value="gender.id" :key="gender.id">{{gender.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="employeeform" field="gender_id"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <label for="id_no" class="col-form-label">ID no.</label>
                                            <input v-model="employeeform.id_no" type="text" name="id_no" placeholder="ID NO"
                                                class="form-control" :class="{ 'is-invalid': employeeform.errors.has('id_no') }" >
                                            <has-error style="color: #e83e8c" :form="employeeform" field="id_no"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="address" class=" col-form-label">Address</label>
                                            <input v-model="employeeform.address" type="text" name="address" placeholder="Address"
                                                class="form-control" :class="{ 'is-invalid': employeeform.errors.has('address') }" >
                                            <has-error style="color: #e83e8c" :form="employeeform" field="country_id"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-3">
                                            <label for="country_id">Select Country</label>
                                            <select class="form-control" @change="countryCounties(employeeform.country_id)"
                                            v-model="employeeform.country_id" :class="{ 'is-invalid': employeeform.errors.has('country_id') }">
                                                    <option disabled value="">Select Country</option>{{employeeform.country_id}}
                                                    <option v-for="country in Countries" :value="country.id" :key="country.id">{{country.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="employeeform" field="country_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="county_id" class=" col-form-label">County</label>
                                            <select class="form-control" @change="countyConstituencies(employeeform.county_id)"
                                            v-model="employeeform.county_id" :class="{ 'is-invalid': employeeform.errors.has('county_id') }">
                                                    <option disabled value="">Select County</option>
                                                    <option v-for="county in Counties" :value="county.id" :key="county.id">{{county.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="employeeform" field="county_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="constituency_id" class=" col-form-label">Constituency</label>
                                            <select class="form-control" @change="constituencyWards(employeeform.constituency_id)"
                                            v-model="employeeform.constituency_id" :class="{ 'is-invalid': employeeform.errors.has('constituency_id') }">
                                                    <option disabled value="">Select County</option>
                                                    <option v-for="constituency in Constituencies" :value="constituency.id" :key="constituency.id">{{constituency.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="employeeform" field="constituency_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="ward_id" class="col-form-label"> Ward </label>
                                            <select class="form-control"
                                            v-model="employeeform.ward_id" :class="{ 'is-invalid': employeeform.errors.has('ward_id') }">
                                                    <option disabled value="">Select Ward</option>
                                                    <option v-for="ward in Wards" :value="ward.id" :key="ward.id">{{ward.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="employeeform" field="ward_id"></has-error>
                                        </div>

                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <label for="photo" class=" col-form-label">Employee PassPort Image</label><br>
                                                <input @change="employeeChangePassPhoto($event)" type="file" name="photo"
                                                    :class="{ 'is-invalid': employeeform.errors.has('photo') }">
                                                    <img v-show="editmodeEmployee" :src="updateEmployeePassPhoto(employeeform.photo)" alt="" width="100%" >
                                                    <img  v-show="!editmodeEmployee" :src="employeeform.photo" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="employeeform" field="photo"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="id_photo_front" class=" col-form-label">Employee FrontSide ID Photo</label><br>
                                                <input @change="employeeChangeIDFrontPhoto($event)" type="file" name="id_photo_front"
                                                    :class="{ 'is-invalid': employeeform.errors.has('id_photo_front') }">
                                                    <img v-show="editmodeEmployee" :src="updateEmployeeIDFrontPhoto(employeeform.id_photo_front)" alt="" width="100%" >
                                                    <img  v-show="!editmodeEmployee" :src="employeeform.id_photo_front" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="employeeform" field="id_photo_front"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="backside_i_photod" class=" col-form-label">BackSide ID Photo</label><br>
                                                <input @change="employeeChangeIDBackPhoto($event)" type="file" name="id_photo_back"
                                                    :class="{ 'is-invalid': employeeform.errors.has('backside_id') }">
                                                    <img v-show="editmodeEmployee" :src="updateEmployeeIDBackPhoto(employeeform.id_photo_back)" alt="" width="100%" >
                                                    <img  v-show="!editmodeEmployee" :src="employeeform.id_photo_back" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="employeeform" field="id_photo_back"></has-error>
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
</template>

<script>

    import VueTelInput from 'vue-tel-input';
    export default {
        components: {
            VueTelInput,
        },
        name:"SingleBureau",
        data(){
            return{
                imageUrl:'',
                IDstatus:'',    //id status check
                Healthstatus:'',
                househelpform: new Form({
                        id:'',
                        first_name:'',
                        last_name:'',
                        email:'',
                        password:'',

                        user_id:'',
                        bureau_id:'',

                        photo:'',

                        about_me:'',
                        phone:'',
                        address:'',
                        country_id:'',
                        county_id:'',
                        constituency_id:'',
                        ward_id:'',
                        //extra
                        birth_date:'',
                        age:'',
                        gender_id:'',
                        education_id:'',
                        experience_id:'',
                        maritalstatus_id:'',
                        tribe_id:'',
                        skill_id:'',
                        operation_id:'',
                        duration_id:'',
                        englishstatus_id:'',
                        religion_id:'',
                        kid_id:'',
                        //id status
                        //id status

                        IDstatus:'',
                        idstatus_id:'',//id of idstatus row
                        bureau_househelp_id:'',
                        id_status:'',
                        id_number:'',
                        ref_number:'',
                        id_photo_front:'',
                        id_photo_back:'',
                        waiting_card_photo:'',
                        id_status_reason:'',

                        //health status
                        HealthStatus:'',
                        health_status_id:'',
                        health_status:'',
                        health_HIV_status:'',
                        health_allergy:'',
                        health_chronic_details:'',
                        health_other_chronics:'',
                        health_specify:'',
                }),
                househelpkinform: new Form({
                        id:'',
                        //househelp
                        first_name:'',
                        last_name:'',
                        email:'',
                        password:'',
                        user_type:'',


                        bureau_househelp_id:'',
                        gender_id:'',
                        user_id:'',
                        househelp_id:'',
                        relationship_id:'',

                        id_no:'',
                        photo:'',
                        id_photo_front:'',
                        id_photo_back:'',
                        phone:'',
                        address:'',
                        country_id:'',
                        county_id:'',
                        constituency_id:'',
                        ward_id:'',
                }),
                Unemployed:'',
                Employed:'',
                Pending:'',
                Status:'',
                employmentstatus:false,
                hirestatus:false,
                urlform: new Form({
                    bureau_id:'',
                    househelp_id:'',
                    director_id:'',
                    admin_id:'',
                    employee_id:'',
                         url:'/api/househelp/get/unemployed/',//by default fetch unemploed househelp of specific bureau
               unemployedurl: '/api/househelp/get/unemployed/',
                 employedurl: '/api/househelp/get/employed/',
                  pendingurl: '/api/househelp/get/pending/',
               }),
                newBureauDirector: false,
                editmodeBureau: false,
                bureauOutput:'',//view form data and confirm if is ok before submit
                bureauform: new Form({
                        id:'',
                        name:'',
                        bureau_email:'',
                        phone:'',
                        landline:'',
                        website:'',
                        address:'',
                        country_id:'',
                        county_id:'',
                        constituency_id:'',
                        ward_id:'',
                        logo:'',
                }),
                 newDirector: false,
                editmodeDirector: false,
                directorform: new Form({
                        id:'',
                        first_name:'',
                        last_name:'',
                        email:'',
                        password:'',
                        user_type:'',
                        permissions:[],
                        roles:[],
                        user_id:'',
                        gender_id:'',
                        organisation_id:'',
                        position_id:'',
                        photo:'',
                        active:'',
                        id_no:'',
                        id_photo_front:'',
                        id_photo_back:'',
                        about_me:'',
                        phone:'',
                        landline:'',
                        address:'',
                        country_id:'',
                        county_id:'',
                        constituency_id:'',
                        ward_id:'',
                }),
                newAdmin: false,
                editmodeAdmin: false,
                adminform: new Form({
                        id:'',
                        first_name:'',
                        last_name:'',
                        email:'',
                        password:'',
                        user_type:'',
                        permissions:[],
                        roles:[],
                        user_id:'',
                        gender_id:'',
                        organisation_id:'',
                        position_id:'',
                        photo:'',
                        active:'',
                        id_no:'',
                        id_photo_front:'',
                        id_photo_back:'',
                        about_me:'',
                        phone:'',
                        landline:'',
                        address:'',
                        country_id:'',
                        county_id:'',
                        constituency_id:'',
                        ward_id:'',
                }),
                      newEmployee: false,
                editmodeEmployee: false,
                employeeform: new Form({
                        id:'',
                        first_name:'',
                        last_name:'',
                        email:'',
                        password:'',
                        user_type:'',
                        permissions:[],
                        roles:[],
                        user_id:'',
                        gender_id:'',
                        organisation_id:'',
                        position_id:'',
                        photo:'',
                        active:'',
                        id_no:'',
                        id_photo_front:'',
                        id_photo_back:'',
                        about_me:'',
                        phone:'',
                        landline:'',
                        address:'',
                        country_id:'',
                        county_id:'',
                        constituency_id:'',
                        ward_id:'',
                }),
                 //organisation
                phone1:{
                        isValid: false,
                        country: undefined,
                },
                landline1:{
                        isValid: false,
                        country: undefined,
                },
                 //director
                phone2:{
                        isValid: false,
                        country: undefined,
                },
                landline2:{
                        isValid: false,
                        country: undefined,
                },
                //admin
                phone3:{
                        isValid: false,
                        country: undefined,
                },
                landline3:{
                        isValid: false,
                        country: undefined,
                },
                  //employee
                phone4:{
                        isValid: false,
                        country: undefined,
                },
                landline4:{
                        isValid: false,
                        country: undefined,
                },
                 //Househelp
                phone5:{
                        isValid: false,
                        country: undefined,
                },
                 //househelpkin
                phone6:{
                        isValid: false,
                        country: undefined,
                },
            }
        },
        mounted() {
            this.loadCountries();
            this.loadCounties();
            this.loadConstituencies();///linked to methods and actions store
            this.loadWards();///linked to methods and actions store
            this.loadEducations();
            this.loadDurations();
            this.loadEnglishstatuses();
            this.loadExperiences();
            this.loadKids();
            this.loadMaritalstatuses();
            this.loadOperations();
            this.loadReligions();
            this.loadSkills();
            this.loadTribes();
            this.loadGenders();
            this.loadRelationships();
            this.singlebureau();
            this.getUnemployedHousehelps()
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
            Bureau(){
               return this.$store.getters.Bureau//single Bureau by parameter id
            },
            Users(){
               return this.$store.getters.HousehelpsList
            },
            Househelp(){
               return this.$store.getters.Househelp
            },
            Director(){
               return this.$store.getters.BureauDirector//View Single Bureau director  by parameter id
            },
            Admin(){
               return this.$store.getters.BureauAdmin//View Single Bureau  admin by parameter id
            },
            Employee(){
               return this.$store.getters.BureauEmployee//View Single Bureau  admin by parameter id
            },
            Genders(){
               return this.$store.getters.Genders
            },
            Relationships(){
               return this.$store.getters.Relationships
            },
            Educations(){
               return this.$store.getters.Educations
            },
            Durations(){
               return this.$store.getters.Durations
            },
            Englishstatuses(){
               return this.$store.getters.Englishstatuses
            },
            Experiences(){
               return this.$store.getters.Experiences
            },
            Kids(){
               return this.$store.getters.Kids
            },
            Maritalstatuses(){
               return this.$store.getters.Maritalstatuses
            },
            Operations(){
               return this.$store.getters.Operations
            },
            Religions(){
               return this.$store.getters.Religions
            },
            Skills(){
               return this.$store.getters.Skills
            },
            Tribes(){
               return this.$store.getters.Tribes
            },
            Pagination(){
                return this.$store.getters.Pagination
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
        },
        methods:{
            singlebureau(){
                    this.$store.dispatch('BureauById', this.$route.params.id);   //action from index.js
                    this.urlform.bureau_id = this.$route.params.id;
           },
            //Househelp Update Demographic
            validateupdateHousehelpDemograhic() {
                if(this.IDstatus === "HasID"){
                    this.househelpform.IDstatus = "HasID";
                    this.househelpform.id_status = "Yes";
                    this.househelpform.id_status_reason = "Has ID Card";
                }
                if(this.IDstatus === "HASIDbutlost"){
                    this.househelpform.IDstatus = "HASIDbutlost";
                    this.househelpform.id_status = "Yes";
                    this.househelpform.id_status_reason = "Has ID Card but lost, however applied for replacement";
                }
                if(this.IDstatus === "NOIDbutapplied"){
                    this.househelpform.IDstatus = "NOIDbutapplied";
                    this.househelpform.id_status = "No";
                    this.househelpform.id_status_reason = "Dont Have ID Card but applied for new Card";
                }
                if(this.IDstatus === "NOID"){
                    this.househelpform.IDstatus = "NOID";
                    this.househelpform.id_status = "No";
                    this.househelpform.id_status_reason = "Dont Have ID Card and Has not applied for new Card";
                }
                let id = this.househelpform.id;
                this.$Progress.start()
                return this.househelpform.patch('/api/househelp/verify/updatedemographics/' +id)
                    .then((response)=>{
                        return true;
                        toast({
                            type: 'success',
                            title: 'Househelp Update Demographic Info Verifed successfully'
                        })
                        this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        toast({
                            type: 'error',
                            title: 'The Househelp Update Demographic Info failed Verification.'
                        })
                    })
            },
            //Househelp update Attributes Info info verification
            validateupdateHousehelpAttributes() {
                 if(this.Healthstatus === "HEALTHY"){
                    this.househelpform.HealthStatus = "HEALTHY";
                    this.househelpform.health_status = "Healthy";
                    this.househelpform.health_allergy = null;
                    this.househelpform.health_chronic_details = null;
                    this.househelpform.health_other_chronics = null;
                    this.househelpform.health_specify = null;
                }
                if(this.Healthstatus === "HASMINOR"){
                    this.househelpform.HealthStatus = "HASMINOR";
                    this.househelpform.health_status = "Has Minor Health Issues";
                    this.househelpform.health_allergy = "yes";
                    // this.househelpform.health_specify = null;filled in form by user
                    this.househelpform.health_chronic_details = null;
                    this.househelpform.health_other_chronics = null;
                }
                if(this.Healthstatus === "HASCHRONIC"){
                    this.househelpform.HealthStatus = "HASCHRONIC";
                    this.househelpform.health_status = "Has Other Chronic Issues";
                    this.househelpform.health_allergy = null;
                    this.househelpform.health_specify = null;
                    this.househelpform.health_other_chronics = "yes";
                    // this.househelpform.health_chronic_details = null;filled in form by user
                }
                this.$Progress.start()
                let id = this.househelpform.id;
                this.$Progress.start()
                return this.househelpform.patch('/api/househelp/verify/updateattributes/' +id)
                    .then((response)=>{
                        return true;
                        toast({
                            type: 'success',
                            title: 'Househelp Update Attributes Info Verifed successfully'
                        })
                        this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        toast({
                            type: 'error',
                            title: 'The Househelp Update Attributes Info failed Verification.'
                        })
                    })
            },
                        //Househelp and kin
            HousehelpInputPhone5({ number, isValid, country }) {
            console.log(number, isValid, country);
            this.househelpform.phone = number;
            this.phone5.isValid = isValid;
            this.phone5.country = country && country.name;
            },
             //Househelpkin
            HousehelpkinInputPhone6({ number, isValid, country }) {
            console.log(number, isValid, country);
            this.househelpkinform.phone = number;
            this.phone6.isValid = isValid;
            this.phone6.country = country && country.name;
            },
            // phone and landline
            //Bureau
            BureauInputPhone({ number, isValid, country }) {
            console.log(number, isValid, country);
            this.bureauform.phone = number;
            this.phone1.isValid = isValid;
            this.phone1.country = country && country.name;
            },
            BureauInputLandline({ number, isValid, country }) {
            console.log(number, isValid, country);
            this.bureauform.landline = number;
            this.landline1.isValid = isValid;
            this.landline1.country = country && country.name;
            },


            //Director
            DirectorInputPhone({ number, isValid, country }) {
            console.log(number, isValid, country);
            this.directorform.phone = number;
            this.phone2.isValid = isValid;
            this.phone2.country = country && country.name;
            },
            DirectorInputLandline({ number, isValid, country }) {
            console.log(number, isValid, country);
            this.directorform.landline = number;
            this.landline2.isValid = isValid;
            this.landline2.country = country && country.name;
            },
                        //Admin
            AdminInputPhone({ number, isValid, country }) {
            console.log(number, isValid, country);
            this.adminform.phone = number;
            this.phone3.isValid = isValid;
            this.phone3.country = country && country.name;
            },
            AdminInputLandline({ number, isValid, country }) {
            console.log(number, isValid, country);
            this.adminform.landline = number;
            this.landline3.isValid = isValid;
            this.landline3.country = country && country.name;
            },
 //Employee
            EmployeeInputPhone({ number, isValid, country }) {
            console.log(number, isValid, country);
            this.employeeform.phone = number;
            this.phone4.isValid = isValid;
            this.phone4.country = country && country.name;
            },
            EmployeeInputLandline({ number, isValid, country }) {
            console.log(number, isValid, country);
            this.employeeform.landline = number;
            this.landline4.isValid = isValid;
            this.landline4.country = country && country.name;
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
            loadBureau(){
                return this.$store.dispatch( "bureaus")//get all from bureau. bureau linked to user
            },
            loadGenders(){
               return this.$store.dispatch("genders")
            },
            loadRelationships(){
               return this.$store.dispatch("relationships")
            },
            loadEducations(){
               return this.$store.dispatch("educations")
            },
            loadDurations(){
               return this.$store.dispatch("durations")
            },
            loadEnglishstatuses(){
               return this.$store.dispatch("englishstatuses")
            },
            loadExperiences(){
               return this.$store.dispatch("experiences")
            },
            loadKids(){
               return this.$store.dispatch("kids")
            },
            loadMaritalstatuses(){
               return this.$store.dispatch("maritalstatuses")
            },
            loadOperations(){
               return this.$store.dispatch("operations")
            },
            loadReligions(){
               return this.$store.dispatch("religions")
            },
            loadSkills(){
               return this.$store.dispatch("skills")
            },
            loadTribes(){
               return this.$store.dispatch("tribes")
            },
             // househelp
            loadHousehelps(){
               this.$Progress.start();
                let employmentstatus = this.employmentstatus;
                let hirestatus = this.hirestatus;
               if(employmentstatus==false && hirestatus==false){
                   console.log(this.urlform, 'url next')
                //    console.log(employmentstatus,"false", hirestatus, "false geting unemployed")
                   return this.$store.dispatch( "househelpslist", this.urlform)
                   .then((response)=>{
                       $('#HousehelpsModal').modal('show')
                       toast({
                        type: 'success',
                        title: 'Fetched the Bureau Househelps data successfully'
                        })
                        this.$Progress.finish();
                    })
                    .catch(()=>{
                        this.$Progress.fail();
                        //errors
                        $('#HousehelpsModal').modal('hide');
                        toast({
                        type: 'error',
                        title: 'There was something Wrong When feching data, try again'
                        })
                    })

               }else if(employmentstatus==true && hirestatus==false){
                //    console.log(employmentstatus,"true", hirestatus, "false geting employed")
                   return this.$store.dispatch( "househelpslist", this.urlform)
                    .then((response)=>{
                       $('#HousehelpsModal').modal('show')
                       toast({
                        type: 'success',
                        title: 'Fetched the Bureau Househelps data successfully'
                        })
                        this.$Progress.finish();
                    })
                    .catch(()=>{
                        this.$Progress.fail();
                        //errors
                        $('#HousehelpsModal').modal('hide');
                        toast({
                        type: 'error',
                        title: 'There was something Wrong When feching data, try again'
                        })
                    })

               }else if(employmentstatus==false && hirestatus==true){
                //    console.log(employmentstatus,"false", hirestatus, "true geting pending employment")
                   return this.$store.dispatch( "househelpslist", this.urlform)
                   .then((response)=>{
                       $('#HousehelpsModal').modal('show')
                       toast({
                        type: 'success',
                        title: 'Fetched the Bureau Househelps data successfully'
                        })
                        this.$Progress.finish();
                    })
                    .catch(()=>{
                        this.$Progress.fail();
                        //errors
                        $('#HousehelpsModal').modal('hide');
                        toast({
                        type: 'error',
                        title: 'There was something Wrong When feching data, try again'
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
                this.urlform.bureau_id = '';
                this.urlform.url = url;
                this.loadHousehelps();
            },
            househelpLoadPassPhoto(Househelp_photo){
                if(Househelp_photo){
                    return "/assets/bureau/img/househelps/passports/"+Househelp_photo;
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
            househelpChangePassPhoto(event){
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
                            this.househelpform.photo =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            househelpChangeDOB(event){
            var current_age = this.househelpform.age;
                var birthday = moment(event);
                var now = moment();
                var age = now.diff(birthday, 'years');
                if(age<18){
                     toast({
                        type: 'error',
                        title: 'This person is of below the age of 18 years',
                     })
                     this.househelpform.age = current_age;
                }else{
                //     toast({
                //        type: 'sucess',
                //        title: 'Age and date of birth added successfully',
                //    })
                   this.househelpform.age = age;
                }
            },
            househelpChangeIDFrontPhoto(event){
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
                            this.househelpform.id_photo_front =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            househelpChangeWaitingCardPhoto(event){
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
                            this.househelpform.waiting_card_photo =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            househelpChangeIDBackPhoto(event){
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
                            this.househelpform.id_photo_back =event.target.result
                            this.househelpform.ref_number = null;
                            this.househelpform.waiting_card_photo = null;
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateHousehelpPassPhoto(househelp_photo){
                console.log(househelp_photo, 'edit')
                let img = this.househelpform.photo;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                        //  console.log('its reall null')
                      }else{
                          if(img.length>100){
                            return this.househelpform.photo;
                        }else{
                            if(househelp_photo){
                                return "/assets/bureau/img/househelps/passports/"+househelp_photo;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },
            updateHousehelpIDFrontPhoto(househelpform_id_photo_front){
                let img = this.househelpform.id_photo_front;
                console.log(img, "hosuelep")
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.househelpform.id_photo_front;
                        }else{
                            if(househelpform_id_photo_front){
                                return "/assets/bureau/img/househelps/IDs/front/"+househelpform_id_photo_front;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },
            updateHousehelpIDBackPhoto(househelpform_id_photo_back){
                let img = this.househelpform.id_photo_back;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.househelpform.id_photo_back;
                        }else{
                            if(househelpform_id_photo_back){
                                return "/assets/bureau/img/househelps/IDs/back/"+househelpform_id_photo_back;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },
            updateHousehelpWaitingCardPhoto(househelpform_waiting_card_photo){
                let img = this.househelpform.waiting_card_photo;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.househelpform.waiting_card_photo;
                        }else{
                            if(househelpform_waiting_card_photo){
                                return "/assets/bureau/img/househelps/waitingcards/"+househelpform_waiting_card_photo;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },
            viewHousehelpModal(id){
                console.log(id)
                this.$Progress.start();
                    //get bueau househelp by id
                this.urlform.househelp_id = id;
                this.$store.dispatch('HousehelpById', id)  //action from index.js
                    .then((response)=>{
                       $('#HousehelpsModal').modal('hide')
                       $('#ViewHousehelpModal').modal('show')
                       toast({
                        type: 'success',
                        title: 'Fetched the Bureau Househelp data successfully'
                        })
                        this.$Progress.finish();
                    })
                    .catch(()=>{
                        this.$Progress.fail();
                        //errors
                        this.$store.dispatch('BureauById', this.$route.params.id)
                        $('#HousehelpsModal').modal('show')
                        $('#ViewHousehelpModal').modal('hide');
                        toast({
                        type: 'error',
                        title: 'There was something Wrong When fetching data'
                        })
                    })
            },
            editHousehelpModal(id){
                 this.househelpform.reset()
                    this.$Progress.start();
                      axios.get('/api/househelp/edit/'+id)
                        .then((response)=>{
                        //    $('#ViewHousehelpModal').modal('hide');
                           toast({
                            type: 'success',
                            title: 'Fetched the Househelp data successfully'
                            })
                            this.househelpform.fill(response.data.user)

                            //id is of househelp not user
                            this.househelpform.id = response.data.user.bureauhousehelps[0].id;

                            this.househelpform.first_name = response.data.user.first_name;
                            this.househelpform.last_name = response.data.user.last_name;
                            this.househelpform.email = response.data.user.email;
                            this.househelpform.password = response.data.user.password;
                            //
                            this.househelpform.user_id = response.data.user.bureauhousehelps[0].pivot.user_id;
                            this.househelpform.bureau_id = response.data.user.bureauhousehelps[0].pivot.bureau_id;
                            this.househelpform.photo = response.data.user.bureauhousehelps[0].pivot.photo;
                            //
                            this.househelpform.about_me = response.data.user.bureauhousehelps[0].pivot.about_me;
                            this.househelpform.phone = response.data.user.bureauhousehelps[0].pivot.phone;
                            this.househelpform.address = response.data.user.bureauhousehelps[0].pivot.address;
                            this.househelpform.country_id = response.data.user.bureauhousehelps[0].pivot.country_id;

                            //get county id using the country id
                            this.househelpform.county_id = response.data.user.bureauhousehelps[0].pivot.county_id
                            this.$store.dispatch('countrycounties', response.data.user.bureauhousehelps[0].pivot.country_id);
                            //get contituency using county id
                            this.househelpform.constituency_id = response.data.user.bureauhousehelps[0].pivot.constituency_id
                            this.$store.dispatch('countyconstituencies', response.data.user.bureauhousehelps[0].pivot.county_id);
                            // //get ward usng constituency id
                            this.househelpform.ward_id = response.data.user.bureauhousehelps[0].pivot.ward_id
                            this.$store.dispatch('constituencywards', response.data.user.bureauhousehelps[0].pivot.constituency_id);

                            //extra
                            this.househelpform.birth_date = response.data.user.bureauhousehelps[0].pivot.birth_date;
                            this.househelpform.age = response.data.user.bureauhousehelps[0].pivot.age;
                            this.househelpform.gender_id = response.data.user.bureauhousehelps[0].pivot.gender_id;
                            this.househelpform.education_id = response.data.user.bureauhousehelps[0].pivot.education_id;
                            this.househelpform.experience_id = response.data.user.bureauhousehelps[0].pivot.experience_id;
                            this.househelpform.maritalstatus_id = response.data.user.bureauhousehelps[0].pivot.maritalstatus_id;
                            this.househelpform.tribe_id = response.data.user.bureauhousehelps[0].pivot.tribe_id;
                            this.househelpform.skill_id = response.data.user.bureauhousehelps[0].pivot.skill_id;
                            this.househelpform.operation_id = response.data.user.bureauhousehelps[0].pivot.operation_id;
                            this.househelpform.duration_id = response.data.user.bureauhousehelps[0].pivot.duration_id;
                            this.househelpform.englishstatus_id = response.data.user.bureauhousehelps[0].pivot.englishstatus_id;
                            this.househelpform.religion_id = response.data.user.bureauhousehelps[0].pivot.religion_id;
                            this.househelpform.kid_id = response.data.user.bureauhousehelps[0].pivot.kid_id;
                            //id status
                                // IDstatus
                                // idstatus_id//id of idstatus row
                                // bureau_househelp_id
                                // id_status
                                // id_number
                                // ref_number
                                // id_photo_front
                                // id_photo_back
                                // waiting_card_photo
                                // reason
                            this.househelpform.idstatus_id = response.data.user.bureauhousehelps[0].idstatus_id;//id of idstatus row
                            this.househelpform.bureau_househelp_id = response.data.user.bureauhousehelps[0].id;
                            this.househelpform.id_status = response.data.user.bureauhousehelps[0].idstatus_status;

                            this.househelpform.id_number = response.data.user.bureauhousehelps[0].idstatus_id_number;
                            this.househelpform.ref_number = response.data.user.bureauhousehelps[0].idstatus_ref_number;

                            if(this.househelpform.id_number != null && this.househelpform.ref_number == null){
                                 this.IDstatus = "HasID";
                                 this.househelpform.IDstatus = "HasID";
                                 this.househelpform.id_status_reason = "Has ID Card";
                                 this.househelpform.id_photo_front = response.data.user.bureauhousehelps[0].idstatus_id_photo_front;
                                 this.househelpform.id_photo_back = response.data.user.bureauhousehelps[0].idstatus_id_photo_back;

                            }else if(this.househelpform.id_number != null && this.househelpform.ref_number != null){                               this.IDstatus = "HASIDbutlost";
                                 this.IDstatus = "HASIDbutlost";
                                 this.househelpform.IDstatus = "HASIDbutlost";
                                 this.househelpform.id_status_reason = "Has ID Card but lost, however applied for replacement";
                                 this.househelpform.id_photo_front = response.data.user.bureauhousehelps[0].idstatus_id_photo_front;
                                 this.househelpform.id_photo_back = response.data.user.bureauhousehelps[0].idstatus_id_photo_back;
                                 this.househelpform.waiting_card_photo = response.data.user.bureauhousehelps[0].idstatus_waiting_card_photo;

                            }else if(this.househelpform.id_number == null && this.househelpform.ref_number != null){
                                this.IDstatus = "NOIDbutapplied";
                                this.househelpform.IDstatus = "NOIDbutapplied";
                                this.househelpform.id_status_reason = "Dont Have ID Card but applied for new Card";
                                this.househelpform.waiting_card_photo = response.data.user.bureauhousehelps[0].idstatus_waiting_card_photo;

                            }else if(this.househelpform.id_number == null && this.househelpform.ref_number == null){
                                this.IDstatus = "NOID";
                                this.househelpform.IDstatus = "NOID";
                                this.househelpform.id_status_reason = "Dont Have ID Card and Has not applied for new Card";
                            }
                            console.log(this.IDstatus, 'status')
                            console.log(this.househelpform.id_photo_front, 'front')
                            console.log(this.househelpform.id_photo_back, 'back')

                            //health status

                            this.househelpform.health_status_id = response.data.user.bureauhousehelps[0].healthstatus_id;
                            this.househelpform.health_HIV_status = response.data.user.bureauhousehelps[0].healthstatus_HIV_status;
                            this.househelpform.health_allergy = response.data.user.bureauhousehelps[0].healthstatus_allergy;
                            this.househelpform.health_chronic_details = response.data.user.bureauhousehelps[0].healthstatus_chronic_details;
                            this.househelpform.health_other_chronics = response.data.user.bureauhousehelps[0].healthstatus_other_chronics;
                            this.househelpform.health_specify = response.data.user.bureauhousehelps[0].healthstatus_specify;
                            this.househelpform.health_status = response.data.user.bureauhousehelps[0].healthstatus_status;

                            if(this.househelpform.health_status == "Healthy"){
                                this.Healthstatus = "HEALTHY";
                                this.househelpform.HealthStatus = "HEALTHY";
                                this.househelpform.health_status = "Healthy";
                                this.househelpform.health_allergy = null;
                                this.househelpform.health_other_chronics = null;
                            }
                            if(this.househelpform.health_status == "HASMINOR"){
                                this.Healthstatus = "HASMINOR";
                                this.househelpform.HealthStatus = "HASMINOR";
                                this.househelpform.health_status = "HASMINOR";
                                this.househelpform.health_allergy = "Has Minor Health Issues";
                                this.househelpform.health_other_chronics = null;
                            }
                            if(this.househelpform.health_status == "HASCHRONIC"){
                                this.Healthstatus = "HASCHRONIC";
                                this.househelpform.HealthStatus = "HASCHRONIC";
                                this.househelpform.health_status = "HASCHRONIC";
                                this.househelpform.health_other_chronics = "Has Other Chronic Issues";
                                this.househelpform.health_allergy = null;
                            }
                            console.log(this.househelpform, 'foGGrm')
                            console.log(this.househelpform.health_specify, 'health_specify')
                        //     }
                            $('#HousehelpModal').modal('show')
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                            //errors
                            $('#ViewHousehelpModal').modal('show');
                            $('#HousehelpModal').modal('hide');
                            toast({
                            type: 'error',
                            title: 'There was something Wrong'
                            })
                        })
            },
            updateHousehelp(id){
                  this.$Progress.start();
                     this.househelpform.patch('/api/househelp/update/'+id)
                        .then(()=>{
                        this.$store.dispatch('HousehelpById', id);
                        this.$refs.wizard.reset()
                         $('#HousehelpModal').modal('hide')
                         this.$store.dispatch('HousehelpById', this.urlform.househelp_id)
                         $('#ViewHousehelpModal').modal('show')
                         this.$store.dispatch( "househelpslist", this.urlform)
                         toast({
                            type: 'success',
                            title: 'Househelp Created successfully'
                            })
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$store.dispatch('HousehelpById', this.urlform.househelp_id);
                            $('#HousehelpModal').modal('show');
                            this.$Progress.fail();
                            toast({
                            type: 'error',
                            title: 'There was something wrong'
                            })
                        })
            },
            // househelp kin
            househelpkinLoadPassPhoto(househelpkinpivot_photo){
                if(househelpkinpivot_photo){
                    return "/assets/bureau/img/househelps/househelpkins/passports/"+househelpkinpivot_photo;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            househelpkinLoadIDFrontPhoto(househelpkinpivot_id_photo_front){
                if(househelpkinpivot_id_photo_front){
                    return "/assets/bureau/img/househelps/househelpkins/IDs/front/"+househelpkinpivot_id_photo_front;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            househelpkinLoadIDBackPhoto(househelpkinform_id_photo_back){
                if(househelpkinform_id_photo_back){
                    return "/assets/bureau/img/househelps/househelpkins/IDs/back/"+househelpkinform_id_photo_back;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            househelpkinChangePassPhoto(event){
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
                            this.househelpkinform.photo =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateHousehelpKinPassPhoto(househelpkinform_househelpkin_photo){
                console.log(househelpkinform_househelpkin_photo)
                let img = this.househelpkinform.photo;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.househelpkinform.photo;
                        }else{
                            if(househelpkinform_househelpkin_photo){
                                   return "/assets/bureau/img/househelps/househelpkins/passports/"+househelpkinform_househelpkin_photo;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }
            },
            househelpkinChangeIDFrontPhoto(event){
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
                            this.househelpkinform.id_photo_front =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateHousehelpKinIDFrontPhoto(househelpkinform_id_photo_front){
                let img = this.househelpkinform.id_photo_front;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.househelpkinform.id_photo_front;
                        }else{
                            if(househelpkinform_id_photo_front){
                                return "/assets/bureau/img/househelps/househelpkins/IDs/front/"+househelpkinform_id_photo_front;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },
            househelpkinChangeIDBackPhoto(event){
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
                            this.househelpkinform.id_photo_back =event.target.result
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateHousehelpKinIDBackPhoto(househelpkinform_id_photo_back){
                let img = this.househelpkinform.id_photo_back;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.househelpkinform.id_photo_back;
                        }else{
                            if(househelpkinform_id_photo_back){
                                return "/assets/bureau/img/househelps/househelpkins/IDs/back/"+househelpkinform_id_photo_back;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },
            viewHousehelpkinModal(id){
                console.log(id)
                this.$Progress.start();
                    //get bueau househelpkin by id
                this.$store.dispatch('HousehelpKinById', id)  //action from index.js
                    .then((response)=>{
                       $('#ViewHousehelpKinModal').modal('show')
                       toast({
                        type: 'success',
                        title: 'Fetched the Househelpkin data successfully'
                        })
                        this.$Progress.finish();
                    })
                    .catch(()=>{
                        this.$Progress.fail();
                        //errors
                        $('#ViewHousehelpKinModal').modal('show');
                        toast({
                        type: 'error',
                        title: 'There was something Wrong When fetching data'
                        })
                    })
            },
            editHousehelpkinModal(id){
                console.log(id)
                 this.househelpkinform.reset()
                    this.$Progress.start();
                      axios.get('/api/househelpkin/edit/'+id)
                        .then((response)=>{
                           $('#HousehelpKinModal').modal('show')
                           toast({
                            type: 'success',
                            title: 'Fetched the Househelp data successfully'
                            })
                            this.househelpkinform.fill(response.data.user)
                            this.househelpkinform.id  = response.data.user.househelpkin.user_id
                        //househelp
                            this.househelpkinform.first_name   = response.data.user.first_name
                            this.househelpkinform.last_name    = response.data.user.last_name
                            this.househelpkinform.email        = response.data.user.email
                            this.househelpkinform.user_type    = response.data.user.user_type

                            this.househelpkinform.bureau_househelp_id  = response.data.user.househelpkin.bureau_househelp_id
                            this.househelpkinform.gender_id   = response.data.user.househelpkin.gender_id
                            this.househelpkinform.user_id     = response.data.user.househelpkin.user_id

                            this.househelpkinform.househelp_id  = response.data.user.househelpkin.househelp_id
                            this.househelpkinform.relationship_id  = response.data.user.househelpkin.relationship_id

                            this.househelpkinform.id_no  = response.data.user.househelpkin.id_no
                            this.househelpkinform.photo  = response.data.user.househelpkin.photo

                            this.househelpkinform.id_photo_front  = response.data.user.househelpkin.id_photo_front
                            this.househelpkinform.id_photo_back  = response.data.user.househelpkin.id_photo_back
                            this.househelpkinform.phone  = response.data.user.househelpkin.phone
                            this.househelpkinform.address  = response.data.user.househelpkin.address

                        // // //    //get country id
                            this.househelpkinform.country_id = response.data.user.househelpkin.country_id
                        //     //get county id using the country id
                            this.househelpkinform.county_id = response.data.user.househelpkin.county_id
                            this.$store.dispatch('countrycounties', response.data.user.househelpkin.country_id);
                            //get contituency using county id
                            this.househelpkinform.constituency_id = response.data.user.househelpkin.constituency_id
                            this.$store.dispatch('countyconstituencies', response.data.user.househelpkin.county_id);
                            // //get ward usng constituency id
                            this.househelpkinform.ward_id = response.data.user.househelpkin.ward_id
                            this.$store.dispatch('constituencywards', response.data.user.househelpkin.constituency_id);
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                            //errors
                            $('#HousehelpKinModal').modal('show');
                            toast({
                            type: 'error',
                            title: 'There was something Wrong'
                            })
                        })
            },
            updateHousehelpKin(id){
                  this.$Progress.start();
                     this.househelpkinform.patch('/api/househelpkin/update/'+id)
                        .then(()=>{
                        this.$store.dispatch('HousehelpById', this.urlform.househelp_id);
                         $('#HousehelpKinModal').modal('hide')
                         $('#ViewHousehelpModal').modal('show')
                         toast({
                            type: 'success',
                            title: 'Househelpkin Created successfully'
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

            //Bureau
            validateBureau() {
                this.$Progress.start()
                return this.bureauform.post('/api/bureau/verify/info')
                    .then((response)=>{
                        return true;
                        toast({
                            type: 'success',
                            title: 'Bureau Info Verifed successfully'
                        })
                        this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        toast({
                            type: 'error',
                            title: 'The Bureau Info failed Verification.'
                        })
                    })
            },

            //Bureau verification
            validateBureauUpdate() {
                let id = this.bureauform.id;
                console.log('first',id);
                this.$Progress.start()
                return this.bureauform.patch('/api/bureau/updateverify/info/'+id)
                    .then((response)=>{
                        return true;
                        toast({
                            type: 'success',
                            title: 'Bureau update Info Verifed successfully'
                        })
                        this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        toast({
                            type: 'error',
                            title: 'The Bureau update Info failed Verification.'
                        })
                    })
            },

            countryCounties(country_id){
                console.log(country_id);
                this.$store.dispatch('countrycounties', country_id);
            },
            countyConstituencies(county_id){
                console.log(county_id);
                this.$store.dispatch('countyconstituencies', county_id);
            },
            constituencyWards(constituency_id){
                console.log(constituency_id);
                this.$store.dispatch('constituencywards', constituency_id); //send to store to the action with id
            },
            bureauChangeLogo(event){
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
                            this.bureauform.logo =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            bureauLoadLogo(logo_id){
                 if(logo_id){
                    return "/assets/bureau/img/logo/"+logo_id;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            updateBureauLogo(bureauformlogo){
                console.log(bureauformlogo)
                let img = this.bureauform.logo;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                        //  console.log('its reall null')
                      }else{
                          if(img.length>100){
                            return this.bureauform.logo;
                        }else{
                            if(bureauformlogo){
                                return "/assets/bureau/img/logo/"+bureauformlogo;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },
            editBureauModal(id){

                 this.editmodeBureau = true;
                 this.bureauform.reset()
                   console.log('edit bureauanisaton', id)
                    this.$Progress.start();
                      axios.get('/api/bureau/edit/'+id)
                        .then((response)=>{
                           $('#BureauModal').modal('show')
                           toast({
                            type: 'success',
                            title: 'Fetched the Bureau data successfully'
                            })
                            this.bureauform.fill(response.data.bureau);
                            //get country id
                            this.bureauform.country_id = response.data.bureau.country.id;
                            //get county id using the country id
                            this.bureauform.county_id = response.data.bureau.county.id
                            this.$store.dispatch('countrycounties', response.data.bureau.country.id);
                            //get contituency using county id
                            this.bureauform.constituency_id = response.data.bureau.constituency.id
                            this.$store.dispatch('countyconstituencies', response.data.bureau.county.id);
                            //get ward usng constituency id
                            this.bureauform.ward_id = response.data.bureau.ward.id
                            this.$store.dispatch('constituencywards', response.data.bureau.constituency.id);

                            this.$Progress.finish();

                        })
                        .catch(()=>{
                            this.$Progress.fail();
                            //errors
                            $('#BureauModal').modal('show');
                            toast({
                            type: 'error',
                            title: 'There was something Wrong'
                            })
                        })
            },
            updateBureau(id){
                  console.log('update bureauanisaton')
                  this.$Progress.start();
                     this.bureauform.patch('/api/bureau/update/'+id)
                        .then(()=>{
                            this.$store.dispatch('BureauById', this.$route.params.id);
                         $('#BureauModal').modal('hide')
                         toast({
                            type: 'success',
                            title: 'User Created successfully'
                            })
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                            $('#BureauModal').modal('show')
                            toast({
                            type: 'error',
                            title: 'There was something wrong'
                            })
                        })
            },
            DirectorcountryCounties(country_id){
                console.log(country_id);
                this.$store.dispatch('countrycounties', country_id);
            },
            DirectorcountyConstituencies(county_id){
                console.log(county_id);
                this.$store.dispatch('countyconstituencies', county_id);
            },
            DirectorconstituencyWards(constituency_id){
                console.log(constituency_id);
                this.$store.dispatch('constituencywards', constituency_id); //send to store to the action with id
            },
            newDirectorModal(bureau_id){
                console.log(bureau_id)
                 this.editmodeDirector= false;
                 this.directorform.reset()
                 this.directorform.bureau_id = bureau_id;
                     $('#DirectorModal').modal('show')
            },
            //bureau director passposrt image
            directorLoadPassPhoto(directorpivot_photo){
                if(directorpivot_photo){
                    return "/assets/bureau/img/directors/passports/"+directorpivot_photo;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            //director passport photo
            directorChangePassPhoto(event){
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
                            this.directorform.photo =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateDirectorPassPhoto(directorform_bureaudirector_photo){
                // console.log(directorform_bureaudirector_photo)
                let img = this.directorform.photo;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                        //  console.log('its reall null')
                      }else{
                          if(img.length>100){
                            return this.directorform.photo;
                        }else{
                            if(directorform_bureaudirector_photo){
                                return "/assets/bureau/img/directors/passports/"+directorform_bureaudirector_photo;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },
            directorLoadIDFrontPhoto(directorpivot_id_photo_front){
                if(directorpivot_id_photo_front){
                    return "/assets/bureau/img/directors/IDs/front/"+directorpivot_id_photo_front;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            directorChangeIDFrontPhoto(event){
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
                            this.directorform.id_photo_front =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateDirectorIDFrontPhoto(directorform_id_photo_front){
                let img = this.directorform.id_photo_front;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.directorform.id_photo_front;
                        }else{
                            if(directorform_id_photo_front){
                                return "/assets/bureau/img/directors/IDs/front/"+directorform_id_photo_front;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },
            directorLoadIDBackPhoto(directorform_id_photo_back){
                if(directorform_id_photo_back){
                    return "/assets/bureau/img/directors/IDs/back/"+directorform_id_photo_back;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            directorChangeIDBackPhoto(event){
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
                            this.directorform.id_photo_back =event.target.result
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateDirectorIDBackPhoto(directorform_id_photo_back){
                let img = this.directorform.id_photo_back;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.directorform.id_photo_back;
                        }else{
                            if(directorform_id_photo_back){
                                return "/assets/bureau/img/directors/IDs/back/"+directorform_id_photo_back;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },

            DirectorsModal(){
                this.$Progress.start();
                this.$store.dispatch('BureauById', this.$route.params.id) //action from index.js
                    .then((response)=>{
                       $('#DirectorsModal').modal('show')
                       toast({
                        type: 'success',
                        title: 'Fetched the Bureau Directors data successfully'
                        })
                        this.$Progress.finish();
                    })
                    .catch(()=>{
                        this.$Progress.fail();
                        //errors
                        $('#DirectorsModal').modal('hide');
                        toast({
                        type: 'error',
                        title: 'There was something Wrong When feching data, try again'
                        })
                    })
            },
            viewDirectorModal(id){
                this.$Progress.start();
                this.urlform.director_id = id;
                this.$store.dispatch('BureauDirectorById', id)  //action from index.js
                    .then((response)=>{
                       $('#DirectorsModal').modal('hide')
                       $('#ViewDirectorModal').modal('show')
                       toast({
                        type: 'success',
                        title: 'Fetched the Bureau Director data successfully'
                        })
                        this.$Progress.finish();
                    })
                    .catch(()=>{
                        this.$Progress.fail();
                        //errors
                        this.$store.dispatch('BureauById', this.$route.params.id)
                        $('#DirectorsModal').modal('show')
                        $('#ViewDirectorModal').modal('hide');
                        toast({
                        type: 'error',
                        title: 'There was something Wrong When fetching data'
                        })
                    })
            },
            editDirectorModal(id){
                console.log(id)
                 this.editmodeDirector = true;
                 this.directorform.reset()
                    this.$Progress.start();
                      axios.get('/api/bureaudirector/edit/'+id)
                        .then((response)=>{
                           toast({
                            type: 'success',
                            title: 'Fetched the Director data successfully'
                            })
                            console.log(response.data)
                            this.directorform.id = response.data.user.id
                            this.directorform.first_name = response.data.user.first_name
                            this.directorform.last_name = response.data.user.last_name
                            this.directorform.email = response.data.user.email
                            this.directorform.password = response.data.user.password
                            this.directorform.user_type = response.data.user.user_type
                            this.directorform.permissions = response.data.user.permissions
                            this.directorform.roles = response.data.user.roles
                            this.directorform.user_id = response.data.user.bureaudirectors[0].pivot.user_id
                            this.directorform.gender_id = response.data.user.bureaudirectors[0].pivot.gender_id
                            this.directorform.organisation_id = response.data.user.bureaudirectors[0].pivot.organisation_id
                            this.directorform.position_id = response.data.user.bureaudirectors[0].pivot.position_id
                            this.directorform.photo = response.data.user.bureaudirectors[0].pivot.photo
                            this.directorform.active = response.data.user.bureaudirectors[0].pivot.active
                            this.directorform.id_no = response.data.user.bureaudirectors[0].pivot.id_no
                            this.directorform.id_photo_front = response.data.user.bureaudirectors[0].pivot.id_photo_front
                            this.directorform.id_photo_back = response.data.user.bureaudirectors[0].pivot.id_photo_back
                            this.directorform.about_me = response.data.user.bureaudirectors[0].pivot.about_me
                            this.directorform.phone = response.data.user.bureaudirectors[0].pivot.phone
                            this.directorform.landline = response.data.user.bureaudirectors[0].pivot.landline
                            this.directorform.address = response.data.user.bureaudirectors[0].pivot.address
                        // //    //get country id
                            this.directorform.country_id = response.data.user.bureaudirectors[0].pivot.country_id
                            //get county id using the country id
                            this.directorform.county_id = response.data.user.bureaudirectors[0].pivot.county_id
                            this.$store.dispatch('countrycounties', response.data.user.bureaudirectors[0].pivot.country_id);
                            //get contituency using county id
                            this.directorform.constituency_id = response.data.user.bureaudirectors[0].pivot.constituency_id
                            this.$store.dispatch('countyconstituencies', response.data.user.bureaudirectors[0].pivot.county_id);
                            // //get ward usng constituency id
                            this.directorform.ward_id = response.data.user.bureaudirectors[0].pivot.ward_id
                            this.$store.dispatch('constituencywards', response.data.user.bureaudirectors[0].pivot.constituency_id);
                         $('#DirectorModal').modal('show')
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                            //errors
                            $('#ViewDirectorModal').modal('show')
                            $('#DirectorModal').modal('hide');
                            toast({
                            type: 'error',
                            title: 'There was something Wrong'
                            })
                        })
            },
            addDirector(Bureau_id) {
                // let bureau = this.$store.getters.Bureau[0];
                console.log(Bureau_id)
                this.$Progress.start();
                this.directorform.patch('/api/bureaudirector/'+Bureau_id)
                    .then((response)=>{
                        //  console.log(response.data)
                         toast({
                            type: 'success',
                            title: 'Director Created successfully'
                            })
                            this.$store.dispatch('BureauById', this.$route.params.id);
                            this.directorform.reset()
                            $('#DirectorModal').modal('hide')
                              this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        //errors
                            $('#DirectorModal').modal('show');
                            toast({
                                type: 'error',
                                title: 'There was something wrong.'
                                })
                    })
            },
            updateDirector(id){
                  this.$Progress.start();
                     this.directorform.patch('/api/bureaudirector/update/'+id)
                        .then(()=>{
                        this.$store.dispatch('BureauDirectorById', this.urlform.director_id)
                        this.$store.dispatch('BureauById', this.$route.params.id);
                         $('#DirectorModal').modal('hide')
                         $('#ViewDirectorModal').modal('show')
                         toast({
                            type: 'success',
                            title: 'Director Created successfully'
                            })
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$store.dispatch('BureauDirectorById', this.urlform.director_id)
                            $('#DirectorModal').modal('show')
                            this.$Progress.fail();
                            toast({
                            type: 'error',
                            title: 'There was something wrong'
                            })
                        })
            },
            deleteDirector(id){
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
                    //  console.log('delete director', id)
                        this.$Progress.start();
                        this.directorform.get('/api/bureaudirector/delete/'+id)
                            .then(()=>{
                            toast({
                            type: 'success',
                            title: 'Director Deleted successfully'
                            })
                           this.$store.dispatch('BureauById', this.$route.params.id);
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
            },


            AdmincountryCounties(country_id){
                console.log(country_id);
                this.$store.dispatch('countrycounties', country_id);
            },
            AdmincountyConstituencies(county_id){
                console.log(county_id);
                this.$store.dispatch('countyconstituencies', county_id);
            },
            AdminconstituencyWards(constituency_id){
                console.log(constituency_id);
                this.$store.dispatch('constituencywards', constituency_id); //send to store to the action with id
            },
            newAdminModal(bureau_id){
                console.log(bureau_id)
                 this.editmodeAdmin= false;
                 this.adminform.reset()
                 this.adminform.bureau_id;
                     $('#AdminModal').modal('show')
            },
            //bureau admin passposrt image
            adminLoadPassPhoto(adminpivot_photo){
                if(adminpivot_photo){
                    return "/assets/bureau/img/admins/passports/"+adminpivot_photo;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            //admin passport photo
            adminChangePassPhoto(event){
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
                            this.adminform.photo =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateAdminPassPhoto(adminform_bureauadmin_photo){
                // console.log(adminform_bureauadmin_photo)
                let img = this.adminform.photo;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                        //  console.log('its reall null')
                      }else{
                          if(img.length>100){
                            return this.adminform.photo;
                        }else{
                            if(adminform_bureauadmin_photo){
                                return "/assets/bureau/img/admins/passports/"+adminform_bureauadmin_photo;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },
            adminLoadIDFrontPhoto(adminpivot_id_photo_front){
                if(adminpivot_id_photo_front){
                    return "/assets/bureau/img/admins/IDs/front/"+adminpivot_id_photo_front;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            adminChangeIDFrontPhoto(event){
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
                            this.adminform.id_photo_front =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateAdminIDFrontPhoto(adminform_id_photo_front){
                let img = this.adminform.id_photo_front;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.adminform.id_photo_front;
                        }else{
                            if(adminform_id_photo_front){
                                return "/assets/bureau/img/admins/IDs/front/"+adminform_id_photo_front;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },
            adminLoadIDBackPhoto(adminform_id_photo_back){
                if(adminform_id_photo_back){
                    return "/assets/bureau/img/admins/IDs/back/"+adminform_id_photo_back;
                }else{
                    return "/assets/bureau/img/website/empty.png";
                }
            },
            adminChangeIDBackPhoto(event){
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
                            this.adminform.id_photo_back =event.target.result
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateAdminIDBackPhoto(adminform_id_photo_back){
                let img = this.adminform.id_photo_back;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.adminform.id_photo_back;
                        }else{
                            if(adminform_id_photo_back){
                                return "/assets/bureau/img/admins/IDs/back/"+adminform_id_photo_back;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },
            AdminsModal(){
                this.$Progress.start();
                this.$store.dispatch('BureauById', this.$route.params.id) //action from index.js
                    .then((response)=>{
                       $('#AdminsModal').modal('show')
                       toast({
                        type: 'success',
                        title: 'Fetched the Bureau Admins data successfully'
                        })
                        this.$Progress.finish();
                    })
                    .catch(()=>{
                        this.$Progress.fail();
                        //errors
                        $('#AdminsModal').modal('hide');
                        toast({
                        type: 'error',
                        title: 'There was something Wrong When feching data, try again'
                        })
                    })
            },
            viewAdminModal(id){
                this.$Progress.start();
                this.urlform.admin_id = id;
                    //get bueau admin by id
                this.$store.dispatch('BureauAdminById', id)  //action from index.js
                    .then((response)=>{
                        $('#AdminsModal').modal('hide')
                       $('#ViewAdminModal').modal('show')
                       toast({
                        type: 'success',
                        title: 'Fetched the Bureau Admin data successfully'
                        })
                        this.$Progress.finish();
                    })
                    .catch(()=>{
                        this.$Progress.fail();
                        //errors
                        this.$store.dispatch('BureauById', this.$route.params.id)
                        $('#AdminsModal').modal('show')
                        $('#ViewAdminModal').modal('hide');
                        toast({
                        type: 'error',
                        title: 'There was something Wrong When fetching data'
                        })
                    })
            },
            editAdminModal(id){
                console.log(id)
                 this.editmodeAdmin = true;
                 this.adminform.reset()
                    this.$Progress.start();
                      axios.get('/api/bureauadmin/edit/'+id)
                        .then((response)=>{
                           $('#AdminModal').modal('show')
                           toast({
                            type: 'success',
                            title: 'Fetched the Admin data successfully'
                            })
                            console.log(response.data)
                            this.adminform.id = response.data.user.id
                            this.adminform.first_name = response.data.user.first_name
                            this.adminform.last_name = response.data.user.last_name
                            this.adminform.email = response.data.user.email
                            this.adminform.password = response.data.user.password
                            this.adminform.user_type = response.data.user.user_type
                            this.adminform.permissions = response.data.user.permissions
                            this.adminform.roles = response.data.user.roles
                            this.adminform.user_id = response.data.user.bureauadmins[0].pivot.user_id
                            this.adminform.gender_id = response.data.user.bureauadmins[0].pivot.gender_id
                            // this.adminform.organisation_id = response.data.user.bureauadmins[0].pivot.organisation_id
                            this.adminform.position_id = response.data.user.bureauadmins[0].pivot.position_id
                            this.adminform.photo = response.data.user.bureauadmins[0].pivot.photo
                            this.adminform.active = response.data.user.bureauadmins[0].pivot.active
                            this.adminform.id_no = response.data.user.bureauadmins[0].pivot.id_no
                            this.adminform.id_photo_front = response.data.user.bureauadmins[0].pivot.id_photo_front
                            this.adminform.id_photo_back = response.data.user.bureauadmins[0].pivot.id_photo_back
                            this.adminform.about_me = response.data.user.bureauadmins[0].pivot.about_me
                            this.adminform.phone = response.data.user.bureauadmins[0].pivot.phone
                            this.adminform.landline = response.data.user.bureauadmins[0].pivot.landline
                            this.adminform.address = response.data.user.bureauadmins[0].pivot.address

                            this.adminform.county_id = response.data.user.bureauadmins[0].pivot.county_id
                            this.adminform.constituency_id = response.data.user.bureauadmins[0].pivot.constituency_id
                            this.adminform.ward_id = response.data.user.bureauadmins[0].pivot.ward_id

                        // //    //get country id
                            this.adminform.country_id = response.data.user.bureauadmins[0].pivot.country_id
                            this.adminform.county_id = response.data.user.bureauadmins[0].pivot.county_id
                            this.$store.dispatch('countrycounties', response.data.user.bureauadmins[0].pivot.country_id);
                            //get contituency using county id
                            this.adminform.constituency_id = response.data.user.bureauadmins[0].pivot.constituency_id
                            this.$store.dispatch('countyconstituencies', response.data.user.bureauadmins[0].pivot.county_id);
                            // //get ward usng constituency id
                            this.adminform.ward_id = response.data.user.bureauadmins[0].pivot.ward_id
                            this.$store.dispatch('constituencywards', response.data.user.bureauadmins[0].pivot.constituency_id);
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                            //errors
                            this.$store.dispatch('BureauAdminById',this.urlform.admin_id)
                            $('#ViewAdminModal').modal('show')
                            $('#AdminModal').modal('hide');
                            toast({
                            type: 'error',
                            title: 'There was something Wrong'
                            })
                        })
            },
            addAdmin(Bureau_id) {
                console.log(Bureau_id)
                this.$Progress.start();
                this.adminform.patch('/api/bureauadmin/'+Bureau_id)
                    .then((response)=>{
                        //  console.log(response.data)
                         toast({
                            type: 'success',
                            title: 'Admin Created successfully'
                            })
                            this.$store.dispatch('BureauById', this.$route.params.id);
                            this.adminform.reset()
                            $('#AdminModal').modal('hide')
                              this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        //errors
                            $('#AdminModal').modal('show');
                            toast({
                                type: 'error',
                                title: 'There was something wrong.'
                                })
                    })
            },
            updateAdmin(id){
                  this.$Progress.start();
                     this.adminform.patch('/api/bureauadmin/update/'+id)
                        .then(()=>{
                        $('#AdminModal').modal('hide')
                        this.$store.dispatch('BureauAdminById', this.urlform.admin_id)
                        this.$store.dispatch('BureauById', this.$route.params.id);
                         $('#ViewAdminModal').modal('show')
                         toast({
                            type: 'success',
                            title: 'Admin Created successfully'
                            })
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$store.dispatch('BureauAdminById', this.urlform.admin_id)
                            $('#AdminModal').modal('show')
                            this.$Progress.fail();
                            toast({
                            type: 'error',
                            title: 'There was something wrong'
                            })
                        })
            },
            deleteAdmin(id){
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
                    //  console.log('delete admin', id)
                        this.$Progress.start();
                        this.adminform.get('/api/bureauadmin/delete/'+id)
                            .then(()=>{
                            toast({
                            type: 'success',
                            title: 'Admin Deleted successfully'
                            })
                            this.$store.dispatch('BureauById', this.$route.params.id);
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
            },



            EmployeecountryCounties(country_id){
                console.log(country_id);
                this.$store.dispatch('countrycounties', country_id);
            },
            EmployeecountyConstituencies(county_id){
                console.log(county_id);
                this.$store.dispatch('countyconstituencies', county_id);
            },
            EmployeeconstituencyWards(constituency_id){
                console.log(constituency_id);
                this.$store.dispatch('constituencywards', constituency_id); //send to store to the action with id
            },
            newEmployeeModal(bureau_id){
                console.log(bureau_id)
                 this.editmodeEmployee= false;
                 this.employeeform.reset()
                 this.employeeform.bureau_id = bureau_id;
                     $('#EmployeeModal').modal('show')
            },
            //bureau employee passposrt image
            employeeLoadPassPhoto(employeepivot_photo){
                if(employeepivot_photo){
                    return "/assets/bureau/img/employees/passports/"+employeepivot_photo;
                }else{
                    return "/assets/bureau/img/website/empty.png";
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
            updateEmployeePassPhoto(employeeform_bureauemployee_photo){
                // console.log(employeeform_bureauemployee_photo)
                let img = this.employeeform.photo;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                        //  console.log('its reall null')
                      }else{
                          if(img.length>100){
                            return this.employeeform.photo;
                        }else{
                            if(employeeform_bureauemployee_photo){
                                return "/assets/bureau/img/employees/passports/"+employeeform_bureauemployee_photo;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },
            employeeLoadIDFrontPhoto(employeepivot_id_photo_front){
                if(employeepivot_id_photo_front){
                    return "/assets/bureau/img/employees/IDs/front/"+employeepivot_id_photo_front;
                }else{
                    return "/assets/bureau/img/website/empty.png";
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
                          return "/assets/bureau/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.employeeform.id_photo_front;
                        }else{
                            if(employeeform_id_photo_front){
                                return "/assets/bureau/img/employees/IDs/front/"+employeeform_id_photo_front;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },
            employeeLoadIDBackPhoto(employeeform_id_photo_back){
                if(employeeform_id_photo_back){
                    return "/assets/bureau/img/employees/IDs/back/"+employeeform_id_photo_back;
                }else{
                    return "/assets/bureau/img/website/empty.png";
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
                          return "/assets/bureau/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.employeeform.id_photo_back;
                        }else{
                            if(employeeform_id_photo_back){
                                return "/assets/bureau/img/employees/IDs/back/"+employeeform_id_photo_back;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },
            EmployeesModal(){
                this.$Progress.start();
                this.$store.dispatch('BureauById', this.$route.params.id) //action from index.js
                    .then((response)=>{
                       $('#EmployeesModal').modal('show')
                       toast({
                        type: 'success',
                        title: 'Fetched the Bureau Employees data successfully'
                        })
                        this.$Progress.finish();
                    })
                    .catch(()=>{
                        this.$Progress.fail();
                        //errors
                        $('#EmployeesModal').modal('hide');
                        toast({
                        type: 'error',
                        title: 'There was something Wrong When feching data, try again'
                        })
                    })
            },
            viewEmployeeModal(id){
                console.log(id)
                this.$Progress.start();
                    //get bueau employee by id
                this.urlform.employee_id = id;
                this.$store.dispatch('BureauEmployeeById', id)  //action from index.js
                    .then((response)=>{
                       $('#EmployeesModal').modal('hide');
                       $('#ViewEmployeeModal').modal('show')
                       toast({
                        type: 'success',
                        title: 'Fetched the Bureau Employee data successfully'
                        })
                        this.$Progress.finish();
                    })
                    .catch(()=>{
                        this.$Progress.fail();
                        //errors
                        this.$store.dispatch('BureauById', this.$route.params.id)
                        $('#EmployeesModal').modal('show');
                        $('#ViewEmployeeModal').modal('hide');
                        toast({
                        type: 'error',
                        title: 'There was something Wrong When fetching data'
                        })
                    })
            },
            editEmployeeModal(id){
                console.log(id)
                 this.editmodeEmployee = true;
                 this.employeeform.reset()
                    this.$Progress.start();
                      axios.get('/api/bureauemployee/edit/'+id)
                        .then((response)=>{
                           $('#EmployeeModal').modal('show')
                           toast({
                            type: 'success',
                            title: 'Fetched the Employee data successfully'
                            })
                            console.log(response.data)
                            this.employeeform.id = response.data.user.id
                            this.employeeform.first_name = response.data.user.first_name
                            this.employeeform.last_name = response.data.user.last_name
                            this.employeeform.email = response.data.user.email
                            this.employeeform.password = response.data.user.password
                            this.employeeform.admin_type = response.data.user.admin_type
                            this.employeeform.permissions = response.data.user.permissions
                            this.employeeform.roles = response.data.user.roles
                            this.employeeform.user_id = response.data.user.bureauemployees[0].pivot.user_id
                            this.employeeform.gender_id = response.data.user.bureauemployees[0].pivot.gender_id
                            this.employeeform.organisation_id = response.data.user.bureauemployees[0].pivot.organisation_id
                            this.employeeform.position_id = response.data.user.bureauemployees[0].pivot.position_id
                            this.employeeform.photo = response.data.user.bureauemployees[0].pivot.photo
                            this.employeeform.active = response.data.user.bureauemployees[0].pivot.active
                            this.employeeform.id_no = response.data.user.bureauemployees[0].pivot.id_no
                            this.employeeform.id_photo_front = response.data.user.bureauemployees[0].pivot.id_photo_front
                            this.employeeform.id_photo_back = response.data.user.bureauemployees[0].pivot.id_photo_back
                            this.employeeform.about_me = response.data.user.bureauemployees[0].pivot.about_me
                            this.employeeform.phone = response.data.user.bureauemployees[0].pivot.phone
                            this.employeeform.landline = response.data.user.bureauemployees[0].pivot.landline
                            this.employeeform.address = response.data.user.bureauemployees[0].pivot.address
                            this.employeeform.country_id = response.data.user.bureauemployees[0].pivot.country_id
                            this.employeeform.county_id = response.data.user.bureauemployees[0].pivot.county_id
                            this.employeeform.constituency_id = response.data.user.bureauemployees[0].pivot.constituency_id
                            this.employeeform.ward_id = response.data.user.bureauemployees[0].pivot.ward_id

                        // //    //get country id
                            this.employeeform.country_id = response.data.user.bureauemployees[0].pivot.country_id
                            //get county id using the country id
                            this.employeeform.county_id = response.data.user.bureauemployees[0].pivot.county_id
                            this.$store.dispatch('countrycounties', response.data.user.bureauemployees[0].pivot.country_id);
                            //get contituency using county id
                            this.employeeform.constituency_id = response.data.user.bureauemployees[0].pivot.constituency_id
                            this.$store.dispatch('countyconstituencies', response.data.user.bureauemployees[0].pivot.county_id);
                            // //get ward usng constituency id
                            this.employeeform.ward_id = response.data.user.bureauemployees[0].pivot.ward_id
                            this.$store.dispatch('constituencywards', response.data.user.bureauemployees[0].pivot.constituency_id);
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                            //errors
                            this.$store.dispatch('BureauEmployeeById',this.urlform.employee_id)
                            $('#ViewEmployeeModal').modal('show');
                            $('#EmployeeModal').modal('hide');
                            toast({
                            type: 'error',
                            title: 'There was something Wrong'
                            })
                        })
            },
            addEmployee(Bureau_id) {
                console.log(Bureau_id)
                this.$Progress.start();
                this.employeeform.patch('/api/bureauemployee/'+Bureau_id)
                    .then((response)=>{
                        //  console.log(response.data)
                         toast({
                            type: 'success',
                            title: 'Employee Created successfully'
                            })
                            this.$store.dispatch('BureauById', this.$route.params.id);
                            this.employeeform.reset()
                            $('#EmployeeModal').modal('hide')
                              this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        //errors
                            $('#EmployeeModal').modal('show');
                            toast({
                                type: 'error',
                                title: 'There was something wrong.'
                                })
                    })
            },
            updateEmployee(id){
                  this.$Progress.start();
                     this.employeeform.patch('/api/bureauemployee/update/'+id)
                        .then(()=>{
                        this.$store.dispatch('BureauById', this.$route.params.id);
                        this.$store.dispatch('BureauEmployeeById', this.urlform.employee_id)
                        $('#EmployeeModal').modal('hide')
                        $('#ViewEmployeeModal').modal('show')
                         toast({
                            type: 'success',
                            title: 'Employee Created successfully'
                            })
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$store.dispatch('BureauEmployeeById', this.urlform.employee_id)
                            $('#EmployeeModal').modal('show')
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
                        this.employeeform.get('/api/bureauemployee/delete/'+id)
                            .then(()=>{
                            toast({
                            type: 'success',
                            title: 'Employee Deleted successfully'
                            })
                            this.$store.dispatch('BureauById', this.$route.params.id);
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
            },



        },
        watch:{
            $route(to, from){
                this.singleabureau();//method
           }
        }

    }
</script>

