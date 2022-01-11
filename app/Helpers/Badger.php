<?php 

namespace App\Helpers;

use App\Models\Badge;
use App\Models\StudentBadge;
use App\Helpers\ResultCalculator as RC;
use Auth;

class Badger
{
    public static function assign()
    {
        $user = Auth::user();
        $totalCorrectAns = 0;
        foreach($user->results as $result) {
            $score = RC::find($result->id);
            $totalCorrectAns += $score->correct ?? 0;
        }

        $badges = Badge::where('status', 1)->get();
        foreach($badges as $badge) {
            $userOldBadge = StudentBadge::where('user_id', $user->id)->where('badge_id', $badge->id)->first();
            if($badge->min_score <= $totalCorrectAns && is_null($userOldBadge) && $user->results->count() >= $badge->required_test){
                $userBadge = new StudentBadge;
                $userBadge->user_id = $user->id;
                $userBadge->badge_id = $badge->id;
                $userBadge->save();
            }
        }
        
    }
}