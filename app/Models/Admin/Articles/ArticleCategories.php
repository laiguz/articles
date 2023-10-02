<?php

namespace App\Models\Admin\Articles;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class ArticleCategories extends Model
{
    use HasFactory;

    protected $table = 'article_categories';

    protected $fillable = [
        'id', 'slug', 'title', 'updated_by', 'created_by',
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
    public function getCreatedAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)
            ->format('d/m/Y H:i:s');
    }

    public function getUpdatedAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->updated_at)
            ->format('d/m/Y H:i:s');
    }

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Articles::class);
    }

}
