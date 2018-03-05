<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;

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
      $this->validate($request, [
            'name' => 'required',
            'display_name' => 'required'
        ]);

      $permission = Permission::find($id);
      $permission->name = $request->name;
      $permission->display_name = $request->display_name;
      $permission->description = $request->description;
      $permission->save();

      $request->session()->flash('is-success', 'Permission successfully edited!');
        return redirect()->route('permission.index');
   	}
}