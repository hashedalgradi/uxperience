@extends('layouts.app')

@section('title', $project->title)

@section('content')
<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Back Button -->
        <div class="mb-8">
            <a href="{{ route('projects') }}" 
               class="text-primary hover:underline flex items-center">
                <i class="fas fa-arrow-right mr-2"></i>
                العودة للمشاريع
            </a>
        </div>

        <!-- Project Header -->
        <div class="mb-12">
            <div class="flex items-center justify-between mb-4">
                <span class="text-sm text-primary font-semibold bg-blue-50 px-3 py-1 rounded-full">
                    {{ $project->category }}
                </span>
                @if($project->featured)
                    <span class="text-xs text-secondary font-semibold bg-orange-50 px-2 py-1 rounded-full">
                        مشروع مميز
                    </span>
                @endif
            </div>
            
            <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $project->title }}</h1>
            
            <div class="flex space-x-reverse space-x-4 mb-6">
                @if($project->github)
                    <a href="{{ $project->github }}" target="_blank" 
                       class="bg-gray-800 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition">
                        <i class="fab fa-github mr-2"></i>
                        GitHub
                    </a>
                @endif
                @if($project->demo)
                    <a href="{{ $project->demo }}" target="_blank" 
                       class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-external-link-alt mr-2"></i>
                        عرض مباشر
                    </a>
                @endif
            </div>
        </div>

        <!-- Project Image -->
        @if($project->image)
            <div class="mb-12">
                <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" 
                     class="w-full rounded-lg shadow-lg">
            </div>
        @endif

        <!-- Project Description -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">وصف المشروع</h2>
            <div class="prose prose-lg text-gray-600">
                <p>{{ $project->description }}</p>
            </div>
        </div>

        <!-- Tools Used -->
        @if($project->tools)
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">التقنيات المستخدمة</h2>
                <div class="flex flex-wrap gap-3">
                    @foreach($project->tools as $tool)
                        <span class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg font-medium">
                            {{ $tool }}
                        </span>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Project Gallery -->
        @if($project->gallery && count($project->gallery) > 0)
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">معرض الصور</h2>
                <div class="grid md:grid-cols-2 gap-6">
                    @foreach($project->gallery as $image)
                        <img src="{{ asset('storage/' . $image) }}" alt="صورة من المشروع" 
                             class="w-full rounded-lg shadow-lg hover:shadow-xl transition cursor-pointer"
                             onclick="openModal('{{ asset('storage/' . $image) }}')">
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Contact CTA -->
        <div class="bg-gray-50 p-8 rounded-lg text-center">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">أعجبك المشروع؟</h3>
            <p class="text-gray-600 mb-6">تواصل معي لمناقشة مشروعك القادم</p>
            <a href="{{ route('contact') }}" 
               class="bg-primary text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                تواصل معي
            </a>
        </div>
    </div>
</section>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 hidden z-50 flex items-center justify-center p-4">
    <div class="relative max-w-4xl max-h-full">
        <img id="modalImage" src="" alt="" class="max-w-full max-h-full rounded-lg">
        <button onclick="closeModal()" 
                class="absolute top-4 right-4 text-white text-2xl hover:text-gray-300">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>

<script>
function openModal(imageSrc) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('imageModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('imageModal').classList.add('hidden');
}

// Close modal on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});
</script>
@endsection