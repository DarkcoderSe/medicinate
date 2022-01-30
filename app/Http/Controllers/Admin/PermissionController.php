<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;

use Toastr;
use DB;
use DataTables;

class PermissionController extends Controller
{
    // shows the list of all permissions.
    public function index(){
		$permissions = Permission::all();
		return view('admin.permission.index')->with([
			'permissions' => $permissions
		]);
	}
    
    // shows the creating a permission page.
	public function create(){
		return view('admin.permission.create');
    }

    // shows the edit page of permission.
    public function edit($id){
		$permission = Permission::find($id); // getting the speific permission to edit
		return view('admin.permission.edit')->with([
			'permission' => $permission // sending permission record to edit view.
		]);
    }

    // shows the deleting method of permission.
    public function delete($id){

		try {
			Permission::destroy($id);
		} catch (\Throwable $th) {
            abort(404); // if argu is wrong then 404 page.
		}

		// Toastr is notification package we are using for project.
		Toastr::success('Permission record deleted successfully', 'Success');
		return redirect()->back(); // redirecting back to list page.
	}
    
    // submitting record to Database.
	public function submit(Request $request){
		
		$request->validate([
			'name' => 'required|string',
            'display_name' => 'required|string',
            'redirect_to' => 'nullable|url'
		]);
		
		DB::beginTransaction(); // starting transaction for runtime db error.
		// if one query executed and other gives error then both will be roll backed. 
		try {
			// dd($request->all()); // debugging method die dump.
			$permission = new Permission;
			$permission->name = $request->name;
			$permission->display_name = $request->display_name;
            $permission->save();

		} catch (\Throwable $th) {
			dd($th);
			DB::rollback();
			Toastr::error('Server side error');
			return redirect()->back();
		}

		DB::commit();
		Toastr::success('Permission added successfully', 'Success');
		
		if($request->ajax())
			return response()->json(Permission::all(), 200);
		else
        	return isset($request->redirect_to) ? redirect($request->redirect_to) : redirect()->back();
	}
    
    // update a specific permission in database.
    public function update(Request $request){
		// added some validation for form values. 
		$request->validate([
			'display_name' => 'required|string'
		]);
		
		DB::beginTransaction(); // starting transaction for runtime db error.
		// if one query executed and other gives error then both will be roll backed. 
		try {
			// dd($request->all()); // debugging method die dump.
			$permission = Permission::find($request->id);
			$permission->display_name = $request->display_name;
            $permission->save();

		} catch (\Throwable $th) {
			dd($th);
			DB::rollback();
			Toastr::error('Server side error');
			return redirect()->back();
		}

		DB::commit();
        Toastr::success('Permission updated successfully', 'Success');
        return isset($request->redirect_to) ? redirect($request->redirect_to) : redirect()->back();
        
	}
}
