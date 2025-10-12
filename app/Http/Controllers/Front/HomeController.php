<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Service;
use App\Models\SocialLink;
use App\Models\User;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::first();
        $featuredProjects = Project::where('featured', true)->take(6)->get();
        $services = Service::take(6)->get();
        $socialLinks = SocialLink::all();
        
        return view('front.home', compact('user', 'featuredProjects', 'services', 'socialLinks'));
    }

    public function about()
    {
        $user = User::first();
        return view('front.about', compact('user'));
    }

    public function projects()
    {
        $projects = Project::latest()->paginate(12);
        return view('front.projects', compact('projects'));
    }

    public function projectShow($id)
    {
        $project = Project::findOrFail($id);
        return view('front.project-show', compact('project'));
    }

    public function services()
    {
        $services = Service::all();
        return view('front.services', compact('services'));
    }

    public function contact()
    {
        $socialLinks = SocialLink::all();
        return view('front.contact', compact('socialLinks'));
    }
}