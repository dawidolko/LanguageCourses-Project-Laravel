<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Movie;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $courses = Course::inRandomOrder()
                          ->limit(6)
                          ->get();
        return view('home', compact('courses'));
    }

    public function regulamin()
    {
        return view('regulamin'); 
    }
}
