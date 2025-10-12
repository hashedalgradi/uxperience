@extends('layouts.app')

@section('title', 'UXperience - الصفحة الرئيسية')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden" style="background: transparent;">
    <!-- Clean 3D Scene Background -->
    <div id="three-container" class="absolute inset-0 z-0">
        <!-- Simple Loading Indicator -->
        <div class="scene-loading flex items-center justify-center h-full text-white/60">
            <div class="text-lg">جاري التحميل...</div>
        </div>
    </div>
    
    <!-- Subtle Overlay -->
    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/30 via-transparent to-slate-900/20 z-10"></div>
    
    <!-- Content -->
    <div class="relative z-30 max-w-5xl mx-auto px-6 text-center">
        <div class="scroll-reveal">
            <!-- Clean Profile Image -->
            <div class="mb-16 relative">
                @if($globalUser && $globalUser->image)
                    <div class="relative inline-block">
                        <img src="{{ asset('storage/' . $globalUser->image) }}" alt="{{ $globalUser->name }}" 
                             class="w-32 h-32 rounded-full mx-auto border-3 border-white/20 shadow-2xl object-cover backdrop-blur-sm">
                    </div>
                @else
                    <div class="w-32 h-32 rounded-full mx-auto border-3 border-white/20 shadow-2xl bg-white/10 backdrop-blur-sm flex items-center justify-center">
                        <i class="fas fa-user text-4xl text-white/80"></i>
                    </div>
                @endif
            </div>
            
            <!-- Elegant Heading -->
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight text-white">
                <span class="block mb-4 text-white/90">مرحباً، أنا</span>
                <span class="bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">{{ $globalUser->name ?? 'UX Developer' }}</span>
            </h1>
            
            <!-- Clean Subtitle -->
            <div class="inline-block px-6 py-3 bg-white/10 backdrop-blur-md rounded-xl mb-8 border border-white/20">
                <p class="text-lg md:text-xl font-medium text-white/90">
                    {{ $globalUser->title ?? 'مطور ويب ومصمم واجهات' }}
                </p>
            </div>
            
            <!-- Simple Description -->
            <p class="text-base md:text-lg mb-12 max-w-3xl mx-auto text-white/80 leading-relaxed">
                {{ Str::limit($globalUser->bio ?? 'أقوم بتطوير مواقع الويب وتصميم واجهات المستخدم بأحدث التقنيات', 200) }}
            </p>
            
            <!-- Clean CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('projects') }}" 
                   class="px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-semibold hover:from-blue-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                    <span class="flex items-center space-x-reverse space-x-2">
                        <i class="fas fa-folder-open"></i>
                        <span>استكشف أعمالي</span>
                    </span>
                </a>
                
                <a href="{{ route('contact') }}" 
                   class="px-8 py-4 bg-white/10 backdrop-blur-md text-white rounded-xl font-semibold border border-white/20 hover:bg-white/20 transition-all duration-300">
                    <span class="flex items-center space-x-reverse space-x-2">
                        <i class="fas fa-envelope"></i>
                        <span>تواصل معي</span>
                    </span>
                </a>
            </div>
        </div>
        
        <!-- Simple Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-30">
            <div class="flex flex-col items-center text-white/60">
                <span class="text-sm mb-3">مرر لأسفل</span>
                <div class="w-6 h-10 border-2 border-white/30 rounded-full flex justify-center">
                    <div class="w-1 h-3 bg-white/50 rounded-full mt-2 animate-bounce"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Projects -->
@if($featuredProjects->count() > 0)
<section class="py-24 bg-gradient-to-b from-slate-50 to-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16 scroll-reveal">
            <div class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-medium mb-4">
                <i class="fas fa-star mr-2"></i>
                أعمالي المميزة
            </div>
            <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4">
                مشاريع <span class="text-blue-600">استثنائية</span>
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                مجموعة مختارة من أفضل المشاريع التي عملت عليها
            </p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featuredProjects as $index => $project)
                <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 scroll-reveal">
                    <div class="relative overflow-hidden">
                        @if($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" 
                                 class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-blue-100 to-purple-100 flex items-center justify-center">
                                <i class="fas fa-image text-4xl text-blue-400"></i>
                            </div>
                        @endif
                        <div class="absolute top-3 right-3">
                            <span class="bg-white/90 backdrop-blur-sm px-3 py-1 text-blue-700 text-xs font-medium rounded-full">
                                {{ $project->category }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors">
                            {{ $project->title }}
                        </h3>
                        <p class="text-gray-600 mb-4 leading-relaxed">
                            {{ Str::limit($project->description, 120) }}
                        </p>
                        
                        @if($project->tools)
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach(array_slice($project->tools, 0, 3) as $tool)
                                    <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-md">
                                        {{ $tool }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                        
                        <a href="{{ route('projects.show', $project->id) }}" 
                           class="inline-flex items-center space-x-reverse space-x-2 text-primary font-semibold hover:text-accent transition-colors group">
                            <span>استكشف المشروع</span>
                            <i class="fas fa-arrow-left transform group-hover:-translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="text-center mt-16 scroll-reveal">
            <a href="{{ route('projects') }}" 
               class="inline-flex items-center space-x-reverse space-x-2 bg-gradient-to-r from-primary to-accent text-white px-8 py-4 rounded-full font-bold text-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                <i class="fas fa-grid-3x3"></i>
                <span>عرض جميع المشاريع</span>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Services -->
@if($services->count() > 0)
<section class="py-24 bg-gradient-to-b from-gray-50 to-white relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute top-20 left-10 w-32 h-32 bg-primary/5 rounded-full morphing-shape"></div>
    <div class="absolute bottom-20 right-10 w-48 h-48 bg-accent/5 rounded-full morphing-shape" style="animation-delay: 2s"></div>
    
    <div class="relative max-w-7xl mx-auto px-4">
        <div class="text-center mb-20 scroll-reveal">
            <span class="inline-block px-4 py-2 bg-accent/10 text-accent rounded-full text-sm font-semibold mb-4">
                خدماتي المتخصصة
            </span>
            <h2 class="text-5xl md:text-6xl font-black text-gray-900 mb-6">
                ما <span class="gradient-text">أقدمه</span> لك
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                خدمات تقنية متكاملة لتحويل أفكارك إلى حلول رقمية مبتكرة
            </p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $index => $service)
                <div class="group bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 scroll-reveal" style="animation-delay: {{ $index * 0.1 }}s">
                    <div class="relative mb-6">
                        <div class="w-16 h-16 bg-gradient-to-r from-primary to-accent rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            @if($service->icon)
                                <i class="{{ $service->icon }} text-2xl text-white"></i>
                            @else
                                <i class="fas fa-cog text-2xl text-white"></i>
                            @endif
                        </div>
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-accent rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 animate-pulse"></div>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-primary transition-colors">
                        {{ $service->title }}
                    </h3>
                    <p class="text-gray-600 leading-relaxed">
                        {{ $service->description }}
                    </p>
                    
                    <div class="mt-6 pt-4 border-t border-gray-100">
                        <a href="{{ route('contact') }}" class="inline-flex items-center space-x-reverse space-x-2 text-primary font-semibold hover:text-accent transition-colors group">
                            <span>اطلب الخدمة</span>
                            <i class="fas fa-arrow-left transform group-hover:-translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Contact CTA -->
<section class="py-24 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-dark via-primary to-accent"></div>
    <div class="absolute inset-0 bg-black/20"></div>
    
    <!-- Animated Elements -->
    <div class="absolute top-10 left-10 w-20 h-20 bg-white/10 rounded-full animate-float"></div>
    <div class="absolute bottom-10 right-10 w-32 h-32 bg-white/5 rounded-full animate-float" style="animation-delay: 2s"></div>
    <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-white/10 rounded-full animate-bounce-slow"></div>
    
    <div class="relative max-w-4xl mx-auto px-4 text-center text-white">
        <div class="scroll-reveal">
            <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-sm font-semibold mb-6">
                جاهز للبدء؟
            </span>
            
            <h2 class="text-5xl md:text-6xl font-black mb-6 leading-tight">
                لديك <span class="text-yellow-300">فكرة</span> رائعة؟
            </h2>
            
            <p class="text-xl md:text-2xl mb-12 text-white/90 max-w-2xl mx-auto leading-relaxed">
                دعنا نتعاون لتحويل رؤيتك إلى واقع رقمي مذهل يحقق أهدافك
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('contact') }}" 
                   class="group bg-white text-gray-900 px-8 py-4 rounded-full font-bold text-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 glow-on-hover">
                    <span class="flex items-center space-x-reverse space-x-2">
                        <i class="fas fa-rocket group-hover:animate-bounce"></i>
                        <span>ابدأ مشروعك الآن</span>
                    </span>
                </a>
                
                <a href="{{ route('projects') }}" 
                   class="group glass-effect text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white/20 transition-all duration-300">
                    <span class="flex items-center space-x-reverse space-x-2">
                        <i class="fas fa-eye"></i>
                        <span>شاهد أعمالي</span>
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection