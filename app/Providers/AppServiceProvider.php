<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting;
use App\Models\SocialLink;

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
        // Share settings with all views
        try {
            View::composer('*', function ($view) {
                $settings = Setting::pluck('value', 'key')->toArray();
                $socialLinks = SocialLink::all();
                
                $view->with([
                    'globalSettings' => $settings,
                    'globalSocialLinks' => $socialLinks
                ]);
            });
        } catch (\Exception $e) {
            // Handle case when database is not yet migrated
        }
    }
}