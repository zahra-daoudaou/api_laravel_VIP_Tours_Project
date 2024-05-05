<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distination extends Model
{
    use HasFactory;
    protected $table ='distinations';
    protected $primaryKey = 'id_distination';
    protected $fillable = [
        'ville',
        'pays',
    ];

    public function tour()
    {
        return $this->belongsToMany(Tour::class, 'tours_distinations', 'id_tour', 'id_distination');
    }
}
