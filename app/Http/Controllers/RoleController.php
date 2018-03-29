<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use DB;

class RoleController extends Controller
{
	  public function index()
    {
    	$roles = Role::All();
    	return view('roles.index',['roles' => $roles]);
   	}

   	public function create()
   	{
      $permissions = Permission::All();
      $groupPermission = array();
      foreach ($permissions as $value) {
        $group = explode(".", $value->name);
        $groupPermission[] = $group[0];
      }
   		return view('roles.create',[
          'permissions' => $permissions,
          'groupPermission' => $groupPermission
      ]);
   	}

   	public function store(Request $request)
   	{
   		$this->validate($request, [
            'name' => 'required|unique:roles',
            'display_name' => 'required'
        ]);

		$role = new Role();
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();

    if(!empty($request->input('permissions'))){
      foreach ($request->input('permissions') as $key => $value) {
           $role->attachPermission($value);
      }
    }

   		$request->session()->flash('is-success', 'Role successfully created!');
        return redirect()->route('role.index');
   	}

   	public function edit($id)
   	{
   		$role = Role::find($id);
      $permissions = Permission::All();

      $rolePermissions = DB::table("permission_role")
                ->where("role_id",$id)
                ->pluck('permission_id')
                ->toArray();

   		return view('roles.edit',[
   			'role' => $role,
        'permissions' => $permissions,
        'rolePermissions' => $rolePermissions
   		]);
   	}

   	public function editStore(Request $request,$id)
   	{
      $role = Role::find($id);
      $this->validate($request, [
            'name' => 'required:name,'.$role->id.'|unique:roles,name,'.$role->id,
            'display_name' => 'required'
        ]);
      $role->name = $request->name;
      $role->display_name = $request->display_name;
      $role->description = $request->description;
      $role->save();

      //delete all permissions currently linked to this role
        DB::table("permission_role")->where("role_id",$id)->delete();

        if(!empty($request->input('permissions'))){
          //attach the new permissions to the role
          foreach ($request->input('permissions') as $key => $value) {
              $role->attachPermission($value);
          }
        }

      $request->session()->flash('is-success', 'Role successfully edited!');
        return redirect()->route('role.index');
   	}

    public function destroy(Request $request, $id)
    {
        $role = Role::find($id);
        $userRoleCount = DB::table("role_user")->where("role_id",$id)->count();
        if($userRoleCount > 0){
          $request->session()->flash('is-danger', 'Another user still using role '.$role->display_name.', please change user role associated with role '.$role->display_name.'!');
          return redirect()->route('role.index');
        } else {
          $role->delete();
          DB::table("role_user")->where("role_id",$id)->delete();
          $request->session()->flash('is-success', 'Role successfully removed!');
          return redirect()->route('role.index');
        }
    }
}