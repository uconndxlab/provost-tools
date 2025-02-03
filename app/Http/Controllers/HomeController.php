<?php

namespace App\Http\Controllers;

use App\Models\SchoolCollege;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request) {
        return view('home');
    }

    public function adminHome(Request $request) {
        $allSchools = SchoolCollege::all();
        return view('admin.home')->with('allSchools', $allSchools);
    }

    public function contact(Request $request) {
        return view('contact');
    }

    public function animationShowcaseSubmission(Request $request) {
        
        return view('animation-showcase-portal.submission-form');
    }
}
