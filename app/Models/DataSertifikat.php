<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSertifikat extends Model
{
    protected $fillable = [
        'id_biodata',
        'nomor_sertifikat',
        'tanggal_ttd',
        'id_penanggungjawab',
        'id_kepala'
    ];
}
