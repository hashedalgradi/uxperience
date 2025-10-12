/**
 * Enhanced Navigation JavaScript
 * Handles all navigation interactions, animations, and scroll effects
 */

class EnhancedNavigation {
    constructor() {
        this.nav = document.getElementById('main-nav');
        this.mobileMenuBtn = document.getElementById('mobile-menu-btn');
        this.mobileMenu = document.getElementById('mobile-menu');
        this.scrollTopBtn = document.getElementById('scroll-to-top');
        
        this.lastScrollY = window.scrollY;
        this.scrollThreshold = 50;
        this.hideThreshold = 100;
        this.isScrolling = false;
        
        this.init();
    }
    
    init() {
        this.bindEvents();
        this.createScrollProgress();
        this.handleInitialScroll();
    }
    
    bindEvents() {
        // Scroll events
        window.addEventListener('scroll', this.throttle(this.handleScroll.bind(this), 16), { passive: true });
        
        // Mobile menu events
        if (this.mobileMenuBtn && this.mobileMenu) {
            this.mobileMenuBtn.addEventListener('click', this.toggleMobileMenu.bind(this));
        }
        
        // Close mobile menu on link click
        document.querySelectorAll('.mobile-nav-link').forEach(link => {
            link.addEventListener('click', this.closeMobileMenu.bind(this));
        });
        
        // Close mobile menu on outside click
        document.addEventListener('click', this.handleOutsideClick.bind(this));
        
        // Scroll to top button
        if (this.scrollTopBtn) {
            this.scrollTopBtn.addEventListener('click', this.scrollToTop.bind(this));
        }
        
        // Keyboard navigation
        document.addEventListener('keydown', this.handleKeyboard.bind(this));
        
        // Resize events
        window.addEventListener('resize', this.throttle(this.handleResize.bind(this), 250));
        
        // Navigation link hover effects
        this.addNavLinkEffects();
    }
    
    handleScroll() {
        const currentScrollY = window.scrollY;
        
        // Add/remove scrolled class
        if (currentScrollY > this.scrollThreshold) {
            this.nav.classList.add('scrolled');
        } else {
            this.nav.classList.remove('scrolled');
        }
        
        // Hide/show navigation on scroll
        if (currentScrollY > this.hideThreshold) {
            if (currentScrollY > this.lastScrollY) {
                // Scrolling down
                this.nav.style.transform = 'translateY(-100%)';
            } else {
                // Scrolling up
                this.nav.style.transform = 'translateY(0)';
            }
        } else {
            this.nav.style.transform = 'translateY(0)';
        }
        
        // Update scroll progress
        this.updateScrollProgress();
        
        // Show/hide scroll to top button
        this.toggleScrollTopButton(currentScrollY);
        
        this.lastScrollY = currentScrollY;
    }
    
    createScrollProgress() {
        const progressBar = document.createElement('div');
        progressBar.className = 'scroll-progress';
        progressBar.id = 'scroll-progress';
        this.nav.appendChild(progressBar);
    }
    
    updateScrollProgress() {
        const progressBar = document.getElementById('scroll-progress');
        if (!progressBar) return;
        
        const windowHeight = document.documentElement.scrollHeight - window.innerHeight;
        const scrolled = (window.scrollY / windowHeight) * 100;
        progressBar.style.width = `${Math.min(scrolled, 100)}%`;
    }
    
    toggleMobileMenu() {
        const isActive = this.mobileMenuBtn.classList.contains('active');
        
        if (isActive) {
            this.closeMobileMenu();
        } else {
            this.openMobileMenu();
        }
    }
    
    openMobileMenu() {
        this.mobileMenuBtn.classList.add('active');
        this.mobileMenu.classList.add('active');
        document.body.style.overflow = 'hidden';
        
        // Add stagger animation to menu items
        const menuItems = this.mobileMenu.querySelectorAll('.mobile-nav-link');
        menuItems.forEach((item, index) => {
            item.style.animationDelay = `${index * 0.1}s`;
            item.classList.add('fade-in-up');
        });
        
        // Focus management
        this.mobileMenu.querySelector('.mobile-nav-link')?.focus();
    }
    
    closeMobileMenu() {
        this.mobileMenuBtn.classList.remove('active');
        this.mobileMenu.classList.remove('active');
        document.body.style.overflow = '';
        
        // Remove animation classes
        const menuItems = this.mobileMenu.querySelectorAll('.mobile-nav-link');
        menuItems.forEach(item => {
            item.classList.remove('fade-in-up');
            item.style.animationDelay = '';
        });
    }
    
    handleOutsideClick(e) {
        if (!this.nav.contains(e.target) && this.mobileMenu.classList.contains('active')) {
            this.closeMobileMenu();
        }
    }
    
    handleKeyboard(e) {
        // Close mobile menu on Escape
        if (e.key === 'Escape' && this.mobileMenu.classList.contains('active')) {
            this.closeMobileMenu();
        }
        
        // Navigate with arrow keys in mobile menu
        if (this.mobileMenu.classList.contains('active')) {
            const menuItems = Array.from(this.mobileMenu.querySelectorAll('.mobile-nav-link'));
            const currentIndex = menuItems.indexOf(document.activeElement);
            
            if (e.key === 'ArrowDown' && currentIndex < menuItems.length - 1) {
                e.preventDefault();
                menuItems[currentIndex + 1].focus();
            } else if (e.key === 'ArrowUp' && currentIndex > 0) {
                e.preventDefault();
                menuItems[currentIndex - 1].focus();
            }
        }
    }
    
    handleResize() {
        // Close mobile menu on resize to desktop
        if (window.innerWidth >= 768 && this.mobileMenu.classList.contains('active')) {
            this.closeMobileMenu();
        }
    }
    
    scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
    
    toggleScrollTopButton(scrollY) {
        if (!this.scrollTopBtn) return;
        
        if (scrollY > 300) {
            this.scrollTopBtn.classList.add('visible');
        } else {
            this.scrollTopBtn.classList.remove('visible');
        }
    }
    
    addNavLinkEffects() {
        const navLinks = document.querySelectorAll('.nav-link, .mobile-nav-link');
        
        navLinks.forEach(link => {
            // Add ripple effect on click
            link.addEventListener('click', this.createRipple.bind(this));
            
            // Add magnetic effect on hover (desktop only)
            if (window.innerWidth >= 768) {
                link.addEventListener('mouseenter', this.addMagneticEffect.bind(this));
                link.addEventListener('mouseleave', this.removeMagneticEffect.bind(this));
            }
        });
    }
    
    createRipple(e) {
        const button = e.currentTarget;
        const rect = button.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;
        
        const ripple = document.createElement('div');
        ripple.style.cssText = `
            position: absolute;
            width: ${size}px;
            height: ${size}px;
            left: ${x}px;
            top: ${y}px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.3) 0%, transparent 70%);
            border-radius: 50%;
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
            z-index: 1;
        `;
        
        button.style.position = 'relative';
        button.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    }
    
    addMagneticEffect(e) {
        const element = e.currentTarget;
        const rect = element.getBoundingClientRect();
        
        const handleMouseMove = (moveEvent) => {
            const x = moveEvent.clientX - rect.left - rect.width / 2;
            const y = moveEvent.clientY - rect.top - rect.height / 2;
            
            const distance = Math.sqrt(x * x + y * y);
            const maxDistance = 50;
            
            if (distance < maxDistance) {
                const strength = (maxDistance - distance) / maxDistance;
                const moveX = x * strength * 0.3;
                const moveY = y * strength * 0.3;
                
                element.style.transform = `translate(${moveX}px, ${moveY}px)`;
            }
        };
        
        element.addEventListener('mousemove', handleMouseMove);
        element._magneticHandler = handleMouseMove;
    }
    
    removeMagneticEffect(e) {
        const element = e.currentTarget;
        element.style.transform = '';
        
        if (element._magneticHandler) {
            element.removeEventListener('mousemove', element._magneticHandler);
            delete element._magneticHandler;
        }
    }
    
    handleInitialScroll() {
        // Handle initial scroll position on page load
        this.handleScroll();
    }
    
    // Utility function for throttling
    throttle(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    }
    
    // Public methods for external use
    showNavigation() {
        this.nav.style.transform = 'translateY(0)';
    }
    
    hideNavigation() {
        this.nav.style.transform = 'translateY(-100%)';
    }
    
    setActiveLink(route) {
        document.querySelectorAll('.nav-link').forEach(link => {
            link.classList.remove('active');
        });
        
        const activeLink = document.querySelector(`[href*="${route}"]`);
        if (activeLink) {
            activeLink.classList.add('active');
        }
    }
}

// Enhanced Footer Interactions
class EnhancedFooter {
    constructor() {
        this.footer = document.querySelector('.enhanced-footer');
        this.newsletterForm = document.querySelector('.newsletter-form');
        this.socialLinks = document.querySelectorAll('.social-link');
        
        this.init();
    }
    
    init() {
        this.bindEvents();
        this.initIntersectionObserver();
        this.addParallaxEffect();
    }
    
    bindEvents() {
        // Newsletter form
        if (this.newsletterForm) {
            this.newsletterForm.addEventListener('submit', this.handleNewsletterSubmit.bind(this));
        }
        
        // Social links ripple effect
        this.socialLinks.forEach(link => {
            link.addEventListener('click', this.createSocialRipple.bind(this));
        });
        
        // Contact items hover effect
        document.querySelectorAll('.contact-item').forEach(item => {
            item.addEventListener('mouseenter', this.animateContactItem.bind(this));
        });
    }
    
    handleNewsletterSubmit(e) {
        e.preventDefault();
        const email = this.newsletterForm.querySelector('input[type="email"]').value;
        const button = this.newsletterForm.querySelector('.newsletter-btn');
        
        if (email && this.validateEmail(email)) {
            // Add loading state
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري الإرسال...';
            button.disabled = true;
            
            // Simulate API call
            setTimeout(() => {
                this.showNotification('تم تسجيل اشتراكك بنجاح! شكراً لك.', 'success');
                this.newsletterForm.reset();
                button.innerHTML = 'اشتراك';
                button.disabled = false;
            }, 2000);
        } else {
            this.showNotification('يرجى إدخال بريد إلكتروني صحيح', 'error');
        }
    }
    
    validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
    
    showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                <span>${message}</span>
            </div>
        `;
        
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${type === 'success' ? '#10b981' : '#ef4444'};
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            z-index: 10000;
            transform: translateX(100%);
            transition: transform 0.3s ease;
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 100);
        
        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => notification.remove(), 300);
        }, 4000);
    }
    
    createSocialRipple(e) {
        const link = e.currentTarget;
        const ripple = link.querySelector('.social-ripple');
        
        if (ripple) {
            ripple.style.animation = 'none';
            ripple.offsetHeight; // Trigger reflow
            ripple.style.animation = 'rippleEffect 0.6s ease-out';
        }
    }
    
    animateContactItem(e) {
        const item = e.currentTarget;
        const icon = item.querySelector('.contact-icon');
        
        if (icon) {
            icon.style.transform = 'scale(1.1) rotate(5deg)';
            setTimeout(() => {
                icon.style.transform = '';
            }, 300);
        }
    }
    
    initIntersectionObserver() {
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
    }
    
    addParallaxEffect() {
        if (window.innerWidth < 768) return; // Skip on mobile
        
        const particles = document.querySelectorAll('.floating-particles .particle');
        
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.5;
            
            particles.forEach((particle, index) => {
                const speed = (index % 3 + 1) * 0.1;
                particle.style.transform = `translateY(${rate * speed}px)`;
            });
        }, { passive: true });
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    // Initialize enhanced navigation
    window.enhancedNav = new EnhancedNavigation();
    
    // Initialize enhanced footer
    window.enhancedFooter = new EnhancedFooter();
    
    // Add CSS for ripple animation if not already present
    if (!document.getElementById('ripple-styles')) {
        const style = document.createElement('style');
        style.id = 'ripple-styles';
        style.textContent = `
            @keyframes ripple {
                0% {
                    transform: scale(0);
                    opacity: 0.8;
                }
                100% {
                    transform: scale(4);
                    opacity: 0;
                }
            }
            
            .fade-in-up {
                animation: fadeInUp 0.6s ease-out forwards;
            }
            
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            .notification-content {
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }
        `;
        document.head.appendChild(style);
    }
});

// Export for module use
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { EnhancedNavigation, EnhancedFooter };
}