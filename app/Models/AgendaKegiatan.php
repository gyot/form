<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaKegiatan extends Model
{
    protected $fillable = [
        'nama_kegiatan', 
        'tpk', 
        'tanggal_mulai', 
        'tanggal_selesai', 
        'pola_kegiatan', 
        'flyer', 
        'materi', 
        'dokumentasi', 
        'panduan', 
        'jenis_kegiatan', 
        'kode_kegiatan', 
        'h_peserta', 
        'h_panitia', 
        'h_narasumber', 
        'status', 
        'id_user',

    ];

    public function formData()
    {
        return $this->belongsToMany(FormData::class, 'agenda_kegiatan_form_data');
    }
}
