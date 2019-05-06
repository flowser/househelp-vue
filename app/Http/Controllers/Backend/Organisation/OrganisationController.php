<?php

namespace App\Http\Controllers\Backend\Organisation;

use Illuminate\Http\Request;
use App\Models\Standard\User;
use Propaganistas\LaravelPhone\PhoneNumber;
use App\Models\Standard\Position;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Models\Organisation\Organisation;
use App\Models\Organisation\OrganisationDirector;

class OrganisationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organisation = Organisation::
                        with('country', 'county', 'constituency', 'ward', 'organisationdirectors','organisationadmins',
                         'organisationemployees', 'about','services', 'servicemodels', 'adverts', 'features')
                        ->first();

        return response()-> json([
            'organisation' => $organisation,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * OrganisationInfo
     */

    public function store(Request $request)
    {
        // return $request;
        // director user
        $user = new User();
        $user->first_name = $request->director_first_name;
        $user->last_name  = $request->director_last_name;
        $user->email      = $request->email;
        $user->active     = true;
        $user->confirmed  = true;
        $user->confirmation_code = md5(uniqid(mt_rand(), true));
        $user->user_type      = 'Organisation Director';
        $user->password   = Hash::make($request->director_password);

        $user->assignRole('Organisation Director');
        $user ->givePermissionTo('View Backend', 'View All');

        if($user){
            //adding organisation new

            $organisation = new Organisation();
            $organisation->name = $request ->name;
            $organisation->email = $request ->email;
            $organisation->phone = PhoneNumber::make($request->phone);
            $organisation->landline = PhoneNumber::make($request->landline);
            $organisation->website = $request ->website;
            $organisation->address = $request ->address;
            $organisation->active = true;
            $organisation->country_id = $request ->country_id;
            $organisation->county_id = $request ->county_id;
            $organisation->constituency_id = $request ->constituency_id;
            $organisation->ward_id = $request ->ward_id;

            // $organisation->logo = $request ->logo;
            //processing logo nme and size
            $strpos = strpos($request->logo, ';'); //positionof image name semicolon
            $sub = substr($request->logo, 0, $strpos);
            $ex = explode('/', $sub)[1];
            $name = time().".".$ex;

            $Path = public_path()."/assets/organisation/img/logo";
                $img = Image::make($request->logo);
                $img ->save($Path.'/'.$name);
            $organisation->logo = $name;
            //end processing logo and size

            //assigning added user as director to the organisation
            if($organisation){

                $user_id = $user->id;
                $organisation_id = $organisation->id;
                $position_id = Position::find(1);

                $organisationdirector = new OrganisationDirector();
                $organisationdirector->user_id                = $user_id;
                $organisationdirector->organisation_id        = $organisation_id;
                $organisationdirector->position_id            = $position_id;
                $organisationdirector->gender_id              = $request ->gender_id;

                $organisationdirector->active                 = true;
                $organisationdirector->director_phone         = $request ->director_phone;
                $organisationdirector->director_landline      = $request ->director_landline;
                $organisationdirector->director_id_no         = $request ->director_id_no;
                $organisationdirector->director_address        = $request ->director_address;

                $organisationdirector->director_country_id    = $request ->director_country_id;
                $organisationdirector->director_county_id     = $request ->director_county_id;
                $organisationdirector->director_constituency_id  = $request ->director_constituency_id;
                $organisationdirector->director_ward_id  = $request ->director_ward_id;

                //pass port
                $passport = $request->director_passport_image;
                if($passport){
                     //processing passport name
                     $ps_strpos = strpos($passport, ';'); //positionof image name semicolon
                     $ps_sub = substr($passport, 0, $ps_strpos);
                     $ps_ex = explode('/', $ps_sub)[1];
                     $ps_name = time().".".$ps_ex;

                     $ps_Path = public_path()."/assets/organisation/img/directors/passports";
                         $ps_img = Image::make($passport);
                         $ps_img ->save($ps_Path.'/'.$ps_name);
                     //end processing
                    $organisationdirector->director_passport_image = $ps_name;
                }
                //director Front side id image
                $frontside_id = $request->frontside_director_id_photo;
                if($frontside_id){
                     //processing front side id imagee
                     $fr_id_strpos = strpos($frontside_id, ';');
                     $fr_id_sub = substr($frontside_id, 0, $fr_id_strpos);
                     $fr_id_ex = explode('/', $fr_id_sub)[1];
                     $fr_id_name = time().".".$fr_id_ex;

                     $fr_id_Path = public_path()."/assets/organisation/img/directors/IDs/front";
                         $fr_id_img = Image::make($frontside_id);
                         $fr_id_img ->save($fr_id_Path.'/'.$fr_id_name);
                     //end processing
                    $organisationdirector->frontside_director_id_photo = $fr_id_name;
                }
                //director Front side id image
                $backside_id = $request->backside_director_id_photo;
                if($backside_id){
                     //processing front side id imagee
                     $bs_id_strpos = strpos($backside_id, ';');
                     $bs_id_sub = substr($backside_id, 0, $bs_id_strpos);
                     $bs_id_ex = explode('/', $bs_id_sub)[1];
                     $bs_id_name = time().".".$bs_id_ex;

                     $bs_id_Path = public_path()."/assets/organisation/img/directors/IDs/back";
                         $bs_id_img = Image::make($backside_id);
                         $bs_id_img ->save($bs_id_Path.'/'.$bs_id_name);
                     //end processing
                    $organisationdirector->backside_director_id_photo = $bs_id_name;
                }
                $organisationdirector->save();
            }
            $organisation->save();
        }
        $user->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $organisation = Organisation::with('country', 'county', 'constituency', 'ward', 'organisationdirectors','organisationadmins',
                                        'organisationemployees')
                                    ->find($id);
        return response()-> json([
            'organisation' => $organisation,
        ], 200);
    }



    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'    => 'required|min:2|max:50',
            'organisation_email' => 'required|email|max:255',
            'phone' => 'phone:AUTO,MOBILE',
            'landline'=> 'phone:AUTO,MOBILE', //FIXED_LINE
            'website'=> 'required|min:2|max:50',
            'address'=> 'required|digits_between:1,20',
            'country_id'=> 'required',
            'county_id'=> 'required',
            'constituency_id'=> 'required',
            'ward_id'=> 'required',
   ]);
        $organisation = Organisation::find($id);

        if($organisation){
            $organisation->name = $request ->name;
            $organisation->organisation_email = $request ->organisation_email;
            $organisation->phone = PhoneNumber::make($request->phone);
            $organisation->landline = PhoneNumber::make($request->landline);
            $organisation->website = $request ->website;
            $organisation->address = $request ->address;
            $organisation->country_id = $request ->country_id;
            $organisation->county_id = $request ->county_id;
            $organisation->constituency_id = $request ->constituency_id;
            $organisation->ward_id = $request ->ward_id;

            // $organisation->logo = $request ->logo;
            //getting previous logo
            $currentLogo =  $organisation->logo;

            //processing logo nme and size
            if($request->logo != $currentLogo){
                $Path = public_path()."/assets/organisation/img/logo/";

                $S_currentLogo = $Path. $currentLogo;
                //deleting if exists
                    if(file_exists($S_currentLogo)){
                        @unlink($S_currentLogo);
                    }
                    $strpos = strpos($request->logo, ';'); //positionof image name semicolon
                    $sub = substr($request->logo, 0, $strpos);
                    $ex = explode('/', $sub)[1];
                    $name = time().".".$ex;

                $img = Image::make($request->logo);
                        $img ->save($Path.'/'.$name);
                    //end processing logo and size

            }else{//$request->logo = $currentLogo
                $name = $organisation->logo;
            }
            $organisation->logo = $name;
        $organisation->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $organisation = Organisation::findOrFail($id);
        $organisationdirectors = $organisation->organisationdirectors()->get();
         foreach($organisationdirectors as $organisationdirector){
            $user = $organisationdirector->user()->first();
            //curent passport of director
            $ps_Path = public_path()."/assets/organisation/img/directors/passports/";
                $ps_currentpassport = $ps_Path. $organisationdirector->director_passport_image;
            if(file_exists($ps_currentpassport)){
                @unlink($ps_currentpassport);
            }
            //current id front of director
            $fr_id_Path = public_path()."/assets/organisation/img/directors/IDs/front/";
            $fr_id_currentdIDPhoto = $fr_id_Path. $organisationdirector->frontside_director_id_photo;
            if(file_exists($fr_id_currentdIDPhoto)){
                @unlink($fr_id_currentdIDPhoto);
            }
            //current id back of director
            $bs_id_Path = public_path()."/assets/organisation/img/directors/IDs/back/";
            $bs_id_currentdIDPhoto = $bs_id_Path. $organisationdirector->backside_director_id_photo;

            if(file_exists($bs_id_currentdIDPhoto)){
                @unlink($bs_id_currentdIDPhoto);
            }

         }

        //image inline with this organisation
        $Path = public_path()."/assets/organisation/img/logo/";

        $S_image = $Path. $organisation->logo;

        if(file_exists($S_image)){
            @unlink($S_image);
        }



        $organisation->delete();
    }
}
