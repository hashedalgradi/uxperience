/**
 * Scene Effects Controller - تحكم في التأثيرات المتقدمة للمشهد
 * يدير التأثيرات البصرية والتفاعلية للمشهد الثلاثي الأبعاد
 */

class SceneEffectsController {
    constructor() {
        this.isInitialized = false;
        this.effects = {
            particles: true,
            glow: true,
            hologram: true,
            lighting: true,
            interaction: true
        };
        
        this.performance = {
            fps: 60,
            quality: 'high',
            adaptiveQuality: true
        };
        
        this.init();
    }

    init() {
        this.detectPerformance();
        this.setupEffects();
        this.bindEvents();
        this.startPerformanceMonitoring();
        this.isInitialized = true;
    }

    detectPerformance() {
        // كشف قدرات الجهاز
        const canvas = document.createElement('canvas');
        const gl = canvas.getContext('webgl') || canvas.getContext('experimental-webgl');
        
        if (!gl) {
            this.performance.quality = 'low';
            this.effects.particles = false;
            this.effects.hologram = false;
            return;
        }

        // فحص الذاكرة المتاحة
        const memory = navigator.deviceMemory || 4;
        const cores = navigator.hardwareConcurrency || 4;
        
        if (memory < 4 || cores < 4) {
            this.performance.quality = 'medium';
            this.effects.particles = true;
            this.effects.hologram = false;
        }

        // كشف الأجهزة المحمولة
        if (window.innerWidth < 768 || /Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            this.performance.quality = 'low';
            this.effects.particles = false;
            this.effects.glow = false;
        }
    }

    setupEffects() {
        this.setupLoadingEffect();
        this.setupParticleSystem();
        this.setupGlowEffects();
        this.setupHologramEffect();
        this.setupLightingEffects();
        this.setupInteractionEffects();
    }

    setupLoadingEffect() {
        const loadingElement = document.querySelector('.scene-loading');
        if (!loadingElement) return;

        // إخفاء مؤشر التحميل بعد تحميل المشهد
        const hideLoading = () => {
            loadingElement.style.opacity = '0';
            loadingElement.style.transform = 'translate(-50%, -50%) scale(0.8)';
            
            setTimeout(() => {
                loadingElement.style.display = 'none';
            }, 600);
        };

        // انتظار تحميل Three.js والمشهد
        const checkSceneReady = () => {
            if (window.enhanced3DScene && window.enhanced3DScene.renderer) {
                setTimeout(hideLoading, 1000);
            } else {
                setTimeout(checkSceneReady, 100);
            }
        };
        
        checkSceneReady();
    }

    setupParticleSystem() {
        if (!this.effects.particles) return;

        const particlesContainer = document.querySelector('.enhanced-particles');
        if (!particlesContainer) return;

        // إضافة جسيمات ديناميكية
        this.createDynamicParticles(particlesContainer);
        
        // تأثير الماوس على الجسيمات
        this.setupParticleInteraction(particlesContainer);
    }

    createDynamicParticles(container) {
        const particleCount = this.performance.quality === 'high' ? 20 : 10;
        
        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle-enhanced';
            
            // خصائص عشوائية
            const size = Math.random() * 4 + 2;
            const speed = Math.random() * 15 + 10;
            const delay = Math.random() * 15;
            
            particle.style.cssText = `
                left: ${Math.random() * 100}%;
                width: ${size}px;
                height: ${size}px;
                animation-duration: ${speed}s;
                animation-delay: ${delay}s;
            `;
            
            container.appendChild(particle);
            
            // إعادة تدوير الجسيمة
            particle.addEventListener('animationend', () => {
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = '0s';
            });
        }
    }

    setupParticleInteraction(container) {
        const interactiveOverlay = document.querySelector('.interactive-overlay');
        if (!interactiveOverlay) return;

        let mouseX = 0;
        let mouseY = 0;

        interactiveOverlay.addEventListener('mousemove', (e) => {
            const rect = interactiveOverlay.getBoundingClientRect();
            mouseX = (e.clientX - rect.left) / rect.width;
            mouseY = (e.clientY - rect.top) / rect.height;

            // تأثير الجسيمات حول الماوس
            this.createMouseParticles(container, e.clientX - rect.left, e.clientY - rect.top);
        });
    }

    createMouseParticles(container, x, y) {
        if (Math.random() > 0.7) return; // تقليل التكرار

        const particle = document.createElement('div');
        particle.className = 'mouse-particle';
        particle.style.cssText = `
            position: absolute;
            left: ${x}px;
            top: ${y}px;
            width: 6px;
            height: 6px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.8) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            animation: mouse-particle-fade 1s ease-out forwards;
        `;

        container.appendChild(particle);

        // إزالة الجسيمة بعد انتهاء الحركة
        setTimeout(() => {
            if (particle.parentNode) {
                particle.parentNode.removeChild(particle);
            }
        }, 1000);
    }

    setupGlowEffects() {
        if (!this.effects.glow) return;

        const glowElement = document.querySelector('.screen-glow');
        if (!glowElement) return;

        // تأثير النبض المتقدم
        let glowIntensity = 0.3;
        let glowDirection = 1;

        const animateGlow = () => {
            glowIntensity += glowDirection * 0.01;
            
            if (glowIntensity >= 0.6) glowDirection = -1;
            if (glowIntensity <= 0.3) glowDirection = 1;

            glowElement.style.opacity = glowIntensity;
            
            if (this.effects.glow) {
                requestAnimationFrame(animateGlow);
            }
        };

        animateGlow();
    }

    setupHologramEffect() {
        if (!this.effects.hologram) return;

        const hologramElement = document.querySelector('.hologram-effect');
        if (!hologramElement) return;

        // تأثير المسح الهولوجرامي
        let scanPosition = 0;
        
        const animateHologram = () => {
            scanPosition += 0.5;
            if (scanPosition > 100) scanPosition = -20;

            hologramElement.style.backgroundPosition = `${scanPosition}px ${scanPosition}px`;
            
            if (this.effects.hologram) {
                requestAnimationFrame(animateHologram);
            }
        };

        animateHologram();
    }

    setupLightingEffects() {
        if (!this.effects.lighting) return;

        const lightingElement = document.querySelector('.advanced-lighting');
        if (!lightingElement) return;

        // تأثير الإضاءة الديناميكية
        let lightAngle = 0;
        
        const animateLighting = () => {
            lightAngle += 0.5;
            
            const intensity1 = 0.1 + Math.sin(lightAngle * 0.01) * 0.05;
            const intensity2 = 0.1 + Math.cos(lightAngle * 0.015) * 0.05;
            const intensity3 = 0.05 + Math.sin(lightAngle * 0.008) * 0.03;

            lightingElement.style.background = `
                radial-gradient(circle at 20% 30%, rgba(99, 102, 241, ${intensity1}) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(236, 72, 153, ${intensity2}) 0%, transparent 50%),
                radial-gradient(circle at 50% 50%, rgba(0, 255, 255, ${intensity3}) 0%, transparent 70%)
            `;
            
            if (this.effects.lighting) {
                requestAnimationFrame(animateLighting);
            }
        };

        animateLighting();
    }

    setupInteractionEffects() {
        if (!this.effects.interaction) return;

        const interactiveOverlay = document.querySelector('.interactive-overlay');
        const interactionHint = document.querySelector('.interaction-hint');
        
        if (!interactiveOverlay || !interactionHint) return;

        let hintVisible = true;
        let hintTimeout;

        // إخفاء التلميح عند التفاعل
        const hideHint = () => {
            if (hintVisible) {
                interactionHint.style.opacity = '0';
                interactionHint.style.transform = 'translateX(-50%) translateY(20px)';
                hintVisible = false;
            }
        };

        // إظهار التلميح مرة أخرى بعد فترة عدم نشاط
        const showHint = () => {
            if (!hintVisible) {
                interactionHint.style.opacity = '0.7';
                interactionHint.style.transform = 'translateX(-50%) translateY(0)';
                hintVisible = true;
            }
        };

        // أحداث التفاعل
        interactiveOverlay.addEventListener('mousemove', () => {
            hideHint();
            clearTimeout(hintTimeout);
            hintTimeout = setTimeout(showHint, 3000);
        });

        interactiveOverlay.addEventListener('mouseleave', () => {
            clearTimeout(hintTimeout);
            hintTimeout = setTimeout(showHint, 1000);
        });

        // تفاعل لوحة المفاتيح
        interactiveOverlay.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                this.triggerSpecialEffect();
            }
        });
    }

    triggerSpecialEffect() {
        // تأثير خاص عند الضغط على مفتاح
        const container = document.querySelector('#three-container');
        if (!container) return;

        const flash = document.createElement('div');
        flash.style.cssText = `
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.3) 0%, transparent 70%);
            pointer-events: none;
            z-index: 5;
            animation: flash-effect 0.5s ease-out;
        `;

        container.appendChild(flash);

        setTimeout(() => {
            if (flash.parentNode) {
                flash.parentNode.removeChild(flash);
            }
        }, 500);
    }

    bindEvents() {
        // تغيير حجم النافذة
        window.addEventListener('resize', () => {
            this.detectPerformance();
            this.adjustEffectsForSize();
        });

        // تغيير التبويب
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                this.pauseEffects();
            } else {
                this.resumeEffects();
            }
        });

        // توفير الطاقة
        window.addEventListener('beforeunload', () => {
            this.cleanup();
        });
    }

    startPerformanceMonitoring() {
        if (!this.performance.adaptiveQuality) return;

        let frameCount = 0;
        let lastTime = performance.now();

        const monitor = () => {
            frameCount++;
            const currentTime = performance.now();
            
            if (currentTime - lastTime >= 1000) {
                const fps = frameCount;
                frameCount = 0;
                lastTime = currentTime;

                // تعديل الجودة حسب الأداء
                if (fps < 30 && this.performance.quality !== 'low') {
                    this.downgradeQuality();
                } else if (fps > 50 && this.performance.quality !== 'high') {
                    this.upgradeQuality();
                }
            }

            if (this.isInitialized) {
                requestAnimationFrame(monitor);
            }
        };

        monitor();
    }

    downgradeQuality() {
        if (this.performance.quality === 'high') {
            this.performance.quality = 'medium';
            this.effects.hologram = false;
        } else if (this.performance.quality === 'medium') {
            this.performance.quality = 'low';
            this.effects.particles = false;
            this.effects.glow = false;
        }
        
        console.log('تم تقليل جودة التأثيرات لتحسين الأداء');
    }

    upgradeQuality() {
        if (this.performance.quality === 'low') {
            this.performance.quality = 'medium';
            this.effects.particles = true;
            this.effects.glow = true;
        } else if (this.performance.quality === 'medium') {
            this.performance.quality = 'high';
            this.effects.hologram = true;
        }
        
        console.log('تم تحسين جودة التأثيرات');
    }

    adjustEffectsForSize() {
        const width = window.innerWidth;
        
        if (width < 768) {
            this.effects.particles = false;
            this.effects.hologram = false;
        } else if (width < 1024) {
            this.effects.particles = true;
            this.effects.hologram = false;
        } else {
            this.effects.particles = true;
            this.effects.hologram = true;
        }
    }

    pauseEffects() {
        this.effects.particles = false;
        this.effects.glow = false;
        this.effects.hologram = false;
        this.effects.lighting = false;
    }

    resumeEffects() {
        this.detectPerformance();
        this.effects.particles = true;
        this.effects.glow = true;
        this.effects.hologram = this.performance.quality === 'high';
        this.effects.lighting = true;
    }

    cleanup() {
        this.isInitialized = false;
        this.pauseEffects();
        
        // إزالة العناصر المؤقتة
        const mouseParticles = document.querySelectorAll('.mouse-particle');
        mouseParticles.forEach(particle => {
            if (particle.parentNode) {
                particle.parentNode.removeChild(particle);
            }
        });
    }
}

// إضافة الأنماط المطلوبة
const style = document.createElement('style');
style.textContent = `
    @keyframes mouse-particle-fade {
        0% {
            opacity: 1;
            transform: scale(1);
        }
        100% {
            opacity: 0;
            transform: scale(2) translateY(-20px);
        }
    }
    
    @keyframes flash-effect {
        0% {
            opacity: 0;
        }
        50% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

// تهيئة التحكم في التأثيرات
document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('three-container')) {
        window.sceneEffectsController = new SceneEffectsController();
    }
});

// تصدير للاستخدام كوحدة
if (typeof module !== 'undefined' && module.exports) {
    module.exports = SceneEffectsController;
}