<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Wawancara;

class DashboardController extends Controller
{
   public function index()
{
// Data Pendaftaran
    $totalPendaftar = Pendaftaran::sum('jumlah');
    $recentPendaftaran = Pendaftaran::latest()->take(5)->get();

// Data Wawancara
    $wawancaraHariIni = Wawancara::whereDate('tanggal', today())->count();
    $avgNilai = Wawancara::avg('nilai') ?? 0;
    $recentWawancara = Wawancara::with('pendaftaran')
                               ->latest()
                               ->take(5)
                               ->get();

    return view('index', compact(
        'totalPendaftar',
        'recentPendaftaran',
        'wawancaraHariIni',
        'avgNilai',
        'recentWawancara'
    ));
}
}

