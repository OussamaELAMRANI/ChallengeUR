<?php

namespace App;

use App\Services\Filters\Arrivals\ArrivalFilter;
use App\Services\Filters\Shop\ShopFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Shop extends Model
{
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];

    public function scopeFilter(Builder $builder, Request $req, array $filters = [])
    {
        return (new ShopFilter($req))->add($filters)->filter($builder);
    }


    public function users()
    {
        return $this->belongsToMany(User::class, Like::class)
            ->withPivot('like')->withTimestamps();
    }
}
