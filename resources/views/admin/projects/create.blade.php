@extends('layouts.admin')

@section('title', 'إضافة مشروع جديد')
@section('page-title', 'إضافة مشروع جديد')
@section('page-subtitle', 'إضافة مشروع جديد إلى معرض أعمالك')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="admin-form fade-in">
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="title" class="form-label">عنوان المشروع *</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" 
                           class="form-input" required>
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="category" class="form-label">فئة المشروع *</label>
                    <select id="category" name="category" class="form-input form-select" required>
                        <option value="">اختر الفئة</option>
                        <option value="تطوير ويب" {{ old('category') == 'تطوير ويب' ? 'selected' : '' }}>تطوير ويب</option>
                        <option value="تصميم واجهات" {{ old('category') == 'تصميم واجهات' ? 'selected' : '' }}>تصميم واجهات</option>
                        <option value="تطبيقات موبايل" {{ old('category') == 'تطبيقات موبايل' ? 'selected' : '' }}>تطبيقات موبايل</option>
                        <option value="أنظمة إدارة" {{ old('category') == 'أنظمة إدارة' ? 'selected' : '' }}>أنظمة إدارة</option>
                    </select>
                    @error('category')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="mb-6">
                <label for="description" class="form-label">وصف المشروع *</label>
                <textarea id="description" name="description" rows="4" class="form-input form-textarea" required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="github" class="form-label">رابط GitHub</label>
                    <input type="url" id="github" name="github" value="{{ old('github') }}" 
                           class="form-input" placeholder="https://github.com/username/repo">
                    @error('github')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="demo" class="form-label">رابط العرض المباشر</label>
                    <input type="url" id="demo" name="demo" value="{{ old('demo') }}" 
                           class="form-input" placeholder="https://example.com">
                    @error('demo')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="mb-6">
                <label class="form-label">التقنيات المستخدمة</label>
                <div id="toolsContainer">
                    <div class="tool-input flex items-center gap-2 mb-2">
                        <input type="text" name="tools[]" class="form-input flex-1" placeholder="اسم التقنية">
                        <button type="button" onclick="removeTool(this)" 
                                class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <button type="button" onclick="addTool()" 
                        class="btn btn-secondary mt-2">
                    <i class="fas fa-plus mr-2"></i>
                    إضافة تقنية
                </button>
            </div>
            
            <div class="mb-6">
                <label for="image" class="form-label">صورة المشروع الرئيسية</label>
                <input type="file" id="image" name="image" class="form-input" accept="image/*">
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="gallery" class="form-label">معرض الصور</label>
                <input type="file" id="gallery" name="gallery[]" class="form-input" accept="image/*" multiple>
                @error('gallery.*')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="featured" value="1" {{ old('featured') ? 'checked' : '' }} 
                           class="mr-2">
                    <span class="form-label">مشروع مميز</span>
                </label>
            </div>
            
            <div class="flex justify-between">
                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
                    إلغاء
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i>
                    حفظ المشروع
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
        <input type="text" name="tools[]" class="form-input flex-1" placeholder="اسم التقنية">
        <button type="button" onclick="removeTool(this)" 
                class="btn btn-danger btn-sm">
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