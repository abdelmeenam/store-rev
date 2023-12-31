<?php

namespace App\Models;

use App\Models\Store;
use App\Models\Category;
use App\Models\Scopes\StoreScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::addGlobalScope('StoreScope' , new StoreScope);
        //or
        // static::addGlobalScope('StoreScope', function (Builder $builder) {
        //     $builder->where('store_id', Auth::user()->store_id);}
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }



}
