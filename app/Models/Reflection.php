<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Reflection extends Model
{
    use HasFactory;


    protected $fillable = ['modul', 'isi_refleksi'];
}
