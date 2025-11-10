<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilDetail extends Model
{
    use HasFactory;
    protected $table = 'hasil_detail';
    protected $fillable = ['id_hasil','id_kuis','jawaban_terpilih','benar'];

    public function kuis()
    {
        return $this->belongsTo(Kuis::class, 'id_kuis', 'id_kuis');
    }
}
