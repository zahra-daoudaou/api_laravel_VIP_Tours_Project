<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class language extends Model
{
    use HasFactory;
    protected $table ='languages';
    protected $primaryKey  = 'id_language';
    protected $fillable = [
    'nom_language' ,
    ];
   
    public function compte()
    {
        return $this->belongsToMany(Compte::class, 'comptes_languages', 'id_language', 'id_compte');
    }
}
