<?php

namespace App\Http\Controllers\Backend\Organisation;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // latest()->paginate(10);
        $permissions = Permission::all();
        return response()-> json([
            'permissions'=>$permissions
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
        $this->validate($request,[
            'name'=>'required|min:2|max:20|unique:permissions'
        ]);
        $permission = New Permission();
        $permission -> name = $request->name;
        $permission->save();

        // dd($request);
        return ['message' => 'Permission Created successfully'];

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
        $permission = Permission::findOrFail($id);
        // dd($category);
        return response()->json([
            'permission' =>$permission
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
            'name' => 'required|min:2|max:50|unique:permissions,name,'.$id

        ]);
        $permission = Permission::find($id);
        $permission->name = $request->name;

        if($permission->name != 'View-backend'){
                $permission ->save();
                        return response()->json([
                            'permission' =>$permission
                ], 200);
        }else{
            return ['message', 'The Permision cannot be updated'];
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
        $permission = Permission::findOrFail($id);
        //delete the permission
        // dd($permission);
        if($permission->name != 'View-backend'){
            $permission->delete();
            return response()->json([
                    'permission' =>$permission
                ], 200);
        }else{
            return ['message', 'The Permission Cannot be deleted'];
        }
    }
}
