<?php

namespace App\Repository;

use App\Models\Wallet; 

class Coin 
{
    public function history($id = null)
    {
        $redeems = Wallet::with(['paymentMethod', 'user'])->orderBy('created_at', 'DESC')->get();
        if(!is_null($id))
            $redeems = Wallet::with(['paymentMethod', 'user'])->where('user_id', $id)->orderBy('created_at', 'DESC')->get();

        return $redeems;
    }
    
}