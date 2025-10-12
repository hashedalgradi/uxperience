<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'لوحة التحكم')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-rtl-fixes.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar-collapsed-fix.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mobile-sidebar-fix.css') }}">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'cairo': ['Segoe UI', 'Tahoma', 'Geneva', 'Verdana', 'sans-serif'],
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
</head>
<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 font-cairo">
    <div class="admin-layout flex h-screen overflow-hidden">
        @include('admin.layouts.sidebar')
        
        <div class="main-content flex-1 flex flex-col">
            @include('admin.layouts.navbar')
            
            <main class="content-area flex-1 p-6 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>
    
    <script src="{{ asset('js/admin-dashboard.js') }}"></script>
    <script>
        function confirmLogout() {
            showLogoutModal();
        }
        
        function showLogoutModal() {
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm';
            modal.innerHTML = `
                <div class="bg-white rounded-2xl shadow-2xl p-8 mx-4 max-w-md w-full transform scale-95 opacity-0 transition-all duration-300" id="logout-modal">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-sign-out-alt text-red-500 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">تسجيل الخروج</h3>
                        <p class="text-gray-600 mb-6">هل أنت متأكد من تسجيل الخروج من لوحة التحكم؟</p>
                        <div class="flex gap-3 justify-center">
                            <button onclick="closeLogoutModal()" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-colors">
                                إلغاء
                            </button>
                            <button onclick="doLogout()" class="px-6 py-2 bg-red-500 text-white rounded-xl hover:bg-red-600 transition-colors">
                                تسجيل الخروج
                            </button>
                        </div>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
            
            setTimeout(() => {
                const modalContent = document.getElementById('logout-modal');
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }
        
        function closeLogoutModal() {
            const modal = document.querySelector('.fixed.inset-0.z-50');
            const modalContent = document.getElementById('logout-modal');
            modalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => modal.remove(), 300);
        }
        
        function doLogout() {
            document.getElementById('logout-form').submit();
        }
    </script>
    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
        @csrf
    </form>
</body>
</html>