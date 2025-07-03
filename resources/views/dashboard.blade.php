<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <div class="rounded-lg bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 p-1 shadow-lg">
                    <div class="bg-white dark:bg-gray-900 rounded-md px-6 py-5 flex flex-col sm:flex-row sm:items-center gap-2">
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">Merhaba, {{ Auth::user()->name }}!</span>
                        
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col gap-6">
                    <div class="flex justify-between items-center mb-6">
                        <span class="text-2xl font-bold">Blog Yazılarım</span> <span class="ml-0 sm:ml-4 text-lg text-gray-700 dark:text-gray-300">Bugün yeni bir yazı eklemeye ne dersin?</span>
                        <a href="{{ route('posts.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition">+ Post Oluştur</a>
                    </div>
                    <form method="GET" action="" class="mb-6 flex justify-center w-full">
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
                    @if($posts->count())
                        <div class="space-y-4">
                            @foreach($posts as $post)
                                <div class="p-4 bg-gray-100 dark:bg-gray-900 rounded shadow flex flex-col md:flex-row md:items-center md:justify-between">
                                    <div>
                                        <a href="{{ route('posts.show', $post->slug) }}" class="text-lg font-semibold text-blue-700 dark:text-blue-400 hover:underline">{{ $post->title }}</a>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $post->created_at->format('d.m.Y H:i') }}</div>
                                    </div>
                                    <div class="mt-2 md:mt-0 flex gap-2">
                                        <a href="{{ route('posts.edit', $post->slug) }}" class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded text-sm">Düzenle</a>
                                        <form action="{{ route('posts.destroy', $post->slug) }}" method="POST" onsubmit="return confirm('Silmek istediğine emin misin?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-sm">Sil</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-6">{{ $posts->links() }}</div>
                    @else
                        <div class="text-center text-gray-500 dark:text-gray-400 py-8">Henüz bir blog yazısı oluşturmadınız.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
