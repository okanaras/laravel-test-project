<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Author extends Model
{
    use HasFactory;
    protected $guarded = [];

    // iliskiler
    public function books(): HasMany
    {
        return $this->hasMany(Book::class, "id", "book_id");
    }
    public function publisher(): BelongsToMany
    {
        return $this->BelongsToMany(Book::class, "id", "publish_id");
    }

}