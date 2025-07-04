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
    .cat-dropdown {
        position: relative;
        display: inline-block;
        min-width: 260px;
    }
    .cat-dropdown-btn {
        background: rgba(255,255,255,0.13);
        color: #eaf6fb;
        border-radius: 10px;
        border: none;
        padding: 0.9rem 1.2rem;
        font-size: 1.1rem;
        min-width: 180px;
        outline: none;
        cursor: pointer;
        width: 100%;
        text-align: left;
    }
    .cat-dropdown-list {
        display: none;
        position: absolute;
        background: #232e4a;
        color: #eaf6fb;
        min-width: 260px;
        max-height: 320px;
        overflow-y: auto;
        border-radius: 10px;
        box-shadow: 0 4px 24px 0 rgba(31,38,135,0.10);
        z-index: 1000;
        padding: 0.7rem 0.5rem;
    }
    .cat-dropdown.open .cat-dropdown-list {
        display: block;
    }
    .cat-dropdown-list ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .cat-dropdown-list li {
        padding-left: 0.5rem;
        margin-bottom: 0.2rem;
    }
    .cat-dropdown-list label {
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1.05rem;
        font-weight: 500;
        padding: 0.2rem 0.2rem 0.2rem 0.5rem;
        border-radius: 6px;
        transition: background 0.15s;
    }
    .cat-dropdown-list label:hover {
        background: rgba(143,211,254,0.10);
    }
    .cat-dropdown-list .cat-children {
        margin-left: 1.2rem;
        border-left: 1.5px solid #8fd3fe33;
        padding-left: 0.7rem;
    }
    .cat-selected-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.4rem;
        margin-bottom: 0.5rem;
    }
    .cat-tag {
        background: linear-gradient(90deg, #8fd3fe 0%, #6ec1f6 100%);
        color: #222e4a;
        border-radius: 8px;
        padding: 0.2rem 0.7rem;
        font-size: 0.98rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.3rem;
        cursor: pointer;
    }
    .cat-tag .remove {
        font-size: 1.1em;
        margin-left: 0.2em;
        cursor: pointer;
    }
    .post-avatar-effect {
        display: inline-block;
        border-radius: 50%;
        box-shadow: 0 1px 6px 0 rgba(31,38,135,0.13), 0 0 0 2px #8fd3fe44;
        transition: box-shadow 0.22s, transform 0.16s;
        padding: 1.5px;
        background: linear-gradient(120deg, #e0e7ef 0%, #8fd3fe 100%);
        position: relative;
    }
    .post-avatar-effect:hover {
        box-shadow: 0 4px 16px 0 #6ec1f6cc, 0 0 0 4px #8fd3fe99;
        transform: scale(1.07);
    }
    .post-avatar-img {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        object-fit: cover;
        border: 1.5px solid #fff;
        background: #f3f6fa;
        transition: border 0.18s;
    }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('category-select');
        if (categorySelect) {
            new Choices(categorySelect, {
                removeItemButton: true,
                searchEnabled: true,
                placeholder: true,
                placeholderValue: 'Kategori seçin',
                noResultsText: 'Sonuç yok',
                noChoicesText: 'Kategori yok',
                itemSelectText: 'Seç',
            });
        }
    });
</script>

@php
    function buildCategoryTree($categories) {
        return $categories->map(function($cat) {
            $arr = [
                'id' => $cat->id,
                'name' => $cat->name,
                'children' => $cat->children && $cat->children->count() ? buildCategoryTree($cat->children) : [],
            ];
            return $arr;
        });
    }
    $categoriesTree = buildCategoryTree(\App\Models\Category::whereNull('parent_id')->with('children')->get());
@endphp
<script>
    window.categoryTree = @json($categoriesTree);
    window.selectedCategories = @json(request('category', []));
</script>

<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="blog-header">
        <h1>Blog Yazıları</h1>
        <p>Güncel içerikler ve değerli bilgiler</p>
    </div>
    <div class="filter-bar">
        <form method="GET" action="" class="filter-form">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Aramak istediğin başlık..." class="search-box" />
            <div id="category-tree-dropdown"></div>
            <input type="hidden" name="category" id="selected-categories-input" value="">
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
            <div class="flex items-start gap-5 w-full">
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-20 h-20 object-cover rounded-xl shadow-lg border border-gray-300 dark:border-gray-700 flex-shrink-0 mt-1" />
                @endif
                <div class="flex flex-col justify-center flex-1">
                    <h2 class="post-title">{{ $post->title }}</h2>
                    <div class="post-meta">
                        @if($post->user)
                            <span class="inline-flex items-center gap-2">
                                <span class="post-avatar-effect">
                                    <img src="{{ $post->user->profile_photo_url }}" alt="{{ $post->user->name }}" class="post-avatar-img" />
                                </span>
                                {{ $post->user->name }}
                            </span>
                        @else
                            <span>Anonim</span>
                        @endif
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

<script>
function renderCategoryTree(tree, selected, level = 0, parentId = null) {
    let html = '<ul>';
    tree.forEach(cat => {
        html += '<li>';
        html += `<label><input type="checkbox" value="${cat.id}" data-parent="${parentId !== null ? parentId : ''}" ${selected.includes(String(cat.id)) ? 'checked' : ''}>`;
        html += (level > 0 ? '<span style="opacity:0.7;">↳</span> ' : '') + cat.name + '</label>';
        if (cat.children && cat.children.length) {
            html += '<div class="cat-children">' + renderCategoryTree(cat.children, selected, level + 1, cat.id) + '</div>';
        }
        html += '</li>';
    });
    html += '</ul>';
    return html;
}
function updateSelectedTags(selected, allCats) {
    const flat = (arr) => arr.reduce((a, c) => a.concat([{id: c.id, name: c.name}], c.children ? flat(c.children) : []), []);
    const all = flat(allCats);
    return selected.map(id => {
        const cat = all.find(c => String(c.id) === String(id));
        if (!cat) return '';
        return `<span class="cat-tag" data-id="${cat.id}">${cat.name}<span class="remove" title="Kaldır">×</span></span>`;
    }).join('');
}
function setIndeterminateStates(list) {
    // Her parent için child'ların durumuna göre indeterminate ayarla
    const checkboxes = list.querySelectorAll('input[type=checkbox]');
    const byId = {};
    checkboxes.forEach(cb => byId[cb.value] = cb);
    checkboxes.forEach(cb => {
        const parentId = cb.getAttribute('data-parent');
        if (parentId && byId[parentId]) {
            const siblings = Array.from(list.querySelectorAll(`input[data-parent='${parentId}']`));
            const allChecked = siblings.every(sib => sib.checked);
            const noneChecked = siblings.every(sib => !sib.checked);
            byId[parentId].indeterminate = !allChecked && !noneChecked;
            byId[parentId].checked = allChecked;
        }
    });
}
document.addEventListener('DOMContentLoaded', function() {
    const tree = window.categoryTree || [];
    let selected = Array.isArray(window.selectedCategories) ? window.selectedCategories.map(String) : (window.selectedCategories ? [String(window.selectedCategories)] : []);
    const dropdown = document.createElement('div');
    dropdown.className = 'cat-dropdown';
    dropdown.innerHTML = `
        <div class="cat-selected-tags" id="cat-selected-tags"></div>
        <button type="button" class="cat-dropdown-btn">Kategori seçin</button>
        <div class="cat-dropdown-list">${renderCategoryTree(tree, selected)}</div>
    `;
    const container = document.getElementById('category-tree-dropdown');
    container.innerHTML = '';
    container.appendChild(dropdown);
    const btn = dropdown.querySelector('.cat-dropdown-btn');
    const list = dropdown.querySelector('.cat-dropdown-list');
    const tags = dropdown.querySelector('#cat-selected-tags');
    const input = document.getElementById('selected-categories-input');
    function syncInput() {
        input.value = selected.join(',');
    }
    function syncTags() {
        tags.innerHTML = updateSelectedTags(selected, tree);
    }
    function syncIndeterminate() {
        setIndeterminateStates(list);
    }
    syncInput();
    syncTags();
    syncIndeterminate();
    btn.addEventListener('click', function(e) {
        dropdown.classList.toggle('open');
    });
    document.addEventListener('click', function(e) {
        if (!dropdown.contains(e.target)) dropdown.classList.remove('open');
    });
    list.addEventListener('change', function(e) {
        if (e.target.type === 'checkbox') {
            const val = e.target.value;
            const isChecked = e.target.checked;
            // Parent seçilirse tüm child'ları seç
            const childCheckboxes = list.querySelectorAll(`input[data-parent='${val}']`);
            childCheckboxes.forEach(cb => {
                cb.checked = isChecked;
                if (isChecked && !selected.includes(cb.value)) selected.push(cb.value);
                if (!isChecked) selected = selected.filter(x => x !== cb.value);
            });
            // Child seçilirse parent'ı kontrol et
            const parentId = e.target.getAttribute('data-parent');
            if (parentId) {
                const siblings = Array.from(list.querySelectorAll(`input[data-parent='${parentId}']`));
                const parentCb = list.querySelector(`input[type=checkbox][value='${parentId}']`);
                if (parentCb) {
                    const allChecked = siblings.every(sib => sib.checked);
                    const noneChecked = siblings.every(sib => !sib.checked);
                    parentCb.indeterminate = !allChecked && !noneChecked;
                    parentCb.checked = allChecked;
                    if (allChecked && !selected.includes(parentId)) selected.push(parentId);
                    if (!allChecked) selected = selected.filter(x => x !== parentId);
                }
            }
            // Kendi seçimini işle
            if (isChecked && !selected.includes(val)) selected.push(val);
            if (!isChecked) selected = selected.filter(x => x !== val);
            syncInput();
            syncTags();
            syncIndeterminate();
        }
    });
    tags.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove')) {
            const id = e.target.parentElement.getAttribute('data-id');
            selected = selected.filter(x => x !== id);
            // Uncheck in dropdown
            const cb = list.querySelector(`input[type=checkbox][value="${id}"]`);
            if (cb) {
                cb.checked = false;
                // Child'ları da kaldır
                const childCheckboxes = list.querySelectorAll(`input[data-parent='${id}']`);
                childCheckboxes.forEach(childCb => {
                    childCb.checked = false;
                    selected = selected.filter(x => x !== childCb.value);
                });
            }
            syncInput();
            syncTags();
            syncIndeterminate();
        }
    });
});
</script>
@endsection
