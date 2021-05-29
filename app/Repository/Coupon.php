<?php

namespace App\Repository;

use App\Models\Coupon as Coup;

class Coupon 
{
    public function get($id = null)
    {
        $coupons = Coup::all();
        if(!is_null($id))
            $coupons = Coup::find($id);

        return $coupons;
    }

    public function save($request, $id = null) 
    {
        if (is_null($id)) 
            $coupon = new Coup;
        else 
            $coupon = Coup::find($id);

        $coupon->code = $request->code;
        // $coupon->type = $request->type == 'on' ? 1 : 0;
        $coupon->expire_date = $request->expire_date;
        $coupon->max_limit = $request->max_limit;
        $coupon->usage_limit_per_student = $request->usage_limit_per_student;
        $coupon->discount_percentage = $request->discount_percentage ?? 0;
        $coupon->discount_amount = $request->discount_amount ?? 0;
        $coupon->status = $request->status == 'on' ? 1 : 0;
        $coupon->description = $request->description;
        $coupon->save();

        return $coupon;
    }

    public function delete($id)
    {
        Coup::destroy($id);
    }
    
}