@extends('layouts.app')

@section('content')
<style>
    :root {
        --color1: #8fd3fe;
        --color2: #eaf6fb;
        --color3: #19223a;
        --color4: #7b8ca7;
        --color5: #f4f8fb;
        --color6: #222e4a;
    }
    body { background: var(--color3); }
    .blog-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }
    .blog-header h1 {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--color1);
        margin-bottom: 0.5rem;
    }
    .blog-header p {
        color: var(--color4);
        font-size: 1.15rem;
    }
    .filter-bar {
        background: var(--color6);
        border-radius: 18px;
        padding: 2rem 2rem 1.5rem 2rem;
        margin-bottom: 2.5rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        box-shadow: 0 2px 16px 0 rgba(0,0,0,0.10);
    }
    .filter-form {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        width: 100%;
        justify-content: center;
        align-items: center;
    }
    .search-box {
        background: var(--color2);
        color: var(--color6);
        border-radius: 10px;
        border: none;
        padding: 0.9rem 1.2rem;
        font-size: 1.1rem;
        width: 320px;
        outline: none;
    }
    .category-select {
        background: var(--color2);
        color: var(--color6);
        border-radius: 10px;
        border: none;
        padding: 0.9rem 1.2rem;
        font-size: 1.1rem;
        min-width: 180px;
        outline: none;
    }
    .filter-btn {
        background: var(--color1);
        color: var(--color6);
        border-radius: 10px;
        border: none;
        padding: 0.9rem 1.5rem;
        font-size: 1.1rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: background 0.2s;
    }
    .filter-btn:hover {
        background: #6ec1f6;
    }
    .new-post-btn {
        background: var(--color1);
        color: var(--color6);
        border-radius: 10px;
        border: none;
        padding: 0.9rem 1.5rem;
        font-size: 1.1rem;
        font-weight: 600;
        margin-left: 1rem;
        transition: background 0.2s;
    }
    .new-post-btn:hover {
        background: #6ec1f6;
    }
    .post-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
        gap: 2.5rem;
    }
    .post-card {
        background: var(--color6);
        border-radius: 18px;
        box-shadow: 0 2px 16px 0 rgba(0,0,0,0.10);
        padding: 2.2rem 2rem 1.5rem 2rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 320px;
        transition: box-shadow 0.2s, transform 0.2s;
    }
    .post-card:hover {
        box-shadow: 0 8px 32px 0 rgba(0,0,0,0.18);
        transform: translateY(-4px) scale(1.02);
    }
    .post-title {
        font-size: 1.35rem;
        font-weight: 700;
        color: #fff;
        margin-bottom: 0.5rem;
    }
    .post-meta {
        font-size: 0.95rem;
        color: var(--color4);
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 1.1rem;
    }
    .post-content {
        color: var(--color5);
        font-size: 1.05rem;
        line-height: 1.6;
        margin-bottom: 1.1rem;
    }
    .tag {
        background: var(--color3);
        color: var(--color1);
        border: 1px solid var(--color1);
        border-radius: 999px;
        padding: 4px 14px;
        font-size: 13px;
        margin-right: 7px;
        margin-bottom: 8px;
        display: inline-block;
        font-weight: 500;
    }
    .read-more {
        background: var(--color1);
        color: var(--color6);
        border-radius: 10px;
        font-weight: 700;
        padding: 0.9rem 0;
        width: 100%;
        text-align: center;
        font-size: 1.1rem;
        margin-top: 1.2rem;
        transition: background 0.2s;
        display: block;
        text-decoration: none;
    }
    .read-more:hover {
        background: #6ec1f6;
        color: #19223a;
    }
    @media (max-width: 600px) {
        .filter-bar { padding: 1rem; }
        .post-card { padding: 1.2rem 1rem; }
        .post-grid { gap: 1.2rem; }
    }
</style>

<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="blog-header">
        <h1>Blog Yazıları</h1>
        <p>Güncel içerikler ve değerli bilgiler</p>
    </div>
    <div class="filter-bar">
        <form method="GET" action="" class="filter-form">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Aramak istediğin başlık..." class="search-box" />
            <select name="category" class="category-select">
                <option value="">Tüm Kategoriler</option>
                @php
                    $categories = \App\Models\Category::whereNull('parent_id')->get();
                    function renderCategoryOptions($categories, $level = 0) {
                        foreach ($categories as $cat) {
                            echo '<option value="' . $cat->id . '"';
                            if(request('category') == $cat->id) echo ' selected';
                            echo '>' . str_repeat('--', $level) . ' ' . $cat->name . '</option>';
                            if ($cat->children && $cat->children->count()) {
                                renderCategoryOptions($cat->children, $level + 1);
                            }
                        }
                    }
                    renderCategoryOptions($categories);
                @endphp
            </select>
            <button type="submit" class="filter-btn">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L15 13.414V19a1 1 0 01-1.447.894l-4-2A1 1 0 019 17v-3.586L3.293 6.707A1 1 0 013 6V4z" /></svg>
                Filtrele
            </button>
            @auth
            <a href="{{ route('posts.create') }}" class="new-post-btn">+ Yeni Post Oluştur</a>
            @endauth
        </form>
    </div>
    <div class="post-grid">
        @forelse($posts as $post)
        <div class="post-card">
            <div>
                <h2 class="post-title">{{ $post->title }}</h2>
                <div class="post-meta">
                    <span>👤 {{ optional($post->user)->name ?? 'Anonim' }}</span>
                    <span>🗓️ {{ $post->created_at->diffForHumans() }}</span>
                </div>
                <div class="post-content">
                    {{ Str::limit(strip_tags($post->content), 160) }}
                </div>
                <div class="flex flex-wrap mt-2">
                    @foreach($post->tags as $tag)
                        <span class="tag">#{{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>
            <a href="{{ route('posts.show', $post->slug) }}" class="read-more">Devamını Oku &rarr;</a>
        </div>
        @empty
            <div class="text-center text-[var(--color4)] col-span-full">Henüz blog yazısı yok.</div>
        @endforelse
    </div>
    <div class="mt-12">
        {{ $posts->links() }}
    </div>
</div>
@endsection
