<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
    use HasFactory;
    protected $table = 'blogs_tags';
    protected $primaryKey = 'id_blog_tag';

    protected $fillable = [
        'id_tag',
        'id_blog',
    ];
}
