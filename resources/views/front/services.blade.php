@extends('layouts.app')

@section('title', 'الخدمات')

@section('content')
<!-- Enhanced Background Effects -->
<div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
    <div class="floating-shape shape-1 animate-morph"></div>
    <div class="floating-shape shape-2 animate-morph"></div>
    <div class="floating-shape shape-3 animate-morph"></div>
    <div class="code-rain"></div>
</div>

<section class="py-20 bg-gradient-to-br from-white via-blue-50/30 to-purple-50/30 relative z-10">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <div class="inline-block relative">
                <h1 class="text-5xl md:text-6xl font-bold text-gray-800 mb-4 animate-fade-in-up">
                    <span class="bg-gradient-to-r from-primary via-accent to-secondary bg-clip-text text-transparent">
                        الخدمات
                    </span>
                </h1>
                <div class="absolute -inset-4 bg-gradient-to-r from-primary/20 to-accent/20 blur-xl rounded-full animate-pulse"></div>
            </div>
            <p class="text-gray-600 text-xl animate-fade-in-up animation-delay-200 leading-relaxed">
                الخدمات المتميزة التي أقدمها لعملائي مع أحدث التقنيات
            </p>
            <div class="mt-8 flex justify-center">
                <div class="w-24 h-1 bg-gradient-to-r from-primary to-accent rounded-full animate-pulse"></div>
            </div>
        </div>

        @if($services->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($services as $index => $service)
                    <div class="service-card group bg-white/80 backdrop-blur-sm p-8 rounded-2xl shadow-lg text-center hover:shadow-2xl transition-all duration-500 transform hover:scale-105 scroll-reveal relative overflow-hidden" 
                         style="animation-delay: {{ ($index % 3) * 0.2 }}s"
                         onmouseenter="createEnhancedCardRipple(this)">
                        
                        <!-- Enhanced Glow Effect -->
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-primary via-accent to-secondary rounded-2xl opacity-0 group-hover:opacity-20 transition-opacity duration-500 blur"></div>
                        
                        <!-- Shimmer Effect -->
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        
                        <div class="relative z-10">
                            <div class="mb-6">
                                <div class="w-20 h-20 bg-gradient-to-br from-primary/20 to-accent/20 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 relative">
                                    @if($service->icon)
                                        <i class="{{ $service->icon }} text-4xl text-primary group-hover:text-accent transition-colors duration-300"></i>
                                    @else
                                        <i class="fas fa-cog text-4xl text-primary group-hover:text-accent transition-colors duration-300"></i>
                                    @endif
                                    <div class="absolute inset-0 bg-gradient-to-r from-primary/30 to-accent/30 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 animate-pulse"></div>
                                </div>
                            </div>
                            
                            <h3 class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-primary group-hover:to-accent group-hover:bg-clip-text transition-all duration-300">
                                {{ $service->title }}
                            </h3>
                            <p class="text-gray-600 leading-relaxed group-hover:text-gray-700 transition-colors duration-300">
                                {{ $service->description }}
                            </p>
                            
                            <div class="mt-6">
                                <a href="{{ route('contact') }}" 
                                   class="inline-flex items-center space-x-reverse space-x-2 text-primary font-semibold hover:text-accent transition-all duration-300 group/link relative overflow-hidden">
                                    <span class="relative z-10">اطلب الخدمة</span>
                                    <i class="fas fa-arrow-left mr-2 transform group-hover/link:-translate-x-1 transition-transform duration-300 relative z-10"></i>
                                    <div class="absolute inset-0 bg-gradient-to-r from-primary/10 to-accent/10 transform scale-x-0 group-hover/link:scale-x-100 transition-transform duration-300 origin-right rounded"></div>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Ripple Container -->
                        <div class="ripple-container absolute inset-0 rounded-2xl overflow-hidden pointer-events-none"></div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20">
                <i class="fas fa-tools text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-2xl font-semibold text-gray-600 mb-2">لا توجد خدمات حالياً</h3>
                <p class="text-gray-500">سيتم إضافة الخدمات قريباً</p>
            </div>
        @endif

        <!-- Enhanced Contact CTA -->
        <div class="mt-20 bg-gradient-to-r from-primary via-accent to-secondary text-white p-12 rounded-2xl text-center relative overflow-hidden group">
            <!-- Animated Background -->
            <div class="absolute inset-0 bg-gradient-to-r from-primary/80 to-accent/80 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="absolute inset-0">
                <div class="absolute top-4 left-4 w-8 h-8 bg-white/20 rounded-full animate-pulse"></div>
                <div class="absolute bottom-6 right-8 w-6 h-6 bg-white/15 rounded-full animate-pulse" style="animation-delay: 1s"></div>
                <div class="absolute top-1/2 right-1/4 w-4 h-4 bg-white/10 rounded-full animate-pulse" style="animation-delay: 2s"></div>
            </div>
            
            <div class="relative z-10">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 animate-fade-in-up">
                    هل تحتاج خدمة مخصصة؟
                </h2>
                <p class="text-xl mb-8 opacity-90 animate-fade-in-up animation-delay-200 leading-relaxed">
                    تواصل معي لمناقشة احتياجاتك وسأقدم لك الحل المناسب بأحدث التقنيات
                </p>
                <a href="{{ route('contact') }}" 
                   class="inline-flex items-center space-x-reverse space-x-3 bg-white text-primary px-8 py-4 rounded-full font-semibold hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 hover:shadow-xl animate-fade-in-up animation-delay-400 relative overflow-hidden group/btn">
                    <span class="relative z-10">تواصل معي الآن</span>
                    <i class="fas fa-paper-plane relative z-10"></i>
                    <div class="absolute inset-0 bg-gradient-to-r from-primary/10 to-accent/10 transform scale-x-0 group-hover/btn:scale-x-100 transition-transform duration-300 origin-left rounded-full"></div>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection