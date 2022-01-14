<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe;
use Session;
use Auth;

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
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Making test payment." 
        ]);
  
        Session::flash('success', 'Payment has been successfully processed.');
          
        return back();
    }
        


}