<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    use HasFactory;
    protected $table = 'moduls';
    protected $primaryKey = 'id_modul';
    public $timestamps = true;

    protected $fillable = [
        'judul_modul',
        'deskripsi',
        'nomor_urut',
        'tingkatan_bahasa',
        'status'
    ];

    public function materi()
    {
        return $this->hasOne(Materi::class, 'id_modul', 'id_modul');
    }
}
