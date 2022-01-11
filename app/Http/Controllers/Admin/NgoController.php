<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repository\Ngo;

use Toastr;

class NgoController extends Controller
{
    public $ngo;

    public function __construct(Ngo $ngo) {
        $this->ngo = $ngo;
    }

     // shows the list of all ngos.
    public function index(){
        $ngos = $this->ngo->get();
		return view('admin.ngo.index')->with([ 
			'ngos' => $ngos // sending the list to view.
		]);
    }
  
    // shows the creating a ngos page.
	public function create() {
		return view('admin.ngo.create');
    }

    public function edit($id) {
        $ngo = $this->ngo->get($id);

		return view('admin.ngo.edit')->with([
            'ngo' => $ngo
        ]);
    }

    public function delete($id) {
        try {
            $this->ngo->delete($id);

            Toastr::success('ngo deleted successfully', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            Toastr::error('This ngo has some relations. Please, broke relations first');
            return redirect()->back();
        
        }
    }

    public function submit(Request $req) {
        
        $req->validate([
            'name' => 'required|string'
        ]);

        try {
            $this->ngo->save($req);
            Toastr::success('ngo has been added successfully', 'Success');
            return is_null($req->redirect_to) ? redirect()->back() : redirect($req->redirect_to);

        } catch (\Throwable $th) {
            dd($th);
            Toastr::error('Server side error', 'Failure!');
            return redirect()->back()->withInput();
        }
    }

    public function update(Request $req) {
        
        $req->validate([
            'name' => 'required|string'
        ]);


        try {
            $this->ngo->save($req, $req->id);
            Toastr::success('ngo has been updated successfully', 'Success');
            return is_null($req->redirect_to) ? redirect()->back() : redirect($req->redirect_to);

        } catch (\Throwable $th) {
            // dd($th);
            Toastr::error('Server side error', 'Failure!');
            return redirect()->back()->withInput();
        }
    }

}
