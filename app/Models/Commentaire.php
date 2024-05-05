<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    protected $table = 'commentaires';
    protected $primaryKey = 'id_commentaire';

    protected $fillable = [
        'contenue',
        'etat',
        'id_utilisateur',
        'id_blog',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($commentaire) {
            $commentaire->date_commentaire = now();
        });
    }
}
