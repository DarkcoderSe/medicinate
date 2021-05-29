<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Helpers\Madadgar;

use App\Models\User;
use App\Models\Preference;
use App\Models\Wallet;

use Carbon\Carbon;
use Auth;
use Hash;

class LoginController extends Controller
{
    public $successStatus = 200;

    public function login(){

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('PrepareHow')->accessToken;
            $user->api_token = $success['token'];
            $user->last_login_at = Carbon::now();
            $user->save();

            $currentCoins = Madadgar::coins();

            return response()->json([
                'response' => 'success',
                'result' => $user,
                'currentCoins' => $currentCoins
            ], $this->successStatus);
        }
        else{
            return response()->json([
                'response' => 'failed',
                'result'=>'Unauthorised'
            ], 401);
        }
    }


    public function social(Request $request){
        $user = User::where('email', $request->email)->first();
        if(!is_null($user)){
            Auth::attempt(['email' => request('email'), 'password' => 'password']);
            
            // $loggedInUser = Auth::loginUsingId($user->id);
            $user = Auth::user();
            $success['token'] =  $user->createToken('PrepareHow')->accessToken;
            $user->api_token = $success['token'];
            $user->last_login_at = Carbon::now();
            $user->save();
        }
        else{
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make('password');
            $user->profile_picture = $request->profile_image_link;
            $user->source = 'mobile facebook';
            $user->last_login_at = Carbon::now();
            $user->save();

            // Auth::loginUsingId($user->id);
            Auth::attempt(['email' => request('email'), 'password' => 'password']);

            /**
             * Adding token
             */
            $user = Auth::user();
            $user->api_token = $user->createToken('PrepareHow')->accessToken;
            $user->save();

            $user->attachRole('student');

            $coins = Preference::where('name', 'default_student_coins')->first()->value ?? 0;

            $wallet = new Wallet;
            $wallet->user_id = $user->id;
            $wallet->total_coins = $coins;
            $wallet->save();
            
        }
        $currentCoins = Madadgar::coins();


        return response()->json([
            'response' => 'success',
            'result' => $user,
            'currentCoins' => $currentCoins
        ], $this->successStatus);
    }

    
}
