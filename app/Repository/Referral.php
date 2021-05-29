<?php

namespace App\Repository;

use App\Models\ReferralRegistration as Sifarish; // Eng -> Urdu

class Referral 
{
    public function history($id = null)
    {
        $referrals = Sifarish::with(['refBy', 'refTo'])->orderBy('created_at', 'DESC')->get();
        if(!is_null($id))
            $referrals = Sifarish::with(['refBy', 'refTo'])->where('ref_id', $id)->orderBy('created_at', 'DESC')->get();

        return $referrals;
    }
    
}