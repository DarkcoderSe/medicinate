<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\PaymentMethodDetail;

use DB;
use Toastr;

class PaymentMethodController extends Controller
{
    // shows the list of all paymentMethods.
    public function index(){
		$paymentMethods = PaymentMethod::all(); // get all paymentMethods here.
		return view('admin.payment_method.index')->with([ 
			'paymentMethods' => $paymentMethods // sending the list to view.
		]);
    }
    
    // shows the creating a paymentMethod page.
	public function create(){
		return view('admin.payment_method.create');
    }

    // shows the edit page of paymentMethod.
    public function edit($id){
		$paymentMethod = PaymentMethod::find($id); // getting the speific paymentMethod to edit
		return view('admin.payment_method.edit')->with([
			'paymentMethod' => $paymentMethod // sending paymentMethod record to edit view.
		]);
    }

    // shows the deleting method of paymentMethod.
    public function delete($id){
		try {
			PaymentMethod::destroy($id); // checks the if paymentMethod is deletable or not.
		} catch (\Throwable $th) {
            abort(404); // if argu is wrong then 404 page.
		}

		// Toastr is notification package we are using for project.
		Toastr::success('Payment Method deleted successfully', 'Deleted!');
		return redirect()->back(); // redirecting back to list page.
	}
    
    // submitting record to Database.
	public function submit(Request $request){

		$request->validate([
			'name' => 'required|string',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif',
		]);
		
		DB::beginTransaction(); // starting transaction for runtime db error.
		// if one query executed and other gives error then both will be roll backed. 
		try {
			// dd($request->all()); // debugging method die dump.
			$paymentMethod = new PaymentMethod;
            $paymentMethod->name = $request->name;

            if ($request->hasFile('image')) {

                $image = $request->file('image');
                $name = 'pm_' . time().'.'.$image->getClientOriginalExtension();
                $destinationPath = storage_path('/app/public/images/payment_methods');
                $image->move($destinationPath, $name);
                $paymentMethod->image = $name;   
            }

			$paymentMethod->status = $request->status == 'on' ? 1 : 0;
			$paymentMethod->type = $request->type == 'on' ? 1 : 0;
            $paymentMethod->save();

		} catch (\Throwable $th) {
			dd($th);
			DB::rollback();
			Toastr::error('Server side error');
			return redirect()->back();
		}

		DB::commit();
		Toastr::success('Payment Method added successfully', 'Created!');
		
		if($request->ajax())
			return response()->json(paymentMethod::all(), 200);
		else
        	return isset($request->redirect_to) ? redirect($request->redirect_to) : redirect()->back();
	}
    
    // update a specific paymentMethod in database.
    public function update(Request $request){

		$request->validate([
			'name' => 'required|string',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif',
            'description' => 'nullable|string'
		]);
		
		DB::beginTransaction(); // starting transaction for runtime db error.
		// if one query executed and other gives error then both will be roll backed. 
		try {
			// dd($request->all()); // debugging method die dump.
			$paymentMethod = PaymentMethod::find($request->id);
            $paymentMethod->name = $request->name;

            if ($request->hasFile('image')) {

                $image = $request->file('image');
                $name = 'pm_' . time().'.'.$image->getClientOriginalExtension();
                $destinationPath = storage_path('/app/public/images/payment_methods');
                $image->move($destinationPath, $name);
                $paymentMethod->image = $name;   
            }


			$paymentMethod->status = $request->status == 'on' ? 1 : 0;
			$paymentMethod->type = $request->type == 'on' ? 1 : 0;
            $paymentMethod->save();

		} catch (\Throwable $th) {
			// dd($th);
			DB::rollback();
			Toastr::error('Server side error');
			return redirect()->back();
		}

		DB::commit();
		Toastr::success('Payment Method added successfully', 'Created!');
		
		if($request->ajax())
			return response()->json(paymentMethod::all(), 200);
		else
        	return isset($request->redirect_to) ? redirect($request->redirect_to) : redirect()->back();
        
	}

	public function detailSubmit(Request $request){
		$request->validate([
			'secret_api' => 'required|string',
			'public_api' => 'required|string',
			'extra' => 'nullable|string',
			'description' => 'nullable|string'
		]);

		$detail = new PaymentMethodDetail;
		$detail->payment_method_id = $request->payment_method_id;
		$detail->private_key = $request->secret_api;
		$detail->public_key = $request->public_api;
		$detail->name = $request->extra;
		$detail->save();

		Toastr::success('Payment Method Detail is added!');
		return redirect()->back();
	}

	public function detailDelete($id){
		PaymentMethodDetail::destroy($id);
		Toastr::success('Payment Method deleted successfully');
		return redirect()->back();
	}
}