<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $table = 'penggunas';
    protected $primaryKey = 'id_pengguna';
    public $timestamps = true;

    protected $fillable = ['nama', 'email', 'password', 'status_akun'];

    public function profil()
    {
        return $this->hasOne(ProfilUser::class, 'id_pengguna');
    }
}
