@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4">
    <h1 class="text-4xl font-bold mb-8 text-center">Blog Yazıları</h1>
    <!-- Arama Çubuğu -->
    <form method="GET" action="" class="mb-8 flex justify-center w-full">
        <div class="flex w-full max-w-2xl items-center gap-2 bg-gray-100 dark:bg-gray-900 rounded-lg p-2 shadow">
            <!-- Arama kutusu -->
            <div class="relative flex-1">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" /></svg>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Aramak istediğin başlık..." class="block w-full pl-10 pr-4 py-2 rounded-lg bg-white dark:bg-gray-800 text-pink-500 dark:text-pink-400 focus:outline-none focus:ring-2 focus:ring-pink-500 transition placeholder-pink-400 font-medium" />
            </div>
            <!-- Kategori dropdown -->
            <div class="flex-shrink-0">
                <select name="category" class="px-4 py-2 rounded-lg bg-white dark:bg-gray-800 text-pink-500 dark:text-pink-400 font-medium focus:outline-none focus:ring-2 focus:ring-pink-500">
                    <option value="">Kategoriler</option>
                    @php
                        $categories = \App\Models\Category::whereNull('parent_id')->get();
                        function renderCategoryOptions($categories, $level = 0) {
                            foreach ($categories as $cat) {
                                echo '<option value="' . $cat->id . '"';
                                if(request('category') == $cat->id) echo ' selected';
                                echo '>' . str_repeat('&nbsp;&nbsp;&nbsp;', $level) . ($level > 0 ? '└ ' : '') . $cat->name . '</option>';
                                if ($cat->children && $cat->children->count()) {
                                    renderCategoryOptions($cat->children, $level + 1);
                                }
                            }
                        }
                        renderCategoryOptions($categories);
                    @endphp
                </select>
            </div>
            <!-- Filtreler butonu -->
            <button type="submit" class="px-4 py-2 rounded-lg bg-white dark:bg-gray-800 text-pink-500 dark:text-pink-400 font-medium hover:bg-pink-100 dark:hover:bg-pink-900 transition">
                Filtrele
            </button>
        </div>
    </form>
    @auth
    <div class="flex justify-end mb-6">
        <a href="{{ route('posts.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition">+ Yeni Post Oluştur</a>
    </div>
    @endauth
    <div class="space-y-8">
        @forelse($posts as $post)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 hover:shadow-lg transition">
                <a href="#" class="block">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2 hover:text-blue-600">{{ $post->title }}</h2>
                </a>
                <div class="flex items-center text-sm text-gray-500 mb-2">
                    <span>{{ optional($post->user)->name ?? 'Anonim' }}</span>
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
                <div class="mt-4">
                    <a href="{{ route('posts.show', $post->slug) }}" class="inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded font-semibold text-sm transition">Devamını Oku</a>
                </div>
            </div>
        @empty
            <div class="text-center text-gray-500">Henüz blog yazısı yok.</div>
        @endforelse
    </div>
    <div class="mt-8">
        {{ $posts->links() }}
    </div>
</div>
@endsection 