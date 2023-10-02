<?php

namespace App\Models\Admin\Articles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleGalleries extends Model
{
    use HasFactory;

    protected $table = 'article_galleries';

    protected $fillable = [
        'id', 'articles_id', 'image_path','highlight','image_name'
    ];
}
