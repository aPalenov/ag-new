<?php

namespace App\Providers;

use App\Services\Breadcrumb\BreadcrumbManager;
use App\Services\PageBuilder\PageBuilder;
use App\Services\Seo\MetaManager;
use App\Services\Tenant\TenantManager;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(PageBuilder::class);
        $this->app->singleton(BreadcrumbManager::class);
        $this->app->singleton(MetaManager::class);
        $this->app->singleton(TenantManager::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
