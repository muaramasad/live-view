<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Division;
use App\Site;

class DivisionController extends Controller
{
    public function __construct()
    {
        $this->icons = ['1' => 'Chicken', '2' => 'Fish', '3' => 'Cow'];
    }

    public function index()
    {
    	$divisions = Division::All();
    	return view('divisions.index',['divisions' => $divisions]);
    }
    public function create()
    {
    	return view('divisions.create', [
            'icons' => $this->icons
        ]);
    }
    public function edit($id)
    {
        $division = Division::find($id);
        return view('divisions.edit', [
            'division' => $division,
            'icons' => $this->icons
        ]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'division_name' => 'required|max:255',
        ]);
        $division = new Division;
        $division->division_name = $request->division_name;
        $division->icon_path = $request->icon;
        $request->session()->flash('is-success', 'Division successfully added!');
        $division->save();

        return redirect()->route('division.index');
    }
    public function editStore(Request $request,$id)
    {
        $validatedData = $request->validate([
            'division_name' => 'required|max:255',
        ]);
    	$division = Division::find($id);
        $division->division_name = $request->division_name;
        $division->icon_path = $request->icon;
        $division->save();
        $request->session()->flash('is-success', 'Division successfully updated!');
    	return redirect()->route('division.index');
    }
    public function destroy(Request $request,$id)
    {
        if (Division::has('areas')->find($id)) {
            return redirect()->route('division.index')->withErrors(['error' => 'Division still has area, remove area first.']);
        }
        Division::find($id)->delete();
        $request->session()->flash('is-success', 'Division successfully removed!');
        return redirect()->route('division.index');
    }
}
