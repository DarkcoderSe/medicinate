<?php

namespace App\Http\Controllers\StripController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StripController extends Controller
{
    public  function purchasForm(){
        return view('StripPayment.show');
    }
    public function purchas(Request $request){
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
            "amount" => 100 * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com."
        ]);

        Session::flash('success', 'Payment successful!');

        return back();
    }
}
