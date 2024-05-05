<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    use HasFactory;
    protected $table ='transports';
    protected $primaryKey = 'id_transport';
    protected $fillable = [
        'nom',
        'type_transport',
        'email',
        'num_tel',
        'logo',
    ];
}
