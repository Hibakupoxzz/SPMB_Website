<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    public function index()
    {
        $data_pembayaran = pembayaran::all();
        return view('SPMB.pembayaran', compact('data_pembayaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|string',
            'jurusan' => 'required|string',
            'status_pembayaran' => 'required|string',
            'jumlah' => 'required|integer|min:1',
        ]);

        pembayaran::create($request->all());

        return redirect()->route('pembayaran.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        pembayaran::findOrFail($id)->delete();
        return redirect()->route('pembayaran.index')->with('success', 'Data berhasil dihapus.');
    }
}


