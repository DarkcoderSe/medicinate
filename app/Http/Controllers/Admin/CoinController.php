<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repository\Coin;

use Toastr;

class CoinController extends Controller
{
    public $coin;

    public function __construct(Coin $coin) {
        $this->coin = $coin;
    }

    public function index($id = null){
        $coins = $this->coin->history($id);

		return view('admin.coin.index')->with([ 
			'coins' => $coins
		]);
    }
    //
}
