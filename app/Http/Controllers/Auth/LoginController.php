<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function redirectTo()
    {
        return Auth::check() && Auth::user()->isCat() ? '/cat-home' : '/user-home';
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
