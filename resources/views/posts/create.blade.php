@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #8fd3fe 0%, #19223a 100%);
        min-height: 100vh;
    }
    .muk-edit-outer {
        min-height: 80vh;
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding-top: 2.5rem;
    }
    .muk-edit-card {
        background: rgba(255,255,255,0.13);
        backdrop-filter: blur(10px);
        border-radius: 28px;
        box-shadow: 0 8px 32px 0 rgba(31,38,135,0.18);
        padding: 2.5rem 2.5rem 2rem 2.5rem;
        max-width: 600px;
        width: 100%;
        animation: fadeInUp 0.8s cubic-bezier(.39,.575,.565,1.000);
    }
    @keyframes fadeInUp {
        0% { opacity: 0; transform: translateY(40px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .muk-edit-title {
        font-size: 2rem;
        font-weight: 900;
        color: #fff;
        margin-bottom: 1.7rem;
        letter-spacing: 1px;
        text-align: center;
    }
    .muk-edit-form label {
        color: #eaf6fb;
        font-weight: 600;
        margin-bottom: 0.3rem;
        display: block;
        font-size: 1.07rem;
    }
    .muk-edit-form input[type="text"],
    .muk-edit-form textarea,
    .muk-edit-form select {
        width: 100%;
        padding: 0.9rem 1.1rem;
        border-radius: 12px;
        border: none;
        background: rgba(255,255,255,0.18);
        color: #fff;
        font-size: 1.08rem;
        margin-bottom: 1.1rem;
        transition: box-shadow 0.2s, background 0.2s;
    }
    .muk-edit-form input:focus,
    .muk-edit-form textarea:focus,
    .muk-edit-form select:focus {
        outline: none;
        background: #eaf6fb;
        color: #222e4a;
        box-shadow: 0 0 0 2px #8fd3fe;
    }
    .muk-edit-form input[type="file"] {
        background: none;
        color: #eaf6fb;
        margin-bottom: 1.1rem;
    }
    .muk-edit-form img {
        width: 100%;
        max-height: 180px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 0.7rem;
        box-shadow: 0 2px 8px 0 rgba(31,38,135,0.10);
    }
    .muk-edit-form .text-red-500 {
        margin-top: -0.7rem;
        margin-bottom: 0.7rem;
        display: block;
    }
    .muk-edit-btn {
        display: block;
        margin: 0.7rem auto 0 auto;
        padding: 0.9rem 2.2rem;
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
        outline: none;
    }
    .muk-edit-btn:hover {
        background: linear-gradient(90deg, #6ec1f6 0%, #8fd3fe 100%);
        color: #19223a;
        transform: translateY(-2px) scale(1.04);
    }
</style>
<div class="muk-edit-outer">
    <div class="muk-edit-card">
        <div class="muk-edit-title">Yeni Blog Yazısı</div>
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="muk-edit-form">
            @csrf
            <div>
                <label>Başlık</label>
                <input type="text" name="title" value="{{ old('title') }}" required>
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label>İçerik</label>
                <textarea name="content" rows="6" required>{{ old('content') }}</textarea>
                @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label>Kategori</label>
                <select name="category_id">
                    <option value="">Seçiniz</option>
                    @php
                        function renderCategoryOptionsCreate($categories, $selected = null, $level = 0) {
                            foreach ($categories as $cat) {
                                $prefix = $level > 0 ? str_repeat('⎯⎯ ', $level-1) . '↳ ' : '';
                                $padding = $level > 0 ? 'padding-left:' . (18 * $level) . 'px;' : '';
                                echo '<option value="' . $cat->id . '" style="' . $padding . '"';
                                if($selected == $cat->id) echo ' selected';
                                echo '>' . $prefix . $cat->name . '</option>';
                                if ($cat->children && $cat->children->count()) {
                                    renderCategoryOptionsCreate($cat->children, $selected, $level + 1);
                                }
                            }
                        }
                        renderCategoryOptionsCreate($categories->whereNull('parent_id'), old('category_id'));
                    @endphp
                </select>
                @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label>Etiketler</label>
                <select name="tags[]" multiple>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}" @selected(collect(old('tags'))->contains($tag->id))>#{{ $tag->name }}</option>
                    @endforeach
                </select>
                @error('tags') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label>Kapak Görseli</label>
                <input type="file" name="image">
                @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label>Meta Başlık</label>
                <input type="text" name="meta_title" value="{{ old('meta_title') }}">
                @error('meta_title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label>Meta Açıklama</label>
                <textarea name="meta_description" rows="2">{{ old('meta_description') }}</textarea>
                @error('meta_description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="muk-edit-btn">Oluştur</button>
        </form>
    </div>
</div>
@endsection 