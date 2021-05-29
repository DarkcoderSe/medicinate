<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repository\Redeem;

use Toastr;

class RedeemController extends Controller
{
    public $redeem;

    public function __construct(Redeem $redeem) {
        $this->redeem = $redeem;
    }

    public function index($id = null){
        $redeems = $this->redeem->history($id);

		return view('admin.redeem.index')->with([ 
			'redeems' => $redeems
		]);
    }
}
