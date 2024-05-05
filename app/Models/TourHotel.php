<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourHotel extends Model
{
    use HasFactory;
    protected $table ='tours_hotels';
    protected $primaryKey = 'id_tour_hotel';
    protected $fillable = [
        'id_hotel',
        'id_tour',
    ];
}
