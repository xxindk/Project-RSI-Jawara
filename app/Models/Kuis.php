<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    use HasFactory;
    protected $table = 'kuis';
    protected $primaryKey = 'id_kuis';
    protected $fillable = [
        'id_modul','pertanyaan','pilihan_a','pilihan_b','pilihan_c','pilihan_d','jawaban_benar','nilai'
    ];

    public function modul()
    {
        return $this->belongsTo(Modul::class, 'id_modul', 'id_modul');
    }
}
