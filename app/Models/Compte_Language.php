<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compte_Language extends Model
{
    protected $table = 'comptes_languages';
    protected $primaryKey = 'id_compte_language';

    protected $fillable = [
        'id_compte',
        'id_language',
    ];
}
