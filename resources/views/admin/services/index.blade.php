@extends('layouts.admin')

@section('title', 'إدارة الخدمات')
@section('page-title', 'إدارة الخدمات')
@section('page-subtitle', 'عرض وتحرير جميع الخدمات')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle ml-2"></i>
        {{ session('success') }}
    </div>
@endif

<!-- Header Section -->
<div class="admin-table mb-8">
    <div class="table-header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="table-title">الخدمات ({{ $services->total() }})</h2>
                <p class="table-subtitle">إدارة وتنظيم جميع خدماتك</p>
            </div>
            <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                <i class="fas fa-plus ml-2"></i>
                إضافة خدمة جديدة
            </a>
        </div>
    </div>
</div>

@if($services->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($services as $service)
            <div class="dashboard-card text-center fade-in" style="animation-delay: {{ ($loop->index * 0.1) }}s">
                <div class="card-icon bg-gradient-to-r from-blue-500 to-blue-600 mx-auto mb-4">
                    @if($service->icon)
                        <i class="{{ $service->icon }} text-white text-2xl"></i>
                    @else
                        <i class="fas fa-cog text-white text-2xl"></i>
                    @endif
                </div>
                
                <h3 class="text-xl font-bold text-gray-800 mb-3">{{ $service->title }}</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">{{ Str::limit($service->description, 120) }}</p>
                
                <div class="flex justify-center space-x-reverse space-x-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-edit ml-1"></i>
                        تعديل
                    </a>
                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirmDelete('هل أنت متأكد من حذف هذه الخدمة؟')">
                            <i class="fas fa-trash ml-1"></i>
                            حذف
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    
    <div class="mt-8 flex justify-center">
        {{ $services->links() }}
    </div>
@else
    <div class="dashboard-card p-12 text-center">
        <div class="w-24 h-24 bg-gradient-to-br from-blue-500/20 to-purple-500/20 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-cogs text-4xl text-gray-400"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-4">لا توجد خدمات</h3>
        <p class="text-gray-600 mb-8 max-w-md mx-auto">ابدأ بإضافة خدمتك الأولى لعرض ما تقدمه للعملاء</p>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
            <i class="fas fa-plus ml-2"></i>
            إضافة خدمة جديدة
        </a>
    </div>
@endif
@endsection