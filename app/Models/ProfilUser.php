<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilUser extends Model
{
    protected $primaryKey = 'id_profil';
    public $timestamps = true;

    protected $fillable = ['id_pengguna', 'foto_profil', 'tanggal_lahir', 'jenis_kelamin', 'alamat'];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna');
    }
}

