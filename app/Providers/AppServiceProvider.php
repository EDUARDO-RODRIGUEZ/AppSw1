<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
use Illuminate\Contracts\View\View;
use App\Categoria;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        Cashier::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
            view()->composer('*', function(View $view) {
            $categorias= Categoria::with('subcategorias')->get();
            $view->with('categorias', $categorias);
        });
    }
}
