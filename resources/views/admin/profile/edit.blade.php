@extends('layouts.admin')

@section('title', 'تحديث الملف الشخصي')
@section('page-title', 'تحديث الملف الشخصي')

@section('content')
<!-- Success/Error Messages -->
@if(session('success'))
    <div class="alert alert-success mb-6">
        <i class="fas fa-check-circle mr-2"></i>
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
        <i class="fas fa-exclamation-circle mr-2"></i>
        {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
        <i class="fas fa-exclamation-triangle mr-2"></i>
        <strong>يرجى تصحيح الأخطاء التالية:</strong>
        <ul class="mt-2 mr-4">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="max-w-6xl mx-auto">
    <div class="card overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 p-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-white">تحديث الملف الشخصي</h1>
                    <p class="text-white/80 mt-1">قم بتحديث معلوماتك الشخصية وروابط التواصل الاجتماعي</p>
                </div>
                <a href="{{ route('admin.profile.index') }}" class="bg-white/20 text-white px-4 py-2 rounded-lg hover:bg-white/30 transition-colors">
                    <i class="fas fa-arrow-right mr-2"></i>
                    عودة
                </a>
            </div>
        </div>

        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')

            <div class="grid lg:grid-cols-2 gap-8">
                <!-- المعلومات الأساسية -->
                <div class="space-y-6">
                    <h2 class="text-xl font-bold text-gray-800 border-b-2 border-blue-200 pb-2">المعلومات الأساسية</h2>
                        
                        <!-- الصورة الشخصية -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">الصورة الشخصية</label>
                            <div class="flex items-center space-x-4 space-x-reverse">
                                @if($user->image)
                                    <img src="{{ asset('storage/' . $user->image) }}" alt="Profile" class="w-20 h-20 rounded-full object-cover">
                                @else
                                    <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-gray-400 text-2xl"></i>
                                    </div>
                                @endif
                                <input type="file" name="image" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-primary/80">
                            </div>
                        </div>

                    <!-- الاسم -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">الاسم الكامل</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required class="form-control w-full">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- البريد الإلكتروني -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">البريد الإلكتروني</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="form-control w-full">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- المسمى الوظيفي -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">المسمى الوظيفي</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $user->title) }}" placeholder="مطور ويب ومصمم واجهات" class="form-control w-full">
                    </div>

                    <!-- رقم الهاتف -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">رقم الهاتف</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control w-full">
                    </div>

                    <!-- الموقع الإلكتروني -->
                    <div>
                        <label for="website" class="block text-sm font-medium text-gray-700 mb-2">الموقع الإلكتروني</label>
                        <input type="url" id="website" name="website" value="{{ old('website', $user->website) }}" placeholder="https://example.com" class="form-control w-full">
                    </div>

                    <!-- الموقع الجغرافي -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">الموقع الجغرافي</label>
                        <input type="text" id="location" name="location" value="{{ old('location', $user->location) }}" placeholder="الرياض، السعودية" class="form-control w-full">
                    </div>
                </div>

                <!-- النبذة والروابط -->
                <div class="space-y-6">
                    <h2 class="text-xl font-bold text-gray-800 border-b-2 border-blue-200 pb-2">النبذة والروابط</h2>
                    
                    <!-- النبذة الشخصية -->
                    <div>
                        <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">النبذة الشخصية</label>
                        <textarea id="bio" name="bio" rows="6" placeholder="اكتب نبذة عن نفسك وخبراتك..." class="form-control w-full resize-none">{{ old('bio', $user->bio) }}</textarea>
                    </div>

                        <!-- الروابط الاجتماعية -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-4">روابط التواصل الاجتماعي</label>
                            <div id="social-links-container" class="space-y-4">
                                @if(isset($socialLinks) && $socialLinks->count() > 0)
                                    @foreach($socialLinks as $index => $link)
                                        <div class="social-link-item flex gap-4">
                                            <select name="social_links[{{ $index }}][platform]" class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                                                <option value="">اختر المنصة</option>
                                                <option value="facebook" {{ $link->platform == 'facebook' ? 'selected' : '' }}>Facebook</option>
                                                <option value="twitter" {{ $link->platform == 'twitter' ? 'selected' : '' }}>Twitter</option>
                                                <option value="instagram" {{ $link->platform == 'instagram' ? 'selected' : '' }}>Instagram</option>
                                                <option value="linkedin" {{ $link->platform == 'linkedin' ? 'selected' : '' }}>LinkedIn</option>
                                                <option value="github" {{ $link->platform == 'github' ? 'selected' : '' }}>GitHub</option>
                                                <option value="youtube" {{ $link->platform == 'youtube' ? 'selected' : '' }}>YouTube</option>
                                                <option value="behance" {{ $link->platform == 'behance' ? 'selected' : '' }}>Behance</option>
                                                <option value="dribbble" {{ $link->platform == 'dribbble' ? 'selected' : '' }}>Dribbble</option>
                                            </select>
                                            <input type="url" name="social_links[{{ $index }}][url]" value="{{ $link->url }}" placeholder="رابط المنصة" class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                                            <button type="button" onclick="removeSocialLink(this)" class="px-4 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                @endif
                                
                                @if(!isset($socialLinks) || $socialLinks->count() == 0)
                                    <div class="social-link-item flex gap-4">
                                        <select name="social_links[0][platform]" class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                                            <option value="">اختر المنصة</option>
                                            <option value="facebook">Facebook</option>
                                            <option value="twitter">Twitter</option>
                                            <option value="instagram">Instagram</option>
                                            <option value="linkedin">LinkedIn</option>
                                            <option value="github">GitHub</option>
                                            <option value="youtube">YouTube</option>
                                            <option value="behance">Behance</option>
                                            <option value="dribbble">Dribbble</option>
                                        </select>
                                        <input type="url" name="social_links[0][url]" placeholder="رابط المنصة" class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                                        <button type="button" onclick="removeSocialLink(this)" class="px-4 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            
                            <button type="button" onclick="addSocialLink()" class="mt-4 px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">
                                <i class="fas fa-plus mr-2"></i>
                                إضافة رابط جديد
                            </button>
                        </div>
                    </div>
                </div>

            <!-- أزرار الحفظ -->
            <div class="flex justify-end space-x-4 space-x-reverse mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.profile.index') }}" class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                    <i class="fas fa-times mr-2"></i>
                    إلغاء
                </a>
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save mr-2"></i>
                    حفظ التغييرات
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let socialLinkIndex = {{ isset($socialLinks) && $socialLinks->count() > 0 ? $socialLinks->count() : 1 }};

function addSocialLink() {
    const container = document.getElementById('social-links-container');
    const newLink = document.createElement('div');
    newLink.className = 'social-link-item flex gap-4';
    newLink.innerHTML = `
        <select name="social_links[${socialLinkIndex}][platform]" class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
            <option value="">اختر المنصة</option>
            <option value="facebook">Facebook</option>
            <option value="twitter">Twitter</option>
            <option value="instagram">Instagram</option>
            <option value="linkedin">LinkedIn</option>
            <option value="github">GitHub</option>
            <option value="youtube">YouTube</option>
            <option value="behance">Behance</option>
            <option value="dribbble">Dribbble</option>
        </select>
        <input type="url" name="social_links[${socialLinkIndex}][url]" placeholder="رابط المنصة" class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
        <button type="button" onclick="removeSocialLink(this)" class="px-4 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
            <i class="fas fa-trash"></i>
        </button>
    `;
    container.appendChild(newLink);
    socialLinkIndex++;
}

function removeSocialLink(button) {
    const container = document.getElementById('social-links-container');
    if (container.children.length > 1) {
        button.parentElement.remove();
    }
}
</script>
@endsection