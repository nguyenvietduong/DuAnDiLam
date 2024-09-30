<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register repositories.
     *
     * @return void
     */
    public function register()
    {
        $repositories = [
            \App\Interfaces\Repositories\AccountRepositoryInterface::class => \App\Repositories\AccountRepositoryEloquent::class,
            \App\Interfaces\Repositories\RoleRepositoryInterface::class => \App\Repositories\RoleRepositoryEloquent::class,
        ];

        foreach ($repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap repositories.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
