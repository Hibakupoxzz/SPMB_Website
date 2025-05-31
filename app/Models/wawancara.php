<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wawancara extends Model
{
    use HasFactory;

    protected $fillable = ['tahun', 'jurusan', 'kondisi', 'jumlah', 'hari_ini', 'kemarin'];
}

