<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $primaryKey = 'id_admin';
    public $timestamps = true;

    protected $fillable = ['nama', 'email', 'password'];
}
