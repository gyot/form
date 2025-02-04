<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class m_ref_users extends Authenticatable
{
    use Notifiable;
    protected $table='m_ref_users';
    protected $primaryKey = 'id_user'; // Jika primary key bukan 'id'

    protected $fillable = [
        'id_satker',
        'id_aktivasi',
        'username',
        'password',
        'nmuser',
        'nip',
        'ttl',
        'jabatan',
        'pangkat',
        'golongan',
        'ijazah',
        'jurusan',
        'tmpt_pendidikan',
        'tahun_pendidikan',
        'tgl_angkat',
        'tgl_jabatan',
        'tgl_pensiun',
        
    ];

    protected $hidden = [
        'password',
    ];
}
