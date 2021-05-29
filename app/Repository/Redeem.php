<?php

namespace App\Repository;

use App\Models\Redeem as Wasool; // Eng -> Urdu

class Redeem 
{
    public function history($id = null)
    {
        $redeems = Wasool::with(['reward', 'user'])->orderBy('created_at', 'DESC')->get();
        if(!is_null($id))
            $redeems = Wasool::with(['reward', 'user'])->where('reward_id', $id)->orderBy('created_at', 'DESC')->get();

        return $redeems;
    }
    
}