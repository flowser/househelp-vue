<?php

namespace App\Http\Controllers\Frontend;


use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PublicController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    public function index()
    {
        // backend logged user
        if (auth()->check()) {
            if (auth('api')->user()){
                $roles = [];
                $permissions = [];

                foreach (Role::all() as $role) {
                    if (auth('api')->user()->hasRole($role->name)) {
                    $roles[] = $role->name;
                    }
                }

                foreach (Permission::all() as $permission) {
                    if (auth('api')->user()->can($permission->name)) {
                    $permissions[] = $permission->name;
                    }
                }
                return view('layouts.frontend', compact('roles', 'permissions'));
            }
        }else{
            return view('layouts.frontend');
        }
    }
}
