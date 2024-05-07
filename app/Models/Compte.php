<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens; 

class Compte extends Model
{
    use HasFactory, HasApiTokens;
    protected $table ='comptes';
    protected $primaryKey = 'id_compte';
    protected $fillable = [
    'login' ,
    'motpass',
    'type_Compte',
    'nom',
    'email',
    'num_tel',
    'photo',
    'ville',
    'pays',
    ];

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'comptes_languages', 'id_compte', 'id_language');
    }
}
