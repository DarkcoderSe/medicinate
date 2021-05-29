<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repository\Badge;

use Toastr;

class BadgeController extends Controller
{
    public $badge;

    public function __construct(Badge $badge) {
        $this->badge = $badge;
    }

     // shows the list of all badges.
    public function index(){
        $badges = $this->badge->get();
		return view('admin.badge.index')->with([ 
			'badges' => $badges // sending the list to view.
		]);
    }
  
    // shows the creating a badges page.
	public function create() {
		return view('admin.badge.create');
    }

    public function edit($id) {
        $badge = $this->badge->get($id);

		return view('admin.badge.edit')->with([
            'badge' => $badge
        ]);
    }

    public function delete($id) {
        try {
            $this->badge->delete($id);

            Toastr::success('Badge deleted successfully', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            Toastr::error('This badge has some relations. Please, broke relations first');
            return redirect()->back();
        
        }
    }

    public function submit(Request $req) {
        
        $req->validate([
            'name' => 'required|string',
            'maxScore' => 'nullable|nullable',
            'minScore' => 'nullable|nullable',
            'requiredTest' => 'numeric|nullable',
            'description' => 'nullable|string',
            'icon' => 'nullable|mimes:png,jpg,jpeg'
        ]);

        try {
            $this->badge->save($req);
            Toastr::success('Badge has been added successfully', 'Success');
            return is_null($req->redirect_to) ? redirect()->back() : redirect($req->redirect_to);

        } catch (\Throwable $th) {
            // dd($th);
            Toastr::error('Server side error', 'Failure!');
            return redirect()->back()->withInput();
        }
    }

    public function update(Request $req) {
        
        $req->validate([
            'name' => 'required|string',
            'maxScore' => 'nullable|nullable',
            'minScore' => 'nullable|nullable',
            'requiredTest' => 'numeric|nullable',
            'description' => 'nullable|string',
            'icon' => 'nullable|mimes:png,jpg,jpeg',
            'id' => 'required|numeric'
        ]);


        try {
            $this->badge->save($req, $req->id);
            Toastr::success('Badge has been updated successfully', 'Success');
            return is_null($req->redirect_to) ? redirect()->back() : redirect($req->redirect_to);

        } catch (\Throwable $th) {
            // dd($th);
            Toastr::error('Server side error', 'Failure!');
            return redirect()->back()->withInput();
        }
    }

}
