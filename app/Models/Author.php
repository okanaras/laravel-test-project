<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Author extends Model
{
    use HasFactory;
    protected $guarded = [];

    // yazarlar ile kitaplar arasinda hasmany iliskisi yani bir yazar birden fazla kitap yazabilir
    public function books(): HasMany
    {
        return $this->hasMany(Book::class, "author_id", "id");
    }

    public function users(): HasOne
    {
        return $this->HasOne(User::class, 'id', 'user_id');
    }

    // polimorfik iliski
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }



    // scope tanimlamasi
    public function scopeName($query, $name)
    {
        if (!is_null($name))
            return $query->where("name", "LIKE", "%" . $name . "%");
    }

}