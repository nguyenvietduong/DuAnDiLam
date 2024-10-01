<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Yajra\DataTables\Html\Builder;
use Illuminate\Support\Facades\URL;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $services = [
            'App\Interfaces\Services\ImageServiceInterface'     => 'App\Services\ImageService',
            'App\Services\BaseService',

            'App\Interfaces\Services\AccountServiceInterface'   => 'App\Services\AccountService',
            'App\Interfaces\Services\CategoryServiceInterface'  => 'App\Services\CategoryService',
            'App\Interfaces\Services\TagServiceInterface'       => 'App\Services\TagService',
            'App\Interfaces\Services\PostServiceInterface'      => 'App\Services\PostService',
        ];

        foreach ($services as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS only in non-local environments
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }

        Builder::useVite();
    }
}
