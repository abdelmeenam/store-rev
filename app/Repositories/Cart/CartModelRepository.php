<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartModelRepository implements CartRepository
{
    protected $items;

     public function __construct()
     {
         //collect all items(array to collection(object like array))
         $this->items = collect([]);
     }

    public function get() :Collection
    {
        // return Cart::with('product')->get();
        if (!$this->items->count())  {
            $this->items = Cart::with('product')->get();
        }
        return $this->items;
    }

    public function add(Product $product, $quantity = 1)
    {
        //case you add the same product at the future
        $item =  Cart::where('product_id', '=', $product->id)
                ->first();

        if (!$item) {
            $cart = Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
            $this->get()->push($cart);
            return $cart;
        }
         return $item->increment('quantity', $quantity);

        // in this case it will create a product in a new row event it is created before
        // return Cart::create([
        //     'cookie_id' => $this->getCookieId(),
        //     'user_id' =>  Auth::id(),
        //     'product_id' =>$product->id,
        //     'quantity' => $quantity,
        // ]);
    }

    public function update($id, $quantity)
    {
        Cart::where('id', '=', $id)->update(['quantity' => $quantity]);
    }

    public function delete($id)
    {
        Cart::where('id', '=', $id)->delete();
    }

    public function empty()
    {
         Cart::query()->delete();
        //Cart::destroy();  is not supported

    }

    public function total(): float
    {
        // return (float) Cart::join('products' , 'products.id' , '=' ,'carts.product_id')
        //         ->SelectRaw('SUM(products.price * carts.quantity) as total') // TO WRITE ROW STATMENT
        //         ->value('total');   //to get only total value instead of cartobject


         return $this->get()->sum(function ($item) {
             return $item->quantity * $item->product->price;
         });
    }

}
