<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = [];

    protected $appends = ["updated_diff"];

    public function sluggable(): array
    {
        return [
            "slug" => [
                "source" => "title",
            ],
        ];
    }

    public function getRouteKeyName(): string
    {
        return "slug";
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getUpdatedDiffAttribute(): string
    {
        return $this->updated_at->format("d M Y");
    }
}