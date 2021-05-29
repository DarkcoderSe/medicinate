<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repository\Referral;

use Toastr;

class ReferralRegistrationController extends Controller
{
    public $referral;

    public function __construct(Referral $referral) {
        $this->referral = $referral;
    }

    public function index($id = null){
        $referrals = $this->referral->history($id);

		return view('admin.referral.index')->with([ 
			'referrals' => $referrals
		]);
    }
}
