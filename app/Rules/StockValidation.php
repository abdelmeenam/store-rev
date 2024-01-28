<?php

namespace App\Rules;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;

class StockValidation implements Rule
{

    public $product_id;


    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($product_id)
    {
        $this->product_id = $product_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $product = Product::where( [['id' , '=' ,$this->product_id] , ['quantity' , '>=' , $value ] ])->first();

        if ($product ) {
            $cart = Cart::where( 'product_id' , '=' , $product->id)->first();
            if ($cart) {
                $count = $cart->quantity + $value;
                if ($count <= $product->quantity ){
                    return true;            //The 2nd Addition
                }
                return false;
            }

            return true;            //The first Addition
        }

        return false;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Out of stock';
    }
}
