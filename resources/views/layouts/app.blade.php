<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'UXperience - Portfolio')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/enhanced-header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/enhanced-footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/enhanced-animations.css') }}">
    <link rel="stylesheet" href="{{ asset('css/3d-scene.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mobile-menu-user.css') }}">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'cairo': ['Cairo', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                            DEFAULT: '#0ea5e9'
                        },
                        secondary: {
                            50: '#fefce8',
                            100: '#fef9c3',
                            200: '#fef08a',
                            300: '#fde047',
                            400: '#facc15',
                            500: '#eab308',
                            600: '#ca8a04',
                            700: '#a16207',
                            800: '#854d0e',
                            900: '#713f12',
                            DEFAULT: '#eab308'
                        },
                        accent: {
                            50: '#fdf2f8',
                            100: '#fce7f3',
                            200: '#fbcfe8',
                            300: '#f9a8d4',
                            400: '#f472b6',
                            500: '#ec4899',
                            600: '#db2777',
                            700: '#be185d',
                            800: '#9d174d',
                            900: '#831843',
                            DEFAULT: '#ec4899'
                        },
                        dark: '#0f172a',
                        surface: '#ffffff',
                        'surface-variant': '#f8fafc'
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'bounce-slow': 'bounce 3s infinite',
                        'fade-in-up': 'fadeInUp 0.8s ease-out',
                        'slide-in-right': 'slideInRight 0.6s ease-out',
                        'gradient-x': 'gradient-x 15s ease infinite',
                        'blob': 'blob 7s infinite',
                        'tilt': 'tilt 10s infinite linear'
                    },
                    boxShadow: {
                        'soft': '0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04)',
                        'medium': '0 4px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 30px -5px rgba(0, 0, 0, 0.05)',
                        'strong': '0 10px 40px -10px rgba(0, 0, 0, 0.15), 0 20px 50px -10px rgba(0, 0, 0, 0.1)'
                    }
                }
            }
        }
    </script>
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 50%, #4facfe 100%);
            --accent-gradient: linear-gradient(135deg, #43e97b 0%, #38f9d7 50%, #667eea 100%);
            --neon-gradient: linear-gradient(135deg, #ff006e 0%, #8338ec 50%, #3a86ff 100%);
            --rainbow-gradient: linear-gradient(135deg, #ff006e, #fb5607, #ffbe0b, #8338ec, #3a86ff);
            --glass-bg: rgba(255, 255, 255, 0.15);
            --glass-border: rgba(255, 255, 255, 0.25);
            --neon-glow: 0 0 20px rgba(255, 0, 110, 0.5), 0 0 40px rgba(131, 56, 236, 0.3), 0 0 60px rgba(58, 134, 255, 0.2);
        }
        
        * {
            scroll-behavior: smooth;
        }
        
        body { 
            font-family: 'Cairo', sans-serif;
            overflow-x: hidden;
            background: #0f0f23;
        }
        
        body.home-page {
            background: #0f0f23;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            25% { background-position: 100% 50%; }
            50% { background-position: 100% 100%; }
            75% { background-position: 0% 100%; }
            100% { background-position: 0% 50%; }
        }
        
        .glass-effect {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            box-shadow: var(--neon-glow);
            position: relative;
            overflow: hidden;
        }
        
        .glass-effect::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            animation: shimmer 3s infinite;
        }
        
        @keyframes shimmer {
            0% { left: -100%; }
            100% { left: 100%; }
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        
        .floating-shapes {
            position: fixed;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
            pointer-events: none;
        }
        
        .shape {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(45deg, rgba(255, 0, 110, 0.3), rgba(131, 56, 236, 0.3), rgba(58, 134, 255, 0.3));
            animation: float 20s infinite linear, morph 8s ease-in-out infinite;
            filter: blur(2px);
            box-shadow: 0 0 20px rgba(255, 0, 110, 0.4);
        }
        
        @keyframes morph {
            0%, 100% { border-radius: 50%; transform: scale(1); }
            25% { border-radius: 60% 40% 30% 70%; transform: scale(1.1); }
            50% { border-radius: 30% 60% 70% 40%; transform: scale(0.9); }
            75% { border-radius: 40% 30% 60% 50%; transform: scale(1.05); }
        }
        
        .gradient-text {
            background: var(--rainbow-gradient);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: rainbowShift 3s ease-in-out infinite;
        }
        
        @keyframes rainbowShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        .btn-primary {
            background: var(--neon-gradient);
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 2rem;
            font-weight: 700;
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--neon-glow);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.6), transparent);
            transition: left 0.6s;
        }
        
        .btn-primary:hover::before {
            left: 100%;
        }
        
        .btn-primary:hover {
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 0 30px rgba(255, 0, 110, 0.8), 0 0 60px rgba(131, 56, 236, 0.6);
            animation: pulse-neon 1.5s infinite;
        }
        
        @keyframes pulse-neon {
            0%, 100% { box-shadow: 0 0 30px rgba(255, 0, 110, 0.8), 0 0 60px rgba(131, 56, 236, 0.6); }
            50% { box-shadow: 0 0 40px rgba(255, 0, 110, 1), 0 0 80px rgba(131, 56, 236, 0.8); }
        }
        
        .btn-secondary {
            background: var(--glass-bg);
            backdrop-filter: blur(16px);
            color: #0f172a;
            border: 1px solid var(--glass-border);
            padding: 0.75rem 2rem;
            border-radius: 0.75rem;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.4);
            transform: translateY(-2px);
        }
        
        .card-hover {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: center;
            position: relative;
        }
        
        .card-hover::after {
            content: '';
            position: absolute;
            inset: -2px;
            background: var(--rainbow-gradient);
            border-radius: inherit;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.5s;
        }
        
        .card-hover:hover {
            transform: translateY(-15px) scale(1.05) rotateX(5deg);
            box-shadow: 0 30px 60px -12px rgba(255, 0, 110, 0.4), 0 0 40px rgba(131, 56, 236, 0.3);
        }
        
        .card-hover:hover::after {
            opacity: 1;
            animation: borderGlow 2s infinite;
        }
        
        @keyframes borderGlow {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 1; }
        }
        
        .scroll-reveal {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .scroll-reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }
        
        @keyframes float {
            0% { 
                transform: translateY(100vh) translateX(0) rotate(0deg) scale(0.5);
                opacity: 0;
            }
            10% { opacity: 0.8; }
            50% { 
                transform: translateY(50vh) translateX(50px) rotate(180deg) scale(1.2);
                opacity: 1;
            }
            90% { opacity: 0.8; }
            100% { 
                transform: translateY(-100px) translateX(100px) rotate(360deg) scale(0.5);
                opacity: 0;
            }
        }
        
        @keyframes gradient-x {
            0%, 100% { transform: translateX(0%); }
            50% { transform: translateX(100%); }
        }
        
        @keyframes blob {
            0% { 
                transform: translate(0px, 0px) scale(1) rotate(0deg);
                border-radius: 60% 40% 30% 70%;
            }
            25% { 
                transform: translate(50px, -30px) scale(1.2) rotate(90deg);
                border-radius: 30% 60% 70% 40%;
            }
            50% { 
                transform: translate(-30px, 40px) scale(0.8) rotate(180deg);
                border-radius: 70% 30% 40% 60%;
            }
            75% { 
                transform: translate(-50px, -20px) scale(1.1) rotate(270deg);
                border-radius: 40% 70% 60% 30%;
            }
            100% { 
                transform: translate(0px, 0px) scale(1) rotate(360deg);
                border-radius: 60% 40% 30% 70%;
            }
        }
        
        @keyframes tilt {
            0%, 50%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(1deg); }
            75% { transform: rotate(-1deg); }
        }
        
        @keyframes fadeInUp {
            from { 
                opacity: 0; 
                transform: translateY(60px);
            }
            to { 
                opacity: 1; 
                transform: translateY(0);
            }
        }
        
        @keyframes slideInRight {
            from { 
                opacity: 0; 
                transform: translateX(60px);
            }
            to { 
                opacity: 1; 
                transform: translateX(0);
            }
        }
        
        /* Smooth scrolling for all elements */
        html {
            scroll-behavior: smooth;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #0ea5e9, #3b82f6);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #0284c7, #2563eb);
        }
        
        /* Improved focus states */
        button:focus,
        a:focus,
        input:focus,
        textarea:focus {
            outline: 2px solid #0ea5e9;
            outline-offset: 2px;
        }
        
        /* Programming Icons Background */
        .programming-icons {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }
        
        .prog-icon {
            position: absolute;
            font-size: 14px;
            opacity: 0.4;
            animation: iconFloat 15s infinite linear;
            color: #6366f1;
        }
        
        @keyframes iconFloat {
            0% {
                transform: translateY(100vh) translateX(0) rotate(0deg);
                opacity: 0;
            }
            15% {
                opacity: 0.4;
            }
            85% {
                opacity: 0.4;
            }
            100% {
                transform: translateY(-80px) translateX(30px) rotate(180deg);
                opacity: 0;
            }
        }
        
        /* Magnetic Effect */
        .magnetic {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Neon Text Effect */
        .neon-text {
            color: #fff;
            text-shadow: 
                0 0 5px #ff006e,
                0 0 10px #ff006e,
                0 0 15px #ff006e,
                0 0 20px #8338ec,
                0 0 35px #8338ec,
                0 0 40px #3a86ff;
            animation: neonFlicker 2s infinite alternate;
        }
        
        @keyframes neonFlicker {
            0%, 18%, 22%, 25%, 53%, 57%, 100% {
                text-shadow: 
                    0 0 5px #ff006e,
                    0 0 10px #ff006e,
                    0 0 15px #ff006e,
                    0 0 20px #8338ec,
                    0 0 35px #8338ec,
                    0 0 40px #3a86ff;
            }
            20%, 24%, 55% {
                text-shadow: none;
            }
        }
        
        /* Holographic Effect */
        .holographic {
            background: linear-gradient(45deg, #ff006e, #8338ec, #3a86ff, #43e97b, #f5576c);
            background-size: 400% 400%;
            animation: holographicShift 4s ease infinite;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        @keyframes holographicShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* Reduced motion for accessibility */
        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body class="min-h-screen" style="background: #0f0f23;">
    <!-- Programming Icons Background -->
    <div class="programming-icons">
        <div class="prog-icon" style="left: 8%; animation-delay: 0s;">⚛️</div>
        <div class="prog-icon" style="left: 18%; animation-delay: 1s; color: #ec4899;">🔧</div>
        <div class="prog-icon" style="left: 28%; animation-delay: 2s; color: #f59e0b;">💻</div>
        <div class="prog-icon" style="left: 38%; animation-delay: 3s;">🎨</div>
        <div class="prog-icon" style="left: 48%; animation-delay: 4s; color: #ec4899;">📱</div>
        <div class="prog-icon" style="left: 58%; animation-delay: 5s; color: #f59e0b;">🌐</div>
        <div class="prog-icon" style="left: 68%; animation-delay: 6s;">⚡</div>
        <div class="prog-icon" style="left: 78%; animation-delay: 7s; color: #ec4899;">🚀</div>
        <div class="prog-icon" style="left: 88%; animation-delay: 8s; color: #f59e0b;">💡</div>
        <div class="prog-icon" style="left: 13%; animation-delay: 9s;">🔥</div>
        <div class="prog-icon" style="left: 23%; animation-delay: 10s; color: #ec4899;">✨</div>
        <div class="prog-icon" style="left: 33%; animation-delay: 11s; color: #f59e0b;">🎯</div>
        <div class="prog-icon" style="left: 43%; animation-delay: 12s;">📊</div>
        <div class="prog-icon" style="left: 53%; animation-delay: 13s; color: #ec4899;">🔒</div>
        <div class="prog-icon" style="left: 63%; animation-delay: 14s; color: #f59e0b;">🎪</div>
        <div class="prog-icon" style="left: 73%; animation-delay: 15s;">📲</div>
        <div class="prog-icon" style="left: 83%; animation-delay: 16s; color: #ec4899;">🔍</div>
        <div class="prog-icon" style="left: 93%; animation-delay: 17s; color: #f59e0b;">🛠️</div>
    </div>
    
    @include('components.header')

    <!-- Main Content -->
    <main class="pt-16">
        @yield('content')
    </main>

    @include('components.footer')

    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/enhanced-effects.js') }}"></script>
    <script src="{{ asset('js/enhanced-navigation.js') }}"></script>
    <script src="{{ asset('js/mobile-menu-user.js') }}"></script>
    
    @if(request()->routeIs('home'))
        <script src="{{ asset('js/scene-config.js') }}"></script>
        <script src="{{ asset('js/3d-scene.js') }}"></script>
        <script src="{{ asset('js/scene-effects.js') }}"></script>
        <script src="{{ asset('js/cursor-effect.js') }}"></script>
    @endif
    <!-- Enhanced Interactive Script -->
    <script>
        // Scroll Reveal Animation
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
        
        document.addEventListener('DOMContentLoaded', function() {
            // Observe all scroll-reveal elements
            document.querySelectorAll('.scroll-reveal').forEach(el => {
                observer.observe(el);
            });
            
            // Magnetic Effect for buttons and cards
            document.querySelectorAll('.magnetic').forEach(el => {
                el.addEventListener('mousemove', function(e) {
                    const rect = this.getBoundingClientRect();
                    const x = e.clientX - rect.left - rect.width / 2;
                    const y = e.clientY - rect.top - rect.height / 2;
                    
                    this.style.transform = `translate(${x * 0.1}px, ${y * 0.1}px) scale(1.02)`;
                });
                
                el.addEventListener('mouseleave', function() {
                    this.style.transform = 'translate(0px, 0px) scale(1)';
                });
            });
            
            // Cursor Trail Effect - Apply to all pages including home
            let mouseX = 0, mouseY = 0;
            let trailElements = [];
            
            // Create trail elements
            for (let i = 0; i < 8; i++) {
                const trail = document.createElement('div');
                trail.className = 'cursor-trail';
                trail.style.cssText = `
                    position: fixed;
                    width: 6px;
                    height: 6px;
                    background: radial-gradient(circle, #6366f1, #ec4899);
                    border-radius: 50%;
                    pointer-events: none;
                    z-index: 9999;
                    opacity: ${0.8 - i * 0.1};
                    transform: scale(${0.8 - i * 0.1});
                    transition: all 0.1s ease;
                `;
                document.body.appendChild(trail);
                trailElements.push(trail);
            }
            
            document.addEventListener('mousemove', function(e) {
                mouseX = e.clientX;
                mouseY = e.clientY;
                
                trailElements.forEach((trail, index) => {
                    setTimeout(() => {
                        trail.style.left = mouseX - 4 + 'px';
                        trail.style.top = mouseY - 4 + 'px';
                    }, index * 20);
                });
            });
            
            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
            
            // Enhanced button interactions
            document.querySelectorAll('.btn-primary, .btn-secondary').forEach(button => {
                button.addEventListener('click', function(e) {
                    // Create ripple effect
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.cssText = `
                        position: absolute;
                        width: ${size}px;
                        height: ${size}px;
                        left: ${x}px;
                        top: ${y}px;
                        background: radial-gradient(circle, rgba(255, 255, 255, 0.6), transparent);
                        border-radius: 50%;
                        transform: scale(0);
                        animation: ripple 0.6s linear;
                        pointer-events: none;
                    `;
                    
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
            
            // Add loading states to submit buttons
            document.querySelectorAll('button[type="submit"]').forEach(button => {
                button.addEventListener('click', function() {
                    if (this.form && this.form.checkValidity()) {
                        this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>جاري المعالجة...';
                        this.disabled = true;
                    }
                });
            });
        });
        
        // Add ripple animation keyframes
        if (!document.getElementById('ripple-keyframes')) {
            const rippleStyle = document.createElement('style');
            rippleStyle.id = 'ripple-keyframes';
            rippleStyle.textContent = `
                @keyframes ripple {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(rippleStyle);
        }
    </script>
</body>
</html>
