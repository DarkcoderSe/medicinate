<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\PasswordReset;

use App\Helpers\SMSAlert;
use App\Helpers\EmailAlert;

use Validator;
use Hash;

use Carbon\Carbon;

class ResetPasswordController extends Controller
{
    //
    public function getResetToken(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'nullable|email',
            'contact_number' => 'nullable|numeric'
        ]);

        if($validator->fails()){
            return response()->json([
                'response' => 'failed',
                'result' => $validator->errors()
            ], 400);
        }

        try {
            $passwordReset = new PasswordReset;
            if(isset($request->email))
                $passwordReset->email = $request->email;
            elseif(isset($request->contact_number))
                $passwordReset->contact_no = $request->contact_number;

            $token = \rand(111111, 999999);
            $passwordReset->token = $token;
            $passwordReset->created_at = Carbon::now();
            $passwordReset->save();

            if(isset($request->contact_number))
                SMSAlert::resetToken($token, $request->contact_number);
            elseif(isset($request->email))
                EmailAlert::resetToken($request, $token);


        } catch (\Throwable $th) {
            return response()->json([
                'response' => 'failed'
            ], 404);
        }

        return response()->json([
            'response' => 'success'
        ], 200);
    }

    public function sendTokenAgain(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'nullable|email',
            'contact_number' => 'nullable|numeric'
        ]);

        if($validator->fails()){
            return response()->json([
                'response' => 'failed',
                'result' => $validator->errors()
            ], 400);
        }

        try {
            if(isset($request->email)){
                $passwordResets = PasswordReset::where('email', $request->email)->get();
                $passwordReset = $passwordResets->last();
            }
            elseif(isset($request->contact_number)){
                $passwordResets = PasswordReset::where('contact_no', $request->contact_number)->get();
                $passwordReset = $passwordResets->last();
            }

            $token = $passwordReset->token;

            // dd($request->all());

            if(isset($request->contact_number))
                SMSAlert::resetToken($token, $request->contact_number);
            elseif(isset($request->email)){
                $user = User::where('email', $request->email)->first();
                // dd($user);
                EmailAlert::resetToken($user, $token);
            }


        } catch (\Throwable $th) {
            throw $th;
            return response()->json([
                'response' => 'failed'
            ], 404);
        }

        return response()->json([
            'response' => 'success'
        ], 200);
    }

    public function matchToken(Request $request){
        try {
            $passwordResets = PasswordReset::where(function($q) use ($request) {
                                            if(isset($request->email))
                                                return $q->where('email', $request->email);
                                            elseif(isset($request->contact_number))
                                                return $q->where('contact_no', $request->contact_number);
                                        })->get();

            $passwordReset = $passwordResets->last();
            if($passwordReset->token == $request->reset_token){
                return response()->json([
                    'response' => 'success'
                ], 200);
            }
            else{
                return response()->json([
                    'response' => 'failed'
                ], 404);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'response' => 'failed'
            ], 404);
        }
    }

    public function resetPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'min:6', 'confirmed', 'different:old_password'],
            'password_confirmation' => ['required', 'min:6', 'same:password'],
        ]);

        if($validator->fails()){
            return response()->json([
                'response' => 'failed',
                'result' => $validator->errors()
            ], 400);
        }

        $passwordResets = PasswordReset::where(function($q) use ($request) {
                            if(isset($request->email))
                                return $q->where('email', $request->email);
                            elseif(isset($request->contact_number))
                                return $q->where('contact_no', $request->contact_number);
                        })->get();

        $passwordReset = $passwordResets->last();
        if($passwordReset->token != $request->reset_token){
            return response()->json([
                'response' => 'failed'
            ], 404);
        }

        $user = User::where(function($q) use ($request) {
                if(isset($request->email))
                    return $q->where('email', $request->email);
                elseif(isset($request->contact_number))
                    return $q->where('contact_no', $request->contact_number);
            })->first();

        $user->update(['password' => Hash::make($request->get('password'))]);

        return response()->json([
            'response' => 'success'
        ], 200);
    }
}
