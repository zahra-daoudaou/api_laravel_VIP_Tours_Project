<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table ='blogs';
    protected $primaryKey = 'id_blog';
    protected $fillable = [
        'titre',
        'contenue',
        'ville',
        'pays',
        'id_guide',
        'date_publication'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($blog) {
            $blog->date_publication = now();
        });
    }

    public function guide()
    {
        return $this->belongsTo(Guide::class, 'guides', 'id_guide');
    }

    
    public function commentaire()
    {
        return $this->belongsTo(Commentaire::class, 'commentaires','id_utilisateur','id_blog');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'blogs_tags', 'id_tag', 'id_blog');
    }
}
