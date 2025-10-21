<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $primaryKey = 'id_pengguna';
    public $timestamps = false;

    protected $fillable = ['nama', 'email', 'password', 'tanggal_dibuat', 'status_akun'];

    public function profil()
    {
        return $this->hasOne(ProfilUser::class, 'id_pengguna');
    }
}

