<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Laravel\Cashier\Billable;
use Auth;
use Session;


class ProductController extends Controller
{
    public function show(Request $request)
    {
     
        $intent = auth()->user()->createSetupIntent();

        return view('show', compact('intent'));
    }


    public function purchase(Request $request)
    {
        //  return $request;
        $user          = $request->user();
        $paymentMethod = $request->input('payment_method');

        try {
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethod);
            $user->charge($product->price * 100, $paymentMethod);        
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

        return back()->with('message', 'Product purchased successfully!');
        // Session::flash('success', 'Payment has been successfully processed.');

    }


}
