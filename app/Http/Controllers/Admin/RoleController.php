<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use Toastr;
use DB;

class RoleController extends Controller
{

	// shows the list of all roles.
    public function index(){
		$roles = Role::all(); 
		return view('admin.role.index')->with([
			'roles' => $roles
		]);
	}
	
    
    // shows the creating a role page.
	public function create(){
		return view('admin.role.create');
    }

    // shows the edit page of role.
    public function edit($id){

		$role = Role::find($id); // getting the speific role to edit
		$permissions = Permission::orderBy('display_name', 'asc')->get();

		return view('admin.role.edit')->with([
			'role' => $role, // sending role record to edit view.
			'permissions' => $permissions
		]);
    }

    // shows the deleting method of role.
    public function delete($id){

		try {
			Role::destroy($id);
		} catch (\Throwable $th) {
			throw $th;
            abort(404); // if argu is wrong then 404 page.
		}

		// Toastr is notification package we are using for project.
		Toastr::success('role record deleted successfully', 'Success');
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
			$role = new Role;
			$role->name = $request->name;
			$role->display_name = $request->display_name;
            $role->save();

		} catch (\Throwable $th) {
			// dd($th);
			DB::rollback();
			Toastr::error('Server side error');
			return redirect()->back();
		}

		DB::commit();
		Toastr::success('role added successfully', 'Success');
		
		$url = \URL::to('admin/role/edit', $role->id);
        return redirect($url);
	}
    
    // update a specific role in database.
    public function update(Request $request){

		// dd($request->all());
		// added some validation for form values. 
		$request->validate([
			'display_name' => 'required|string'
		]);
		
		DB::beginTransaction(); // starting transaction for runtime db error.
		// if one query executed and other gives error then both will be roll backed. 
		try {
			// dd($request->all()); // debugging method die dump.
			$role = Role::find($request->id);
			$role->display_name = $request->display_name;
			$role->save();
			

			if(count($request->perms) > 0){
				$role->detachPermissions();
				$permissions = Permission::whereIn('id', $request->perms)->get();
				// $role->attachPermission($permissions);
				foreach($permissions as $permission){
					$role->attachPermission($permission->name);
				}
			}

		} catch (\Throwable $th) {
			// dd($th);
			DB::rollback();
			Toastr::error('Server side error');
			return redirect()->back();
		}

		DB::commit();
        Toastr::success('role added successfully', 'Success');
        return isset($request->redirect_to) ? redirect($request->redirect_to) : redirect()->back();
        
	}
}
