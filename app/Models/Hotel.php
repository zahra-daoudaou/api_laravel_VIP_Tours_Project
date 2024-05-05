<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $table ='hotels';
    protected $primaryKey = 'id_hotel';
    protected $fillable = [
        'nom',
        'email',
        'num_tel',
        'ville',
        'pays',
        'adress',
        'nbr_etoile',
        'logo',
    ];

    public function tour()
    {
        return $this->belongsToMany(Tour::class, 'tours_hotels', 'id_tour', 'id_hotel');
    }
}