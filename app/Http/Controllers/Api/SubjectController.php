<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Subject;

class SubjectController extends Controller
{
    public function index(){
        $subjects = Subject::with('chapters')->get();
        return response()->json([
            'subjects' => $subjects,
            'response' => 'success'
        ], 200);
    }
    
}
