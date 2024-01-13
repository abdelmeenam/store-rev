<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Store;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\Scopes\StoreScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'description', 'image', 'category_id', 'store_id',
        'price', 'compare_price', 'status',
    ];

    protected static function booted()
    {
        static::addGlobalScope('StoreScope' , new StoreScope);
        //or
        // static::addGlobalScope('StoreScope', function (Builder $builder) {
        //     $builder->where('store_id', Auth::user()->store_id);
        // });
    }

    public function scopeActive( Builder $builder){
        $builder->where('status',  'active');
    }


    // Accessors
    // $product->image_url
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            //default if there are no image
            return 'https://www.incathlab.com/images/products/default_product.png';
        }
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }

    public function getSalePercentAttribute()
    {
        // compare_price = orignail price , price : price after discount
        if (!$this->compare_price) {
            return 0;
        }
        return round( ( 100* ($this->compare_price - $this->price) / $this->compare_price)  );
    }


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id')
        ->withDefault([
            'name'=> 'empty category',
        ]);
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function tags(){
        return $this->belongsToMany(
            Tag::class,      //Related model
            'product_tag',     //Pivot table
            'product_id',  //FK of pivot table for the current
            'tag_id',    //FK of pivot table for the related
            'id',             //PK Current
            'id'              //PK Related
        );
    }


}
