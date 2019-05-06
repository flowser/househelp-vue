<template>
  <div class="container-fluid mt-5">
      <!-- Main content -->
        <div class="col-md-12">
                <!-- Widget: user widget style 1 -->
                <!-- <div v-if="Organisation.length <1" class="card-tools">
                <!-- <div  class="card-tools"> -->
                    <!-- <button class="btn btn-success" @click.prevent="newOrganisationModal()" >Add Organisation -->
                        <!-- <i class="fas fa-plus fw"></i> -->
                    <!-- </button> -->
                <!-- </div> -->
                <div class="card card-widget widget-user" >
                   <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header text-white" style="background: url('assets/organisation/img/background/background-1.jpg')
                    center center;width:100%;height:300px">
                    <div class="clearfix">
                                <span class="float-left">
                                    <h3 class="widget-user-username">{{Organisation.name}}</h3>
                                    <h5 class="widget-user-desc bg-green" style="margin-bottom:0">Phone: {{Organisation.phone}}, <span>{{Organisation.landline}}</span> </h5>
                                    <h5 class="widget-user-desc" style="margin-bottom:0">P.O. Box {{Organisation.address}},</h5>
                                    <h5 class="widget-user-desc" style="margin-bottom:0" v-if="Organisation.ward">{{Organisation.ward.name}} Ward,
                                        <span v-if="Organisation.constituency">{{Organisation.constituency.name}} Constituency,</span>
                                    </h5>
                                    <h5 class="widget-user-desc" style="margin-bottom:0" v-if="Organisation.county">{{Organisation.county.name}} County,
                                         <span v-if="Organisation.country"> {{Organisation.country.name}}</span>
                                    </h5>
                                </span>
                                <span class="float-right">
                                    <h5 class="widget-user-desc" style="margin-bottom:0">{{Organisation.email}}</h5>
                                    <h5 class="widget-user-desc" style="margin-bottom:0">{{Organisation.website}}</h5>
                                    <!-- <p style="margin-bottom:-0.5em">
                                        <small class="text-muted">Updated By: {{organisation.user.full_name}}</small>
                                    </p> -->
                                    <p style="margin-bottom:0.25em">
                                        <small class="text-muted">Last updated On: {{Organisation.updated_at | dateformat}}</small>
                                    </p>
                                    <a href=""  @click.prevent="editOrganisationModal(Organisation.id)">
                                            <i class="fa fa-edit red"> Edit</i>
                                    </a>
                                    <!-- / -->
                                    <!-- <a href=""  @click.prevent="deleteOrganisation(Organisation.id)">
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
                        <img :src="organisationLoadLogo(Organisation.logo)"  class="border-0" alt="" style="width:160px;">
                        <h3 class="card-title text-center text-white">{{Organisation.name}}</h3>

                    </div>
                </div>
                <!-- /.widget-user -->

                <div class="container-fluid">
                    <div class="row">
                        <div class="card col-md">
                            <div class="card-header">
                               <h3 class="card-title">Organisation Directors Table</h3>
                                <div class="card-tools">
                                        <button class="btn btn-success"  @click.prevent="newDirectorModal(Organisation.id)">Add New Director
                                            <i class="fas fa-plus fw"></i>
                                        </button>
                                </div>
                            </div>

                            <div class="card-body">
                                 <div class="row" v-for="director in Organisation.organisationdirectors" :key="director.id">
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
                                                {{Organisation.name}},
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
                               <h3 class="card-title">Organisation Admins Table</h3>
                                <div class="card-tools">
                                        <button class="btn btn-success"  @click.prevent="newAdminModal(Organisation.id)">Add New Admin
                                            <i class="fas fa-plus fw"></i>
                                        </button>
                                </div>
                            </div>
                            <div class="card-body">
                                 <div class="row" v-for="admin in Organisation.organisationadmins" :key="admin.id">
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
                                                {{Organisation.name}},
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
                                <h3> Organisation Employees</h3>
                                <div class="card-tools">
                                        <button class="btn btn-success"  @click.prevent="newEmployeeModal(Organisation.id)">Add New Employee
                                            <i class="fas fa-plus fw"></i>
                                        </button>
                                </div>
                            </div>
                            <div class="card-body">
                                 <div class="row" v-for="employee in Organisation.organisationemployees" :key="employee.id">
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
                                                {{Organisation.name}},
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

                <div class="card">
                    <div class="card-header p-2">
                      <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a href="#about_us" class="nav-link" data-toggle="tab"
                                title="About Us Pages" aria-expanded="true">
                                <i class="fa fa-newspaper red">About Us Page </i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#services" class="nav-link" data-toggle="tab"
                                title="Services Pages" aria-expanded="true">
                                <i class="fa fa-newspaper red">Services Page </i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#features" class="nav-link" data-toggle="tab"
                                title="Features Pages" aria-expanded="true">
                                <i class="fa fa-newspaper red">Features Page </i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#adverts" class="nav-link" data-toggle="tab"
                                title="Adverts Pages" aria-expanded="true">
                                <i class="fa fa-newspaper red">AdvertsPage </i>
                            </a>
                        </li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                            <div class="tab-content">
                                <!-- /.tab-pane -->
                                <div class="tab-pane active show" id="about_us">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                             <a href="#general_configuration">About Us Settings</a>
                                        </h3>
                                    </div>
                                    <!-- about us -->
                                     <div >
                                         <div class="card" v-if="About <1 ">
                                             <div class="card-body">
                                                <h5 class="card-title text-center">
                                                    Currently the About us setting is not yet set,
                                                     Kindly set it using ,
                                                     <span>
                                                         <button class="btn btn-success" @click.prevent="newAboutModal()" >Add About Us
                                                            <i class="fas fa-plus fw"></i>
                                                        </button>
                                                     </span>
                                                </h5>
                                             </div>
                                         </div>
                                        <div class="card" v-else>
                                            <div class="row">
                                                <div class="col-md-4" >
                                                    <div class="card-body">
                                                        <img :src="aboutLoadFrontImage(About.front_image)" alt="" width="250px" >
                                                    </div>
                                                </div>
                                                <div class="col-md-8 " >
                                                    <div class="card text-white bg-danger" >
                                                            <div class="card-header">
                                                                <h5 class="card-title text-center">{{About.title}}</h5>
                                                            </div>
                                                            <div class="card-body">
                                                                <h6 class="card-subtitle mb-2 text-muted text-center">{{About.subtitle}}</h6>
                                                                <h5 class="card-title text-center">Why Choose US</h5>
                                                                <p class="card-text">{{About.why_choose_us}}</p>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6" >
                                                    <div class="card text-white bg-info" >
                                                        <div class="card-header">
                                                        <h5 class="card-title text-center">Who We Are</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <p class="card-text">{{About.why_choose_us}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6" >
                                                    <div class="card text-white bg-success mb-3" >
                                                        <div class="card-header">
                                                            <h5 class="card-title text-center">What We Do</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <p class="card-text">{{About.what_we_do}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="float-right">
                                                    <a href="" class="card-link" @click.prevent="editAboutModal(About.id)">
                                                         <i class="fa fa-edit blue"> Edit</i>
                                                    </a>
                                                    <!-- <a href="" class="card-link" @click.prevent="deleteAbout(about.id)">
                                                        <i class="fa fa-trash red"></i>
                                                    </a> -->
                                                </div>
                                                <div class="float-left">
                                                    <a href="#about_us" class="card-link" v-if="About.user">Updated BY: {{About.user.full_name}}</a>
                                                    <a href="#about_us" class="card-link">Updated On: {{About.updated_at | dateformat}}</a>
                                                </div>
                                            </div>
                                        </div>
                                     </div>
                                </div>
                                <div class="tab-pane" id="services">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                             <a href="#advert">Service Settings</a>
                                        </h3>
                                        <div class="card-tools" v-if="Services.length >0 ">
                                                <button class="btn btn-success" @click.prevent="newServiceModal()" >Add new Service
                                                    <i class="fas fa-plus fw"></i>
                                                </button>
                                        </div>
                                         <!-- service -->
                                    </div>
                                     <div class="card" v-if="Services.length <1 ">
                                          <div class="card-body">
                                            <h5 class="card-title text-center">
                                                Currently the Services setting is not yet set,
                                                Kindly set it using ,
                                                <span>
                                                    <button class="btn btn-success" @click.prevent="newServiceModal()" >Add new Service
                                                       <i class="fas fa-plus fw"></i>
                                                    </button>
                                                </span>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="card" v-else>
                                        <div class="row ">
                                                 <div  v-for="service in Services" :key="service.id" class="col-md-3 d-flex">
                                                    <div class="card flex-fill" >
                                                            <img class="card-img-top " :src="serviceLoadImage(service.service_image)" style="width:100%;height:150px;">
                                                        <div class="card-body" >
                                                                <h5 class="card-title text-center">{{service.title}}</h5>
                                                            <h6 class="card-title text-center">{{service.service_title}}</h6>
                                                            <p style="margin-bottom:-0.5em" class="card-text">{{service.service_details | sortlength(80, "...") }}</p>
                                                        </div>
                                                            <router-link  :to="`/service/${service.id}`" class="pull-right blue">View and Add new Service Models <i class="icon-angle-right"></i></router-link>
                                                        <div class="clearfix">
                                                            <span class="float-left" style="margin-bottom:-0.5em" >
                                                                <p style="margin-bottom:-0.5em">
                                                                    <small class="text-muted">Updated By: {{service.user.full_name}}</small>
                                                                </p>
                                                                <p style="margin-bottom:0.25em">
                                                                    <small class="text-muted">On: {{service.updated_at | dateformat}}</small>
                                                                </p>
                                                            </span>
                                                            <span class="float-right">
                                                                <a href=""  @click.prevent="editServiceModal(service.id)">
                                                                    <i class="fa fa-edit blue"></i>
                                                                </a>
                                                                /
                                                                <a href=""  @click.prevent="deleteService(service.id)">
                                                                    <i class="fa fa-trash red"></i>
                                                                </a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class="pagination" style="padding: 0px;margin: 0px;">
                                                        <!-- {{ $fulltime_courses->links()}} -->
                                                </ul>
                                            </div>
                                            <!--end service  -->
                                    </div>
                                </div>
                                <div class="tab-pane" id="features">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                             <a href="#features">System Features Settings</a>
                                        </h3>
                                        <div class="card-tools" v-if="Features.length >0 ">
                                                <button class="btn btn-success" @click.prevent="newFeatureModal()" >Add new System Feature
                                                    <i class="fas fa-plus fw"></i>
                                                </button>
                                        </div>
                                        <div class="card" v-if="Features.length <1 ">
                                          <div class="card-body">
                                            <h5 class="card-title text-center">
                                                Currently the Features setting is not yet set,
                                                Kindly set it using ,
                                                <span>
                                                    <button class="btn btn-success" @click.prevent="newFeatureModal()" >Add new Feature
                                                       <i class="fas fa-plus fw"></i>
                                                    </button>
                                                </span>
                                            </h5>
                                          </div>
                                        </div>
                                            <!-- feature -->
                                        <div class="card" v-else>
                                            <div class="row ">
                                                <div  v-for="feature in Features" :key="feature.id" class="col-md-3 d-flex">
                                                    <div class="card flex-fill" >
                                                            <img class="card-img-top " :src="featureLoadImage(feature.image)" style="width:100%;height:150px;">
                                                        <div class="card-body" >
                                                            <h5 class="card-title text-center">{{feature.title}}</h5>
                                                            <p style="margin-bottom:-0.5em" class="card-text">{{feature.details }}</p>
                                                            <!-- <p style="margin-bottom:-0.5em" class="card-text">{{feature.why | sortlength(80, "...") }}</p> -->
                                                        </div>
                                                            <!-- <router-link  :to="`/feature/${feature.id}`" class="pull-right blue">Read More <i class="icon-angle-right"></i></router-link> -->
                                                        <div class="clearfix">
                                                            <span class="float-left" style="margin-bottom:-0.5em" >
                                                                <p style="margin-bottom:-0.5em">
                                                                    <small class="text-muted">Updated By: {{feature.user.full_name}}</small>
                                                                </p>
                                                                <p style="margin-bottom:0.25em">
                                                                    <small class="text-muted">On: {{feature.updated_at | dateformat}}</small>
                                                                </p>
                                                            </span>
                                                            <span class="float-right">
                                                                <a href=""  @click.prevent="editFeatureModal(feature.id)">
                                                                    <i class="fa fa-edit blue"></i>
                                                                </a>
                                                                /
                                                                <a href=""  @click.prevent="deleteFeature(feature.id)">
                                                                    <i class="fa fa-trash red"></i>
                                                                </a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class="pagination" style="padding: 0px;margin: 0px;">
                                                        <!-- {{ $fulltime_courses->links()}} -->
                                                </ul>
                                            </div>
                                        </div>
                                            <!--end feature  -->
                                    </div>
                                </div>
                                <div class="tab-pane" id="adverts">
                                     <div class="card-header">
                                        <h3 class="card-title">
                                             <a href="#advert">Advert Settings</a>
                                        </h3>
                                        <div class="card-tools" v-if="Adverts.length >0 ">
                                                <button class="btn btn-success" @click.prevent="newAdvertodal()" >Add new Advert
                                                    <i class="fas fa-plus fw"></i>
                                                </button>
                                        </div>
                                        <div class="card" v-if="Adverts.length <1 ">
                                          <div class="card-body">
                                            <h5 class="card-title text-center">
                                                Currently the Adverts setting is not yet set,
                                                Kindly set it using ,
                                                <span>
                                                    <button class="btn btn-success" @click.prevent="newAdvertModal()" >Add new Advert
                                                       <i class="fas fa-plus fw"></i>
                                                    </button>
                                                </span>
                                            </h5>
                                          </div>
                                        </div>
                                         <!-- Advert -->
                                          <div class="card" v-else>
                                            <div class="row ">
                                                 <div  v-for="advert in Adverts" :key="advert.id" class="col-md-3 d-flex">
                                                    <div class="card flex-fill" >
                                                            <img class="card-img-top " :src="advertLoadImage(advert.advert_image)" style="width:100%;height:150px;">
                                                        <div class="card-body" >
                                                            <h5 class="card-title text-center">{{advert.title}}</h5>
                                                            <h6 class="card-title text-center">{{advert.subtitle}}</h6>
                                                            <p style="margin-bottom:-0.5em" class="card-text">{{advert.details | sortlength(80, "...") }}</p>
                                                        </div>
                                                            <router-link  :to="`/advert/${advert.id}`" class="pull-right blue">Read More <i class="icon-angle-right"></i></router-link>
                                                        <div class="clearfix">
                                                            <span class="float-left" style="margin-bottom:-0.5em" >
                                                                <p style="margin-bottom:-0.5em">
                                                                    <small class="text-muted">Updated By: {{advert.user.full_name}}</small>
                                                                </p>
                                                                <p style="margin-bottom:0.25em">
                                                                    <small class="text-muted">On: {{advert.updated_at | dateformat}}</small>
                                                                </p>
                                                            </span>
                                                            <span class="float-right">
                                                                <a href=""  @click.prevent="editAdvertModal(advert.id)">
                                                                    <i class="fa fa-edit blue"></i>
                                                                </a>
                                                                /
                                                                <a href=""  @click.prevent="deleteAdvert(advert.id)">
                                                                    <i class="fa fa-trash red"></i>
                                                                </a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class="pagination" style="padding: 0px;margin: 0px;">
                                                        <!-- {{ $fulltime_courses->links()}} -->
                                                </ul>
                                            </div>
                                          </div>
                                            <!--end Advert  -->
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-content -->
                    </div>
                </div>
                <!-- /.nav-tabs-custom -->
        </div>
        <!-- Role Modal -->
        <div class="modal fade " id="OrganisationModal" tabindex="-1" role="dialog" aria-labelledby="OrganisationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form role="form" @submit.prevent="editmodeOrganisation ? updateOrganisation(organisationform.id) : addOrganisation ()" >
                        <div class="modal-body">
                            <h5 class="modal-title" v-show="editmodeOrganisation" id="OrganisationModalLabel">Update Organisation</h5>
                            <!-- <h5 class="modal-title" v-show="!editmodeOrganisation" id="OrganisationModalLabel">Add New Organisation & Director</h5> -->
                                <div class=" row">
                                    <div class="form-group col-md-4">
                                        <label for="name" class="col-form-label"> Organisation Name</label>
                                        <input v-model="organisationform.name" type="text" name="name" placeholder="Organisation Name"
                                            class="form-control" :class="{ 'is-invalid': organisationform.errors.has('name') }" >
                                        <has-error style="color: #e83e8c" :form="organisationform" field="name"></has-error>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="organisation_email" class=" col-form-label">Email </label>
                                        <input v-model="organisationform.organisation_email" type="email" name="organisation_email" placeholder="Email Address"
                                            class="form-control" :class="{ 'is-invalid': organisationform.errors.has('organisation_email') }" >
                                        <has-error style="color: #e83e8c" :form="organisationform" field="organisation_email"></has-error>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="phone" class="col-form-label"> Organisation Phone</label>
                                            <div>
                                                <vue-tel-input v-model="organisationform.phone" name="phone" @onInput="OrganisationInputPhone"
                                                class="form-control" :class="{ 'is-invalid': organisationform.errors.has('phone') }">
                                                </vue-tel-input>
                                                <has-error style="color: #e83e8c" :form="organisationform" field="phone"></has-error>
                                            </div>
                                            <div v-if="organisationform.phone" style="color: #e83e8c">
                                                <span>Is valid: <strong>{{phone1.isValid}}</strong>,&nbsp;</span>
                                                <span>Country: <strong>{{phone1.country}}</strong></span>
                                        </div>
                                    </div>
                                </div>
                                <div class=" row">
                                    <div class="form-group col-md-4">
                                        <label for="landline" class=" col-form-label">Landline</label>
                                            <vue-tel-input v-model="organisationform.landline" name="landline" @onInput="OrganisationInputLandline"
                                                class="form-control" :class="{ 'is-invalid': organisationform.errors.has('landline') }">
                                            </vue-tel-input>
                                            <has-error style="color: #e83e8c" :form="organisationform" field="landline"></has-error>

                                            <div v-if="organisationform.landline" style="color: #e83e8c">
                                                <span>Is valid: <strong>{{landline1.isValid}}</strong>,&nbsp;</span>
                                                <span>Country: <strong>{{landline1.country}}</strong></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="website" class="col-form-label">Website</label>
                                        <input v-model="organisationform.website" type="text" name="website" placeholder="Website"
                                            class="form-control" :class="{ 'is-invalid': organisationform.errors.has('website') }" >
                                        <has-error style="color: #e83e8c" :form="organisationform" field="website"></has-error>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="address" class=" col-form-label">address</label>
                                        <input v-model="organisationform.address" type="text" name="Address" placeholder="Address"
                                            class="form-control" :class="{ 'is-invalid': organisationform.errors.has('address') }" >
                                        <has-error style="color: #e83e8c" :form="organisationform" field="address"></has-error>
                                    </div>
                                </div>
                                <div class=" row">
                                    <div class="form-group col-md-3">
                                        <label for="country_id">Select Country</label>
                                        <select class="form-control" @change="countryCounties(organisationform.country_id)"
                                        v-model="organisationform.country_id" :class="{ 'is-invalid': organisationform.errors.has('country_id') }">
                                                <option disabled value="">Select Country</option>
                                                <option v-for="country in Countries" :value="country.id" :key="country.id">{{country.name}}</option>
                                        </select>
                                            <has-error style="color: #e83e8c" :form="organisationform" field="country_id"></has-error>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="county_id" class=" col-form-label">County</label>
                                        <select class="form-control" @change="countyConstituencies(organisationform.county_id)"
                                        v-model="organisationform.county_id" :class="{ 'is-invalid': organisationform.errors.has('county_id') }">
                                                <option disabled value="">Select County</option>
                                                <option v-for="county in Counties" :value="county.id" :key="county.id">{{county.name}}</option>
                                        </select>
                                        <has-error style="color: #e83e8c" :form="organisationform" field="county_id"></has-error>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="constituency_id" class=" col-form-label">Constituency</label>
                                        <select class="form-control" @change="constituencyWards(organisationform.constituency_id)"
                                        v-model="organisationform.constituency_id" :class="{ 'is-invalid': organisationform.errors.has('constituency_id') }">
                                                <option disabled value="">Select County</option>
                                                <option v-for="constituency in Constituencies" :value="constituency.id" :key="constituency.id">{{constituency.name}}</option>
                                        </select>
                                        <has-error style="color: #e83e8c" :form="organisationform" field="constituency_id"></has-error>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="ward_id" class="col-form-label"> Ward </label>
                                        <select class="form-control"
                                        v-model="organisationform.ward_id" :class="{ 'is-invalid': organisationform.errors.has('ward_id') }">
                                                <option disabled value="">Select Town</option>
                                                <option v-for="ward in Wards" :value="ward.id" :key="ward.id">{{ward.name}}</option>
                                        </select>
                                        <has-error style="color: #e83e8c" :form="organisationform" field="ward_id"></has-error>
                                    </div>
                                </div>
                                <div class=" row">
                                    <div class="form-group col-md-6">
                                        <label for="logo" class=" col-form-label">Organisation Logo</label><br>
                                            <input @change="organisationChangeLogo($event)" type="file" name="logo"
                                                :class="{ 'is-invalid': organisationform.errors.has('logo') }">
                                                <img v-show="editmodeOrganisation" :src="updateOrganisationLogo(organisationform.logo)" alt="" width="100%" >
                                                <img  v-show="!editmodeOrganisation" :src="organisationform.logo" alt="" width="100%" >
                                            <has-error style="color: #e83e8c" :form="organisationform" field="logo"></has-error>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editmodeOrganisation" type="submit" class="btn btn-success">Update</button>
                            <button v-show="!editmodeOrganisation" type="submit" class="btn btn-primary">Create</button>
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
                    <form role="form" @submit.prevent="editmodeDirector ? updateDirector(directorform.id) : addDirector(Organisation.id)" >
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
                    <div class="modal-body" v-for="director in Director.organisationdirectors" :key="director.id">
                        <div class="card card-widget widget-user" >
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header text-white" style="background: url('assets/organisation/img/background/background-1.jpg')
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
                                                        <!-- organisation name -->
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
                    <form role="form" @submit.prevent="editmodeAdmin ? updateAdmin(adminform.id) : addAdmin(Organisation.id)" >
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
                    <div class="modal-body" v-for="admin in Admin.organisationadmins" :key="admin.id">
                        <div class="card card-widget widget-user" >
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header text-white" style="background: url('assets/organisation/img/background/background-1.jpg')
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
                                                        <!-- organisation name -->
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
                    <form role="form" @submit.prevent="editmodeEmployee ? updateEmployee(employeeform.id) : addEmployee(Organisation.id)" >
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
                    <div class="modal-body" v-for="employee in Employee.organisationemployees" :key="employee.id">
                        <div class="card card-widget widget-user" >
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header text-white" style="background: url('assets/organisation/img/background/background-1.jpg')
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

        <div class="modal fade " id="AboutModal" tabindex="-1" role="dialog" aria-labelledby="AboutModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="editmodeAbout" id="AboutModalLabel">Update About Us</h5>
                        <h5 class="modal-title" v-show="!editmodeAbout" id="AboutModalLabel">Add New About Us</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form role="form" @submit.prevent="editmodeAbout ? updateAbout(aboutform.id) : addAbout()" >
                        <div class="modal-body">
                            <div class=" row">
                                 <div class="form-group col-md-6">
                                    <label for="title" class="col-form-label">Title</label>
                                    <input v-model="aboutform.title" type="text" name="title" placeholder="Title"
                                        class="form-control" :class="{ 'is-invalid': aboutform.errors.has('title') }" >
                                    <has-error style="color: #e83e8c" :form="aboutform" field="title"></has-error>
                                </div>
                                 <div class="form-group col-md-6">
                                    <label for="subtitle" class="col-form-label">subtitle</label>
                                    <input v-model="aboutform.subtitle" type="text" name="subtitle" placeholder="subtitle"
                                        class="form-control" :class="{ 'is-invalid': aboutform.errors.has('subtitle') }" >
                                    <has-error style="color: #e83e8c" :form="aboutform" field="subtitle"></has-error>
                                </div>
                            </div>
                            <div class=" row">
                                <div class="form-group col-md-6">
                                    <label for="why_choose_us" class="col-form-label">why_choose_us</label>
                                    <textarea v-model="aboutform.why_choose_us" type="text" name="why_choose_us" placeholder="why_choose_us"
                                        class="form-control" :class="{ 'is-invalid': aboutform.errors.has('why_choose_us') }" >
                                    </textarea>
                                    <has-error style="color: #e83e8c" :form="aboutform" field="why_choose_us"></has-error>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="who_we_are" class="col-form-label">who_we_are</label>
                                    <textarea v-model="aboutform.who_we_are" type="text" name="who_we_are" placeholder="who_we_are"
                                        class="form-control" :class="{ 'is-invalid': aboutform.errors.has('who_we_are') }" >
                                    </textarea>
                                    <has-error style="color: #e83e8c" :form="aboutform" field="who_we_are"></has-error>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="what_we_do" class="col-form-label">what_we_do</label>
                                    <textarea v-model="aboutform.what_we_do" type="text" name="what_we_do" placeholder="what_we_do"
                                        class="form-control" :class="{ 'is-invalid': aboutform.errors.has('what_we_do') }" >
                                    </textarea>
                                    <has-error style="color: #e83e8c" :form="aboutform" field="what_we_do"></has-error>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="front_image" class=" col-form-label">About Us Front Image 6</label><br>
                                        <input @change="aboutChangeFrontImage($event)" type="file" name="front_image"
                                            :class="{ 'is-invalid': aboutform.errors.has('front_image') }">

                                            <img v-show="editmodeAbout" :src="updateAboutFrontImage(aboutform.front_image)" alt="" width="100%" >
                                            <img  v-show="!editmodeAbout" :src="aboutform.front_image" alt="" width="100%" >
                                        <has-error style="color: #e83e8c" :form="aboutform" field="front_image"></has-error>
                                </div>

                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editmodeAbout" type="submit" class="btn btn-success">Update</button>
                            <button v-show="!editmodeAbout" type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Service -->
        <div class="modal fade " id="ServiceModal" tabindex="-1" role="dialog" aria-labelledby="ServiceModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="editmodeService" id="ServiceModalLabel">Update Service Us</h5>
                        <h5 class="modal-title" v-show="!editmodeService" id="ServiceModalLabel">Add New Service Us</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form role="form" @submit.prevent="editmodeService ? updateService(serviceform.id) : addService()" >
                        <div class="modal-body">
                            <div class=" row">
                                 <div class="form-group col-md-6">
                                    <label for="title" class="col-form-label">Title</label>
                                    <input v-model="serviceform.title" type="text" name="title" placeholder="Title"
                                        class="form-control" :class="{ 'is-invalid': serviceform.errors.has('title') }" >
                                    <has-error style="color: #e83e8c" :form="serviceform" field="title"></has-error>
                                </div>
                                 <div class="form-group col-md-6">
                                    <label for="service_title" class="col-form-label">Service Title</label>
                                    <input v-model="serviceform.service_title" type="text" name="service_title" placeholder="Service Title"
                                        class="form-control" :class="{ 'is-invalid': serviceform.errors.has('service_title') }" >
                                    <has-error style="color: #e83e8c" :form="serviceform" field="service_title"></has-error>
                                </div>
                            </div>
                            <div class=" row">
                                <div class="form-group col-md-12">
                                    <label for="service_details" class="col-form-label">Service Details</label>
                                    <textarea v-model="serviceform.service_details" type="text" name="service_details" placeholder="Service details"
                                        class="form-control" :class="{ 'is-invalid': serviceform.errors.has('service_details') }" >
                                    </textarea>
                                    <has-error style="color: #e83e8c" :form="serviceform" field="service_details"></has-error>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="service_image" class=" col-form-label">Service Us Front Image 6</label><br>
                                        <input @change="serviceChangeImage($event)" type="file" name="service_image"
                                            :class="{ 'is-invalid': serviceform.errors.has('service_image') }">

                                            <img v-show="editmodeService" :src="updateServiceImage(serviceform.service_image)" alt="" width="100%" >
                                            <img  v-show="!editmodeService" :src="serviceform.service_image" alt="" width="100%" >
                                        <has-error style="color: #e83e8c" :form="serviceform" field="service_image"></has-error>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editmodeService" type="submit" class="btn btn-success">Update</button>
                            <button v-show="!editmodeService" type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Feature -->
        <div class="modal fade " id="FeatureModal" tabindex="-1" role="dialog" aria-labelledby="FeatureModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="editmodeFeature" id="FeatureModalLabel">Update Feature Us</h5>
                        <h5 class="modal-title" v-show="!editmodeFeature" id="FeatureModalLabel">Add New Feature Us</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form role="form" @submit.prevent="editmodeFeature ? updateFeature(featureform.id) : addFeature()" >
                        <div class="modal-body">
                            <div class=" row">
                                 <div class="form-group col-md-6">
                                    <label for="title" class="col-form-label">Title</label>
                                    <input v-model="featureform.title" type="text" name="title" placeholder="Title"
                                        class="form-control" :class="{ 'is-invalid': featureform.errors.has('title') }" >
                                    <has-error style="color: #e83e8c" :form="featureform" field="title"></has-error>
                                </div>
                            </div>
                            <div class=" row">
                                <div class="form-group col-md-12">
                                    <label for="details" class="col-form-label">Details</label>
                                    <textarea v-model="featureform.details" type="text" name="details" placeholder="Details"
                                        class="form-control" :class="{ 'is-invalid': featureform.errors.has('details') }" >
                                    </textarea>
                                    <has-error style="color: #e83e8c" :form="featureform" field="details"></has-error>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="image" class=" col-form-label">Feature Image</label><br>
                                        <input @change="featureChangeImage($event)" type="file" name="image"
                                            :class="{ 'is-invalid': featureform.errors.has('image') }">
                                            <img v-show="editmodeFeature" :src="updateFeatureImage(featureform.image)" alt="" width="100%" >
                                            <img  v-show="!editmodeFeature" :src="featureform.image" alt="" width="100%" >
                                        <has-error style="color: #e83e8c" :form="featureform" field="image"></has-error>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editmodeFeature" type="submit" class="btn btn-success">Update</button>
                            <button v-show="!editmodeFeature" type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Servicemodel -->
        <div class="modal fade " id="ServiceModelModal" tabindex="-1" role="dialog" aria-labelledby="ServiceModelModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="editmodeServiceModel" id="ServiceModelModalLabel">Update ServiceModel Us</h5>
                        <h5 class="modal-title" v-show="!editmodeServiceModel" id="ServiceModelModalLabel">Add New ServiceModel Us</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form role="form" @submit.prevent="editmodeServiceModel ? updateServiceModel(servicemodelform.id) : addServiceModel()" >
                        <div class="modal-body">
                            <div class=" row">
                                 <div class="form-group col-md-6">
                                    <label for="title" class="col-form-label">Title</label>
                                    <input v-model="servicemodelform.title" type="text" name="title" placeholder="Title"
                                        class="form-control" :class="{ 'is-invalid': servicemodelform.errors.has('title') }" >
                                    <has-error style="color: #e83e8c" :form="servicemodelform" field="title"></has-error>
                                </div>
                            </div>
                            <div class=" row">
                                <div class="form-group col-md-12">
                                    <label for="details" class="col-form-label">Details</label>
                                    <textarea v-model="servicemodelform.details" type="text" name="details" placeholder="Details"
                                        class="form-control" :class="{ 'is-invalid': servicemodelform.errors.has('details') }" >
                                    </textarea>
                                    <has-error style="color: #e83e8c" :form="servicemodelform" field="details"></has-error>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="image" class=" col-form-label">Servive Model Image</label><br>
                                        <input @change="servicemodelChangeImage($event)" type="file" name="image"
                                            :class="{ 'is-invalid': servicemodelform.errors.has('image') }">
                                            <img v-show="editmodeServiceModel" :src="updateFeatureImage(servicemodelform.image)" alt="" width="100%" >
                                            <img  v-show="!editmodeServiceModel" :src="servicemodelform.image" alt="" width="100%" >
                                        <has-error style="color: #e83e8c" :form="servicemodelform" field="image"></has-error>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editmodeServiceModel" type="submit" class="btn btn-success">Update</button>
                            <button v-show="!editmodeServiceModel" type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Advert -->
        <div class="modal fade " id="AdvertModal" tabindex="-1" role="dialog" aria-labelledby="AdvertModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="editmodeAdvert" id="AdvertModalLabel">Update Advert Us</h5>
                        <h5 class="modal-title" v-show="!editmodeAdvert" id="AdvertModalLabel">Add New Advert Us</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form role="form" @submit.prevent="editmodeAdvert ? updateAdvert(advertform.id) : addAdvert()" >
                        <div class="modal-body">
                            <div class=" row">
                                 <div class="form-group col-md-6">
                                    <label for="title" class="col-form-label">Title</label>
                                    <input v-model="advertform.title" type="text" name="title" placeholder="Title"
                                        class="form-control" :class="{ 'is-invalid': advertform.errors.has('title') }" >
                                    <has-error style="color: #e83e8c" :form="advertform" field="title"></has-error>
                                </div>
                                 <div class="form-group col-md-6">
                                    <label for="subtitle" class="col-form-label">subtitle</label>
                                    <input v-model="advertform.subtitle" type="text" name="subtitle" placeholder="subtitle"
                                        class="form-control" :class="{ 'is-invalid': advertform.errors.has('subtitle') }" >
                                    <has-error style="color: #e83e8c" :form="advertform" field="subtitle"></has-error>
                                </div>
                            </div>
                            <div class=" row">
                                <div class="form-group col-md-12">
                                    <label for="details" class="col-form-label">details</label>
                                    <textarea v-model="advertform.details" type="text" name="details" placeholder="details"
                                        class="form-control" :class="{ 'is-invalid': advertform.errors.has('details') }" >
                                    </textarea>
                                    <has-error style="color: #e83e8c" :form="advertform" field="details"></has-error>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="advert_image" class=" col-form-label">Advert Us Front Image 6</label><br>
                                        <input @change="advertChangeImage($event)" type="file" name="advert_image"
                                            :class="{ 'is-invalid': advertform.errors.has('advert_image') }">

                                            <img v-show="editmodeAdvert" :src="updateAdvertImage(advertform.advert_image)" alt="" width="100%" >
                                            <img  v-show="!editmodeAdvert" :src="advertform.advert_image" alt="" width="100%" >
                                        <has-error style="color: #e83e8c" :form="advertform" field="advert_image"></has-error>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editmodeAdvert" type="submit" class="btn btn-success">Update</button>
                            <button v-show="!editmodeAdvert" type="submit" class="btn btn-primary">Create</button>
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
               newOrganisationDirector: false,
                editmodeOrganisation: false,
                organisationOutput:'',//view form data and confirm if is ok before submit
                organisationform: new Form({
                        id:'',
                        name:'',
                        organisation_email:'',
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
                        director_type:'',
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
                        admin_type:'',
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
                        admin_type:'',
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


                editmodeAbout: false,
                aboutform: new Form({
                        id:'',
                        user_id:'',
                        organisation_id:'',
                        title:'',
                        subtitle:'',
                        front_image:'',
                        why_choose_us:'',
                        who_we_are:'',
                        what_we_do:'',
                }),
                editmodeService: false,
                serviceform: new Form({
                        id:'',
                        title:'',
                        service_title:'',
                        service_details:'',
                        service_image:'',
                }),
                editmodeAdvert: false,
                advertform: new Form({
                        id:'',
                        title:'',
                        subtitle:'',
                        details:'',
                        advert_image:'',
                }),
                editmodeFeature: false,
                featureform: new Form({
                        id:'',
                        organisation_id:'',
                        title:'',
                        details:'',
                        image:'',
                }),
                editmodeServiceModel: false,
                servicemodelform: new Form({
                        id:'',
                        service_id:'',
                        title:'',
                        details:'',
                        image:'',
                }),
            }
        },
        mounted() {
            this.loadCountries();
            this.loadCounties();
            this.loadConstituencies();///linked to methods and actions store
            this.loadWards();///linked to methods and actions store
            this.loadOrganisation();
            this.loadAbout();
            this.loadServices();
            this.loadFeatures();
            this.loadServiceModel();
            this.loadAdverts();

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
            Organisation(){
               return this.$store.getters.Organisation
            },
            Director(){
                console.log(this.$store.getters.director)
               return this.$store.getters.director//reminder to updater index
            },
            Admin(){
                console.log(this.$store.getters.Admin)
               return this.$store.getters.Admin//reminder to updater index
            },
            Employee(){
                console.log(this.$store.getters.Employee)
               return this.$store.getters.Employee//reminder to updater index
            },
            About(){
               return this.$store.getters.About
            },
            Services(){
               return this.$store.getters.Services
            },
            Features(){
               return this.$store.getters.Features
            },
            ServiceModel(){
               return this.$store.getters.ServiceModel
            },
            Adverts(){
               return this.$store.getters.Adverts
            },
        },
        methods:{
            // phone and landline
            //Organisation
            OrganisationInputPhone({ number, isValid, country }) {
            console.log(number, isValid, country);
            this.organisationform.phone = number;
            this.phone1.isValid = isValid;
            this.phone1.country = country && country.name;
            },
            OrganisationInputLandline({ number, isValid, country }) {
            console.log(number, isValid, country);
            this.organisationform.landline = number;
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
            //Organisation verification
            validateOrganisation() {
                this.$Progress.start()
                return this.organisationform.post('/organisation/verify/info')
                    .then((response)=>{
                        return true;
                        toast({
                            type: 'success',
                            title: 'Organisation Info Verifed successfully'
                        })
                        this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        toast({
                            type: 'error',
                            title: 'The Organisation Info failed Verification.'
                        })
                    })
            },
            //Director info verification
            validateDirector() {
                this.$Progress.start()
                this.organisationOutput = this.organisationform;  //append form data
                return this.organisationform.post('/organisation/verify/director')
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
            //Organisation verification
            validateOrganisationUpdate() {
                let id = this.organisationform.id;
                console.log('first',id);
                this.$Progress.start()
                return this.organisationform.patch('/organisation/updateverify/info/'+id)
                    .then((response)=>{
                        return true;
                        toast({
                            type: 'success',
                            title: 'Organisation update Info Verifed successfully'
                        })
                        this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        toast({
                            type: 'error',
                            title: 'The Organisation update Info failed Verification.'
                        })
                    })
            },
            //Director info verification
            validateDirectorUpdate() {
                 let id = this.organisationform.id;
                console.log('mix me down',id);
                this.$Progress.start()
                // console.log('mis me down')
                // this.organisationOutput = this.organisationform;  //append form data
                return this.organisationform.patch('/organisation/updateverify/director/'+id)
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
            loadOrganisation(){
                return this.$store.dispatch( "organisation")//get all from organisation. organisation linked to user
            },

            loadAbout(){
                return this.$store.dispatch( "about")
            },
            loadAdverts(){
                return this.$store.dispatch( "adverts")
            },
            loadServices(){
                return this.$store.dispatch( "services")
            },
            loadFeatures(){
                return this.$store.dispatch( "features")
            },
            loadServiceModel(){
                return this.$store.dispatch( "servicemodels")
            },

            //Organisation
            validateOrganisation() {
                this.$Progress.start()
                return this.organisationform.post('/organisation/verify/info')
                    .then((response)=>{
                        return true;
                        toast({
                            type: 'success',
                            title: 'Organisation Info Verifed successfully'
                        })
                        this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        toast({
                            type: 'error',
                            title: 'The Organisation Info failed Verification.'
                        })
                    })
            },
            //Director info verification
            validateDirector() {
                this.$Progress.start()
                this.organisationOutput = this.organisationform;  //append form data
                return this.organisationform.post('/organisation/verify/director')
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
            //Organisation verification
            validateOrganisationUpdate() {
                let id = this.organisationform.id;
                console.log('first',id);
                this.$Progress.start()
                return this.organisationform.patch('/organisation/updateverify/info/'+id)
                    .then((response)=>{
                        return true;
                        toast({
                            type: 'success',
                            title: 'Organisation update Info Verifed successfully'
                        })
                        this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        toast({
                            type: 'error',
                            title: 'The Organisation update Info failed Verification.'
                        })
                    })
            },
            //Director info verification
            validateDirectorUpdate() {
                 let id = this.organisationform.id;
                console.log('mix me down',id);
                this.$Progress.start()
                // console.log('mis me down')
                // this.organisationOutput = this.organisationform;  //append form data
                return this.organisationform.patch('/organisation/updateverify/director/'+id)
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
            organisationChangeLogo(event){
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
                            this.organisationform.logo =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            organisationLoadLogo(logo_id){
                 if(logo_id){
                    return "assets/organisation/img/logo/"+logo_id;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            updateOrganisationLogo(organisationformlogo){
                console.log(organisationformlogo)
                let img = this.organisationform.logo;
                      if(img ==null){
                          return "/assets/organisation/img/website/empty.png";
                        //  console.log('its reall null')
                      }else{
                          if(img.length>100){
                            return this.organisationform.logo;
                        }else{
                            if(organisationformlogo){
                                return "assets/organisation/img/logo/"+organisationformlogo;
                            }else{
                                return "/assets/organisation/img/website/empty.png";
                            }
                        }
                      }

            },
            editOrganisationModal(id){

                 this.editmodeOrganisation = true;
                 this.organisationform.reset()
                   console.log('edit organisationanisaton', id)
                    this.$Progress.start();
                      axios.get('/organisation/edit/'+id)
                        .then((response)=>{
                           $('#OrganisationModal').modal('show')
                           toast({
                            type: 'success',
                            title: 'Fetched the Organisation data successfully'
                            })
                            this.organisationform.fill(response.data.organisation);
                            //get country id
                            this.organisationform.country_id = response.data.organisation.country.id;
                            //get county id using the country id
                            this.organisationform.county_id = response.data.organisation.county.id
                            this.$store.dispatch('countrycounties', response.data.organisation.country.id);
                            //get contituency using county id
                            this.organisationform.constituency_id = response.data.organisation.constituency.id
                            this.$store.dispatch('countyconstituencies', response.data.organisation.county.id);
                            //get ward usng constituency id
                            this.organisationform.ward_id = response.data.organisation.ward.id
                            this.$store.dispatch('constituencywards', response.data.organisation.constituency.id);

                            this.$Progress.finish();

                        })
                        .catch(()=>{
                            this.$Progress.fail();
                            //errors
                            $('#OrganisationModal').modal('show');
                            toast({
                            type: 'error',
                            title: 'There was something Wrong'
                            })
                        })
            },
            addOrganisation(){
                console.log('add Organisation new')
                this.$Progress.start();
                this.organisationform.post('/organisation')
                    .then((response)=>{
                         toast({
                            type: 'success',
                            title: 'Organisation Created successfully'
                            })
                            this.$store.dispatch( "organisation")
                            this.$store.dispatch( "about")
                            this.$store.dispatch( "services")

                            $('#OrganisationModal').modal('hide')
                            this.organisationform.reset()
                              this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        //errors
                            $('#OrganisationModal').modal('show');
                            toast({
                                type: 'error',
                                title: 'There was something wrong.'
                                })
                    })
            },
            updateOrganisation(id){
                  console.log('update organisationanisaton')
                  this.$Progress.start();
                     this.organisationform.patch('/organisation/update/'+id)
                        .then(()=>{
                            this.$store.dispatch('organisation', id);
                            this.$store.dispatch( "about")

                         $('#OrganisationModal').modal('hide')
                         toast({
                            type: 'success',
                            title: 'User Created successfully'
                            })
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                            $('#OrganisationModal').modal('show')
                            toast({
                            type: 'error',
                            title: 'There was something wrong'
                            })
                        })
            },
            deleteOrganisation(id){
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
                        this.organisationform.get('/organisation/delete/'+id)
                            .then(()=>{
                            toast({
                            type: 'success',
                            title: 'Organisation Deleted successfully'
                            })
                            this.$store.dispatch( "organisation")
                            this.$store.dispatch( "about")

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
            newDirectorModal(organisation_id){
                console.log(organisation_id)
                 this.editmodeDirector= false;
                 this.directorform.reset()
                 this.directorform.organisation_id;
                     $('#DirectorModal').modal('show')
            },
            //organisation director passposrt image
            directorLoadPassPhoto(directorpivot_photo){
                if(directorpivot_photo){
                    return "/assets/organisation/img/directors/passports/"+directorpivot_photo;
                }else{
                    return "/assets/organisation/img/website/empty.png";
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
                          return "/assets/organisation/img/website/empty.png";
                        //  console.log('its reall null')
                      }else{
                          if(img.length>100){
                            return this.directorform.photo;
                        }else{
                            if(directorform_organisationdirector_photo){
                                return "assets/organisation/img/directors/passports/"+directorform_organisationdirector_photo;
                            }else{
                                return "/assets/organisation/img/website/empty.png";
                            }
                        }
                      }

            },
            directorLoadIDFrontPhoto(directorpivot_id_photo_front){
                if(directorpivot_id_photo_front){
                    return "/assets/organisation/img/directors/IDs/front/"+directorpivot_id_photo_front;
                }else{
                    return "/assets/organisation/img/website/empty.png";
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
                          return "/assets/organisation/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.directorform.id_photo_front;
                        }else{
                            if(directorform_id_photo_front){
                                return "assets/organisation/img/directors/IDs/front/"+directorform_id_photo_front;
                            }else{
                                return "/assets/organisation/img/website/empty.png";
                            }
                        }
                      }

            },
            directorLoadIDBackPhoto(directorform_id_photo_back){
                if(directorform_id_photo_back){
                    return "/assets/organisation/img/directors/IDs/back/"+directorform_id_photo_back;
                }else{
                    return "/assets/organisation/img/website/empty.png";
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
                          return "/assets/organisation/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.directorform.id_photo_back;
                        }else{
                            if(directorform_id_photo_back){
                                return "assets/organisation/img/directors/IDs/back/"+directorform_id_photo_back;
                            }else{
                                return "/assets/organisation/img/website/empty.png";
                            }
                        }
                      }

            },
            viewDirectorModal(id){
                console.log(id)
                this.$Progress.start();
                    //get bueau director by id
                this.$store.dispatch('DirectorById', id)  //action from index.js
                    .then((response)=>{
                       $('#ViewDirectorModal').modal('show')
                       toast({
                        type: 'success',
                        title: 'Fetched the Organisation Director data successfully'
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
                      axios.get('/orgdirector/edit/'+id)
                        .then((response)=>{
                           $('#DirectorModal').modal('show')
                           toast({
                            type: 'success',
                            title: 'Fetched the Director data successfully'
                            })
                            console.log(response.data)
                            this.directorform.fill(response.data.director)
                            this.directorform.user_id = response.data.director.organisationdirectors[0].pivot.user_id
                            this.directorform.organisation_id = response.data.director.organisationdirectors[0].pivot.organisation_id
                            // // this.directorform.position_id = response.data.director.organisationdirectors[0].pivot.position_id
                            this.directorform.photo = response.data.director.organisationdirectors[0].pivot.photo
                            this.directorform.id_no = response.data.director.organisationdirectors[0].pivot.id_no
                            this.directorform.id_photo_front = response.data.director.organisationdirectors[0].pivot.id_photo_front
                            this.directorform.id_photo_back = response.data.director.organisationdirectors[0].pivot.id_photo_back
                            this.directorform.phone = response.data.director.organisationdirectors[0].pivot.phone
                            this.directorform.landline = response.data.director.organisationdirectors[0].pivot.landline
                            this.directorform.address = response.data.director.organisationdirectors[0].pivot.address

                        // //    //get country id
                            this.directorform.country_id = response.data.director.organisationdirectors[0].pivot.country_id
                            //get county id using the country id
                            this.directorform.county_id = response.data.director.organisationdirectors[0].pivot.county_id
                            this.$store.dispatch('countrycounties', response.data.director.organisationdirectors[0].pivot.country_id);
                            //get contituency using county id
                            this.directorform.constituency_id = response.data.director.organisationdirectors[0].pivot.constituency_id
                            this.$store.dispatch('countyconstituencies', response.data.director.organisationdirectors[0].pivot.county_id);
                            // //get ward usng constituency id
                            this.directorform.ward_id = response.data.director.organisationdirectors[0].pivot.ward_id
                            this.$store.dispatch('constituencywards', response.data.director.organisationdirectors[0].pivot.constituency_id);
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
            addDirector(Organisation_id) {
                // let organisation = this.$store.getters.Organisation[0];
                console.log(Organisation_id)
                this.$Progress.start();
                this.directorform.patch('/orgdirector/'+Organisation_id)
                    .then((response)=>{
                        //  console.log(response.data)
                         toast({
                            type: 'success',
                            title: 'Director Created successfully'
                            })
                             this.$store.dispatch('organisation');
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
                     this.directorform.patch('/orgdirector/update/'+id)
                        .then(()=>{
                        this.$store.dispatch('organisation');
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
                        this.directorform.get('/orgdirector/delete/'+id)
                            .then(()=>{
                            toast({
                            type: 'success',
                            title: 'Director Deleted successfully'
                            })
                            this.$store.dispatch('organisation');
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
            newAdminModal(organisation_id){
                console.log(organisation_id)
                 this.editmodeAdmin= false;
                 this.adminform.reset()
                 this.adminform.organisation_id;
                     $('#AdminModal').modal('show')
            },
            //organisation admin passposrt image
            adminLoadPassPhoto(adminpivot_photo){
                if(adminpivot_photo){
                    return "/assets/organisation/img/admins/passports/"+adminpivot_photo;
                }else{
                    return "/assets/organisation/img/website/empty.png";
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
            updateAdminPassPhoto(adminform_organisationadmin_photo){
                // console.log(adminform_organisationadmin_photo)
                let img = this.adminform.photo;
                      if(img ==null){
                          return "/assets/organisation/img/website/empty.png";
                        //  console.log('its reall null')
                      }else{
                          if(img.length>100){
                            return this.adminform.photo;
                        }else{
                            if(adminform_organisationadmin_photo){
                                return "assets/organisation/img/admins/passports/"+adminform_organisationadmin_photo;
                            }else{
                                return "/assets/organisation/img/website/empty.png";
                            }
                        }
                      }

            },
            adminLoadIDFrontPhoto(adminpivot_id_photo_front){
                if(adminpivot_id_photo_front){
                    return "/assets/organisation/img/admins/IDs/front/"+adminpivot_id_photo_front;
                }else{
                    return "/assets/organisation/img/website/empty.png";
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
                          return "/assets/organisation/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.adminform.id_photo_front;
                        }else{
                            if(adminform_id_photo_front){
                                return "assets/organisation/img/admins/IDs/front/"+adminform_id_photo_front;
                            }else{
                                return "/assets/organisation/img/website/empty.png";
                            }
                        }
                      }

            },
            adminLoadIDBackPhoto(adminform_id_photo_back){
                if(adminform_id_photo_back){
                    return "/assets/organisation/img/admins/IDs/back/"+adminform_id_photo_back;
                }else{
                    return "/assets/organisation/img/website/empty.png";
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
                          return "/assets/organisation/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.adminform.id_photo_back;
                        }else{
                            if(adminform_id_photo_back){
                                return "assets/organisation/img/admins/IDs/back/"+adminform_id_photo_back;
                            }else{
                                return "/assets/organisation/img/website/empty.png";
                            }
                        }
                      }

            },
            viewAdminModal(id){
                console.log(id)
                this.$Progress.start();
                    //get bueau admin by id
                this.$store.dispatch('AdminById', id)  //action from index.js
                    .then((response)=>{
                       $('#ViewAdminModal').modal('show')
                       toast({
                        type: 'success',
                        title: 'Fetched the Organisation Admin data successfully'
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
                      axios.get('/orgadmin/edit/'+id)
                        .then((response)=>{
                           $('#AdminModal').modal('show')
                           toast({
                            type: 'success',
                            title: 'Fetched the Admin data successfully'
                            })
                            console.log(response.data)
                            this.adminform.fill(response.data.admin)
                            this.adminform.user_id = response.data.admin.organisationadmins[0].pivot.user_id
                            this.adminform.organisation_id = response.data.admin.organisationadmins[0].pivot.organisation_id
                            // // this.adminform.position_id = response.data.admin.organisationadmins[0].pivot.position_id
                            this.adminform.photo = response.data.admin.organisationadmins[0].pivot.photo
                            this.adminform.id_no = response.data.admin.organisationadmins[0].pivot.id_no
                            this.adminform.id_photo_front = response.data.admin.organisationadmins[0].pivot.id_photo_front
                            this.adminform.id_photo_back = response.data.admin.organisationadmins[0].pivot.id_photo_back
                            this.adminform.phone = response.data.admin.organisationadmins[0].pivot.phone
                            this.adminform.landline = response.data.admin.organisationadmins[0].pivot.landline
                            this.adminform.address = response.data.admin.organisationadmins[0].pivot.address

                        // //    //get country id
                            this.adminform.country_id = response.data.admin.organisationadmins[0].pivot.country_id
                            //get county id using the country id
                            this.adminform.county_id = response.data.admin.organisationadmins[0].pivot.county_id
                            this.$store.dispatch('countrycounties', response.data.admin.organisationadmins[0].pivot.country_id);
                            //get contituency using county id
                            this.adminform.constituency_id = response.data.admin.organisationadmins[0].pivot.constituency_id
                            this.$store.dispatch('countyconstituencies', response.data.admin.organisationadmins[0].pivot.county_id);
                            // //get ward usng constituency id
                            this.adminform.ward_id = response.data.admin.organisationadmins[0].pivot.ward_id
                            this.$store.dispatch('constituencywards', response.data.admin.organisationadmins[0].pivot.constituency_id);
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
            addAdmin(Organisation_id) {
                console.log(Organisation_id)
                this.$Progress.start();
                this.adminform.patch('/orgadmin/'+Organisation_id)
                    .then((response)=>{
                        //  console.log(response.data)
                         toast({
                            type: 'success',
                            title: 'Admin Created successfully'
                            })
                            this.$store.dispatch('organisation');
                            $('#AdminModal').modal('hide')
                            this.$refs.wizard.reset()
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
                     this.adminform.patch('/orgadmin/update/'+id)
                        .then(()=>{
                        this.$store.dispatch('organisation');
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
                        this.adminform.get('/orgadmin/delete/'+id)
                            .then(()=>{
                            toast({
                            type: 'success',
                            title: 'Admin Deleted successfully'
                            })
                             this.$store.dispatch('organisation');
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
            newEmployeeModal(organisation_id){
                console.log(organisation_id)
                 this.editmodeEmployee= false;
                 this.employeeform.reset()
                 this.employeeform.organisation_id;
                     $('#EmployeeModal').modal('show')
            },
            //organisation employee passposrt image
            employeeLoadPassPhoto(employeepivot_photo){
                if(employeepivot_photo){
                    return "/assets/organisation/img/employees/passports/"+employeepivot_photo;
                }else{
                    return "/assets/organisation/img/website/empty.png";
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
            updateEmployeePassPhoto(employeeform_orgemployee_photo){
                // console.log(employeeform_orgemployee_photo)
                let img = this.employeeform.photo;
                      if(img ==null){
                          return "/assets/organisation/img/website/empty.png";
                        //  console.log('its reall null')
                      }else{
                          if(img.length>100){
                            return this.employeeform.photo;
                        }else{
                            if(employeeform_orgemployee_photo){
                                return "assets/organisation/img/employees/passports/"+employeeform_orgemployee_photo;
                            }else{
                                return "/assets/organisation/img/website/empty.png";
                            }
                        }
                      }

            },
            employeeLoadIDFrontPhoto(employeepivot_id_photo_front){
                if(employeepivot_id_photo_front){
                    return "/assets/organisation/img/employees/IDs/front/"+employeepivot_id_photo_front;
                }else{
                    return "/assets/organisation/img/website/empty.png";
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
                          return "/assets/organisation/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.employeeform.id_photo_front;
                        }else{
                            if(employeeform_id_photo_front){
                                return "assets/organisation/img/employees/IDs/front/"+employeeform_id_photo_front;
                            }else{
                                return "/assets/organisation/img/website/empty.png";
                            }
                        }
                      }

            },
            employeeLoadIDBackPhoto(employeeform_id_photo_back){
                if(employeeform_id_photo_back){
                    return "/assets/organisation/img/employees/IDs/back/"+employeeform_id_photo_back;
                }else{
                    return "/assets/organisation/img/website/empty.png";
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
                          return "/assets/organisation/img/website/empty.png";
                      }else{
                          if(img.length>100){
                            return this.employeeform.id_photo_back;
                        }else{
                            if(employeeform_id_photo_back){
                                return "assets/organisation/img/employees/IDs/back/"+employeeform_id_photo_back;
                            }else{
                                return "/assets/organisation/img/website/empty.png";
                            }
                        }
                      }

            },
            viewEmployeeModal(id){
                console.log(id)
                this.$Progress.start();
                    //get bueau employee by id
                this.$store.dispatch('EmployeeById', id)  //action from index.js
                    .then((response)=>{
                       $('#ViewEmployeeModal').modal('show')
                       toast({
                        type: 'success',
                        title: 'Fetched the Organisation Employee data successfully'
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
                      axios.get('/orgemployee/edit/'+id)
                        .then((response)=>{
                           $('#EmployeeModal').modal('show')
                           toast({
                            type: 'success',
                            title: 'Fetched the Employee data successfully'
                            })
                            console.log(response.data)
                            this.employeeform.fill(response.data.employee)
                            this.employeeform.user_id = response.data.employee.organisationemployees[0].pivot.user_id
                            this.employeeform.organisation_id = response.data.employee.organisationemployees[0].pivot.organisation_id
                            // // this.employeeform.position_id = response.data.employee.organisationemployees[0].pivot.position_id
                            this.employeeform.photo = response.data.employee.organisationemployees[0].pivot.photo
                            this.employeeform.id_no = response.data.employee.organisationemployees[0].pivot.id_no
                            this.employeeform.id_photo_front = response.data.employee.organisationemployees[0].pivot.id_photo_front
                            this.employeeform.id_photo_back = response.data.employee.organisationemployees[0].pivot.id_photo_back
                            this.employeeform.phone = response.data.employee.organisationemployees[0].pivot.phone
                            this.employeeform.landline = response.data.employee.organisationemployees[0].pivot.landline
                            this.employeeform.address = response.data.employee.organisationemployees[0].pivot.address

                        // //    //get country id
                            this.employeeform.country_id = response.data.employee.organisationemployees[0].pivot.country_id
                            //get county id using the country id
                            this.employeeform.county_id = response.data.employee.organisationemployees[0].pivot.county_id
                            this.$store.dispatch('countrycounties', response.data.employee.organisationemployees[0].pivot.country_id);
                            //get contituency using county id
                            this.employeeform.constituency_id = response.data.employee.organisationemployees[0].pivot.constituency_id
                            this.$store.dispatch('countyconstituencies', response.data.employee.organisationemployees[0].pivot.county_id);
                            // //get ward usng constituency id
                            this.employeeform.ward_id = response.data.employee.organisationemployees[0].pivot.ward_id
                            this.$store.dispatch('constituencywards', response.data.employee.organisationemployees[0].pivot.constituency_id);
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
            addEmployee(Organisation_id) {
                console.log(Organisation_id)
                this.$Progress.start();
                this.employeeform.patch('/orgemployee/'+Organisation_id)
                    .then((response)=>{
                        //  console.log(response.data)
                         toast({
                            type: 'success',
                            title: 'Employee Created successfully'
                            })
                             this.$store.dispatch('organisation');
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
                     this.employeeform.patch('/orgemployee/update/'+id)
                        .then(()=>{
                        this.$store.dispatch('organisation');
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
                        this.employeeform.get('/orgemployee/delete/'+id)
                            .then(()=>{
                            toast({
                            type: 'success',
                            title: 'Employee Deleted successfully'
                            })
                            this.$store.dispatch('organisation');
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


            //About
            newAboutModal(){
                this.editmodeAbout = false;
                 this.aboutform.reset()
                     $('#AboutModal').modal('show')
            },
            editAboutModal(id){
                 this.editmodeAbout = true;
                 this.aboutform.reset()
                   console.log('edit about', id)
                    this.$Progress.start();
                      axios.get('/about/edit/'+id)

                        .then((response)=>{
                             console.log(response.data)
                           $('#AboutModal').modal('show')
                           toast({
                            type: 'success',
                            title: 'Fetched the About data successfully'
                            })
                            this.aboutform.fill(response.data.about)
                               this.$Progress.finish();
                        })
                        .catch(()=>{

                            //errors
                            $('#AboutModal').modal('show');
                            toast({
                            type: 'error',
                            title: 'There was something Wrong'
                            })
                            this.$Progress.fail();
                        })
            },
            aboutChangeFrontImage(event){
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
                            this.aboutform.front_image =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            aboutLoadFrontImage(front_image_id){
                if(front_image_id){
                    return "/assets/organisation/img/website/frontimage/"+front_image_id;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            updateAboutFrontImage(aboutformfront_image){
                // console.log(aboutformfront_image, 'mixcv')
                let img = this.aboutform.front_image;
                      if(img.length>100){
                            console.log('bbbbmixcv')
                            return this.aboutform.front_image;
                        }else{
                            if(aboutformfront_image){
                                return "assets/organisation/img/website/frontimage/"+aboutformfront_image;
                            }else{
                                return "/assets/organisation/img/website/empty.png";
                            }
                        }
            },
            addAbout() {
                console.log('add About new')
                this.$Progress.start();
                this.aboutform.post('/about')
                    .then((response)=>{
                        //  console.log(response.data)
                         toast({
                            type: 'success',
                            title: 'About Info Created successfully'
                            })
                           this.$store.dispatch( "organisation")
                            this.$store.dispatch( "about")
                            this.$store.dispatch( "services")
                            this.$store.dispatch( "features")
                            this.$store.dispatch( "servicemodels")
                            this.$store.dispatch( "adverts")
                            $('#AboutModal').modal('hide')
                            this.aboutform.reset()
                              this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        //errors
                            $('#AboutModal').modal('show');
                            toast({
                                type: 'error',
                                title: 'There was something wrong.'
                                })
                    })
            },
            updateAbout(id){
                  console.log('update about')
                  this.$Progress.start();
                     this.aboutform.patch('/about/update/'+id)
                        .then(()=>{
                             this.$store.dispatch( "organisation")
                            this.$store.dispatch( "about")
                            this.$store.dispatch( "services")
                            this.$store.dispatch( "features")
                            this.$store.dispatch( "servicemodels")
                            this.$store.dispatch( "adverts")
                         $('#AboutModal').modal('hide')
                         toast({
                            type: 'success',
                            title: 'About Updated successfully'
                            })
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                             $('#AboutModal').modal('show')
                            toast({
                            type: 'error',
                            title: 'There was something wrong'
                            })
                        })
            },

            //Service
            newServiceModal(){
                this.editmodeService = false;
                 this.serviceform.reset()
                     $('#ServiceModal').modal('show')
            },
            editServiceModal(id){
                 this.editmodeService = true;
                 this.serviceform.reset()
                   console.log('edit service', id)
                    this.$Progress.start();
                      axios.get('/service/edit/'+id)

                        .then((response)=>{
                             console.log(response.data)
                           $('#ServiceModal').modal('show')
                           toast({
                            type: 'success',
                            title: 'Fetched the Service data successfully'
                            })
                            this.serviceform.fill(response.data.service)
                               this.$Progress.finish();
                        })
                        .catch(()=>{
                            //errors
                            $('#ServiceModal').modal('show');
                            toast({
                            type: 'error',
                            title: 'There was something Wrong'
                            })
                            this.$Progress.fail();
                        })
            },
            serviceChangeImage(event){
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
                            this.serviceform.service_image =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            serviceLoadImage(image_id){
                if(image_id){
                    return "/assets/organisation/img/website/services/"+image_id;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            updateServiceImage(serviceformimage){
                // console.log(serviceformimage, 'mixcv')
                let img = this.serviceform.service_image;
                      if(img.length>100){
                            console.log('bbbbmixcv')
                            return this.serviceform.service_image;
                        }else{
                            if(serviceformimage){
                                return "assets/organisation/img/website/services/"+serviceformimage;
                            }else{
                                return "/assets/organisation/img/website/empty.png";
                            }
                        }
            },
            addService() {
                console.log('add Service new')
                this.$Progress.start();
                this.serviceform.post('/service')
                    .then((response)=>{
                        //  console.log(response.data)
                         toast({
                            type: 'success',
                            title: 'Service Info Created successfully'
                            })
                            this.$store.dispatch( "organisation")
                            this.$store.dispatch( "about")
                            this.$store.dispatch( "services")
                            this.$store.dispatch( "features")
                            this.$store.dispatch( "servicemodels")
                            this.$store.dispatch( "adverts")
                            $('#ServiceModal').modal('hide')
                            this.serviceform.reset()
                              this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        //errors
                            $('#ServiceModal').modal('show');
                            toast({
                                type: 'error',
                                title: 'There was something wrong.'
                                })
                    })
            },
            updateService(id){
                  console.log('update service')
                  this.$Progress.start();
                     this.serviceform.patch('/service/update/'+id)
                        .then(()=>{
                            this.$store.dispatch( "organisation")
                            this.$store.dispatch( "about")
                            this.$store.dispatch( "services")
                            this.$store.dispatch( "features")
                            this.$store.dispatch( "servicemodels")
                            this.$store.dispatch( "adverts")
                         $('#ServiceModal').modal('hide')
                         toast({
                            type: 'success',
                            title: 'Service Updated successfully'
                            })
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                             $('#ServiceModal').modal('show')
                            toast({
                            type: 'error',
                            title: 'There was something wrong'
                            })
                        })
            },


            //Advert
            newAdvertModal(){
                this.editmodeAdvert = false;
                 this.advertform.reset()
                     $('#AdvertModal').modal('show')
            },
            editAdvertModal(id){
                 this.editmodeAdvert = true;
                 this.advertform.reset()
                   console.log('edit advert', id)
                    this.$Progress.start();
                      axios.get('/advert/edit/'+id)

                        .then((response)=>{
                             console.log(response.data)
                           $('#AdvertModal').modal('show')
                           toast({
                            type: 'success',
                            title: 'Fetched the Advert data successfully'
                            })
                            this.advertform.fill(response.data.advert)
                               this.$Progress.finish();
                        })
                        .catch(()=>{

                            //errors
                            $('#AdvertModal').modal('show');
                            toast({
                            type: 'error',
                            title: 'There was something Wrong'
                            })
                            this.$Progress.fail();
                        })
            },
            advertChangeImage(event){
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
                            this.advertform.advert_image =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            advertLoadImage(image_id){
                if(image_id){
                    return "/assets/organisation/img/website/adverts/"+image_id;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            updateAdvertImage(advertformimage){
                // console.log(advertformimage, 'mixcv')
                let img = this.advertform.advert_image;
                      if(img.length>100){
                            console.log('bbbbmixcv')
                            return this.advertform.advert_image;
                        }else{
                            if(advertformimage){
                                return "assets/organisation/img/website/adverts/"+advertformimage;
                            }else{
                                return "/assets/organisation/img/website/empty.png";
                            }
                        }
            },
            addAdvert() {
                console.log('add Advert new')
                this.$Progress.start();
                this.advertform.post('/advert')
                    .then((response)=>{
                        //  console.log(response.data)
                         toast({
                            type: 'success',
                            title: 'Advert Info Created successfully'
                            })
                            this.$store.dispatch( "organisation")
                            this.$store.dispatch( "about")
                            this.$store.dispatch( "services")
                            this.$store.dispatch( "features")
                            this.$store.dispatch( "servicemodels")
                            this.$store.dispatch( "adverts")
                            $('#AdvertModal').modal('hide')
                            this.advertform.reset()
                              this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        //errors
                            $('#AdvertModal').modal('show');
                            toast({
                                type: 'error',
                                title: 'There was something wrong.'
                                })
                    })
            },
            updateAdvert(id){
                  console.log('update advert')
                  this.$Progress.start();
                     this.advertform.patch('/advert/update/'+id)
                        .then(()=>{
                            this.$store.dispatch( "organisation")
                            this.$store.dispatch( "about")
                            this.$store.dispatch( "services")
                            this.$store.dispatch( "features")
                            this.$store.dispatch( "servicemodels")
                            this.$store.dispatch( "adverts")
                         $('#AdvertModal').modal('hide')
                         toast({
                            type: 'success',
                            title: 'Advert Updated successfully'
                            })
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                             $('#AdvertModal').modal('show')
                            toast({
                            type: 'error',
                            title: 'There was something wrong'
                            })
                        })
            },
            deleteAdvert(id){
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
                        this.advertform.get('/advert/delete/'+id)
                            .then(()=>{
                            toast({
                            type: 'success',
                            title: 'Advert Deleted successfully'
                            })
                            this.$store.dispatch( "organisation")
                            this.$store.dispatch( "about")
                            this.$store.dispatch( "services")
                            this.$store.dispatch( "features")
                            this.$store.dispatch( "servicemodels")
                            this.$store.dispatch( "adverts")

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


            //Feature
            newFeatureModal(){
                this.editmodeFeature = false;
                 this.featureform.reset()
                     $('#FeatureModal').modal('show')
            },
            editFeatureModal(id){
                 this.editmodeFeature = true;
                 this.featureform.reset()
                   console.log('edit feature', id)
                    this.$Progress.start();
                      axios.get('/feature/edit/'+id)

                        .then((response)=>{
                             console.log(response.data)
                           $('#FeatureModal').modal('show')
                           toast({
                            type: 'success',
                            title: 'Fetched the Feature data successfully'
                            })
                            this.featureform.fill(response.data.feature)
                               this.$Progress.finish();
                        })
                        .catch(()=>{

                            //errors
                            $('#FeatureModal').modal('show');
                            toast({
                            type: 'error',
                            title: 'There was something Wrong'
                            })
                            this.$Progress.fail();
                        })
            },
            featureChangeImage(event){
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
                            this.featureform.image =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            featureLoadImage(image_id){
                if(image_id){
                    return "/assets/organisation/img/website/features/"+image_id;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            updateFeatureImage(featureformimage){
                // console.log(featureformimage, 'mixcv')
                let img = this.featureform.image;
                      if(img.length>100){
                            return this.featureform.image;
                        }else{
                            if(featureformimage){
                                return "assets/organisation/img/website/features/"+featureformimage;
                            }else{
                                return "/assets/organisation/img/website/empty.png";
                            }
                        }
            },
            addFeature() {
                console.log('add Feature new')
                this.$Progress.start();
                this.featureform.post('/feature')
                    .then((response)=>{
                        //  console.log(response.data)
                         toast({
                            type: 'success',
                            title: 'Feature Info Created successfully'
                            })
                            this.$store.dispatch( "organisation")
                            this.$store.dispatch( "about")
                            this.$store.dispatch( "services")
                            this.$store.dispatch( "features")
                            this.$store.dispatch( "servicemodels")
                            this.$store.dispatch( "adverts")
                            $('#FeatureModal').modal('hide')
                            this.featureform.reset()
                              this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        //errors
                            $('#FeatureModal').modal('show');
                            toast({
                                type: 'error',
                                title: 'There was something wrong.'
                                })
                    })
            },
            updateFeature(id){
                  console.log('update feature')
                  this.$Progress.start();
                     this.featureform.patch('/feature/update/'+id)
                        .then(()=>{
                            this.$store.dispatch( "organisation")
                            this.$store.dispatch( "about")
                            this.$store.dispatch( "services")
                            this.$store.dispatch( "features")
                            this.$store.dispatch( "servicemodels")
                            this.$store.dispatch( "adverts")
                         $('#FeatureModal').modal('hide')
                         toast({
                            type: 'success',
                            title: 'Feature Updated successfully'
                            })
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                             $('#FeatureModal').modal('show')
                            toast({
                            type: 'error',
                            title: 'There was something wrong'
                            })
                        })
            },
            deleteFeature(id){
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
                        this.featureform.get('/feature/delete/'+id)
                            .then(()=>{
                            toast({
                            type: 'success',
                            title: 'Feature Deleted successfully'
                            })
                            this.$store.dispatch( "organisation")
                            this.$store.dispatch( "about")
                            this.$store.dispatch( "services")
                            this.$store.dispatch( "features")
                            this.$store.dispatch( "servicemodels")
                            this.$store.dispatch( "adverts")

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



            //Servicemodel
            newServiceModelModal(){
                this.editmodeServiceModel = false;
                 this.servicemodelform.reset()
                     $('#ServiceModelModal').modal('show')
            },
            editServiceModelModal(id){
                 this.editmodeServiceModel = true;
                 this.servicemodelform.reset()
                   console.log('edit servicemodel', id)
                    this.$Progress.start();
                      axios.get('/servicemodel/edit/'+id)

                        .then((response)=>{
                             console.log(response.data)
                           $('#ServiceModelModal').modal('show')
                           toast({
                            type: 'success',
                            title: 'Fetched the Servicemodel data successfully'
                            })
                            this.servicemodelform.fill(response.data.servicemodel)
                               this.$Progress.finish();
                        })
                        .catch(()=>{

                            //errors
                            $('#ServiceModelModal').modal('show');
                            toast({
                            type: 'error',
                            title: 'There was something Wrong'
                            })
                            this.$Progress.fail();
                        })
            },
            servicemodelChangeImage(event){
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
                            this.servicemodelform.image =event.target.result
                                // console.log(event.target.result)
                            };
                        reader.readAsDataURL(file);
                }
            },
            servicemodelLoadImage(image_id){
                if(image_id){
                    return "/assets/organisation/img/website/image/"+image_id;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            updateServiceModelImage(servicemodelformimage){
                // console.log(servicemodelformimage, 'mixcv')
                let img = this.servicemodelform.image;
                      if(img.length>100){
                            console.log('bbbbmixcv')
                            return this.servicemodelform.image;
                        }else{
                            if(servicemodelformimage){
                                return "assets/organisation/img/website/image/"+servicemodelformimage;
                            }else{
                                return "/assets/organisation/img/website/empty.png";
                            }
                        }
            },
            addServiceModel() {
                console.log('add Servicemodel new')
                this.$Progress.start();
                this.servicemodelform.post('/servicemodel')
                    .then((response)=>{
                        //  console.log(response.data)
                         toast({
                            type: 'success',
                            title: 'Servicemodel Info Created successfully'
                            })
                            this.$store.dispatch( "organisation")
                            this.$store.dispatch( "about")
                            this.$store.dispatch( "services")
                            this.$store.dispatch( "features")
                            this.$store.dispatch( "servicemodels")
                            this.$store.dispatch( "adverts")
                            $('#ServiceModelModal').modal('hide')
                            this.servicemodelform.reset()
                              this.$Progress.finish()
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        //errors
                            $('#ServiceModelModal').modal('show');
                            toast({
                                type: 'error',
                                title: 'There was something wrong.'
                                })
                    })
            },
            updateServiceModel(id){
                  console.log('update servicemodel')
                  this.$Progress.start();
                     this.servicemodelform.patch('/servicemodel/update/'+id)
                        .then(()=>{
                            this.$store.dispatch( "organisation")
                            this.$store.dispatch( "about")
                            this.$store.dispatch( "services")
                            this.$store.dispatch( "features")
                            this.$store.dispatch( "servicemodels")
                            this.$store.dispatch( "adverts")
                         $('#ServiceModelModal').modal('hide')
                         toast({
                            type: 'success',
                            title: 'Servicemodel Updated successfully'
                            })
                            this.$Progress.finish();
                        })
                        .catch(()=>{
                            this.$Progress.fail();
                             $('#ServiceModelModal').modal('show')
                            toast({
                            type: 'error',
                            title: 'There was something wrong'
                            })
                        })
            },
            deleteServiceModel(id){
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
                        this.servicemodelform.get('/servicemodel/delete/'+id)
                            .then(()=>{
                            toast({
                            type: 'success',
                            title: 'Servicemodel Deleted successfully'
                            })
                            this.$store.dispatch( "organisation")
                            this.$store.dispatch( "about")
                            this.$store.dispatch( "services")
                            this.$store.dispatch( "features")
                            this.$store.dispatch( "servicemodels")
                            this.$store.dispatch( "adverts")

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
                this.loadOrganisation();//method
                this.viewDirectorModal();//method
                this.viewAdminModal();//method
                this.viewEmployeeModal();//method
           }
        }

    }
</script>

