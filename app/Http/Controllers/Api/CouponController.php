<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Coupon;
use App\Models\CouponHistory;

use Carbon\Carbon;
use Auth;

class CouponController extends Controller
{
    public function apply(Request $request){
        try {
            $coupon = Coupon::where('code', $request->code)->first();
            if(is_null($coupon))
                return response()->json([
                    'result' => 'Not found',
                    'response' => 'failed'
                ], 400);

            $now = Carbon::now();
            if($coupon->expire_date <= $now)
                return response()->json([
                    'result' => 'Coupon code is expired.',
                    'response' => 'failed'
                ], 400);

            $couponUsers = $coupon->users;
            if($coupon->usage_count <= $couponUsers->count())
                return response()->json([
                    'result' => "Coupon code usage exceeded. You have used {$couponUsers->count()}x",
                    'response' => 'failed'
                ], 400);

            $couponUser = $couponUsers->where('user_id', Auth::user()->id);
            if($coupon->usage_limit_per_student <= $couponUser->count())
                return response()->json([
                    'result' => "Coupon code usage exceeded. You have used {$couponUser->count()}x",
                    'response' => 'failed'
                ], 400);
        
            $couponHistory = new CouponHistory;
            $couponHistory->user_id = Auth::user()->id;
            $couponHistory->coupon_id = $coupon->id;
            $couponHistory->save();
            
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json([
                'result' => 'Server side error',
                'response' => 'failed'
            ], 500);
        }

        return response()->json([
            'result' => "User is valid for this coupon. User will get {$coupon->discount_percentage}% discount on purchase!",
            'coupon' => $coupon,
            'response' => 'success'
        ], 200);
    }
}
