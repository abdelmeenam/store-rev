<?php

namespace App\Providers;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Cart\CartModelRepository;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     * we user register fn to store inside service container
     * @return void
     */
    public function register()
    {
        //App facade class APP:: itself is a service container , or $this->app and bind method
        $this->app->bind(CartRepository::class, function() {
            return new CartModelRepository();
        });


        // $this->app->bind('cart' , function(){
        //     return new CartModelRepository();
        // });
        // to get the cart from service container : App::make('Cart')



    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
