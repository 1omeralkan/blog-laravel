@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-4">
    <h1 class="text-3xl font-bold mb-8 text-center">Kategoriler</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        @forelse($categories as $category)
            <a href="{{ route('categories.show', $category->slug) }}" class="block bg-white dark:bg-gray-800 rounded-lg shadow p-6 hover:shadow-lg transition group">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white group-hover:text-blue-600 mb-2">{{ $category->name }}</h2>
                <p class="text-gray-600 dark:text-gray-300 text-sm line-clamp-2">{{ $category->description }}</p>
            </a>
        @empty
            <div class="text-center text-gray-500">Henüz kategori yok.</div>
        @endforelse
    </div>
</div>
@endsection 