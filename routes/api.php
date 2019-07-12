<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Backend\Bureau\BureauController;
use App\Http\Controllers\Backend\Client\ClientController;
use App\Http\Controllers\Backend\Standard\WardController;
use App\Http\Controllers\Backend\Webpage\AboutController;
use App\Http\Controllers\Backend\Webpage\AdvertController;
use App\Http\Controllers\Backend\Standard\CountyController;
use App\Http\Controllers\Backend\Standard\GenderController;
use App\Http\Controllers\Backend\Webpage\FeatureController;
use App\Http\Controllers\Backend\Webpage\ServiceController;
use App\Http\Controllers\Backend\Househelp\ReviewController;
use App\Http\Controllers\Backend\Standard\CountryController;
use App\Http\Controllers\Backend\Organisation\RoleController;
use App\Http\Controllers\Backend\Organisation\UserController;
use App\Http\Controllers\Backend\Standard\PositionController;
use App\Http\Controllers\Backend\Bureau\BureauAdminController;
use App\Http\Controllers\Backend\Affiliate\AffiliateController;
use App\Http\Controllers\Backend\Affiliate\SharelinkController;
use App\Http\Controllers\Backend\Househelp\HousehelpController;
use App\Http\Controllers\Backend\Client\standard\CartController;
use App\Http\Controllers\Backend\Webpage\ServiceModelController;
use App\Http\Controllers\Backend\Bureau\BureauDirectorController;
use App\Http\Controllers\Backend\Bureau\BureauEmployeeController;
use App\Http\Controllers\Backend\Client\standard\OrderController;
use App\Http\Controllers\Backend\Househelp\Filters\KidController;
use App\Http\Controllers\Backend\Organisation\OrgAdminController;
use App\Http\Controllers\Backend\Standard\ConstituencyController;
use App\Http\Controllers\Backend\Standard\RelationshipController;
use App\Http\Controllers\Backend\Affiliate\ReferralLinkController;
use App\Http\Controllers\Backend\Househelp\HousehelpkinController;
use App\Http\Controllers\Backend\Househelp\Filters\SkillController;
use App\Http\Controllers\Backend\Househelp\Filters\TribeController;
use App\Http\Controllers\Backend\Organisation\PermissionController;
use App\Http\Controllers\Backend\Organisation\OrgDirectorController;
use App\Http\Controllers\Backend\Organisation\OrgEmployeeController;
use App\Http\Controllers\Backend\Organisation\OrganisationController;
use App\Http\Controllers\Backend\Househelp\Filters\DurationController;
use App\Http\Controllers\Backend\Househelp\Filters\IDstatusController;
use App\Http\Controllers\Backend\Househelp\Filters\ReligionController;
use App\Http\Controllers\Backend\Househelp\Filters\EducationController;
use App\Http\Controllers\Backend\Househelp\Filters\OperationController;
use App\Http\Controllers\Backend\Househelp\Filters\ExperienceController;
use App\Http\Controllers\Backend\Househelp\Filters\HealthstatusController;
use App\Http\Controllers\Backend\Househelp\Filters\EnglishstatusController;
use App\Http\Controllers\Backend\Househelp\Filters\MaritalstatusController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/get/user', [AuthController::class, 'user']);

       //users
       Route::get('user/get', [UserController::class, 'index']);
       Route::get('usertypes/get', [UserController::class, 'usertypes']);
       Route::post('user', [UserController::class, 'store']);
       Route::get('user/show/{user}', [UserController::class, 'show']);
       Route::get('user/edit/{user}', [UserController::class, 'edit']);
       Route::patch('user/update/{user}', [UserController::class, 'update']);
       Route::get('user/delete/{user}/', [UserController::class, 'destroy']);


    //organisation staff
    // orgdirector
    Route::get('orgdirector/get', [OrgDirectorController::class, 'index'])->name('orgdirector.index');
    Route::get('orgdirectors/get', [OrgDirectorController::class, 'organisations'])->name('orgdirector.organisations');
    Route::get('orgdirector/get/list', [OrgDirectorController::class, 'orgdirectorList'])->name('orgdirector.list-index');
    Route::patch('orgdirector', [OrgDirectorController::class, 'store'])->name('orgdirector.store');

    Route::get('orgdirector/show/{orgdirector}', [OrgDirectorController::class, 'show'])->name('orgdirector.show');
    Route::get('orgdirector/edit/{orgdirector}', [OrgDirectorController::class, 'edit'])->name('orgdirector.edit');
    Route::patch('orgdirector/updateverify/director/{orgdirector}', [OrgDirectorController::class, 'updateverifyDirectorInfo'])->name('orgdirector.updateverifydirector');
    Route::patch('orgdirector/update/{orgdirector}', [OrgDirectorController::class, 'update'])->name('orgdirector.update');
    Route::get('orgdirector/delete/{orgdirector}/', [OrgDirectorController::class, 'destroy'])->name('orgdirector.destroy');

            // orgadmin
    Route::get('orgadmin/get', [OrgAdminController::class, 'index'])->name('orgadmin.index');
    Route::get('orgadmins/get', [OrgAdminController::class, 'organisations'])->name('orgadmin.organisations');
    Route::get('orgadmin/get/list', [OrgAdminController::class, 'orgadminList'])->name('orgadmin.list-index');
    Route::post('orgadmin/verify/admin/', [OrgAdminController::class, 'verifyAdminInfo'])->name('orgadmin.verifyadmin');
    Route::patch('orgadmin/{orgadmin}', [OrgAdminController::class, 'store'])->name('orgadmin.store');
    Route::get('orgadmin/show/{orgadmin}', [OrgAdminController::class, 'show'])->name('orgadmin.show');
    Route::get('orgadmin/edit/{orgadmin}', [OrgAdminController::class, 'edit'])->name('orgadmin.edit');
    Route::patch('orgadmin/updateverify/admin/{orgadmin}', [OrgAdminController::class, 'updateverifyAdminInfo'])->name('orgadmin.updateverifyadmin');
    Route::patch('orgadmin/update/{orgadmin}', [OrgAdminController::class, 'update'])->name('orgadmin.update');
    Route::get('orgadmin/delete/{orgadmin}/', [OrgAdminController::class, 'destroy'])->name('orgadmin.destroy');

            // orgemployee
    Route::get('orgemployee/get', [OrgEmployeeController::class, 'index'])->name('orgemployee.index');
    Route::get('orgemployee/get/list', [OrgEmployeeController::class, 'orgemployeeList'])->name('orgemployee.list-index');
    Route::post('orgemployee/verify/employee/', [OrgEmployeeController::class, 'verifyEmployeeInfo'])->name('orgemployee.verifyemployee');
    Route::patch('orgemployee', [OrgEmployeeController::class, 'store'])->name('orgemployee.store');

        //clients
    Route::get('client/get', [ClientController::class, 'index'])->name('client.index');
    Route::get('client/get/list', [ClientController::class, 'ClientList'])->name('client.list-index');
    Route::patch('client', [ClientController::class, 'store'])->name('client.store');

    Route::get('client/show/{client}', [ClientController::class, 'show'])->name('client.show');
    Route::get('client/edit/{client}', [ClientController::class, 'edit'])->name('client.edit');
    Route::patch('client/update/{client}', [ClientController::class, 'update'])->name('client.update');
    Route::get('client/delete/{client}', [ClientController::class, 'destroy'])->name('client.destroy');
//organisation employee
    Route::get('orgemployee/show/{orgemployee}', [OrgEmployeeController::class, 'show'])->name('orgemployee.show');
    Route::get('orgemployee/edit/{orgemployee}', [OrgEmployeeController::class, 'edit'])->name('orgemployee.edit');
    Route::patch('orgemployee/updateverify/employee/{orgemployee}', [OrgEmployeeController::class, 'updateverifyEmployeeInfo'])->name('orgemployee.updateverifyemployee');
    Route::patch('orgemployee/update/{orgemployee}', [OrgEmployeeController::class, 'update'])->name('orgemployee.update');
    Route::get('orgemployee/delete/{orgemployee}/', [OrgEmployeeController::class, 'destroy'])->name('orgemployee.destroy');

    //affiliate
    Route::get('affiliate/get', [AffiliateController::class, 'index'])->name('affiliate.index');
    Route::get('affiliate/get/list/', [AffiliateController::class, 'AffiliateList'])->name('affiliate.list-index');
    Route::patch('affiliate/', [AffiliateController::class, 'store'])->name('affiliate.checkout');
    Route::get('affiliate/show/{affiliate}', [AffiliateController::class, 'show'])->name('affiliate.show');
    Route::get('affiliate/edit/{affiliate}', [AffiliateController::class, 'edit'])->name('affiliate.edit');
    Route::patch('affiliate/update/{affiliate}', [AffiliateController::class, 'update'])->name('affiliate.update');
    Route::get('affiliate/delete/{affiliate}', [AffiliateController::class, 'destroy'])->name('affiliate.destroy');


    // bureau
    Route::get('bureaus/get', [BureauController::class, 'index'])->name('bureau.index');
    Route::get('/bureau/get', [BureauController::class, 'bureauByUserID'])->name('bureau.bureauByUserID');

    Route::post('bureau/verify/info/', [BureauController::class, 'verifyBureauInfo'])->name('bureau.verify');
    Route::post('bureau/verify/director/', [BureauController::class, 'verifyDirectorInfo'])->name('bureau.verifydirector');
    Route::post('bureau', [BureauController::class, 'store'])->name('bureau.store');

    Route::get('bureau/show/{bureau}', [BureauController::class, 'show'])->name('bureau.show');
    Route::get('bureau/edit/{bureau}', [BureauController::class, 'edit'])->name('bureau.edit');
    Route::patch('bureau/updateverify/info/{bureau}', [BureauController::class, 'updateverifyBureauInfo'])->name('bureau.updateverify');
    Route::patch('bureau/updateverify/director/{bureau}', [BureauController::class, 'updateverifyDirectorInfo'])->name('bureau.updateverifydirector');
    Route::patch('bureau/update/{bureau}', [BureauController::class, 'update'])->name('bureau.update');
    Route::patch('singlebureau/update/{bureau}', [BureauController::class, 'singleupdate'])->name('bureau.update');
    Route::get('bureau/delete/{bureau}', [BureauController::class, 'destroy'])->name('bureau.destroy');

    // bureaudirector
    Route::get('bureaudirector/get', [BureauDirectorController::class, 'index'])->name('bureaudirector.index');
    Route::get('bureaudirectors/get', [BureauDirectorController::class, 'bureaus'])->name('bureaudirector.bureaus');
    Route::get('bureaudirector/get/list', [BureauDirectorController::class, 'BureauDirectorList'])->name('bureaudirector.list-index');
    Route::post('bureaudirector/verify/director/', [BureauDirectorController::class, 'verifyDirectorInfo'])->name('bureaudirector.verifydirector');
    Route::patch('bureaudirector/{bureaudirector}', [BureauDirectorController::class, 'store'])->name('bureaudirector.store');

    //  Route::get('bureaudirector/view/{bureaudirector}', [BureauDirectorController::class, 'view'])->name('bureaudirector.view');
    Route::get('bureaudirector/show/{bureaudirector}', [BureauDirectorController::class, 'show'])->name('bureaudirector.show');
    Route::get('bureaudirector/edit/{bureaudirector}', [BureauDirectorController::class, 'edit'])->name('bureaudirector.edit');
    Route::patch('bureaudirector/updateverify/director/{bureaudirector}', [BureauDirectorController::class, 'updateverifyDirectorInfo'])->name('bureaudirector.updateverifydirector');
    Route::patch('bureaudirector/update/{bureaudirector}', [BureauDirectorController::class, 'update'])->name('bureaudirector.update');
    Route::get('bureaudirector/delete/{bureaudirector}/', [BureauDirectorController::class, 'destroy'])->name('bureaudirector.destroy');

            // bureauadmin
    Route::get('bureauadmin/get', [BureauAdminController::class, 'index'])->name('bureauadmin.index');
    Route::get('bureauadmins/get', [BureauAdminController::class, 'bureaus'])->name('bureauadmin.bureaus');
    Route::get('bureauadmin/get/list', [BureauAdminController::class, 'BureauAdminList'])->name('bureauadmin.list-index');
    Route::post('bureauadmin/verify/admin/', [BureauAdminController::class, 'verifyAdminInfo'])->name('bureauadmin.verifyadmin');
    Route::patch('bureauadmin/{bureaudirector}', [BureauAdminController::class, 'store'])->name('bureauadmin.store');

    Route::get('bureauadmin/show/{bureauadmin}', [BureauAdminController::class, 'show'])->name('bureauadmin.show');
    Route::get('bureauadmin/edit/{bureauadmin}', [BureauAdminController::class, 'edit'])->name('bureauadmin.edit');
    Route::patch('bureauadmin/updateverify/admin/{bureauadmin}', [BureauAdminController::class, 'updateverifyAdminInfo'])->name('bureauadmin.updateverifyadmin');
    Route::patch('bureauadmin/update/{bureauadmin}', [BureauAdminController::class, 'update'])->name('bureauadmin.update');
    Route::get('bureauadmin/delete/{bureauadmin}/', [BureauAdminController::class, 'destroy'])->name('bureauadmin.destroy');

    // bureauemployee
    Route::get('bureauemployee/get', [BureauEmployeeController::class, 'index'])->name('bureauemployee.index');
    Route::get('bureauemployees/get', [BureauEmployeeController::class, 'bureaus'])->name('bureauemployee.bureaus');
    Route::get('bureauemployee/get/list', [BureauEmployeeController::class, 'BureauEmployeeList'])->name('bureauemployee.list-index');
    Route::post('bureauemployee/verify/employee/', [BureauEmployeeController::class, 'verifyEmployeeInfo'])->name('bureauemployee.verifyemployee');
    Route::patch('bureauemployee/{bureaudirector}', [BureauEmployeeController::class, 'store'])->name('bureauemployee.store');

    Route::get('bureauemployee/show/{bureauemployee}', [BureauEmployeeController::class, 'show'])->name('bureauemployee.show');
    Route::get('bureauemployee/edit/{bureauemployee}', [BureauEmployeeController::class, 'edit'])->name('bureauemployee.edit');
    Route::patch('bureauemployee/updateverify/employee/{bureauemployee}', [BureauEmployeeController::class, 'updateverifyEmployeeInfo'])->name('bureauemployee.updateverifyemployee');
    Route::patch('bureauemployee/update/{bureauemployee}', [BureauEmployeeController::class, 'update'])->name('bureauemployee.update');
    Route::get('bureauemployee/delete/{bureauemployee}/', [BureauEmployeeController::class, 'destroy'])->name('bureauemployee.destroy');


});

  //permissions
  Route::get('permission-list', [PermissionController::class, 'index']);
  Route::post('add-permission', [PermissionController::class, 'store']);
  Route::get('/edit/{permission}', [PermissionController::class, 'edit']);
  Route::patch('/update/{permission}', [PermissionController::class, 'update']);
  Route::get('/delete/{permission}', [PermissionController::class, 'destroy']);
  // Role Management
  Route::get('role-list', [RoleController::class, 'index']);
  Route::post('add-role', [RoleController::class, 'store']);
  Route::get('/edit/{role}', [RoleController::class, 'edit']);
  Route::patch('/update/{role}', [RoleController::class, 'update']);
  Route::get('/delete/{role}', [RoleController::class, 'destroy']);






/*
* Country Management
*/
Route::get('country/get', [CountryController::class, 'index'])->name('country.index');
Route::post('country', [CountryController::class, 'store'])->name('country.store');
//     /*
//      * Specifics
//      */
Route::get('country/show/{country}', [CountryController::class, 'show'])->name('country.show');
Route::get('country/edit/{country}', [CountryController::class, 'edit'])->name('country.edit');
Route::patch('country/update/{country}', [CountryController::class, 'update'])->name('country.update');
Route::get('country/delete/{country}/', [CountryController::class, 'destroy'])->name('country.destroy');


Route::get('county/get', [CountyController::class, 'index'])->name('county.index');
Route::post('county', [CountyController::class, 'store'])->name('county.store');
//     /*
//      * Specifics
//      */
Route::get('county/get/list/{county}', [CountyController::class, 'CountyList'])->name('county.list-index');//fetch county list bsedon country id
Route::get('county/show/{county}', [CountyController::class, 'show'])->name('county.show');
Route::get('county/edit/{county}', [CountyController::class, 'edit'])->name('county.edit');
Route::patch('county/update/{county}', [CountyController::class, 'update'])->name('county.update');
Route::get('county/delete/{county}/', [CountyController::class, 'destroy'])->name('county.destroy');

//constituency
Route::get('constituency/get', [ConstituencyController::class, 'index'])->name('constituency.index');
Route::post('constituency', [ConstituencyController::class, 'store'])->name('constituency.store');
//     /*
//      * Specifics
//      */
Route::get('constituency/get/list/{constituency}', [ConstituencyController::class, 'ConstituencyList'])->name('constituency.list-index');//fetch county list bsedon country id
Route::get('constituency/show/{constituency}', [ConstituencyController::class, 'show'])->name('constituency.show');
Route::get('constituency/edit/{constituency}', [ConstituencyController::class, 'edit'])->name('constituency.edit');
Route::patch('constituency/update/{constituency}', [ConstituencyController::class, 'update'])->name('constituency.update');
Route::get('constituency/delete/{constituency}/', [ConstituencyController::class, 'destroy'])->name('constituency.destroy');

//ward
Route::get('ward/get', [WardController::class, 'index'])->name('ward.index');
Route::get('ward/get/list/{ward}', [WardController::class, 'WardList'])->name('ward.list-index');
Route::post('ward', [WardController::class, 'store'])->name('ward.store');
//     /*
//      * Specifics
//      */
Route::get('ward/show/{ward}', [WardController::class, 'show'])->name('ward.show');
Route::get('ward/edit/{ward}', [WardController::class, 'edit'])->name('ward.edit');
Route::patch('ward/update/{ward}', [WardController::class, 'update'])->name('ward.update');
Route::get('ward/delete/{ward}', [WardController::class, 'destroy'])->name('ward.destroy');

//position
Route::get('position/get', [PositionController::class, 'index'])->name('position.index');
Route::get('position/get/list/{position}', [PositionController::class, 'PositionList'])->name('position.list-index');
Route::post('position', [PositionController::class, 'store'])->name('position.store');
//     /*
//      * Specifics
//      */
Route::get('position/show/{position}', [PositionController::class, 'show'])->name('position.show');
Route::get('position/edit/{position}', [PositionController::class, 'edit'])->name('position.edit');
Route::patch('position/update/{position}', [PositionController::class, 'update'])->name('position.update');
Route::get('position/delete/{position}', [PositionController::class, 'destroy'])->name('position.destroy');

        //relationship
Route::get('relationship/get', [RelationshipController::class, 'index'])->name('relationship.index');
Route::get('relationship/get/list/{relationship}', [RelationshipController::class, 'RelationshipList'])->name('relationship.list-index');
Route::post('relationship', [RelationshipController::class, 'store'])->name('relationship.store');
//     /*
//      * Specifics
//      */
Route::get('relationship/show/{relationship}', [RelationshipController::class, 'show'])->name('relationship.show');
Route::get('relationship/edit/{relationship}', [RelationshipController::class, 'edit'])->name('relationship.edit');
Route::patch('relationship/update/{relationship}', [RelationshipController::class, 'update'])->name('relationship.update');
Route::get('relationship/delete/{relationship}', [RelationshipController::class, 'destroy'])->name('relationship.destroy');



//gender
Route::get('gender/get', [GenderController::class, 'index'])->name('gender.index');
Route::get('gender/get/list/{gender}', [GenderController::class, 'GenderList'])->name('gender.list-index');
Route::post('gender', [GenderController::class, 'store'])->name('gender.store');
//     /*
//      * Specifics
//      */
Route::get('gender/show/{gender}', [GenderController::class, 'show'])->name('gender.show');
Route::get('gender/edit/{gender}', [GenderController::class, 'edit'])->name('gender.edit');
Route::patch('gender/update/{gender}', [GenderController::class, 'update'])->name('gender.update');
Route::get('gender/delete/{gender}', [GenderController::class, 'destroy'])->name('gender.destroy');



// organisation
Route::get('organisation/get', [OrganisationController::class, 'index'])->name('organisation.index');
Route::get('organisation/get/list', [OrganisationController::class, 'OrganisationList'])->name('organisation.list-index');
Route::post('organisation/verify/info/', [OrganisationController::class, 'verifyOrganisationInfo'])->name('organisation.verify');
Route::post('organisation/verify/director/', [OrganisationController::class, 'verifyDirectorInfo'])->name('organisation.verifydirector');
Route::post('organisation', [OrganisationController::class, 'store'])->name('organisation.store');
//     /*
//      * Specifics
//      */
Route::get('organisation/show/{organisation}', [OrganisationController::class, 'show'])->name('organisation.show');
Route::get('organisation/edit/{organisation}', [OrganisationController::class, 'edit'])->name('organisation.edit');
Route::patch('organisation/updateverify/info/{organisation}', [OrganisationController::class, 'updateverifyOrganisationInfo'])->name('organisation.updateverify');
Route::patch('organisation/updateverify/director/{organisation}', [OrganisationController::class, 'updateverifyDirectorInfo'])->name('organisation.updateverifydirector');
Route::patch('organisation/update/{organisation}', [OrganisationController::class, 'update'])->name('organisation.update');
Route::get('organisation/delete/{organisation}', [OrganisationController::class, 'destroy'])->name('organisation.destroy');




// about
Route::get('about/get', [AboutController::class, 'index'])->name('about.index');
Route::get('abouts/get', [AboutController::class, 'organisations'])->name('about.organisations');
Route::get('about/get/list', [AboutController::class, 'aboutList'])->name('about.list-index');
Route::post('about', [AboutController::class, 'store'])->name('about.store');
//     /*
//      * Specifics
//      */
Route::get('about/show/{about}', [AboutController::class, 'show'])->name('about.show');
Route::get('about/edit/{about}', [AboutController::class, 'edit'])->name('about.edit');
Route::patch('about/update/{about}', [AboutController::class, 'update'])->name('about.update');
Route::get('about/delete/{about}/', [AboutController::class, 'destroy'])->name('about.destroy');

// service
Route::get('service/get', [ServiceController::class, 'index'])->name('service.index');
Route::get('service/get/list', [ServiceController::class, 'organisations'])->name('service.list-index');
Route::post('service', [ServiceController::class, 'store'])->name('service.store');
//     /*
//      * Specifics
//      */
Route::get('service/show/{service}', [ServiceController::class, 'show'])->name('service.show');
Route::get('service/edit/{service}', [ServiceController::class, 'edit'])->name('service.edit');
Route::patch('service/update/{service}', [ServiceController::class, 'update'])->name('service.update');
Route::get('service/delete/{service}/', [ServiceController::class, 'destroy'])->name('service.destroy');


        // servicemodel
Route::get('servicemodel/get', [ServiceModelController::class, 'index'])->name('servicemodel.index');
Route::get('servicemodel/latest', [ServiceModelController::class, 'latestservicemodels'])->name('servicemodel.latest');
Route::patch('servicemodel/{servicemodel}', [ServiceModelController::class, 'store'])->name('servicemodel.store');
//     /*
//      * Specifics
//      */
Route::get('servicemodel/show/{servicemodel}', [ServiceModelController::class, 'show'])->name('servicemodel.show');
Route::get('servicemodel/fetch/{servicemodel}', [ServiceModelController::class, 'ServiceModelsByServiceID'])->name('servicemodel.ServiceModelsByServiceID');
Route::get('servicemodel/fetch/latest/{servicemodel}', [ServiceModelController::class, 'LatestServiceModelsByServiceID'])->name('servicemodel.latestServiceModelByServiceID');
Route::get('servicemodel/fetch/latest/singlemodel/{servicemodel}', [ServiceModelController::class, 'LatestServiceModelsBySingleModelID'])->name('servicemodel.LatestServiceModelsBySingleModelID');
Route::get('servicemodel/search', [ServiceModelController::class, 'search'])->name('servicemodel.search');
Route::get('servicemodel/edit/{servicemodel}', [ServiceModelController::class, 'edit'])->name('servicemodel.edit');
Route::patch('servicemodel/update/{servicemodel}', [ServiceModelController::class, 'update'])->name('servicemodel.update');
Route::get('servicemodel/delete/{servicemodel}/', [ServiceModelController::class, 'destroy'])->name('servicemodel.destroy');


// features
Route::get('feature/get', [FeatureController::class, 'index'])->name('feature.index');
Route::get('features/get', [FeatureController::class, 'organisations'])->name('feature.organisations');
Route::get('feature/get/list', [FeatureController::class, 'aboutList'])->name('feature.list-index');
Route::post('feature', [FeatureController::class, 'store'])->name('feature.store');
//     /*
//      * Specifics
//      */
Route::get('feature/show/{feature}', [FeatureController::class, 'show'])->name('feature.show');
Route::get('feature/edit/{feature}', [FeatureController::class, 'edit'])->name('feature.edit');
Route::patch('feature/update/{feature}', [FeatureController::class, 'update'])->name('feature.update');
Route::get('feature/delete/{feature}/', [FeatureController::class, 'destroy'])->name('feature.destroy');

// adverts
Route::get('advert/get', [AdvertController::class, 'index'])->name('advert.index');
Route::get('adverts/get', [AdvertController::class, 'organisations'])->name('advert.organisations');
Route::get('advert/get/list', [AdvertController::class, 'aboutList'])->name('advert.list-index');
Route::post('advert', [AdvertController::class, 'store'])->name('advert.store');
//     /*
//      * Specifics
//      */
Route::get('advert/show/{advert}', [AdvertController::class, 'show'])->name('advert.show');
Route::get('advert/edit/{advert}', [AdvertController::class, 'edit'])->name('advert.edit');
Route::patch('advert/update/{advert}', [AdvertController::class, 'update'])->name('advert.update');
Route::get('advert/delete/{advert}/', [AdvertController::class, 'destroy'])->name('advert.destroy');


//filters

Route::get('duration/get', [DurationController::class, 'index'])->name('duration.index');
Route::get('duration/get/list/{duration}', [DurationController::class, 'DurationList'])->name('duration.list-index');
Route::post('duration', [DurationController::class, 'store'])->name('duration.store');
//     /*
//      * Specifics
//      */
Route::get('duration/show/{duration}', [DurationController::class, 'show'])->name('duration.show');
Route::get('duration/edit/{duration}', [DurationController::class, 'edit'])->name('duration.edit');
Route::patch('duration/update/{duration}', [DurationController::class, 'update'])->name('duration.update');
Route::get('duration/delete/{duration}', [DurationController::class, 'destroy'])->name('duration.destroy');

Route::get('education/get', [EducationController::class, 'index'])->name('education.index');
Route::get('education/get/list/{education}', [EducationController::class, 'EducationList'])->name('education.list-index');
Route::post('education', [EducationController::class, 'store'])->name('education.store');

Route::get('education/show/{education}', [EducationController::class, 'show'])->name('education.show');
Route::get('education/edit/{education}', [EducationController::class, 'edit'])->name('education.edit');
Route::patch('education/update/{education}', [EducationController::class, 'update'])->name('education.update');
Route::get('education/delete/{education}', [EducationController::class, 'destroy'])->name('education.destroy');


Route::get('englishstatus/get', [EnglishstatusController::class, 'index'])->name('englishstatus.index');
Route::get('englishstatus/get/list/{englishstatus}', [EnglishstatusController::class, 'EnglishstatusList'])->name('englishstatus.list-index');
Route::post('englishstatus', [EnglishstatusController::class, 'store'])->name('englishstatus.store');

Route::get('englishstatus/show/{englishstatus}', [EnglishstatusController::class, 'show'])->name('englishstatus.show');
Route::get('englishstatus/edit/{englishstatus}', [EnglishstatusController::class, 'edit'])->name('englishstatus.edit');
Route::patch('englishstatus/update/{englishstatus}', [EnglishstatusController::class, 'update'])->name('englishstatus.update');
Route::get('englishstatus/delete/{englishstatus}', [EnglishstatusController::class, 'destroy'])->name('englishstatus.destroy');


Route::get('experience/get', [ExperienceController::class, 'index'])->name('experience.index');
Route::get('experience/get/list/{experience}', [ExperienceController::class, 'ExperienceList'])->name('experience.list-index');
Route::post('experience', [ExperienceController::class, 'store'])->name('experience.store');
//     /*
//      * Specifics
//      */
Route::get('experience/show/{experience}', [ExperienceController::class, 'show'])->name('experience.show');
Route::get('experience/edit/{experience}', [ExperienceController::class, 'edit'])->name('experience.edit');
Route::patch('experience/update/{experience}', [ExperienceController::class, 'update'])->name('experience.update');
Route::get('experience/delete/{experience}', [ExperienceController::class, 'destroy'])->name('experience.destroy');

Route::get('kid/get', [KidController::class, 'index'])->name('kid.index');
Route::get('kid/get/list/{kid}', [KidController::class, 'KidList'])->name('kid.list-index');
Route::post('kid', [KidController::class, 'store'])->name('kid.store');
//     /*
//      * Specifics
//      */
Route::get('kid/show/{kid}', [KidController::class, 'show'])->name('kid.show');
Route::get('kid/edit/{kid}', [KidController::class, 'edit'])->name('kid.edit');
Route::patch('kid/update/{kid}', [KidController::class, 'update'])->name('kid.update');
Route::get('kid/delete/{kid}', [KidController::class, 'destroy'])->name('kid.destroy');

Route::get('maritalstatus/get', [MaritalstatusController::class, 'index'])->name('maritalstatus.index');
Route::get('maritalstatus/get/list/{maritalstatus}', [MaritalstatusController::class, 'MaritalstatusList'])->name('maritalstatus.list-index');
Route::post('maritalstatus', [MaritalstatusController::class, 'store'])->name('maritalstatus.store');
//     /*
//      * Specifics
//      */
Route::get('maritalstatus/show/{maritalstatus}', [MaritalstatusController::class, 'show'])->name('maritalstatus.show');
Route::get('maritalstatus/edit/{maritalstatus}', [MaritalstatusController::class, 'edit'])->name('maritalstatus.edit');
Route::patch('maritalstatus/update/{maritalstatus}', [MaritalstatusController::class, 'update'])->name('maritalstatus.update');
Route::get('maritalstatus/delete/{maritalstatus}', [MaritalstatusController::class, 'destroy'])->name('maritalstatus.destroy');

Route::get('operation/get', [OperationController::class, 'index'])->name('operation.index');
Route::get('operation/get/list/{operation}', [OperationController::class, 'OperationList'])->name('operation.list-index');
Route::post('operation', [OperationController::class, 'store'])->name('operation.store');
//     /*
//      * Specifics
//      */
Route::get('operation/show/{operation}', [OperationController::class, 'show'])->name('operation.show');
Route::get('operation/edit/{operation}', [OperationController::class, 'edit'])->name('operation.edit');
Route::patch('operation/update/{operation}', [OperationController::class, 'update'])->name('operation.update');
Route::get('operation/delete/{operation}', [OperationController::class, 'destroy'])->name('operation.destroy');

Route::get('religion/get', [ReligionController::class, 'index'])->name('religion.index');
Route::get('religion/get/list/{religion}', [ReligionController::class, 'ReligionList'])->name('religion.list-index');
Route::post('religion', [ReligionController::class, 'store'])->name('religion.store');
//     /*
//      * Specifics
//      */
Route::get('religion/show/{religion}', [ReligionController::class, 'show'])->name('religion.show');
Route::get('religion/edit/{religion}', [ReligionController::class, 'edit'])->name('religion.edit');
Route::patch('religion/update/{religion}', [ReligionController::class, 'update'])->name('religion.update');
Route::get('religion/delete/{religion}', [ReligionController::class, 'destroy'])->name('religion.destroy');

Route::get('skill/get', [SkillController::class, 'index'])->name('skill.index');
Route::get('skill/get/list/{skill}', [SkillController::class, 'SkillList'])->name('skill.list-index');
Route::post('skill', [SkillController::class, 'store'])->name('skill.store');
//     /*
//      * Specifics
//      */
Route::get('skill/show/{skill}', [SkillController::class, 'show'])->name('skill.show');
Route::get('skill/edit/{skill}', [SkillController::class, 'edit'])->name('skill.edit');
Route::patch('skill/update/{skill}', [SkillController::class, 'update'])->name('skill.update');
Route::get('skill/delete/{skill}', [SkillController::class, 'destroy'])->name('skill.destroy');

Route::get('tribe/get', [TribeController::class, 'index'])->name('tribe.index');
Route::get('tribe/get/list/{tribe}', [TribeController::class, 'TribeList'])->name('tribe.list-index');
Route::post('tribe', [TribeController::class, 'store'])->name('tribe.store');
//     /*
//      * Specifics
//      */
Route::get('tribe/show/{tribe}', [TribeController::class, 'show'])->name('tribe.show');
Route::get('tribe/edit/{tribe}', [TribeController::class, 'edit'])->name('tribe.edit');
Route::patch('tribe/update/{tribe}', [TribeController::class, 'update'])->name('tribe.update');
Route::get('tribe/delete/{tribe}', [TribeController::class, 'destroy'])->name('tribe.destroy');



Route::get('idstatus/get', [IDstatusController::class, 'index'])->name('idstatus.index');
Route::get('idstatus/get/list/{idstatus}', [IDstatusController::class, 'IdstatusList'])->name('idstatus.list-index');
Route::post('idstatus', [IDstatusController::class, 'store'])->name('idstatus.store');
//     /*
//      * Specifics
//      */
Route::get('idstatus/show/{idstatus}', [IDstatusController::class, 'show'])->name('idstatus.show');
Route::get('idstatus/edit/{idstatus}', [IDstatusController::class, 'edit'])->name('idstatus.edit');
Route::patch('idstatus/update/{idstatus}', [IDstatusController::class, 'update'])->name('idstatus.update');
Route::get('idstatus/delete/{idstatus}', [IDstatusController::class, 'destroy'])->name('idstatus.destroy');

Route::get('healthstatus/get', [HealthstatusController::class, 'index'])->name('healthstatus.index');
Route::get('healthstatus/get/list/{healthstatus}', [HealthstatusController::class, 'HealthstatusList'])->name('healthstatus.list-index');
Route::post('healthstatus', [HealthstatusController::class, 'store'])->name('healthstatus.store');
//     /*
//      * Specifics
//      */
Route::get('healthstatus/show/{healthstatus}', [HealthstatusController::class, 'show'])->name('healthstatus.show');
Route::get('healthstatus/edit/{healthstatus}', [HealthstatusController::class, 'edit'])->name('healthstatus.edit');
Route::patch('healthstatus/update/{healthstatus}', [HealthstatusController::class, 'update'])->name('healthstatus.update');
Route::get('healthstatus/delete/{healthstatus}', [HealthstatusController::class, 'destroy'])->name('healthstatus.destroy');

   //househelp
   Route::get('househelp/get', [HousehelpController::class, 'index'])->name('househelp.index');//front
   Route::get('househelp/bureau/get', [HousehelpController::class, 'bureau'])->name('househelp.bureau');
   Route::get('househelp/get/list', [HousehelpController::class, 'HousehelpsList'])->name('househelp.index');//login details edit by supperadmin

   Route::get('househelp/get/unemployed', [HousehelpController::class, 'unemployed'])->name('househelp.unemployed'); //view househelps
   Route::get('househelp/get/employed', [HousehelpController::class, 'employed'])->name('househelp.unemployed');
   Route::get('househelp/get/pending', [HousehelpController::class, 'pending'])->name('househelp.pending');

//    by bureau id veiwded by organisation through bureaus
   Route::get('househelp/get/unemployed/{househelp}', [HousehelpController::class, 'bureau_id_unemployed'])->name('househelp.unemployed'); //view househelps
   Route::get('househelp/get/employed/{househelp}', [HousehelpController::class, 'bureau_id_employed'])->name('househelp.unemployed');
   Route::get('househelp/get/pending/{househelp}', [HousehelpController::class, 'bureau_id_pending'])->name('househelp.pending');

   Route::get('agehousehelps/get', [HousehelpController::class, 'age'])->name('agehousehelp.index');
   Route::get('genderhousehelps/get/{househelp}', [HousehelpController::class, 'gender'])->name('genderhousehelp.index');
   Route::get('educationhousehelps/get/{househelp}', [HousehelpController::class, 'education'])->name('educationhousehelp.index');
   Route::get('durationhousehelps/get/{househelp}', [HousehelpController::class, 'duration'])->name('durationhousehelp.index');
   Route::get('experiencehousehelps/get/{househelp}', [HousehelpController::class, 'experience'])->name('experiencehousehelp.index');
   Route::get('maritalstatushousehelps/get/{househelp}', [HousehelpController::class, 'maritalstatus'])->name('maritalstatushousehelp.index');
   Route::get('operationhousehelps/get/{househelp}', [HousehelpController::class, 'operation'])->name('operationhousehelp.index');
   Route::get('skillhousehelps/get/{househelp}', [HousehelpController::class, 'skill'])->name('skillhousehelp.index');
   Route::get('religionhousehelps/get/{househelp}', [HousehelpController::class, 'religion'])->name('religionhousehelp.index');
   Route::get('tribehousehelps/get/{househelp}', [HousehelpController::class, 'tribe'])->name('tribehousehelp.index');
   Route::post('househelpfilter/get', [HousehelpController::class, 'filter'])->name('househelp.filter');
   Route::post('househelp/verify/demographics/', [HousehelpController::class, 'verifyDemographics'])->name('househelp.verifydemographics');



   Route::post('househelp/verify/attributes/', [HousehelpController::class, 'verifyAttributes'])->name('househelp.verifyattributes');
   Route::post('househelp/verify/kin/', [HousehelpController::class, 'verifyKin'])->name('househelp.verifykin');
   Route::patch('househelp/{bureau}', [HousehelpController::class, 'store'])->name('househelp.store');    //     /*

   Route::get('househelp/show/{househelp}', [HousehelpController::class, 'show'])->name('househelp.show');
   Route::get('househelp/edit/{househelp}', [HousehelpController::class, 'edit'])->name('househelp.edit');
   Route::patch('househelp/verify/updatedemographics/{househelp}', [HousehelpController::class, 'verifyUpdateDemographics'])->name('househelp.Demographics');
   Route::patch('househelp/verify/updateattributes/{househelp}', [HousehelpController::class, 'verifyUpdateAttributes'])->name('househelp.Attributes');
   Route::patch('househelp/update/{househelp}', [HousehelpController::class, 'update'])->name('househelp.update');
   Route::get('househelp/delete/{househelp}/', [HousehelpController::class, 'destroy'])->name('househelp.destroy');

   //  Househelpkin
   Route::get('househelpkin/get', [HousehelpkinController::class, 'index'])->name('househelpkin.index');
   Route::patch('househelpkin/{househelpkin}', [HousehelpkinController::class, 'store'])->name('househelpkin.store');
   Route::get('househelpkin/show/{househelpkin}', [HousehelpkinController::class, 'show'])->name('househelpkin.show');
   Route::get('househelpkin/edit/{househelpkin}', [HousehelpkinController::class, 'edit'])->name('househelpkin.edit');
   Route::patch('househelpkin/update/{househelpkin}', [HousehelpkinController::class, 'update'])->name('househelpkin.update');
   Route::get('househelpkin/delete/{househelpkin}/', [HousehelpkinController::class, 'destroy'])->name('househelpkin.destroy');


//cart
Route::get('cart/get', [CartController::class, 'index'])->name('cart.index');
Route::patch('cart', [CartController::class, 'store'])->name('cart.store');
//     /*
//      * Specifics
//      */
Route::get('cart/show/{cart}', [CartController::class, 'show'])->name('cart.show');
Route::get('cart/edit/{cart}', [CartController::class, 'edit'])->name('cart.edit');
Route::patch('cart/update/{cart}', [CartController::class, 'update'])->name('cart.update');
Route::get('cart/remove/{cart}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('cart/clear/{cart}', [CartController::class, 'clear'])->name('cart.clear');
Route::patch('cart/checkout/{cart}', [CartController::class, 'checkout'])->name('cart.checkout');


Route::get('order/get', [OrderController::class, 'index'])->name('order.index');
Route::get('order/get/list/{order}', [OrderController::class, 'OrderList'])->name('order.list-index');
Route::patch('order/checkout/{order}', [OrderController::class, 'store'])->name('order.checkout');
//     /*rev
//      * Specifics
//      */
Route::get('order/show/{order}', [OrderController::class, 'show'])->name('order.show');
Route::get('order/edit/{order}', [OrderController::class, 'edit'])->name('order.edit');
Route::patch('order/update/{order}', [OrderController::class, 'update'])->name('order.update');
Route::get('order/delete/{order}', [OrderController::class, 'destroy'])->name('order.destroy');



//refferal links
Route::get('referralLink/get', [ReferralLinkController::class, 'index'])->name('referralLink.index');
Route::get('referralLink/get/list/{referralLink}', [ReferralLinkController::class, 'ReferralLinkList'])->name('referralLink.list-index');
Route::patch('referralLink/', [ReferralLinkController::class, 'store'])->name('referralLink.store');

Route::get('referralLink/show/{referralLink}', [ReferralLinkController::class, 'show'])->name('referralLink.show');
Route::get('referralLink/edit/{referralLink}', [ReferralLinkController::class, 'edit'])->name('referralLink.edit');
Route::patch('referralLink/update/{referralLink}', [ReferralLinkController::class, 'update'])->name('referralLink.update');
Route::get('referralLink/delete/{referralLink}', [ReferralLinkController::class, 'destroy'])->name('referralLink.destroy');

//sharelinks
Route::get('sharelink/get', [SharelinkController::class, 'index'])->name('sharelink.index');
Route::get('sharelink/get/list/{sharelink}', [SharelinkController::class, 'SharelinkList'])->name('sharelink.list-index');
Route::patch('sharelink', [SharelinkController::class, 'store'])->name('sharelink.store');

Route::get('sharelink/show/{sharelink}', [SharelinkController::class, 'show'])->name('sharelink.show');
Route::get('sharelink/edit/{sharelink}', [SharelinkController::class, 'edit'])->name('sharelink.edit');
Route::patch('sharelink/update/{sharelink}', [SharelinkController::class, 'update'])->name('sharelink.update');
Route::get('sharelink/delete/{sharelink}', [SharelinkController::class, 'destroy'])->name('sharelink.destroy');

//reviews             // review
Route::get('review/get', [ReviewController::class, 'index'])->name('review.index');
Route::get('reviews/get', [ReviewController::class, 'bureaus'])->name('review.bureaus');

//    by bureau id veiwded by organisation through bureaus
Route::get('review/get/approved/{review}', [ReviewController::class, 'bureau_id_approved']); //view househelps
Route::get('review/get/pending/{review}', [ReviewController::class, 'bureau_id_pending']);

Route::get('review/get/approved', [ReviewController::class, 'approved']); //view househelps
Route::get('review/get/pending', [ReviewController::class, 'pending']);


Route::patch('review/{review}', [ReviewController::class, 'store'])->name('review.store');
Route::get('review/show/{review}', [ReviewController::class, 'show'])->name('review.show');
Route::get('review/edit/{review}', [ReviewController::class, 'edit'])->name('review.edit');
Route::patch('review/update/{review}', [ReviewController::class, 'update'])->name('review.update');
Route::get('review/delete/{review}/', [ReviewController::class, 'destroy'])->name('review.destroy');



