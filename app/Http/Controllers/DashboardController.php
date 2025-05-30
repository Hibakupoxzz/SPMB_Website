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
        $pendaftarHariIni = Pendaftaran::sum('hari_ini');
        $pendaftarKemarin = Pendaftaran::sum('kemarin');
        $recentPendaftaran = Pendaftaran::latest()->take(5)->get();

        // Data Wawancara (tanpa nilai)
        $wawancaraHariIni = Wawancara::sum('hari_ini');
        $wawancaraKemarin = Wawancara::sum('kemarin');
        $totalWawancara = Wawancara::sum('jumlah');
        $recentWawancara = Wawancara::latest()->take(5)->get();

        $recentWawancara = Wawancara::latest()->take(5)->get();

        return view('SPMB.index', compact(
            'totalPendaftar','pendaftarHariIni','pendaftarKemarin',
            'recentPendaftaran','totalWawancara','wawancaraHariIni',
            'wawancaraKemarin','recentWawancara'
        ));
    }
}
