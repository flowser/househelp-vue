<template>
  <div class="container-fluid mt-5">
      <!-- Main content -->
    <div class="col-md-12">
     <section class="content">
      <div class="row justify-content-around">
        <div class="col-md">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Welcome to {{Bureau.name}} Househelps</h3>
              <h3 class="card-title">Househelps And Their Next of Kins Table</h3>
              <div class="card-tools">
                    <button class="btn btn-success"  @click.prevent="newHousehelpKinModal()">Add New Househelp and Their Next of Kins                         <i class="fas fa-plus fw"></i>
                     </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>S1</th>
                    <th>Househelp Details</th>
                    <th>Househelp Attributes</th>
                    <th style="padding-left: 14px">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(househelp, index) in Bureau.bureauhousehelps" :key="househelp.id">
                    <td >{{index+1}}</td>
                    <td >
                        <div class="row">
                           <div class="col" style="padding: 3px;">
                                        <img class="card-img-top" :src="househelpLoadPassPhoto(househelp.pivot.photo)" style="width:100%; height:130px" alt="Card image cap">
                                    </div>
                                    <div class="col" style="padding: 3px;" v-if="househelp.idstatus_id_photo_front !=null">
                                        <img class="card-img-top" :src="househelpLoadIDFrontPhoto(househelp.idstatus_id_photo_front)" style="width:100%;height:65px" alt="Card image cap"><br>
                                        <img class="card-img-top" :src="househelpLoadIDBackPhoto(househelp.idstatus_id_photo_back)" style="width:100%;height:65px" alt="Card image cap">
                                    </div>
                                    <div class="col" style="padding: 3px;" v-else>
                                        Waiting Card<br>
                                        <img class="card-img-top" :src="househelpLoadWaitingCard(househelp.idstatus_waiting_card_photo)" style="width:100%;height:65px" alt="Card image cap"><br>
                                    </div>
                                    <div style="font-weight:bold;font-size:0.7em;min-width:210px;max-width:400px;margin-top:4px;padding-top:4px;font-style: italic ">
                                        <div>{{househelp.full_name}},</div>
                                        <div>
                                            Househelp,
                                            <!-- {{househelp.position_name}}, -->
                                            <span style="color:#9a009a;">
                                                {{Bureau.name}},
                                            </span>
                                        </div>
                                        <div>
                                             ID: ,<span style="color:#9a009a;">{{househelp.idstatus_id_number}}</span>,
                                            Phone: <span style="color:#9a009a;">{{househelp.pivot.phone}},</span>
                                        </div>
                                        <div>
                                            Mail: <span style="color:#9a009a;">{{househelp.email}},</span>
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
                        </div>
                    </td>
                    <td>
                        <div class="row">
                           <div class="col" style="padding: 3px;">
                               <div style="font-weight:bold;font-size:0.7em;min-width:210px;max-width:400px;margin-top:4px;padding-top:4px;font-style: italic ">
                                    <div>Gender: <span style="color:#9a009a;">{{househelp.gender_name}}</span>,
                                         Age: <span style="color:#9a009a;">{{househelp.age}} Years</span>,
                                    </div>
                                    <div>
                                        Marital Status: <span style="color:#9a009a;">{{househelp.maritalstatus_name}}</span>,
                                    </div>
                                    <div>
                                        English Ability: <span style="color:#9a009a;">{{househelp.englishstatus_name}}</span>,
                                    </div>
                                    <div>
                                        Education Level: <span style="color:#9a009a;">{{househelp.education_name}}</span>,
                                    </div>
                                    <div>
                                        Experience Level: <span style="color:#9a009a;">{{househelp.experience_name}}</span>,
                                    </div>
                                    <div>
                                         Duration: <span style="color:#9a009a;">{{househelp.duration_name}}</span>,
                                    </div>
                                    <div>
                                        Employemnt Status:
                                         <span style="color:#9a009a;">
                                            <div v-if="househelp.employementstatus == true">
                                                <a type="button" class="btn btn-success btn-md"> Employed</a>
                                            </div>
                                            <div v-else-if="househelp.employementstatus == false">
                                                <a type="button" class="btn btn-success btn-md"> Unemployed</a>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                           </div>
                        </div>
                    </td>
                    <td style="padding: 3px; width:130px" >
                        <div class="clearfix" style="font-weight:bold;font-size:0.7em;">
                            <span class="float-left" style="margin-bottom:-0.5em" >
                                <div style="margin-bottom:0.25em"> Updated at:
                                    <span style="color:#9a009a;">{{househelp.created_at | dateformat}} </span>
                                </div>
                            </span>
                        </div>
                        <br>
                        <div class="clearfix" style="font-weight:bold;font-size:0.7em;">
                            <span class="float-left">
                                <router-link  :to="`/househelp/${househelp.id}`">
                                        <i class="fa fa-eye "></i>
                                </router-link>
                            </span>
                            <span class="float-right">
                                <a href=""  @click.prevent="deleteHousehelp(househelp.user_id)">
                                    <i class="fa fa-trash red"></i>
                                </a>
                            </span>
                        </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
    </section>


    </div>
        <!-- Role Modal -->

    <div class="modal fade " id="Househelp_KinModal" tabindex="-1" role="dialog" aria-labelledby="Househelp_KinModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4> Househelp Demographic data</h4>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form-wizard role="form" @on-complete="addHousehelp(Bureau.id)" ref="wizard">
                            <h5 class="modal-title" id="Househelp_KinModalLabel">Add New Househelp & Kin</h5>

                            <tab-content title="Househelp Househelp Info" :before-change="validateHousehelpDemograhic">
                                      <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="househelp_first_name" class="col-form-label"> Househelp First Name</label>
                                            <input v-model="househelp_kinform.househelp_first_name" type="text" name="first_name" placeholder="Househelp First Name"
                                                class="form-control" :class="{ 'is-invalid': househelp_kinform.errors.has('househelp_first_name') }" >
                                            <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelp_first_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="househelp_last_name" class=" col-form-label">househelp_Last Name </label>
                                            <input v-model="househelp_kinform.househelp_last_name" type="househelp_last_name" name="househelp_last_name" placeholder="househelp_Last Name"
                                                class="form-control" :class="{ 'is-invalid': househelp_kinform.errors.has('househelp_last_name') }" >
                                            <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelp_last_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="email" class=" col-form-label">Email </label>
                                            <input v-model="househelp_kinform.email" type="email" name="email" placeholder="Email Address"
                                                class="form-control" :class="{ 'is-invalid': househelp_kinform.errors.has('email') }" >
                                            <has-error style="color: #e83e8c" :form="househelp_kinform" field="email"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <input v-model="househelp_kinform.househelp_password" type="password" id="househelp_password" placeholder="Househelp Password"
                                                class="form-control" :class="{ 'is-invalid': househelp_kinform.errors.has('househelp_password') }">
                                            <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelp_password"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="househelp_birth_date" class="col-form-label">Househelp Birth Date</label>
                                                <!-- <datetime v-model="househelp_kinform.househelp_birth_date" type="text" name="househelp_birth_date" placeholder="Househelp Birth Date"
                                                              input-class="my-class form-control" :class="{ 'is-invalid': househelp_kinform.errors.has('househelp_birth_date') }" >
                                                </datetime> -->
                                                <datetime v-model="househelp_kinform.househelp_birth_date" type="text" id="househelp_birth_date" placeholder="Househelp Birth Date"
                                                class="form-control"  input-class="form-control border-0" style="padding-top: 0px;"  :class="{ 'is-invalid': househelp_kinform.errors.has('househelp_birth_date') }"></datetime>
                                            <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelp_birth_date"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="househelp_address" class=" col-form-label">Househelp Address</label>
                                            <input v-model="househelp_kinform.househelp_address" type="text" name="Address" placeholder="Househelp Address"
                                                class="form-control" :class="{ 'is-invalid': househelp_kinform.errors.has('househelp_address') }" >
                                            <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelp_address"></has-error>
                                        </div>

                                    </div>
                                    <div class=" row">
                                         <div class="form-group col-md-4">
                                            <label for="househelp_gender_id">Select Gender</label>
                                            <select class="form-control" v-model="househelp_kinform.househelp_gender_id"
                                                    :class="{ 'is-invalid': househelp_kinform.errors.has('househelp_gender_id') }">
                                                    <option disabled value="">Select gender</option>
                                                    <option v-for="gender in Genders" :value="gender.id" :key="gender.id">{{gender.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelp_gender_id"></has-error>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="househelp_phone" class="col-form-label"> Househelp Phone</label>
                                                <div>
                                                    <vue-tel-input v-model="househelp_kinform.househelp_phone" name="househelp_phone" @onInput="HousehelpInputPhone1"
                                                    class="form-control" :class="{ 'is-invalid': househelp_kinform.errors.has('househelp_phone') }">
                                                    </vue-tel-input>
                                                    <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelp_phone"></has-error>
                                                </div>
                                                <div v-if="househelp_kinform.househelp_phone" style="color: #e83e8c">
                                                    <span>Is valid: <strong>{{phone1.isValid}}</strong>,&nbsp;</span>
                                                    <span>Country: <strong>{{phone1.country}}</strong></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="househelp_photo" class=" col-form-label">Househelp PassPort Image</label><br>
                                                <input @change="househelpChangePassPhoto($event)" type="file" name="househelp_photo"
                                                    :class="{ 'is-invalid': househelp_kinform.errors.has('househelp_photo') }"
                                                    class="form-control" style=" border: 1px solid #ffffff; padding-left: 0px;">
                                                    <img  :src="househelp_kinform.househelp_photo" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelp_photo"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-3">
                                            <label for="househelp_country_id">Select Country</label>
                                            <select class="form-control" @change="HousehelpcountryCounties(househelp_kinform.househelp_country_id)"
                                            v-model="househelp_kinform.househelp_country_id" :class="{ 'is-invalid': househelp_kinform.errors.has('househelp_country_id') }">
                                                    <option disabled value="">Select Country</option>
                                                    <option v-for="country in Countries" :value="country.id" :key="country.id">{{country.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelp_country_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="househelp_county_id" class=" col-form-label">County</label>
                                            <select class="form-control" @change="HousehelpcountyConstituencies(househelp_kinform.househelp_county_id)"
                                            v-model="househelp_kinform.househelp_county_id" :class="{ 'is-invalid': househelp_kinform.errors.has('househelp_county_id') }">
                                                    <option disabled value="">Select County</option>
                                                    <option v-for="county in Counties" :value="county.id" :key="county.id">{{county.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelp_county_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="househelp_constituency_id" class=" col-form-label">Constituency</label>
                                            <select class="form-control" @change="HousehelpconstituencyWards(househelp_kinform.househelp_constituency_id)"
                                            v-model="househelp_kinform.househelp_constituency_id" :class="{ 'is-invalid': househelp_kinform.errors.has('househelp_constituency_id') }">
                                                    <option disabled value="">Select County</option>
                                                    <option v-for="constituency in Constituencies" :value="constituency.id" :key="constituency.id">{{constituency.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelp_constituency_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="househelp_ward_id" class="col-form-label"> Ward </label>
                                            <select class="form-control"
                                            v-model="househelp_kinform.househelp_ward_id" :class="{ 'is-invalid': househelp_kinform.errors.has('househelp_ward_id') }">
                                                    <option disabled value="">Select Ward</option>
                                                    <option v-for="ward in Wards" :value="ward.id" :key="ward.id">{{ward.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelp_ward_id"></has-error>
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
                                               <label for="househelp_id_photo_front" class=" col-form-label">Househelp FrontSide ID Photo</label><br>
                                                <input @change="househelpChangeIDFrontPhoto($event)" type="file" name="househelp_id_photo_front"
                                                    :class="{ 'is-invalid': househelp_kinform.errors.has('househelp_id_photo_front') }"
                                                     class="form-control" style=" border: 1px solid #ffffff;padding-left: 0px;">
                                                    <img  :src="househelp_kinform.househelp_id_photo_front" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelp_id_photo_front"></has-error>
                                            </div>
                                            <div v-show="IDstatus === 'HASIDbutlost'">
                                                <label for="househelp_id_number" class="col-form-label">Househelp ID NO.</label>
                                                    <input v-model="househelp_kinform.househelp_id_number" type="text" name="househelp_id_number" placeholder="Househelp ID NO"
                                                    class="form-control" :class="{ 'is-invalid': househelp_kinform.errors.has('househelp_id_number') }" >
                                                   <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelp_id_number"></has-error>
                                            </div>
                                            <div v-show="IDstatus === 'NOIDbutapplied'">
                                                <label for="househelp_ref_number" class="col-form-label">Househelp Waiting Card Rer NO.</label>
                                                    <input v-model="househelp_kinform.househelp_ref_number" type="text" name="househelp_ref_number" placeholder="Househelp Waiting card ref NO"
                                                    class="form-control" :class="{ 'is-invalid': househelp_kinform.errors.has('househelp_ref_number') }" >
                                                   <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelp_ref_number"></has-error>
                                            </div>
                                            <div v-show="IDstatus === 'NOID'">
                                                <h5 class="text-center">This Househelp has No ID card Whatsoever,
                                                     but you can register and later update if Gets ID card</h5>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                             <div v-show="IDstatus === 'HasID'">
                                                <label for="househelp_id_photo_back" class=" col-form-label">Househelp BackSide ID Photo</label><br>
                                                    <input @change="househelpChangeIDBackPhoto($event)" type="file" name="househelp_id_photo_back"
                                                        :class="{ 'is-invalid': househelp_kinform.errors.has('househelp_id_photo_back') }"
                                                        class="form-control" style=" border: 1px solid #ffffff;padding-left: 0px;">
                                                        <img  :src="househelp_kinform.househelp_id_photo_back" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelp_id_photo_back"></has-error>

                                               <div>
                                                   <label for="househelp_id_number" class="col-form-label">Househelp ID NO.</label>
                                                    <input v-model="househelp_kinform.househelp_id_number" type="text" name="househelp_id_number" placeholder="Househelp ID NO"
                                                    class="form-control" :class="{ 'is-invalid': househelp_kinform.errors.has('househelp_id_number') }" >
                                                   <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelp_id_number"></has-error>
                                               </div>
                                            </div>
                                            <div v-show="IDstatus === 'HASIDbutlost'">
                                                  <label for="househelp_waiting_card_photo" class="col-form-label">Househelp Waiting Card Photo</label>
                                                 <input @change="househelpChangeWaitingCardPhoto($event)" type="file" name="househelp_waiting_card_photo"
                                                    :class="{ 'is-invalid': househelp_kinform.errors.has('househelp_waiting_card_photo') }"
                                                     class="form-control" style=" border: 1px solid #ffffff;padding-left: 0px;">
                                                    <img  :src="househelp_kinform.househelp_waiting_card_photo" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelp_waiting_card_photo"></has-error>
                                            </div>
                                            <div v-show="IDstatus === 'NOIDbutapplied'">
                                                <label for="househelp_waiting_card_photo" class=" col-form-label">Househelp Waiting Card Photo</label><br>
                                                <input @change="househelpChangeWaitingCardPhoto($event)" type="file" name="househelp_waiting_card_photo"
                                                    :class="{ 'is-invalid': househelp_kinform.errors.has('househelp_waiting_card_photo') }"
                                                     class="form-control" style=" border: 1px solid #ffffff;padding-left: 0px;">
                                                    <img  :src="househelp_kinform.househelp_waiting_card_photo" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelp_waiting_card_photo"></has-error>
                                            </div>
                                        </div>
                                    </div>
                            </tab-content>
                            <tab-content title="Househelp Features Info" :before-change="validateHousehelpAttributes">
                                    <div class=" row">
                                         <div class="form-group col-md-3">
                                            <label for="househelp_education_id">Select Education Level</label>
                                            <select class="form-control" v-model="househelp_kinform.househelp_education_id"
                                                    :class="{ 'is-invalid': househelp_kinform.errors.has('househelp_education_id') }">
                                                    <option disabled value="">Select education</option>
                                                    <option v-for="education in Educations" :value="education.id" :key="education.id">{{education.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelp_education_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="househelp_experience_id">Select Experience</label>
                                            <select class="form-control" v-model="househelp_kinform.househelp_experience_id"
                                                    :class="{ 'is-invalid': househelp_kinform.errors.has('househelp_experience_id') }">
                                                    <option disabled value="">Select experience</option>
                                                    <option v-for="experience in Experiences" :value="experience.id" :key="experience.id">{{experience.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelp_experience_id"></has-error>
                                        </div>
                                         <div class="form-group col-md-3">
                                            <label for="househelp_maritalstatus_id">Select Maritalstatus</label>
                                            <select class="form-control" v-model="househelp_kinform.househelp_maritalstatus_id"
                                                    :class="{ 'is-invalid': househelp_kinform.errors.has('househelp_maritalstatus_id') }">
                                                    <option disabled value="">Select maritalstatus</option>
                                                    <option v-for="maritalstatus in Maritalstatuses" :value="maritalstatus.id" :key="maritalstatus.id">{{maritalstatus.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelp_maritalstatus_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="househelp_tribe_id">Select Tribe</label>
                                            <select class="form-control" v-model="househelp_kinform.househelp_tribe_id"
                                                    :class="{ 'is-invalid': househelp_kinform.errors.has('househelp_tribe_id') }">
                                                    <option disabled value="">Select tribe</option>
                                                    <option v-for="tribe in Tribes" :value="tribe.id" :key="tribe.id">{{tribe.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelp_tribe_id"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                         <div class="form-group col-md-3">
                                            <label for="househelp_skill_id">Select Skill Level</label>
                                            <select class="form-control" v-model="househelp_kinform.househelp_skill_id"
                                                    :class="{ 'is-invalid': househelp_kinform.errors.has('househelp_skill_id') }">
                                                    <option disabled value="">Select skill</option>
                                                    <option v-for="skill in Skills" :value="skill.id" :key="skill.id">{{skill.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelp_skill_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="househelp_operation_id">Select Operation</label>
                                            <select class="form-control" v-model="househelp_kinform.househelp_operation_id"
                                                    :class="{ 'is-invalid': househelp_kinform.errors.has('househelp_operation_id') }">
                                                    <option disabled value="">Select operation</option>
                                                    <option v-for="operation in Operations" :value="operation.id" :key="operation.id">{{operation.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelp_operation_id"></has-error>
                                        </div>
                                         <div class="form-group col-md-3">
                                            <label for="househelp_duration_id">Select Duration</label>
                                            <select class="form-control" v-model="househelp_kinform.househelp_duration_id"
                                                    :class="{ 'is-invalid': househelp_kinform.errors.has('househelp_duration_id') }">
                                                    <option disabled value="">Select duration</option>
                                                    <option v-for="duration in Durations" :value="duration.id" :key="duration.id">{{duration.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelp_duration_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="househelp_englishstatus_id">Select Englishstatus</label>
                                            <select class="form-control" v-model="househelp_kinform.househelp_englishstatus_id"
                                                    :class="{ 'is-invalid': househelp_kinform.errors.has('househelp_englishstatus_id') }">
                                                    <option disabled value="">Select englishstatus</option>
                                                    <option v-for="englishstatus in Englishstatuses" :value="englishstatus.id" :key="englishstatus.id">{{englishstatus.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelp_englishstatus_id"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-3">
                                            <label for="househelp_religion_id">Select Religion Level</label>
                                            <select class="form-control" v-model="househelp_kinform.househelp_religion_id"
                                                    :class="{ 'is-invalid': househelp_kinform.errors.has('househelp_religion_id') }">
                                                    <option disabled value="">Select religion</option>
                                                    <option v-for="religion in Religions" :value="religion.id" :key="religion.id">{{religion.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelp_religion_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="househelp_kid_id">Select Kid Level</label>
                                            <select class="form-control" v-model="househelp_kinform.househelp_kid_id"
                                                    :class="{ 'is-invalid': househelp_kinform.errors.has('househelp_kid_id') }">
                                                    <option disabled value="">Select kid</option>
                                                    <option v-for="kid in Kids" :value="kid.id" :key="kid.id">{{kid.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelp_kid_id"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <div>Househelp ID status</div>
                                            <div>
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
                                                   <label for="HIV_status" class="col-form-label">HIV status</label>
                                                    <input v-model="househelp_kinform.HIV_status" type="text" name="HIV_status" placeholder="HIV status"
                                                    class="form-control" :class="{ 'is-invalid': househelp_kinform.errors.has('HIV_status') }" >
                                                   <has-error style="color: #e83e8c" :form="househelp_kinform" field="HIV_status"></has-error>
                                            </div>
                                            <div v-show="Healthstatus === 'HASMINOR'">
                                                <label for="HIV_status" class="col-form-label">HIV status</label>
                                                    <input v-model="househelp_kinform.HIV_status" type="text" name="HIV_status" placeholder="HIV status"
                                                    class="form-control" :class="{ 'is-invalid': househelp_kinform.errors.has('HIV_status') }" >
                                                   <has-error style="color: #e83e8c" :form="househelp_kinform" field="HIV_status"></has-error>
                                            </div>
                                            <div v-show="Healthstatus === 'HASCHRONIC'">
                                                <label for="HIV_status" class="col-form-label"> HIV status</label>
                                                    <input v-model="househelp_kinform.HIV_status" type="text" name="HIV_status" placeholder="HIV status"
                                                    class="form-control" :class="{ 'is-invalid': househelp_kinform.errors.has('HIV_status') }" >
                                                   <has-error style="color: #e83e8c" :form="househelp_kinform" field="HIV_status"></has-error>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div v-show="Healthstatus === 'HASMINOR'">
                                                <label for="specify" class="col-form-label">Allergies Specification</label>
                                                <input v-model="househelp_kinform.specify" type="text" name="specify" placeholder="Allergies Specification"
                                                   class="form-control" :class="{ 'is-invalid': househelp_kinform.errors.has('specify') }" >
                                               <has-error style="color: #e83e8c" :form="househelp_kinform" field="specify"></has-error>
                                            </div>
                                            <div v-show="Healthstatus === 'HASCHRONIC'">
                                                   <label for="chronic_details" class="col-form-label">Chronic Issues</label>
                                                    <input v-model="househelp_kinform.chronic_details" type="text" name="chronic_details" placeholder="Chronic Issues"
                                                    class="form-control" :class="{ 'is-invalid': househelp_kinform.errors.has('chronic_details') }" >
                                                   <has-error style="color: #e83e8c" :form="househelp_kinform" field="chronic_details"></has-error>
                                            </div>
                                        </div>
                                    </div>
                            </tab-content>
                            <tab-content title="Househelpkin Househelpkin Info" :before-change="validateHousehelpkin">
                                      <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="househelpkin_first_name" class="col-form-label"> Househelpkin First Name</label>
                                            <input v-model="househelp_kinform.househelpkin_first_name" type="text" name="first_name" placeholder="Househelpkin First Name"
                                                class="form-control" :class="{ 'is-invalid': househelp_kinform.errors.has('househelpkin_first_name') }" >
                                            <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelpkin_first_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="househelpkin_last_name" class=" col-form-label">househelpkin_Last Name </label>
                                            <input v-model="househelp_kinform.househelpkin_last_name" type="househelpkin_last_name" name="househelpkin_last_name" placeholder="househelpkin_Last Name"
                                                class="form-control" :class="{ 'is-invalid': househelp_kinform.errors.has('househelpkin_last_name') }" >
                                            <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelpkin_last_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="househelpkin_id_no" class="col-form-label">Househelpkin ID no.</label>
                                            <input v-model="househelp_kinform.househelpkin_id_no" type="text" name="househelpkin_id_no" placeholder="Househelpkin ID NO"
                                                class="form-control" :class="{ 'is-invalid': househelp_kinform.errors.has('househelpkin_id_no') }" >
                                            <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelpkin_id_no"></has-error>
                                        </div>

                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-3">
                                            <label for="househelpkin_relationship_id">Select Relationship </label>
                                            <select class="form-control" v-model="househelp_kinform.househelpkin_relationship_id"
                                                    :class="{ 'is-invalid': househelp_kinform.errors.has('househelpkin_relationship_id') }">
                                                    <option disabled value="">Select relationship</option>
                                                    <option v-for="relationship in Relationships" :value="relationship.id" :key="relationship.id">{{relationship.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelp_gender_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="househelpkin_gender_id">Select Gender</label>
                                            <select class="form-control" v-model="househelp_kinform.househelpkin_gender_id"
                                                    :class="{ 'is-invalid': househelp_kinform.errors.has('househelpkin_gender_id') }">
                                                    <option disabled value="">Select gender</option>
                                                    <option v-for="gender in Genders" :value="gender.id" :key="gender.id">{{gender.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelp_gender_id"></has-error>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="househelpkin_address" class=" col-form-label">Househelpkin Address</label>
                                            <input v-model="househelp_kinform.househelpkin_address" type="text" name="Address" placeholder="Househelpkin Address"
                                                class="form-control" :class="{ 'is-invalid': househelp_kinform.errors.has('househelpkin_address') }" >
                                            <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelpkin_address"></has-error>
                                        </div>
                                         <div class="form-group col-md-3">
                                            <label for="househelpkin_phone" class="col-form-label"> Househelpkin Phone</label>
                                                <div>
                                                    <vue-tel-input v-model="househelp_kinform.househelpkin_phone" name="househelpkin_phone" @onInput="HousehelpkinInputPhone1"
                                                    class="form-control" :class="{ 'is-invalid': househelp_kinform.errors.has('househelpkin_phone') }">
                                                    </vue-tel-input>
                                                    <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelpkin_phone"></has-error>
                                                </div>
                                                <div v-if="househelp_kinform.househelpkin_phone" style="color: #e83e8c">
                                                    <span>Is valid: <strong>{{phone2.isValid}}</strong>,&nbsp;</span>
                                                    <span>Country: <strong>{{phone2.country}}</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-3">
                                            <label for="househelpkin_country_id">Select Country</label>
                                            <select class="form-control" @change="HousehelpkincountryCounties(househelp_kinform.househelpkin_country_id)"
                                            v-model="househelp_kinform.househelpkin_country_id" :class="{ 'is-invalid': househelp_kinform.errors.has('househelpkin_country_id') }">
                                                    <option disabled value="">Select Country</option>
                                                    <option v-for="country in Countries" :value="country.id" :key="country.id">{{country.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelpkin_country_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="househelpkin_county_id" class=" col-form-label">County</label>
                                            <select class="form-control" @change="HousehelpkincountyConstituencies(househelp_kinform.househelpkin_county_id)"
                                            v-model="househelp_kinform.househelpkin_county_id" :class="{ 'is-invalid': househelp_kinform.errors.has('househelpkin_county_id') }">
                                                    <option disabled value="">Select County</option>
                                                    <option v-for="county in Counties" :value="county.id" :key="county.id">{{county.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelpkin_county_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="househelpkin_constituency_id" class=" col-form-label">Constituency</label>
                                            <select class="form-control" @change="HousehelpkinconstituencyWards(househelp_kinform.househelpkin_constituency_id)"
                                            v-model="househelp_kinform.househelpkin_constituency_id" :class="{ 'is-invalid': househelp_kinform.errors.has('househelpkin_constituency_id') }">
                                                    <option disabled value="">Select County</option>
                                                    <option v-for="constituency in Constituencies" :value="constituency.id" :key="constituency.id">{{constituency.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelpkin_constituency_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="househelpkin_ward_id" class="col-form-label"> Ward </label>
                                            <select class="form-control"
                                            v-model="househelp_kinform.househelpkin_ward_id" :class="{ 'is-invalid': househelp_kinform.errors.has('househelpkin_ward_id') }">
                                                    <option disabled value="">Select Ward</option>
                                                    <option v-for="ward in Wards" :value="ward.id" :key="ward.id">{{ward.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelpkin_ward_id"></has-error>
                                        </div>

                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <label for="househelpkin_photo" class=" col-form-label">Househelpkin PassPort Image</label><br>
                                                <input @change="househelpkinChangePassPhoto($event)" type="file" name="househelpkin_photo"
                                                    :class="{ 'is-invalid': househelp_kinform.errors.has('househelpkin_photo') }">
                                                    <img  :src="househelp_kinform.househelpkin_photo" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelpkin_photo"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="househelpkin_id_photo_front" class=" col-form-label">Househelpkin FrontSide ID Photo</label><br>
                                                <input @change="househelpkinChangeIDFrontPhoto($event)" type="file" name="househelpkin_id_photo_front"
                                                    :class="{ 'is-invalid': househelp_kinform.errors.has('househelpkin_id_photo_front') }">
                                                    <img  :src="househelp_kinform.househelpkin_id_photo_front" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelpkin_id_photo_front"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="househelpkin_id_photo_back" class=" col-form-label">Househelpkin BackSide ID Photo</label><br>
                                                <input @change="househelpkinChangeIDBackPhoto($event)" type="file" name="househelpkin_id_photo_back"
                                                    :class="{ 'is-invalid': househelp_kinform.errors.has('househelpkin_id_photo_back') }">
                                                    <img  :src="househelp_kinform.househelpkin_id_photo_back" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="househelp_kinform" field="househelpkin_id_photo_back"></has-error>
                                        </div>
                                    </div>
                            </tab-content>
                            <tab-content>
                                Create Houshelp and Next of Kin
                            </tab-content>
                        </form-wizard>
                    </div>
                </div>
            </div>
    </div>

    <!-- houselp edit mode only househelp -->







  </div>
</template>
<script>

</script>

<script>

    // $('#mpesabtn').hide();
            // ('#stripebtn').hide();
            // ('#paypalbtn').hide();
            // (':radio[id=paypal]').change(function () {
            //     ('#paypalbtn').show();
            //     ('#mpesabtn').hide();
            //     ('#stripebtn').hide();
            // });
            // (':radio[id=mpesa]').change(function () {
            //     ('#mpesabtn').show();
            //     ('#paypalbtn').hide();
            //     ('#stripebtn').hide();
            // });
            // (':radio[id=stripe]').change(function () {
            //     ('#stripebtn').show();
            //     ('#paypalbtn').hide();
            //     ('#mpesabtn').hide();
            // });

    export default {
        name:"Househelps",
        data(){
            return{
                IDstatus:"HasID",    //id status check
                Healthstatus: "HEALTHY",
                househelp_kinform: new Form({
                        id:'',
                        househelp_first_name:'',
                        househelp_last_name:'',
                        email:'',
                        househelp_password:'',


                        househelp_user_id:'',
                        househelp_bureau_id:'',

                        househelp_photo:'',

                        househelp_about_me:'',
                        househelp_phone:'',
                        househelp_address:'',
                        househelp_country_id:'',
                        househelp_county_id:'',
                        househelp_constituency_id:'',
                        househelp_ward_id:'',
                        //extra
                        househelp_birth_date:'',
                        househelp_gender_id:'',
                        househelp_education_id:'',
                        househelp_experience_id:'',
                        househelp_maritalstatus_id:'',
                        househelp_tribe_id:'',
                        househelp_skill_id:'',
                        househelp_operation_id:'',
                        househelp_duration_id:'',
                        househelp_englishstatus_id:'',
                        househelp_religion_id:'',
                        househelp_kid_id:'',
                        //id status
                        IDstatus:'',
                        HealthStatus:'',

                        househelp_id_status:'',
                        househelp_id_status_reason:'',
                        househelp_id_number:'',
                        househelp_ref_number:'',
                        househelp_id_photo_front:'',
                        househelp_id_photo_back:'',
                        househelp_waiting_card_photo:'',
                        //health status
                        status:'',
                        HIV_status:'',
                        other_chronics:'',
                        chronic_details:'',
                        allergy:'',
                        specify:'',

                        //househelp
                        househelpkin_first_name:'',
                        househelpkin_last_name:'',

                        househelpkin_user_id:'',
                        househelpkin_househelp_id:'',
                        houshelpkin_relationship_id:'',

                        househelpkin_id_no:'',
                        househelpkin_photo:'',
                        househelpkin_id_photo_front:'',
                        househelpkin_id_photo_back:'',
                        househelpkin_phone:'',
                        househelpkin_address:'',
                        househelpkin_gender_id:'',
                        househelpkin_country_id:'',
                        househelpkin_county_id:'',
                        househelpkin_constituency_id:'',
                        househelpkin_ward_id:'',

                }),
                editmodeHousehelp: false,
                househelpform: new Form({
                        id:'',
                        househelp_first_name:'',
                        househelp_last_name:'',
                        househelp_email:'',
                        househelp_password:'',

                        househelp_user_id:'',
                        househelp_bureau_id:'',

                        househelp_photo:'',
                        househelp_id_photo_front:'',
                        househelp_id_photo_back:'',
                        househelp_about_me:'',
                        househelp_phone:'',
                        househelp_address:'',
                        househelp_country_id:'',
                        househelp_county_id:'',
                        househelp_constituency_id:'',
                        househelp_ward_id:'',
                        //extra
                        househelp_birth_date:'',
                        househelp_gender_id:'',
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
                        id_status:'',
                        id_number:'',
                        ref_number:'',
                        id_photo_front:'',
                        id_photo_back:'',
                        //health status
                        health_status:'',
                        specify:'',
                }),
                editmodeHousehelpKin: false,
                househelpkinform: new Form({
                        id:'',
                        //househelp
                        househelpkin_first_name:'',
                        househelpkin_last_name:'',
                        househelpkin_email:'',
                        househelpkin_password:'',
                        househelpkin_user_type:'',

                        househelpkin_user_id:'',
                        househelpkin_househelp_id:'',
                        houshelpkin_relationship_id:'',

                        househelpkin_id_no:'',
                        househelpkin_photo:'',
                        househelpkin_id_photo_front:'',
                        househelpkin_id_photo_back:'',
                        househelpkin_phone:'',
                        househelpkin_address:'',
                        househelpkin_country_id:'',
                        househelpkin_county_id:'',
                        househelpkin_constituency_id:'',
                        househelpkin_ward_id:'',
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
               return this.$store.getters.Bureau
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
            // CLient(){
            //     console.log(this.$store.getters.BureauClient)
            //    return this.$store.getters.BureauClient//View Single Bureau client  by parameter id
            // },
        },
        methods:{
            //Househelp Demographic
            validateHousehelpDemograhic() {
                if(this.IDstatus === 'HasID'){
                    this.househelp_kinform.IDstatus = 'HasID';
                    this.househelp_kinform.househelp_id_status = 'Yes';
                    this.househelp_kinform.househelp_id_status_reason = 'Has ID Card';
                }
                if(this.IDstatus === 'HASIDbutlost'){
                    this.househelp_kinform.IDstatus = 'HASIDbutlost';
                    this.househelp_kinform.househelp_id_status = 'Yes';
                    this.househelp_kinform.househelp_id_status_reason = 'Has ID Card but lost, however applied for replacement';
                }
                if(this.IDstatus === 'NOIDbutapplied'){
                    this.househelp_kinform.IDstatus = 'NOIDbutapplied';
                    this.househelp_kinform.househelp_id_status = 'No';
                    this.househelp_kinform.househelp_id_status_reason = 'Dont Have ID Card but applied for new Card';
                }
                if(this.IDstatus === 'NOID'){
                    this.househelp_kinform.IDstatus = 'NOID';
                    this.househelp_kinform.househelp_id_status = 'No';
                    this.househelp_kinform.househelp_id_status_reason = 'Dont Have ID Card and Has not applied for new Card';
                }
                this.$Progress.start()
                return this.househelp_kinform.post('/househelp/verify/demographics')
                    .then((response)=>{
                        return true;
                        toast({
                            type: 'success',
                            title: 'Househelp Demographic Info Verifed successfully'
                        })
                        this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        toast({
                            type: 'error',
                            title: 'The Househelp Demographic Info failed Verification.'
                        })
                    })
            },
            //Househelp Attributes Info info verification
            validateHousehelpAttributes() {
                if(this.Healthstatus === 'HEALTHY'){
                    this.househelp_kinform.HealthStatus = 'HEALTHY';
                    this.househelp_kinform.status = 'Healthy';
                }
                if(this.Healthstatus === 'HASMINOR'){
                    this.househelp_kinform.HealthStatus = 'HASMINOR';
                    this.househelp_kinform.status = 'HASMINOR';
                    this.househelp_kinform.allergy = 'Has Minor Health Issues';
                }
                if(this.Healthstatus === 'HASCHRONIC'){
                    this.househelp_kinform.HealthStatus = 'HASCHRONIC';
                    this.househelp_kinform.status = 'HASCHRONIC';
                    this.househelp_kinform.other_chronics = 'Has Other Chronic Issues';
                }
                this.$Progress.start()
                return this.househelp_kinform.post('/househelp/verify/attributes')
                    .then((response)=>{
                        return true;
                        toast({
                            type: 'success',
                            title: 'Househelp Attributes Info Verifed successfully'
                        })
                        this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        toast({
                            type: 'error',
                            title: 'The Househelp Attributes Info failed Verification.'
                        })
                    })
            },

            //Househelpkin verification
            validateHousehelpkin() {
                this.$Progress.start()
                return this.househelp_kinform.post('/househelp/verify/kin')
                    .then((response)=>{
                        return true;
                        toast({
                            type: 'success',
                            title: 'Househelp Kin update Info Verifed successfully'
                        })
                        this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        toast({
                            type: 'error',
                            title: 'The Househelp Kin Info failed Verification.'
                        })
                    })
            },


            //Househelp and kin
            HousehelpInputPhone1({ number, isValid, country }) {
            console.log(number, isValid, country);
            this.househelp_kinform.phone = number;
            this.phone1.isValid = isValid;
            this.phone1.country = country && country.name;
            },
             //Househelpkin
            HousehelpkinInputPhone1({ number, isValid, country }) {
            console.log(number, isValid, country);
            this.househelp_kinform.phone = number;
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

            //househelp
            HousehelpcountryCounties(country_id){
                console.log(country_id);
                this.$store.dispatch('countrycounties', country_id);
            },
            HousehelpcountyConstituencies(county_id){
                console.log(county_id);
                this.$store.dispatch('countyconstituencies', county_id);
            },
            HousehelpconstituencyWards(constituency_id){
                console.log(constituency_id);
                this.$store.dispatch('constituencywards', constituency_id); //send to store to the action with id
            },

            //kin
            HousehelpkincountryCounties(country_id){
                console.log(country_id);
                this.$store.dispatch('countrycounties', country_id);
            },
            HousehelpkincountyConstituencies(county_id){
                console.log(county_id);
                this.$store.dispatch('countyconstituencies', county_id);
            },
            HousehelpkinconstituencyWards(constituency_id){
                console.log(constituency_id);
                this.$store.dispatch('constituencywards', constituency_id); //send to store to the action with id
            },

             //househelp
            newHousehelpKinModal(){
                 this.newBureauDirector = true;
                //  this.editmodeBureau= false;
                 this.househelp_kinform.reset()
                     $('#Househelp_KinModal').modal('show')
            },
                        //bureau househelp passposrt image
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
                            this.househelp_kinform.househelp_photo =event.target.result
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
                            this.househelp_kinform.househelp_id_photo_front =event.target.result
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
                            this.househelp_kinform.househelp_waiting_card_photo =event.target.result
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
                            this.househelp_kinform.househelp_id_photo_back =event.target.result
                            };
                        reader.readAsDataURL(file);
                }
            },

            //househelpkin
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
                            this.househelp_kinform.househelpkin_photo =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
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
                            this.househelp_kinform.househelpkin_id_photo_front =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
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
                            this.househelp_kinform.househelpkin_id_photo_back =event.target.result
                            };
                        reader.readAsDataURL(file);
                }
            },
            addHousehelp(Bureau_id) {
                console.log(Bureau_id)
                this.$Progress.start();
                this.househelp_kinform.patch('/househelp/'+Bureau_id)
                    .then((response)=>{
                        //  console.log(response.data)
                         toast({
                            type: 'success',
                            title: 'Househelp_kin Created successfully'
                            })
                            this.$store.dispatch('bureauByUserID');
                            $('#Househelp_KinModal').modal('hide')
                             this.$refs.wizard.reset()
                             this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        //errors
                            $('#Househelp_KinModal').modal('show');
                            toast({
                                type: 'error',
                                title: 'There was something wrong.'
                                })
                    })
            },
            deleteHousehelp(id){
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
                    //  console.log('delete househelp', id)
                        this.$Progress.start();
                        this.househelpform.get('/househelp/delete/'+id)
                            .then(()=>{
                            toast({
                            type: 'success',
                            title: 'Househelp Deleted successfully'
                            })
                            this.$store.dispatch("bureauByUserID")
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

