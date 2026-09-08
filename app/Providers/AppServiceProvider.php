<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('*', function ($view): void {
            $seller = config('landing.seller', []);

            $view->with([
                'seller' => $seller,
                'hasSellerDetails' => collect($seller)->contains(fn ($value) => filled($value)),
                'hasContactDetails' => filled($seller['email'] ?? null) || filled($seller['phone'] ?? null),
                'hasSellerIdentity' => filled($seller['name'] ?? null)
                    || filled($seller['status'] ?? null)
                    || filled($seller['inn'] ?? null)
                    || filled($seller['ogrn'] ?? null)
                    || filled($seller['address'] ?? null),
            ]);
        });
    }
}
