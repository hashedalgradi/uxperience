<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:100',
            'tools' => 'nullable|array',
            'github' => 'nullable|url',
            'demo' => 'nullable|url',
            'featured' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['title', 'description', 'category', 'github', 'demo']);
        $data['featured'] = $request->has('featured');
        $data['tools'] = $request->tools ? array_filter($request->tools) : [];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        if ($request->hasFile('gallery')) {
            $gallery = [];
            foreach ($request->file('gallery') as $file) {
                $gallery[] = $file->store('projects/gallery', 'public');
            }
            $data['gallery'] = $gallery;
        }

        Project::create($data);

        return redirect()->route('admin.projects.index')->with('success', 'تم إضافة المشروع بنجاح');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:100',
            'tools' => 'nullable|array',
            'github' => 'nullable|url',
            'demo' => 'nullable|url',
            'featured' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['title', 'description', 'category', 'github', 'demo']);
        $data['featured'] = $request->has('featured');
        $data['tools'] = $request->tools ? array_filter($request->tools) : [];

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        if ($request->hasFile('gallery')) {
            if ($project->gallery) {
                foreach ($project->gallery as $image) {
                    Storage::disk('public')->delete($image);
                }
            }
            $gallery = [];
            foreach ($request->file('gallery') as $file) {
                $gallery[] = $file->store('projects/gallery', 'public');
            }
            $data['gallery'] = $gallery;
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')->with('success', 'تم تحديث المشروع بنجاح');
    }

    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }
        if ($project->gallery) {
            foreach ($project->gallery as $image) {
                Storage::disk('public')->delete($image);
            }
        }
        
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'تم حذف المشروع بنجاح');
    }
}