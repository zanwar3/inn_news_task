<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Utilities\ElasticsearchClient;    
use Elasticsearch\Client;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->singleton(Client::class, function ($app) {
            return ElasticsearchClient::create();
        });

    }


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
