@extends('layouts.app')

@section('title', 'من أنا')

@section('content')
<!-- Hero Section -->
<section class="relative py-32 bg-gradient-to-br from-primary via-accent to-secondary overflow-hidden">
    <div class="absolute inset-0 bg-black/20"></div>
    <div class="floating-shapes">
        @for($i = 0; $i < 8; $i++)
            <div class="particle" style="left: {{ rand(0, 100) }}%; animation-delay: {{ rand(0, 8) }}s;"></div>
        @endfor
    </div>
    
    <div class="relative max-w-4xl mx-auto px-4 text-center text-white">
        <div class="animate-fade-in-up">
            <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-sm font-semibold mb-6">
                الملف الشخصي
            </span>
            <h1 class="text-6xl md:text-7xl font-black mb-6">
                من <span class="gradient-text">أنا</span>
            </h1>
            <p class="text-xl md:text-2xl text-white/90">
                تعرف على قصتي وخبرتي في عالم التقنية
            </p>
        </div>
    </div>
</section>

<section class="py-24 bg-gradient-to-b from-white to-gray-50">
    <div class="max-w-6xl mx-auto px-4">

        <div class="grid lg:grid-cols-2 gap-16 items-center mb-20">
            <!-- Profile Image -->
            <div class="scroll-reveal">
                <div class="relative">
                    @if($user && $user->image)
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}" 
                                 class="w-full max-w-lg mx-auto rounded-3xl shadow-2xl group-hover:shadow-3xl transition-all duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-primary/20 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                    @else
                        <div class="w-full max-w-lg mx-auto h-96 bg-gradient-to-br from-primary/20 to-accent/20 rounded-3xl shadow-2xl flex items-center justify-center">
                            <i class="fas fa-user text-8xl text-gray-400"></i>
                        </div>
                    @endif
                    
                    <!-- Floating Elements -->
                    <div class="absolute -top-6 -right-6 w-24 h-24 bg-gradient-to-r from-primary to-accent rounded-full opacity-20 animate-float"></div>
                    <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-gradient-to-r from-accent to-secondary rounded-full opacity-20 animate-float" style="animation-delay: 2s"></div>
                </div>
            </div>
            
            <!-- Profile Info -->
            <div class="scroll-reveal" style="animation-delay: 0.2s">
                <div class="space-y-6">
                    <div>
                        <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-2">
                            {{ $user->name ?? 'المطور' }}
                        </h2>
                        <h3 class="text-2xl font-bold gradient-text mb-6">
                            {{ $user->title ?? 'مطور ويب ومصمم واجهات' }}
                        </h3>
                    </div>
                    
                    <div class="prose prose-lg text-gray-600 leading-relaxed">
                        <p>{{ $user->bio ?? 'مطور ويب متخصص في تطوير المواقع والتطبيقات باستخدام أحدث التقنيات. أسعى دائماً لتقديم حلول مبتكرة وعملية تلبي احتياجات العملاء وتحقق أهدافهم التجارية.' }}</p>
                    </div>

                    <!-- Contact Info -->
                    <div class="space-y-4">
                        @if($user && $user->phone)
                            <div class="flex items-center space-x-reverse space-x-3">
                                <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center">
                                    <i class="fas fa-phone text-primary"></i>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">الهاتف</span>
                                    <p class="font-semibold text-gray-800">{{ $user->phone }}</p>
                                </div>
                            </div>
                        @endif

                        @if($user && $user->email)
                            <div class="flex items-center space-x-reverse space-x-3">
                                <div class="w-10 h-10 bg-accent/10 rounded-full flex items-center justify-center">
                                    <i class="fas fa-envelope text-accent"></i>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">البريد الإلكتروني</span>
                                    <p class="font-semibold text-gray-800">{{ $user->email }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- CTA Button -->
                    <div class="pt-6">
                        <a href="{{ route('contact') }}" 
                           class="inline-flex items-center space-x-reverse space-x-2 bg-gradient-to-r from-primary to-accent text-white px-8 py-4 rounded-full font-bold text-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 glow-on-hover">
                            <i class="fas fa-paper-plane"></i>
                            <span>تواصل معي</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @if($user && $user->skills)
            <!-- Skills Section -->
            <div class="scroll-reveal">
                <div class="text-center mb-16">
                    <span class="inline-block px-4 py-2 bg-primary/10 text-primary rounded-full text-sm font-semibold mb-4">
                        مهاراتي التقنية
                    </span>
                    <h3 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">
                        ما <span class="gradient-text">أتقنه</span>
                    </h3>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                        مجموعة متنوعة من التقنيات والأدوات الحديثة
                    </p>
                </div>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($user->skills as $index => $skill)
                        <div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 scroll-reveal" style="animation-delay: {{ $index * 0.1 }}s">
                            <div class="text-center">
                                <div class="w-16 h-16 bg-gradient-to-r from-primary to-accent rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                                    @php
                                        $icons = [
                                            'Laravel' => 'fab fa-laravel',
                                            'PHP' => 'fab fa-php',
                                            'JavaScript' => 'fab fa-js-square',
                                            'React' => 'fab fa-react',
                                            'Vue.js' => 'fab fa-vuejs',
                                            'MySQL' => 'fas fa-database',
                                            'HTML/CSS' => 'fab fa-html5',
                                            'Bootstrap' => 'fab fa-bootstrap',
                                            'Tailwind CSS' => 'fas fa-palette',
                                            'Git' => 'fab fa-git-alt',
                                        ];
                                        $icon = $icons[$skill] ?? 'fas fa-code';
                                    @endphp
                                    <i class="{{ $icon }} text-2xl text-white"></i>
                                </div>
                                <h4 class="font-bold text-gray-900 group-hover:text-primary transition-colors">
                                    {{ $skill }}
                                </h4>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        
        <!-- Stats Section -->
        <div class="mt-24 scroll-reveal">
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center p-8 bg-white rounded-2xl shadow-lg">
                    <div class="text-4xl font-black text-primary mb-2">{{ \App\Models\Project::count() }}+</div>
                    <p class="text-gray-600 font-semibold">مشروع منجز</p>
                </div>
                <div class="text-center p-8 bg-white rounded-2xl shadow-lg">
                    <div class="text-4xl font-black text-accent mb-2">{{ \App\Models\Service::count() }}+</div>
                    <p class="text-gray-600 font-semibold">خدمة متاحة</p>
                </div>
                <div class="text-center p-8 bg-white rounded-2xl shadow-lg">
                    <div class="text-4xl font-black text-secondary mb-2">3+</div>
                    <p class="text-gray-600 font-semibold">سنوات خبرة</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection