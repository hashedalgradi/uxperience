<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - لوحة التحكم</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'cairo': ['Cairo', 'sans-serif'],
                    },
                    colors: {
                        primary: '#6366f1',
                        secondary: '#f59e0b',
                        accent: '#ec4899',
                        dark: '#0f172a',
                    }
                }
            }
        }
    </script>
    <style>
        body { 
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }
        
        .shape {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(45deg, rgba(99, 102, 241, 0.1), rgba(236, 72, 153, 0.1));
            animation: float 20s infinite linear;
        }
        
        @keyframes float {
            0% { transform: translateY(100vh) rotate(0deg); }
            100% { transform: translateY(-100px) rotate(360deg); }
        }
        
        .login-form {
            animation: slideUp 0.8s ease-out;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center relative overflow-hidden">
    <!-- Floating Background Shapes -->
    <div class="floating-shapes">
        <div class="shape" style="width: 80px; height: 80px; left: 10%; animation-delay: 0s;"></div>
        <div class="shape" style="width: 120px; height: 120px; left: 20%; animation-delay: 2s;"></div>
        <div class="shape" style="width: 60px; height: 60px; left: 70%; animation-delay: 4s;"></div>
        <div class="shape" style="width: 100px; height: 100px; left: 80%; animation-delay: 6s;"></div>
        <div class="shape" style="width: 140px; height: 140px; left: 50%; animation-delay: 8s;"></div>
    </div>
    <div class="max-w-md w-full mx-4 login-form">
        <!-- Logo/Header -->
        <div class="text-center mb-8">
            <div class="w-24 h-24 bg-gradient-to-r from-primary to-accent rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-2xl transform hover:scale-110 transition-transform duration-300">
                <i class="fas fa-crown text-white text-3xl"></i>
            </div>
            <h1 class="text-4xl font-black text-white mb-3 drop-shadow-lg">لوحة التحكم</h1>
            <p class="text-white/90 text-lg">قم بتسجيل الدخول للوصول إلى لوحة التحكم</p>
        </div>

        <!-- Login Form -->
        <div class="glass-card rounded-2xl shadow-2xl p-8 border border-white/20">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-white text-sm font-bold mb-3">
                        البريد الإلكتروني
                    </label>
                    <div class="relative">
                        <input id="email" type="email" 
                               class="w-full px-5 py-4 pl-12 bg-white/20 backdrop-blur-sm border border-white/30 rounded-xl text-white placeholder-white/70 focus:ring-2 focus:ring-white/50 focus:border-white/50 transition-all @error('email') border-red-400 @enderror" 
                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                               placeholder="أدخل بريدك الإلكتروني">
                        <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-white/70"></i>
                    </div>
                    @error('email')
                        <p class="text-red-300 text-sm mt-2 bg-red-500/20 p-2 rounded-lg">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-white text-sm font-bold mb-3">
                        كلمة المرور
                    </label>
                    <div class="relative">
                        <input id="password" type="password" 
                               class="w-full px-5 py-4 pl-12 bg-white/20 backdrop-blur-sm border border-white/30 rounded-xl text-white placeholder-white/70 focus:ring-2 focus:ring-white/50 focus:border-white/50 transition-all @error('password') border-red-400 @enderror" 
                               name="password" required autocomplete="current-password"
                               placeholder="أدخل كلمة المرور">
                        <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-white/70"></i>
                        <button type="button" onclick="togglePassword()" class="absolute left-12 top-1/2 transform -translate-y-1/2 text-white/70 hover:text-white transition-colors">
                            <i id="toggleIcon" class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-300 text-sm mt-2 bg-red-500/20 p-2 rounded-lg">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center">
                        <input class="h-5 w-5 text-primary focus:ring-primary border-white/30 rounded bg-white/20" 
                               type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="mr-3 block text-sm text-white font-medium" for="remember">
                            تذكرني
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-white/90 hover:text-white transition-colors underline" href="{{ route('password.request') }}">
                            نسيت كلمة المرور؟
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-primary to-accent text-white py-4 px-6 rounded-xl font-bold text-lg hover:shadow-2xl hover:scale-105 transition-all duration-300 flex items-center justify-center relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-r from-accent to-primary opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <i class="fas fa-sign-in-alt ml-3 relative z-10"></i>
                    <span class="relative z-10">تسجيل الدخول</span>
                </button>
            </form>
        </div>

        <!-- Back to Website -->
        <div class="text-center mt-8">
            <a href="{{ route('home') }}" class="inline-flex items-center text-white/90 hover:text-white transition-all duration-300 hover:scale-105">
                <i class="fas fa-arrow-right ml-2"></i>
                العودة للموقع الرئيسي
            </a>
        </div>

        <!-- Demo Credentials -->
        <div class="glass-card rounded-xl p-6 mt-8 text-white border border-white/20">
            <div class="flex items-center mb-4">
                <i class="fas fa-info-circle text-yellow-300 ml-2"></i>
                <h3 class="font-bold text-lg">بيانات تجريبية</h3>
            </div>
            <div class="space-y-2 text-sm">
                <div class="flex items-center justify-between bg-white/10 p-3 rounded-lg">
                    <span class="font-medium">البريد:</span>
                    <span class="font-mono bg-white/20 px-2 py-1 rounded">admin@example.com</span>
                </div>
                <div class="flex items-center justify-between bg-white/10 p-3 rounded-lg">
                    <span class="font-medium">كلمة المرور:</span>
                    <span class="font-mono bg-white/20 px-2 py-1 rounded">password</span>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
        
        // Add floating animation to form
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('.login-form');
            form.style.animation = 'slideUp 0.8s ease-out';
        });
    </script>
</body>
</html>