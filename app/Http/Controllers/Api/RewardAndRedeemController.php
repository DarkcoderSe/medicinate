<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reward;
use App\Models\Redeem;
use App\Models\Wallet;
use App\Models\ConsumeCredit;
use Auth;
use Carbon\Carbon;

class RewardAndRedeemController extends Controller
{
    public function index(){
        /**
         * Getting all active rewards
         */
        $rewards = Reward::where('status', 1)->get();

        /**
         * If user is new then first reward is redeemable.
         */
        if(Auth::user()->redeems->count() <= 0)
            $rewards[0]->redeemable = true;
        

        
        foreach($rewards as $k => $reward){
            /**
             * Getting all redeems of current user's rewards by iterating
             * and getting the recently redeemed reward.
             */
            $redeems = Redeem::where('user_id', Auth::user()->id)
                            ->where('reward_id', $reward->id)
                            ->orderBy('created_at', 'desc')
                            ->get();

            $lastRedeem = $redeems->first();



            if($lastRedeem != null){
                $redeemDate = Carbon::parse($lastRedeem->created_at);
                $now = Carbon::now();
                $reward->redeem_days = $redeemDate->diffInDays($now);
            }
            $reward->redeems = $redeems;

            if($reward->redeem_days == 1){
                // $reward->redeemable = true;
                if(!isset($rewards[$k+1]->redeem_days) || $rewards[$k+1]->redeem_days == 0){
                    if($rewards->count() == $k+1)
                        $rewards[0]->redeemable = true;
                    else
                        $rewards[$k+1]->redeemable = true;
                }
            }
            else{
                if($rewards->count() == $k+1)
                    $rewards[0]->redeemable = false;
                else 
                    $rewards[$k+1]->redeemable = false;
            }
        }

        return response()->json([
            'rewards' => $rewards,
            'response' => 'success'
        ], 200);

    }

    public function rewards(){
        $user = Auth::user();
        $rewards = Reward::where('status', 1)->get();
        foreach($rewards as $reward){
            $userRedeems = $user->redeems->where('reward_id', $reward->id);
            if($userRedeems->count() == 0)
                $reward->redeemable = true;
            else 
                $reward->redeemable = false;

        }

        return response()->json([
            'rewards' => $rewards,
            'response' => 'success'
        ], 200);
    }

    public function redeem($rewardId){
        $user = Auth::user();
        $reward = Reward::find($rewardId);

        $redeems = $user->redeems;
        if($redeems->count() > 0 && $reward->is_ads_available == 0){
            $recentRedeem = $redeems->last();

            $redeemDate = Carbon::parse($recentRedeem->created_at);
            $redeemDateEndOfDay = $redeemDate
                                    ->copy()
                                    ->endOfDay()
                                    ->format('Y-m-d');

            $now = Carbon::now();
            $nowEndOfDay = $now->copy()
                                ->endOfDay()
                                ->format('Y-m-d');

            

            // $days = $redeemDate->diffInDays($now);
            if($redeemDateEndOfDay == $nowEndOfDay)
                return response()->json([
                    'response' => 'failed',
                    'result' => 'You have already redeemed reward today'
                ], 401);
            elseif($nowEndOfDay > $redeemDateEndOfDay && $recentRedeem->reward_id == $rewardId)
                return response()->json([
                    'response' => 'failed',
                    'result' => 'You have already redeemed that reward yesterday. Please redeem next day reward'
                ], 401);
        }

        $redeem = new Redeem;
        $redeem->user_id = $user->id;
        $redeem->reward_id = $rewardId;
        $redeem->save();

        $wallet = new Wallet;
        $wallet->user_id = $user->id;
        $wallet->total_coins = $reward->coins;
        $wallet->save();

        $walletCols = Wallet::where('user_id', Auth::user()->id)->get();
        $historyCols = ConsumeCredit::where('user_id', Auth::user()->id)->get();

        $totalCoins = $walletCols->sum('total_coins') ?? 0;
        $consumedCoins = $historyCols->sum('coins') ?? 0;
        $currentCoins = $totalCoins - $consumedCoins;

        return response()->json([
            'response' => 'success',
            'result' => "You have redeemed {$reward->coins} coins successfully",
            'currentCoins' => $currentCoins
        ], 200);
    }
}