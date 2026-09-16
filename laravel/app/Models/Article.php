<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'content',
        'author',
        'notify_subscribers',
    ];


    public function scopeSearch($query, $term)
    {
        return $query->whereRaw(
            "to_tsvector('french', title || ' ' || author || ' ' || content) @@ plainto_tsquery('french', ?)",
            [$term]
        );
    }

    public function images()
    {
        return $this->hasMany(ArticleImage::class);
    }
}
