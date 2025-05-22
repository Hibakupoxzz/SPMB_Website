<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wawancara extends Model
{
    use HasFactory;

    protected $fillable = ['tahun', 'jurusan', 'jumlah', 'hari_ini', 'kemarin'];
}

