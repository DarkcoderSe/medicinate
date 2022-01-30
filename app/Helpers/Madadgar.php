<?php 

namespace App\Helpers;

use Auth;

class Madadgar
{
    public static function coins()
    {
        $user = Auth::user();
        $walletCoins = $user->walletCoins;
        $consumedCoins = $user->consumedCoins;

        $totalCoins = $walletCoins->sum('total_coins') ?? 0;
        $consumedCoins = $consumedCoins->sum('coins') ?? 0;
        $currentCoins = $totalCoins - $consumedCoins;
        
        return $currentCoins;
    }
}