{{-- resources/views/article/article_detail.blade.php --}}
@extends('layouts.app')
@section('title', $article->title)

@section('content')
    <div class="max-w-5xl mx-auto">
        <!-- BREADCRUMB -->
        <nav class="text-sm mb-6">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-red-600">Trang chủ</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="{{ route('category.show', $article->category->slug) }}" class="text-gray-500 hover:text-red-600">
                {{ $article->category->name }}
            </a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-gray-700">{{ Str::limit($article->title, 50) }}</span>
        </nav>

        <!-- TIÊU ĐỀ + INFO -->
        <header class="mb-8">
            <h1 class="text-5xl font-bold text-gray-900 leading-tight mb-4">
                {{ $article->title }}
            </h1>
            <div class="flex items-center text-base text-gray-600 space-x-6">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span><strong>{{ $article->author->name ?? 'Admin' }}</strong></span>
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>{{ $article->published_at?->format('d/m/Y H:i') }}</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <span>{{ $article->views }} lượt xem</span>
                </div>
            </div>
        </header>

        <!-- THUMBNAIL -->
        @if($article->thumbnail)
            <div class="mb-10 -mx-8">
                <img src="{{ $article->thumbnail }}" alt="{{ $article->title }}" class="w-full h-auto max-h-96 object-cover rounded-xl shadow-lg">
            </div>
        @endif

        <!-- NỘI DUNG CHÍNH -->
        <div class="prose prose-lg max-w-none mb-12 text-justify leading-relaxed text-gray-800">
            {!! $article->content !!}
        </div>

        <!-- TAGS -->
        @if($article->tags->count())
            <div class="mb-10 pt-6 border-t border-gray-200">
                <span class="text-sm font-semibold text-gray-600">Tags:</span>
                <div class="flex flex-wrap gap-2 mt-2">
                    @foreach($article->tags as $tag)
                        <a href="{{ route('tag.show', $tag->slug) }}" class="inline-block px-4 py-1 bg-gray-100 text-gray-700 text-sm rounded-full hover:bg-red-100 hover:text-red-600 transition">
                            #{{ $tag->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- BÀI VIẾT LIÊN QUAN -->
        @if($relatedArticles->count())
            <section class="mt-16 pt-10 border-t border-gray-200">
                <h3 class="text-2xl font-bold mb-6 text-gray-800">Tin liên quan</h3>
                <div class="grid grid-cols-3 gap-6">
                    @foreach($relatedArticles as $related)
                        <article class="bg-white rounded-lg shadow hover:shadow-lg transition">
                            <a href="{{ route('article.show', $related->slug) }}">
                                <img src="{{ $related->thumbnail ? $related->thumbnail : 'https://via.placeholder.com/400x250' }}" 
                                     alt="{{ $related->title }}" class="w-full h-40 object-cover rounded-t-lg">
                                <div class="p-4">
                                    <h4 class="font-semibold text-lg line-clamp-2">{{ $related->title }}</h4>
                                    <p class="text-sm text-gray-500 mt-1">{{ $related->published_at?->format('d/m/Y') }}</p>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- BÌNH LUẬN (sẽ thêm sau) -->
        <section class="mt-16 pt-10 border-t border-gray-200">
            <h3 class="text-2xl font-bold mb-6 text-gray-800">Bình luận</h3>
            <div id="comments-section" class="bg-gray-50 p-6 rounded-xl">
                <p class="text-gray-600">Chức năng bình luận đang được phát triển...</p>
            </div>
        </section>
    </div>
@endsection