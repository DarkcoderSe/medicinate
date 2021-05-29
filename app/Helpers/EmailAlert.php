<?php 

namespace App\Helpers;

use App\Models\User;
use App\Models\Preference;
use App\Models\PasswordReset;

use App\Mail\EmailVerification;
use App\Mail\PasswordReset as PwdReset;

use Carbon\Carbon;
use Mail;

class EmailAlert
{
    public static function accountVerification($request){
        if(Preference::where('name', 'email_verification')->first()->value ?? false){
            $emailToken = rand(111111, 999999);

            $passwordReset = new PasswordReset;
            $passwordReset->email = $request->email;
            $passwordReset->token = $emailToken;
            $passwordReset->created_at = Carbon::now();
            $passwordReset->save();

            try {
                Mail::to($request->email)
                    ->queue(new EmailVerification($request->name, $emailToken));

            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }

    public static function resetToken($user, $token){
        if(Preference::where('name', 'email_verification')->first()->value ?? false){
           
            try {
                Mail::to($user->email)
                    ->queue(new PwdReset($user, $token));

            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }
}