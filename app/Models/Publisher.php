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


    // yayinevi ile kitaplar arasinda hasmany iliskisi yani bir yayinevi birden fazla kitap yayinlayabilir
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    // polimorfik iliski
    public function comments()
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