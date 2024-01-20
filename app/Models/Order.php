<?php

namespace App\Models;

use App\Models\User;
use App\Models\Store;
use App\Models\OrderItem;
use App\Models\OrderAddress;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id', 'user_id', 'payment_method', 'status', 'payment_status',
    ];


    protected static function booted(){
        static::creating(function(Order $order){
            //20240001 , 20240002
            $order->number = Order::getNextOrderNumber();
        });
    }

    public static function getNextOrderNumber()
    {
        // SELECT MAX(number) FROM orders
        $year =  Carbon::now()->year;
        $number = Order::whereYear('created_at', $year)->max('number');
        if ($number) {
            return $number + 1;
        }
        return $year . '0001';
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Guest Customer'
        ]);
    }

    // public function items()
    // {
    //     return $this->hasMany(OrderItem::class, 'order_id');
    // }

    public function products()
    {
        return $this->belongsToMany(
                Product::class,        //Related model
                'order_items',        //Pivot table
                'order_id',          //FK of pivot table for the current
                'product_id',       //FK of pivot table for the related
                'id',
                'id')
            ->using(OrderItem::class)           // ??
            ->as('order_item')
            ->withPivot([       // if the pivot table has extra data and you wanna get it
                'product_name', 'price', 'quantity', 'options',
            ]);
    }

    public function addresses()
    {
        return $this->hasMany(OrderAddress::class);
    }

    // virtual one-to-one relationship
    public function billingAddress()
    {
        return $this->hasOne(OrderAddress::class, 'order_id', 'id')
            ->where('type', '=', 'billing');                            // return whole model
        //return $this->addresses()->where('type', '=', 'billing');     // return collection
    }

    public function shippingAddress()
    {
        return $this->hasOne(OrderAddress::class, 'order_id', 'id')
            ->where('type', '=', 'shipping');
    }

}
