import Vue from 'vue';
import Vuex from 'vuex';


import VueRouter from 'vue-router';

        //frontend pages
        import Home from './pages/Home.vue';
        import HousehelpDetails from './pages/frontend/HousehelpDetails.vue';
        import Services from './pages/frontend/Services.vue';
        import Team from './pages/frontend/Team.vue';

        // online services
        import OnlineHelp from './pages/frontend/services/OnLineHelp.vue';
        import Contact from './pages/frontend/services/Contact.vue';
        import SearchOrderStatus from './pages/frontend/services/SearchOrderStatus.vue';
        import FAQS from './pages/frontend/services/FAQS.vue';
        //services

        // Policies
        import TermsofUse from './pages/frontend/policies/TermsofUse.vue';
        import Privacy from './pages/frontend/policies/Privacy.vue';
        import Refund from './pages/frontend/policies/Refund.vue';
        import BillingSytem from './pages/frontend/policies/BillingSystem.vue';
        import TicketingSystem from './pages/frontend/policies/TicketingSystem.vue';
        // Policies

        //About Organisation
        import About from './pages/frontend/organisation/About-us.vue';
        import Career from './pages/frontend/organisation/Career.vue';
        import Location from './pages/frontend/organisation/Location.vue';
        import AffiliateProgram from './pages/frontend/organisation/AffiliateProgram.vue';
        //About Organisation


       //frontend pages

    // dashboards
       //    backend
       //organisation
       import OrganisationDashboard  from './pages/user/admin/organisation/Dashboard.vue';
        //bureau
       import BureauDashboard  from './pages/user/admin/bureau/Dashboard.vue';


       import AllMailbox from './pages/backend/Mailbox/AllMails.vue';
       import Mailbox from './pages/backend/Mailbox/Mailbox.vue';

        //    front end
       import AffiliateDashboard  from './pages/user/afilliate/Dashboard.vue';
       import ClientDashboard  from './pages/user/client/Dashboard.vue';
       import HousehelpDashboard  from './pages/user/househelp/Dashboard.vue';

        //backend pages
        // users
        // organisation
        import DirectorsCredentials  from './pages/backend/users/organisation/Directors.vue';
        import AdminsCredentials  from './pages/backend/users/organisation/Admins.vue';
        import EmployeesCredentials  from './pages/backend/users/organisation/Employees.vue';
        import AffiliatesCredentials  from './pages/backend/users/organisation/Affiliates.vue';
        import ClientsCredentials  from './pages/backend/users/organisation/Clients.vue';
        import UsersCredentials  from './pages/backend/users/organisation/Users.vue';
        import HousehelpsCredentials  from './pages/backend/users/organisation/Househelps.vue';
        import OrgBureauDirectorsCredentials  from './pages/backend/users/organisation/BureauDirectors.vue';
        import OrgBureauAdminsCredentials  from './pages/backend/users/organisation/BureauAdmins.vue';
        import OrgBureauEmployeesCredentials  from './pages/backend/users/organisation/BureauEmployees.vue';

        //all
        import Bureaus  from './pages/backend/bureaus/Bureaus.vue';
        import Bureausingle  from './pages/backend/bureaus/SingleBureau.vue';


    //bureau
        import BureauDirectorsCredentials  from './pages/backend/users/bureau/Directors.vue';
        import BureauAdminsCredentials  from './pages/backend/users/bureau/Admins.vue';
        import BureauEmployeesCredentials  from './pages/backend/users/bureau/Employees.vue';
        import BureauHousehelpsCredentials  from './pages/backend/users/bureau/Househelps.vue';
        import BureauClients  from './pages/backend/users/bureau/Clients.vue';

        //Househelps view can share single
        import Househelps  from './pages/backend/househelps/organisation/AllHousehelps.vue';
        import BureauHousehelps  from './pages/backend/househelps/bureau/Househelps.vue';
        import SingleHousehelp  from './pages/backend/househelps/SingleHousehelp.vue';

        // reviews can share single
        import HousehelpsReviews  from './pages/backend/client/organisation/AllReviews.vue';
        import BureauHousehelpsReviews  from './pages/backend/client/bureau/Reviews.vue';

    //    clients
        import HousehelpsClients  from './pages/backend/client/organisation/AllClients.vue';
        import BureauHousehelpsClients  from './pages/backend/client/bureau/Clients.vue';

        //ORders
        import SearchOrders  from './pages/backend/orders/organisation/AllOrders.vue';
        import ClientSearchOrders  from './pages/backend/orders/client/ClientSearchOrders.vue';
        import BureauSearchOrders  from './pages/backend/orders/bureau/SearchOrders.vue';
        import SingleSearchOrder  from './pages/backend/orders/organisation/SingleSearchOrder.vue';
        import ClientSingleSearchOrder  from './pages/backend/orders/client/ClientSingleSearchOrder.vue';
        import BureauSingleSearchOrder  from './pages/backend/orders/bureau/SearchOrders.vue';


        // settings organisation
        import Permissions  from './pages/backend/settings/organisation/Permissions.vue';
        import Settings  from './pages/backend/settings/organisation/Settings.vue';
        // standard
        import AboutBackend  from './pages/backend/settings/organisation/about.vue';
        //service
        import ServicesBackend  from './pages/backend/settings/organisation/services/Services.vue';
        import SingleServiceBackend  from './pages/backend/settings/organisation/services/SingleService.vue';
        // Advert
        import AdvertsBackend  from './pages/backend/settings/organisation/adverts/Adverts.vue';
        import SingleAdvertBackend from './pages/backend/settings/organisation/adverts/SingleAdvert.vue';
        // Policy
        import PoliciesBackend  from './pages/backend/settings/organisation/policies/Policies.vue';
        import SinglePolicyBackend from './pages/backend/settings/organisation/policies/SinglePolicy.vue';

        //bureau settings
        import BureauSettings from './pages/backend/settings/bureau/settings.vue'
        // end of backend pages

        //user login n logout
        import Logout from './pages/login-out/logout.vue'


let routes = [

                // 1. Front End view
                  // 1.1 landing Page home
                      {
                        path:'/', //with Househelps
                        name:'Home',
                        component: Home,
                      },
                      {
                        path:'/login', //with Househelps
                        name:'Login',
                        component: Home,
                        meta:{
                            requiresVisitor:true,
                        }
                      },
                      {
                        path: '/logout',
                        name: 'Logout',
                        component: Logout
                      },

                  // 1.2. dashboards front
                     // 1.2.1 affiliate
                          {
                            path: '/affiliate/dashboard',
                            name: 'affiliate.dashboard',
                            component: AffiliateDashboard,
                            meta:{
                                requiresAuth:true,
                            }
                          },
                     //1.2.2 client
                          {
                            path: '/client/dashboard',
                            name: 'client.dashboard',
                            component: ClientDashboard,
                            meta:{
                                  requiresAuth:true,
                              }
                          },
                     //1.2.3 househelp
                          {
                            path: '/househelp/dashboard',
                            name: 'househelp.dashboard',
                            component: HousehelpDashboard,
                            meta:{
                                  requiresAuth:true,
                              }
                          },
                  // 1.3 pages
                     //1.3.1 Houshelp Details
                          {
                            path:'/househelp/details/:id',
                            name: 'details',
                            component: HousehelpDetails,
                          },
                     //1.3.2 about
                          {
                            path:'/about',
                            name:'about',
                            component: About ,
                          },
                    //  //1.3.5 Services
                          {
                            path:'/services',
                            name: 'services',
                            component: Services,
                          },
                     //1.3.3 Team
                          {
                            path:'/team',
                            name: 'team',
                            component: Team,
                          },

                // 2. Backend view

                  //2.1 Dashboards backend
                  // organisation landing page
                    //2.1.1 universal
                          {
                            path: '/B/dashboard',
                            name: 'dashboard',
                            component: OrganisationDashboard,
                            meta:{
                                requiresAuth:true,
                            }
                          },
                    // bureau
                    //2.1.4 universal
                          {
                              path: '/B/bureau/dashboard',
                              name: 'bureau.dashboard',
                              component: BureauDashboard,
                              meta:{
                                requiresAuth:true,
                            }
                          },
                    //2.1.5 mailbox
                          {
                            path:'/B/mails',
                            name: 'mails',
                            component: AllMailbox,
                            meta:{
                                  requiresAuth:true,
                              }
                          },
                          {
                            path:'/B/mail',
                            name: 'mail',
                            component: Mailbox,
                            meta:{
                                  requiresAuth:true,
                              }
                          },
                          {
                            path:'/B/bureaus',
                            name: 'Bureaus',
                            component: Bureaus,
                            meta:{
                                  requiresAuth:true,
                              }
                          },
                          {
                            path:'/B/clients',
                            name: 'Bureaus',
                            component: HousehelpsClients,
                            meta:{
                                  requiresAuth:true,
                              }
                          },
                          {
                            path:'/B/bclients/clients',
                            name: 'Bureaus',
                            component: BureauHousehelpsClients,
                            meta:{
                                  requiresAuth:true,
                              }
                          },
                          {
                            path:'/B/bureaus/:id',
                            name: 'Bureaus.:id',
                            component: Bureausingle,
                            meta:{
                                  requiresAuth:true,
                              }
                          },
                    //2.2 Pages
                      //2.2.1 users
                       //2.2.1.1 directors
                          {
                            path: '/B/directors/credentials',
                            name: 'directors.credentials',
                            component: DirectorsCredentials,
                            meta:{
                                  requiresAuth:true,
                              }
                          },
                       //2.2.1.2 admins
                          {
                            path: '/B/admins/credentials',
                            name: 'admins.credentials',
                            component:AdminsCredentials,
                            meta:{
                                  requiresAuth:true,
                              }
                          },
                       //2.2.1.3 employees
                          {
                            path: '/B/employees/credentials',
                            name: 'employees.credentials',
                            component:EmployeesCredentials,
                            meta:{
                                  requiresAuth:true,
                              }
                          },
                       //2.2.1.4 Affiliates
                          {
                            path: '/B/affiliates/credentials',
                            name: 'affiliates.credentials',
                            component:AffiliatesCredentials,
                            meta:{
                                  requiresAuth:true,
                              }

                          },
                       //2.2.1.5 clients
                          {
                            path: '/B/clients/credentials',
                            name: 'clients.credentials',
                            component:ClientsCredentials,
                            meta:{
                                  requiresAuth:true,
                              }

                          },
                          //organiationBureau Directors
                          {
                            path: '/B/Bdirectors/credentials',
                            name: 'bureau.directors.credentials',
                            component:OrgBureauDirectorsCredentials,
                            meta:{
                                  requiresAuth:true,
                              }
                          },
                       //2.2.1.8
                       //organiationBureauAdmins
                          {
                            path: '/B/Badmins/credentials',
                            name: 'bureau.admins.credentials',
                            component:OrgBureauAdminsCredentials,
                            meta:{
                                  requiresAuth:true,
                              }
                          },
                       //2.2.1.9
                       //organiationBureauEmployees
                          {
                            path: '/B/Bemployees/credentials',
                            name: 'bureau.employees.credentials',
                            component:OrgBureauEmployeesCredentials,
                            meta:{
                                  requiresAuth:true,
                              }
                          },
                       //2.2.1.16 Househelps
                          {
                            path: '/B/Bhousehelps/credentials',
                            name: 'househelps.credentials',
                            component:HousehelpsCredentials,
                            meta:{
                                  requiresAuth:true,
                              }
                          },

                       //2.2.1.6 users
                          {
                            path: '/B/users/credentials',
                            name: 'users.credentials',
                            component:UsersCredentials,
                            meta:{
                                  requiresAuth:true,
                              }

                          },
                      //bureau
                        //2.2.1.7 users
                          {
                            path: '/B/bureau/directors/credentials',
                            name: 'bureau.directors.credentials',
                            component:BureauDirectorsCredentials,
                            meta:{
                                  requiresAuth:true,
                              }
                          },
                       //2.2.1.8 BureauAdmins
                          {
                            path: '/B/bureau/admins/credentials',
                            name: 'bureau.admins.credentials',
                            component:BureauAdminsCredentials,
                            meta:{
                                  requiresAuth:true,
                              }
                          },
                       //2.2.1.9 BureauEmployees
                          {
                            path: '/B/bureau/employees/credentials',
                            name: 'bureau.employees.credentials',
                            component:BureauEmployeesCredentials,
                            meta:{
                                  requiresAuth:true,
                              }
                          },
                       //2.2.1.10 BureauHousehelps
                          {
                            path: '/B/bureau/househelps/credentials',
                            name: 'bureau.househelps.credentials',
                            component:BureauHousehelpsCredentials,
                            meta:{
                                  requiresAuth:true,
                              }
                          },
                          //2.2.1.10 BureauClients
                          {
                            path: '/B/bureau/clients',
                            name: 'bureau.clients',
                            component:BureauClients,
                            meta:{
                                  requiresAuth:true,
                              }
                          },

                    // 2.2.2 Househelps view details
                       //2.2.2.1 all organisation Househelps
                          {
                            path: '/B/househelps',
                            name: 'AllHousehelps', //all Househelps
                            component: Househelps,
                            meta:{
                                  requiresAuth:true,
                              }
                          },
                       //2.2.2.2 all bureau Househelps
                          {
                            path: '/B/bureau/househelps',
                            name: 'bureau.househelps', //all bureau Househelps
                            component: BureauHousehelps,
                            meta:{
                                  requiresAuth:true,
                              }
                          },
                        //2.2.2.3 Single Househelp with details
                          {
                            path: '/B/househelp/:id',
                            name: 'single.Househelp',//view single Househelp with all details
                            component: SingleHousehelp,
                          },
                        //2.2.2.3 Single Househelp with details
                          {
                            path: '/B/bureau/househelp/:id',
                            name: 'single.bureau.Househelp',//view single Househelp with all details
                            component: SingleHousehelp,
                          },
                       //2.2.2.4 all organisation Househelps reviews
                          {
                            path: '/B/househelps/reviews',
                            name: 'allhousehelps.reviews', //all Househelps Reviews
                            component: HousehelpsReviews,
                            meta:{
                                  requiresAuth:true,
                              }
                          },
                       //2.2.2.5 all bureau Househelps
                          {
                            path: '/B/bureau/househelps/reviews',
                            name: 'bureau.allhousehelps.reviews', //all bureau Househelps Reviews
                            component: BureauHousehelpsReviews,
                            meta:{
                                  requiresAuth:true,
                              }
                          },
                          //2.2.2.6 all organisation Househelps reviews
                        //   {
                        //     path: '/B/househelps/review:id',
                        //     name: 'single.househelp.review', //single Househelp review
                        //     component: HousehelpSingleReview,
                        //     meta:{
                        //           requiresAuth:true,
                        //       }
                        //   },
                       //2.2.2.5 all bureau Househelps
                        //   {
                        //     path: '/B/bureau/househelps/review/:id',
                        //     name: 'bureau.single.househelp.review.id', //bureau single Househelp review
                        //     component: HousehelpSingleReview,
                        //     meta:{
                        //           requiresAuth:true,
                        //       }
                        //   },
                          //2.2.2.6 all search orders
                          {
                            path: '/B/searchorders',
                            name: 'searchorders', //single Househelp review
                            component: SearchOrders,
                            meta:{
                                  requiresAuth:true,
                              }
                          },
                          //2.2.2.6 clients search orders
                          {
                            path: '/client/searchorders',
                            name: 'client.searchorders', //single Househelp review
                            component: ClientSearchOrders,
                            meta:{
                                  requiresAuth:true,
                              }
                          },
                       //2.2.2.5 all bureau search orders
                          {
                            path: '/B/bureau/searchorders',
                            name: 'bureau.searchorders', //bureau single Househelp review
                            component: BureauSearchOrders,
                            meta:{
                                  requiresAuth:true,
                              }
                          },
                           //2.2.2.6 all organisation Househelps reviews
                           {
                            path: '/B/searchorder/:id',
                            name: 'single.searchorder', //single Househelp review
                            component: SingleSearchOrder,
                            meta:{
                                  requiresAuth:true,
                              }
                          },
                           //2.2.2.6 all organisation Househelps reviews
                           {
                            path: '/B/client/searchorder/:id',
                            name: 'single.client.searchorder', //single Househelp review
                            component: ClientSingleSearchOrder,
                            meta:{
                                  requiresAuth:true,
                              }
                          },
                       //2.2.2.5 all bureau Househelps
                          {
                            path: '/B/bureau/searchorder/:id',
                            name: 'bureau.single.searchorder.id', //bureau single Househelp review
                            component: BureauSingleSearchOrder,
                            meta:{
                                  requiresAuth:true,
                              }
                          },

                    // 2.2.2 Settings
                       //2.2.2.1 Roles & permissions
                          {
                              path: '/B/permissions',
                              name: 'permissions',
                              component: Permissions,
                              meta:{
                                  requiresAuth:true,
                              }

                          },
                       //2.2.2.2 organisation settings
                          {
                              path: '/B/settings',
                              name: 'settings',
                              component:Settings,
                              meta:{
                                  requiresAuth:true,
                              }

                          },
                       //2.2.2.2 bureau settings
                          {
                              path: '/B/bureau/settings',
                              name: 'bureau.settings',
                              component:BureauSettings,
                              meta:{
                                  requiresAuth:true,
                              }

                          },
                    // 2.2.3 Standard
                       //2.2.3.1 About backend
                          {
                              path: '/B/backend/about',
                              name: 'backend.about',
                              component:AboutBackend,
                              meta:{
                                  requiresAuth:true,
                              }

                          },
                    // 2.2.4 Service backend
                       //2.2.4.1 Service backend
                          {
                              path: '/B/backend/services',
                              name: 'backend.services',
                              component:ServicesBackend,
                              meta:{
                                  requiresAuth:true,
                              }

                          },
                       //2.2.4.2 Single Service backend
                          {
                              path: '/B/service/:id',
                              name: 'backend.single.service.id',
                              component:SingleServiceBackend,
                              meta:{
                                  requiresAuth:true,
                              }

                          },
                    // 2.2.4 Advert backend
                       //2.2.4.1 Advert backend
                          {
                              path: '/B/backend/adverts',
                              name: 'backend.adverts',
                              component:AdvertsBackend,
                              meta:{
                                  requiresAuth:true,
                              }
                          },
                       //2.2.4.2 Single Advert backend
                          {
                              path: '/B/advert/:id',
                              name: 'backend.singe.advert.id',
                              component:SingleAdvertBackend,
                              meta:{
                                  requiresAuth:true,
                              }
                          },
                    // 2.2.4 Policies backend
                       //2.2.4.1 Policies backend
                          {
                              path: '/B/backend/policies',
                              name: 'backend.single.policies',
                              component:PoliciesBackend,
                              meta:{
                                  requiresAuth:true,
                              }
                          },
                       //2.2.4.2 Single Policy backend
                          {
                              path: '/B/policy/:id',
                              name: 'backend.single.policy.id',
                              component:SinglePolicyBackend,
                              meta:{
                                  requiresAuth:true,
                              }
                          },

];



export default routes;

