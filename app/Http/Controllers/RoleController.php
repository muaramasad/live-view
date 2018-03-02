<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;

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
   		return view('roles.create',[
          'permissions' => $permissions
      ]);
   	}

   	public function store(Request $request)
   	{
   		$this->validate($request, [
            'name' => 'required',
            'display_name' => 'required'
        ]);

		$role = new Role();
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();

    foreach ($request->input('permissions') as $key => $value) {
            $role->attachPermission($value);
        }

   		$request->session()->flash('is-success', 'Role successfully created!');
        return redirect()->route('role.index');
   	}

   	public function edit($id)
   	{
   		$role = Role::find($id);
   		return view('roles.edit',[
   			'role' => $role
   		]);
   	}

   	public function editStore(Request $request,$id)
   	{
      $this->validate($request, [
            'name' => 'required',
            'display_name' => 'required'
        ]);

      $role = Role::find($id);
      $role->name = $request->name;
      $role->display_name = $request->display_name;
      $role->description = $request->description;
      $role->save();

      $request->session()->flash('is-success', 'Role successfully edited!');
        return redirect()->route('role.index');
   	}

    public function destroy(Request $request, $id)
    {
        if (Area::has('sites')->find($id)) {
            return redirect()->route('area.index')->withErrors(['error' => 'This area still has sites, remove the sites first !']);
        }
        Area::find($id)->delete();
        $request->session()->flash('is-success', 'Area successfully removed!');
        return redirect()->route('area.index');
    }
}