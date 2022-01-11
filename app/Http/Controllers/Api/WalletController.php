<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ConsumeCredit;
use App\Models\Wallet;

use Auth;
use Validator;

class WalletController extends Controller
{
    //
    public function index(){

        $walletCols = Wallet::where('user_id', Auth::user()->id)->get();
        $historyCols = ConsumeCredit::where('user_id', Auth::user()->id)->get();

        $totalCoins = $walletCols->sum('total_coins') ?? 0;
        $consumedCoins = $historyCols->sum('coins') ?? 0;
        $currentCoins = $totalCoins - $consumedCoins;

        foreach($walletCols as $walletCol){
            $walletCol->payment_method_id = $walletCol->paymentMethod->name ?? 'Admin Panel';
        }

        foreach($historyCols as $historyCol){
            $test = $historyCol->result->generalTest->name ?? 
                    ((isset($historyCol->result->dynamicTest->subject) ? 
                        $historyCol->result->dynamicTest->subject->name : 
                        '') . ' Dynamic Test' ?? ' Dynamic Test');
            $historyCol->description = "{$historyCol->coins} coins are used for {$test}. {$historyCol->created_at->diffForHumans()}";
        }

        return response()->json([
            'walletCols' => $walletCols,
            'historyCols' => $historyCols,
            'totalCurrentCoins' => $currentCoins,
            'response' => 'success'
        ], 200);
    }

    public function getCurrentCoins(){
        $walletCols = Wallet::where('user_id', Auth::user()->id)->get();
        $historyCols = ConsumeCredit::where('user_id', Auth::user()->id)->get();

        $totalCoins = $walletCols->sum('total_coins') ?? 0;
        $consumedCoins = $historyCols->sum('coins') ?? 0;
        $currentCoins = $totalCoins - $consumedCoins;

        return response()->json([
            'totalCurrentCoins' => $currentCoins,
            'response' => 'success'
        ], 200);
    }

    public function addCoins(Request $request){
        $validator = Validator::make($request->all(), [
            'total_amount' => 'numeric|required',
            'total_coins' => 'numeric|required',
            'payment_method_id' => 'required|numeric',
        ]);

        if($validator->fails()){
            return response()->json([
                'response' => 'failed',
                'result' => $validator->errors()
            ], 400);
        }

        $user = Auth::user();
        $wallet = new Wallet;
        $wallet->user_id = $user->id;
        $wallet->payment_method_id = $request->payment_method_id;
        $wallet->total_amount = $request->total_amount;
        $wallet->total_coins = $request->total_coins;
        $wallet->save();

        return response()->json([
            'response' => 'success'
        ], 200);
    }
}
