<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Tour extends Model
{
    use HasFactory;
    protected $table ='tours';
    protected $primaryKey = 'id_tour';
    protected $fillable = [
        'titre',
        'description',
        'prix',
        'date_debut',
        'date_fin',
    ];

    public function setDateDebutAttribute($value)
    {
        $this->attributes['date_debut'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }

    public function setDateFinAttribute($value)
    {
        $this->attributes['date_fin'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }

    
    public function distinations()
    {
        return $this->belongsToMany(Distination::class, 'tours_distinations', 'id_tour', 'id_distination');
    }

    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'tours_hotels', 'id_tour', 'id_hotel');
    }

    public function transports()
    {
        return $this->belongsToMany(Transport::class, 'tours_transports', 'id_tour', 'id_transport');
    }
}
