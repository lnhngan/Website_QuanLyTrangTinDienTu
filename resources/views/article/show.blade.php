@extends('layouts.app')

@section('content')
  <div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-2">{{ $article->title }}</h1>
    <p class="text-sm text-gray-500 mb-4">{{ $article->published_at ? $article->published_at->format('d/m/Y H:i') : '' }} - {{ $article->author->name ?? 'Tác giả' }}</p>
    @if($article->thumbnail)
      <img src="{{ $article->thumbnail }}" class="w-full h-64 object-cover rounded mb-4">
    @endif
    <div class="prose max-w-none">{!! $article->content !!}</div>
  </div>
@endsection
