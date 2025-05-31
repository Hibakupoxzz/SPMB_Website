<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class pendaftarancontroller extends Controller
{
    public function SPMB()
    {
        $data_siswa = pendaftaran::all();
        return view('SPMB.pendaftaran', compact('data_siswa'));
    }

    public function pendaftaran()
    {
        $data_siswa = pendaftaran::all();
        return view('SPMB.pendaftaran', compact('data_siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required',
            'jurusan' => 'required',
            'jumlah' => 'required|integer',
            'hari_ini' => 'required|integer',
            'kemarin' => 'required|integer',
        ]);

        pendaftaran::create($request->all());
        return redirect()->route('SPMB.pendaftaran')->with('success', 'Data berhasil ditambahkan');
    }

    public function destroy($id)
    {
        pendaftaran::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
