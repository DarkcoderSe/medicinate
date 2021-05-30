<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repository\Manufacturer;

use Toastr;


class ManufacturerController extends Controller
{
    public $manufacturer;

    public function __construct(Manufacturer $manufacturer) {
        $this->manufacturer = $manufacturer;
    }

     // shows the list of all manufacturers.
    public function index(){
        $manufacturers = $this->manufacturer->get();
		return view('admin.manufacturer.index')->with([ 
			'manufacturers' => $manufacturers // sending the list to view.
		]);
    }
  
    // shows the creating a manufacturers page.
	public function create() {
		return view('admin.manufacturer.create');
    }

    public function edit($id) {
        $manufacturer = $this->manufacturer->get($id);

		return view('admin.manufacturer.edit')->with([
            'manufacturer' => $manufacturer
        ]);
    }

    public function delete($id) {
        try {
            $this->manufacturer->delete($id);

            Toastr::success('manufacturer deleted successfully', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            Toastr::error('This manufacturer has some relations. Please, broke relations first');
            return redirect()->back();
        
        }
    }

    public function submit(Request $req) {
        
        $req->validate([
            'name' => 'required|string',
            'type_of_license' => 'string|nullable',
            'address' => 'nullable|string',
            'dmln' => 'required|string'
        ]);

        try {
            $this->manufacturer->save($req);
            Toastr::success('manufacturer has been added successfully', 'Success');
            return is_null($req->redirect_to) ? redirect()->back() : redirect($req->redirect_to);

        } catch (\Throwable $th) {
            dd($th);
            Toastr::error('Server side error', 'Failure!');
            return redirect()->back()->withInput();
        }
    }

    public function update(Request $req) {
        
        $req->validate([
            'name' => 'required|string',
            'type_of_license' => 'string|nullable',
            'address' => 'nullable|string',
            'dmln' => 'required|string'
        ]);


        try {
            $this->manufacturer->save($req, $req->id);
            Toastr::success('manufacturer has been updated successfully', 'Success');
            return is_null($req->redirect_to) ? redirect()->back() : redirect($req->redirect_to);

        } catch (\Throwable $th) {
            // dd($th);
            Toastr::error('Server side error', 'Failure!');
            return redirect()->back()->withInput();
        }
    }

}
