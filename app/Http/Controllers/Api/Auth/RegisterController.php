<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use Hash;
use DB;

use App\Models\User;
use App\Models\Preference;
use App\Models\Wallet;
use App\Models\ReferralRegistration;

use App\Helpers\EmailAlert;
use App\Helpers\SMSAlert;

class RegisterController extends Controller
{
    public $successStatus = 200;

    public function register(Request $request){
        // return response()->json($request->all(), 200);
        $validator = Validator::make($request->all(), [
            'user_name' => 'required',
            'email' => 'required|unique:users,email',
            'contact_number' => 'required|numeric|unique:users,contact_no',
            'password' => 'required|string',
            'confirm_password' => 'required|string|same:password'
        ], [
            'user_name.required' => 'Username is required',
            'email.required' => 'Email is required',
            'email.unique' => 'Email already is use',
            'contact_number.required' => 'Contact number is required',
            'contact_number.unique' => 'Contact number already is use',
        ]);

        if($validator->fails()){
            return response()->json([
                'response' => 'failed',
                'result' => $validator->errors()
            ], 400);
        }

        DB::beginTransaction();

        try {
            $input = $request->all();
            $user = User::create([
                'name' => $request->user_name,
                'email' => $request->email,
                'contact_no' => $request->contact_number,
                'password' => Hash::make($request->password),
                'source' => 'mobile'
            ]);

            $user->attachRole('student');

            $coins = Preference::where('name', 'default_student_coins')->first()->value ?? 0;

            $wallet = new Wallet;
            $wallet->user_id = $user->id;
            $wallet->total_coins = $coins;
            $wallet->save();

            EmailAlert::accountVerification($user);
            SMSAlert::accountVerification($user);

            
            if(isset($request->ref)){
                // $refByUserId = \base64_decode($request->ref);
                $refByUser = User::where('ref_code', $request->ref);

                $refAmountCol = Preference::where('name', 'ref_coins')->first();
                $refAmount = is_null($refAmountCol) ? 0 : $refAmountCol->value;

                $wallet = new Wallet;
                $wallet->user_id = $refByUser->id;
                $wallet->total_coins = $refAmount;
                $wallet->save();

                $walletz = new Wallet;
                $walletz->user_id = $user->id;
                $walletz->total_coins = $refAmount;
                $walletz->save();

                $refReg = new ReferralRegistration;
                $refReg->ref_id = $refByUser->id;
                $refReg->user_id = $user->id;
                $refReg->ref_received_coins = $refAmount;
                $refReg->user_received_coins = $refAmount;
                $refReg->save();

                $user->ref_by = $refByUser->id;
                $user->save();
            }

        } catch (\Throwable $th) {
            DB::rollback();

            return $th;
            return response()->json(['error' => 'Please, try again'], 401);
        }

        DB::commit();
        return response()->json([
            'response' => 'success',
            'result' => $user,
            'message' => 'User has been created successfully',
        ], $this->successStatus);

    }
}
