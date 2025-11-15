@extends('layouts.app')
@section('title', 'Trang chủ')

@section('content')
    <!-- SLIDER NỔI BẬT -->
    @if($featured && $featured->count())
    <div class="mb-10 bg-gray-900 rounded-xl overflow-hidden shadow-xl">
        <div class="swiper">
            <div class="swiper-wrapper">
                @foreach($featured as $item)
                <div class="swiper-slide">
                    <a href="{{ route('article.show', $item->slug) }}" class="block relative group">
                        <img src="{{ $item->thumbnail ? asset('storage/'.$item->thumbnail) : 'https://via.placeholder.com/1400x600' }}" 
                             alt="{{ $item->title }}" class="w-full h-64 sm:h-80 lg:h-96 object-cover transition group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-6 text-white">
                            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold leading-tight">{{ $item->title }}</h2>
                            <p class="text-sm sm:text-base mt-2 opacity-90 line-clamp-2">{{ $item->summary }}</p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    @endif

    <!-- GRID CHÍNH - RESPONSIVE -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">
        <!-- CỘT CHÍNH -->
        <div class="lg:col-span-8 space-y-8">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Tin mới nhất</h2>
            <div class="space-y-6">
                @forelse($articles as $article)
                    <article class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col sm:flex-row">
                        <img src="{{ $article->thumbnail ? asset('storage/'.$article->thumbnail) : 'https://via.placeholder.com/500x300' }}" 
                             alt="{{ $article->title }}" class="w-full sm:w-64 h-48 sm:h-52 object-cover">
                        <div class="p-5 sm:p-6 flex-1">
                            <h3 class="text-xl font-bold mb-2">
                                <a href="{{ route('article.show', $article->slug) }}" class="hover:text-red-600">
                                    {{ $article->title }}
                                </a>
                            </h3>
                            <p class="text-gray-700 mb-3 line-clamp-3 text-sm sm:text-base">{{ $article->summary }}</p>
                            <div class="flex flex-wrap items-center text-xs sm:text-sm text-gray-500 gap-3">
                                <span><strong>{{ $article->author->name ?? 'Admin' }}</strong></span>
                                <span>{{ $article->published_at?->format('d/m/Y H:i') }}</span>
                                <span>{{ $article->views }} lượt xem</span>
                            </div>
                        </div>
                    </article>
                @empty
                    <p class="text-center text-gray-500 py-10">Chưa có bài viết nào.</p>
                @endforelse
            </div>
            <div class="mt-8">
                {{ $articles->links() }}
            </div>
        </div>

        <!-- SIDEBAR -->
        <aside class="lg:col-span-4 space-y-6">
            <!-- TIN NHANH -->
            <div class="bg-white p-5 rounded-xl shadow-lg">
                <h3 class="text-lg font-bold mb-4 text-red-600">Tin nhanh 24h</h3>
                <div class="space-y-3">
                    @foreach($quickArticles as $q)
                        <a href="{{ route('article.show', $q->slug) }}" class="block p-2 border-b border-gray-100 hover:bg-gray-50">
                            <p class="font-medium text-gray-800 text-sm">{{ Str::limit($q->title, 80) }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $q->published_at?->format('H:i') }}</p>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- LỊCH THI ĐẤU -->
            <div class="bg-gradient-to-br from-red-600 to-red-700 p-5 rounded-xl text-white shadow-lg">
                <h3 class="text-lg font-bold mb-4">Lịch thi đấu hôm nay</h3>
                <p class="text-sm">V.League: <strong>HAGL vs Hà Nội FC</strong> - 19:00</p>
                <p class="text-sm mt-2">Champions League: <strong>Real Madrid vs Man City</strong> - 02:00</p>
            </div>
        </aside>
    </div>
@endsection

@section('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            new Swiper('.swiper', {
                loop: true,
                autoplay: { delay: 5000 },
                pagination: { el: '.swiper-pagination', clickable: true },
            });
        });
    </script>
@endsection