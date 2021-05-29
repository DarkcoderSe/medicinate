<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repository\Result;

class ResultController extends Controller
{
    public $result;

    public function __construct(Result $result) {
        $this->result = $result;
    }

    public function index($id = null){
        $results = $this->result->history($id);

		return view('admin.result.index')->with([ 
			'results' => $results
		]);
    }
}
