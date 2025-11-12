<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoryCard extends Model
{
    protected $fillable = [
        'id_modul',
        'id_card',
        'word',
        'pair_id'
    ];
}
