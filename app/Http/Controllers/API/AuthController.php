<?php

namespace App\Http\Controllers\API;

use App\Events\UserReferred;
use Illuminate\Http\Request;
use App\Models\Client\Client;
use App\Models\Standard\User;
use App\Models\Househelp\Househelp;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Bureau\BureauDirector;
use Intervention\Image\Facades\Image;
use App\Models\Organisation\Organisation;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        try {
            $response = $http->post(config('services.passport.login_endpoint'), [
            // $response = $http->post('http://laravel-vue-api.test/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => config('services.passport.client_id'),
                    // 'client_id' => 2,
                    'client_secret' => config('services.passport.client_secret'),
                    // 'client_secret' => 'dghicpoihOYK7UygCjuz5B7vU38YqsYE7VuNeVFD',
                    'username' => $request->email,
                    'password' => $request->password,
                ]
            ]);
            return $response->getBody();
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if ($e->getCode() === 400) {
                return response()->json('Invalid Request. Please enter a username or a password.', $e->getCode());
            } else if ($e->getCode() === 401) {
                return response()->json('Your credentials are incorrect. Please try again', $e->getCode());
            }
            return response()->json('Something went wrong on the server.', $e->getCode());
        }
    }

    public function user()
    {
        if (auth()->check()) {
            if (auth()->user()->hasAnyRole(['Superadmin'])){

                $user = User::with('roles', 'permissions', 'organisationadmin')
                     ->where('id', Auth::user()->id)
                     ->first();
            }
            elseif (auth()->user()->hasAnyRole(['Director'])){

                $user = User::with('roles', 'permissions', 'organisationdirector')
                      ->where('id', Auth::user()->id)
                      ->first();
            }
            elseif(auth()->user()->hasAnyRole(['Employee'])){

                $user = User::with('roles', 'permissions', 'organisationemployee')
                      ->where('id', Auth::user()->id)
                      ->first();
            }
            elseif(auth()->user()->hasAnyRole(['Admin'])){

                $user = User::with('roles', 'permissions', 'organisationadmin')
                      ->where('id', Auth::user()->id)
                      ->first();
            }
            elseif(auth()->user()->hasAnyRole(['Accountant'])){

                $user = User::with('roles', 'permissions', 'organisationadmin')
                      ->where('id', Auth::user()->id)
                      ->first();
            }
            elseif(auth()->user()->hasAnyRole(['Affiliate'])){

                $user = User::with('roles', 'permissions')
                      ->where('id', Auth::user()->id)
                      ->first();
            }
            elseif(auth()->user()->hasAnyRole(['Client'])){

                $user = User::with('roles', 'permissions')
                      ->where('id', Auth::user()->id)
                      ->first();
            }
            elseif(auth()->user()->hasAnyRole(['Bureau Director'])){

                $user = User::with('roles', 'permissions','bureaudirector')
                      ->where('id', Auth::user()->id)
                      ->first();
            }
            elseif(auth()->user()->hasAnyRole(['Bureau Employee'])){

                $user = User::with('roles', 'permissions', 'bureauemployee')
                      ->where('id', Auth::user()->id)
                      ->first();
            }
            elseif(auth()->user()->hasAnyRole(['Bureau Admin'])){

                $user = User::with('roles', 'permissions', 'bureauadmin')
                      ->where('id', Auth::user()->id)
                      ->first();
            }
            elseif(auth()->user()->hasAnyRole(['Bureau Accountant'])){

                $user = User::with('roles', 'permissions')
                      ->where('id', Auth::user()->id)
                      ->first();
            }
            elseif(auth()->user()->hasAnyRole(['Househelp'])){

                $user = User::with('roles', 'permissions', 'househelp')
                      ->where('id', Auth::user()
                      ->id)->first();
                // $househelp = Househelp ::with('country', 'county', 'constituency', 'ward',
                // 'gender', 'education', 'experience', 'tribe', 'skill','duration',
                // 'operation', 'englishstatus','maritalstatus','religion',
                // 'idstatus', 'healthstatus', 'househelpkins')->where('user_id', $user->id)->first()
            }
            elseif(auth()->user()->hasAnyRole(['Househelp Kin'])){

                $user = User::with('roles', 'permissions')
                      ->where('id', Auth::user()->id)
                      ->first();
            }

                $roles = $user->roles()->pluck('name');
                $permissions = $user->permissions()->pluck('name');

                return response()-> json([
                    'user'=>$user,
                    'roles'=> $roles,
                    'permissions' => $permissions,
                ], 200);
        }

    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name'       => 'required|string|max:255',
            'last_name'        => 'required|string|max:255',
            'email'            => 'required|string|email|max:255|unique:users',
            'password'         => 'required|string|min:6',
            'phone'            => 'required|digits_between:10,12',
            'id_no'            => 'required|digits_between:7,10',
            'address'          => 'required|digits_between:1,20',
            'gender_id'        => 'required',
            'education_id'     => 'required',
            'country_id'       => 'required',
            'county_id'        => 'required',
            'constituency_id'  => 'required',
            'ward_id'          => 'required',
            'photo'            => 'required',
            'id_photo_front'   => 'required',
            'id_photo_back'    => 'required',
            'user_type'        => 'required',
        ]);

        return User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if($request->user_type == "Client"){
            $user = User::create([
                'first_name'        => $request->first_name,
                'last_name'         => $request->last_name,
                'email'             => $request->email,
                'password' => Hash::make($request->password),
                'user_type'         => $request->user_type,
                'active'            => true,
                'confirmed'         => true,
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
            ]);

            if($user){

                // event(new UserReferred(request()->cookie('ref'), $user));
                event(new \App\Events\UserReferred(request()->cookie('ref'), $user));

                $user->assignRole('Client');
                // $user->assignRole('Client');
                $user ->givePermissionTo('View Backend');

                    $passport = $request->photo;
                    if($passport){
                         //processing passport name
                         $ps_strpos = strpos($passport, ';'); //positionof image name semicolon
                         $ps_sub = substr($passport, 0, $ps_strpos);
                         $ps_ex = explode('/', $ps_sub)[1];
                         $ps_name = time().".".$ps_ex;

                         $ps_Path = public_path()."/assets/organisation/img/clients/passports";
                             $ps_img = Image::make($passport);
                             $ps_img ->save($ps_Path.'/'.$ps_name);
                         //end processing
                        $photo= $ps_name;
                    }
                    //client Front side id image
                    $frontside_id = $request->id_photo_front;
                    if($frontside_id){
                         //processing front side id imagee
                         $fr_id_strpos = strpos($frontside_id, ';');
                         $fr_id_sub = substr($frontside_id, 0, $fr_id_strpos);
                         $fr_id_ex = explode('/', $fr_id_sub)[1];
                         $fr_id_name = time().".".$fr_id_ex;

                         $fr_id_Path = public_path()."/assets/organisation/img/clients/IDs/front";
                             $fr_id_img = Image::make($frontside_id);
                             $fr_id_img ->save($fr_id_Path.'/'.$fr_id_name);
                         //end processing
                        $id_photo_front = $fr_id_name;
                    }
                    $backside_id = $request->id_photo_back;
                    if($backside_id){
                         //processing front side id imagee
                         $bs_id_strpos = strpos($backside_id, ';');
                         $bs_id_sub = substr($backside_id, 0, $bs_id_strpos);
                         $bs_id_ex = explode('/', $bs_id_sub)[1];
                         $bs_id_name = time().".".$bs_id_ex;

                         $bs_id_Path = public_path()."/assets/organisation/img/clients/IDs/back";
                             $bs_id_img = Image::make($backside_id);
                             $bs_id_img ->save($bs_id_Path.'/'.$bs_id_name);
                         //end processing
                        $id_photo_back = $bs_id_name;
                    }

                    $client = new Client();
                    $client ->user_id          = $user->id;
                    $client ->gender_id        = $request->gender_id;
                    $client ->education_id     = $request->education_id;
                    $client ->active           = true;
                    $client ->id_no            = $request->id_no;
                    $client ->photo            = $photo;
                    $client ->id_photo_front   = $id_photo_front;
                    $client ->id_photo_back    = $id_photo_back;
                    $client ->about_me         = $request->about_me;
                    $client ->phone            = $request->phone;
                    $client ->landline         = $request->landline;
                    $client ->address          = $request->address;
                    $client ->country_id       = $request->country_id;
                    $client ->county_id        = $request->county_id;
                    $client ->constituency_id  = $request->constituency_id;
                    $client ->ward_id          = $request->ward_id;
                    $client->save();
            }
                return $user;
        }
        if($request->user_type == "Affiliate"){
            $organisation= Organisation::first();
            if ($organisation){
                $user = User::create([
                    'first_name'        => $request->first_name,
                    'last_name'         => $request->last_name,
                    'email'             => $request->email,
                    'password' => Hash::make($request->password),
                    'user_type'         => $request->user_type,
                    'active'            => true,
                    'confirmed'         => true,
                    'confirmation_code' => md5(uniqid(mt_rand(), true)),
                ]);

                if($user){
                    event(new \App\Events\UserReferred(request()->cookie('ref'), $user));

                    $user->assignRole('Affiliate', 'Client');
                    $user ->givePermissionTo('View Frontend');

                        $passport = $request->photo;
                        if($passport){
                             //processing passport name
                             $ps_strpos = strpos($passport, ';'); //positionof image name semicolon
                             $ps_sub = substr($passport, 0, $ps_strpos);
                             $ps_ex = explode('/', $ps_sub)[1];
                             $ps_name = time().".".$ps_ex;

                             $ps_Path = public_path()."/assets/organisation/img/affiliates/passports";
                                 $ps_img = Image::make($passport);
                                 $ps_img ->save($ps_Path.'/'.$ps_name);
                             //end processing
                            $photo= $ps_name;
                        }
                        //client Front side id image
                        $frontside_id = $request->id_photo_front;
                        if($frontside_id){
                             //processing front side id imagee
                             $fr_id_strpos = strpos($frontside_id, ';');
                             $fr_id_sub = substr($frontside_id, 0, $fr_id_strpos);
                             $fr_id_ex = explode('/', $fr_id_sub)[1];
                             $fr_id_name = time().".".$fr_id_ex;

                             $fr_id_Path = public_path()."/assets/organisation/img/affiliates/IDs/front";
                                 $fr_id_img = Image::make($frontside_id);
                                 $fr_id_img ->save($fr_id_Path.'/'.$fr_id_name);
                             //end processing
                            $id_photo_front = $fr_id_name;
                        }
                        $backside_id = $request->id_photo_back;
                        if($backside_id){
                             //processing front side id imagee
                             $bs_id_strpos = strpos($backside_id, ';');
                             $bs_id_sub = substr($backside_id, 0, $bs_id_strpos);
                             $bs_id_ex = explode('/', $bs_id_sub)[1];
                             $bs_id_name = time().".".$bs_id_ex;

                             $bs_id_Path = public_path()."/assets/organisation/img/affiliates/IDs/back";
                                 $bs_id_img = Image::make($backside_id);
                                 $bs_id_img ->save($bs_id_Path.'/'.$bs_id_name);
                             //end processing
                            $id_photo_back = $bs_id_name;
                        }
                        //register as client too,can enroll well
                        //client Front side id image
                         $newclient = "newclient";
                         if($newclient){

                            $passport = $request->photo;
                            if($passport){
                                //processing passport name
                                $client_ps_strpos = strpos($passport, ';'); //positionof image name semicolon
                                $client_ps_sub = substr($passport, 0, $client_ps_strpos);
                                $client_ps_ex = explode('/', $client_ps_sub)[1];
                                $client_ps_name = time().".".$client_ps_ex;

                                $client_ps_Path = public_path()."/assets/organisation/img/clients/passports";
                                    $client_ps_img = Image::make($passport);
                                    $client_ps_img ->save($client_ps_Path.'/'.$client_ps_name);
                                //end processing
                                $client_photo= $client_ps_name;
                            }
                            //client Front side id image
                            $frontside_id = $request->id_photo_front;
                            if($frontside_id){
                                //processing front side id imagee
                                $client_fr_id_strpos = strpos($frontside_id, ';');
                                $client_fr_id_sub = substr($frontside_id, 0, $client_fr_id_strpos);
                                $client_fr_id_ex = explode('/', $client_fr_id_sub)[1];
                                $client_fr_id_name = time().".".$client_fr_id_ex;

                                $client_fr_id_Path = public_path()."/assets/organisation/img/clients/IDs/front";
                                    $client_fr_id_img = Image::make($frontside_id);
                                    $client_fr_id_img ->save($client_fr_id_Path.'/'.$client_fr_id_name);
                                //end processing
                                $client_id_photo_front = $client_fr_id_name;
                            }
                            $backside_id = $request->id_photo_back;
                            if($backside_id){
                                //processing front side id imagee
                                $client_bs_id_strpos = strpos($backside_id, ';');
                                $client_bs_id_sub = substr($backside_id, 0, $client_bs_id_strpos);
                                $client_bs_id_ex = explode('/', $client_bs_id_sub)[1];
                                $client_bs_id_name = time().".".$client_bs_id_ex;

                                $client_bs_id_Path = public_path()."/assets/organisation/img/clients/IDs/back";
                                    $client_bs_id_img = Image::make($backside_id);
                                    $client_bs_id_img ->save($client_bs_id_Path.'/'.$client_bs_id_name);
                                //end processing
                                $client_id_photo_back = $client_bs_id_name;
                            }

                            $client = new Client();
                            $client ->user_id          = $user->id;
                            $client ->gender_id        = $request->gender_id;
                            $client ->education_id     = $request->education_id;
                            $client ->active           = true;
                            $client ->id_no            = $request->id_no;
                            $client ->photo            = $client_photo;
                            $client ->id_photo_front   = $client_id_photo_front;
                            $client ->id_photo_back    = $client_id_photo_back;
                            $client ->about_me         = $request->about_me;
                            $client ->phone            = $request->phone;
                            $client ->landline         = $request->landline;
                            $client ->address          = $request->address;
                            $client ->country_id       = $request->country_id;
                            $client ->county_id        = $request->county_id;
                            $client ->constituency_id  = $request->constituency_id;
                            $client ->ward_id          = $request->ward_id;
                            $client->save();
                         }

                        if($user){
                            $organisation->organisationaffiliates()->save($user, [
                                'user_id'          => $user->id,
                                'gender_id'        => $request->gender_id,
                                'education_id'     => $request->education_id,
                                'position_id'      => '7',
                                'active'           => true,
                                'id_no'            => $request->id_no,
                                'photo'            => $photo,
                                'id_photo_front'   => $id_photo_front,
                                'id_photo_back'    => $id_photo_back,
                                'about_me'         => $request->about_me,
                                'phone'            => $request->phone,
                                'address'          => $request->address,
                                'country_id'       => $request->country_id,
                                'county_id'        => $request->county_id,
                                'constituency_id'  => $request->constituency_id,
                                'ward_id'          => $request->ward_id,
                            ]);
                        }
                }
                return $user;
            }
        }

    }
    public function logout()
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return response()->json('Logged out successfully', 200);
    }
}
