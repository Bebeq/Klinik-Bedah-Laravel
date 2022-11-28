<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('Auth/login');
    }

    public function store(Request $request) {
        $credentials = $request->validate([
            'no_hp' => ['required','numeric','digits_between:8,15'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
 
            return redirect()->intended('dashboard');
        }

        return redirect()->route('auth.login.index')->withErrors(['no_hp' => 'no hp atau password kamu salah.','password' => 'no hp atau password kamu salah.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login.index')->with('success', 'kamu telah berhasil logout.');;
    }
}
