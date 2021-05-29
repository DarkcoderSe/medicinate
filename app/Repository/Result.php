<?php

namespace App\Repository;

use App\Models\Result as Natija; // Eng -> Urdu

class Result 
{
    public function history($id = null)
    {
        $results = Natija::with(['answeredQuestions', 'user'])->orderBy('created_at', 'DESC')->get();
        if(!is_null($id))
            $results = Natija::with(['answeredQuestions', 'user'])->where('user_id', $id)->orderBy('created_at', 'DESC')->get();

        return $results;
    }
    
}