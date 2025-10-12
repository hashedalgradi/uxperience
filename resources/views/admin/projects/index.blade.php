@extends('layouts.admin')

@section('title', 'إدارة المشاريع')
@section('page-title', 'إدارة المشاريع')
@section('page-subtitle', 'عرض وتحرير جميع المشاريع')

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
                <h2 class="table-title">المشاريع ({{ $projects->total() }})</h2>
                <p class="table-subtitle">إدارة وتنظيم جميع مشاريعك</p>
            </div>
            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
                <i class="fas fa-plus ml-2"></i>
                إضافة مشروع جديد
            </a>
        </div>
    </div>
</div>

@if($projects->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($projects as $project)
            <div class="dashboard-card overflow-hidden fade-in" style="animation-delay: {{ ($loop->index * 0.1) }}s">
                <div class="relative">
                    @if($project->image)
                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" 
                             class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                            <i class="fas fa-image text-4xl text-gray-400"></i>
                        </div>
                    @endif
                    
                    <!-- Status Badges -->
                    <div class="absolute top-3 right-3 flex space-x-reverse space-x-2">
                        <span class="px-2 py-1 bg-white/90 backdrop-blur-sm text-primary text-xs font-semibold rounded-full">
                            {{ $project->category }}
                        </span>
                        @if($project->featured)
                            <span class="px-2 py-1 bg-gradient-to-r from-yellow-400 to-orange-500 text-white text-xs font-bold rounded-full">
                                <i class="fas fa-star mr-1"></i>مميز
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-3">{{ $project->title }}</h3>
                    <p class="text-gray-600 text-sm mb-4 leading-relaxed">{{ Str::limit($project->description, 100) }}</p>
                    
                    @if($project->tools)
                        <div class="flex flex-wrap gap-2 mb-6">
                            @foreach(array_slice($project->tools, 0, 3) as $tool)
                                <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-md font-medium">
                                    {{ $tool }}
                                </span>
                            @endforeach
                            @if(count($project->tools) > 3)
                                <span class="px-2 py-1 bg-primary/10 text-primary text-xs rounded-md font-medium">
                                    +{{ count($project->tools) - 3 }}
                                </span>
                            @endif
                        </div>
                    @endif
                    
                    <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                        <div class="flex space-x-reverse space-x-2">
                            <a href="{{ route('admin.projects.edit', $project) }}" 
                               class="btn btn-secondary btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirmDelete('هل أنت متأكد من حذف هذا المشروع؟')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                        
                        <div class="flex space-x-reverse space-x-2">
                            @if($project->github)
                                <a href="{{ $project->github }}" target="_blank" 
                                   class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center text-gray-600 hover:bg-gray-800 hover:text-white transition-all">
                                    <i class="fab fa-github"></i>
                                </a>
                            @endif
                            @if($project->demo)
                                <a href="{{ $project->demo }}" target="_blank" 
                                   class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition-all">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <!-- Pagination -->
    <div class="mt-8 flex justify-center">
        {{ $projects->links() }}
    </div>
@else
    <div class="dashboard-card p-12 text-center">
        <div class="w-24 h-24 bg-gradient-to-br from-primary/20 to-accent/20 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-folder-open text-4xl text-gray-400"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-4">لا توجد مشاريع</h3>
        <p class="text-gray-600 mb-8 max-w-md mx-auto">ابدأ بإضافة مشروعك الأول لعرض أعمالك ومهاراتك</p>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
            <i class="fas fa-plus ml-2"></i>
            إضافة مشروع جديد
        </a>
    </div>
@endif
@endsection