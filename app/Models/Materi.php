<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;
    protected $table = 'materis';
    protected $primaryKey = 'id_materi';
    public $timestamps = true;

    protected $fillable = [
        'id_modul',
        'konten_teks',
        'konten_gambar'
    ];

    public function modul()
    {
        return $this->belongsTo(Modul::class, 'id_modul', 'id_modul');
    }
}
