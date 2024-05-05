<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    use HasFactory;
    protected $table ='guides';
    protected $primaryKey = 'id_guide';
    protected $fillable = ['description','evaluation','cin', 'specialite', 'id_compte'];

    public function compte()
    {
        return $this->belongsTo(Compte::class, 'id_compte');
    }
}
