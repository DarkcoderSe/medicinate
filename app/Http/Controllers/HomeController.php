<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function temp()
    {
    //     $students = User::whereDoesntHaveRole()->get();

    //     foreach ($students as $key => $student) {
    //         $student->attachRole('student');
    //     }

        return 'All done';
    }
}
