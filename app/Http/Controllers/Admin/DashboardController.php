<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Antrian;
use App\Models\RiwayatPembayaran;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index() {
        
        return view('Admin.dashboard', [
            'users' => User::count(),
            'antrians' => Antrian::count(),
            'antrians_selesai' => Antrian::where('status', 5)->count(),
            'pendapatan' => RiwayatPembayaran::sum('biaya_jumlah'),
            'antrians_hadir' => Antrian::latest()->where('status', 5)->select(DB::raw('DATE(tanggal_antrian) as date'), DB::raw('count(*) as total'))->groupBy('date')->orderBy('date', 'desc')->take(7)->get(),
            'antrians_tidakhadir' => Antrian::latest()->whereIn('status', [3])->select(DB::raw('DATE(tanggal_antrian) as date'), DB::raw('count(*) as total'))->groupBy('date')->orderBy('date', 'desc')->take(7)->get(),
            'antrians_log' => Antrian::latest()->whereIn('status', [3,5])->select(DB::raw('DATE(tanggal_antrian) as date'), DB::raw('count(*) as total'))->groupBy('date')->orderBy('date', 'desc')->take(7)->get(),
        ]);
    }
}
