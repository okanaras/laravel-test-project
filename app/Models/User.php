<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'about',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function authors(): HasMany
    {
        return $this->hasMany(Author::class, "user_id", "id");
    }
    public function publishers(): HasMany
    {
        return $this->hasMany(Publisher::class, "user_id", "id");
    }
    public function books(): HasMany
    {
        return $this->hasMany(Book::class, "user_id", "id");
    }

    // scope

    public function scopeSearchText($query, $searchText)
    {
        if (!is_null($searchText)) {
            return $query->where(function ($q) use ($searchText) {
                $q->where("name", "LIKE", "%" . $searchText . "%")
                    ->orWhere("email", "LIKE", "%" . $searchText . "%");
            });
        }
    }
}