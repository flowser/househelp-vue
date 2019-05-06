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
        import HousehelpsReviews  from './pages/backend/househelps/organisation/AllReviews.vue';
        import BureauHousehelpsReviews  from './pages/backend/househelps/bureau/Reviews.vue';
        import HousehelpSingleReview  from './pages/backend/househelps/SingleReview.vue';

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


const     router= new VueRouter({
                mode: 'history',
                routes: [

                // 1. Front End view
                  // 1.1 landing Page home
                      {
                        path:'/', //with Househelps
                        name:'home',
                        component: Home,
                      },

                  // 1.2. dashboards front
                     // 1.2.1 affiliate
                          {
                            path: '/affiliate',
                            name: 'affiliate',
                            component: AffiliateDashboard,
                          },
                     //1.2.2 client
                          {
                            path: '/client',
                            name: 'client',
                            component: ClientDashboard,
                          },
                     //1.2.3 househelp
                          {
                            path: '/househelp',
                            name: 'househelp',
                            component: HousehelpDashboard,
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
                            path: '/dashboard',
                            name: 'dashboard',
                            component: OrganisationDashboard,
                          },
                    // bureau
                    //2.1.4 universal
                          {
                              path: '/bureau',
                              name: 'bureau',
                              component: BureauDashboard,
                          },
                    //2.1.5 mailbox
                          {
                            path:'/mails',
                            name: 'mails',
                            component: AllMailbox,
                          },
                          {
                            path:'/mail',
                            name: 'mail',
                            component: Mailbox,
                          },

                    //2.2 Pages
                      //2.2.1 users
                       //2.2.1.1 directors
                          {
                            path: '/directors/credentials',
                            name: 'directors',
                            component: DirectorsCredentials,
                          },
                       //2.2.1.2 admins
                          {
                            path: '/admins/credentials',
                            name: 'admins',
                            component:AdminsCredentials,
                          },
                       //2.2.1.3 employees
                          {
                            path: '/employees/credentials',
                            name: 'employees',
                            component:EmployeesCredentials,
                          },
                       //2.2.1.4 Affiliates
                          {
                            path: '/affiliates/credentials',
                            name: 'affiliates',
                            component:AffiliatesCredentials,

                          },
                       //2.2.1.5 clients
                          {
                            path: '/clients/credentials',
                            name: 'clients',
                            component:ClientsCredentials,

                          },
                       //2.2.1.16 Househelps
                          {
                            path: '/househelps/credentials',
                            name: 'househelps',
                            component:HousehelpsCredentials,
                          },

                       //2.2.1.6 users
                          {
                            path: '/users/credentials',
                            name: 'users',
                            component:UsersCredentials,

                          },
                      //bureau
                        //2.2.1.7 users
                          {
                            path: '/bureau/directors/credentials',
                            name: 'bureau/directors',
                            component:BureauDirectorsCredentials,

                          },
                       //2.2.1.8 BureauAdmins
                          {
                            path: '/bureau/admins/credentials',
                            name: 'bureau/admins',
                            component:BureauAdminsCredentials,

                          },
                       //2.2.1.9 BureauEmployees
                          {
                            path: '/bureau/employees/credentials',
                            name: 'bureau.employees',
                            component:BureauEmployeesCredentials,

                          },
                       //2.2.1.10 BureauClients
                          {
                            path: '/bureau/clients',
                            name: 'bureau/clients',
                            component:BureauClients,

                          },
                       //2.2.1.10 BureauHousehelps
                          {
                            path: '/bureau/househelps/credentials',
                            name: 'bureau/househelps',
                            component:BureauHousehelpsCredentials,
                          },

                    // 2.2.2 Househelps view details
                       //2.2.2.1 all organisation Househelps
                          {
                            path: '/househelps',
                            name: 'AllHousehelps', //all Househelps
                            component: Househelps,
                          },
                       //2.2.2.2 all bureau Househelps
                          {
                            path: '/bureau/househelps',
                            name: 'bureau.househelps', //all bureau Househelps
                            component: BureauHousehelps,
                          },
                        //2.2.2.3 Single Househelp with details
                          {
                            path: '/househelp/:id',
                            name: 'single.Househelp',//view single Househelp with all details
                            component: SingleHousehelp,
                          },
                       //2.2.2.4 all organisation Househelps reviews
                          {
                            path: '/househelps/reviews',
                            name: 'allhousehelps.reviews', //all Househelps Reviews
                            component: HousehelpsReviews,
                          },
                       //2.2.2.5 all bureau Househelps
                          {
                            path: '/bureau/househelps/reviews',
                            name: 'bureau.allhousehelps.reviews', //all bureau Househelps Reviews
                            component: BureauHousehelpsReviews,
                          },
                          //2.2.2.6 all organisation Househelps reviews
                          {
                            path: '/househelps/review:id',
                            name: 'single.househelp.review', //single Househelp review
                            component: HousehelpSingleReview,
                          },
                       //2.2.2.5 all bureau Househelps
                          {
                            path: '/bureau/househelps/review/:id',
                            name: 'bureau.single.househelp.review', //bureau single Househelp review
                            component: HousehelpSingleReview,
                          },
                          //2.2.2.6 all search orders
                          {
                            path: '/searchorders',
                            name: 'searchorders', //single Househelp review
                            component: SearchOrders,
                          },
                          //2.2.2.6 clients search orders
                          {
                            path: '/client/searchorders',
                            name: 'client.searchorders', //single Househelp review
                            component: ClientSearchOrders,
                          },
                       //2.2.2.5 all bureau search orders
                          {
                            path: '/bureau/searchorders',
                            name: 'bureau.searchorders', //bureau single Househelp review
                            component: BureauSearchOrders,
                          },
                           //2.2.2.6 all organisation Househelps reviews
                           {
                            path: '/searchorder/:id',
                            name: 'single.searchorder', //single Househelp review
                            component: SingleSearchOrder,
                          },
                           //2.2.2.6 all organisation Househelps reviews
                           {
                            path: '/client/searchorder/:id',
                            name: 'single.client.searchorder', //single Househelp review
                            component: ClientSingleSearchOrder,
                          },
                       //2.2.2.5 all bureau Househelps
                          {
                            path: '/bureau/searchorder/:id',
                            name: 'bureau.single.searchorder', //bureau single Househelp review
                            component: BureauSingleSearchOrder,
                          },

                    // 2.2.2 Settings
                       //2.2.2.1 Roles & permissions
                          {
                              path: '/permissions',
                              name: 'permissions',
                              component: Permissions,

                          },
                       //2.2.2.2 organisation settings
                          {
                              path: '/settings',
                              name: 'settings',
                              component:Settings,

                          },
                       //2.2.2.2 bureau settings
                          {
                              path: '/bureau/settings',
                              name: 'bureau.settings',
                              component:BureauSettings,

                          },
                    // 2.2.3 Standard
                       //2.2.3.1 About backend
                          {
                              path: '/backend/about',
                              name: 'backend.about',
                              component:AboutBackend,

                          },
                    // 2.2.4 Service backend
                       //2.2.4.1 Service backend
                          {
                              path: '/backend/services',
                              name: 'backend.services',
                              component:ServicesBackend,

                          },
                       //2.2.4.2 Single Service backend
                          {
                              path: '/service/:id',
                              name: 'backend.single.service.id',
                              component:SingleServiceBackend,

                          },
                    // 2.2.4 Advert backend
                       //2.2.4.1 Advert backend
                          {
                              path: '/backend/adverts',
                              name: 'backend.adverts',
                              component:AdvertsBackend,
                          },
                       //2.2.4.2 Single Advert backend
                          {
                              path: '/advert/:id',
                              name: 'backend.singe.advert.id',
                              component:SingleAdvertBackend,
                          },
                    // 2.2.4 Policies backend
                       //2.2.4.1 Policies backend
                          {
                              path: '/backend/policies',
                              name: 'backend.signle.policies',
                              component:PoliciesBackend,
                          },
                       //2.2.4.2 Single Policy backend
                          {
                              path: '/policy/:id',
                              name: 'backend.signle.policy.id',
                              component:SinglePolicyBackend,
                          },

                ]
        });


// const router = new VueRouter({
//     history: true,
//     mode: 'history',
//     routes,
// });
export default router;

