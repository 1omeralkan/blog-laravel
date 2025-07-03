@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4">
    <h1 class="text-3xl font-bold mb-8 text-center">{{ $category->name }}</h1>
    <p class="mb-6 text-gray-600 dark:text-gray-300 text-center">{{ $category->description }}</p>
    <div class="space-y-8">
        @forelse($category->posts as $post)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 hover:shadow-lg transition">
                <a href="{{ route('posts.show', $post->slug) }}" class="block">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2 hover:text-blue-600">{{ $post->title }}</h2>
                </a>
                <div class="flex items-center text-sm text-gray-500 mb-2">
                    <span>{{ $post->user->name ?? 'Anonim' }}</span>
                    <span class="mx-2">•</span>
                    <span>{{ $post->created_at->diffForHumans() }}</span>
                </div>
                <div class="mb-2 text-gray-700 dark:text-gray-300 line-clamp-3">
                    {{ Str::limit(strip_tags($post->content), 200) }}
                </div>
                <div class="flex flex-wrap gap-2 mt-2">
                    @foreach($post->tags as $tag)
                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">#{{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="text-center text-gray-500">Bu kategoride henüz yazı yok.</div>
        @endforelse
    </div>
</div>
@endsection 