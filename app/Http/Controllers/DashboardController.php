<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Wawancara;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Rekap Pendaftaran per Jurusan
        $pendaftaranData = Pendaftaran::select('jurusan')
            ->selectRaw('SUM(jumlah) as total')
            ->selectRaw('SUM(hari_ini) as hari_ini')
            ->selectRaw('SUM(kemarin) as kemarin')
            ->groupBy('jurusan')
            ->get();

        // Rekap Wawancara per Jurusan
        $wawancaraData = Wawancara::select('jurusan')
            ->selectRaw('SUM(jumlah) as total')
            ->selectRaw('SUM(hari_ini) as hari_ini')
            ->selectRaw('SUM(kemarin) as kemarin')
            ->groupBy('jurusan')
            ->get();

        // Statistik total pembayaran per status
        $statusPembayaranStats = Pembayaran::select('status_pembayaran', DB::raw('SUM(jumlah) as total'))
            ->groupBy('status_pembayaran')
            ->get();

        // Total & ringkasan Pendaftaran
        $totalPendaftar = Pendaftaran::sum('jumlah');
        $pendaftaranHariIni = Pendaftaran::sum('hari_ini');
        $pendaftaranKemarin = Pendaftaran::sum('kemarin');
        $recentPendaftaran = Pendaftaran::latest()->take(5)->get();

        // Total & ringkasan Wawancara
        $totalWawancara = Wawancara::sum('jumlah');
        $wawancaraHariIni = Wawancara::sum('hari_ini');
        $wawancaraKemarin = Wawancara::sum('kemarin');
        $recentWawancara = Wawancara::latest()->take(5)->get();

        // Total & ringkasan Pembayaran
        $totalPembayaran = Pembayaran::sum('jumlah');
        $recentPembayaran = Pembayaran::latest()->take(5)->get();

        return view('SPMB.index', compact(
            'pendaftaranData','wawancaraData','statusPembayaranStats',
            'totalPendaftar','pendaftaranHariIni','pendaftaranKemarin',
            'recentPendaftaran','totalWawancara','wawancaraHariIni',
            'wawancaraKemarin','recentWawancara','totalPembayaran',
            'recentPembayaran'
        ));
    }
}
