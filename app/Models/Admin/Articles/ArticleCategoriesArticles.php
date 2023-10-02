<?php

namespace App\Models\Admin\Articles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleCategoriesArticles extends Model
{
    use HasFactory;

    protected $table = 'article_categories_articles';

    protected $fillable = [
        'id', 'user_id','articles_id', 'article_categories_id',
    ];
}
