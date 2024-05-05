<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourDistination extends Model
{
    protected $table = 'tours_distinations';
    protected $primaryKey = 'id_tour_distination';

    protected $fillable = [
        'id_tour',
        'id_distination',
    ];
}
