<template>
    <!-- Main content -->
    <section class="content">
            <div class="card card-widget widget-user" >
              <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header text-white" style="background: url('assets/bureau/img/background/background-1.jpg')
                     center center;width:100%;height:300px">
                    <div class="clearfix">
                        <span class="float-left">
                            <h3 class="widget-user-username" v-if="Househelp.user">{{Househelp.user.full_name}}</h3>
                            <h5 class="widget-user-desc bg-green" style="margin-bottom:0">Phone: {{Househelp.phone}} ,</h5>
                            <h5 class="widget-user-desc" style="margin-bottom:0">P.O. Box {{Househelp.address}},</h5>
                            <h5 class="widget-user-desc" style="margin-bottom:0" v-if="Househelp.ward">{{Househelp.ward.name}} Ward,
                                <span v-if="Househelp.constituency">{{Househelp.constituency.name}} Constituency,</span>
                            </h5>
                            <h5 class="widget-user-desc" style="margin-bottom:0" v-if="Househelp.county">
                                {{Househelp.county.name}} County,
                                <span v-if="Househelp.country"> {{Househelp.country.name}}</span>
                            </h5>
                        </span>
                        <span class="float-right">
                            <h5 class="widget-user-desc" style="margin-bottom:0" v-if="Househelp.user">{{Househelp.user.email}}</h5>
                            <p style="margin-bottom:0.25em">
                                <small class="text-muted">Last updated On: {Househelp.updated_at | dateformat}}</small>
                            </p>
                        </span>
                    </div>
                    <div class="card-footer" style="padding-top:0px; margin-top: 60px;">
                            <div class="row">
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">3,200</h5>
                                        <span class="description-header green " >Twitter Followers</span>
                                        <div class="card-tools">
                                            <button class="btn btn-info" style="background-color: purple; color: #fff" >Follow us
                                                <i class="fas fa-plus fw"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">13,000</h5>
                                        <span class="description-header green">Facebook Followers</span>
                                        <div class="card-tools">
                                            <button class="btn btn-info " style="background-color: purple; color: #fff">Follow us
                                                <i class="fas fa-plus fw"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                    <div class="description-block">
                                        <h5 class="description-header">3544</h5>
                                        <span class="description-header green">Linkedin Followers</span>
                                        <div class="card-tools">
                                            <button class="btn btn-info" style="background-color: purple; color: #fff" >Follow us
                                                <i class="fas fa-plus fw"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                    </div>
                </div>
                <div class="widget-user-image" style="top:5px;">
                    <img :src="househelpLoadPassPhoto(Househelp.photo)"  class="border-0"  style="width:160px;">
                    <h3 class="card-title text-center text-white" v-if="Househelp.user">{{Househelp.user.full_name}}</h3>
                </div>
            </div>
            <div class="container-fluid">
                    <div class="row">
                        <div class="card col-md">
                            <div class="card-header">
                               <h3 class="card-title">Househelp Demographic Data</h3>
                            </div>
                            <div class="card-body">
                                 <div class="row">
                                    <div class="col" style="padding: 3px;">
                                        <img class="card-img-top" :src="househelpLoadPassPhoto(Househelp.photo)" style="width:100%; height:130px" alt="Card image cap">
                                    </div>
                                    <div class="col" style="padding: 3px;" v-if="Househelp.idstatus">
                                        <img class="card-img-top" :src="househelpLoadIDFrontPhoto(Househelp.idstatus.id_photo_front)" style="width:100%;height:65px" alt="Card image cap"><br>
                                        <img class="card-img-top" :src="househelpLoadIDBackPhoto(Househelp.idstatus.id_photo_back)" style="width:100%;height:65px" alt="Card image cap">
                                    </div>
                                    <div style="font-weight:bold;font-size:0.7em;min-width:210px;max-width:400px;margin-top:4px;padding-top:4px;font-style: italic ">
                                        <div v-if="Househelp.user">{{Househelp.user.full_name}},</div>
                                        <div>
                                            Househelp,
                                            <span style="color:#9a009a;">
                                                <!-- {{Bureau.name}}, -->
                                            </span>
                                        </div>
                                        <div> ID: ,<span style="color:#9a009a;" v-if="Househelp.idstatus">{{Househelp.idstatus.id_number}}</span>,
                                            Phone: <span style="color:#9a009a;">{{Househelp.phone}},</span>
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
                                        <div >
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
                                                <a href=""  @click.prevent="editHousehelpModal(Househelp.id)">
                                                    <i class="fa fa-edit blue"></i>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card col-md">
                            <div class="card-header">
                               <h3 class="card-title">Househelp Kin Demographic Data</h3>
                            </div>
                            <div class="card-body">
                                 <div class="row" v-for="househelpkin in Househelp.househelpkins" :key="househelpkin.id">
                                    <div class="col" style="padding: 3px;">
                                        <img class="card-img-top" :src="househelpkinLoadPassPhoto(househelpkin.pivot.photo)" style="width:100%; height:130px" alt="Card image cap">
                                    </div>
                                    <div class="col" style="padding: 3px;">
                                        <img class="card-img-top" :src="househelpkinLoadIDFrontPhoto(househelpkin.pivot.id_photo_front)" style="width:100%;height:65px" alt="Card image cap"><br>
                                        <img class="card-img-top" :src="househelpkinLoadIDBackPhoto(househelpkin.pivot.id_photo_back)" style="width:100%;height:65px" alt="Card image cap">
                                    </div>
                                    <div style="font-weight:bold;font-size:0.7em;min-width:210px;max-width:400px;margin-top:4px;padding-top:4px;font-style: italic ">
                                        <div>{{househelpkin.full_name}},</div>
                                        <div>
                                            Househelp Kin,
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
                        <form-wizard role="form" @on-complete="updateHousehelp(Househelp.id)" ref="wizard">
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
                                                <datetime v-model="househelpform.birth_date" type="text" id="birth_date" placeholder="Househelp Birth Date"
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
                                                    <vue-tel-input v-model="househelpform.phone" name="phone" @onInput="HousehelpInputPhone1"
                                                    class="form-control" :class="{ 'is-invalid': househelpform.errors.has('phone') }">
                                                    </vue-tel-input>
                                                    <has-error style="color: #e83e8c" :form="househelpform" field="phone"></has-error>
                                                </div>
                                                <div v-if="househelpform.phone" style="color: #e83e8c">
                                                    <span>Is valid: <strong>{{phone1.isValid}}</strong>,&nbsp;</span>
                                                    <span>Country: <strong>{{phone1.country}}</strong></span>
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
                                                <input type="radio" v-model="IDstatus" value="HASIDbutlost">
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
                                            <div>Househelp ID status</div>

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
                                            <div v-if="this.househelpform.other_chronics = 'Has Other Chronic Issues'">
                                                <input type="radio" v-model="Healthstatus" value="HASCHRONIC" checked>
                                                <label for="Healthstatus" class="col-form-label">Has Other Chronic</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div v-show="Healthstatus === 'HEALTHY'">
                                                   <label for="HIV_status" class="col-form-label">HIV status</label>
                                                    <input v-model="househelpform.HIV_status" type="text" name="HIV_status" placeholder="HIV status"
                                                    class="form-control" :class="{ 'is-invalid': househelpform.errors.has('HIV_status') }" >
                                                   <has-error style="color: #e83e8c" :form="househelpform" field="HIV_status"></has-error>
                                            </div>
                                            <div v-show="Healthstatus === 'HASMINOR'">
                                                <label for="HIV_status" class="col-form-label">HIV status</label>
                                                    <input v-model="househelpform.HIV_status" type="text" name="HIV_status" placeholder="HIV status"
                                                    class="form-control" :class="{ 'is-invalid': househelpform.errors.has('HIV_status') }" >
                                                   <has-error style="color: #e83e8c" :form="househelpform" field="HIV_status"></has-error>
                                            </div>
                                            <div v-show="Healthstatus === 'HASCHRONIC'">
                                                <label for="HIV_status" class="col-form-label"> HIV status</label>
                                                    <input v-model="househelpform.HIV_status" type="text" name="HIV_status" placeholder="HIV status"
                                                    class="form-control" :class="{ 'is-invalid': househelpform.errors.has('HIV_status') }" >
                                                   <has-error style="color: #e83e8c" :form="househelpform" field="HIV_status"></has-error>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div v-show="Healthstatus === 'HASMINOR'">
                                                <label for="specify" class="col-form-label">Allergies Specification</label>
                                                <input v-model="househelpform.specify" type="text" name="specify" placeholder="Allergies Specification"
                                                   class="form-control" :class="{ 'is-invalid': househelpform.errors.has('specify') }" >
                                               <has-error style="color: #e83e8c" :form="househelpform" field="specify"></has-error>
                                            </div>
                                            <div v-show="Healthstatus === 'HASCHRONIC'">
                                                   <label for="chronic_details" class="col-form-label">Chronic Issues</label>
                                                    <input v-model="househelpform.chronic_details" type="text" name="chronic_details" placeholder="Chronic Issues"
                                                    class="form-control" :class="{ 'is-invalid': househelpform.errors.has('chronic_details') }" >
                                                   <has-error style="color: #e83e8c" :form="househelpform" field="chronic_details"></has-error>
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
                                            <vue-tel-input v-model="househelpkinform.phone" name="phone" @onInput="HousehelpkinInputPhone1"
                                            class="form-control" :class="{ 'is-invalid': househelpkinform.errors.has('phone') }">
                                            </vue-tel-input>
                                            <has-error style="color: #e83e8c" :form="househelpkinform" field="phone"></has-error>
                                        </div>
                                        <div v-if="househelpkinform.phone" style="color: #e83e8c">
                                            <span>Is valid: <strong>{{phone2.isValid}}</strong>,&nbsp;</span>
                                            <span>Country: <strong>{{phone2.country}}</strong></span>
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











    </section>
    <!-- /.content -->
</template>

<script>
    export default {
        data(){
            return{
                IDstatus:"HasID",    //id status check
                Healthstatus: "HEALTHY",
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
                        IDstatus:'',
                        idstatus_id:'',//id of idstatus row
                        bureau_househelp_id:'',
                        id_status:'',
                        id_number:'',
                        ref_number:'',
                        id_photo_front:'',
                        id_photo_back:'',
                        waiting_card_photo:'',
                        reason:'',
                        status:'',

                        //health status
                        HealthStatus:'',
                        health_status_id:'',
                        bureau_househelp_id:'',
                        health_status:'',
                        HIV_status:'',
                        allergy:'',
                        chronic_details:'',
                        other_chronics:'',
                        specify:'',
                        status:'',
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
                 //Househelp
                phone1:{
                        isValid: false,
                        country: undefined,
                },
                 //househelpkin
                phone2:{
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
            this.loadDurations(); //from methods
            this.loadEducations(); //from methods
            this.loadEnglishstatuses(); //from methods
            this.loadExperiences(); //from methods
            this.loadKids(); //from methods
            this.loadMaritalstatuses(); //from methods
            this.loadOperations(); //from methods
            this.loadReligions(); //from methods
            this.loadSkills(); //from methods
            this.loadTribes(); //from methods
            this.loadGenders(); //from methods
            this.loadRelationships(); //from methods
            this.loadBureau(); //from methods
            this.singlehousehelp()

        },
        computed:{
            Countries(){
                return this.$store.getters.Countries
            },
            Counties(){
                console.log(this.$store.getters.CountryCounties)
               return this.$store.getters.CountryCounties
            },
            Constituencies(){
               return this.$store.getters.CountyConstituencies
            },
            Wards(){
               return this.$store.getters.ConstituencyWards
            },
            Bureau(){
               return this.$store.getters.Bureau
            },
            Househelp(){
                console.log(this.$store.getters.Househelp)
               return this.$store.getters.Househelp
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
        },
        methods:{
            singlehousehelp(){
                console.log(this.$route.params.id, 'jjjjj')
                this.$store.dispatch('HousehelpById', this.$route.params.id);
            },
             //Househelp Update Demographic
            validateupdateHousehelpDemograhic() {
                let id = this.househelpform.id;
                this.$Progress.start()
                return this.househelpform.patch('/househelp/verify/updatedemographics/' +id)
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
                let id = this.househelpform.id;
                this.$Progress.start()
                return this.househelpform.patch('/househelp/verify/updateattributes/' +id)
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
            HousehelpInputPhone1({ number, isValid, country }) {
            console.log(number, isValid, country);
            this.househelpform.phone = number;
            this.phone1.isValid = isValid;
            this.phone1.country = country && country.name;
            },
             //Househelpkin
            HousehelpkinInputPhone1({ number, isValid, country }) {
            console.log(number, isValid, country);
            this.househelpkinform.phone = number;
            this.phone2.isValid = isValid;
            this.phone2.country = country && country.name;
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
            loadBureau(){
                return this.$store.dispatch("bureauByUserID")
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
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateHousehelpPassPhoto(househelpform_photo){
                // console.log(househelpform_bureauhousehelp_photo)
                let img = this.househelpform.photo;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                        //  console.log('its reall null')
                      }else{
                          if(img.length>100){
                            return this.househelpform.photo;
                        }else{
                            if(househelpform_photo){
                                return "assets/bureau/img/househelps/passports/"+househelpform_photo;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }
            },
            updateHousehelpIDFrontPhoto(househelpform_id_photo_front){
                let img = this.househelpform.id_photo_front;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.househelpform.id_photo_front;
                        }else{
                            if(househelpform_id_photo_front){
                                return "assets/bureau/img/househelps/IDs/front/"+househelpform_id_photo_front;
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
                                return "assets/bureau/img/househelps/IDs/back/"+househelpform_id_photo_back;
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
                                return "assets/bureau/img/househelps/waitingcards/"+househelpform_waiting_card_photo;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },

            editHousehelpModal(id){
                console.log(id)
                 this.househelpform.reset()
                    this.$Progress.start();
                      axios.get('/househelp/edit/'+id)
                        .then((response)=>{
                           $('#HousehelpModal').modal('show')
                           toast({
                            type: 'success',
                            title: 'Fetched the Househelp data successfully'
                            })
                            console.log(response.data)
                            this.househelpform.fill(response.data.househelp)
                            this.househelpform.id = response.data.househelp.id
                            this.househelpform.first_name = response.data.househelp.user.first_name
                            this.househelpform.last_name = response.data.househelp.user.last_name
                            this.househelpform.email = response.data.househelp.user.email
                            this.househelpform.user_id = response.data.househelp.user_id
                            this.househelpform.password = response.data.househelp.user.password

                            this.househelpform.photo = response.data.househelp.photo
                            this.househelpform.bureau_id = response.data.househelp.bureau_id


                            this.househelpform.about_me = response.data.househelp.about_me
                            this.househelpform.phone = response.data.househelp.phone
                            this.househelpform.address = response.data.househelp.address

                            //    //get country id
                            this.househelpform.country_id = response.data.househelp.country.id
                            console.log(response.data.househelp.country.id)
                            //get county id using the country id
                             this.househelpform.county_id = response.data.househelp.county.id
                             console.log(response.data.househelp.county.id)
                            this.$store.dispatch('countrycounties', response.data.househelp.country.id);
                            //get contituency using county id
                            this.househelpform.constituency_id = response.data.househelp.constituency.id
                            console.log(response.data.househelp.constituency.id)
                            this.$store.dispatch('countyconstituencies', response.data.househelp.county.id);
                            // //get ward usng constituency id
                           this.househelpform.ward_id = response.data.househelp.ward.id
                           console.log( response.data.househelp.constituency.id)
                            this.$store.dispatch('constituencywards', response.data.househelp.constituency.id);

                            this.househelpform.age = response.data.househelp.age
                            this.househelpform.gender_id = response.data.househelp.gender.id
                            this.househelpform.education_id = response.data.househelp.education.id
                            this.househelpform.experience_id = response.data.househelp.experience.id
                            this.househelpform.maritalstatus_id = response.data.househelp.maritalstatus.id
                            this.househelpform.tribe_id = response.data.househelp.tribe.id
                            this.househelpform.skill_id = response.data.househelp.skill.id
                            this.househelpform.operation_id = response.data.househelp.operation.id
                            this.househelpform.duration_id = response.data.househelp.duration.id
                            this.househelpform.englishstatus_id = response.data.househelp.englishstatus.id
                            this.househelpform.religion_id = response.data.househelp.religion.id
                            this.househelpform.kid_id = response.data.househelp.kid.id
                            //id status
                            this.househelpform.idstatus_id = response.data.househelp.idstatus.id
                            this.househelpform.bureau_househelp_id = response.data.househelp.idstatus.bureau_househelp_id
                            this.househelpform.id_number = response.data.househelp.idstatus.id_number
                            this.househelpform.ref_number = response.data.househelp.idstatus.ref_number
                            this.househelpform.id_photo_front = response.data.househelp.idstatus.id_photo_front
                            this.househelpform.id_photo_back = response.data.househelp.idstatus.id_photo_back
                            this.househelpform.waiting_card_photo = response.data.househelp.idstatus.waiting_card_photo
                            this.househelpform.reason = response.data.househelp.idstatus.reason
                            this.househelpform.status = response.data.househelp.idstatus.status

                            if(response.data.househelp.idstatus.reason == 'Has ID Card'){
                                this.IDstatus = 'HasID'
                            }
                            if(response.data.househelp.idstatus.reason == 'Has ID Card but lost, however applied for replacement'){
                                this.IDstatus = 'HASIDbutlost'
                            }
                            if(response.data.househelp.idstatus.reason == 'Dont Have ID Card but applied for new Card'){
                                this.IDstatus = 'NOIDbutapplied'
                            }
                            if(response.data.househelp.idstatus.reason == 'Dont Have ID Card and Has not applied for new Card'){
                                this.IDstatus = 'NOID'
                            }

                            // this.househelpform.health_status = response.data.househelp
                            this.househelpform.HIV_status = response.data.househelp.healthstatus.HIV_status
                            this.househelpform.allergy = response.data.househelp.healthstatus.allergy
                            this.househelpform.health_status_id = response.data.househelp.healthstatus.id
                            this.househelpform.bureau_househelp_id = response.data.househelp.healthstatus.bureau_househelp_id
                            this.househelpform.chronic_details = response.data.househelp.healthstatus.chronic_details
                            this.househelpform.other_chronics = response.data.househelp.healthstatus.other_chronics
                            this.househelpform.specify = response.data.househelp.healthstatus.specify
                            this.househelpform.status = response.data.househelp.healthstatus.status

                            if(response.data.househelp.healthstatus.allergy == 'Healthy'){
                                this.Healthstatus = 'HEALTHY'
                            }
                            if(response.data.househelp.healthstatus.allergy == 'Has Minor Health Issues'){
                                this.Healthstatus = 'HASMINOR'
                            }
                            if(response.data.househelp.healthstatus.other_chronics == 'Has Other Chronic Issues'){
                                console.log(response.data.househelp.healthstatus.allergy)
                                this.Healthstatus = 'HASCHRONIC'
                            }

                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                            //errors
                            $('#HousehelpModal').modal('show');
                            toast({
                            type: 'error',
                            title: 'There was something Wrong'
                            })
                        })
            },
            updateHousehelp(id){
                  console.log(id)
                  console.log(+this.$route.params.id)
                  this.$Progress.start();
                     this.househelpform.patch('/househelp/update/'+id)
                        .then(()=>{
                        this.$store.dispatch('HousehelpById', this.$route.params.id);
                        this.$refs.wizard.reset()
                         $('#HousehelpModal').modal('hide')

                         toast({
                            type: 'success',
                            title: 'Househelp Created successfully'
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
                // console.log(househelpkinform_bureauhousehelpkin_photo)
                let img = this.househelpkinform.photo;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                        //  console.log('its reall null')
                      }else{
                          if(img.length>100){
                            return this.househelpkinform.photo;
                        }else{
                            if(househelpkinform_househelpkin_photo){
                                return "assets/bureau/img/househelps/househelpkins/passports/"+househelpkinform_househelpkin_photo;
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
                                return "assets/bureau/img/househelps/househelpkins/IDs/front/"+househelpkinform_id_photo_front;
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
                                return "assets/bureau/img/househelps/househelpkins/IDs/back/"+househelpkinform_id_photo_back;
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
                        title: 'There was something Wrong Wheen feching data'
                        })
                    })
            },
            editHousehelpkinModal(id){
                console.log(id)
                 this.househelpkinform.reset()
                    this.$Progress.start();
                      axios.get('/househelpkin/edit/'+id)
                        .then((response)=>{
                           $('#HousehelpKinModal').modal('show')
                           toast({
                            type: 'success',
                            title: 'Fetched the Househelp data successfully'
                            })
                            console.log(response.data)
                            this.househelpkinform.fill(response.data.househelpkin)
                            this.househelpkinform.id  = response.data.househelpkin.househelpkins[0].pivot.user_id
                        //househelp
                            this.househelpkinform.first_name   = response.data.househelpkin.first_name
                            this.househelpkinform.last_name    = response.data.househelpkin.last_name
                            this.househelpkinform.email        = response.data.househelpkin.email
                            this.househelpkinform.user_type    = response.data.househelpkin.user_type

                            this.househelpkinform.bureau_househelp_id  = response.data.househelpkin.househelpkins[0].pivot.bureau_househelp_id
                            this.househelpkinform.gender_id   = response.data.househelpkin.househelpkins[0].pivot.gender_id
                            this.househelpkinform.user_id     = response.data.househelpkin.househelpkins[0].pivot.user_id

                            this.househelpkinform.househelp_id  = response.data.househelpkin.househelpkins[0].pivot.househelp_id
                            this.househelpkinform.relationship_id  = response.data.househelpkin.househelpkins[0].pivot.relationship_id

                            this.househelpkinform.id_no  = response.data.househelpkin.househelpkins[0].pivot.id_no
                            this.househelpkinform.photo  = response.data.househelpkin.househelpkins[0].pivot.photo

                            this.househelpkinform.id_photo_front  = response.data.househelpkin.househelpkins[0].pivot.id_photo_front
                            this.househelpkinform.id_photo_back  = response.data.househelpkin.househelpkins[0].pivot.id_photo_back
                            console.log(this.househelpkinform.id_photo_front)
                            console.log(this.househelpkinform.id_photo_back)
                            this.househelpkinform.phone  = response.data.househelpkin.househelpkins[0].pivot.phone
                            this.househelpkinform.address  = response.data.househelpkin.househelpkins[0].pivot.address

                        // //    //get country id
                            this.househelpkinform.country_id = response.data.househelpkin.househelpkins[0].pivot.country_id
                            //get county id using the country id
                            this.househelpkinform.county_id = response.data.househelpkin.househelpkins[0].pivot.county_id
                            this.$store.dispatch('countrycounties', response.data.househelpkin.househelpkins[0].pivot.country_id);
                            //get contituency using county id
                            this.househelpkinform.constituency_id = response.data.househelpkin.househelpkins[0].pivot.constituency_id
                            this.$store.dispatch('countyconstituencies', response.data.househelpkin.househelpkins[0].pivot.county_id);
                            // //get ward usng constituency id
                            this.househelpkinform.ward_id = response.data.househelpkin.househelpkins[0].pivot.ward_id
                            this.$store.dispatch('constituencywards', response.data.househelpkin.househelpkins[0].pivot.constituency_id);
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
               console.log(id)
                  console.log(+this.$route.params.id)
                  this.$Progress.start();
                     this.househelpkinform.patch('/househelpkin/update/'+id)
                        .then(()=>{
                        this.$store.dispatch('HousehelpById', this.$route.params.id);
                         $('#HousehelpKinModal').modal('hide')
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


        },
    }
</script>
