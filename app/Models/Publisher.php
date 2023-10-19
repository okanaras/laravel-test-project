<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Publisher extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class, "publisher_id", "id");
    }

    // public function books(): HasMany
    // {
    //     return $this->hasMany(Book::class, "id", "book_id");
    // }

    // public function authors()
    // {
    //     return $this->belongsToMany(Author::class);
    // }
}