<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Information extends Model
{
    use HasFactory;

    protected $table = 'informations';

    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'slug',
        'summary',
        'content',
        'image',
        'status',
        'views',
        'is_featured',
        'published_at',
    ];

    protected $casts = [
        'views' => 'integer',
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function incrementViews()
    {
        $this->increment('views');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($info) {
            if (empty($info->slug)) {
                $info->slug = Str::slug($info->title) . '-' . Str::random(5);
            }
            if (empty($info->published_at) && $info->status === 'published') {
                $info->published_at = now();
            }
        });
    }
}

