<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Wawancara;

class DashboardController extends Controller
{
    public function index()
{
    $jumlahPendaftaran = Pendaftaran::count();
    $jumlahWawancara = Wawancara::count();

    $hariIni = now()->toDateString();
    $kemarin = now()->subDay()->toDateString();

    $pendaftaranHariIni = Pendaftaran::whereDate('created_at', $hariIni)->count();
    $pendaftaranKemarin = Pendaftaran::whereDate('created_at', $kemarin)->count();

    $pendaftaran2025 = Pendaftaran::whereYear('created_at', 2025)->count();
    $pendaftaran2025HariIni = Pendaftaran::whereYear('created_at', 2025)->whereDate('created_at', $hariIni)->count();

    $pendaftaran2024 = Pendaftaran::whereYear('created_at', 2024)->count();
    $pendaftaran2024HariIni = Pendaftaran::whereYear('created_at', 2024)->whereDate('created_at', $hariIni)->count();

    // Tambahan untuk per jurusan
    $perJurusan = Pendaftaran::selectRaw('jurusan, COUNT(*) as total')
                    ->groupBy('jurusan')
                    ->get();

    return view('SPMB.index', compact(
        'jumlahPendaftaran',
        'jumlahWawancara',
        'pendaftaranHariIni',
        'pendaftaranKemarin',
        'pendaftaran2025',
        'pendaftaran2025HariIni',
        'pendaftaran2024',
        'pendaftaran2024HariIni',
        'perJurusan' // Tambahkan ini
    ));
}

}
