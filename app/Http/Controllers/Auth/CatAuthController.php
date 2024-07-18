<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:cat')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.cat-login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard('cat')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $request->remember)) {
            // 認証成功
            return redirect()->intended(route('cat.home'));
        }

        // 認証失敗
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout(Request $request)
    {
        Auth::guard('cat')->logout();
        return redirect('/');
    }
}
