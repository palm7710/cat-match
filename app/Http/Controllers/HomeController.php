<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cat;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::all();
        $cats = Cat::all();
        $catsCount = $cats->count();
        $from_user_id = Auth::id();
        $matching_users_count = $users->count();

        return view('users.home', compact('users', 'cats', 'catsCount', 'from_user_id', 'matching_users_count'));
    }

    public function catIndex()
    {
        $users = User::all();
        $cats = Cat::all();
        $catsCount = $cats->count();
        $from_user_id = Auth::id();
        $matching_users_count = $users->count();

        return view('cats.home', compact('users', 'cats', 'catsCount', 'from_user_id', 'matching_users_count'));
    }
}
