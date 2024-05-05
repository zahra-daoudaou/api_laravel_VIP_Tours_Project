<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourTransport extends Model
{
    use HasFactory;
    protected $table ='tours_transports';
    protected $primaryKey = 'id_tour_transport';
    protected $fillable = [
        'id_hotel',
        'id_transport',
    ];
}
