<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Preference;
use Carbon\Carbon;
use Auth;

class LeaderboardController extends Controller
{
    public function index(){
        $now = Carbon::now();
        $dates = [];

        $from = $now->copy()->startOfYear();
        $to = $now->copy()->endOfYear();
        $yearly = $this->leaderboardIndex($from, $to);
        $dates[] = [$from, $to];
      
        $from = $now->copy()->startOfMonth();
        $to = $now->copy()->endOfMonth();
        $monthly = $this->leaderboardIndex($from, $to);
        $dates[] = [$from, $to];
    
        $from = $now->copy()->startOfWeek();
        $to = $now->copy()->endOfWeek();
        $weekly = $this->leaderboardIndex($from, $to);
        $dates[] = [$from, $to];
    
        $from = $now->copy()->startOfDay()->format('Y-m-d H:i:s.u');
        $to = $now->copy()->endOfDay()->format('Y-m-d H:i:s.u');
        $daily = $this->leaderboardIndex($from, $to);
        $dates[] = [$from, $to];

        return response()->json([
            'yearly' => $yearly,
            'monthly' => $monthly,
            'weekly' => $weekly,
            'daily' => $daily,
            'dates' => $dates,
            'response' => 'success'
        ], 200);
    }

    private function leaderboardIndex($from, $to){

        // dd([$from, $to]);
        $limit = Preference::where('name', 'leaderboard_limit')->first()->value ?? 10;

        $users = User::with([
                        'results.answeredQuestions.question'
                    ])
                    ->whereHas('results', function($q) use ($from, $to){
                        return $q->where('created_at', '>', $from)
                                ->where('created_at', '<', $to);
                    })
                    ->take($limit)
                    ->get();
        // dd($users);

        $usersArr = collect();
        foreach($users as $key => $user){

            $totalScore = 0;
            $totalTest = 0;

            $dtest = 0;
            $atest = 0;

            
            // iterating actual dynamic test.
            foreach($user->results as $userResult){
                if($userResult->test_type == 1){ // dynamic test
                    $userTest = $userResult->dynamicTest;

                    // dd($userTest);
                    if($userTest != null && $userTest->mode == 0){ // real test
                       
                        if($userResult->answeredQuestions->count() > 0){
                            $totalTest += 1;
                            $ansQs = $userResult->answeredQuestions;
        
                            foreach($ansQs as $ansQ){
                                if($ansQ->question->correct_option == $ansQ->sel_option_id)
                                    $totalScore += 1;
                            }                  
                        }

                        $dtest++;
                    }

                    
                }
                else{
                    

                    if($userResult->answeredQuestions->count() > 0){
                        $totalTest += 1;
                        $ansQs = $userResult->answeredQuestions;
    
                        foreach($ansQs as $ansQ){
                            if($ansQ->question->correct_option == $ansQ->sel_option_id)
                                $totalScore += 1;
                        }                  
                    }

                    $atest++;
                }
                   
            }

            $profilePicture = \URL::to('/storage/images/profiles', $user->profile_picture);

            $usersArr->push([
                'name' => $user->name ?? '',
                'profile' => $profilePicture,
                'test' => $totalTest,
                'score' => $totalScore ?? 0,
                'account' => Auth::user()->id == $user->id ? $user->id : '',
                'debug' => [$atest, $dtest]
            ]);
        }

        $usersArr = $usersArr->sortByDesc('score');

        return $usersArr->values()->all();
    }
}