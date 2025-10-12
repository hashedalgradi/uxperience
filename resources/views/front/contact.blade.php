@extends('layouts.app')

@section('title', 'التواصل')

@section('content')
<!-- Hero Section -->
<section class="relative py-32 bg-gradient-to-br from-primary via-accent to-secondary overflow-hidden">
    <div class="absolute inset-0 bg-black/20"></div>
    <div class="floating-shapes">
        @for($i = 0; $i < 6; $i++)
            <div class="particle" style="left: {{ rand(0, 100) }}%; animation-delay: {{ rand(0, 6) }}s;"></div>
        @endfor
    </div>
    
    <div class="relative max-w-4xl mx-auto px-4 text-center text-white">
        <div class="animate-fade-in-up">
            <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-sm font-semibold mb-6">
                تواصل معي
            </span>
            <h1 class="text-6xl md:text-7xl font-black mb-6">
                لنبدأ <span class="gradient-text">معاً</span>
            </h1>
            <p class="text-xl md:text-2xl text-white/90">
                أسعد بالتواصل معك ومناقشة أفكارك ومشاريعك
            </p>
        </div>
    </div>
</section>

<section class="py-24 bg-gradient-to-b from-white to-gray-50">
    <div class="max-w-6xl mx-auto px-4">

        @if($socialLinks->count() > 0)
            <div class="text-center mb-20 scroll-reveal">
                <span class="inline-block px-4 py-2 bg-primary/10 text-primary rounded-full text-sm font-semibold mb-4">
                    طرق التواصل
                </span>
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">
                    اختر <span class="gradient-text">طريقتك</span> المفضلة
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto mb-12">
                    متاح على جميع المنصات للرد السريع على استفساراتك
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-20">
                @foreach($socialLinks as $index => $link)
                    <a href="{{ $link->url }}" target="_blank" 
                       class="group bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-4 scroll-reveal" 
                       style="animation-delay: {{ $index * 0.1 }}s">
                        
                        <div class="text-center">
                            <div class="relative mb-6">
                                <div class="w-20 h-20 mx-auto rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300
                                    @if($link->platform == 'LinkedIn') bg-gradient-to-r from-blue-500 to-blue-600
                                    @elseif($link->platform == 'Instagram') bg-gradient-to-r from-pink-500 to-purple-600
                                    @elseif($link->platform == 'WhatsApp') bg-gradient-to-r from-green-500 to-green-600
                                    @elseif($link->platform == 'GitHub') bg-gradient-to-r from-gray-700 to-gray-800
                                    @elseif($link->platform == 'Email') bg-gradient-to-r from-red-500 to-red-600
                                    @else bg-gradient-to-r from-primary to-accent @endif">
                                    
                                    @if($link->platform == 'LinkedIn')
                                        <i class="fab fa-linkedin text-3xl text-white"></i>
                                    @elseif($link->platform == 'Instagram')
                                        <i class="fab fa-instagram text-3xl text-white"></i>
                                    @elseif($link->platform == 'WhatsApp')
                                        <i class="fab fa-whatsapp text-3xl text-white"></i>
                                    @elseif($link->platform == 'GitHub')
                                        <i class="fab fa-github text-3xl text-white"></i>
                                    @elseif($link->platform == 'Email')
                                        <i class="fas fa-envelope text-3xl text-white"></i>
                                    @else
                                        <i class="fas fa-link text-3xl text-white"></i>
                                    @endif
                                </div>
                                
                                <!-- Pulse Ring -->
                                <div class="absolute inset-0 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="absolute inset-0 rounded-2xl animate-ping 
                                        @if($link->platform == 'LinkedIn') bg-blue-500/20
                                        @elseif($link->platform == 'Instagram') bg-pink-500/20
                                        @elseif($link->platform == 'WhatsApp') bg-green-500/20
                                        @elseif($link->platform == 'GitHub') bg-gray-700/20
                                        @elseif($link->platform == 'Email') bg-red-500/20
                                        @else bg-primary/20 @endif"></div>
                                </div>
                            </div>
                            
                            <h3 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-primary transition-colors">
                                {{ $link->platform }}
                            </h3>
                            <p class="text-gray-600 mb-4">
                                @if($link->platform == 'WhatsApp') تواصل فوري ومباشر
                                @elseif($link->platform == 'Email') للاستفسارات التفصيلية
                                @elseif($link->platform == 'LinkedIn') التواصل المهني
                                @elseif($link->platform == 'GitHub') استعراض الأكواد
                                @else تواصل اجتماعي @endif
                            </p>
                            
                            <div class="inline-flex items-center space-x-reverse space-x-2 text-primary font-semibold group-hover:text-accent transition-colors">
                                <span>ابدأ المحادثة</span>
                                <i class="fas fa-arrow-left transform group-hover:-translate-x-1 transition-transform"></i>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif

        <!-- Contact Info Cards -->
        <div class="grid md:grid-cols-2 gap-8 mb-20 scroll-reveal">
            <div class="bg-gradient-to-br from-primary/5 to-accent/5 p-8 rounded-2xl border border-primary/10">
                <div class="text-center">
                    <div class="w-20 h-20 bg-gradient-to-r from-primary to-accent rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-envelope text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">البريد الإلكتروني</h3>
                    <p class="text-gray-600 mb-4">للاستفسارات التفصيلية والمشاريع الكبيرة</p>
                    <div class="inline-flex items-center space-x-reverse space-x-2 text-primary font-semibold">
                        <i class="fas fa-clock"></i>
                        <span>رد خلال 24 ساعة</span>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-accent/5 to-secondary/5 p-8 rounded-2xl border border-accent/10">
                <div class="text-center">
                    <div class="w-20 h-20 bg-gradient-to-r from-accent to-secondary rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-phone text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">الهاتف</h3>
                    <p class="text-gray-600 mb-4">للتواصل الفوري والاستشارات العاجلة</p>
                    <div class="inline-flex items-center space-x-reverse space-x-2 text-accent font-semibold">
                        <i class="fas fa-bolt"></i>
                        <span>رد فوري</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-primary via-accent to-secondary opacity-10 rounded-3xl"></div>
            <div class="relative text-center p-12 scroll-reveal">
                <div class="max-w-3xl mx-auto">
                    <span class="inline-block px-4 py-2 bg-primary/10 text-primary rounded-full text-sm font-semibold mb-6">
                        جاهز للبدء؟
                    </span>
                    
                    <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">
                        لنحول <span class="gradient-text">فكرتك</span> لواقع
                    </h2>
                    
                    <p class="text-xl text-gray-600 mb-12 leading-relaxed">
                        أعمل مع عملائي بشراكة حقيقية لتحويل رؤيتهم إلى حلول رقمية مبتكرة تحقق أهدافهم
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        @foreach($socialLinks->where('platform', 'WhatsApp') as $whatsapp)
                            <a href="{{ $whatsapp->url }}" target="_blank"
                               class="group bg-gradient-to-r from-green-500 to-green-600 text-white px-8 py-4 rounded-full font-bold text-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 glow-on-hover">
                                <span class="flex items-center space-x-reverse space-x-2">
                                    <i class="fab fa-whatsapp group-hover:animate-bounce"></i>
                                    <span>بدء محادثة فورية</span>
                                </span>
                            </a>
                        @endforeach
                        
                        @foreach($socialLinks->where('platform', 'Email') as $email)
                            <a href="{{ $email->url }}"
                               class="group glass-effect border-2 border-primary text-primary px-8 py-4 rounded-full font-bold text-lg hover:bg-primary hover:text-white transition-all duration-300">
                                <span class="flex items-center space-x-reverse space-x-2">
                                    <i class="fas fa-envelope"></i>
                                    <span>إرسال إيميل</span>
                                </span>
                            </a>
                        @endforeach
                    </div>
                    
                    <!-- Quick Stats -->
                    <div class="grid grid-cols-3 gap-8 mt-12 pt-8 border-t border-gray-200">
                        <div class="text-center">
                            <div class="text-2xl font-black text-primary mb-1">&lt; 1ه</div>
                            <p class="text-sm text-gray-600">وقت الرد</p>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-black text-accent mb-1">24/7</div>
                            <p class="text-sm text-gray-600">متاح دائماً</p>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-black text-secondary mb-1">100%</div>
                            <p class="text-sm text-gray-600">رضا العملاء</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection