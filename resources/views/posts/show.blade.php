@extends('layouts.app')

@section('content')
@if(!$post)
    <div class="max-w-2xl mx-auto py-10 px-4">
        <div class="bg-red-100 text-red-800 rounded-lg shadow p-6 text-center text-xl font-semibold">
            Yazı bulunamadı veya silinmiş.
        </div>
    </div>
@else
<div class="max-w-3xl mx-auto py-10 px-4">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-8">
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">{{ $post->title }}</h1>
        <div class="flex items-center text-sm text-gray-500 mb-4">
            <span>{{ $post->user->name ?? 'Anonim' }}</span>
            <span class="mx-2">•</span>
            <span>{{ $post->created_at->format('d M Y') }}</span>
            @if($post->category)
                <span class="mx-2">•</span>
                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">{{ $post->category->name }}</span>
            @endif
        </div>
        @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-64 object-cover rounded mb-6">
        @endif
        <div class="prose dark:prose-invert max-w-none mb-6">
            {!! $post->content !!}
        </div>
        <div class="flex flex-wrap gap-2 mt-4">
            @foreach(($post->tags ?? []) as $tag)
                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">#{{ $tag->name }}</span>
            @endforeach
        </div>
    </div>
    <!-- Yorumlar Bölümü -->
    <div class="mt-10">
        <h2 class="text-xl font-semibold mb-4">Yorumlar</h2>
        @auth
        <form action="{{ route('comments.store', $post->slug) }}" method="POST" class="mb-6 bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
            @csrf
            <textarea name="content" rows="3" class="w-full rounded border-gray-300 dark:bg-gray-900 dark:text-white" placeholder="Yorumunuzu yazın..." required>{{ old('content') }}</textarea>
            @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            <div class="text-right mt-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Yorum Yap</button>
            </div>
        </form>
        @endauth
        @guest
        <div class="mb-6 bg-gray-100 dark:bg-gray-700 p-4 rounded-lg text-center">
            <p class="mb-3 text-gray-700 dark:text-gray-200">Yorum yapmak için kayıt olmalısın.</p>
            <a href="{{ route('register', ['redirect' => url()->current()]) }}" class="inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded font-semibold text-sm transition">Kayıt Ol</a>
        </div>
        @endguest
        <div class="space-y-4">
            @forelse($post->comments()->where('is_approved', true)->get() as $comment)
                <div class="bg-white dark:bg-gray-800 rounded p-4 shadow flex flex-col">
                    <div class="flex items-center mb-2">
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $comment->user->name ?? 'Anonim' }}</span>
                        <span class="mx-2 text-gray-400">•</span>
                        <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="text-gray-700 dark:text-gray-300">{{ $comment->content }}</div>
                </div>
            @empty
                <div class="text-gray-500">Henüz yorum yok.</div>
            @endforelse
        </div>
    </div>
</div>
@endif
@endsection 