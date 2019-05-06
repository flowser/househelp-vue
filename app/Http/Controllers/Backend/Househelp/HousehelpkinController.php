<?php

namespace App\Http\Controllers\Backend\Househelp;

use Illuminate\Http\Request;
use App\Models\Standard\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class HousehelpkinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     */
    public function store(Request $request)
    {
        //
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
        $househelpkin = User::with('roles','permissions','househelpkins')
                            ->find($id);
        return response()-> json([
            'househelpkin'=>$househelpkin,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $id;
        $this->validate($request,[
            'first_name'  =>  'required',
            'last_name'  =>  'required',

            'phone'  =>  'phone:AUTO,MOBILE',

            'id_no'  =>  'required|digits_between:7,10',
            'address'  =>  'required|digits_between:1,20',
            'gender_id'  =>  'required',
            'country_id'  =>  'required',
            'county_id'  =>  'required',
            'constituency_id'  =>  'required',
            'ward_id'  =>  'required',
            'photo'  =>  'sometimes|required',
            'id_photo_front'  =>  'sometimes|required',
            'id_photo_back'  =>  'sometimes|required',
       ]);

       $user = User::find($id);
    //    $password = Hash::make($request->password)
       $user->first_name = $request->first_name;
       $user->last_name  = $request->last_name;
       $user->email      = $request->email;
       $user->active     = true;
       $user->confirmed  = true;
       $user->confirmation_code = md5(uniqid(mt_rand(), true));
       $user->user_type      = 'Househelp Kin';
       $user->password   = Hash::make($request->password);
       // $user->save();

       $user->assignRole('Househelp Kin');

       if($user){

        //getting previous photo
        $currentPassport = $user->househelpkins()->first()->pivot->photo;
        // return $currentPassport;
        //processing photo nme and size
        if($request->photo != $currentPassport){
            $ps_Path = public_path()."/assets/bureau/img/househelps/househelpkins/passports/";

            $S_currentPassport = $ps_Path. $currentPassport;
            //deleting if exists
                if(file_exists($S_currentPassport)){
                    @unlink($S_currentPassport);
                }
                $passport = $request->photo;

                $ps_strpos = strpos($passport, ';'); //positionof image name semicolon
                $ps_sub = substr($passport, 0, $ps_strpos);
                $ps_ex = explode('/', $ps_sub)[1];
                $ps_name = time().".".$ps_ex;

                 $ps_img = Image::make($passport);
                 $ps_img ->save($ps_Path.'/'.$ps_name);
             //end processing
            $photo= $ps_name;
        }else{
            $photo = $user->househelpkins()->first()->pivot->photo;
        }
       //front side id
       $currentFrontside_id = $user->househelpkins()->first()->pivot->id_photo_front;
        // return $currentFrontside_id;
        //processing id_photo_front nme and size
        if($request->id_photo_front != $currentFrontside_id){
            $fr_id_Path = public_path()."/assets/bureau/img/househelps/househelpkins/IDs/front/";

            $S_currentFrontside_id = $fr_id_Path. $currentFrontside_id;
            // return $S_currentFrontside_id;
            //deleting if exists
                if(file_exists($S_currentFrontside_id)){
                    @unlink($S_currentFrontside_id);
                }
                $frontside_id = $request->id_photo_front;

                $fr_id_strpos = strpos($frontside_id, ';');
                $fr_id_sub = substr($frontside_id, 0, $fr_id_strpos);
                $fr_id_ex = explode('/', $fr_id_sub)[1];
                $fr_id_name = time().".".$fr_id_ex;

                $fr_id_img = Image::make($frontside_id);
                $fr_id_img ->save($fr_id_Path.'/'.$fr_id_name);
             //end processing
                $id_photo_front = $fr_id_name;
        }else{
            $id_photo_front = $user->househelpkins()->first()->pivot->id_photo_front;
        }

        //backside id
        $currentBackside_id = $user->househelpkins()->first()->pivot->id_photo_back;
        // return $currentBackside_id;
        //processing id_photo_back nme and size
        if($request->id_photo_back != $currentBackside_id){
            $bs_id_Path = public_path()."/assets/bureau/img/househelps/househelpkins/IDs/back/";

            $S_currentBackside_id = $bs_id_Path. $currentBackside_id;
            // return $S_currentBackside_id;
            //deleting if exists
                if(file_exists($S_currentBackside_id)){
                    @unlink($S_currentBackside_id);
                }
                $backside_id = $request->id_photo_back;

                $bs_id_strpos = strpos($backside_id, ';');
                $bs_id_sub = substr($backside_id, 0, $bs_id_strpos);
                $bs_id_ex = explode('/', $bs_id_sub)[1];
                $bs_id_name = time().".".$bs_id_ex;

                $bs_id_img = Image::make($backside_id);
                $bs_id_img ->save($bs_id_Path.'/'.$bs_id_name);
             //end processing
                $id_photo_back = $bs_id_name;
        }else{
            $id_photo_back = $user->househelpkins()->first()->pivot->id_photo_back;
        }


           DB::table('househelp_kin')->where('user_id', $user->id)
           ->update([
                'relationship_id'  => $request->relationship_id,
                'gender_id'        => $request->gender_id,
                'active'           => true,
                'id_no'            => $request->id_no,
                'photo'            => $photo,
                'id_photo_front'   => $id_photo_front,
                'id_photo_back'    => $id_photo_back,
                'phone'            => $request->phone,
                'address'          => $request->address,
                'country_id'       => $request->country_id,
                'county_id'        => $request->county_id,
                'constituency_id'  => $request->constituency_id,
                'ward_id'          => $request->ward_id,
           ]);
       }
       $user->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
