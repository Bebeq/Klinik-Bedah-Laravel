<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class UsersController extends Controller
{
    public function index() {
        return view('Admin/users',[
            'users' => User::latest()->filter(request(['search']))->paginate(20)->withQueryString()
        ]);
    }

    public function store(Request $request) {
        $credentials = $request->validate([
            'no_hp' => ['required','numeric','unique:users,no_hp'],
            'name' => ['required'],
            'nik' => ['required','digits:16','numeric','unique:users,nik'],
            'alamat' => ['required'],
            'role' => ['required','numeric','digits:1'],
            'password' => ['required']
        ]);
        $credentials['password'] = Hash::make($credentials['password']);
        User::create($credentials);
        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil ditambahkan.');
    }

    public function edit(Request $request) {
        $user = User::findOrFail($request->id);
        $credentials = $request->validate([
            'id' => ['required','numeric'],
            'no_hp' => 'required|numeric|unique:users,no_hp,' . $request->id,
            'name' => ['required'],
            'nik' => ['required','digits:16','numeric','unique:users,nik,' . $user->id],
            'alamat' => ['required'],
            'role' => ['required','numeric','digits:1'],
            'password' => []
        ]);
        $user = User::findOrFail($request->id);
        $user->no_hp = $request->no_hp;
        $user->name = $request->name;
        $user->nik = $request->nik;
        if (empty($request->password)) {
            $user->password = $user->password;
        } else {
            $user->password = Hash::make($request->password);
        }
        $user->alamat = $request->alamat;
        $user->role = $request->role;
        $user->save();
        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil diupdate.');
    }

    public function destroy(Request $request) {
        $user = User::findOrFail($request->id);
        User::destroy($user->id);
        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil dihapus.');
    }
}
