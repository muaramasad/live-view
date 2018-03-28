<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Division;
use App\Area;
use App\Site;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('division','area','site')->get();
        return view('users.index',[
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('display_name','id');
        $divisions = Division::all();
        $areas = Area::all();
        $sites = Site::all();
        return view('users.create',[
            'roles' => $roles,
            'divisions' => $divisions,
            'areas' => $areas,
            'sites' => $sites
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'divisions' => 'required',
            'areas' => 'required',
            'sites' => 'required',
            'role_id' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        if(!empty($request->input('role_id'))){
            //Attach the selected Roles
            foreach ($request->input('role_id') as $key => $value) {
                $user->attachRole($value);
            }
        }

        if(!empty($request->input('divisions'))){
            foreach ($request->input('divisions') as $key => $value) {
                $user->division()->attach($value);
            }
        }

        if(!empty($request->input('areas'))){
            foreach ($request->input('areas') as $key => $value) {
                $user->area()->attach($value);
            }
        }

        if(!empty($request->input('sites'))){
            foreach ($request->input('sites') as $key => $value) {
                $user->site()->attach($value);
            }
        }

        // foreach ($request->input('areas') as $key => $value) {
        //     $user->attachDivision($value);
        // }

        // foreach ($request->input('sites') as $key => $value) {
        //     $user->attachDivision($value);
        // }

        $request->session()->flash('is-success', 'User successfully created!');
        return redirect()->route('user.index');

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
        $user = User::find($id);
        // get relation on pivot table : user & division
        $userDivisions = $user->division->keyBy('id');
        $userDivisionArray = [];
        foreach ($userDivisions as $userDivision) {
            $userDivisionArray[] = $userDivision->pivot->division_id;
        }
        // get relation on pivot table : user & area
        $userAreas = $user->area->keyBy('id');
        $userAreaArray = [];
        foreach ($userAreas as $userArea) {
            $userAreaArray[] = $userArea->pivot->area_id;
        }
        // get relation on pivot table : user & site
        $userSites = $user->site->keyBy('id');
        $userSiteArray = [];
        foreach ($userSites as $userSite) {
            $userSiteArray[] = $userSite->pivot->site_id;
        }
        $divisions = Division::all();
        $areas = Area::all();
        $sites = Site::all();
        $roles = Role::pluck('display_name','id');
        $userRoles = [];
        if(!empty($user->roles)){
            foreach($user->roles as $role) {
                $userRoles[] = $role->id;
            }
        }
        return view('users.edit',[
            'id' => $id,
            'user' => $user,
            'divisions' => $divisions,
            'areas' => $areas,
            'sites' => $sites,
            'roles' => $roles,
            'userDivisionArray' => $userDivisionArray,
            'userAreaArray' => $userAreaArray,
            'userSiteArray' => $userSiteArray,
            'userRoles' => $userRoles
        ]);
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
        $user = User::find($id);
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email,'.$user->id,
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        DB::table("role_user")->where("user_id",$user->id)->delete();
        DB::table("division_user")->where("user_id",$user->id)->delete();
        DB::table("area_user")->where("user_id",$user->id)->delete();
        DB::table("site_user")->where("user_id",$user->id)->delete();

        if(!empty($request->input('role_id'))){
            //Attach the selected Roles
            foreach ($request->input('role_id') as $key => $value) {
                $user->attachRole($value);
            }
        }

        if(!empty($request->input('divisions'))){
            foreach ($request->input('divisions') as $key => $value) {
                $user->division()->attach($value);
            }
        }

        if(!empty($request->input('areas'))){
            foreach ($request->input('areas') as $key => $value) {
                $user->area()->attach($value);
            }
        }

        if(!empty($request->input('sites'))){
            foreach ($request->input('sites') as $key => $value) {
                $user->site()->attach($value);
            }
        }

        $request->session()->flash('is-success', 'User successfully updated!');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        User::find($id)->delete();
        $request->session()->flash('is-success', 'User successfully removed!');
        return redirect()->route('user.index');
    }


    // API for User Edit Page
    public function getAreaByDivisionUser(Request $request)
    {
        dd($request);
        $area = Area::where('division_id',$id)->pluck('area_name','id');
        return $area;
    }
}
