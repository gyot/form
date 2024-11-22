<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BioData extends Model
{
    protected $fillable = [
        'id_user',
        'id_kegiatan'
    ];
}
