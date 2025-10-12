@extends('layouts.app')

@section('title', 'المشاريع')

@section('content')
<!-- Hero Section -->
<section class="relative py-32 bg-gradient-to-br from-primary via-accent to-secondary overflow-hidden">
    <div class="absolute inset-0 bg-black/20"></div>
    <div class="floating-shapes">
        @for($i = 0; $i < 10; $i++)
            <div class="particle" style="left: {{ rand(0, 100) }}%; animation-delay: {{ rand(0, 10) }}s;"></div>
        @endfor
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 text-center text-white">
        <div class="animate-fade-in-up">
            <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-sm font-semibold mb-6">
                معرض الأعمال
            </span>
            <h1 class="text-6xl md:text-7xl font-black mb-6">
                <span class="gradient-text">مشاريعي</span>
            </h1>
            <p class="text-xl md:text-2xl text-white/90 max-w-2xl mx-auto">
                مجموعة شاملة من المشاريع المتنوعة التي عملت عليها
            </p>
        </div>
    </div>
</section>

<section class="py-24 bg-gradient-to-b from-white to-gray-50">
    <div class="max-w-7xl mx-auto px-4">

        @if($projects->count() > 0)
            <!-- Filter Tabs -->
            <div class="flex flex-wrap justify-center gap-4 mb-12">
                <button class="filter-btn active px-6 py-3 rounded-full font-semibold transition-all duration-300" data-filter="all">
                    جميع المشاريع
                </button>
                @php
                    $categories = $projects->pluck('category')->unique();
                @endphp
                @foreach($categories as $category)
                    <button class="filter-btn px-6 py-3 rounded-full font-semibold transition-all duration-300" data-filter="{{ $category }}">
                        {{ $category }}
                    </button>
                @endforeach
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8" id="projects-grid">
                @foreach($projects as $index => $project)
                    <div class="project-card group card-hover bg-white rounded-2xl shadow-lg overflow-hidden scroll-reveal hover-glow relative" 
                         data-category="{{ $project->category }}" 
                         style="animation-delay: {{ ($index % 6) * 0.1 }}s"
                         onmouseenter="createEnhancedCardRipple(this)" onmouseleave="removeCardEffects(this)">
                         
                        <!-- Enhanced Glow Effect -->
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-primary via-accent to-secondary rounded-2xl opacity-0 group-hover:opacity-20 transition-opacity duration-500 blur"></div>
                        
                        <div class="relative overflow-hidden">
                            @if($project->image)
                                <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" 
                                     class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-56 bg-gradient-to-br from-primary/20 to-accent/20 flex items-center justify-center">
                                    <i class="fas fa-image text-5xl text-gray-400"></i>
                                </div>
                            @endif
                            
                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <div class="absolute bottom-4 left-4 right-4">
                                    <div class="flex space-x-reverse space-x-2">
                                        @if($project->github)
                                            <a href="{{ $project->github }}" target="_blank" 
                                               class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-white hover:bg-white/30 transition">
                                                <i class="fab fa-github"></i>
                                            </a>
                                        @endif
                                        @if($project->demo)
                                            <a href="{{ $project->demo }}" target="_blank" 
                                               class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-white hover:bg-white/30 transition">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Category Badge -->
                            <div class="absolute top-4 right-4">
                                <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-primary text-sm font-semibold rounded-full">
                                    {{ $project->category }}
                                </span>
                            </div>
                            
                            @if($project->featured)
                                <div class="absolute top-4 left-4">
                                    <span class="px-2 py-1 bg-gradient-to-r from-yellow-400 to-orange-500 text-white text-xs font-bold rounded-full">
                                        <i class="fas fa-star mr-1"></i>مميز
                                    </span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-primary group-hover:to-accent group-hover:bg-clip-text transition-all duration-300">
                                {{ $project->title }}
                            </h3>
                            <p class="text-gray-600 mb-4 leading-relaxed group-hover:text-gray-700 transition-colors duration-300">
                                {{ Str::limit($project->description, 120) }}
                            </p>
                            
                            @if($project->tools)
                                <div class="flex flex-wrap gap-2 mb-6">
                                    @foreach(array_slice($project->tools, 0, 4) as $tool)
                                        <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-md font-medium">
                                            {{ $tool }}
                                        </span>
                                    @endforeach
                                    @if(count($project->tools) > 4)
                                        <span class="px-2 py-1 bg-primary/10 text-primary text-xs rounded-md font-medium">
                                            +{{ count($project->tools) - 4 }}
                                        </span>
                                    @endif
                                </div>
                            @endif
                            
                            <a href="{{ route('projects.show', $project->id) }}" 
                               class="inline-flex items-center space-x-reverse space-x-2 text-primary font-semibold hover:text-accent transition-all duration-300 group/link relative overflow-hidden">
                                <span class="relative z-10">استكشف المشروع</span>
                                <i class="fas fa-arrow-left transform group-hover/link:-translate-x-1 transition-transform duration-300 relative z-10"></i>
                                <div class="absolute inset-0 bg-gradient-to-r from-primary/10 to-accent/10 transform scale-x-0 group-hover/link:scale-x-100 transition-transform duration-300 origin-right rounded"></div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $projects->links() }}
            </div>
        @else
            <div class="text-center py-20">
                <div class="w-32 h-32 bg-gradient-to-br from-primary/20 to-accent/20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-folder-open text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-800 mb-4">لا توجد مشاريع حالياً</h3>
                <p class="text-gray-600 text-lg mb-8">سيتم إضافة المشاريع قريباً</p>
                <a href="{{ route('contact') }}" class="inline-flex items-center space-x-reverse space-x-2 bg-gradient-to-r from-primary to-accent text-white px-6 py-3 rounded-full font-semibold hover:shadow-lg transition-all duration-300">
                    <i class="fas fa-paper-plane"></i>
                    <span>تواصل معي</span>
                </a>
            </div>
        @endif
    </div>
</section>
@endsection