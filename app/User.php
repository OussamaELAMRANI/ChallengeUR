<?php

namespace App;

use App\Services\Filters\Shop\ShopFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $fillable = [
        'name', 'email', 'password', 'address', 'lat', 'lng'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public $timestamps = false;

    /**
     * @Overried
     * Hash the password before save !
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            $user->password = bcrypt($user->password);
        });
    }

    public function scopeFilter(Builder $builder, Request $req, array $filters = [])
    {
        return (new ShopFilter($req))->add($filters)->filter($builder);
    }

    public function shops()
    {
        return $this->belongsToMany(Shop::class, Like::class)->withPivot('like');
    }
}
