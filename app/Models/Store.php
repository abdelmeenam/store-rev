<?php

namespace App\Models;

use App\Models\Vendor;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'slug', 'logo_image', 'cover_image', 'status'];


    public function products()
    {
        return $this->hasMany(Product::class, 'store_id', 'id');
    }

    // each store has many vendors
    public function vendors()
    {
        return $this->hasMany(Vendor::class);
    }

    public function getImageUrlAttribute()
    {
        if (!$this->logo_image) {
            return 'https://www.incathlab.com/images/products/default_product.png';
        }
        if (Str::startsWith($this->logo_image, ['http://', 'https://'])) {
            return $this->logo_image;
        }
        return asset('storage/' . $this->logo_image);
    }
}