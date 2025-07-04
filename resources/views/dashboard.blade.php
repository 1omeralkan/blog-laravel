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
            max-width: 800px;
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
            gap: 0.4rem;
            margin-bottom: 1.7rem;
            align-items: center;
        }
        .muk-dash-search {
            flex: 2 1 0;
            padding: 0.8rem 1.1rem 0.8rem 2.2rem;
            border-radius: 12px;
            border: none;
            background: rgba(255,255,255,0.18);
            color: #fff;
            font-size: 1.05rem;
            transition: box-shadow 0.2s, background 0.2s;
            width: 100%;
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
            flex: 0 0 auto;
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
    </style>
    <div class="muk-dash-outer">
        <div class="muk-dash-card">
            <div class="muk-dash-title">Blog Yazılarım</div>
            <div class="muk-dash-subtitle">Bugün yeni bir yazı eklemeye ne dersin?</div>
            <a href="{{ route('posts.create') }}" class="muk-dash-btn">+ Post Oluştur</a>
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
            <form method="GET" action="" class="muk-dash-form">
                <div class="relative w-full">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-blue-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" /></svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Aramak istediğin başlık..." class="muk-dash-search pl-10" />
                </div>
                <div id="category-tree-dropdown"></div>
                <input type="hidden" name="category" id="selected-categories-input" value="">
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
    <script>
    function renderCategoryTree(tree, selected, level = 0, parentId = null) {
        let html = '<ul>';
        tree.forEach(cat => {
            html += '<li>';
            html += `<label><input type=\"checkbox\" value=\"${cat.id}\" data-parent=\"${parentId !== null ? parentId : ''}\" ${selected.includes(String(cat.id)) ? 'checked' : ''}>`;
            html += (level > 0 ? '<span style=\"opacity:0.7;\">↳</span> ' : '') + cat.name + '</label>';
            if (cat.children && cat.children.length) {
                html += '<div class=\"cat-children\">' + renderCategoryTree(cat.children, selected, level + 1, cat.id) + '</div>';
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
            return `<span class=\"cat-tag\" data-id=\"${cat.id}\">${cat.name}<span class=\"remove\" title=\"Kaldır\">×</span></span>`;
        }).join('');
    }
    function setIndeterminateStates(list) {
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
            <div class=\"cat-selected-tags\" id=\"cat-selected-tags\"></div>
            <button type=\"button\" class=\"cat-dropdown-btn\">Kategori seçin</button>
            <div class=\"cat-dropdown-list\">${renderCategoryTree(tree, selected)}</div>
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
                const childCheckboxes = list.querySelectorAll(`input[data-parent='${val}']`);
                childCheckboxes.forEach(cb => {
                    cb.checked = isChecked;
                    if (isChecked && !selected.includes(cb.value)) selected.push(cb.value);
                    if (!isChecked) selected = selected.filter(x => x !== cb.value);
                });
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
                const cb = list.querySelector(`input[type=checkbox][value=\"${id}\"]`);
                if (cb) {
                    cb.checked = false;
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
</x-app-layout>
