<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SocialLink;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $socialLinks = SocialLink::all();
        
        return view('admin.profile.edit', compact('user', 'socialLinks'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'title' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|url',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'social_links' => 'nullable|array',
            'social_links.*.platform' => 'required|string',
            'social_links.*.url' => 'required|url',
        ]);

        // تحديث بيانات المستخدم
        $userData = $request->only(['name', 'email', 'title', 'bio', 'phone', 'website', 'location']);
        
        // رفع الصورة
        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $userData['image'] = $request->file('image')->store('profile', 'public');
        }
        
        $user->update($userData);

        // تحديث الروابط الاجتماعية
        if ($request->has('social_links')) {
            SocialLink::truncate(); // حذف جميع الروابط القديمة
            
            foreach ($request->social_links as $link) {
                if (!empty($link['platform']) && !empty($link['url'])) {
                    SocialLink::create([
                        'platform' => $link['platform'],
                        'url' => $link['url'],
                        'icon' => $this->getPlatformIcon($link['platform'])
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'تم تحديث الملف الشخصي بنجاح');
    }

    private function getPlatformIcon($platform)
    {
        $icons = [
            'facebook' => 'fab fa-facebook',
            'twitter' => 'fab fa-twitter',
            'instagram' => 'fab fa-instagram',
            'linkedin' => 'fab fa-linkedin',
            'github' => 'fab fa-github',
            'youtube' => 'fab fa-youtube',
            'behance' => 'fab fa-behance',
            'dribbble' => 'fab fa-dribbble',
        ];

        return $icons[strtolower($platform)] ?? 'fas fa-link';
    }
}