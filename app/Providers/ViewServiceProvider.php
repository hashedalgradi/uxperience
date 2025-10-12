<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\GlobalDataComposer;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', GlobalDataComposer::class);
    }

    public function register()
    {
        //
    }
}