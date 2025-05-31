<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans'; // Nama tabel default Laravel: plural

    protected $fillable = [
        'tahun',
        'jurusan',
        'status_pembayaran',
        'jumlah',
    ];
}
