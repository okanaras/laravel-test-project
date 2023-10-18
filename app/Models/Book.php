<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Book extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    // public function author(): HasOne
    // {
    //     return $this->hasOne(Author::class, "author_id", "id");
    // }

    // public function publisher(): HasMany
    // {
    //     return $this->hasMany(Author::class, "author_id", "id");
    // }

}