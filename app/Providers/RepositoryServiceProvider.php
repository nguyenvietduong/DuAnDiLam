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
            \App\Interfaces\Repositories\AccountRepositoryInterface::class  => \App\Repositories\AccountRepositoryEloquent::class,
            \App\Interfaces\Repositories\CategoryRepositoryInterface::class => \App\Repositories\CategoryRepositoryEloquent::class,
            \App\Interfaces\Repositories\TagRepositoryInterface::class      => \App\Repositories\TagRepositoryEloquent::class,
            \App\Interfaces\Repositories\PostRepositoryInterface::class     => \App\Repositories\PostRepositoryEloquent::class,
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
