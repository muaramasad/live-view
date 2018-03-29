<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use DB;

class PermissionController extends Controller
{
	public function index()
    {
    	$permissions = Permission::All();
    	return view('permissions.index',['permissions' => $permissions]);
   	}

   	public function create()
    {
    	return view('permissions.create');
   	}

   	public function store(Request $request)
   	{
   		$this->validate($request, [
            'name' => 'required|unique:permissions',
            'display_name' => 'required'
        ]);

		$permission = new Permission();
        $permission->name = $request->name;
        $permission->display_name = $request->display_name;
        $permission->description = $request->description;
        $permission->save();

   		$request->session()->flash('is-success', 'Permission successfully created!');
        return redirect()->route('permission.index');
   	}

   	public function edit($id)
   	{
   		$permission = Permission::find($id);
   		return view('permissions.edit',[
   			'permission' => $permission
   		]);
   	}

   	public function editStore(Request $request,$id)
   	{
      $permission = Permission::find($id);
      $this->validate($request, [
            'name' => 'required|unique:permissions,name,'.$permission->id,
            'display_name' => 'required'
        ]);
      $permission->name = $request->name;
      $permission->display_name = $request->display_name;
      $permission->description = $request->description;
      $permission->save();

      $request->session()->flash('is-success', 'Permission successfully edited!');
        return redirect()->route('permission.index');
   	}

    public function destroy(Request $request, $id)
    {
        $permission = Permission::find($id);
        $permissionRoleCount = DB::table("permission_role")->where("permission_id",$id)->count();
        
        if($permissionRoleCount > 0){
          $request->session()->flash('is-danger', 'Another role still using '.$permission->display_name.' permission, please change role permission associated with '.$permission->display_name.' permission!');
          return redirect()->route('permission.index');
        } else {
          $permission->delete();
          DB::table("permission_role")->where("permission_id",$id)->delete();
          $request->session()->flash('is-success', 'Permission successfully removed!');
          return redirect()->route('permission.index');
        }
    }
}