<?php

namespace App\Http\Controllers\Auth;



use Illuminate\Http\Request;
use App\Models\Client\Client;
use App\Models\Standard\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Models\Organisation\Organisation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator( array $data)
    {

        return Validator::make($data, [
            'first_name'       => ['required', 'string', 'max:255'],
            'last_name'        => ['required', 'string', 'max:255'],
            'email'            => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'         => ['required', 'string', 'min:6'],
            'phone'            => ['required','digits_between:10,12'],
            'id_no'            => ['required','digits_between:7,10'],
            'address'          => ['required','digits_between:1,20'],
            'gender_id'        => ['required'],
            'education_id'     => ['required'],
            'country_id'       => ['required'],
            'county_id'        => ['required'],
            'constituency_id'  => ['required'],
            'ward_id'          => ['required'],
            'photo'            => ['required'],
            'id_photo_front'   => ['required'],
            'id_photo_back'    => ['required'],
            'user_type'    => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    protected function create(array $data)
    {

        if($data['user_type'] == "Client"){
            $user = User::create([
                'first_name'        => $data['first_name'],
                'last_name'         => $data['last_name'],
                'email'             => $data['email'],
                'password' => Hash::make($data['password']),
                'user_type'         => $data['user_type'],
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

                    $passport = $data['photo'];
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
                    $frontside_id = $data['id_photo_front'];
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
                    $backside_id = $data['id_photo_back'];
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
                    $client ->gender_id        = $data['gender_id'];
                    $client ->education_id     = $data['education_id'];
                    $client ->active           = true;
                    $client ->id_no            = $data['id_no'];
                    $client ->photo            = $photo;
                    $client ->id_photo_front   = $id_photo_front;
                    $client ->id_photo_back    = $id_photo_back;
                    $client ->about_me         = $data['about_me'];
                    $client ->phone            = $data['phone'];
                    $client ->landline         = $data['landline'];
                    $client ->address          = $data['address'];
                    $client ->country_id       = $data['country_id'];
                    $client ->county_id        = $data['county_id'];
                    $client ->constituency_id  = $data['constituency_id'];
                    $client ->ward_id          = $data['ward_id'];
                    $client->save();
            }
                return $user;
        }
        if($data['user_type'] == "Affiliate"){
            $organisation= Organisation::first();
            if ($organisation){
                $user = User::create([
                    'first_name'        => $data['first_name'],
                    'last_name'         => $data['last_name'],
                    'email'             => $data['email'],
                    'password' => Hash::make($data['password']),
                    'user_type'         => $data['user_type'],
                    'active'            => true,
                    'confirmed'         => true,
                    'confirmation_code' => md5(uniqid(mt_rand(), true)),
                ]);

                if($user){
                    event(new \App\Events\UserReferred(request()->cookie('ref'), $user));

                    $user->assignRole('Affiliate', 'Client');
                    $user ->givePermissionTo('View Frontend');

                        $passport = $data['photo'];
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
                        $frontside_id = $data['id_photo_front'];
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
                        $backside_id = $data['id_photo_back'];
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

                            $passport = $data['photo'];
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
                            $frontside_id = $data['id_photo_front'];
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
                            $backside_id = $data['id_photo_back'];
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
                            $client ->gender_id        = $data['gender_id'];
                            $client ->education_id     = $data['education_id'];
                            $client ->active           = true;
                            $client ->id_no            = $data['id_no'];
                            $client ->photo            = $client_photo;
                            $client ->id_photo_front   = $client_id_photo_front;
                            $client ->id_photo_back    = $client_id_photo_back;
                            $client ->about_me         = $data['about_me'];
                            $client ->phone            = $data['phone'];
                            $client ->landline         = $data['landline'];
                            $client ->address          = $data['address'];
                            $client ->country_id       = $data['country_id'];
                            $client ->county_id        = $data['county_id'];
                            $client ->constituency_id  = $data['constituency_id'];
                            $client ->ward_id          = $data['ward_id'];
                            $client->save();
                         }

                        if($user){
                            $organisation->organisationaffiliates()->save($user, [
                                'user_id'          => $user->id,
                                'gender_id'        => $data['gender_id'],
                                'education_id'     => $data['education_id'],
                                'position_id'      => '7',
                                'active'           => true,
                                'id_no'            => $data['id_no'],
                                'photo'            => $photo,
                                'id_photo_front'   => $id_photo_front,
                                'id_photo_back'    => $id_photo_back,
                                'about_me'         => $data['about_me'],
                                'phone'            => $data['phone'],
                                'address'          => $data['address'],
                                'country_id'       => $data['country_id'],
                                'county_id'        => $data['county_id'],
                                'constituency_id'  => $data['constituency_id'],
                                'ward_id'          => $data['ward_id'],
                            ]);
                        }
                }
                return $user;
            }
        }

    }
}
