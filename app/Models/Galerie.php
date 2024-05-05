<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Guide;

class Galerie extends Model
{
    use HasFactory;
    protected $table ='galeries';
    protected $primaryKey = 'id_galerie';
    protected $fillable = [
        'chemain_photo',
        'date_publication',
        'id_guide'
    ];

    public function guide()
    {
        return $this->belongsTo(Guide::class, 'guides','id_guide');
    }
}
