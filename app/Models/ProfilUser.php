<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilUser extends Model
{
    protected $primaryKey = 'id_profil';
    public $timestamps = false;

    protected $fillable = ['id_pengguna', 'foto_profil', 'tanggal_lahir', 'jenis_kelamin', 'alamat', 'tanggal_diupdate'];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna');
    }
}

