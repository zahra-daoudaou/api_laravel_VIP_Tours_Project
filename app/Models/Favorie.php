<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorie extends Model
{
    use HasFactory;
    protected $table ='favories';
    protected $primaryKey = 'id_favorie';
    protected $fillable = [
        'date_ajoute',
        'id_utilisateur',
        'id_blog'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($favorie) {
            $favorie->date_ajoute = now();
        });
    }
}
