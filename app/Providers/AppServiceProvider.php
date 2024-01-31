<?php

namespace App\Providers;

use App\Services\CurrencyConverter;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('currency.converter', function () {
            return new CurrencyConverter(config('services.currency_converter.api_key'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // to get api resource reponse without wrapping [for all api resources]
        JsonResource::withoutWrapping();


        // use the bootstrap style
        Paginator::useBootstrapFour();
    }
}
