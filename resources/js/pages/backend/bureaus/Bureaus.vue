<template>
  <div class="container-fluid mt-5">
      <!-- Main content -->
    <section class="content">
      <div class="row justify-content-around">
        <div class="col-md">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Bureaus And Directors Table</h3>
              <div class="card-tools">
                    <button class="btn btn-success"  @click.prevent="newBureauModal()">Add New Bureau and Director
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
                    <th>Bureau Details</th>
                    <th style="padding-left: 14px">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(bureau, index) in Bureaus" :key="bureau.id">
                    <td >{{index+1}}</td>
                    <td >
                        <div class="row">
                            <div style="padding: 3px;max-width:250px">
                                 <img class="card-img-top" :src="bureauLoadLogo(bureau.logo)" style="width:170px" alt="Card image cap">
                            </div>
                            <div style="font-weight:bold;font-size:0.7em;min-width:210px;max-width:400px;margin-top:4px;padding-top:4px;padding-left: 10px;
                                        font-style: italic ">
                                <div>{{bureau.name}},</div>
                                <div> Phone: ,<span style="color:#9a009a;">{{bureau.phone}}</span>,
                                    Landline: <span style="color:#9a009a;">{{bureau.landline}},</span>
                                </div>
                                <div>
                                     Mail: <span style="color:#9a009a;">{{bureau.bureau_email}},</span>
                                </div>
                                    <div>P. O. Box , <span style="color:#9a009a;">{{bureau.address}}</span>,
                                    </div>
                                <div>
                                    <span style="color:#9a009a;">{{bureau.ward.name}}</span> ward,
                                    <span style="color:#9a009a;">{{bureau.constituency.name}}</span> constituency,
                                </div>
                                <div>
                                    <span style="color:#9a009a;">{{bureau.county.name}}</span> county,
                                    <span style="color:#9a009a;">{{bureau.country.name}}, </span>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td style="padding: 3px;" >
                        <div class="clearfix" style="font-weight:bold;font-size:0.7em;">
                            <span class="float-left" style="margin-bottom:-0.5em" >
                                <div style="margin-bottom:0.25em"> Updated at:
                                    <span style="color:#9a009a;">{{bureau.created_at | dateformat}} </span>
                                </div>
                            </span>
                            <span class="float-right">
                                <router-link  :to="`/bureau/${bureau.id}`">
                                        <i class="fa fa-eye "></i>
                                </router-link>
                                <a href=""  @click.prevent="deleteBureau(bureau.id)">
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
      <!-- /.row -->
    </section>
        <!-- Role Modal -->
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
                            <h5 class="modal-title" v-show="editmodeBureau" id="BureauModalLabel">Update Bureau & Director</h5>
                            <h5 class="modal-title" v-show="!editmodeBureau" id="BureauModalLabel">Add New Bureau & Director</h5>
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
                                                <vue-tel-input v-model="bureauform.phone" name="phone" @onInput="InputPhone"
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
                                            <vue-tel-input v-model="bureauform.landline" name="landline" @onInput="InputLandline"
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

                            <tab-content title="Bureau Director Info" :before-change="newBureauDirector ? validateDirector : validateDirectorUpdate ">
                                <div v-show="newBureauDirector">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="director_first_name" class="col-form-label"> Director First Name</label>
                                            <input v-model="bureauform.director_first_name" type="text" name="first_name" placeholder="Director First Name"
                                                class="form-control" :class="{ 'is-invalid': bureauform.errors.has('director_first_name') }" >
                                            <has-error style="color: #e83e8c" :form="bureauform" field="director_first_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="director_last_name" class=" col-form-label">director_Last Name </label>
                                            <input v-model="bureauform.director_last_name" type="director_last_name" name="director_last_name" placeholder="director_Last Name"
                                                class="form-control" :class="{ 'is-invalid': bureauform.errors.has('director_last_name') }" >
                                            <has-error style="color: #e83e8c" :form="bureauform" field="director_last_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="email" class=" col-form-label">Email </label>
                                            <input v-model="bureauform.email" type="email" name="email" placeholder="Email Address"
                                                class="form-control" :class="{ 'is-invalid': bureauform.errors.has('email') }" >
                                            <has-error style="color: #e83e8c" :form="bureauform" field="email"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <input v-model="bureauform.director_password" type="password" id="director_password" placeholder="Director Password"
                                                class="form-control" :class="{ 'is-invalid': bureauform.errors.has('director_password') }">
                                            <has-error :form="bureauform" field="director_password"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="director_phone" class="col-form-label"> Director Phone</label>
                                                <div>
                                                    <vue-tel-input v-model="bureauform.director_phone" name="director_phone" @onInput="DirectorInputPhone"
                                                    class="form-control" :class="{ 'is-invalid': bureauform.errors.has('director_phone') }">
                                                    </vue-tel-input>
                                                    <has-error style="color: #e83e8c" :form="bureauform" field="director_phone"></has-error>
                                                </div>
                                                <div v-if="bureauform.director_phone" style="color: #e83e8c">
                                                    <span>Is valid: <strong>{{director_phone1.isValid}}</strong>,&nbsp;</span>
                                                    <span>Country: <strong>{{director_phone1.country}}</strong></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="director_landline" class=" col-form-label">Director Landline</label>
                                                <vue-tel-input v-model="bureauform.director_landline" name="director_landline" @onInput="DirectorInputLandline"
                                                    class="form-control" :class="{ 'is-invalid': bureauform.errors.has('director_landline') }">
                                                </vue-tel-input>
                                                <has-error style="color: #e83e8c" :form="bureauform" field="director_landline"></has-error>

                                                <div v-if="bureauform.director_landline" style="color: #e83e8c">
                                                    <span>Is valid: <strong>{{director_landline1.isValid}}</strong>,&nbsp;</span>
                                                    <span>Country: <strong>{{director_landline1.country}}</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <label for="director_id_no" class="col-form-label">Director ID no.</label>
                                            <input v-model="bureauform.director_id_no" type="text" name="director_id_no" placeholder="Director ID NO"
                                                class="form-control" :class="{ 'is-invalid': bureauform.errors.has('director_id_no') }" >
                                            <has-error style="color: #e83e8c" :form="bureauform" field="director_id_no"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="director_address" class=" col-form-label">Director Address</label>
                                            <input v-model="bureauform.director_address" type="text" name="Address" placeholder="Director Address"
                                                class="form-control" :class="{ 'is-invalid': bureauform.errors.has('director_address') }" >
                                            <has-error style="color: #e83e8c" :form="bureauform" field="director_address"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-3">
                                            <label for="director_country_id">Select Country</label>
                                            <select class="form-control" @change="DirectorcountryCounties(bureauform.director_country_id)"
                                            v-model="bureauform.director_country_id" :class="{ 'is-invalid': bureauform.errors.has('director_country_id') }">
                                                    <option disabled value="">Select Country</option>
                                                    <option v-for="country in Countries" :value="country.id" :key="country.id">{{country.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="bureauform" field="director_country_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="director_county_id" class=" col-form-label">County</label>
                                            <select class="form-control" @change="DirectorcountyConstituencies(bureauform.director_county_id)"
                                            v-model="bureauform.director_county_id" :class="{ 'is-invalid': bureauform.errors.has('director_county_id') }">
                                                    <option disabled value="">Select County</option>
                                                    <option v-for="county in Counties" :value="county.id" :key="county.id">{{county.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="bureauform" field="director_county_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="director_constituency_id" class=" col-form-label">Constituency</label>
                                            <select class="form-control" @change="DirectorconstituencyWards(bureauform.director_constituency_id)"
                                            v-model="bureauform.director_constituency_id" :class="{ 'is-invalid': bureauform.errors.has('director_constituency_id') }">
                                                    <option disabled value="">Select County</option>
                                                    <option v-for="constituency in Constituencies" :value="constituency.id" :key="constituency.id">{{constituency.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="bureauform" field="director_constituency_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="director_ward_id" class="col-form-label"> Ward </label>
                                            <select class="form-control"
                                            v-model="bureauform.director_ward_id" :class="{ 'is-invalid': bureauform.errors.has('director_ward_id') }">
                                                    <option disabled value="">Select Ward</option>
                                                    <option v-for="ward in Wards" :value="ward.id" :key="ward.id">{{ward.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="bureauform" field="director_ward_id"></has-error>
                                        </div>


                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <label for="director_passport_image" class=" col-form-label">Director PassPort Image</label><br>
                                                <input @change="bureauChangeDirectorPImage($event)" type="file" name="director_passport_image"
                                                    :class="{ 'is-invalid': bureauform.errors.has('director_passport_image') }">
                                                    <img v-show="editmodeBureau" :src="updateBureauDirectorPImage(bureauform.director_passport_image)" alt="" width="100%" >
                                                    <img  v-show="!editmodeBureau" :src="bureauform.director_passport_image" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="bureauform" field="director_passport_image"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="frontside_director_id_photo" class=" col-form-label">Director FrontSide ID Photo</label><br>
                                                <input @change="bureauChangeDirectorFIDPhoto($event)" type="file" name="frontside_director_id_photo"
                                                    :class="{ 'is-invalid': bureauform.errors.has('frontside_director_id_photo') }">
                                                    <img v-show="editmodeBureau" :src="updateBureauDirectorFIDPhoto(bureauform.frontside_director_id_photo)" alt="" width="100%" >
                                                    <img  v-show="!editmodeBureau" :src="bureauform.frontside_director_id_photo" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="bureauform" field="frontside_director_id_photo"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="backside_director_i_photod" class=" col-form-label">Director BackSide ID Photo</label><br>
                                                <input @change="bureauChangeDirectorBIDPhoto($event)" type="file" name="backside_director_id_photo"
                                                    :class="{ 'is-invalid': bureauform.errors.has('backside_director_id') }">
                                                    <img v-show="editmodeBureau" :src="updateBureauDirectorBIDPhoto(bureauform.backside_director_id_photo)" alt="" width="100%" >
                                                    <img  v-show="!editmodeBureau" :src="bureauform.backside_director_id_photo" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="bureauform" field="backside_director_id_photo"></has-error>
                                        </div>
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
                            <div v-show="newBureauDirector">
                                Director Info
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="director_first_name" class="col-form-label"> Director First Name</label>
                                        <input v-model="bureauform.director_first_name" class="form-control" :readonly="true">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="director_last_name" class=" col-form-label">director_Last Name </label>
                                        <input v-model="bureauform.director_last_name" class="form-control" :readonly="true">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="email" class=" col-form-label">Email </label>
                                        <input v-model="bureauform.email" class="form-control" :readonly="true">
                                    </div>
                                </div>
                                 <div class=" row">
                                     <div class="form-group col-md-4">
                                        <input v-model="bureauform.director_password" type="password" class="form-control" :readonly="true">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="director_phone" class="col-form-label"> Director Phone</label>
                                            <div>
                                                <vue-tel-input v-model="bureauform.director_phone" class="form-control" :readonly="true">
                                                </vue-tel-input>
                                            </div>
                                            <div v-if="bureauform.director_phone" style="color: #e83e8c">
                                                <span>Is valid: <strong>{{director_phone1.isValid}}</strong>,&nbsp;</span>
                                                <span>Country: <strong>{{director_phone1.country}}</strong></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="director_landline" class=" col-form-label">Director Landline</label>
                                            <vue-tel-input v-model="bureauform.director_landline" class="form-control" :readonly="true">
                                            </vue-tel-input>
                                            <div v-if="bureauform.director_landline" style="color: #e83e8c">
                                                <span>Is valid: <strong>{{director_landline1.isValid}}</strong>,&nbsp;</span>
                                                <span>Country: <strong>{{director_landline1.country}}</strong></span>
                                        </div>
                                    </div>
                                </div>
                                <div class=" row">
                                    <div class="form-group col-md-4">
                                        <label for="director_id_no" class="col-form-label">Director ID no.</label>
                                        <input v-model="bureauform.director_id_no" class="form-control" :readonly="true">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="director_address" class=" col-form-label">Director Address</label>
                                        <input v-model="bureauform.director_address" class="form-control" :readonly="true">
                                    </div>
                                </div>
                                <div class=" row">
                                    <div class="form-group col-md-3">
                                        <label for="director_country_id">Select Country</label>
                                        <select class="form-control" v-model="bureauform.director_country_id" >
                                                <option v-for="country in Countries" :value="country.id" :key="country.id">{{country.name}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="director_county_id" class=" col-form-label">County</label>
                                        <select class="form-control" v-model="bureauform.director_county_id" :readonly="true">
                                            <option v-for="county in Counties" :value="county.id" :key="county.id">{{county.name}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="director_constituency_id" class=" col-form-label">Constituency</label>
                                        <select class="form-control" v-model="bureauform.director_constituency_id" :readonly="true">
                                                <option v-for="constituency in Constituencies" :value="constituency.id" :key="constituency.id">{{constituency.name}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="director_ward_id" class="col-form-label"> Ward </label>
                                        <select class="form-control" v-model="bureauform.director_ward_id" :readonly="true">
                                                <option v-for="ward in Wards" :value="ward.id" :key="ward.id">{{ward.name}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class=" row">
                                    <div class="form-group col-md-4">
                                        <label for="director_passport_image" class=" col-form-label">Director PassPort Image</label><br>
                                            <input type="file" :readonly="true">
                                                <img v-show="editmodeBureau" :src="updateBureauDirectorPImage(bureauform.director_passport_image)" alt="" width="100%" >
                                                <img  v-show="!editmodeBureau" :src="bureauform.director_passport_image" alt="" width="100%" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="frontside_director_id_photo" class=" col-form-label">Director FrontSide ID Photo</label><br>
                                            <input  type="file" :readonly="true">
                                                <img v-show="editmodeBureau" :src="updateBureauDirectorFIDPhoto(bureauform.frontside_director_id_photo)" alt="" width="100%" >
                                                <img  v-show="!editmodeBureau" :src="bureauform.frontside_director_id_photo" alt="" width="100%" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="backside_director_i_photo" class=" col-form-label">Director BackSide ID Photo</label><br>
                                            <input type="file" :readonly="true">
                                                <img v-show="editmodeBureau" :src="updateBureauDirectorBIDPhoto(bureauform.backside_director_id_photo)" alt="" width="100%" >
                                                <img  v-show="!editmodeBureau" :src="bureauform.backside_director_id_photo" alt="" width="100%" >
                                    </div>
                                </div>
                             </div>
                            </tab-content>
                        </form-wizard>
                    </div>
                </div>
            </div>
    </div>
    <div class="modal fade " id="DirectorModal" tabindex="-1" role="dialog" aria-labelledby="DirectorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form role="form" @submit.prevent="editmodeDirector ? updateDirector(directorform.id) : addDirector(directorform.bureau_id)" >
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
                                        <div class="form-group col-md-4">
                                            <input v-model="directorform.password" type="password" id="password" placeholder="Password"
                                                class="form-control" :class="{ 'is-invalid': directorform.errors.has('password') }">
                                            <has-error :form="directorform" field="password"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="phone" class="col-form-label"> Director Phone</label>
                                                <div>
                                                    <vue-tel-input v-model="directorform.phone" name="phone" @onInput="InputPhone"
                                                    class="form-control" :class="{ 'is-invalid': directorform.errors.has('phone') }">
                                                    </vue-tel-input>
                                                    <has-error style="color: #e83e8c" :form="directorform" field="phone"></has-error>
                                                </div>
                                                <div v-if="directorform.phone" style="color: #e83e8c">
                                                    <span>Is valid: <strong>{{phone.isValid}}</strong>,&nbsp;</span>
                                                    <span>Country: <strong>{{phone.country}}</strong></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="landline" class=" col-form-label">Landline</label>
                                                <vue-tel-input v-model="directorform.landline" name="landline" @onInput="InputLandline"
                                                    class="form-control" :class="{ 'is-invalid': directorform.errors.has('landline') }">
                                                </vue-tel-input>
                                                <has-error style="color: #e83e8c" :form="directorform" field="landline"></has-error>

                                                <div v-if="directorform.landline" style="color: #e83e8c">
                                                    <span>Is valid: <strong>{{landline.isValid}}</strong>,&nbsp;</span>
                                                    <span>Country: <strong>{{landline.country}}</strong></span>
                                            </div>
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
                                            <input v-model="directorform.address" type="text" name="Address" placeholder="Address"
                                                class="form-control" :class="{ 'is-invalid': directorform.errors.has('address') }" >
                                            <has-error style="color: #e83e8c" :form="directorform" field="address"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-3">
                                            <label for="country_id">Select Country</label>
                                            <select class="form-control" @change="countryCounties(directorform.country_id)"
                                            v-model="directorform.country_id" :class="{ 'is-invalid': directorform.errors.has('country_id') }">
                                                    <option disabled value="">Select Country</option>
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
  </div>
</template>

<script>

    export default {
        name:"List",
        data(){
            return{
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
                        //director
                        director_first_name:'',
                        director_last_name:'',
                        email:'',
                        director_password:'',
                        director_phone:'',
                        director_landline:'',
                        director_id_no:'',
                        director_address:'',
                        director_country_id:'',
                        director_county_id:'',
                        director_constituency_id:'',
                        director_ward_id:'',
                        director_passport_image:'',
                        frontside_director_id_photo:'',
                        backside_director_id_photo:'',
                }),
                //bureau
                phone1:{
                        isValid: false,
                        country: undefined,
                },
                landline1:{
                        isValid: false,
                        country: undefined,
                },
                //director
                director_phone1:{
                        isValid: false,
                        country: undefined,
                },
                director_landline1:{
                        isValid: false,
                        country: undefined,
                },
                 newDirector: false,
                editmodeDirector: false,
                directorform: new Form({
                        id:'',
                        first_name:'',
                        last_name:'',
                        email:'',
                        password:'',
                        director_type:'',
                        permissions:[],
                        roles:[],
                        user_id:'',
                        bureau_id:'',
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
                 //director
                phone:{
                        isValid: false,
                        country: undefined,
                },
                landline:{
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
            this.loadBureaus();
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
            Bureaus(){
               return this.$store.getters.Bureaus
            },
        },
        methods:{
            //Bureau verification
            validateBureau() {
                this.$Progress.start()
                return this.bureauform.post('/bureau/verify/info')
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
            //Director info verification
            validateDirector() {
                console.log('dddddd')
                this.$Progress.start()
                // this.bureauOutput = this.bureauform;  //append form data
                return this.bureauform.post('/bureau/verify/director')
                    .then((response)=>{
                        return true;
                        toast({
                            type: 'success',
                            title: 'Director Info Verifed successfully'
                        })
                        this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        toast({
                            type: 'error',
                            title: 'The Director Info failed Verification.'
                        })
                    })
            },
            //Bureau verification
            validateBureauUpdate() {
                let id = this.bureauform.id;
                console.log('first',id);
                this.$Progress.start()
                return this.bureauform.patch('/bureau/updateverify/info/'+id)
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
            //Director info verification
            validateDirectorUpdate() {
                 let id = this.bureauform.id;
                console.log('mix me down',id);
                this.$Progress.start()
                // console.log('mis me down')
                // this.bureauOutput = this.bureauform;  //append form data
                return this.bureauform.patch('/bureau/updateverify/director/'+id)
                    .then((response)=>{
                        return true;
                        toast({
                            type: 'success',
                            title: 'Director Update Info Verifed successfully'
                        })
                        this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        toast({
                            type: 'error',
                            title: 'The Director update Info failed Verification.'
                        })
                    })
            },
            //Bureau
            InputPhone({ number, isValid, country }) {
            console.log(number, isValid, country);
            this.bureauform.phone = number;
            this.phone1.isValid = isValid;
            this.phone1.country = country && country.name;
            },
            InputLandline({ number, isValid, country }) {
            console.log(number, isValid, country);
            this.bureauform.landline = number;
            this.landline1.isValid = isValid;
            this.landline1.country = country && country.name;
            },
            //Director
            DirectorInputPhone({ number, isValid, country }) {
            console.log(number, isValid, country);
            this.bureauform.director_phone = number;
            this.director_phone1.isValid = isValid;
            this.director_phone1.country = country && country.name;
            },
            DirectorInputLandline({ number, isValid, country }) {
            console.log(number, isValid, country);
            this.bureauform.director_landline = number;
            this.director_landline1.isValid = isValid;
            this.director_landline1.country = country && country.name;
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
            loadBureaus(){
                return this.$store.dispatch( "bureaus")//get all from bureau. bureau linked to user
            },
            loadBureaudirectors(){
                return this.$store.dispatch( "bureausdirectors")//get all from bureau. bureau linked to user
            },

            //Bureau
            newBureauModal(){
                 this.newBureauDirector = true;
                //  this.editmodeBureau= false;
                 this.bureauform.reset()
                     $('#BureauModal').modal('show')
            },
            editBureauModal(id){

                 this.editmodeBureau = true;
                 this.bureauform.reset()
                   console.log('edit organisaton', id)
                    this.$Progress.start();
                      axios.get('/bureau/edit/'+id)
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
            //bureau logo
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
                    return "assets/bureau/img/logo/"+logo_id;
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
                                return "assets/bureau/img/logo/"+bureauformlogo;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },
            //DIRECTOR ALONG WITH BUREAU DURING CREATION
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
                    return "assets/bureau/img/logo/"+logo_id;
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
                                return "assets/bureau/img/logo/"+bureauformlogo;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },
            //bureau director passposrt image
            bureauChangeDirectorPImage(event){
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
                            this.bureauform.director_passport_image =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateBureauDirectorPImage(bureauformdirector_passport_image){
                console.log(bureauformdirector_passport_image)
                let img = this.bureauform.director_passport_image;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                      }else{
                        if(img.length>100){
                            return this.bureauform.director_passport_image;
                        }else{
                            if(bureauformdirector_passport_image){
                                return "assets/bureau/img/directors/passports/"+bureauform.director_passport_image;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },
            //director Front side ID image
            bureauChangeDirectorFIDPhoto(event){
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
                            this.bureauform.frontside_director_id_photo =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateBureauDirectorFIDPhoto(bureauformfrontside_director_id_photo){
                console.log(bureauformfrontside_director_id_photo)
                let img = this.bureauform.frontside_director_id_photo;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.bureauform.frontside_director_id_photo;
                        }else{
                            if(bureauformfrontside_director_id_photo){
                                return "assets/bureau/img/directors/IDs/"+bureauformfrontside_director_id_photo;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },
            //director Backside ID image
            bureauChangeDirectorBIDPhoto(event){
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
                            this.bureauform.backside_director_id_photo =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateBureauDirectorBIDPhoto(bureauformbackside_director_id_photo){
                console.log(bureauformbackside_director_id_photo)
                let img = this.bureauform.backside_director_id_photo;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";

                      }else{
                          if(img.length>100){
                            return this.bureauform.backside_director_id_photo;
                        }else{
                            if(bureauformbackside_director_id_photo){
                                return "assets/bureau/img/directors/IDs/"+bureauformbackside_director_id_photo;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }
            },

            //SINGLE DIRECTOR
            newDirectorModal(bureau_id){
                console.log(bureau_id)
                 this.editmodeDirector= false;
                axios.get('/bureaudirector/view/'+bureau_id)
                .then((response)=>{
                           $('#DirectorModal').modal('show')
                           toast({
                            type: 'success',
                            title: 'Fetched the Bureau data successfully'
                            })
                            this.directorform.bureau_id = response.data.director.pivot.bureau_id
                               this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                            //errors
                            $('#DirectorModal').modal('show');
                            toast({
                            type: 'error',
                            title: 'There was something Wrong'
                            })
                        })

                //  this.directorform.user_id = response.data.director.bureaudirectors[0].pivot.user_id
                //  console.log(this.directorform.fill(bureau_id))
                 this.directorform.reset()
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
            updateDirectorPassPhoto(directorform_organisationdirector_photo){
                // console.log(directorform_organisationdirector_photo)
                let img = this.directorform.photo;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                        //  console.log('its reall null')
                      }else{
                          if(img.length>100){
                            return this.directorform.photo;
                        }else{
                            if(directorform_organisationdirector_photo){
                                return "assets/bureau/img/directors/passports/"+directorform_organisationdirector_photo;
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
                // console.log(directorform.id_photo_front)
                let img = this.directorform.id_photo_front;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                        //  console.log('its reall null')
                      }else{
                          if(img.length>100){
                            return this.directorform.id_photo_front;
                        }else{
                            if(directorform_id_photo_front){
                                return "assets/bureau/img/directors/passports/"+directorform_id_photo_front;
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
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            updateDirectorIDBackPhoto(directorform_id_photo_back){
                // console.log(directorform.id_photo_back)
                let img = this.directorform.id_photo_back;
                      if(img ==null){
                          return "/assets/bureau/img/website/empty.png";
                        //  console.log('its reall null')
                      }else{
                          if(img.length>100){
                            return this.directorform.id_photo_back;
                        }else{
                            if(directorform_id_photo_back){
                                return "assets/bureau/img/directors/IDs/front/"+directorform_id_photo_back;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },

            addBureau(){
                console.log('add Bureau new')
                this.$Progress.start();
                this.bureauform.post('/bureau')
                    .then((response)=>{
                         toast({
                            type: 'success',
                            title: 'Bureau Created successfully'
                            })
                            this.$store.dispatch("bureaus")
                            $('#BureauModal').modal('hide')
                            this.bureauform.reset()
                              this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        //errors
                            $('#BureauModal').modal('show');
                            toast({
                                type: 'error',
                                title: 'There was something wrong.'
                                })
                    })
            },
            updateBureau(id){
                  console.log('update organisaton')
                  this.$Progress.start();
                     this.bureauform.patch('/bureau/update/'+id)
                        .then(()=>{
                            this.$store.dispatch("bureaus")
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
            deleteBureau(id){
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
                    //  console.log('delete user', id)
                        this.$Progress.start();
                        this.bureauform.get('/bureau/delete/'+id)
                            .then(()=>{
                            toast({
                            type: 'success',
                            title: 'Bureau Deleted successfully'
                            })
                            this.$store.dispatch( "bureaus")
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
            editDirectorModal(id){
                 this.editmodeDirector = true;
                 this.directorform.reset()
                    this.$Progress.start();
                      axios.get('/bureaudirector/edit/'+id)
                        .then((response)=>{
                           $('#DirectorModal').modal('show')
                           toast({
                            type: 'success',
                            title: 'Fetched the Director data successfully'
                            })
                            this.directorform.fill(response.data.director)
                            this.directorform.user_id = response.data.director.bureaudirectors[0].pivot.user_id
                            this.directorform.bureau_id = response.data.director.bureaudirectors[0].pivot.bureau_id
                            this.directorform.position_id = response.data.director.bureaudirectors[0].pivot.position_id
                            this.directorform.photo = response.data.director.bureaudirectors[0].pivot.photo
                            this.directorform.id_no = response.data.director.bureaudirectors[0].pivot.id_no
                            this.directorform.id_photo_front = response.data.director.bureaudirectors[0].pivot.id_photo_front
                            this.directorform.id_photo_back = response.data.director.bureaudirectors[0].pivot.id_photo_back
                            this.directorform.phone = response.data.director.bureaudirectors[0].pivot.phone
                            this.directorform.landline = response.data.director.bureaudirectors[0].pivot.landline
                            this.directorform.address = response.data.director.bureaudirectors[0].pivot.address

                           //get country id
                            this.directorform.country_id = response.data.director.countries[0].id
                            //get county id using the country id
                            this.directorform.county_id = response.data.director.counties[0].id
                            this.$store.dispatch('countrycounties', response.data.director.countries[0].id);
                            //get contituency using county id
                            this.directorform.constituency_id = response.data.director.constituencies[0].id
                            this.$store.dispatch('countyconstituencies', response.data.director.counties[0].id);
                            //get ward usng constituency id
                            this.directorform.ward_id = response.data.director.wards[0].id
                            this.$store.dispatch('constituencywards', response.data.director.constituencies[0].id);
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                            //errors
                            $('#DirectorModal').modal('show');
                            toast({
                            type: 'error',
                            title: 'There was something Wrong'
                            })
                        })
             },
            addDirector(bureau_id) {
                // let bureau_id = this.bureauform.id;
                 console.log(bureau_id)
                this.$Progress.start();
                this.directorform.patch('/bureaudirector/'+bureau_id)
                    .then((response)=>{
                        //  console.log(response.data)
                         toast({
                            type: 'success',
                            title: 'Director Created successfully'
                            })
                            this.$store.dispatch( "bureaudirectors")
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
                  console.log('update director')
                  this.$Progress.start();
                     this.directorform.patch('/bureaudirector/update/'+id)
                        .then(()=>{
                            this.$store.dispatch( "directors")
                         $('#DirectorModal').modal('hide')
                         toast({
                            type: 'success',
                            title: 'Director Created successfully'
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
                        this.directorform.get('/bureaudirector/delete/'+id)
                            .then(()=>{
                            toast({
                            type: 'success',
                            title: 'Director Deleted successfully'
                            })
                            this.$store.dispatch( "directors")
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

