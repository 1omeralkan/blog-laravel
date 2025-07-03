<x-app-layout>
    <style>
        body {
            background: linear-gradient(135deg, #8fd3fe 0%, #19223a 100%);
            min-height: 100vh;
        }
        .muk-dash-outer {
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .muk-dash-card {
            background: rgba(255,255,255,0.13);
            backdrop-filter: blur(10px);
            border-radius: 28px;
            box-shadow: 0 8px 32px 0 rgba(31,38,135,0.18);
            padding: 2.5rem 2.5rem 2rem 2.5rem;
            max-width: 540px;
            width: 100%;
            animation: fadeInUp 0.8s cubic-bezier(.39,.575,.565,1.000);
        }
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(40px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .muk-dash-title {
            font-size: 2.1rem;
            font-weight: 800;
            color: #fff;
            text-align: center;
            margin-bottom: 0.3rem;
            letter-spacing: 1px;
        }
        .muk-dash-subtitle {
            color: #b6c6e3;
            font-size: 1.08rem;
            text-align: center;
            margin-bottom: 1.7rem;
        }
        .muk-dash-btn {
            display: block;
            margin: 0.5rem auto 1.5rem auto;
            padding: 0.8rem 2.2rem;
            border-radius: 14px;
            background: linear-gradient(90deg, #8fd3fe 0%, #6ec1f6 100%);
            color: #222e4a;
            font-weight: 700;
            font-size: 1.1rem;
            border: none;
            box-shadow: 0 2px 8px 0 rgba(31,38,135,0.10);
            transition: background 0.22s, color 0.22s, transform 0.18s;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
        }
        .muk-dash-btn:hover {
            background: linear-gradient(90deg, #6ec1f6 0%, #8fd3fe 100%);
            color: #19223a;
            transform: translateY(-2px) scale(1.04);
        }
        .muk-dash-form {
            display: flex;
            gap: 0.7rem;
            margin-bottom: 1.7rem;
        }
        .muk-dash-search {
            flex: 2;
            padding: 0.8rem 1.1rem 0.8rem 2.2rem;
            border-radius: 12px;
            border: none;
            background: rgba(255,255,255,0.18);
            color: #fff;
            font-size: 1.05rem;
            transition: box-shadow 0.2s, background 0.2s;
        }
        .muk-dash-search:focus {
            outline: none;
            background: #eaf6fb;
            color: #222e4a;
            box-shadow: 0 0 0 2px #8fd3fe;
        }
        .muk-dash-select {
            flex: 1;
            padding: 0.8rem 1.1rem;
            border-radius: 12px;
            background: rgba(255,255,255,0.18);
            color: #fff;
            font-weight: 600;
            font-size: 1.05rem;
            border: none;
            transition: background 0.2s, color 0.2s, transform 0.15s;
        }
        .muk-dash-select:focus {
            outline: none;
            background: #eaf6fb;
            color: #222e4a;
        }
        .muk-dash-filter-btn {
            padding: 0.8rem 1.3rem;
            border-radius: 12px;
            background: linear-gradient(90deg, #8fd3fe 0%, #6ec1f6 100%);
            color: #222e4a;
            font-weight: 700;
            font-size: 1.05rem;
            border: none;
            transition: background 0.2s, color 0.2s, transform 0.15s;
        }
        .muk-dash-filter-btn:hover {
            background: linear-gradient(90deg, #6ec1f6 0%, #8fd3fe 100%);
            color: #19223a;
            transform: translateY(-2px) scale(1.04);
        }
        .muk-dash-post-card {
            background: rgba(255,255,255,0.13);
            border-radius: 18px;
            box-shadow: 0 4px 16px 0 rgba(31,38,135,0.10);
            padding: 1.5rem 1.2rem;
            margin-bottom: 1.2rem;
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
            animation: fadeInUp 0.7s cubic-bezier(.39,.575,.565,1.000);
        }
        .muk-dash-post-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #8fd3fe;
            margin-bottom: 0.3rem;
        }
        .muk-dash-post-date {
            color: #b6c6e3;
            font-size: 0.95rem;
        }
        .muk-dash-post-actions a, .muk-dash-post-actions button {
            margin-right: 0.5rem;
        }
        .muk-dash-empty {
            text-align: center;
            color: #b6c6e3;
            padding: 2.5rem 0 1.5rem 0;
            font-size: 1.13rem;
        }
    </style>
    <div class="muk-dash-outer">
        <div class="muk-dash-card">
            <div class="muk-dash-title">Blog Yazılarım</div>
            <div class="muk-dash-subtitle">Bugün yeni bir yazı eklemeye ne dersin?</div>
            <a href="{{ route('posts.create') }}" class="muk-dash-btn">+ Post Oluştur</a>
            <form method="GET" action="" class="muk-dash-form">
                <div class="relative w-full">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-blue-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" /></svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Aramak istediğin başlık..." class="muk-dash-search pl-10" />
                </div>
                <select name="category" class="muk-dash-select">
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
                <button type="submit" class="muk-dash-filter-btn">Filtrele</button>
            </form>
            @if($posts->count())
                <div class="space-y-4">
                    @foreach($posts as $post)
                        <div class="muk-dash-post-card">
                            <div class="flex items-center gap-6 w-full">
                                @if($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-20 h-20 object-cover rounded-xl shadow-lg border border-gray-300 dark:border-gray-700 flex-shrink-0" />
                                @endif
                                <div class="flex flex-col justify-center flex-1">
                                    <a href="{{ route('posts.show', $post->slug) }}" class="muk-dash-post-title hover:underline">{{ $post->title }}</a>
                                    <div class="muk-dash-post-date">{{ $post->created_at->format('d.m.Y H:i') }}</div>
                                    <div class="flex gap-2 mt-3 muk-dash-post-actions">
                                        <a href="{{ route('posts.show', $post->slug) }}" class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded text-sm">Devamını Oku</a>
                                        <a href="{{ route('posts.edit', $post->slug) }}" class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded text-sm">Düzenle</a>
                                        <form action="{{ route('posts.destroy', $post->slug) }}" method="POST" onsubmit="return confirm('Silmek istediğine emin misin?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-sm">Sil</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-6">{{ $posts->links() }}</div>
            @else
                <div class="muk-dash-empty">Henüz bir blog yazısı oluşturmadınız.</div>
            @endif
        </div>
    </div>
</x-app-layout>
