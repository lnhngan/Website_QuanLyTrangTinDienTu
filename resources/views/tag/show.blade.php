@extends('layouts.app')
@section('title', 'Tag: ' . $tag->name)

@section('content')
    <div class="max-w-5xl mx-auto">
        <h1 class="text-4xl font-bold mb-8 text-gray-800">
            #{{ $tag->name }}
        </h1>

        <div class="space-y-8">
            @forelse($articles as $article)
                <article class="bg-white rounded-xl shadow-lg overflow-hidden flex">
                    <img src="{{ $article->thumbnail ?? 'https://via.placeholder.com/500x300' }}" 
                         alt="{{ $article->title }}" class="w-80 h-52 object-cover">
                    <div class="p-6 flex-1">
                        <h3 class="text-2xl font-bold mb-2">
                            <a href="{{ route('article.show', $article->slug) }}" class="hover:text-red-600">
                                {{ $article->title }}
                            </a>
                        </h3>
                        <p class="text-gray-700 mb-3 line-clamp-2">{{ $article->summary }}</p>
                        <div class="text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($article->published_at)->format('d/m/Y') }} | 
                            {{ $article->author->name ?? 'Admin' }}
                        </div>
                    </div>
                </article>
            @empty
                <p class="text-center text-gray-500 py-10">Chưa có bài viết nào với tag này.</p>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $articles->links() }}
        </div>
    </div>
@endsection