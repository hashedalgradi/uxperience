<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Service;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects' => Project::count(),
            'services' => Service::count(),
            'featured_projects' => Project::where('featured', true)->count(),
        ];
        
        return view('admin.dashboard', compact('stats'));
    }
}