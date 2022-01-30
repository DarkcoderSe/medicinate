<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Toastr;

class ProfileController extends Controller
{
    public function index(){
        return view('admin.profile');
    }
    //

    public function submit(Request $request){
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'logo_url' => 'url|nullable'
        ]);

        $user = Auth::guard('admin')->user();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->region = $request->region;
        $user->logo_url = $request->logo_url;
        $user->active = $request->active == 'on' ? 1 : 0;
        $user->save();

        Toastr::success('Profile updated successfully');
        return redirect()->back();
    }
}
