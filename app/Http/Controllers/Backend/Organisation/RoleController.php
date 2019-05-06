<?php

namespace App\Http\Controllers\Backend\Organisation;


use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();

        return response()->json([
            'roles' => $roles,
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
     */
    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

            $role = New Role();
            $role->name = $request->name;
            $role->givePermissionTo($request->permission);
            $role->save();
        return response()-> json([
            'role'=>$role
        ], 200);
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
        $role = Role::with('permissions')->findOrFail($id);
        // dd($role);
        // dd($role->permissions()->pluck('name'));
        return response()-> json([
            'role'=>$role
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id )

    {
        // dd($request->permission);

    // Validate name and permission fields
        $this->validate($request, [
            'name'=>'required|max:15|unique:roles,name,'.$id,
            'permission' =>'required',
        ]);
// dd($role);
         $role = Role::with('permissions')->find($id);
            $role->name = $request->name;
            $role->syncPermissions($request->permission);
            $role->save();
            return response()-> json([
                'role'=>$role
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
            if($role->name != 'Superadmin'){
                $role->delete();
                return response()-> json([
                    'role'=>$role
                ], 200);
            }else{
                return ['message', 'The Role Can not be deleted'];
            }
    }
}
