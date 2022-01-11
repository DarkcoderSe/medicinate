<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Laravel\Cashier\Billable;
use Auth;
class ProductController extends Controller
{
    public function show(Product $product)
    {
     
        $intent = auth()->user()->createSetupIntent();

        return view('show', compact('product', 'intent'));
    }


    public function purchase(Request $request, Product $product)
    {
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
    }


    //  public function cashier()
    // {
    //     return view('purchase');
    // }

    // public function pay(Request $request)
    // {
    //     $obj = new Product;
    //     $obj->card_num= $request->card_num;
    //     $obj->name= $request->name;
    //     $obj->exp= $request->exp;
    //     $obj->cvc= $request->cvc;
    //     $obj->save();

    //     return redirect('/purchase');
    // }

}
