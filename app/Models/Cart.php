<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Observers\CartObserver;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'cookie_id', 'user_id', 'product_id', 'quantity', 'options',
    ];

    // Events (Observers)
    // creating, created, updating, updated, saving, saved
    // deleting, deleted, restoring, restored, retrieved

    protected static function booted()
    {
        // first method when i have to listen to single event
        // static::creating(function(Cart $cart) {
        //     $cart->id = Str::uuid();
        // });

        //the 2nd one is to create observer file(CartObserver) for cart model
        static::observe(CartObserver::class);

        static::addGlobalScope('cookie_id', function(Builder $builder) {
            $builder->where('cookie_id', '=', Cart::getCookieId());
        });
    }


    public static function getCookieId()
    {
        $cookie_id = Cookie::get('cart_id');
        if (!$cookie_id) {
            $cookie_id = Str::uuid();
            Cookie::queue('cart_id', $cookie_id, 30 * 24 * 60);
        }
        return $cookie_id;
    }


    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Guest',
        ]);
    }

    public  function product()
    {
        return $this->belongsTo(Product::class);
    }
}
