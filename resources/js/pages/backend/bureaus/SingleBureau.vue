<template>
  <div class="container-fluid mt-5">
      <!-- Main content -->
        <div class="col-md-12">
                <div class="card card-widget widget-user" >
                   <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header text-white" style="background: url('assets/bureau/img/background/background-1.jpg')
                    center center;width:100%;height:300px">
                    <div class="clearfix">
                                <span class="float-left">
                                    <h3 class="widget-user-username">{{Bureau.name}}</h3>
                                    <h5 class="widget-user-desc bg-green" style="margin-bottom:0">Phone: {{Bureau.phone}}, <span>{{Bureau.landline}}</span> </h5>
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
                        <img :src="bureauLoadLogo(Bureau.logo)"  class="border-0" alt="" style="width:160px;">
                        <h3 class="card-title text-center text-white">{{Bureau.name}}</h3>

                    </div>
                </div>
                <!-- /.widget-user -->

                <div class="container-fluid">
                    <div class="row">
                        <div class="card col-md">
                            <div class="card-header">
                               <h3 class="card-title">Bureau Directors Table</h3>
                                <div class="card-tools">
                                        <button class="btn btn-success"  @click.prevent="newDirectorModal(Bureau.id)">Add New Director
                                            <i class="fas fa-plus fw"></i>
                                        </button>
                                </div>
                            </div>

                            <div class="card-body">
                                 <div class="row" v-for="director in Bureau.bureaudirectors" :key="director.id">
                                    <div class="col" style="padding: 3px;">
                                        <img class="card-img-top" :src="directorLoadPassPhoto(director.pivot.photo)" style="width:100%; height:130px" alt="Card image cap">
                                    </div>
                                    <div class="col" style="padding: 3px;">
                                        <img class="card-img-top" :src="directorLoadIDFrontPhoto(director.pivot.id_photo_front)" style="width:100%;height:65px" alt="Card image cap"><br>
                                        <img class="card-img-top" :src="directorLoadIDBackPhoto(director.pivot.id_photo_back)" style="width:100%;height:65px" alt="Card image cap">
                                    </div>
                                    <div style="font-weight:bold;font-size:0.7em;min-width:210px;max-width:400px;margin-top:4px;padding-top:4px;font-style: italic ">
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
                                                <a href=""  @click.prevent="editDirectorModal(director.user_id)">
                                                    <i class="fa fa-edit blue"></i>
                                                </a>
                                                /
                                                <a href=""  @click.prevent="deleteDirector(director.user_id)">
                                                    <i class="fa fa-trash red"></i>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card col-md">
                            <div class="card-header">
                               <h3 class="card-title">Bureau Admins Table</h3>
                                <div class="card-tools">
                                        <button class="btn btn-success"  @click.prevent="newAdminModal(Bureau.id)">Add New Admin
                                            <i class="fas fa-plus fw"></i>
                                        </button>
                                </div>
                            </div>
                            <div class="card-body">
                                 <div class="row" v-for="admin in Bureau.bureauadmins" :key="admin.id">
                                    <div class="col" style="padding: 3px;">
                                        <img class="card-img-top" :src="adminLoadPassPhoto(admin.pivot.photo)" style="width:100%; height:130px" alt="Card image cap">
                                    </div>
                                    <div class="col" style="padding: 3px;">
                                        <img class="card-img-top" :src="adminLoadIDFrontPhoto(admin.pivot.id_photo_front)" style="width:100%;height:65px" alt="Card image cap"><br>
                                        <img class="card-img-top" :src="adminLoadIDBackPhoto(admin.pivot.id_photo_back)" style="width:100%;height:65px" alt="Card image cap">
                                    </div>
                                    <div style="font-weight:bold;font-size:0.7em;min-width:210px;max-width:400px;margin-top:4px;padding-top:4px;font-style: italic ">
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
                                                <a href=""  @click.prevent="editAdminModal(admin.user_id)">
                                                    <i class="fa fa-edit blue"></i>
                                                </a>
                                                /
                                                <a href=""  @click.prevent="deleteAdmin(admin.user_id)">
                                                    <i class="fa fa-trash red"></i>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card col-md-6">
                            <div class="card-header">
                                <h3> Bureau Employees</h3>
                                <div class="card-tools">
                                        <button class="btn btn-success"  @click.prevent="newEmployeeModal(Bureau.id)">Add New Employee
                                            <i class="fas fa-plus fw"></i>
                                        </button>
                                </div>
                            </div>
                            <div class="card-body">
                                 <div class="row" v-for="employee in Bureau.bureauemployees" :key="employee.id">
                                    <div class="col" style="padding: 3px;">
                                        <img class="card-img-top" :src="employeeLoadPassPhoto(employee.pivot.photo)" style="width:100%; height:130px" alt="Card image cap">
                                    </div>
                                    <div class="col" style="padding: 3px;">
                                        <img class="card-img-top" :src="employeeLoadIDFrontPhoto(employee.pivot.id_photo_front)" style="width:100%;height:65px" alt="Card image cap"><br>
                                        <img class="card-img-top" :src="employeeLoadIDBackPhoto(employee.pivot.id_photo_back)" style="width:100%;height:65px" alt="Card image cap">
                                    </div>
                                    <div style="font-weight:bold;font-size:0.7em;min-width:210px;max-width:400px;margin-top:4px;padding-top:4px;font-style: italic ">
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
                                                <a href=""  @click.prevent="editEmployeeModal(employee.user_id)">
                                                    <i class="fa fa-edit blue"></i>
                                                </a>
                                                /
                                                <a href=""  @click.prevent="deleteEmployee(employee.user_id)">
                                                    <i class="fa fa-trash red"></i>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <!-- /.nav-tabs-custom -->
        </div>
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
                                        <div class="form-group col-md-4">
                                            <input v-model="directorform.password" type="password" id="password" placeholder="Password"
                                                class="form-control" :class="{ 'is-invalid': directorform.errors.has('password') }">
                                            <has-error :form="directorform" field="password"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
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
                                        <div class="form-group col-md-4">
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
        <!-- view director -->
        <div class="modal fade " id="ViewDirectorModal" tabindex="-1" role="dialog" aria-labelledby="ViewDirectorModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width: 80% !important; margin-left: 263px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" v-for="director in Director.bureaudirectors" :key="director.id">
                        <div class="card card-widget widget-user" >
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header text-white" style="background: url('assets/bureau/img/background/background-1.jpg')
                                 center center;width:100%;height:300px">
                                <div class="clearfix">
                                    <span class="float-left">
                                        <h3 class="widget-user-username">{{Director.full_name}}</h3>
                                        <h5 class="widget-user-desc bg-green" style="margin-bottom:0">Phone: {{director.pivot.phone}} , <span>{{director.pivot.landline}}</span> </h5>
                                        <h5 class="widget-user-desc" style="margin-bottom:0">P.O. Box {{director.pivot.address}},</h5>
                                        <h5 class="widget-user-desc" style="margin-bottom:0" >{{director.ward_name}} Ward,
                                            <span >{{director.constituency_name}} Constituency,</span>
                                        </h5>
                                        <h5 class="widget-user-desc" style="margin-bottom:0" >{{director.county_name}} County,
                                            <span > {{director.country_name}}</span>
                                        </h5>
                                    </span>
                                    <span class="float-right">
                                        <h5 class="widget-user-desc" style="margin-bottom:0">{{Director.email}}</h5>
                                        <p style="margin-bottom:0.25em">
                                            <small class="text-muted">Last updated On: {director.updated_at | dateformat}}</small>
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
                                <img :src="directorLoadPassPhoto(director.pivot.photo)"  class="border-0"  style="width:160px;">
                                <h3 class="card-title text-center text-white">{{Director.full_name}}</h3>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="card col-md">
                                    <div  class="card-header">
                                        <h3 class="card-title">ID Front & Back Side</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col" style="padding: 3px;">
                                                <img class="card-img-top" :src="directorLoadIDFrontPhoto(director.pivot.id_photo_front)" style="width:100%; height:150px" alt="Card image cap">
                                            </div>
                                            <div class="col" style="padding: 3px;">
                                                <img class="card-img-top" :src="directorLoadIDBackPhoto(director.pivot.id_photo_back)" style="width:100%; height:150px" alt="Card image cap">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card col-md">
                                   <div  class="card-header">
                                       <h3 class="card-title">ID front Side</h3>
                                   </div>
                                   <div class="card-body">
                                        <div class="col" style="padding: 3px;">
                                            <div style="font-weight:bold;font-size:1.0em;min-width:210px;max-width:400px;margin-top:4px;padding-top:4px;font-style: italic ">
                                                <div>{{Director.full_name}},</div>
                                                <div>
                                                    {{director.position_name}},
                                                    <span style="color:#9a009a;">
                                                        <!-- bureau name -->
                                                        {{director.name}},
                                                    </span>
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
                                            </div>
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
                                        <div class="form-group col-md-4">
                                            <input v-model="adminform.password" type="password" id="password" placeholder="Password"
                                                class="form-control" :class="{ 'is-invalid': adminform.errors.has('password') }">
                                            <has-error :form="adminform" field="password"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
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
                                        <div class="form-group col-md-4">
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

        <!-- view admin -->
        <div class="modal fade " id="ViewAdminModal" tabindex="-1" role="dialog" aria-labelledby="ViewAdminModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width: 80% !important; margin-left: 263px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" v-for="admin in Admin.bureauadmins" :key="admin.id">
                        <div class="card card-widget widget-user" >
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header text-white" style="background: url('assets/bureau/img/background/background-1.jpg')
                                 center center;width:100%;height:300px">
                                <div class="clearfix">
                                    <span class="float-left">
                                        <h3 class="widget-user-username">{{Admin.full_name}}</h3>
                                        <h5 class="widget-user-desc bg-green" style="margin-bottom:0">Phone: {{admin.pivot.phone}} , <span>{{admin.pivot.landline}}</span> </h5>
                                        <h5 class="widget-user-desc" style="margin-bottom:0">P.O. Box {{admin.pivot.address}},</h5>
                                        <h5 class="widget-user-desc" style="margin-bottom:0" >{{admin.ward_name}} Ward,
                                            <span >{{admin.constituency_name}} Constituency,</span>
                                        </h5>
                                        <h5 class="widget-user-desc" style="margin-bottom:0" >{{admin.county_name}} County,
                                            <span > {{admin.country_name}}</span>
                                        </h5>
                                    </span>
                                    <span class="float-right">
                                        <h5 class="widget-user-desc" style="margin-bottom:0">{{Admin.email}}</h5>
                                        <p style="margin-bottom:0.25em">
                                            <small class="text-muted">Last updated On: {admin.updated_at | dateformat}}</small>
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
                                <img :src="adminLoadPassPhoto(admin.pivot.photo)"  class="border-0"  style="width:160px;">
                                <h3 class="card-title text-center text-white">{{Admin.full_name}}</h3>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="card col-md">
                                    <div  class="card-header">
                                        <h3 class="card-title">ID Front & Back Side</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col" style="padding: 3px;">
                                                <img class="card-img-top" :src="adminLoadIDFrontPhoto(admin.pivot.id_photo_front)" style="width:100%; height:150px" alt="Card image cap">
                                            </div>
                                            <div class="col" style="padding: 3px;">
                                                <img class="card-img-top" :src="adminLoadIDBackPhoto(admin.pivot.id_photo_back)" style="width:100%; height:150px" alt="Card image cap">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card col-md">
                                   <div  class="card-header">
                                       <h3 class="card-title">ID front Side</h3>
                                   </div>
                                   <div class="card-body">
                                        <div class="col" style="padding: 3px;">
                                            <div style="font-weight:bold;font-size:1.0em;min-width:210px;max-width:400px;margin-top:4px;padding-top:4px;font-style: italic ">
                                                <div>{{Admin.full_name}},</div>
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
                                            </div>
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
                                        <div class="form-group col-md-4">
                                            <input v-model="employeeform.password" type="password" id="password" placeholder="Password"
                                                class="form-control" :class="{ 'is-invalid': employeeform.errors.has('password') }">
                                            <has-error :form="employeeform" field="password"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
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
                                        <div class="form-group col-md-4">
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
        <!-- view employee -->
        <div class="modal fade " id="ViewEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="ViewEmployeeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width: 80% !important; margin-left: 263px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" v-for="employee in Employee.bureauemployees" :key="employee.id">
                        <div class="card card-widget widget-user" >
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header text-white" style="background: url('assets/bureau/img/background/background-1.jpg')
                                 center center;width:100%;height:300px">
                                <div class="clearfix">
                                    <span class="float-left">
                                        <h3 class="widget-user-username">{{Employee.full_name}}</h3>
                                        <h5 class="widget-user-desc bg-green" style="margin-bottom:0">Phone: {{employee.pivot.phone}} , <span>{{employee.pivot.landline}}</span> </h5>
                                        <h5 class="widget-user-desc" style="margin-bottom:0">P.O. Box {{employee.pivot.address}},</h5>
                                        <h5 class="widget-user-desc" style="margin-bottom:0" >{{employee.ward_name}} Ward,
                                            <span >{{employee.constituency_name}} Constituency,</span>
                                        </h5>
                                        <h5 class="widget-user-desc" style="margin-bottom:0" >{{employee.county_name}} County,
                                            <span > {{employee.country_name}}</span>
                                        </h5>
                                    </span>
                                    <span class="float-right">
                                        <h5 class="widget-user-desc" style="margin-bottom:0">{{Employee.email}}</h5>
                                        <p style="margin-bottom:0.25em">
                                            <small class="text-muted">Last updated On: {employee.updated_at | dateformat}}</small>
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
                                <img :src="employeeLoadPassPhoto(employee.pivot.photo)"  class="border-0"  style="width:160px;">
                                <h3 class="card-title text-center text-white">{{Employee.full_name}}</h3>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="card col-md">
                                    <div  class="card-header">
                                        <h3 class="card-title">ID Front & Back Side</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col" style="padding: 3px;">
                                                <img class="card-img-top" :src="employeeLoadIDFrontPhoto(employee.pivot.id_photo_front)" style="width:100%; height:150px" alt="Card image cap">
                                            </div>
                                            <div class="col" style="padding: 3px;">
                                                <img class="card-img-top" :src="employeeLoadIDBackPhoto(employee.pivot.id_photo_back)" style="width:100%; height:150px" alt="Card image cap">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card col-md">
                                   <div  class="card-header">
                                       <h3 class="card-title">ID front Side</h3>
                                   </div>
                                   <div class="card-body">
                                        <div class="col" style="padding: 3px;">
                                            <div style="font-weight:bold;font-size:1.0em;min-width:210px;max-width:400px;margin-top:4px;padding-top:4px;font-style: italic ">
                                                <div>{{Employee.full_name}},</div>
                                                <div>
                                                    {{employee.position_name}},
                                                    <span style="color:#9a009a;">
                                                        {{employee.name}},
                                                    </span>
                                                </div>
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
                                            </div>
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



  </div>
</template>

<script>

    export default {
        name:"SingleBureau",
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
            }
        },
        mounted() {
            this.loadCountries();
            this.loadCounties();
            this.loadConstituencies();///linked to methods and actions store
            this.loadWards();///linked to methods and actions store
            this.singlebureau();
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
                console.log(this.$store.getters.Bureau)
               return this.$store.getters.Bureau//single Bureau by parameter id
            },
            Director(){
                console.log(this.$store.getters.BureauDirector)
               return this.$store.getters.BureauDirector//View Single Bureau director  by parameter id
            },
            Admin(){
                console.log(this.$store.getters.BureauAdmin)
               return this.$store.getters.BureauAdmin//View Single Bureau  admin by parameter id
            },
            Employee(){
                console.log(this.$store.getters.BureauEmployee)
               return this.$store.getters.BureauEmployee//View Single Bureau  admin by parameter id
            },
            // Househelp(){
            //     console.log(this.$store.getters.BureauHousehelp)
            //    return this.$store.getters.BureauHousehelps//View Single Bureau houshelp  by parameter id with their kins
            // },
            // CLient(){
            //     console.log(this.$store.getters.BureauClient)
            //    return this.$store.getters.BureauClient//View Single Bureau client  by parameter id
            // },
        },
        methods:{
            singlebureau(){
                        console.log(this.$route.params.id)
                        this.$store.dispatch('BureauById', this.$route.params.id);   //action from index.js
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

            //Bureau
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
            editBureauModal(id){

                 this.editmodeBureau = true;
                 this.bureauform.reset()
                   console.log('edit bureauanisaton', id)
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

            updateBureau(id){
                  console.log('update bureauanisaton')
                  this.$Progress.start();
                     this.bureauform.patch('/bureau/update/'+id)
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
                 this.directorform.bureau_id;
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
                                return "assets/bureau/img/directors/passports/"+directorform_bureaudirector_photo;
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
                                return "assets/bureau/img/directors/IDs/front/"+directorform_id_photo_front;
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
                                return "assets/bureau/img/directors/IDs/back/"+directorform_id_photo_back;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },
            viewDirectorModal(id){
                console.log(id)
                this.$Progress.start();
                    //get bueau director by id
                this.$store.dispatch('BureauDirectorById', id)  //action from index.js
                    .then((response)=>{
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
                        $('#ViewDirectorModal').modal('show');
                        toast({
                        type: 'error',
                        title: 'There was something Wrong Wheen feching data'
                        })
                    })
            },
            editDirectorModal(id){
                console.log(id)
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
                            console.log(response.data)
                            this.directorform.fill(response.data.director)
                            this.directorform.user_id = response.data.director.bureaudirectors[0].pivot.user_id
                            this.directorform.bureau_id = response.data.director.bureaudirectors[0].pivot.bureau_id
                            // // this.directorform.position_id = response.data.director.bureaudirectors[0].pivot.position_id
                            this.directorform.photo = response.data.director.bureaudirectors[0].pivot.photo
                            this.directorform.id_no = response.data.director.bureaudirectors[0].pivot.id_no
                            this.directorform.id_photo_front = response.data.director.bureaudirectors[0].pivot.id_photo_front
                            this.directorform.id_photo_back = response.data.director.bureaudirectors[0].pivot.id_photo_back
                            this.directorform.phone = response.data.director.bureaudirectors[0].pivot.phone
                            this.directorform.landline = response.data.director.bureaudirectors[0].pivot.landline
                            this.directorform.address = response.data.director.bureaudirectors[0].pivot.address

                        // //    //get country id
                            this.directorform.country_id = response.data.director.bureaudirectors[0].pivot.country_id
                            //get county id using the country id
                            this.directorform.county_id = response.data.director.bureaudirectors[0].pivot.county_id
                            this.$store.dispatch('countrycounties', response.data.director.bureaudirectors[0].pivot.country_id);
                            //get contituency using county id
                            this.directorform.constituency_id = response.data.director.bureaudirectors[0].pivot.constituency_id
                            this.$store.dispatch('countyconstituencies', response.data.director.bureaudirectors[0].pivot.county_id);
                            // //get ward usng constituency id
                            this.directorform.ward_id = response.data.director.bureaudirectors[0].pivot.ward_id
                            this.$store.dispatch('constituencywards', response.data.director.bureaudirectors[0].pivot.constituency_id);
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
            addDirector(Bureau_id) {
                // let bureau = this.$store.getters.Bureau[0];
                console.log(Bureau_id)
                this.$Progress.start();
                this.directorform.patch('/bureaudirector/'+Bureau_id)
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
                  console.log(id)
                  console.log(+this.$route.params.id)
                  this.$Progress.start();
                     this.directorform.patch('/bureaudirector/update/'+id)
                        .then(()=>{
                        this.$store.dispatch('BureauById', this.$route.params.id);
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
                                return "assets/bureau/img/admins/passports/"+adminform_bureauadmin_photo;
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
                                return "assets/bureau/img/admins/IDs/front/"+adminform_id_photo_front;
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
                                return "assets/bureau/img/admins/IDs/back/"+adminform_id_photo_back;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },
            viewAdminModal(id){
                console.log(id)
                this.$Progress.start();
                    //get bueau admin by id
                this.$store.dispatch('BureauAdminById', id)  //action from index.js
                    .then((response)=>{
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
                        $('#ViewAdminModal').modal('show');
                        toast({
                        type: 'error',
                        title: 'There was something Wrong Wheen feching data'
                        })
                    })
            },
            editAdminModal(id){
                console.log(id)
                 this.editmodeAdmin = true;
                 this.adminform.reset()
                    this.$Progress.start();
                      axios.get('/bureauadmin/edit/'+id)
                        .then((response)=>{
                           $('#AdminModal').modal('show')
                           toast({
                            type: 'success',
                            title: 'Fetched the Admin data successfully'
                            })
                            console.log(response.data)
                            this.adminform.fill(response.data.admin)
                            this.adminform.user_id = response.data.admin.bureauadmins[0].pivot.user_id
                            this.adminform.bureau_id = response.data.admin.bureauadmins[0].pivot.bureau_id
                            // // this.adminform.position_id = response.data.admin.bureauadmins[0].pivot.position_id
                            this.adminform.photo = response.data.admin.bureauadmins[0].pivot.photo
                            this.adminform.id_no = response.data.admin.bureauadmins[0].pivot.id_no
                            this.adminform.id_photo_front = response.data.admin.bureauadmins[0].pivot.id_photo_front
                            this.adminform.id_photo_back = response.data.admin.bureauadmins[0].pivot.id_photo_back
                            this.adminform.phone = response.data.admin.bureauadmins[0].pivot.phone
                            this.adminform.landline = response.data.admin.bureauadmins[0].pivot.landline
                            this.adminform.address = response.data.admin.bureauadmins[0].pivot.address

                        // //    //get country id
                            this.adminform.country_id = response.data.admin.bureauadmins[0].pivot.country_id
                            //get county id using the country id
                            this.adminform.county_id = response.data.admin.bureauadmins[0].pivot.county_id
                            this.$store.dispatch('countrycounties', response.data.admin.bureauadmins[0].pivot.country_id);
                            //get contituency using county id
                            this.adminform.constituency_id = response.data.admin.bureauadmins[0].pivot.constituency_id
                            this.$store.dispatch('countyconstituencies', response.data.admin.bureauadmins[0].pivot.county_id);
                            // //get ward usng constituency id
                            this.adminform.ward_id = response.data.admin.bureauadmins[0].pivot.ward_id
                            this.$store.dispatch('constituencywards', response.data.admin.bureauadmins[0].pivot.constituency_id);
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                            //errors
                            $('#AdminModal').modal('show');
                            toast({
                            type: 'error',
                            title: 'There was something Wrong'
                            })
                        })
            },
            addAdmin(Bureau_id) {
                console.log(Bureau_id)
                this.$Progress.start();
                this.adminform.patch('/bureauadmin/'+Bureau_id)
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
                  console.log(id)
                  this.$Progress.start();
                     this.adminform.patch('/bureauadmin/update/'+id)
                        .then(()=>{
                        this.$store.dispatch('BureauById', this.$route.params.id);
                         $('#AdminModal').modal('hide')
                         toast({
                            type: 'success',
                            title: 'Admin Created successfully'
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
                        this.adminform.get('/bureauadmin/delete/'+id)
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
                 this.employeeform.bureau_id;
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
                                return "assets/bureau/img/employees/passports/"+employeeform_bureauemployee_photo;
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
                                return "assets/bureau/img/employees/IDs/front/"+employeeform_id_photo_front;
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
                                return "assets/bureau/img/employees/IDs/back/"+employeeform_id_photo_back;
                            }else{
                                return "/assets/bureau/img/website/empty.png";
                            }
                        }
                      }

            },
            viewEmployeeModal(id){
                console.log(id)
                this.$Progress.start();
                    //get bueau employee by id
                this.$store.dispatch('BureauEmployeeById', id)  //action from index.js
                    .then((response)=>{
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
                        $('#ViewEmployeeModal').modal('show');
                        toast({
                        type: 'error',
                        title: 'There was something Wrong Wheen feching data'
                        })
                    })
            },
            editEmployeeModal(id){
                console.log(id)
                 this.editmodeEmployee = true;
                 this.employeeform.reset()
                    this.$Progress.start();
                      axios.get('/bureauemployee/edit/'+id)
                        .then((response)=>{
                           $('#EmployeeModal').modal('show')
                           toast({
                            type: 'success',
                            title: 'Fetched the Employee data successfully'
                            })
                            console.log(response.data)
                            this.employeeform.fill(response.data.employee)
                            this.employeeform.user_id = response.data.employee.bureauemployees[0].pivot.user_id
                            this.employeeform.bureau_id = response.data.employee.bureauemployees[0].pivot.bureau_id
                            // // this.employeeform.position_id = response.data.employee.bureauemployees[0].pivot.position_id
                            this.employeeform.photo = response.data.employee.bureauemployees[0].pivot.photo
                            this.employeeform.id_no = response.data.employee.bureauemployees[0].pivot.id_no
                            this.employeeform.id_photo_front = response.data.employee.bureauemployees[0].pivot.id_photo_front
                            this.employeeform.id_photo_back = response.data.employee.bureauemployees[0].pivot.id_photo_back
                            this.employeeform.phone = response.data.employee.bureauemployees[0].pivot.phone
                            this.employeeform.landline = response.data.employee.bureauemployees[0].pivot.landline
                            this.employeeform.address = response.data.employee.bureauemployees[0].pivot.address

                        // //    //get country id
                            this.employeeform.country_id = response.data.employee.bureauemployees[0].pivot.country_id
                            //get county id using the country id
                            this.employeeform.county_id = response.data.employee.bureauemployees[0].pivot.county_id
                            this.$store.dispatch('countrycounties', response.data.employee.bureauemployees[0].pivot.country_id);
                            //get contituency using county id
                            this.employeeform.constituency_id = response.data.employee.bureauemployees[0].pivot.constituency_id
                            this.$store.dispatch('countyconstituencies', response.data.employee.bureauemployees[0].pivot.county_id);
                            // //get ward usng constituency id
                            this.employeeform.ward_id = response.data.employee.bureauemployees[0].pivot.ward_id
                            this.$store.dispatch('constituencywards', response.data.employee.bureauemployees[0].pivot.constituency_id);
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                            //errors
                            $('#EmployeeModal').modal('show');
                            toast({
                            type: 'error',
                            title: 'There was something Wrong'
                            })
                        })
            },
            addEmployee(Bureau_id) {
                console.log(Bureau_id)
                this.$Progress.start();
                this.employeeform.patch('/bureauemployee/'+Bureau_id)
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
                  console.log(id)
                  console.log(+this.$route.params.id)
                  this.$Progress.start();
                     this.employeeform.patch('/bureauemployee/update/'+id)
                        .then(()=>{
                        this.$store.dispatch('BureauById', this.$route.params.id);
                         $('#EmployeeModal').modal('hide')
                         toast({
                            type: 'success',
                            title: 'Employee Created successfully'
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
                        this.employeeform.get('/bureauemployee/delete/'+id)
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

