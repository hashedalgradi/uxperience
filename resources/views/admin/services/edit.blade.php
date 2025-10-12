@extends('layouts.admin')

@section('title', 'تعديل الخدمة')
@section('page-title', 'تعديل الخدمة')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="card p-6">
        <form action="{{ route('admin.services.update', $service) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-6">
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">عنوان الخدمة *</label>
                <input type="text" id="title" name="title" value="{{ old('title', $service->title) }}" 
                       class="form-control w-full" required>
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">وصف الخدمة *</label>
                <textarea id="description" name="description" rows="4" class="form-control w-full" required>{{ old('description', $service->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="icon" class="block text-sm font-semibold text-gray-700 mb-2">أيقونة الخدمة</label>
                <select id="icon" name="icon" class="form-control w-full">
                    <option value="">اختر أيقونة</option>
                    <option value="fas fa-code" {{ old('icon', $service->icon) == 'fas fa-code' ? 'selected' : '' }}>برمجة</option>
                    <option value="fas fa-paint-brush" {{ old('icon', $service->icon) == 'fas fa-paint-brush' ? 'selected' : '' }}>تصميم</option>
                    <option value="fas fa-mobile-alt" {{ old('icon', $service->icon) == 'fas fa-mobile-alt' ? 'selected' : '' }}>تطبيقات موبايل</option>
                    <option value="fas fa-lightbulb" {{ old('icon', $service->icon) == 'fas fa-lightbulb' ? 'selected' : '' }}>استشارات</option>
                    <option value="fas fa-tools" {{ old('icon', $service->icon) == 'fas fa-tools' ? 'selected' : '' }}>صيانة</option>
                    <option value="fas fa-search" {{ old('icon', $service->icon) == 'fas fa-search' ? 'selected' : '' }}>SEO</option>
                    <option value="fas fa-chart-line" {{ old('icon', $service->icon) == 'fas fa-chart-line' ? 'selected' : '' }}>تحليلات</option>
                    <option value="fas fa-shield-alt" {{ old('icon', $service->icon) == 'fas fa-shield-alt' ? 'selected' : '' }}>أمان</option>
                </select>
                @error('icon')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm mt-1">يمكنك أيضاً كتابة كلاس Font Awesome مخصص</p>
            </div>
            
            <div class="flex justify-between">
                <a href="{{ route('admin.services.index') }}" 
                   class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition">
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
@endsection