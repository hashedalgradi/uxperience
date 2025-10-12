<!-- Enhanced Admin Navbar -->
<header class="admin-navbar sticky top-0 z-40 bg-white/95 backdrop-blur-lg border-b border-gray-200/50 shadow-sm">
    <div class="navbar-container flex items-center justify-between px-6 py-4">
        
        <!-- Left Section -->
        <div class="navbar-left flex items-center space-x-reverse space-x-4">
            <!-- Mobile Menu Toggle -->
            <button id="mobile-menu-toggle" class="md:hidden p-3 rounded-xl bg-white/20 backdrop-blur-sm hover:bg-white/30 transition-colors border border-white/20">
                <i class="fas fa-bars text-gray-700 text-lg"></i>
            </button>
            
            <!-- Page Title -->
            <div class="page-title">
                <h1 class="text-2xl font-bold text-gray-800">@yield('page-title', 'لوحة التحكم')</h1>
                <p class="text-sm text-gray-500 mt-1">@yield('page-subtitle', 'إدارة وتحكم في محتوى الموقع')</p>
            </div>
        </div>

        <!-- Center Section - Search -->
        <div class="navbar-center hidden lg:flex flex-1 max-w-md mx-8">
            <div class="search-container relative w-full">
                <input type="text" 
                       placeholder="البحث في لوحة التحكم..." 
                       class="search-input w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                <div class="search-icon absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                    <i class="fas fa-search"></i>
                </div>
            </div>
        </div>

        <!-- Right Section -->
        <div class="navbar-right flex items-center space-x-reverse space-x-4">
            
            <!-- Notifications -->
            <div class="notification-dropdown relative">
                <button class="notification-btn p-2 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors relative">
                    <i class="fas fa-bell text-gray-600"></i>
                    <span class="notification-badge absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
                </button>
            </div>

            <!-- Quick Actions -->
            <div class="quick-actions flex items-center space-x-reverse space-x-2">
                <a href="{{ route('home') }}" target="_blank" 
                   class="quick-action-btn p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition-colors"
                   title="عرض الموقع">
                    <i class="fas fa-external-link-alt"></i>
                </a>
                
                <button class="quick-action-btn p-2 rounded-lg bg-gray-50 text-gray-600 hover:bg-gray-100 transition-colors"
                        title="الإعدادات">
                    <i class="fas fa-cog"></i>
                </button>
            </div>

            <!-- User Profile Dropdown -->
            <div class="user-dropdown relative">
                <button id="user-menu-toggle" class="user-profile-btn flex items-center space-x-reverse space-x-3 p-2 rounded-xl hover:bg-gray-50 transition-colors">
                    <div class="user-avatar w-10 h-10 bg-gradient-to-r from-primary to-accent rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <div class="user-info hidden sm:block text-right">
                        <p class="user-name text-sm font-semibold text-gray-800">المدير</p>
                        <p class="user-role text-xs text-gray-500">مدير النظام</p>
                    </div>
                    <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
                </button>

                <!-- Dropdown Menu -->
                <div id="user-dropdown-menu" class="user-dropdown-menu absolute left-0 top-full mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-200 py-2 opacity-0 invisible transform scale-95 transition-all duration-200">
                    <a href="{{ route('admin.profile.index') }}" class="dropdown-item flex items-center space-x-reverse space-x-3 px-4 py-2 text-gray-700 hover:bg-gray-50">
                        <i class="fas fa-user-circle text-gray-400"></i>
                        <span>الملف الشخصي</span>
                    </a>
                    <a href="#" class="dropdown-item flex items-center space-x-reverse space-x-3 px-4 py-2 text-gray-700 hover:bg-gray-50">
                        <i class="fas fa-cog text-gray-400"></i>
                        <span>الإعدادات</span>
                    </a>
                    <div class="dropdown-divider border-t border-gray-200 my-2"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="button" onclick="confirmLogout()" class="dropdown-item w-full flex items-center space-x-reverse space-x-3 px-4 py-2 text-red-600 hover:bg-red-50">
                            <i class="fas fa-sign-out-alt text-red-500"></i>
                            <span>تسجيل الخروج</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Search -->
    <div class="mobile-search lg:hidden px-6 pb-4">
        <div class="search-container relative">
            <input type="text" 
                   placeholder="البحث..." 
                   class="search-input w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
            <div class="search-icon absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                <i class="fas fa-search"></i>
            </div>
        </div>
    </div>
</header>

<style>
/* Enhanced Navbar Styles */
.admin-navbar {
    backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(229, 231, 235, 0.5);
}

.search-input:focus {
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

.notification-badge {
    animation: pulse 2s infinite;
}

.user-dropdown-menu.show {
    opacity: 1;
    visibility: visible;
    transform: scale(1);
}

.dropdown-item {
    transition: all 0.2s ease;
}

.dropdown-item:hover {
    transform: translateX(4px);
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .navbar-container {
        padding: 1rem;
    }
    
    .page-title h1 {
        font-size: 1.5rem;
    }
    
    .user-info {
        display: none;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // User dropdown toggle
    const userMenuToggle = document.getElementById('user-menu-toggle');
    const userDropdownMenu = document.getElementById('user-dropdown-menu');
    
    if (userMenuToggle && userDropdownMenu) {
        userMenuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdownMenu.classList.toggle('show');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function() {
            userDropdownMenu.classList.remove('show');
        });
    }
    

    
    // Search functionality (placeholder)
    const searchInputs = document.querySelectorAll('.search-input');
    searchInputs.forEach(input => {
        input.addEventListener('input', function() {
            // Add search functionality here
            console.log('Searching for:', this.value);
        });
    });
});
</script>