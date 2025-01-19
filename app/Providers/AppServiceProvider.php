<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Listeners\LogModelCreated;
use App\Events\ModelCreated;
use App\Listeners\LogModelUpdated;
use App\Events\ModelUpdated;
use App\Listeners\LogModelDeleted;
use App\Events\ModelDeleted;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $listen = [
            ModelCreated::class => [
                LogModelCreated::class,
            ],
            ModelDeleted::class => [
                LogModelDeleted::class,
            ],
        ];
    }
}
