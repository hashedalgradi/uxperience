<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\User;
use App\Models\SocialLink;
use App\Models\Setting;

class GlobalDataComposer
{
    public function compose(View $view)
    {
        $globalUser = User::first();
        $globalSocialLinks = SocialLink::all();
        $globalSettings = Setting::pluck('value', 'key');
        
        $view->with([
            'globalUser' => $globalUser,
            'globalSocialLinks' => $globalSocialLinks,
            'globalSettings' => $globalSettings
        ]);
    }
}