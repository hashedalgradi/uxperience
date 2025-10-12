<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class ThreeSceneController extends Controller
{
    public function index()
    {
        $settings = [
            'scene_enabled' => Setting::get('scene_enabled', true),
            'scene_geometry' => Setting::get('scene_geometry', 'icosahedron'),
            'scene_primary_color' => Setting::get('scene_primary_color', '#6366f1'),
            'scene_secondary_color' => Setting::get('scene_secondary_color', '#ec4899'),
            'scene_animation_speed' => Setting::get('scene_animation_speed', 1),
        ];
        
        return view('admin.scene.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'scene_enabled' => 'boolean',
            'scene_geometry' => 'in:icosahedron,cube,sphere,torus',
            'scene_primary_color' => 'string|max:7',
            'scene_secondary_color' => 'string|max:7',
            'scene_animation_speed' => 'numeric|min:0.1|max:5',
        ]);

        $settings = [
            'scene_enabled' => $request->has('scene_enabled'),
            'scene_geometry' => $request->scene_geometry,
            'scene_primary_color' => $request->scene_primary_color,
            'scene_secondary_color' => $request->scene_secondary_color,
            'scene_animation_speed' => $request->scene_animation_speed,
        ];

        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->route('admin.scene.index')->with('success', 'تم تحديث إعدادات المشهد ثلاثي الأبعاد بنجاح');
    }

    public function getSettings()
    {
        return response()->json([
            'enabled' => Setting::get('scene_enabled', true),
            'geometry' => Setting::get('scene_geometry', 'icosahedron'),
            'primaryColor' => Setting::get('scene_primary_color', '#6366f1'),
            'secondaryColor' => Setting::get('scene_secondary_color', '#ec4899'),
            'animationSpeed' => Setting::get('scene_animation_speed', 1),
        ]);
    }
}