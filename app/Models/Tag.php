<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug'
    ];

    public function products(){
        return $this->belongsToMany(
            Product::class ,      //Related model
            'product_tag' ,     //Pivot table
            'tag_id'  ,    //FK of pivot table for the related
            'product_id',  //FK of pivot table for the current
            'id' ,             //PK Current
            'id'              //PK Related
        );
    }
}
