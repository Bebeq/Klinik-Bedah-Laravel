<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KartuController extends Controller
{
    public function index() {
        return view('Admin/kartu');
    }

    public function show(Request $request) {
        $gap = $request->gap;
        $ids = explode(",",$request->id);
        return view('kartu', [
            'users' => User::where('role',1)->whereIn('id',$ids)->get(),
            'gap' => $gap,
            'status' => $ids
        ]);
    }
}
