<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class pendaftarancontroller extends Controller
{
    public function SPMB()
    {
        $data_siswa = Pendaftaran::all();
        return view('SPMB.pendaftaran', compact('data_siswa'));
    }

    public function pendaftaran()
    {
        $data_siswa = Pendaftaran::all();
        return view('SPMB.pendaftaran', compact('data_siswa'));
    }

    public function store(Request $request)
    {
        // Validasi awal: tahun wajib
        $request->validate([
            'tahun' => 'required',
        ]);

        // Validasi khusus berdasarkan tahun
        if ($request->tahun === '2024') {
            $request->validate([
                'jumlah' => 'required|integer|min:1',
                'hari_ini' => 'required|integer|min:0',
            ]);

            Pendaftaran::create([
                'tahun' => $request->tahun,
                'jumlah' => $request->jumlah,
                'hari_ini' => $request->hari_ini,
                'jurusan' => null,
                'kemarin' => null,
            ]);
        } else {
            // Validasi lengkap untuk 2025 dan lainnya
            $request->validate([
                'jurusan' => 'required',
                'jumlah' => 'required|integer|min:1',
                'hari_ini' => 'required|integer|min:0',
                'kemarin' => 'required|integer|min:0',
            ]);

            Pendaftaran::create($request->all());
        }

        return redirect()->route('SPMB.pendaftaran')->with('success', 'Data berhasil ditambahkan');
    }

    public function destroy($id)
    {
        Pendaftaran::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
