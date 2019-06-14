<?php

namespace App\Http\Controllers\Backend\Organisation;


use Illuminate\Http\Request;
use App\Models\Standard\User;
use App\Models\Standard\Country;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index()
    {
        if (auth()->check()) {
            if (auth()->user()->hasRole('Superadmin')) {
                $users = User::with('roles', 'permissions')->paginate(7);
            }
        }
            return response()-> json([
                'users'=>$users,
            ], 200);
    }

    public function usertypes ()
    {
                $id = 'id';
                $name = 'name';

                 $output1 = [ $id => '1', $name => 'Organisation Director', ];
                 $output2 = [ $id => '2', $name => 'Organisation Admin', ];
                 $output3 = [ $id => '3', $name => 'Organisation Accounts', ];
                 $output4 = [ $id => '4', $name => 'Organisation Employee', ];
                 $output5 = [ $id => '5', $name => 'Organisation Afiliate', ];
                 $output6 = [ $id => '6', $name => 'Bureau Director', ];
                 $output7 = [ $id => '7', $name => 'Bureau Admin', ];
                 $output8 = [ $id => '8', $name => 'Bureau Accounts', ];
                 $output9 = [ $id => '9', $name => 'Househelp', ];
                 $output10= [ $id => '10', $name => 'Client', ];

                $usertypes = [
                    $output1,
                    $output2,
                    $output3,
                    $output4,
                    $output5,
                    $output6,
                    $output7,
                    $output8,
                    $output9,
                    $output10,
                ];
                   return response()-> json([
                        'usertypes' => $usertypes,
                    ], 200);
    }

     public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password'=>'required|min:6',
            'user_type' => 'required|min:3',
            'permissions'=>'required',
            'roles'=>'required',
        ]);

        $user= User::create([
            'first_name'       => $request ['first_name'],
            'last_name'        => $request ['last_name'],
            'email'           => $request ['email'],
            'password'        => Hash::make($request ['password']),
            'user_type'        => $request ['user_type'],
            'active'           => true,
            'confirmed'        => true,
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
        ]);

        $user->assignRole($request ['roles']);
        $user->syncPermissions($request ['permissions']);

        return ['message' => 'User Created successfully'];

    }

    public function show($id)
    {
        $user = User::with('roles', 'permissions')->find($id);
        // dd($user);
        return response()-> json([
            'user'=>$user
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
        $user = User::with('roles', 'permissions')->find($id);
        // dd($user);
        return response()-> json([
            'user'=>$user
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

        $this->validate($request,[
            'first_name'=>'required|string|max:191',
            'last_name'=>'required|string|max:191',
            'email'=>'required|string|email|max:191|unique:users,email,'.$id,
            'password'=>'sometimes|required|min:6',
            'user_type' => 'sometimes|required|min:3',
            // 'permissions'=>'sometimes|required',
            // 'roles'=>'sometimes|required',
        ]);
        $user = User::find($id);
        $user->first_name = $request->first_name;
            $user->last_name  = $request->last_name;
            $user->email      = $request->email;
            $user->active     = true;
            $user->confirmed  = true;
            $user->confirmation_code = md5(uniqid(mt_rand(), true));
            $user->user_type      = $request->user_type;
            $user->password   = Hash::make($request->password);
            $user->save();
        return ['message', 'update the user info'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return ['message'=>'User Deleted'];
    }
}
