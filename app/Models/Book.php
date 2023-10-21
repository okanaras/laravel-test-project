<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Book extends Model
{
    use HasFactory;
    protected $guarded = [];

    // polimorfik iliski
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function authors(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }

    public function publishers(): BelongsTo
    {
        return $this->belongsTo(Publisher::class, 'publisher_id', 'id');
    }
    public function users(): HasOne
    {
        return $this->HasOne(User::class, 'id', 'user_id');
    }



    public function scopeName($query, $title)
    {
        if (!is_null($title))
            return $query->where("title", "LIKE", "%" . $title . "%");
    }
}