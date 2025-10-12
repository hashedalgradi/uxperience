@extends('layouts.admin')

@section('title', 'الملف الشخصي')
@section('page-title', 'الملف الشخصي')
@section('page-subtitle', 'عرض ومراجعة معلوماتك الشخصية')

@section('content')
@if(session('success'))
    <div class="alert alert-success mb-6">
        <i class="fas fa-check-circle ml-2"></i>
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-error mb-6">
        <i class="fas fa-exclamation-circle ml-2"></i>
        {{ session('error') }}
    </div>
@endif

<div class="max-w-6xl mx-auto">
    <div class="dashboard-card overflow-hidden fade-in">
        <div class="bg-gradient-to-r from-primary to-accent p-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-white">الملف الشخصي</h1>
                    <p class="text-white/90 mt-2 text-lg">عرض ومراجعة معلوماتك الشخصية</p>
                </div>
                <a href="{{ route('admin.profile.edit') }}" class="btn btn-secondary">
                    <i class="fas fa-edit ml-2"></i>
                    تحديث الملف
                </a>
            </div>
        </div>

        <div class="p-8">
            <div class="grid lg:grid-cols-2 gap-8">
                <!-- المعلومات الأساسية -->
                <div class="space-y-6 slide-up" style="animation-delay: 0.1s">
                    <h2 class="text-2xl font-bold text-gray-800 border-b-2 border-primary/20 pb-3">المعلومات الأساسية</h2>
                        
                    <!-- الصورة الشخصية -->
                    <div class="dashboard-card p-6">
                        <div class="flex items-center space-x-4 space-x-reverse">
                            @if($user->image)
                                <img src="{{ asset('storage/' . $user->image) }}" alt="Profile" class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-xl">
                            @else
                                <div class="w-24 h-24 bg-gradient-to-br from-primary to-accent rounded-full flex items-center justify-center border-4 border-white shadow-xl">
                                    <i class="fas fa-user text-white text-2xl"></i>
                                </div>
                            @endif
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h3>
                                @if($user->title)
                                    <p class="text-gray-600 text-lg mt-1">{{ $user->title }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- تفاصيل الاتصال -->
                    <div class="dashboard-card p-6 space-y-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center ml-4">
                                <i class="fas fa-envelope text-blue-600"></i>
                            </div>
                            <span class="text-gray-700 font-medium">{{ $user->email }}</span>
                        </div>
                        
                        @if($user->phone)
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center ml-4">
                                    <i class="fas fa-phone text-green-600"></i>
                                </div>
                                <span class="text-gray-700 font-medium">{{ $user->phone }}</span>
                            </div>
                        @endif
                        
                        @if($user->website)
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center ml-4">
                                    <i class="fas fa-globe text-purple-600"></i>
                                </div>
                                <a href="{{ $user->website }}" target="_blank" class="text-primary hover:text-accent font-medium transition-colors">{{ $user->website }}</a>
                            </div>
                        @endif
                        
                        @if($user->location)
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center ml-4">
                                    <i class="fas fa-map-marker-alt text-red-600"></i>
                                </div>
                                <span class="text-gray-700 font-medium">{{ $user->location }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- النبذة والروابط -->
                <div class="space-y-6 slide-up" style="animation-delay: 0.2s">
                    <h2 class="text-2xl font-bold text-gray-800 border-b-2 border-primary/20 pb-3">النبذة الشخصية</h2>
                    
                    @if($user->bio)
                        <div class="dashboard-card bg-gradient-to-r from-primary/5 to-accent/5 p-6">
                            <p class="text-gray-700 leading-relaxed text-lg">{{ $user->bio }}</p>
                        </div>
                    @else
                        <div class="dashboard-card p-8 text-center border-2 border-dashed border-gray-300">
                            <i class="fas fa-edit text-gray-400 text-3xl mb-4"></i>
                            <p class="text-gray-500 text-lg">لم يتم إضافة نبذة شخصية بعد</p>
                        </div>
                    @endif

                    <!-- الروابط الاجتماعية -->
                    @if($socialLinks && $socialLinks->count() > 0)
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 mb-6">روابط التواصل الاجتماعي</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach($socialLinks as $link)
                                    <a href="{{ $link->url }}" target="_blank" class="dashboard-card flex items-center p-4 hover:shadow-lg transition-all hover:border-primary/30">
                                        <div class="w-12 h-12 bg-gradient-to-br from-primary to-accent rounded-xl flex items-center justify-center ml-4">
                                            <i class="{{ $link->icon ?? 'fas fa-link' }} text-white"></i>
                                        </div>
                                        <span class="text-gray-700 font-semibold capitalize text-lg">{{ $link->platform }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="dashboard-card p-8 text-center border-2 border-dashed border-gray-300">
                            <i class="fas fa-share-alt text-gray-400 text-3xl mb-4"></i>
                            <p class="text-gray-500 text-lg">لم يتم إضافة روابط تواصل اجتماعي بعد</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection