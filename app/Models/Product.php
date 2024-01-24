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

    protected $hidden =[
        'created_at', 'updated_at', 'deleted_at','image'
    ];

    // appends some attributes through their accessors functions
    protected $appends =[
        'image_url'
    ];


    protected static function booted()
    {
        static::addGlobalScope('StoreScope' , new StoreScope);
        //or
        // static::addGlobalScope('StoreScope', function (Builder $builder) {
        //     $builder->where('store_id', Auth::user()->store_id);
        // });


        // first method when i have to listen to single event
        static::creating(function(Product $product) {
            $product->slug = Str::slug($product->name);
        });

        static::updating(function(Product $product) {
            $product->slug = Str::slug($product->name);
        });

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

    public function scopeFilter(Builder $builder, $filters)
    {
        $options = array_merge([
            'store_id' => null,
            'category_id' => null,
            'tag_id' => null,
            'status' => 'active',
        ], $filters);

        $builder->when($options['status'], function ($query, $status) {
            return $query->where('status', $status);
        });
        $builder->when($options['store_id'], function($builder, $value) {
            $builder->where('store_id', $value);
        });
        $builder->when($options['category_id'], function($builder, $value) {
            $builder->where('category_id', $value);
        });
        $builder->when($options['tag_id'], function($builder, $value) {
            $builder->whereExists(function($query) use ($value) {
                $query->select(1)
                    ->from('product_tag')
                    ->whereRaw('product_id = products.id')
                    ->where('tag_id', $value);
            });


            // $builder->whereRaw('id IN (SELECT product_id FROM product_tag WHERE tag_id = ?)', [$value]);
            // $builder->whereRaw('EXISTS (SELECT 1 FROM product_tag WHERE tag_id = ? AND product_id = products.id)', [$value]);

            // $builder->whereHas('tags', function($builder) use ($value) {
            //     $builder->where('id', $value);
            // });
        });
    }

}
