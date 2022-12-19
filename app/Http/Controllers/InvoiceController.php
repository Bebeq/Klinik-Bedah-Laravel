<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPembayaran;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function show(Request $request) {
        return view('invoice', [
            'pembayaran' => RiwayatPembayaran::findOrFail($request->id)
        ]);
    }
}
