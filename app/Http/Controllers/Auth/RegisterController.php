<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index() {
        return view('auth/register');
    }

    public function store(Request $request) {
        $credentials = $request->validate([
            'no_hp' => ['required','numeric','digits_between:8,15','unique:users,no_hp'],
            'name' => ['required'],
            'nik' => ['required','digits:16','numeric','unique:users,nik'],
            'alamat' => ['required'],
            'password' => ['required','confirmed'],
            'password_confirmation' => ['required']
        ]);
        $credentials['password'] = Hash::make($credentials['password']);
        User::create($credentials);
        return redirect()->route('auth.login.index')->with('success', 'kamu telah berhasil mendaftar, silahkan login untuk memasuki website.');
    }
}
