<!-- Enhanced Admin Sidebar -->
<div id="sidebar" class="sidebar-container fixed right-0 top-0 h-full bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900 text-white transition-all duration-300 z-50">
    <!-- Logo Section -->
    <div class="sidebar-header p-6 border-b border-slate-700/50">
        <div class="flex items-center space-x-reverse space-x-3">
            <div class="logo-icon w-10 h-10 bg-gradient-to-r from-primary to-accent rounded-xl flex items-center justify-center">
                <i class="fas fa-crown text-white text-lg"></i>
            </div>
            <div class="logo-text">
                <h2 class="text-xl font-bold text-white">لوحة التحكم</h2>
                <p class="text-xs text-slate-400 mt-1">إدارة المحتوى</p>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="sidebar-nav mt-6 px-4">
        <div class="nav-section">
            <h3 class="nav-section-title text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3 px-3">الرئيسية</h3>
            
            <a href="{{ route('admin.dashboard') }}" 
               class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
               data-tooltip="الرئيسية">
                <div class="nav-icon">
                    <i class="fas fa-tachometer-alt"></i>
                </div>
                <span class="nav-text">الرئيسية</span>
                <div class="nav-indicator"></div>
            </a>
        </div>

        <div class="nav-section mt-6">
            <h3 class="nav-section-title text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3 px-3">المحتوى</h3>
            
            <a href="{{ route('admin.profile.index') }}" 
               class="nav-item {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}"
               data-tooltip="الملف الشخصي">
                <div class="nav-icon">
                    <i class="fas fa-user-circle"></i>
                </div>
                <span class="nav-text">الملف الشخصي</span>
                <div class="nav-indicator"></div>
            </a>

            <a href="{{ route('admin.projects.index') }}" 
               class="nav-item {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}"
               data-tooltip="المشاريع">
                <div class="nav-icon">
                    <i class="fas fa-project-diagram"></i>
                </div>
                <span class="nav-text">المشاريع</span>
                <div class="nav-indicator"></div>
            </a>

            <a href="{{ route('admin.services.index') }}" 
               class="nav-item {{ request()->routeIs('admin.services.*') ? 'active' : '' }}"
               data-tooltip="الخدمات">
                <div class="nav-icon">
                    <i class="fas fa-cogs"></i>
                </div>
                <span class="nav-text">الخدمات</span>
                <div class="nav-indicator"></div>
            </a>
        </div>

        <div class="nav-section mt-6">
            <h3 class="nav-section-title text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3 px-3">النظام</h3>
            
            <a href="{{ route('home') }}" target="_blank"
               class="nav-item"
               data-tooltip="عرض الموقع">
                <div class="nav-icon">
                    <i class="fas fa-external-link-alt"></i>
                </div>
                <span class="nav-text">عرض الموقع</span>
                <div class="nav-indicator"></div>
            </a>
        </div>
    </nav>

    <!-- Collapse Toggle -->
    <button id="sidebar-toggle" class="sidebar-toggle absolute -left-3 top-20 w-8 h-8 bg-white rounded-full shadow-lg flex items-center justify-center text-slate-600 hover:text-primary transition-colors z-50">
        <i class="fas fa-chevron-right text-sm"></i>
    </button>

    <!-- User Profile Footer -->
    <div class="sidebar-footer absolute bottom-0 left-0 right-0 p-4 border-t border-slate-700/50">
        <div class="user-profile flex items-center space-x-reverse space-x-3">
            <div class="user-avatar w-8 h-8 bg-gradient-to-r from-primary to-accent rounded-full flex items-center justify-center">
                <i class="fas fa-user text-white text-sm"></i>
            </div>
            <div class="user-info flex-1">
                <p class="user-name text-sm font-medium text-white">المدير</p>
                <p class="user-role text-xs text-slate-400">مدير النظام</p>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="button" onclick="confirmLogout()" class="logout-btn w-8 h-8 rounded-lg bg-red-500/20 text-red-400 hover:bg-red-500 hover:text-white transition-all duration-200 flex items-center justify-center" data-tooltip="تسجيل الخروج">
                    <i class="fas fa-sign-out-alt text-sm"></i>
                </button>
            </form>
        </div>
    </div>
</div>