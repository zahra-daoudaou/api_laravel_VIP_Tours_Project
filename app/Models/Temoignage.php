<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temoignage extends Model
{
    use HasFactory;
    protected $table ='temoignages';
    protected $primaryKey = 'id_temoignage';
    protected $fillable = ['description','etoile','id_utilisateur'];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateurs', 'id_utilisateur');
    }
}
