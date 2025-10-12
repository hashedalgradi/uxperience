<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SocialLink;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $socialLinks = SocialLink::all() ?? collect();
        
        return view('admin.profile.index', compact('user', 'socialLinks'));
    }

    public function edit()
    {
        $user = Auth::user();
        $socialLinks = SocialLink::all() ?? collect();
        
        return view('admin.profile.edit', compact('user', 'socialLinks'));
    }

    public function update(Request $request)
    {
        try {
            $user = Auth::user();
            
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'title' => 'nullable|string|max:255',
                'bio' => 'nullable|string',
                'phone' => 'nullable|string|max:20',
                'website' => 'nullable|string|max:255',
                'location' => 'nullable|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'social_links' => 'nullable|array',
                'social_links.*.platform' => 'nullable|string',
                'social_links.*.url' => 'nullable|string',
            ]);
            
            // تحقق من صحة الموقع إذا تم إدخاله
            if (!empty($validatedData['website']) && !filter_var($validatedData['website'], FILTER_VALIDATE_URL)) {
                if (!str_starts_with($validatedData['website'], 'http://') && !str_starts_with($validatedData['website'], 'https://')) {
                    $validatedData['website'] = 'https://' . $validatedData['website'];
                }
            }

            $userData = array_intersect_key($validatedData, array_flip(['name', 'email', 'title', 'bio', 'phone', 'website', 'location']));
            
            if ($request->hasFile('image')) {
                if ($user->image) {
                    Storage::disk('public')->delete($user->image);
                }
                $userData['image'] = $request->file('image')->store('profile', 'public');
            }
            
            $user->update($userData);

            if (isset($validatedData['social_links'])) {
                SocialLink::truncate();
                
                foreach ($validatedData['social_links'] as $link) {
                    if (!empty($link['platform']) && !empty($link['url'])) {
                        $url = $link['url'];
                        // تحقق من صحة الرابط وإضافة https إذا لزم الأمر
                        if (!str_starts_with($url, 'http://') && !str_starts_with($url, 'https://') && !str_starts_with($url, 'mailto:')) {
                            $url = 'https://' . $url;
                        }
                        
                        SocialLink::create([
                            'platform' => $link['platform'],
                            'url' => $url,
                            'icon' => $this->getPlatformIcon($link['platform'])
                        ]);
                    }
                }
            }

            return redirect()->route('admin.profile.index')->with('success', 'تم تحديث الملف الشخصي بنجاح');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء تحديث الملف الشخصي. يرجى المحاولة مرة أخرى.')
                        ->withInput();
        }
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