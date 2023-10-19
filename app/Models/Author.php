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

    // yazarlar ile kitaplar arasinda hasmany iliskisi yani bir yazar birden fazla kitap yazabilir
    public function books()
    {
        return $this->hasMany(Book::class, "author_id", "id");
    }


    // scope tanimlamasi
    public function scopeName($query, $name)
    {
        if (!is_null($name))
            return $query->where("name", "LIKE", "%" . $name . "%");
    }

}