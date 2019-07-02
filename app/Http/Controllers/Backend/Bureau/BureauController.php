<?php

namespace App\Http\Controllers\Backend\Bureau;

use Illuminate\Http\Request;
use App\Models\Bureau\Bureau;
use App\Models\Standard\User;
use App\Models\Standard\Gender;
use App\Models\Standard\Position;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Bureau\BureauDirector;
use Intervention\Image\Facades\Image;
use App\Models\Organisation\Organisation;
use Propaganistas\LaravelPhone\PhoneNumber;



class BureauController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $bureaus = Bureau::
                        with('country', 'county', 'constituency', 'ward')
                        ->paginate(10);

        return response()-> json([
            'bureaus' => $bureaus,
        ], 200);
    }

    //get own bureau according to login details
    public function bureauByUserID(Request $request)
    {
        if (auth()->check()) {
            if (auth()->user()->hasRole('Bureau Director')) {
                $bureaudirector = auth('api')->user()->bureaudirectors()->first();
                $bureau = Bureau::with('country', 'county', 'constituency', 'ward', 'bureaudirectors','bureauadmins',
                            'bureauemployees', 'bureauhousehelps')
                            ->where('id', $bureaudirector->bureau_id)
                            ->first();
                    return response()-> json([
                        'bureau' => $bureau,
                    ], 200);

            }
            elseif(auth()->user()->hasRole('Bureau Admin')){
                $bureauadmin = auth('api')->user()->bureauadmins()->first();
                // return  $bureauadmin->bureau_id;
                $bureau = Bureau::with('country', 'county', 'constituency', 'ward', 'bureaudirectors','bureauadmins',
                            'bureauemployees', 'bureauhousehelps')
                            ->where('id', $bureauadmin->bureau_id)
                            ->first();
                return response()-> json([
                    'bureau' => $bureau,
                ], 200);

            }elseif(auth()->user()->hasRole('Bureau Employee')){
                $bureauemployee = auth('api')->user()->bureauemployees()->first();
                $bureau = Bureau::with('country', 'county', 'constituency', 'ward', 'bureaudirectors','bureauadmins',
                            'bureauemployees', 'bureauhousehelps')
                            ->where('id', $bureauemployee->bureau_id)
                            ->first();
                return response()-> json([
                    'bureau' => $bureau,
                ], 200);
            }
        }
    }


    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * BureauInfo
     */
    public function verifyBureauInfo (Request $request)
    {
        $this->validate($request,[
                'name'    => 'required|min:2|max:50',
                'bureau_email' => 'required|email|max:255|unique:bureaus',
                'phone' => 'phone:AUTO,MOBILE',
                'landline'=> 'phone:AUTO,MOBILE', //FIXED_LINE
                'website'=> 'required|min:2|max:50',
                'address'=> 'required|digits_between:1,20',
                'country_id'=> 'required',
                'county_id'=> 'required',
                'constituency_id'=> 'required',
                'ward_id'=> 'required',
       ]);
    }
    public function verifyDirectorInfo (Request $request)
    {
        $this->validate($request,[
            'director_first_name'  =>  'required',
            'director_last_name'  =>  'required',
            'email'  =>  'required|email|max:255|unique:users',
            'director_password'  =>  'required',
            'director_phone'  =>  'phone:AUTO,MOBILE',
            'director_landline'  =>  'phone:AUTO,MOBILE',
            'director_id_no'  =>  'required|digits_between:7,10',
            'director_address'  =>  'required|digits_between:1,20',
            // 'gender_id'  =>  'required',
            'director_country_id'  =>  'required',
            'director_county_id'  =>  'required',
            'director_constituency_id'  =>  'required',
            'director_ward_id'  =>  'required',
            'director_passport_image'  =>  'required',
            'frontside_director_id_photo'  =>  'required',
            'backside_director_id_photo'  =>  'required',
       ]);
    }

    public function store(Request $request)
    {

        //geting organistion id
        $organisation= Organisation::first();
        if ($organisation){
            $bureau = new Bureau();
            $bureau->name = $request ->name;
            $bureau->bureau_email = $request ->bureau_email;
            $bureau->phone = PhoneNumber::make($request->phone);
            $bureau->landline = PhoneNumber::make($request->landline);
            $bureau->website = $request ->website;
            $bureau->address = $request ->address;
            $bureau->active = true;
            $bureau->organisation_id = $organisation->id;
            $bureau->country_id = $request ->country_id;
            $bureau->county_id = $request ->county_id;
            $bureau->constituency_id = $request ->constituency_id;
            $bureau->ward_id = $request ->ward_id;

            // $bureau->logo = $request ->logo;
            //processing logo nme and size
            $strpos = strpos($request->logo, ';'); //positionof image name semicolon
            $sub = substr($request->logo, 0, $strpos);
            $ex = explode('/', $sub)[1];
            $name = time().".".$ex;

            $Path = public_path()."/assets/bureau/img/logo";
                $img = Image::make($request->logo);
                $img ->save($Path.'/'.$name);
            $bureau->logo = $name;
            //end processing logo and size
            $bureau->save();
        }
            if ($bureau){
                $user = new User();
                $user->first_name = $request->director_first_name;
                $user->last_name  = $request->director_last_name;
                $user->email      = $request->email;
                $user->active     = true;
                $user->confirmed  = true;
                $user->confirmation_code = md5(uniqid(mt_rand(), true));
                $user->user_type      = 'Bureau Director';
                $user->password   = Hash::make($request->director_password);

                $user->assignRole('Bureau Director');
                $user ->givePermissionTo('View Backend', 'View All');

                    $passport = $request->director_passport_image;
                    if($passport){
                         //processing passport name
                         $ps_strpos = strpos($passport, ';'); //positionof image name semicolon
                         $ps_sub = substr($passport, 0, $ps_strpos);
                         $ps_ex = explode('/', $ps_sub)[1];
                         $ps_name = time().".".$ps_ex;

                         $ps_Path = public_path()."/assets/bureau/img/directors/passports";
                             $ps_img = Image::make($passport);
                             $ps_img ->save($ps_Path.'/'.$ps_name);
                         //end processing
                        $photo= $ps_name;
                    }
                    //director Front side id image
                    $frontside_id = $request->frontside_director_id_photo;
                    if($frontside_id){
                         //processing front side id imagee
                         $fr_id_strpos = strpos($frontside_id, ';');
                         $fr_id_sub = substr($frontside_id, 0, $fr_id_strpos);
                         $fr_id_ex = explode('/', $fr_id_sub)[1];
                         $fr_id_name = time().".".$fr_id_ex;

                         $fr_id_Path = public_path()."/assets/bureau/img/directors/IDs/front";
                             $fr_id_img = Image::make($frontside_id);
                             $fr_id_img ->save($fr_id_Path.'/'.$fr_id_name);
                         //end processing
                        $id_photo_front = $fr_id_name;
                    }
                    $backside_id = $request->backside_director_id_photo;
                    if($backside_id){
                         //processing front side id imagee
                         $bs_id_strpos = strpos($backside_id, ';');
                         $bs_id_sub = substr($backside_id, 0, $bs_id_strpos);
                         $bs_id_ex = explode('/', $bs_id_sub)[1];
                         $bs_id_name = time().".".$bs_id_ex;

                         $bs_id_Path = public_path()."/assets/bureau/img/directors/IDs/back";
                             $bs_id_img = Image::make($backside_id);
                             $bs_id_img ->save($bs_id_Path.'/'.$bs_id_name);
                         //end processing
                        $id_photo_back = $bs_id_name;
                    }
                    $position_id = Position::find(1)->id;
                    $gender_id = Gender::find(1)->id;
                if($user){
                    $bureau->bureaudirectors()->save($user, [
                        'position_id'      => $position_id,
                        'gender_id'        => $gender_id,
                        'active'           => true,
                        'id_no'            => $request-> id_no,
                        'photo'            => $photo,
                        'id_photo_front'   => $id_photo_front,
                        'id_photo_back'    => $id_photo_back,
                        'about_me'         => $request-> director_about_me,
                        'phone'            => $request-> director_phone,
                        'landline'         => $request-> director_landline,
                        'address'          => $request-> director_address,
                        'country_id'       => $request-> director_country_id,
                        'county_id'        => $request-> director_county_id,
                        'constituency_id'  => $request-> director_constituency_id,
                        'ward_id'          => $request-> director_ward_id,
                    ]);
                }
                $user->save();
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $bureau = Bureau::
                        with('country', 'county', 'constituency', 'ward', 'bureaudirectors','bureauadmins',
                         'bureauemployees', 'bureauhousehelps')
                        ->find($id);

        return response()-> json([
            'bureau' => $bureau,
        ], 200);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bureau = Bureau::with('country', 'county', 'constituency', 'ward', 'bureaudirectors')
                              ->find($id);
        return response()-> json([
            'bureau' => $bureau,
        ], 200);
    }

    public function updateverifyBureauInfo (Request $request, $id)
    {
       $bureau = Bureau::find($id);
       $bureau_email = $bureau->bureau_email;
    //    return $bureau_email;

        if($bureau_email == null){

            $this->validate($request,[
                            'name'    => 'sometimes|required|min:2|max:50',
                            'bureau_email' => 'required|email|max:255|unique:bureaus',
                            'phone' => 'phone:AUTO,MOBILE',
                            'landline'=> 'phone:AUTO,MOBILE', //FIXED_LINE
                            'website'=> 'sometimes|required|min:2|max:50',
                            'address'=> 'sometimes|required|digits_between:1,20',
                            'country_id'=> 'sometimes|required',
                            'county_id'=> 'sometimes|required',
                            'constituency_id'=> 'sometimes|required',
                            'ward_id'=> 'sometimes|required',
                   ]);

        }else{
            // return 'mememe';
            $this->validate($request,[
                            'name'    => 'sometimes|required|min:2|max:50',
                            'bureau_email' => 'sometimes|required|email|max:191|',
                            'phone' => 'phone:AUTO,MOBILE',
                            'landline'=> 'phone:AUTO,MOBILE', //FIXED_LINE
                            'website'=> 'sometimes|required|min:2|max:50',
                            'address'=> 'sometimes|required|digits_between:1,20',
                            'country_id'=> 'sometimes|required',
                            'county_id'=> 'sometimes|required',
                            'constituency_id'=> 'sometimes|required',
                            'ward_id'=> 'sometimes|required',
                   ]);

        }

    //
    }
    public function updateverifyDirectorInfo (Request $request, $id)
    {
       $bureau = Bureau::find($id);
       $bureaudirector = $bureau->bureaudirectors()->first();
    //
    // return $director;

        if($bureaudirector == null ){
            $this->validate($request,[
                'director_first_name'  =>  'required',
                'director_last_name'  =>  'required',
                // 'email'  =>  'required|email|max:255|unique:users',
                // 'gender_id'  =>  'required',
                'director_password'  =>  '|required',
                'director_phone'  =>  'phone:AUTO,MOBILE',
                'director_landline'  =>  'phone:AUTO,MOBILE',
                'director_id_no'  =>  'required|digits_between:7,10',
                'director_address'  =>  'required|digits_between:1,20',
                'director_country_id'  =>  'required',
                'director_county_id'  =>  'required',
                'director_constituency_id'  =>  'required',
                'director_ward_id'  =>  'required',
                // 'director_passport_image'  =>  'required',
                // 'frontside_director_id_photo'  =>  'required',
                // 'backside_director_id_photo'  =>  'required',
           ]);

        }else{
            // return $bureaudirector;
        //   $user_id = $bureaudirector->id;
            $this->validate($request,[
                'director_first_name'  =>  'sometimes|required',
                'director_last_name'  =>  'sometimes|required',
                'email'=>'sometimes|required|string|email|max:191',
                // 'gender_id'  =>  'required',
                'director_password'  =>  'sometimes|required',
                'director_phone'  =>  'sometimes|phone:AUTO,MOBILE',
                'director_landline'  =>  'sometimes|phone:AUTO,MOBILE',
                'director_id_no'  =>  'sometimes|required|digits_between:7,10',
                'director_address'  =>  'sometimes|required|digits_between:1,20',
                'director_country_id'  =>  'sometimes|required',
                'director_county_id'  =>  'sometimes|required',
                'director_constituency_id'  =>  'sometimes|required',
                'director_ward_id'  =>  'sometimes|required',
                // 'director_passport_image'  =>  'required',
                // 'frontside_director_id_photo'  =>  'required',
                // 'backside_director_id_photo'  =>  'required',
           ]);
        }

    }
    public function update(Request $request, $id)
    {
        $bureau = Bureau::find($id);

        if($bureau){
            $bureau->name = $request ->name;
            $bureau->bureau_email = $request ->bureau_email;
            $bureau->phone = PhoneNumber::make($request->phone);
            $bureau->landline = PhoneNumber::make($request->landline);
            $bureau->website = $request ->website;
            $bureau->address = $request ->address;
            $bureau->country_id = $request ->country_id;
            $bureau->county_id = $request ->county_id;
            $bureau->constituency_id = $request ->constituency_id;
            $bureau->ward_id = $request ->ward_id;

            // $bureau->logo = $request ->logo;
            //getting previous logo
            $currentLogo =  $bureau->logo;

            //processing logo nme and size
            if($request->logo != $currentLogo){
                $Path = public_path()."/assets/bureau/img/logo/";

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
                $name = $bureau->logo;
            }
            $bureau->logo = $name;

            if($bureau){

                $bureaudirector = $bureau->bureaudirectors()->first();
                // return $bureaudirector;
                if($bureaudirector ==null){
                    // director user
                    $user = new User();
                    $user->first_name = $request->director_first_name;
                    $user->last_name  = $request->director_last_name;
                    $user->email      = $request->email;
                    $user->active     = true;
                    $user->confirmed  = true;
                    $user->confirmation_code = md5(uniqid(mt_rand(), true));
                    $user->user_type      = 'Bureau Director';
                    $user->password   = Hash::make($request->director_password);

                    $user->assignRole('Bureau Director');
                    $user ->givePermissionTo('View Backend', 'View All');

                    $user->save();

                    //add director to bureau
                    if($user){
                        $user_id = $user->id;
                        // return $user;
                        $bureau_id = $bureau->id;

                        $bureaudirector = new BureauDirector();
                        $bureaudirector->user_id                = $user_id;
                        $bureaudirector->bureau_id        = $bureau_id;
                        $bureaudirector->position_id            = 1;
                        $bureaudirector->gender_id              = 1;

                        $bureaudirector->active                 = true;
                        $bureaudirector->phone         = $request ->director_phone;
                        $bureaudirector->landline      = $request ->director_landline;
                        $bureaudirector->id_no         = $request ->director_id_no;
                        $bureaudirector->address        = $request ->director_address;

                        $bureaudirector->country_id    = $request ->director_country_id;
                        $bureaudirector->county_id     = $request ->director_county_id;
                        $bureaudirector->constituency_id  = $request ->director_constituency_id;
                        $bureaudirector->ward_id  = $request ->director_ward_id;

                        //pass port
                        $passport = $request->director_passport_image;
                        if($passport){
                            //processing passport name
                            $ps_strpos = strpos($passport, ';'); //positionof image name semicolon
                            $ps_sub = substr($passport, 0, $ps_strpos);
                            $ps_ex = explode('/', $ps_sub)[1];
                            $ps_name = time().".".$ps_ex;

                            $ps_Path = public_path()."/assets/bureau/img/directors/passports";
                                $ps_img = Image::make($passport);
                                $ps_img ->save($ps_Path.'/'.$ps_name);
                            //end processing
                            $bureaudirector->photo = $ps_name;
                        }
                        //director Front side id image
                        $frontside_id = $request->frontside_director_id_photo;
                        if($frontside_id){
                            //processing front side id imagee
                            $fr_id_strpos = strpos($frontside_id, ';');
                            $fr_id_sub = substr($frontside_id, 0, $fr_id_strpos);
                            $fr_id_ex = explode('/', $fr_id_sub)[1];
                            $fr_id_name = time().".".$fr_id_ex;

                            $fr_id_Path = public_path()."/assets/bureau/img/directors/IDs/front";
                                $fr_id_img = Image::make($frontside_id);
                                $fr_id_img ->save($fr_id_Path.'/'.$fr_id_name);
                            //end processing
                            $bureaudirector->id_photo_front = $fr_id_name;
                        }
                        //director Front side id image
                        $backside_id = $request->backside_director_id_photo;
                        if($backside_id){
                            //processing front side id imagee
                            $bs_id_strpos = strpos($backside_id, ';');
                            $bs_id_sub = substr($backside_id, 0, $bs_id_strpos);
                            $bs_id_ex = explode('/', $bs_id_sub)[1];
                            $bs_id_name = time().".".$bs_id_ex;

                            $bs_id_Path = public_path()."/assets/bureau/img/directors/IDs/back";
                                $bs_id_img = Image::make($backside_id);
                                $bs_id_img ->save($bs_id_Path.'/'.$bs_id_name);
                            //end processing
                            $bureaudirector->id_photo_back = $bs_id_name;
                        }
                        $bureaudirector->save();
                    }
                }
            }
        $bureau->save();
        }
    }
    public function singleupdate(Request $request, $id)
    {
        $bureau = Bureau::find($id);

            $bureau->name = $request ->name;
            $bureau->bureau_email = $request ->bureau_email;
            $bureau->phone = PhoneNumber::make($request->phone);
            $bureau->landline = PhoneNumber::make($request->landline);
            $bureau->website = $request ->website;
            $bureau->address = $request ->address;
            $bureau->country_id = $request ->country_id;
            $bureau->county_id = $request ->county_id;
            $bureau->constituency_id = $request ->constituency_id;
            $bureau->ward_id = $request ->ward_id;

            // $bureau->logo = $request ->logo;
            //getting previous logo
            $currentLogo =  $bureau->logo;

            //processing logo nme and size
            if($request->logo != $currentLogo){
                $Path = public_path()."/assets/bureau/img/logo/";

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
                $name = $bureau->logo;
            }
            $bureau->logo = $name;
        $bureau->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bureau = Bureau::findOrFail($id);
        $bureaudirectors = $bureau->bureaudirectors()->get();
         foreach($bureaudirectors as $bureaudirector){

            //curent passport of director
            $ps_Path = public_path()."/assets/bureau/img/directors/passports/";
                $ps_currentpassport = $ps_Path. $bureaudirector->director_passport_image;
            if(file_exists($ps_currentpassport)){
                @unlink($ps_currentpassport);
            }
            //current id front of director
            $fr_id_Path = public_path()."/assets/bureau/img/directors/IDs/front/";
            $fr_id_currentdIDPhoto = $fr_id_Path. $bureaudirector->frontside_director_id_photo;
            if(file_exists($fr_id_currentdIDPhoto)){
                @unlink($fr_id_currentdIDPhoto);
            }
            //current id back of director
            $bs_id_Path = public_path()."/assets/bureau/img/directors/IDs/back/";
            $bs_id_currentdIDPhoto = $bs_id_Path. $bureaudirector->backside_director_id_photo;

            if(file_exists($bs_id_currentdIDPhoto)){
                @unlink($bs_id_currentdIDPhoto);
            }

         }

        //image inline with this bureau
        $Path = public_path()."/assets/bureau/img/logo/";

        $S_image = $Path. $bureau->logo;

        if(file_exists($S_image)){
            @unlink($S_image);
        }


        $bureau->delete();
    }


}
