<!-- Enhanced Header Component -->
<nav id="main-nav" class="fixed w-full top-0 z-50 transition-all duration-500 ease-out">
    <div class="nav-container max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="logo-container group flex items-center space-x-reverse space-x-3">
                    <div class="logo-icon w-12 h-12 bg-gradient-to-r from-primary to-accent rounded-xl flex items-center justify-center transform transition-all duration-300 group-hover:scale-110 group-hover:rotate-12">
                        <i class="fas fa-code text-white text-xl"></i>
                    </div>
                    <span class="logo-text text-2xl font-bold gradient-text">UXperience</span>
                </a>
            </div>
            
            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-reverse space-x-8">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" data-text="الرئيسية">الرئيسية</a>
                <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" data-text="من أنا">من أنا</a>
                <a href="{{ route('projects') }}" class="nav-link {{ request()->routeIs('projects*') ? 'active' : '' }}" data-text="المشاريع">المشاريع</a>
                <a href="{{ route('services') }}" class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}" data-text="الخدمات">الخدمات</a>
                <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" data-text="التواصل">التواصل</a>
            </div>
            
            <!-- CTA Button -->
            <div class="hidden md:flex items-center space-x-reverse space-x-4">
                <a href="{{ route('contact') }}" class="cta-button group relative overflow-hidden bg-gradient-to-r from-primary to-accent text-white px-6 py-3 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                    <span class="relative z-10">تواصل معي</span>
                    <div class="absolute inset-0 bg-gradient-to-r from-accent to-primary opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
            </div>
            
            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="mobile-menu-btn" class="mobile-menu-toggle p-3 rounded-xl glass-effect transition-all duration-300 hover:scale-110">
                    <div class="hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile Overlay -->
    <div class="mobile-overlay" style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 1000; opacity: 0; visibility: hidden; transition: all 0.3s ease;"></div>
    
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="mobile-menu">
        <div class="mobile-menu-content px-2 py-4 space-y-2">
            <!-- Navigation Links -->
            <nav class="w-full flex flex-col gap-1">
                <a href="{{ route('home') }}" class="mobile-nav-link{{ request()->routeIs('home') ? ' active' : '' }}">
                    <i class="fas fa-home mr-2 text-lg"></i> الرئيسية
                </a>
                <a href="{{ route('about') }}" class="mobile-nav-link{{ request()->routeIs('about') ? ' active' : '' }}">
                    <i class="fas fa-user mr-2 text-lg"></i> من أنا
                </a>
                <a href="{{ route('projects') }}" class="mobile-nav-link{{ request()->routeIs('projects*') ? ' active' : '' }}">
                    <i class="fas fa-briefcase mr-2 text-lg"></i> المشاريع
                </a>
                <a href="{{ route('services') }}" class="mobile-nav-link{{ request()->routeIs('services') ? ' active' : '' }}">
                    <i class="fas fa-cogs mr-2 text-lg"></i> الخدمات
                </a>
                <a href="{{ route('contact') }}" class="mobile-nav-link{{ request()->routeIs('contact') ? ' active' : '' }}">
                    <i class="fas fa-envelope mr-2 text-lg"></i> التواصل
                </a>
            </nav>
            <!-- CTA Button -->
            <div class="pt-6 w-full flex justify-center mt-auto">
                <a href="{{ route('contact') }}" class="mobile-cta-button bg-gradient-to-r from-primary to-accent text-white px-5 py-2 rounded-full font-semibold flex items-center gap-2 shadow-lg">
                    <i class="fas fa-paper-plane text-lg"></i>
                    تواصل معي
                </a>
            </div>
        </div>
    </div>
</nav>

<style>
/* Enhanced Header Styles */
#main-nav {
    background: rgba(255, 255, 255, 1);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

#main-nav.scrolled {
    background: rgba(255, 255, 255, 1);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}

#main-nav.scrolled .nav-link {
    color: #374151;
}

#main-nav.scrolled .logo-text {
    background: linear-gradient(135deg, #6366f1 0%, #ec4899 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Logo Animation */
.logo-container:hover .logo-icon {
    animation: logoFloat 0.6s ease-in-out;
}

@keyframes logoFloat {
    0%, 100% { transform: translateY(0) rotate(0deg) scale(1); }
    50% { transform: translateY(-5px) rotate(6deg) scale(1.1); }
}

/* Enhanced Nav Links */
.nav-link {
    position: relative;
    padding: 0.75rem 1.25rem;
    color: #374151;
    font-weight: 600;
    border-radius: 12px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
}

.nav-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.nav-link:hover::before {
    left: 100%;
}

.nav-link::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, #6366f1, #ec4899);
    transition: all 0.3s ease;
    transform: translateX(-50%);
}

.nav-link:hover,
.nav-link.active {
    background: rgba(99, 102, 241, 0.1);
    color: #6366f1;
    transform: translateY(-2px);
}

.nav-link:hover::after,
.nav-link.active::after {
    width: 80%;
}

/* Mobile Menu */
.mobile-overlay {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.5);
    z-index: 1000;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.mobile-menu {
    position: fixed;
    top: 0; right: 0; left: 0;
    z-index: 1010; /* أعلى من التمويه */
    background: #fff;
    box-shadow: 0 2px 20px rgba(0,0,0,0.15);
    transform: translateY(-100%);
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
}

.mobile-menu.mobile-open {
    transform: translateY(0);
    opacity: 1;
    visibility: visible;
}

.mobile-menu-content {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    background: #f8fafc;
    border-radius: 1rem;
    box-shadow: 0 4px 16px rgba(99,102,241,0.06);
    min-width: 0;
    max-width: 100vw;
    margin: 0 auto;
    align-items: stretch;
    height: 100%;
    position: relative;
}

.mobile-menu-content .gradient-text {
    font-size: 2rem;
    font-weight: 800;
    letter-spacing: 1px;
    margin-bottom: 0.25rem;
    text-align: center;
    background: linear-gradient(90deg, #6366f1 0%, #ec4899 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.mobile-menu-content .text-xs {
    text-align: center;
    color: #a1a1aa;
    margin-bottom: 0.5rem;
}

.mobile-menu-content nav {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.mobile-nav-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.65rem 1rem;
    color: #374151;
    font-weight: 600;
    border-radius: 0.75rem;
    transition: all 0.3s cubic-bezier(0.4,0,0.2,1), box-shadow 0.3s;
    text-align: right;
    position: relative;
    background: transparent;
    box-shadow: none;
    font-size: 1rem;
}

.mobile-nav-link i {
    color: #6366f1;
    min-width: 22px;
    text-align: center;
    font-size: 1.1rem;
    transition: color 0.3s;
}

.mobile-nav-link.active {
    background: linear-gradient(90deg, #6366f1 0%, #ec4899 100%);
    color: #fff;
    box-shadow: 0 2px 8px rgba(99,102,241,0.10);
    transform: scale(1.03);
    z-index: 2;
}

.mobile-nav-link.active i {
    color: #fff;
    text-shadow: 0 2px 8px #6366f1;
}

.mobile-nav-link.active::after {
    content: '';
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    width: 8px;
    height: 8px;
    background: #fff;
    border-radius: 50%;
    box-shadow: 0 0 0 2px #ec4899;
    opacity: 0.7;
}

.mobile-nav-link:hover {
    background: rgba(99,102,241,0.08);
    color: #6366f1;
    box-shadow: none;
    transform: scale(1.02);
}

.mobile-nav-link:hover i {
    color: #6366f1;
}

.mobile-cta-button {
    margin-top: 1rem;
    font-size: 1rem;
    font-weight: 700;
    box-shadow: 0 2px 8px rgba(99,102,241,0.10);
    transition: transform 0.2s;
    background: linear-gradient(90deg, #6366f1 0%, #ec4899 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    border-radius: 999px;
    padding: 0.65rem 1.5rem;
    position: absolute;
    left: 50%;
    bottom: 1.5rem;
    transform: translateX(-50%);
    width: calc(100% - 2rem);
}

.mobile-cta-button i {
    color: #fff;
    font-size: 1.1rem;
}

.mobile-cta-button:hover {
    transform: scale(1.05) translateX(-50%);
    box-shadow: 0 4px 16px rgba(99,102,241,0.18);
}

/* Hamburger Animation */
.hamburger {
    width: 24px;
    height: 18px;
    position: relative;
    cursor: pointer;
}

.hamburger span {
    display: block;
    position: absolute;
    height: 2px;
    width: 100%;
    background: #374151;
    border-radius: 2px;
    opacity: 1;
    left: 0;
    transform: rotate(0deg);
    transition: 0.25s ease-in-out;
}

.hamburger span:nth-child(1) {
    top: 0px;
}

.hamburger span:nth-child(2) {
    top: 8px;
}

.hamburger span:nth-child(3) {
    top: 16px;
}

.mobile-menu-toggle.active .hamburger span:nth-child(1) {
    top: 8px;
    transform: rotate(135deg);
}

.mobile-menu-toggle.active .hamburger span:nth-child(2) {
    opacity: 0;
    left: -60px;
}

.mobile-menu-toggle.active .hamburger span:nth-child(3) {
    top: 8px;
    transform: rotate(-135deg);
}

/* Glass Effect */
.glass-effect {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

/* CTA Button Enhancement */
.cta-button {
    position: relative;
    overflow: hidden;
}

.cta-button::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.6s;
}

.cta-button:hover::before {
    left: 100%;
}

/* Responsive Design */
@media (max-width: 768px) {
    .nav-container {
        padding: 0 1rem;
    }
    
    .logo-text {
        font-size: 1.5rem;
    }
    
    .logo-icon {
        width: 2.5rem;
        height: 2.5rem;
    }
}

/* Scroll Indicator */
.scroll-progress {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 2px;
    background: linear-gradient(90deg, #6366f1, #ec4899);
    transition: width 0.1s ease;
}
</style>

<script>
// Scroll Effect Only
document.addEventListener('DOMContentLoaded', function() {
    const nav = document.getElementById('main-nav');
    let lastScrollY = window.scrollY;
    
    function handleScroll() {
        const currentScrollY = window.scrollY;
        
        if (currentScrollY > 50) {
            nav.classList.add('scrolled');
        } else {
            nav.classList.remove('scrolled');
        }
        
        if (currentScrollY > lastScrollY && currentScrollY > 100) {
            nav.style.transform = 'translateY(-100%)';
        } else {
            nav.style.transform = 'translateY(0)';
        }
        
        lastScrollY = currentScrollY;
    }
    
    window.addEventListener('scroll', handleScroll, { passive: true });
});
</script>