<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

use Auth;
use Crypt;
use Hash;
use Toastr;
use DB;
use DataTables;

class UserController extends Controller
{
    // shows the list of all users.
    public function index(){
		return view('admin.user.index');
	}
	
	public function ajaxIndex(){
		
		/**
         * @return users with Data Table instance. 
         */

		$users = User::whereDoesntHaveRole()->orWhereRoleIs('student')->get(); 
		$url = \URL::to('/');
		// return $users;
        return Datatables::of($users)
        ->editColumn('name', function ($users) use ($url) {
            return "<a href='{$url}/admin/user/edit/{$users->id}'>{$users->name}</a>";
        })
		->addColumn('referrals', function ($users) use ($url) {
            return "<a href='{$url}/admin/referral/{$users->id}'><i class='fa fa-eye'></i> Referrals</a>";
		})
		->addColumn('results', function ($users) use ($url) {
			if($users->results)
            	return "<a href='{$url}/admin/result/{$users->id}'><i class='fa fa-eye'></i> Results</a>";
			else 
				return '';
		})
        ->addColumn('action', function ($users) use ($url) {
			return "<a class='text-primary' href='{$url}/admin/user/view/{$users->id}' data-toggle='tooltip' data-placement='top' title='' data-original-title='View'><i class='bx bx-eye'></i></a><a class='text-danger' href='{$url}/admin/user/delete/{$users->id}' data-toggle='tooltip' data-placement='top' title='' data-original-title='Delete'><i class='bx bx-trash'></i></a>";
        })
        ->rawColumns(['name', 'referrals', 'results', 'action'])
		->make(true);
		
	}
    
    // shows the creating a user page.
	public function create(){
		return view('admin.user.create');
    }

    // shows the edit page of user.
    public function edit($id){

		$user = User::with('roles')->find($id); // getting the speific user to edit
		$roles = Role::all();
		return view('admin.user.edit')->with([
			'user' => $user, // sending user record to edit view.
			'roles' => $roles
		]);
    }

	public function view($id){
		return view('admin.user.view');
	}

    // shows the deleting method of user.
    public function delete($id){

		try {
			User::destroy($id); // checks the if user is deletable or not.
		} catch (\Throwable $th) {
            abort(404); // if argu is wrong then 404 page.
		}

		// Toastr is notification package we are using for project.
		Toastr::success('user record deleted successfully', 'Success');
		return redirect()->back(); // redirecting back to list page.
	}
    
    // submitting record to Database.
	public function submit(Request $request){

		// dd($request->all());
		// added some validation for form values. 
		$request->validate([
			'name' => 'required|string',
			'email' => 'required|string',
			'password' => 'required|string',
			'contact_no' => 'required|string',
			'profile' => 'mimes:png,jpg,jpeg'
		]);
		
		DB::beginTransaction(); // starting transaction for runtime db error.
		// if one query executed and other gives error then both will be roll backed. 
		try {
			// dd($request->all()); // debugging method die dump.
			$user = new User;
			$user->name = $request->name;
			$user->email = $request->email;
			$user->password = Hash::make($request->password);
            $user->contact_no = $request->contact_no;
			$user->source = 'admin-panel';
			if ($request->hasFile('profile')) {

                $image = $request->file('profile');
                $name = 'std' . time().'.'.$image->getClientOriginalExtension();
                $destinationPath = storage_path('/app/public/images/students');
                $image->move($destinationPath, $name);
                $user->profile_picture = $name;   
            }
			$user->save();
			$user->attachRole('student');

		} catch (\Throwable $th) {
			// dd($th);
			DB::rollback();
			Toastr::error('Server side error');
			return redirect()->back();
		}

		DB::commit();
		Toastr::success('student added successfully', 'Success');
        return redirect('admin/user');
	}
    
    // update a specific user in database.
    public function update(Request $request){

		// dd($request->all());
		// added some validation for form values. 
		$request->validate([
			'name' => 'required|string',
			// 'email' => 'required|string',
			// 'contact_no' => 'required|string',
			'profile' => 'mimes:png,jpg,jpeg|nullable'
		]);
		
		DB::beginTransaction(); // starting transaction for runtime db error.
		// if one query executed and other gives error then both will be roll backed. 
		try {
			// dd($request->all()); // debugging method die dump.
			$user = User::findOrFail($request->id);
			$user->name = $request->name;
			// $user->contact_no = $request->contact_no;
			if ($request->hasFile('profile')) {

                $image = $request->file('profile');
                $name = 'std' . time().'.'.$image->getClientOriginalExtension();
                $destinationPath = storage_path('/app/public/images/students');
                $image->move($destinationPath, $name);
                $user->profile_picture = $name;   
            }
			$user->save();

		} catch (\Throwable $th) {
			dd($th);
			DB::rollback();
			Toastr::error('Server side error');
			return redirect()->back();
		}

		DB::commit();
		Toastr::success('student record updated successfully', 'Success');
        return redirect()->back();
	}


	public function updatePassword(Request $request){
		$password = $request->password;
		$request->validate([
			'current_password' => 'required|string',
			'password' => 'required|string|different:current_password',
			'confirm_password' => 'required|string|same:password'
		]);


		$user = User::find($request->id);

		$oldPass = $user->password;
		if(Hash::check($password, $oldPass)){
			$user->password = Hash::make($password);
			$user->save();

			Toastr::success('Password update successfully', 'Updated');
			return redirect()->back();
		}

		Toastr::error('Your current Password does not match with your Password', 'Error');
		return redirect()->back();
	}



}
