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
        return $this->hasMany(Book::class, "author_id", "id");
    }

    // public function publishers(): BelongsToMany
    // {
    //     return $this->BelongsToMany(Publisher::class, "id");
    // }
}