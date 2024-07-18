<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cat;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['catIndex']);
        $this->middleware('auth:cat')->only(['catIndex']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $users = User::all(); // Retrieve all users
        $cats = Cat::all();   // Retrieve all cats
        $catsCount = $cats->count();
        $matching_users_count = $users->count();
        $from_user_id = Auth::id();

        return view('users.home', compact('users', 'cats', 'catsCount', 'from_user_id', 'matching_users_count'));
    }

    /**
     * Show the cat dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function catIndex()
    {
        $users = User::all(); // Retrieve all users
        $cats = Cat::all();   // Retrieve all cats
        $catsCount = $cats->count();
        $from_user_id = Auth::id();
        $matching_users_count = $users->count(); // or any other logic to determine the count

        return view('cats.home', compact('users', 'cats', 'catsCount', 'from_user_id', 'matching_users_count'));
    }
}
