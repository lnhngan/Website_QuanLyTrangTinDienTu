@extends('layouts.app')
@section('title', $category->name)

@section('content')
    <h1 class="text-4xl font-bold mb-8 text-gray-800">
        {{ $category->name }}
    </h1>

    <div class="space-y-10">
        @forelse($articles as $article)
            <article class="bg-white rounded-xl shadow-lg overflow-hidden flex">
                <img src="{{ $article->thumbnail ? $article->thumbnail : 'https://via.placeholder.com/600x350' }}" 
                     alt="{{ $article->title }}" class="w-96 h-60 object-cover">
                <div class="p-8 flex-1">
                    <h2 class="text-3xl font-bold mb-3">
                        <a href="{{ route('article.show', $article->slug) }}" class="hover:text-red-600">
                            {{ $article->title }}
                        </a>
                    </h2>
                    <p class="text-lg text-gray-700 mb-4 line-clamp-3">{{ $article->summary }}</p>
                    <div class="flex items-center text-base text-gray-500 space-x-6">
                        <span><strong>{{ $article->author->name ?? 'Admin' }}</strong></span>
                        <span>{{ $article->published_at?->format('d/m/Y H:i') }}</span>
                        <span>{{ $article->views }} lượt xem</span>
                    </div>
                </div>
            </article>
        @empty
            <p class="text-center text-gray-500 py-16 text-xl">Chưa có bài viết trong danh mục này.</p>
        @endforelse
    </div>

    <div class="mt-12">
        {{ $articles->links() }}
    </div>
@endsection