<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Division;
use App\Site;

class DivisionController extends Controller
{
    public function index()
    {
    	$divisions = Division::All();
    	return view('divisions.index',['divisions' => $divisions]);
    }
    public function create()
    {
    	return view('divisions.create');
    }
    public function edit($id)
    {
        $division = Division::find($id);
        return view('divisions.edit', [
            'division' => $division
        ]);
    }
    public function store(Request $request)
    {
        $division = new Division;
        $division->division_name = $request->division_name;
        $division->save();

        return redirect()->route('division.index');
    }
    public function editStore(Request $request,$id)
    {
    	$division = Division::find($id);
        $division->division_name = $request->division_name;
        $division->save();

    	return redirect()->route('division.index');
    }
    public function destroy($id)
    {
        Division::find($id)->delete();
        return redirect()->route('division.index');
    }
}
