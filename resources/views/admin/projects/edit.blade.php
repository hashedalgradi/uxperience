@extends('layouts.admin')

@section('title', 'تعديل المشروع')
@section('page-title', 'تعديل المشروع')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="card p-6">
        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">عنوان المشروع *</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $project->title) }}" 
                           class="form-control w-full" required>
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">فئة المشروع *</label>
                    <select id="category" name="category" class="form-control w-full" required>
                        <option value="">اختر الفئة</option>
                        <option value="تطوير ويب" {{ old('category', $project->category) == 'تطوير ويب' ? 'selected' : '' }}>تطوير ويب</option>
                        <option value="تصميم واجهات" {{ old('category', $project->category) == 'تصميم واجهات' ? 'selected' : '' }}>تصميم واجهات</option>
                        <option value="تطبيقات موبايل" {{ old('category', $project->category) == 'تطبيقات موبايل' ? 'selected' : '' }}>تطبيقات موبايل</option>
                        <option value="أنظمة إدارة" {{ old('category', $project->category) == 'أنظمة إدارة' ? 'selected' : '' }}>أنظمة إدارة</option>
                    </select>
                    @error('category')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="mb-6">
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">وصف المشروع *</label>
                <textarea id="description" name="description" rows="4" class="form-control w-full" required>{{ old('description', $project->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="github" class="block text-sm font-semibold text-gray-700 mb-2">رابط GitHub</label>
                    <input type="url" id="github" name="github" value="{{ old('github', $project->github) }}" 
                           class="form-control w-full" placeholder="https://github.com/username/repo">
                    @error('github')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="demo" class="block text-sm font-semibold text-gray-700 mb-2">رابط العرض المباشر</label>
                    <input type="url" id="demo" name="demo" value="{{ old('demo', $project->demo) }}" 
                           class="form-control w-full" placeholder="https://example.com">
                    @error('demo')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">التقنيات المستخدمة</label>
                <div id="toolsContainer">
                    @if($project->tools)
                        @foreach($project->tools as $tool)
                            <div class="tool-input flex items-center gap-2 mb-2">
                                <input type="text" name="tools[]" value="{{ $tool }}" class="form-control flex-1" placeholder="اسم التقنية">
                                <button type="button" onclick="removeTool(this)" 
                                        class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        @endforeach
                    @else
                        <div class="tool-input flex items-center gap-2 mb-2">
                            <input type="text" name="tools[]" class="form-control flex-1" placeholder="اسم التقنية">
                            <button type="button" onclick="removeTool(this)" 
                                    class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    @endif
                </div>
                <button type="button" onclick="addTool()" 
                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 mt-2">
                    <i class="fas fa-plus mr-2"></i>
                    إضافة تقنية
                </button>
            </div>
            
            <div class="mb-6">
                <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">صورة المشروع الرئيسية</label>
                @if($project->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $project->image) }}" alt="Current image" class="w-32 h-32 object-cover rounded">
                    </div>
                @endif
                <input type="file" id="image" name="image" class="form-control w-full" accept="image/*">
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="gallery" class="block text-sm font-semibold text-gray-700 mb-2">معرض الصور</label>
                @if($project->gallery)
                    <div class="grid grid-cols-4 gap-2 mb-2">
                        @foreach($project->gallery as $image)
                            <img src="{{ asset('storage/' . $image) }}" alt="Gallery image" class="w-20 h-20 object-cover rounded">
                        @endforeach
                    </div>
                @endif
                <input type="file" id="gallery" name="gallery[]" class="form-control w-full" accept="image/*" multiple>
                @error('gallery.*')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="featured" value="1" {{ old('featured', $project->featured) ? 'checked' : '' }} 
                           class="mr-2">
                    <span class="text-sm font-semibold text-gray-700">مشروع مميز</span>
                </label>
            </div>
            
            <div class="flex justify-between">
                <a href="{{ route('admin.projects.index') }}" 
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

<script>
function addTool() {
    const container = document.getElementById('toolsContainer');
    const toolDiv = document.createElement('div');
    toolDiv.className = 'tool-input flex items-center gap-2 mb-2';
    toolDiv.innerHTML = `
        <input type="text" name="tools[]" class="form-control flex-1" placeholder="اسم التقنية">
        <button type="button" onclick="removeTool(this)" 
                class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600">
            <i class="fas fa-trash"></i>
        </button>
    `;
    container.appendChild(toolDiv);
}

function removeTool(button) {
    button.parentElement.remove();
}
</script>
@endsection