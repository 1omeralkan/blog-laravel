@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10 px-4">
    <h1 class="text-3xl font-bold mb-8 text-center">Yeni Blog Yazısı</h1>
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white dark:bg-gray-800 p-8 rounded-lg shadow">
        @csrf
        <div>
            <label class="block font-medium mb-1">Başlık</label>
            <input type="text" name="title" class="w-full rounded border-gray-300 dark:bg-gray-900 dark:text-white" value="{{ old('title') }}" required>
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label class="block font-medium mb-1">İçerik</label>
            <textarea name="content" rows="6" class="w-full rounded border-gray-300 dark:bg-gray-900 dark:text-white" required>{{ old('content') }}</textarea>
            @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label class="block font-medium mb-1">Kategori</label>
            <select name="category_id" class="w-full rounded border-gray-300 dark:bg-gray-900 dark:text-white">
                <option value="">Seçiniz</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label class="block font-medium mb-1">Etiketler</label>
            <select name="tags[]" multiple class="w-full rounded border-gray-300 dark:bg-gray-900 dark:text-white">
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" @selected(collect(old('tags'))->contains($tag->id))>#{{ $tag->name }}</option>
                @endforeach
            </select>
            @error('tags') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label class="block font-medium mb-1">Kapak Görseli</label>
            <input type="file" name="image" class="w-full">
            @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label class="block font-medium mb-1">Meta Başlık</label>
            <input type="text" name="meta_title" class="w-full rounded border-gray-300 dark:bg-gray-900 dark:text-white" value="{{ old('meta_title') }}">
            @error('meta_title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label class="block font-medium mb-1">Meta Açıklama</label>
            <textarea name="meta_description" rows="2" class="w-full rounded border-gray-300 dark:bg-gray-900 dark:text-white">{{ old('meta_description') }}</textarea>
            @error('meta_description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="text-center">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Oluştur</button>
        </div>
    </form>
</div>
@endsection 