<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function adminIndex() {
        $users = User::orderBy('name')->paginate(100);
        return view('admin.users.index', compact('users'));
    }
}
