<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormDatas extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_kegiatan',
        'nama',
        'nip',
        'email',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'nama_instansi',
        'jabatan',
        'pangkat_golongan',
        'pendidikan_terakhir',
        'no_hp',
        'provider',
        'agama',
        'kabupaten_kota',
        'nomor_rekening',
        'nama_bank',
        'tanda_tangan_path',
    ];

    public function agendaKegiatan()
    {
        return $this->belongsToMany(AgendaKegiatan::class, 'agenda_kegiatan_form_data');
    }
}
