@extends('layouts.admin')

@section('title', 'لوحة التحكم')
@section('page-title', 'الرئيسية')
@section('page-subtitle', 'نظرة عامة على إحصائيات الموقع')

@section('content')
<!-- Stats Cards -->
<div class="dashboard-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="dashboard-card fade-in" style="animation-delay: 0.1s">
        <div class="card-icon bg-gradient-to-r from-blue-500 to-blue-600">
            <i class="fas fa-project-diagram text-white text-xl"></i>
        </div>
        <div class="card-number counter" data-target="{{ $stats['projects'] }}">0</div>
        <div class="card-label">إجمالي المشاريع</div>
        <div class="card-trend trend-up">
            <i class="fas fa-arrow-up mr-1"></i>
            <span>+12% من الشهر الماضي</span>
        </div>
    </div>

    <div class="dashboard-card fade-in" style="animation-delay: 0.2s">
        <div class="card-icon bg-gradient-to-r from-green-500 to-green-600">
            <i class="fas fa-cogs text-white text-xl"></i>
        </div>
        <div class="card-number counter" data-target="{{ $stats['services'] }}">0</div>
        <div class="card-label">الخدمات المتاحة</div>
        <div class="card-trend trend-up">
            <i class="fas fa-arrow-up mr-1"></i>
            <span>+8% من الشهر الماضي</span>
        </div>
    </div>

    <div class="dashboard-card fade-in" style="animation-delay: 0.3s">
        <div class="card-icon bg-gradient-to-r from-yellow-500 to-orange-500">
            <i class="fas fa-star text-white text-xl"></i>
        </div>
        <div class="card-number counter" data-target="{{ $stats['featured_projects'] }}">0</div>
        <div class="card-label">المشاريع المميزة</div>
        <div class="card-trend trend-up">
            <i class="fas fa-arrow-up mr-1"></i>
            <span>+25% من الشهر الماضي</span>
        </div>
    </div>

    <div class="dashboard-card fade-in" style="animation-delay: 0.4s">
        <div class="card-icon bg-gradient-to-r from-purple-500 to-pink-500">
            <i class="fas fa-eye text-white text-xl"></i>
        </div>
        <div class="card-number counter" data-target="1250">0</div>
        <div class="card-label">زيارات الموقع</div>
        <div class="card-trend trend-up">
            <i class="fas fa-arrow-up mr-1"></i>
            <span>+18% من الشهر الماضي</span>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="admin-form mb-8 fade-in" style="animation-delay: 0.5s">
    <div class="table-header">
        <h2 class="table-title">إجراءات سريعة</h2>
        <p class="table-subtitle">الوصول السريع للمهام الأساسية</p>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary text-center flex flex-col items-center space-y-2">
                <i class="fas fa-plus text-xl"></i>
                <span>مشروع جديد</span>
            </a>
            <a href="{{ route('admin.services.create') }}" class="btn btn-secondary text-center flex flex-col items-center space-y-2">
                <i class="fas fa-plus text-xl"></i>
                <span>خدمة جديدة</span>
            </a>
            <a href="{{ route('admin.profile.edit') }}" class="btn btn-secondary text-center flex flex-col items-center space-y-2">
                <i class="fas fa-user-edit text-xl"></i>
                <span>تحديث الملف</span>
            </a>
            <a href="{{ route('home') }}" target="_blank" class="btn btn-secondary text-center flex flex-col items-center space-y-2">
                <i class="fas fa-external-link-alt text-xl"></i>
                <span>عرض الموقع</span>
            </a>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="grid lg:grid-cols-2 gap-8">
    <!-- Recent Projects -->
    <div class="admin-table fade-in" style="animation-delay: 0.6s">
        <div class="table-header">
            <h3 class="table-title">المشاريع الحديثة</h3>
            <p class="table-subtitle">آخر المشاريع المضافة</p>
        </div>
        <div class="table-content">
            <table>
                <thead>
                    <tr>
                        <th>اسم المشروع</th>
                        <th>التاريخ</th>
                        <th>الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>موقع تجارة إلكترونية</td>
                        <td>منذ يومين</td>
                        <td><span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">مكتمل</span></td>
                    </tr>
                    <tr>
                        <td>تطبيق إدارة المهام</td>
                        <td>منذ أسبوع</td>
                        <td><span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">قيد التطوير</span></td>
                    </tr>
                    <tr>
                        <td>موقع شركة</td>
                        <td>منذ أسبوعين</td>
                        <td><span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">مكتمل</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Welcome Message -->
    <div class="dashboard-card fade-in" style="animation-delay: 0.7s">
        <div class="text-center">
            <div class="card-icon bg-gradient-to-r from-primary to-accent mx-auto mb-4">
                <i class="fas fa-crown text-white text-2xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-4">مرحباً بك في لوحة التحكم!</h3>
            <p class="text-gray-600 mb-6">من هنا يمكنك إدارة جميع محتويات موقعك الشخصي بسهولة وفعالية</p>
            <div class="flex justify-center space-x-reverse space-x-4">
                <a href="{{ route('admin.projects.index') }}" class="btn btn-primary btn-sm">
                    إدارة المشاريع
                </a>
                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary btn-sm">
                    إدارة الخدمات
                </a>
            </div>
        </div>
    </div>
</div>
@endsection