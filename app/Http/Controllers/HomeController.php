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

        $allSchools = SchoolCollege::where('type', 'school')->get();
        return view('admin.home')->with('allSchools', $allSchools);
    }
}
