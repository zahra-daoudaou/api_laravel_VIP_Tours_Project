<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $table ='photos';
    protected $primaryKey = 'id_photo';
    protected $fillable = [
        'chemain_photo',
        'titre',
        'id_tour',
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tours', 'id_tour');
    }

}
