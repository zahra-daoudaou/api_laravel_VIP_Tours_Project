<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    use HasFactory;    
    protected $table ='utilisateurs';
    protected $primaryKey = 'id_utilisateur';
    protected $fillable = ['cin', 'address', 'id_compte'];

    public function compte()
    {
        return $this->belongsTo(Compte::class, 'id_compte');
    }

    public function commentaire()
    {
        return $this->belongsTo(Commentaire::class, 'commentaires','id_utilisateur','id_blog');
    }
}
