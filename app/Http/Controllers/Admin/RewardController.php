<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repository\Reward;

use Toastr;

class RewardController extends Controller
{
    //
    public $reward;

    public function __construct(reward $reward) {
        $this->reward = $reward;
    }

     // shows the list of all rewards.
    public function index(){
        $rewards = $this->reward->get();
		return view('admin.reward.index')->with([ 
			'rewards' => $rewards // sending the list to view.
		]);
    }
  
    // shows the creating a rewards page.
	public function create() {
		return view('admin.reward.create');
    }

    public function edit($id) {
        $reward = $this->reward->get($id);

		return view('admin.reward.edit')->with([
            'reward' => $reward
        ]);
    }

    public function delete($id) {
        try {
            $this->reward->delete($id);

            Toastr::success('Reward deleted successfully', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            Toastr::error('This Reward has some relations. Please, broke relations first');
            return redirect()->back();
        
        }
    }

    public function submit(Request $req) {
        
        $req->validate([
            'coins' => 'required|numeric',
            'limit' => 'nullable|numeric',
            'expire_at' => 'nullable|date',
            'ad' => 'string|nullable',
            'order' => 'nullable|numeric',
            'icon' => 'nullable|mimes:png,jpg,jpeg'
        ]);

        try {
            $this->reward->save($req);
            Toastr::success('Reward has been added successfully', 'Success');
            return is_null($req->redirect_to) ? redirect()->back() : redirect($req->redirect_to);

        } catch (\Throwable $th) {
            // dd($th);
            Toastr::error('Server side error', 'Failure!');
            return redirect()->back()->withInput();
        }
    }

    public function update(Request $req) {
        
        $req->validate([
            'coins' => 'required|numeric',
            'limit' => 'nullable|numeric',
            'expire_at' => 'nullable|date',
            'ad' => 'string|nullable',
            'order' => 'nullable|numeric',
            'icon' => 'nullable|mimes:png,jpg,jpeg'
        ]);

        try {
            $this->reward->save($req, $req->id);
            Toastr::success('Reward has been updated successfully', 'Success');
            return is_null($req->redirect_to) ? redirect()->back() : redirect($req->redirect_to);

        } catch (\Throwable $th) {
            // dd($th);
            Toastr::error('Server side error', 'Failure!');
            return redirect()->back()->withInput();
        }
    }

}
