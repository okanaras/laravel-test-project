<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Book extends Model
{
    use HasFactory;
    protected $guarded = [];
    /*
        // kitaplar ile yazarlar arasinda hasone iliskisi yani her kitabin bir yazari olabilir
        public function authors(): HasOne
        {
            return $this->HasOne(Author::class, "id", "author_id");
        }

        // kitaplar ile yayinevleri arasinda hasone iliskisi yani her kitabin bir yayinevi olabilir
        public function publishers(): HasOne
        {
            return $this->HasOne(Publisher::class, "id", "publisher_id");
        }
     */


    // scope tanimlamasi


    // polimorfik iliski
    public function comments()
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


    public function scopeName($query, $title)
    {
        if (!is_null($title))
            return $query->where("title", "LIKE", "%" . $title . "%");
    }
}