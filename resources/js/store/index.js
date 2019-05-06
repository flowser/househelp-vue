//standard
import countries from './modules/standard/countries';
import counties from './modules/standard/counties';
import constituencies from './modules/standard/constituencies';
import wards from './modules/standard/wards';
import genders from './modules/standard/genders';
import positions from './modules/standard/positions';
import relationships from './modules/standard/relationships';

//universal
import about from './modules/webpages/about';
import advert from './modules/webpages/advert';
import service from './modules/webpages/service';
import servicemodel from './modules/webpages/servicemodel';
import feature from './modules/webpages/feature';
//organisation
import organisation from './modules/organisation/organisation';
import permission from './modules/organisation/permission';
import role from './modules/organisation/role';
import user from './modules/organisation/user';
import orgdirector from './modules/organisation/director';
import orgadmin from './modules/organisation/admin';
import orgemployee from './modules/organisation/employee';

//bureau
import bureaus from './modules/bureau/bureau';
import bureauadmins from './modules/bureau/bureauadmin';
import bureaudirectors from './modules/bureau/bureaudirector';
import bureauemployees from './modules/bureau/bureauemployee';


// househelp filters
import age        from './modules/househelp/filters/age';
import duration        from './modules/househelp/filters/duration';
import education       from './modules/househelp/filters/education';
import englishstatus   from './modules/househelp/filters/englishstatus';
import experience      from './modules/househelp/filters/experience';
import kid             from './modules/househelp/filters/kid';
import maritalstatus   from './modules/househelp/filters/maritalstatus';
import operation       from './modules/househelp/filters/operation';
import religion        from './modules/househelp/filters/religion';
import skill           from './modules/househelp/filters/skill';
import tribe           from './modules/househelp/filters/tribe';
import idstatus        from './modules/househelp/filters/idstatus';
import healthstatus    from './modules/househelp/filters/healthstatus';

//househelps
import househelp from './modules/househelp/househelp';
import househelpkin from './modules/househelp/househelpkins/bureauhousehelpkin';


//client
import client from './modules/client/client';
import loggeduser from './modules/client/loggeduser';
import cart from './modules/order/cart/cart';
import order from './modules/order/order';

//Affiliate
import affiliate from './modules/affiliate/affiliate';
import referralLink from './modules/affiliate/referralLinks';


        export default {
          modules: {
            //organisation
                organisation,
                orgdirector,
                orgadmin,
                orgemployee,
                user,
                permission,
                role,

            //bureau
                bureaus,
                bureaudirectors,
                bureauadmins,
                bureauemployees,
            //standard
                countries,
                counties,
                constituencies,
                wards,
                genders,
                positions,
                relationships,
            //universal
                about,
                advert,
                service,
                servicemodel,
                feature,

            //househelp filters
                age,
                duration,
                education,
                englishstatus,
                experience,
                kid,
                maritalstatus,
                operation,
                religion,
                skill,
                tribe,
                idstatus,
                healthstatus,

                //househelp
                househelp,
                househelpkin,

                //client
                client,
                loggeduser,

                //Order
                order,
                cart,

                //affiliate
                affiliate,
                referralLink,
          },
        };

