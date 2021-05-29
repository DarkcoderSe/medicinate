<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repository\Coupon;

use Toastr;

class CouponController extends Controller
{
    public $coupon;

    public function __construct(Coupon $coupon) {
        $this->coupon = $coupon;
    }

     // shows the list of all coupons.
    public function index(){
        $coupons = $this->coupon->get();
		return view('admin.coupon.index')->with([ 
			'coupons' => $coupons // sending the list to view.
		]);
    }
  
    // shows the creating a coupons page.
	public function create() {
		return view('admin.coupon.create');
    }

    public function edit($id) {
        $coupon = $this->coupon->get($id);

		return view('admin.coupon.edit')->with([
            'coupon' => $coupon
        ]);
    }

    public function delete($id) {
        try {
            $this->coupon->delete($id);

            Toastr::success('Coupon deleted successfully', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            Toastr::error('This Coupon has some relations. Please, broke relations first');
            return redirect()->back();
        
        }
    }

    public function submit(Request $req) {
        
        $req->validate([
            'code' => 'required|string',
            'type' => 'nullable|string',
            'expire_date' => 'nullable|date',
            'max_limit' => 'numeric|nullable',
            'usage_limit_per_student' => 'numeric|nullable',
            'discount_percentage' => 'nullable|numeric',
            'discount_amount' => 'nullable|numeric',
            'description' => 'nullable|string'
        ]);

        try {
            $this->coupon->save($req);
            Toastr::success('Coupon has been added successfully', 'Success');
            return is_null($req->redirect_to) ? redirect()->back() : redirect($req->redirect_to);

        } catch (\Throwable $th) {
            // dd($th);
            Toastr::error('Server side error', 'Failure!');
            return redirect()->back()->withInput();
        }
    }

    public function update(Request $req) {

        $req->validate([
            'code' => 'required|string',
            'type' => 'nullable|string',
            'expire_date' => 'nullable|date',
            'max_limit' => 'numeric|nullable',
            'usage_limit_per_student' => 'numeric|nullable',
            'discount_percentage' => 'nullable|numeric',
            'discount_amount' => 'nullable|numeric',
            'description' => 'nullable|string',
            'id' => 'required|numeric'
        ]);

        try {
            $this->coupon->save($req, $req->id);
            Toastr::success('coupon has been updated successfully', 'Success');
            return is_null($req->redirect_to) ? redirect()->back() : redirect($req->redirect_to);

        } catch (\Throwable $th) {
            // dd($th);
            Toastr::error('Server side error', 'Failure!');
            return redirect()->back()->withInput();
        }
    }
}
