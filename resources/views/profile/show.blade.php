@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-4">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-8 flex flex-col items-center">
        <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}" alt="Profil Fotoğrafı" class="w-28 h-28 rounded-full mb-4 object-cover">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $user->name }}</h1>
        @if($user->bio)
            <p class="text-gray-600 dark:text-gray-300 mb-4 text-center">{{ $user->bio }}</p>
        @endif
        <div class="w-full mt-8">
            <h2 class="text-lg font-semibold mb-4">Blog Yazıları</h2>
            <div class="space-y-4">
                @forelse($user->posts as $post)
                    <a href="{{ route('posts.show', $post->slug) }}" class="block bg-gray-100 dark:bg-gray-700 rounded p-4 hover:shadow">
                        <div class="font-semibold text-gray-900 dark:text-white">{{ $post->title }}</div>
                        <div class="text-sm text-gray-500">{{ $post->created_at->format('d M Y') }}</div>
                    </a>
                @empty
                    <div class="text-gray-500">Henüz blog yazısı yok.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection 