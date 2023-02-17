<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Interfaces\IProductService;
use App\Services\ProductService;
use App\Services\Interfaces\IColorService;
use App\Services\ColorService;
use App\Http\Resources\Interfaces\IHandler;
use App\Http\Resources\Handler as ResourcesHandler;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IProductService::class, ProductService::class);
        $this->app->bind(IColorService::class, ColorService::class);
        $this->app->bind(IHandler::class, ResourcesHandler::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
