<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;


class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function show(){
        
        if(Auth::check()) 
            return redirect('/');

        // dd(Auth::check());
        return view('admin.auth.login');
    }

    public function submit(Request $request){
    
        if(Auth::attempt($request->only('email','password'),true)){
            //Authentication passed...
            // return Auth::user();
            return redirect()
                ->intended(route('admin.home'));
        }
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
    //
}
