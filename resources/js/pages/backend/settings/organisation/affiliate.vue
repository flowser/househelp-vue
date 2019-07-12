                        <!-- Affiliates modal -->
        <div class="modal fade " id="AffiliatesModal" tabindex="-1" role="dialog" aria-labelledby="AffiliatesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title"  id="AffiliatesModalLabel">Organisation Affiliates</h3>
                        <span>
                            <button class="btn btn-success"  @click.prevent="newAffiliateModal(Organisation.id)">Add  <i class="fas fa-plus fw"></i></button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </span>
                    </div>
                    <div >
                        <div class="modal-body">
                            <div class="row" v-for="affiliate in Organisation.organisationaffiliates" :key="affiliate.id">
                                    <div class="col" style="padding: 3px;">
                                        <img class="card-img-top" :src="affiliateLoadPassPhoto(affiliate.pivot.photo)" style="width:100%; height:130px" alt="Card image cap">
                                    </div>
                                    <div class="col" style="padding: 3px;">
                                        <img class="card-img-top" :src="affiliateLoadIDFrontPhoto(affiliate.pivot.id_photo_front)" style="width:100%;height:65px" alt="Card image cap"><br>
                                        <img class="card-img-top" :src="affiliateLoadIDBackPhoto(affiliate.pivot.id_photo_back)" style="width:100%;height:65px" alt="Card image cap">
                                    </div>
                                    <div style="font-weight:bold;font-size:0.7em;min-width:210px;max-width:400px;margin-top:4px;padding-top:4px;font-style: italic ">
                                        <div>{{affiliate.full_name}},</div>
                                        <div>
                                            {{affiliate.position_name}},
                                            <span style="color:#9a009a;">
                                                {{Organisation.name}},
                                            </span>
                                        </div>
                                        <div> ID: ,<span style="color:#9a009a;">{{affiliate.pivot.id_no}}</span>,
                                            Phone: <span style="color:#9a009a;">{{affiliate.pivot.phone}},</span>
                                        </div>
                                        <div>
                                            Mail: <span style="color:#9a009a;">{{affiliate.email}},</span>
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
                                         <div class="clearfix" style="font-weight:bold;font-size:0.9em;">
                                            <span class="float-left" style="margin-bottom:-0.5em" >
                                                <div style="margin-bottom:0.25em"> Updated at:
                                                    <span style="color:#9a009a;">{{affiliate.created_at | dateformat}} </span>
                                                </div>
                                            </span>
                                            <span class="float-right">
                                                <a href=""  @click.prevent="viewAffiliateModal(affiliate.user_id)">
                                                    <i class="fa fa-eye purple"></i>
                                                </a>
                                                <a href=""  @click.prevent="editAffiliateModal(affiliate.user_id)">
                                                    <i class="fa fa-edit blue"></i>
                                                </a>
                                                /
                                                <a href=""  @click.prevent="deleteAffiliate(affiliate.user_id)">
                                                    <i class="fa fa-trash red"></i>
                                                </a>
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

        <!-- create & edit Affiliate modal -->
        <div class="modal fade " id="AffiliateModal" tabindex="-1" role="dialog" aria-labelledby="AffiliateModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form role="form" @submit.prevent="editmodeAffiliate ? updateAffiliate(affiliateform.id) : addAffiliate(Organisation.id)" >
                        <div class="modal-body">
                            <h5 class="modal-title" v-show="editmodeAffiliate" id="AffiliateModalLabel">Update Affiliate</h5>
                            <h5 class="modal-title" v-show="!editmodeAffiliate" id="AffiliateModalLabel">Add New Affiliate</h5>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="first_name" class="col-form-label"> Affiliate First Name</label>
                                            <input v-model="affiliateform.first_name" type="text" name="first_name" placeholder="Affiliate First Name"
                                                class="form-control" :class="{ 'is-invalid': affiliateform.errors.has('first_name') }" >
                                            <has-error style="color: #e83e8c" :form="affiliateform" field="first_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="last_name" class=" col-form-label">affiliate_Last Name </label>
                                            <input v-model="affiliateform.last_name" type="affiliate_last_name" name="last_name" placeholder="Affiliate Last Name"
                                                class="form-control" :class="{ 'is-invalid': affiliateform.errors.has('last_name') }" >
                                            <has-error style="color: #e83e8c" :form="affiliateform" field="last_name"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="email" class=" col-form-label">Email </label>
                                            <input v-model="affiliateform.email" type="email" name="email" placeholder="Email Address"
                                                class="form-control" :class="{ 'is-invalid': affiliateform.errors.has('email') }" >
                                            <has-error style="color: #e83e8c" :form="affiliateform" field="email"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <input v-model="affiliateform.password" type="password" id="password" placeholder="Password"
                                                class="form-control" :class="{ 'is-invalid': affiliateform.errors.has('password') }">
                                            <has-error :form="affiliateform" field="password"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="phone" class="col-form-label"> Affiliate Phone</label>
                                                <div>
                                                    <vue-tel-input v-model="affiliateform.phone" name="phone" @onInput="AffiliateInputPhone"
                                                    class="form-control" :class="{ 'is-invalid': affiliateform.errors.has('phone') }">
                                                    </vue-tel-input>
                                                    <has-error style="color: #e83e8c" :form="affiliateform" field="phone"></has-error>
                                                </div>
                                                <div v-if="affiliateform.phone" style="color: #e83e8c">
                                                    <span>Is valid: <strong>{{phone4.isValid}}</strong>,&nbsp;</span>
                                                    <span>Country: <strong>{{phone4.country}}</strong></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="landline" class=" col-form-label">Landline</label>
                                                <vue-tel-input v-model="affiliateform.landline" name="landline" @onInput="AffiliateInputLandline"
                                                    class="form-control" :class="{ 'is-invalid': affiliateform.errors.has('landline') }">
                                                </vue-tel-input>
                                                <has-error style="color: #e83e8c" :form="affiliateform" field="landline"></has-error>

                                                <div v-if="affiliateform.landline" style="color: #e83e8c">
                                                    <span>Is valid: <strong>{{landline4.isValid}}</strong>,&nbsp;</span>
                                                    <span>Country: <strong>{{landline4.country}}</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <label for="id_no" class="col-form-label">ID no.</label>
                                            <input v-model="affiliateform.id_no" type="text" name="id_no" placeholder="ID NO"
                                                class="form-control" :class="{ 'is-invalid': affiliateform.errors.has('id_no') }" >
                                            <has-error style="color: #e83e8c" :form="affiliateform" field="id_no"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="address" class=" col-form-label">Address</label>
                                            <input v-model="affiliateform.address" type="text" name="address" placeholder="Address"
                                                class="form-control" :class="{ 'is-invalid': affiliateform.errors.has('address') }" >
                                            <has-error style="color: #e83e8c" :form="affiliateform" field="country_id"></has-error>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-3">
                                            <label for="country_id">Select Country</label>
                                            <select class="form-control" @change="countryCounties(affiliateform.country_id)"
                                            v-model="affiliateform.country_id" :class="{ 'is-invalid': affiliateform.errors.has('country_id') }">
                                                    <option disabled value="">Select Country</option>{{affiliateform.country_id}}
                                                    <option v-for="country in Countries" :value="country.id" :key="country.id">{{country.name}}</option>
                                            </select>
                                                <has-error style="color: #e83e8c" :form="affiliateform" field="country_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="county_id" class=" col-form-label">County</label>
                                            <select class="form-control" @change="countyConstituencies(affiliateform.county_id)"
                                            v-model="affiliateform.county_id" :class="{ 'is-invalid': affiliateform.errors.has('county_id') }">
                                                    <option disabled value="">Select County</option>
                                                    <option v-for="county in Counties" :value="county.id" :key="county.id">{{county.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="affiliateform" field="county_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="constituency_id" class=" col-form-label">Constituency</label>
                                            <select class="form-control" @change="constituencyWards(affiliateform.constituency_id)"
                                            v-model="affiliateform.constituency_id" :class="{ 'is-invalid': affiliateform.errors.has('constituency_id') }">
                                                    <option disabled value="">Select County</option>
                                                    <option v-for="constituency in Constituencies" :value="constituency.id" :key="constituency.id">{{constituency.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="affiliateform" field="constituency_id"></has-error>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="ward_id" class="col-form-label"> Ward </label>
                                            <select class="form-control"
                                            v-model="affiliateform.ward_id" :class="{ 'is-invalid': affiliateform.errors.has('ward_id') }">
                                                    <option disabled value="">Select Ward</option>
                                                    <option v-for="ward in Wards" :value="ward.id" :key="ward.id">{{ward.name}}</option>
                                            </select>
                                            <has-error style="color: #e83e8c" :form="affiliateform" field="ward_id"></has-error>
                                        </div>

                                    </div>
                                    <div class=" row">
                                        <div class="form-group col-md-4">
                                            <label for="photo" class=" col-form-label">Affiliate PassPort Image</label><br>
                                                <input @change="affiliateChangePassPhoto($event)" type="file" name="photo"
                                                    :class="{ 'is-invalid': affiliateform.errors.has('photo') }">
                                                    <img v-show="editmodeAffiliate" :src="updateAffiliatePassPhoto(affiliateform.photo)" alt="" width="100%" >
                                                    <img  v-show="!editmodeAffiliate" :src="affiliateform.photo" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="affiliateform" field="photo"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="id_photo_front" class=" col-form-label">Affiliate FrontSide ID Photo</label><br>
                                                <input @change="affiliateChangeIDFrontPhoto($event)" type="file" name="id_photo_front"
                                                    :class="{ 'is-invalid': affiliateform.errors.has('id_photo_front') }">
                                                    <img v-show="editmodeAffiliate" :src="updateAffiliateIDFrontPhoto(affiliateform.id_photo_front)" alt="" width="100%" >
                                                    <img  v-show="!editmodeAffiliate" :src="affiliateform.id_photo_front" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="affiliateform" field="id_photo_front"></has-error>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="backside_i_photod" class=" col-form-label">BackSide ID Photo</label><br>
                                                <input @change="affiliateChangeIDBackPhoto($event)" type="file" name="id_photo_back"
                                                    :class="{ 'is-invalid': affiliateform.errors.has('backside_id') }">
                                                    <img v-show="editmodeAffiliate" :src="updateAffiliateIDBackPhoto(affiliateform.id_photo_back)" alt="" width="100%" >
                                                    <img  v-show="!editmodeAffiliate" :src="affiliateform.id_photo_back" alt="" width="100%" >
                                                <has-error style="color: #e83e8c" :form="affiliateform" field="id_photo_back"></has-error>
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
        <!-- view affiliate -->
        <div class="modal fade " id="ViewAffiliateModal" tabindex="-1" role="dialog" aria-labelledby="ViewAffiliateModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width: 80% !important; margin-left: 263px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" v-for="affiliate in Affiliate.organisationaffiliates" :key="affiliate.id">
                        <div class="card card-widget widget-user" >
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header text-white" style="background-color: #070075c4; center center;width:100%;height:190px">
                                <div class="clearfix">
                                    <span class="float-left">
                                        <h3 class="widget-user-username">{{Affiliate.full_name}}</h3>
                                        <h5 class="widget-user-desc bg-green" style="margin-bottom:0">Phone: {{affiliate.pivot.phone}} , <span>{{affiliate.pivot.landline}}</span> </h5>
                                        <h5 class="widget-user-desc" style="margin-bottom:0">P.O. Box {{affiliate.pivot.address}},</h5>
                                        <h5 class="widget-user-desc" style="margin-bottom:0" >{{affiliate.ward_name}} Ward,
                                            <span >{{affiliate.constituency_name}} Constituency,</span>
                                        </h5>
                                        <h5 class="widget-user-desc" style="margin-bottom:0" >{{affiliate.county_name}} County,
                                            <span > {{affiliate.country_name}}</span>
                                        </h5>
                                    </span>
                                    <span class="float-right">
                                        <h5 class="widget-user-desc" style="margin-bottom:0">{{Affiliate.email}}</h5>
                                        <p style="margin-bottom:0.25em">
                                            <small class="text-muted">Last updated On: {affiliate.updated_at | dateformat}}</small>
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
                                <img :src="affiliateLoadPassPhoto(affiliate.pivot.photo)"  class="border-0"  style="width:160px;">
                                <h3 class="card-title text-center text-white">{{Affiliate.full_name}}</h3>
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
                                                <img class="card-img-top" :src="affiliateLoadIDFrontPhoto(affiliate.pivot.id_photo_front)" style="width:100%; height:150px" alt="Card image cap">
                                            </div>
                                            <div class="col" style="padding: 3px;">
                                                <img class="card-img-top" :src="affiliateLoadIDBackPhoto(affiliate.pivot.id_photo_back)" style="width:100%; height:150px" alt="Card image cap">
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
                                                <div>{{Affiliate.full_name}},</div>
                                                <div>
                                                    {{affiliate.position_name}},
                                                    <span style="color:#9a009a;">
                                                        {{affiliate.name}},
                                                    </span>
                                                </div>
                                                <div> ID: ,<span style="color:#9a009a;">{{affiliate.pivot.id_no}}</span>,
                                                    Phone: <span style="color:#9a009a;">{{affiliate.pivot.phone}},</span>
                                                </div>
                                                <div>
                                                    Mail: <span style="color:#9a009a;">{{Affiliate.email}},</span>
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
