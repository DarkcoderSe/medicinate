<?php 

namespace App\Helpers;

use App\Models\User;
use App\Models\Preference;
use App\Models\PasswordReset;

use Carbon\Carbon;


class SMSAlert
{
    public static function accountVerification($request){
        if(Preference::where('name', 'sms_verification')->first()->value ?? false){
            $smsToken = rand(111111, 999999);

            $passwordReset = new PasswordReset;
            $passwordReset->contact_no = $request->contact_no;
            $passwordReset->token = $smsToken;
            $passwordReset->created_at = Carbon::now();
            $passwordReset->save();

            try {
                $message_to_user = "Hi {$request->name}, We're excited to have you get started. First, you need to confirm your Phone number. 
                    Your Phone number verification code is {$smsToken}
                    Feel free to contact us via WhatsApp/Message at +92 331 3331920
                    PrepareHOW";

                $url = "https://lifetimesms.com/plain";
                $parameters = array(
                    "api_token" => "087ec576392918c8cf72a68ec372f6b79b5b492652",
                    "api_secret" => "pwhsecrettest",
                    "to" => $request->contact_no,
                    "from" => "PrepareHOW",
                    "message" => $message_to_user
                );

                $ch = curl_init();
                $timeout  =  30;
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
                curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
                $response = curl_exec($ch);
                curl_close($ch);

            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }

    public static function resetToken($token, $no){
        if(Preference::where('name', 'sms_verification')->first()->value ?? false){

            try {
                $message_to_user = "{$token} is your password reset token. 
                    Feel free to contact us via WhatsApp/Message at +92 331 3331920
                    PrepareHOW";

                $url = "https://lifetimesms.com/plain";
                $parameters = array(
                    "api_token" => "087ec576392918c8cf72a68ec372f6b79b5b492652",
                    "api_secret" => "pwhsecrettest",
                    "to" => $no,
                    "from" => "PrepareHOW",
                    "message" => $message_to_user
                );

                $ch = curl_init();
                $timeout  =  30;
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
                curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
                $response = curl_exec($ch);
                curl_close($ch);

            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }
}