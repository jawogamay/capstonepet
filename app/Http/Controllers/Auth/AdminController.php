<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    //
    use AuthenticatesUsers;

    protected $guard = 'admin';

    protected $redirectTo = '/admin';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        return view('auth.adminlogin');
    }
    public function login(Request $request)
    {
        if (auth()->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            dd(auth()->guard('admin')->user());
        }
        return back()->withErrors(['email' => 'Email or password are wrong.']);
    }

}
