<?php

namespace App\Http\Controllers\StripController;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Stripe;
use Session;
class StripController extends Controller
{
    public  function purchasForm(){
        return view('StripPayment.show');
    }
    public function purchas(Request $request){
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
       $data = Stripe\Charge::create([
            "amount" => $request->amount * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from ",
        ]);
        Payment::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'cardNumber'=>$request->cardNumber,
            'expirationYear'=>$request->expirationYear,
            'expirationMonth'=>$request->expirationMonth,
            'amount'=>$data->amount,
            'transactionId'=>$data->balance_transaction,
        ]);
        Session::flash('success', 'Payment successful!');

        return back();
    }
}
