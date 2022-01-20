<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe;
use Session;
use Auth;

use App\Models\Payment;

class StripeController extends Controller
{
    /**
     * payment view
     */
    public function handleGet(Request $request )
    {
        // $intent = auth()->user()->createSetupIntent();
        return view('stripe');
    }




    /**
     * handling payment with POST
     */
    public function handlePost(Request $request)
    {
        // return $request;
        Stripe\Stripe::setApiKey('sk_test_51KFN2cBT9ZQqIPsm97rZgYD58G3aokaOaH6q49wORAcRybl9fzUTAD6gRomkJdRZia2nCBdbzACzVQSVAfnNPfiv0034HRKRpP');
        $stripeData = Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Donation payment."
        ]);

        // dd($stripeData);
        $payment = new Payment;
        $payment->name = auth()->user()->name ?? '';
        $payment->email = auth()->user()->email ?? '';
        $payment->charge_id = $stripeData->id;
        $payment->amount = $stripeData->amount / 100;
        $payment->transaction_id = $stripeData->balance_transaction;
        $payment->description = $stripeData->description;
        $payment->last4 = $stripeData->payment_method_details->card->last4 ?? '';
        $payment->recipt_url = $stripeData->receipt_url;
        $payment->stripe_status = $stripeData->status;
        $payment->save();


        Session::flash('success', 'Payment has been successfully processed.');

        return back();
    }


    // public function info()
    // {
    //     // $intent = auth()->user()->createSetupIntent();
    //     return view('user');
    // }


}
