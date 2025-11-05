<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flashcard extends Model
{
    use HasFactory;

    protected $table = 'flashcards';      
    protected $primaryKey = 'id_card';  
    public $incrementing = true;  
    protected $keyType = 'int';          
    protected $fillable = [
        'id_modul',
        'kata_indo',
        'kata_jawa',
    ];
}