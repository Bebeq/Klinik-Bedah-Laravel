<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PasienController extends Controller
{
    public function index() {
        return view('Admin/pasien',[
            'users' => User::latest()->get()
        ]);
    }

    public function store(Request $request) {
        $credentials = $request->validate([
            'no_hp' => ['required','numeric','digits_between:8,15','unique:users,no_hp'],
            'name' => ['required'],
            'nik' => ['required','digits:16','numeric','unique:users,nik'],
            'alamat' => ['required'],
            'password' => ['required']
        ]);
        User::create($credentials);
        return redirect()->route('admin.pasien.index')->with('success', 'Data Pasien berhasil ditambahkan.');
    }
}
