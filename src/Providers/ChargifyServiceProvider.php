<?php

namespace JSCustom\Chargify\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class ChargifyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerConfig();
            $this->registerMigrations();
        }
        $this->registerRoutes();
    }
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('chargify.php'),
        ], 'config');
    }
    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        });
    }
    protected function routeConfiguration()
    {
        return [
            'prefix' => config('chargify.prefix'),
            'middleware' => config('chargify.middleware'),
        ];
    }
    protected function registerMigrations()
    {
        $this->publishes([
            __DIR__ . '/../database/migrations/create_chargify_customers_table.php' => database_path('migrations/chargify/' . date('Y_m_d_His', time()) . '_create_chargify_customers_table.php'),
            __DIR__ . '/../database/migrations/create_chargify_product_families_table.php' => database_path('migrations/chargify/' . date('Y_m_d_His', time()) . '_create_chargify_product_families_table.php'),
            __DIR__ . '/../database/migrations/create_chargify_products_table.php' => database_path('migrations/chargify/' . date('Y_m_d_His', time()) . '_create_chargify_products_table.php'),
            __DIR__ . '/../database/migrations/create_chargify_subscriptions_table.php' => database_path('migrations/chargify/' . date('Y_m_d_His', time()) . '_create_chargify_subscriptions_table.php')
        ], 'migrations');
    }
}
?>