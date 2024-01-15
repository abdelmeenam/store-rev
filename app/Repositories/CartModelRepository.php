<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartModelRepository implements CartRepository
{
    protected $items;

     public function __construct()
     {
         //collect all items(array to collection(object))
         //$this->items = collect([]);
     }

    public function get() :Collection
    {
        // if (!$this->items->count()) {$this->items = Cart::with('product')->get();  }
        // return $this->items;

        return Cart::all();
    }

    public function add(Product $product, $quantity = 1)
    {
        //case you add the same product at the future
        // $item =  Cart::where('product_id', '=', $product->id)->first();
        // if (!$item) {
        //     $cart = Cart::create([
        //         'user_id' => Auth::id(),
        //         'product_id' => $product->id,
        //         'quantity' => $quantity,
        //     ]);
        //     $this->get()->push($cart);
        //     return $cart;
        // }
        // return $item->increment('quantity', $quantity);

        return Cart::create([
            'cookie_id' => Str::uuid(),
            'user_id' =>  Auth::id(),
            'Product_id' =>$product->id,
            'quantity' => $quantity,
        ]);
    }

    public function update($product, $quantity)
    {
        // Cart::where('id', '=', $id)->update(['quantity' => $quantity]);
        Cart::where('Product_id', '=', $product->id)->update(['quantity' => $quantity]);
    }

    public function delete($product)
    {
        // Cart::where('id', '=', $id)->delete();
        Cart::where('Product_id', '=', $product->id)->delete();

    }

    public function empty()
    {
        // Cart::query()->delete();
        Cart::where('cookie-id' , )->destroy();

    }

    public function total(): float
    {
        //  return $this->get()->sum(function ($item) {
        //      return $item->quantity * $item->product->price;
        //  });

        return Cart::where('cookie_id' , '=', )
                ->join('products' , 'products.id' , '=' ,'carts.product_id')
                ->SelectRaw('SUM(products.price * carts.quantity) as total')
                ->value('total');
    }

    protected function getCookieId()
    {
        $cookie_id = Cookie::get('cart')
    }
}
