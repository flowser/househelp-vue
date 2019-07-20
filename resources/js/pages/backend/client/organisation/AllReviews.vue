<template>
<div class="content-wrapper">
  <div class="container-fluid mt-5">
      <!-- Main content -->
    <div class="col-md-12">
     <section class="content">
      <div class="row justify-content-around">
        <div class="col-md">
          <div class="card">
            <div class="card-header">
                <div v-if="Approved ==true && Pending ==false">
                    <el-button type="success">{{Status}} ({{ApprovedPagination.total}}) </el-button>
                    <el-button type="danger" v-on:click="getPendingReviews()" plain>Pending Reviews ({{PendingPagination.total}})</el-button>
                </div>
                <div v-else-if="Approved ==false && Pending ==true">
                    <el-button type="danger" v-on:click="getApprovedReviews()" plain>Approved Reviews ({{ApprovedPagination.total}})</el-button>
                    <el-button type="success">{{Status}} ({{PendingPagination.total}})</el-button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>S1</th>
                    <th>Househelp Reviews</th>
                  </tr>
                </thead>
                <tbody v-for="(review, index) in Reviews" :key="review.id">
                    <tr>
                    <td style="width: 1px;">{{index+1}}</td>
                    <td>
                        <div class="row">
                            <div class="col-sm-2" v-if="review.bureauhousehelp">
                                <div style="padding: 3px;">
                                    <img class="card-img-top" :src="househelpLoadPassPhoto(review.bureauhousehelp.photo)" style="width:100%; height:130px" alt="Card image cap">
                                </div>
                                <div style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                    <div>Name: <span style="color:#9a009a;">{{review.bureauhousehelp.user_first_name}} {{review.bureauhousehelp.user_last_name}}</span></div>
                                    <div>Phone: <span style="color:#9a009a;">{{review.bureauhousehelp.phone}}</span></div>
                                </div>
                                <div class="clearfix" style="font-weight:bold;font-size:0.7em;" v-if="review.bureauhousehelp">
                                    <span class="float-left" style="margin-bottom:-0.5em" >
                                        <div style="margin-bottom:0.25em"> Updated at:
                                            <span style="color:#9a009a;">{{review.bureauhousehelp.created_at | dateformat}} </span>
                                        </div>
                                    </span>
                                    <span class="float-right">
                                        <a href=""  @click.prevent="viewHousehelpModal(review.bureauhousehelp.id)">
                                            <i class="fa fa-eye purple"></i>
                                        </a>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-8" style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                <div class="row" >
                                    <div class="col-sm-6">
                                        <div>Review: <span style="color:#9a009a;"> {{review.review | sortlength(300, "...")}}</span>,</div>
                                        <div>What To improve <span style="color:#9a009a;"> {{review.what_to_improve | sortlength(300, "...")}}</span>,</div>
                                    <br>
                                    <div class="row" >
                                        <td style="padding: 0px; padding-left: 16px;"> Overall Rating:</td>
                                        <!-- call for calculation fuctnion on avrage -->
                                            {{averageRating(review)}}
                                            <td style="padding: 0px; padding-left: 16px;">
                                                <star-rating :read-only="true" :show-rating="true"
                                                            :max-rating="10" :star-size="20"
                                                            :rating="Number(Average_rating)">
                                                </star-rating>
                                            </td>
                                    </div>
                                    <div class="clearfix" >
                                        <span class="float-left" style="margin-bottom:-0.5em" >
                                            <div style="margin-bottom:0.25em"> Updated at:
                                                <span style="color:#9a009a;">{{review.created_at | dateformat}} </span>
                                            </div>
                                        </span>
                                        <span class="float-right">
                                            <a href=""  @click.prevent="viewReviewModal(review.id)">
                                                <i class="fa fa-eye purple"></i>
                                            </a>
                                        </span>
                                    </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <tr>
                                            <td style="padding: 0px; padding-left: 16px;">Hygiene:</td>
                                                <td style="padding: 0px; padding-left: 16px;">
                                                    <star-rating :read-only="true" :show-rating="true"
                                                                :max-rating="10" :star-size="20"
                                                                :rating="Number(review.hygiene_rating)">
                                                    </star-rating>
                                                </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 0px; padding-left: 16px;">Children Rapport:</td>
                                               <td style="padding: 0px; padding-left: 16px;">
                                                   <star-rating :read-only="true" :show-rating="true"
                                                             :max-rating="10" :star-size="20"
                                                             :rating="Number(review.children_rapport_rating)">
                                                   </star-rating>
                                                </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 0px; padding-left: 16px;">Truthfullness:</td>
                                                <td style="padding: 0px; padding-left: 16px;">
                                                    <star-rating :read-only="true" :show-rating="true"
                                                                :max-rating="10" :star-size="20"
                                                                :rating="Number(review.truthfullness_rating)">
                                                    </star-rating>
                                                </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 0px; padding-left: 16px;">Morality:</td>
                                                <td style="padding: 0px; padding-left: 16px;">
                                                    <star-rating :read-only="true" :show-rating="true"
                                                                :max-rating="10" :star-size="20"
                                                                :rating="Number(review.morality_rating)">
                                                    </star-rating>
                                                </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 0px; padding-left: 16px;">Truthfullness:</td>
                                                <td style="padding: 0px; padding-left: 16px;">
                                                    <star-rating :read-only="true" :show-rating="true"
                                                                :max-rating="10" :star-size="20"
                                                                :rating="Number(review.truthfullness_rating)">
                                                    </star-rating>
                                                </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 0px; padding-left: 16px;">Obedience:</td>
                                                <td style="padding: 0px; padding-left: 16px;">
                                                    <star-rating :read-only="true" :show-rating="true"
                                                                :max-rating="10" :star-size="20"
                                                                :rating="Number(review.obedience_rating)">
                                                    </star-rating>
                                                </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 0px; padding-left: 16px;">Approval Status:</td>
                                                <td style="padding: 0px; padding-left: 16px;">
                                                    <div v-if="review.approval_status == true">
                                                        <button type="button" class="btn btn-warning btn-sm"> Approved</button>
                                                    </div>
                                                    <div v-else-if="review.approval_status == false">
                                                        <button type="button" class="btn btn-danger btn-sm"> Pending</button>
                                                    </div>
                                                </td>
                                        </tr>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2" v-if="review.organisationclient">
                                <div style="padding: 3px;">
                                    <img class="card-img-top" :src="clientLoadPassPhoto(review.organisationclient.photo)" style="width:100%; height:130px" alt="Card image cap">
                                </div>
                                <div style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                    <div>Name: <span style="color:#9a009a;">{{review.organisationclient.user_first_name}} {{review.organisationclient.user_last_name}}</span></div>
                                    <div>Phone: <span style="color:#9a009a;">{{review.organisationclient.phone}}</span></div>
                                </div>
                                <div class="clearfix" style="font-weight:bold;font-size:0.7em;" v-if="review.organisationclient">
                                    <span class="float-left" style="margin-bottom:-0.5em" >
                                        <div style="margin-bottom:0.25em"> Updated at:
                                            <span style="color:#9a009a;">{{review.organisationclient.created_at | dateformat}} </span>
                                        </div>
                                    </span>
                                    <span class="float-right">
                                        <a href=""  @click.prevent="viewClientModal(review.organisationclient.id)">
                                            <i class="fa fa-eye purple"></i>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div v-if="Reviews.length">
                  <div class="clearfix" style="font-weight:bold;font-size:0.7em;">
                        <span class="float-left" style="margin-bottom:-0.5em" >
                            <div style="margin-bottom:0.25em">
                                 Between <span style="color:#9a009a;"> {{ReviewPagination.from}} </span>
                                 & <span style="color:#9a009a;"> {{ReviewPagination.to}} </span>
                                out of <span style="color:#9a009a;"> {{ReviewPagination.total}} </span> Reviews
                            </div>
                            <button class="btn btn-info" v-on:click="fetchPaginatedReviews(ReviewPagination.prev_page_url)" :disabled="!ReviewPagination.prev_page_url">Prev</button>
                        </span>
                        <span class="float-right" style="margin-bottom:-0.5em" >
                            <div style="margin-bottom:0.25em">
                                 Page <span style="color:#9a009a;"> {{ReviewPagination.current_page}} </span>
                                 of <span style="color:#9a009a;"> {{ReviewPagination.last_page}} </span>
                            </div>
                             <button class="btn btn-info" v-on:click="fetchPaginatedReviews(ReviewPagination.next_page_url)" :disabled="!ReviewPagination.next_page_url">Next</button>
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
    </section>
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
                                                    <!-- <span class="float-right"> -->
                                                        <!-- <a href=""  @click.prevent="viewHousehelpModal(househelp.id)">
                                                            <i class="fa fa-eye purple"></i>
                                                        </a> -->
                                                        <!-- <a href=""  @click.prevent="editHousehelpModal(Househelp.user_id)"> -->
                                                            <!-- <i class="fa fa-edit blue"></i> -->
                                                        <!-- </a> -->
                                                        <!-- /
                                                        <a href=""  @click.prevent="deleteHousehelp(Househelp.id)">
                                                            <i class="fa fa-trash red"></i>
                                                        </a> -->
                                                    <!-- </span> -->
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
                                            <!-- <span class="float-right"> -->
                                                <!-- <a href=""  @click.prevent="viewHousehelpkinModal(househelpkin.user_id)">
                                                    <i class="fa fa-eye purple"></i>
                                                </a> -->
                                                <!-- <a href=""  @click.prevent="editHousehelpkinModal(househelpkin.user_id)">
                                                    <i class="fa fa-edit blue"></i> -->
                                                <!-- </a>
                                            </span> -->
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

<!-- view client -->
        <div class="modal fade " id="ViewClientModal" tabindex="-1" role="dialog" aria-labelledby="ViewClientModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row" >
                            <div class="col-sm-3" style="padding: 3px;">
                                <img class="card-img-top" :src="clientLoadPassPhoto(Client.photo)" style="width:100%; height:130px" alt="Card image cap">
                            </div>
                            <div class="col-sm-3" style="padding: 3px;">
                                <img class="card-img-top" :src="clientLoadIDFrontPhoto(Client.id_photo_front)" style="width:100%;height:65px" alt="Card image cap"><br>
                                <img class="card-img-top" :src="clientLoadIDBackPhoto(Client.id_photo_back)" style="width:100%;height:65px" alt="Card image cap">
                            </div>
                            <div class="col-sm-6" style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                <div v-if="Client.user"> Client: <span style="color:#9a009a;" >{{Client.user.full_name}},</span></div>
                                <div >
                                    ID: ,<span style="color:#9a009a;">{{Client.id_number}}</span>,
                                    Phone: <span style="color:#9a009a;">{{Client.phone}},</span>
                                </div>
                                <div>
                                    Mail: <span style="color:#9a009a;" v-if="Client.user">{{Client.user.email}},</span>
                                </div>
                                    <div>P. O. Box , <span style="color:#9a009a;">{{Client.address}}</span>,
                                    </div>
                                <div>
                                    <span style="color:#9a009a;" v-if="Client.ward">{{Client.ward.name}}</span> ward,
                                    <span style="color:#9a009a;" v-if="Client.constituency">{{Client.constituency.name}}</span> constituency,
                                </div>
                                <div>
                                    <span style="color:#9a009a;" v-if="Client.county">{{Client.county.name}}</span> county,
                                    <span style="color:#9a009a;" v-if="Client.country">{{Client.country.name}},</span>
                                </div>
                                <div class="clearfix" style="font-weight:bold;font-size:0.9em;">
                                        <span class="float-left" style="margin-bottom:-0.5em" >
                                            <div style="margin-bottom:0.25em"> Updated at:
                                                <span style="color:#9a009a;">{{Client.created_at | dateformat}} </span>
                                            </div>
                                        </span>
                                        <!-- <span class="float-right"> -->
                                            <!-- <a href=""  @click.prevent="viewClientModal(client.id)">
                                                <i class="fa fa-eye purple"></i>
                                            </a> -->
                                            <!-- <a href=""  @click.prevent="editClientModal(Client.user_id)"> -->
                                                <!-- <i class="fa fa-edit blue"></i> -->
                                            <!-- </a> -->
                                            <!-- /
                                            <a href=""  @click.prevent="deleteClient(Client.id)">
                                                <i class="fa fa-trash red"></i>
                                            </a> -->
                                        <!-- </span> -->
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



        <!-- view review -->
        <div class="modal fade " id="ViewReviewModal" tabindex="-1" role="dialog" aria-labelledby="ViewReviewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" >
                        <div class="row">
                            <div  style="font-weight:bold;font-size:0.7em;margin-top:4px;padding-top:4px;font-style: italic ">
                                <div class="row" >
                                    <div class="col-sm-6">
                                        <div>Review: <span style="color:#9a009a;"> {{Review.review}}</span>,</div>
                                        <div>What To improve <span style="color:#9a009a;"> {{Review.what_to_improve}}</span>,</div>
                                        <br>
                                        <div class="row" >
                                            <td style="padding: 0px; padding-left: 16px;"> Overall Rating:</td>
                                            <!-- call for calculation fuctnion on avrage -->
                                                {{averageRating(Review)}}
                                                <td style="padding: 0px; padding-left: 16px;">
                                                    <star-rating :read-only="true" :show-rating="true"
                                                                :max-rating="10" :star-size="20"
                                                                :rating="Number(Average_rating)">
                                                    </star-rating>
                                                </td>
                                        </div>
                                        <div class="clearfix" >
                                            <span class="float-left" style="margin-bottom:-0.5em" >
                                                <div style="margin-bottom:0.25em"> Updated at:
                                                    <span style="color:#9a009a;">{{Review.created_at | dateformat}} </span>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <tr>
                                            <td style="padding: 0px; padding-left: 16px;">Hygiene:</td>
                                                <td style="padding: 0px; padding-left: 16px;">
                                                    <star-rating :read-only="true" :show-rating="true"
                                                                :max-rating="10" :star-size="20"
                                                                :rating="Number(Review.hygiene_rating)">
                                                    </star-rating>
                                                </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 0px; padding-left: 16px;">Children Rapport:</td>
                                               <td style="padding: 0px; padding-left: 16px;">
                                                   <star-rating :read-only="true" :show-rating="true"
                                                             :max-rating="10" :star-size="20"
                                                             :rating="Number(Review.children_rapport_rating)">
                                                   </star-rating>
                                                </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 0px; padding-left: 16px;">Truthfullness:</td>
                                                <td style="padding: 0px; padding-left: 16px;">
                                                    <star-rating :read-only="true" :show-rating="true"
                                                                :max-rating="10" :star-size="20"
                                                                :rating="Number(Review.truthfullness_rating)">
                                                    </star-rating>
                                                </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 0px; padding-left: 16px;">Morality:</td>
                                                <td style="padding: 0px; padding-left: 16px;">
                                                    <star-rating :read-only="true" :show-rating="true"
                                                                :max-rating="10" :star-size="20"
                                                                :rating="Number(Review.morality_rating)">
                                                    </star-rating>
                                                </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 0px; padding-left: 16px;">Truthfullness:</td>
                                                <td style="padding: 0px; padding-left: 16px;">
                                                    <star-rating :read-only="true" :show-rating="true"
                                                                :max-rating="10" :star-size="20"
                                                                :rating="Number(Review.truthfullness_rating)">
                                                    </star-rating>
                                                </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 0px; padding-left: 16px;">Obedience:</td>
                                                <td style="padding: 0px; padding-left: 16px;">
                                                    <star-rating :read-only="true" :show-rating="true"
                                                                :max-rating="10" :star-size="20"
                                                                :rating="Number(Review.obedience_rating)">
                                                    </star-rating>
                                                </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 0px; padding-left: 16px;">Approval Status:</td>
                                                <td style="padding: 0px; padding-left: 16px;">
                                                    <div v-if="Review.approval_status == true">
                                                        <el-button type="success">Approved</el-button>
                                                        <el-button type="danger" class="btn btn-warning btn-sm" v-on:click="RejectReview(Review.id)" plain> Reject </el-button>
                                                    </div>
                                                    <div v-else-if="Review.approval_status == false">
                                                        <el-button type="danger">Rejected</el-button>
                                                        <el-button type="warning" class="btn btn-warning btn-sm" v-on:click="ApproveReview(Review.id)" plain> Approve </el-button>
                                                    </div>
                                                </td>
                                        </tr>
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
        name:"Reviews",
        data(){
            return{
                Average_rating:'',
                Approved:'',
                Pending:'',
                Status:'',
                approvedstatus:false,
                pendingstatus:false,
                urlform: new Form({
                    review_id:'',
                    client_id:'',
                 househelp_id:'',
                    bureau_id:'',
                          url:'/api/review/get/approved/',
                  approvedurl:'/api/review/get/approved/',
                   pendingurl:'/api/review/get/pending/',
                    bureauurl:'/api/bureaus/get/',
              approval_status:'',
                }),
            }
        },
        mounted() {
            this.getApprovedReviews(); //from methods
        },
        computed:{
            Reviews(){
               return this.$store.getters.Reviews
            },
            ReviewPagination(){
                return this.$store.getters.ReviewPagination
            },
            ApprovedPagination(){
                return this.$store.getters.ApprovedReviewPagination
            },
            PendingPagination(){
                return this.$store.getters.PendingReviewPagination
            },
            Review(){
               return this.$store.getters.Review
            },
            Househelp(){
               return this.$store.getters.Househelp
            },
            Client(){
               return this.$store.getters.Client
            },
        },
        methods:{
            ApproveReview(id){
                this.urlform.approval_status=true,
                this.urlform.patch('/api/review/update/'+id)
                .then((response)=>{
                    this.$store.dispatch('ReviewById',id)
                    this.getApprovedReviews();
                        toast({
                        type: 'success',
                        title: 'Approved the Review successfully'
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
            RejectReview(id){
                this.urlform.approval_status=false,
                this.urlform.patch('/api/review/update/'+id)
                .then((response)=>{
                        this.$store.dispatch('ReviewById', id)
                        this.getPendingReviews();
                        toast({
                        type: 'success',
                        title: 'Rejected the Review successfully'
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
            averageRating(review){
                console.log(review, 'review')
                var hygiene          = Number(review.hygiene_rating)
                var children_rapport = Number(review.children_rapport_rating)
                var truthfullness    = Number(review.truthfullness_rating)
                var morality         = Number(review.morality_rating)
                var truthfullness    = Number(review.truthfullness_rating)
                var obedience        = Number(review.obedience_rating)
                this.Average_rating =  (hygiene + children_rapport + truthfullness + morality + truthfullness + obedience)/6;
            },
            getApprovedReviews(){
                this.Approved = true;
                this.Pending = false;
                this.Status = 'Approved Reviews';
                this.approvedstatus = true;
                this.pendingstatus = false;
                this.urlform.url = '/api/review/get/approved/';
                this.$store.dispatch("approvedreviews", this.urlform)
                this.$store.dispatch("pendingreviews", this.urlform)
                this.loadReviews();
            },
            getPendingReviews(){
                this.Approved = false;
                this.Pending = true;
                this.Status = 'Pending Reviews';
                this.approvedstatus = false;
                this.pendingstatus = true;// pending
                this.urlform.url = '/api/review/get/pending/';
                this.$store.dispatch("approvedreviews", this.urlform)
                this.$store.dispatch("pendingreviews", this.urlform)
                this.loadReviews();
            },
            loadReviews(){
               this.$Progress.start();
                let approved = this.approvedstatus;
                let pending = this.pendingstatus;
               if(approved ==true && pending ==false){
                   return this.$store.dispatch( "reviews", this.urlform)
                    .then((response)=>{
                        toast({
                        type: 'success',
                        title: 'Fetched the Reviews data successfully'
                        })
                    })
                    .catch(()=>{
                        this.$Progress.fail();
                        toast({
                        type: 'error',
                        title: 'There was something Wrong'
                        })
                    })

               }else if(approved ==false && pending ==true){
                   return this.$store.dispatch( "reviews", this.urlform)
                    .then((response)=>{
                        toast({
                        type: 'success',
                        title: 'Fetched the Reviews data successfully'
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
            fetchPaginatedReviews(url){
                this.urlform.url = url;
                this.loadReviews();
            },
            viewHousehelpModal(id){
                console.log(id)
                this.$Progress.start();
                //get bueau househelp by id
                this.urlform.househelp_id = id;
                this.$store.dispatch('HousehelpById', id)  //action from index.js
                    .then((response)=>{
                       $('#ViewHousehelpModal').modal('show')
                       toast({
                        type: 'success',
                        title: 'Fetched the Bureau Househelp data successfully'
                        })
                        this.$Progress.finish();
                    })
                    .catch(()=>{
                        this.$Progress.fail();
                        this.loadReviews();
                        $('#ViewHousehelpModal').modal('hide');
                        toast({
                        type: 'error',
                        title: 'There was something Wrong When fetching data'
                        })
                    })
            },
            viewReviewModal(id){
                this.$Progress.start();
                //get bueau review by id
                this.urlform.review_id = id;
                this.$store.dispatch('ReviewById', id)  //action from index.js
                    .then((response)=>{
                       $('#ViewReviewModal').modal('show')
                       toast({
                        type: 'success',
                        title: 'Fetched the Review data successfully'
                        })
                        this.$Progress.finish();
                    })
                    .catch(()=>{
                        this.$Progress.fail();
                        this.loadReviews();
                        $('#ViewReviewModal').modal('hide');
                        toast({
                        type: 'error',
                        title: 'There was something Wrong When fetching data'
                        })
                    })
            },
            viewClientModal(id){
                this.$Progress.start();
                //get bueau client by id
                this.urlform.client_id = id;
                this.$store.dispatch('ClientById', id)  //action from index.js
                    .then((response)=>{
                       $('#ViewClientModal').modal('show')
                       toast({
                        type: 'success',
                        title: 'Fetched the Bureau Client data successfully'
                        })
                        this.$Progress.finish();
                    })
                    .catch(()=>{
                        this.$Progress.fail();
                        this.loadReviews();
                        $('#ViewClientModal').modal('hide');
                        toast({
                        type: 'error',
                        title: 'There was something Wrong When fetching data'
                        })
                    })
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
            clientLoadPassPhoto(photo){
                if(photo){
                    return "/assets/organisation/img/clients/passports/"+photo;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            clientLoadIDFrontPhoto(id_photo_front){
                if(id_photo_front){
                    return "/assets/organisation/img/clients/IDs/front/"+id_photo_front;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            clientLoadIDBackPhoto(id_photo_back){
                if(id_photo_back){
                    return "/assets/organisation/img/clients/IDs/back/"+id_photo_back;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
        },
    }
</script>

