<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\User\UserReader;
use App\Repositories\User\UserRepository;
use App\Repositories\User\MixedUserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(UserReader::class)
            ->needs(UserRepository::class)
            ->give(MixedUserRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }
}
