<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class ReferralController extends Controller
{

    private function searchRefCode($code){
        $users = User::where('ref_code', $code)->get();
        if ($users->count() > 0) 
            $this->searchRefCode($code . \rand(1, 99));
        else {
            $user = Auth::user();
            $user->ref_code = $code;
            $user->save();

        }

    }

    public function index(){
        $user = Auth::user();
        $exEmail = explode('@', $user->email);
        $user->ref_code ?? $this->searchRefCode($exEmail[0]);

        return response()->json([
            'referralToken' => $user->ref_code,
            'response' => 'success'
        ], 200);
    }

    public function list(){
        $user = Auth::user();
        $referredUsers = $user->referredUsers;

        return response()->json([
            'referredUsers' => $referredUsers,
            'response' => 'success'
        ], 200);
    }
}
