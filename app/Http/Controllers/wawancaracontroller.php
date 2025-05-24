<?php

namespace App\Http\Controllers;

use App\Models\wawancara;
use Illuminate\Http\Request;

class wawancaracontroller extends controller
{
    public function wawancara()  // Pertahankan nama method custom
    {
        $wawancaras = wawancara::latest()->get();
        return view('SPMB.wawancara', compact('wawancaras')); // Arahkan ke view index
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|string',
            'jurusan' => 'required|string',
            'jumlah' => 'required|integer|min:1',
            'hari_ini' => 'required|integer|min:0',
            'kemarin' => 'required|integer|min:0',
        ]);

        wawancara::create($request->all());
        return redirect()->route('wawancara.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function destroy(wawancara $wawancara)
    {
        $wawancara->delete();
        return redirect()->route('wawancara.index')->with('success', 'Data berhasil dihapus!');
    }

}

