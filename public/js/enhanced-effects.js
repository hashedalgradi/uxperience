// Enhanced JavaScript for Creative Effects
function createEnhancedCardRipple(card) {
    card.addEventListener('click', function(e) {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        
        const ripple = document.createElement('div');
        ripple.className = 'js-ripple';
        ripple.style.left = x + 'px';
        ripple.style.top = y + 'px';
        ripple.style.width = '0px';
        ripple.style.height = '0px';
        
        card.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    });
}

function removeCardEffects(card) {
    const ripples = card.querySelectorAll('.js-ripple');
    ripples.forEach(ripple => ripple.remove());
}

// Scroll Reveal Animation
function initScrollReveal() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.scroll-reveal').forEach(el => {
        observer.observe(el);
    });
}

// Enhanced Mobile Performance
function optimizeForMobile() {
    if (window.innerWidth < 768) {
        // Reduce animation complexity on mobile
        document.querySelectorAll('.floating-shape').forEach(shape => {
            shape.style.animationDuration = '15s';
        });
        
        // Simplify 3D scene for mobile
        const threeContainer = document.getElementById('three-container');
        if (threeContainer) {
            threeContainer.style.opacity = '0.7';
        }
    }
}

// Initialize on DOM load
document.addEventListener('DOMContentLoaded', function() {
    initScrollReveal();
    optimizeForMobile();
    
    // Add enhanced hover effects to project cards
    document.querySelectorAll('.project-card').forEach(card => {
        createEnhancedCardRipple(card);
    });
});

// Resize handler for responsive optimizations
window.addEventListener('resize', optimizeForMobile);