<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table ='services';
    protected $primaryKey = 'id_service';
    protected $fillable = [
        'nom',
        'prix',
        'etat_service',
        'id_tour',
        'id_plan',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plans', 'id_plan');
    }
}
