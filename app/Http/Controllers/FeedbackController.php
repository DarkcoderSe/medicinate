<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ContactUs;

use Auth;
use Toastr;

class FeedbackController extends Controller
{
    public function index()
    {
        return view('feedback');
    }

    public function submit(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'nullable|email',
            'contact_no' => 'nullable|numeric',
            'message' => 'nullable|string'
        ]);

        $contactUs = new ContactUs;
        $contactUs->user_id = Auth::check() ? Auth::user()->id : null;
        $contactUs->name = $request->name;
        $contactUs->email = $request->email;
        $contactUs->contact_no = $request->contact_no;
        $contactUs->message = $request->message;
        $contactUs->save();

        Toastr::success('Your Feedback has been sent to admin', 'Success');
        return redirect()->back();
    }
}

