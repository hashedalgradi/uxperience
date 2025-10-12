<!-- Enhanced Footer Component -->
<footer class="enhanced-footer relative overflow-hidden">
    <!-- Background Elements -->
    <div class="footer-bg absolute inset-0">
        <div class="gradient-overlay"></div>
        <div class="floating-particles">
            @for($i = 0; $i < 15; $i++)
                <div class="particle" style="left: {{ rand(0, 100) }}%; animation-delay: {{ rand(0, 20) }}s; animation-duration: {{ rand(15, 25) }}s;"></div>
            @endfor
        </div>
    </div>
    
    <div class="footer-content relative z-10 max-w-7xl mx-auto px-4 py-20">
        <!-- Main Footer Content -->
        <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-12 mb-16">
            
            <!-- Brand Section -->
            <div class="brand-section lg:col-span-2" data-aos="fade-up" data-aos-delay="100">
                <div class="brand-header flex items-center space-x-reverse space-x-4 mb-6">
                    <div class="brand-icon w-16 h-16 bg-gradient-to-r from-primary to-accent rounded-2xl flex items-center justify-center transform transition-all duration-300 hover:scale-110 hover:rotate-12">
                        <i class="fas fa-code text-white text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="brand-title text-3xl font-bold text-white mb-2">{{ $globalUser->name ?? 'UXperience' }}</h3>
                        <p class="brand-subtitle text-primary/80 font-medium">{{ $globalUser->title ?? 'مطور ويب محترف' }}</p>
                    </div>
                </div>
                
                <p class="brand-description text-gray-300 text-lg leading-relaxed mb-8 max-w-md">
                    {{ $globalUser->bio ?? 'متخصص في إنشاء مواقع وتطبيقات ويب عصرية باستخدام أحدث التقنيات والأدوات المتطورة لتحقيق أفضل تجربة مستخدم.' }}
                </p>
                
                <!-- Social Links -->
                <div class="social-links flex space-x-reverse space-x-4">
                    @if(isset($globalSocialLinks))
                        @foreach($globalSocialLinks as $link)
                            <a href="{{ $link->url }}" target="_blank" class="social-link group relative w-12 h-12 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center transition-all duration-300 hover:bg-primary hover:scale-110 hover:-translate-y-2">
                                <div class="social-icon-bg absolute inset-0 bg-gradient-to-r from-primary to-accent opacity-0 group-hover:opacity-100 rounded-xl transition-opacity duration-300"></div>
                                @if($link->platform == 'LinkedIn')
                                    <i class="fab fa-linkedin text-lg relative z-10 text-white"></i>
                                @elseif($link->platform == 'GitHub')
                                    <i class="fab fa-github text-lg relative z-10 text-white"></i>
                                @elseif($link->platform == 'WhatsApp')
                                    <i class="fab fa-whatsapp text-lg relative z-10 text-white"></i>
                                @else
                                    <i class="fas fa-link text-lg relative z-10 text-white"></i>
                                @endif
                                <div class="social-ripple absolute inset-0 rounded-xl opacity-0 group-hover:opacity-100"></div>
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="quick-links" data-aos="fade-up" data-aos-delay="200">
                <h4 class="section-title text-xl font-bold text-white mb-6 relative">
                    روابط سريعة
                    <div class="title-underline absolute bottom-0 left-0 w-12 h-0.5 bg-gradient-to-r from-primary to-accent"></div>
                </h4>
                <ul class="links-list space-y-4">
                    <li><a href="{{ route('home') }}" class="footer-link">الرئيسية</a></li>
                    <li><a href="{{ route('about') }}" class="footer-link">من أنا</a></li>
                    <li><a href="{{ route('projects') }}" class="footer-link">المشاريع</a></li>
                    <li><a href="{{ route('services') }}" class="footer-link">الخدمات</a></li>
                    <li><a href="{{ route('contact') }}" class="footer-link">التواصل</a></li>
                </ul>
            </div>
            
            <!-- Contact Info -->
            <div class="contact-info" data-aos="fade-up" data-aos-delay="300">
                <h4 class="section-title text-xl font-bold text-white mb-6 relative">
                    تواصل معي
                    <div class="title-underline absolute bottom-0 left-0 w-12 h-0.5 bg-gradient-to-r from-primary to-accent"></div>
                </h4>
                <ul class="contact-list space-y-4">
                    <li class="contact-item group">
                        <div class="contact-content flex items-center space-x-reverse space-x-3">
                            <div class="contact-icon w-10 h-10 bg-primary/20 rounded-lg flex items-center justify-center group-hover:bg-primary transition-colors duration-300">
                                <i class="fas fa-envelope text-primary group-hover:text-white transition-colors duration-300"></i>
                            </div>
                            <span class="contact-text text-gray-300 group-hover:text-white transition-colors duration-300">{{ $globalUser->email ?? 'contact@example.com' }}</span>
                        </div>
                    </li>
                    @if($globalUser && $globalUser->phone)
                    <li class="contact-item group">
                        <div class="contact-content flex items-center space-x-reverse space-x-3">
                            <div class="contact-icon w-10 h-10 bg-accent/20 rounded-lg flex items-center justify-center group-hover:bg-accent transition-colors duration-300">
                                <i class="fas fa-phone text-accent group-hover:text-white transition-colors duration-300"></i>
                            </div>
                            <span class="contact-text text-gray-300 group-hover:text-white transition-colors duration-300">{{ $globalUser->phone }}</span>
                        </div>
                    </li>
                    @endif
                    @if($globalUser && $globalUser->location)
                    <li class="contact-item group">
                        <div class="contact-content flex items-center space-x-reverse space-x-3">
                            <div class="contact-icon w-10 h-10 bg-secondary/20 rounded-lg flex items-center justify-center group-hover:bg-secondary transition-colors duration-300">
                                <i class="fas fa-map-marker-alt text-secondary group-hover:text-white transition-colors duration-300"></i>
                            </div>
                            <span class="contact-text text-gray-300 group-hover:text-white transition-colors duration-300">{{ $globalUser->location }}</span>
                        </div>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        
        <!-- Newsletter Section -->
        <div class="newsletter-section bg-white/5 backdrop-blur-sm rounded-2xl p-8 mb-12" data-aos="fade-up" data-aos-delay="400">
            <div class="text-center">
                <h4 class="newsletter-title text-2xl font-bold text-white mb-4">ابق على تواصل</h4>
                <p class="newsletter-description text-gray-300 mb-6 max-w-md mx-auto">
                    اشترك في النشرة البريدية للحصول على آخر المشاريع والتحديثات
                </p>
                <form class="newsletter-form flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                    <input type="email" placeholder="بريدك الإلكتروني" class="newsletter-input flex-1 px-4 py-3 bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:border-primary transition-colors duration-300">
                    <button type="submit" class="newsletter-btn bg-gradient-to-r from-primary to-accent text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                        اشتراك
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Footer Bottom -->
        <div class="footer-bottom border-t border-white/10 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <div class="copyright text-gray-400 text-center md:text-right">
                    <p>&copy; {{ date('Y') }} جميع الحقوق محفوظة - تم التطوير بـ <span class="text-red-400">❤️</span> باستخدام Laravel</p>
                </div>
                <div class="footer-links flex space-x-reverse space-x-6">
                    <a href="#" class="footer-link text-sm">سياسة الخصوصية</a>
                    <a href="#" class="footer-link text-sm">شروط الاستخدام</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scroll to Top Button -->
    <button id="scroll-to-top" class="scroll-top-btn fixed bottom-8 left-8 w-12 h-12 bg-gradient-to-r from-primary to-accent rounded-full flex items-center justify-center text-white shadow-lg opacity-0 invisible transition-all duration-300 hover:scale-110 z-50">
        <i class="fas fa-arrow-up"></i>
    </button>
</footer>

<style>
/* Enhanced Footer Styles */
.enhanced-footer {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
    position: relative;
}

.footer-bg .gradient-overlay {
    background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(236, 72, 153, 0.1) 50%, rgba(245, 158, 11, 0.1) 100%);
    position: absolute;
    inset: 0;
}

/* Floating Particles */
.floating-particles {
    position: absolute;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.floating-particles .particle {
    position: absolute;
    width: 4px;
    height: 4px;
    background: rgba(99, 102, 241, 0.4);
    border-radius: 50%;
    animation: floatParticle 20s infinite linear;
}

@keyframes floatParticle {
    0% {
        transform: translateY(100vh) translateX(0) rotate(0deg);
        opacity: 0;
    }
    10% {
        opacity: 1;
    }
    90% {
        opacity: 1;
    }
    100% {
        transform: translateY(-100px) translateX(50px) rotate(360deg);
        opacity: 0;
    }
}

/* Brand Section */
.brand-section .brand-icon {
    box-shadow: 0 10px 30px rgba(99, 102, 241, 0.3);
}

.brand-title {
    background: linear-gradient(135deg, #ffffff 0%, #e2e8f0 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Section Titles */
.section-title {
    position: relative;
    padding-bottom: 0.5rem;
}

.title-underline {
    animation: expandLine 0.8s ease-out 0.5s both;
}

@keyframes expandLine {
    from { width: 0; }
    to { width: 3rem; }
}

/* Footer Links */
.footer-link {
    color: #94a3b8;
    font-weight: 500;
    transition: all 0.3s ease;
    position: relative;
    display: inline-block;
}

.footer-link::before {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, #6366f1, #ec4899);
    transition: width 0.3s ease;
}

.footer-link:hover {
    color: #ffffff;
    transform: translateX(4px);
}

.footer-link:hover::before {
    width: 100%;
}

/* Social Links */
.social-link {
    position: relative;
    overflow: hidden;
}

.social-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.6s;
}

.social-link:hover::before {
    left: 100%;
}

.social-ripple {
    background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
    animation: rippleEffect 0.6s ease-out;
}

@keyframes rippleEffect {
    0% {
        transform: scale(0);
        opacity: 1;
    }
    100% {
        transform: scale(2);
        opacity: 0;
    }
}

/* Contact Items */
.contact-item {
    transition: all 0.3s ease;
    padding: 0.5rem;
    border-radius: 0.75rem;
}

.contact-item:hover {
    background: rgba(255, 255, 255, 0.05);
    transform: translateX(8px);
}

/* Newsletter Section */
.newsletter-section {
    border: 1px solid rgba(255, 255, 255, 0.1);
    position: relative;
    overflow: hidden;
}

.newsletter-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.05), transparent);
    animation: shimmer 3s infinite;
}

@keyframes shimmer {
    0% { left: -100%; }
    100% { left: 100%; }
}

.newsletter-input:focus {
    box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.3);
}

.newsletter-btn {
    position: relative;
    overflow: hidden;
}

.newsletter-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.6s;
}

.newsletter-btn:hover::before {
    left: 100%;
}

/* Scroll to Top Button */
.scroll-top-btn {
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.scroll-top-btn.visible {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.scroll-top-btn:hover {
    box-shadow: 0 10px 30px rgba(99, 102, 241, 0.4);
}

/* Responsive Design */
@media (max-width: 768px) {
    .footer-content {
        padding: 3rem 1rem;
    }
    
    .brand-section {
        text-align: center;
    }
    
    .social-links {
        justify-content: center;
    }
    
    .newsletter-form {
        flex-direction: column;
    }
    
    .floating-particles .particle {
        animation-duration: 15s;
    }
    
    .scroll-top-btn {
        bottom: 1rem;
        left: 1rem;
        width: 3rem;
        height: 3rem;
    }
}

/* AOS Animation Overrides */
[data-aos="fade-up"] {
    transform: translateY(30px);
    opacity: 0;
    transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

[data-aos="fade-up"].aos-animate {
    transform: translateY(0);
    opacity: 1;
}

/* Performance Optimizations */
.enhanced-footer * {
    will-change: transform;
}

@media (prefers-reduced-motion: reduce) {
    .floating-particles .particle,
    .newsletter-section::before {
        animation: none;
    }
    
    .title-underline {
        animation: none;
        width: 3rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Scroll to Top Button
    const scrollTopBtn = document.getElementById('scroll-to-top');
    
    function handleScrollTop() {
        if (window.scrollY > 300) {
            scrollTopBtn.classList.add('visible');
        } else {
            scrollTopBtn.classList.remove('visible');
        }
    }
    
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
    
    // Event Listeners
    window.addEventListener('scroll', handleScrollTop, { passive: true });
    scrollTopBtn.addEventListener('click', scrollToTop);
    
    // Newsletter Form
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            if (email) {
                // Add your newsletter subscription logic here
                alert('شكراً لك! تم تسجيل اشتراكك بنجاح.');
                this.reset();
            }
        });
    }
    
    // Social Links Ripple Effect
    document.querySelectorAll('.social-link').forEach(link => {
        link.addEventListener('click', function(e) {
            const ripple = this.querySelector('.social-ripple');
            if (ripple) {
                ripple.style.animation = 'none';
                ripple.offsetHeight; // Trigger reflow
                ripple.style.animation = 'rippleEffect 0.6s ease-out';
            }
        });
    });
    
    // Intersection Observer for Animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('aos-animate');
            }
        });
    }, observerOptions);
    
    // Observe all elements with data-aos attribute
    document.querySelectorAll('[data-aos]').forEach(el => {
        observer.observe(el);
    });
});
</script>