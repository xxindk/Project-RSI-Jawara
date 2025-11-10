<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilKuis extends Model
{
    use HasFactory;
    protected $table = 'hasil_kuis';
    protected $primaryKey = 'id_hasil';
    protected $fillable = ['id_pengguna','id_modul','jumlah_benar','skor','tanggal_kerja'];

    public function detail()
    {
        return $this->hasMany(HasilDetail::class, 'id_hasil', 'id_hasil');
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna', 'id_pengguna');
    }
}
