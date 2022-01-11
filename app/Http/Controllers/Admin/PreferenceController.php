<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Preference;

use DB;
use Toastr;

class PreferenceController extends Controller
{
	
    // shows the list of all preferences.
    public function index(){
		$preferences = Preference::all(); // get all preferences here.
		return view('admin.preference.index')->with([ 
			'preferences' => $preferences // sending the list to view.
		]);
    }
    
    // shows the creating a preference page.
	public function create(){
		return view('admin.preference.create');
    }

    // shows the edit page of preference.
    public function edit($id){
		$preference = Preference::find($id); // getting the speific preference to edit
		return view('admin.preference.edit')->with([
			'preference' => $preference // sending preference record to edit view.
		]);
    }

    // shows the deleting method of preference.
    public function delete($id){

		try {
			Preference::destroy($id); // checks the if preference is deletable or not.
		} catch (\Throwable $th) {
            abort(404); // if argu is wrong then 404 page.
		}

		// Toastr is notification package we are using for project.
		Toastr::success('preference record deleted successfully', 'Success');
		return redirect()->back(); // redirecting back to list page.
	}
    
    // submitting record to Database.
	public function submit(Request $request){

		$request->validate([
			'name' => 'required|string',
            'value' => 'nullable|string',
            'description' => 'nullable|string'
		]);
		
		DB::beginTransaction(); // starting transaction for runtime db error.
		// if one query executed and other gives error then both will be roll backed. 
		try {
			// dd($request->all()); // debugging method die dump.
			$preference = new Preference;
			$preference->name = $request->name;
			$preference->value = $request->value;
            $preference->save();

		} catch (\Throwable $th) {
			dd($th);
			DB::rollback();
			Toastr::error('Server side error');
			return redirect()->back();
		}

		DB::commit();
		Toastr::success('Preference added successfully', 'Success');
		
		if($request->ajax())
			return response()->json(Preference::all(), 200);
		else
        	return isset($request->redirect_to) ? redirect($request->redirect_to) : redirect()->back();
	}
    
    // update a specific preference in database.
    public function update(Request $request){

		$request->validate([
			'name' => 'required|string',
            'value' => 'nullable|string',
            'description' => 'nullable|string'
		]);
		
		DB::beginTransaction(); // starting transaction for runtime db error.
		// if one query executed and other gives error then both will be roll backed. 
		try {
			// dd($request->all()); // debugging method die dump.
			$preference = Preference::findOrFail($request->id);
			$preference->name = $request->name;
			$preference->value = $request->value;
            $preference->save();

		} catch (\Throwable $th) {
			// dd($th);
			DB::rollback();
			Toastr::error('Server side error');
			return redirect()->back();
		}

		DB::commit();
		Toastr::success('Preference updated successfully', 'Success');
		
		if($request->ajax())
			return response()->json(Preference::all(), 200);
		else
        	return isset($request->redirect_to) ? redirect($request->redirect_to) : redirect()->back();
        
	}
}
