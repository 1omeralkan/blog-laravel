@extends('layouts.app')

@section('content')
@if(!$post)
    <div class="max-w-2xl mx-auto py-10 px-4">
        <div class="bg-red-100 text-red-800 rounded-lg shadow p-6 text-center text-xl font-semibold">
            Yazı bulunamadı veya silinmiş.
        </div>
    </div>
@else
<style>
    body {
        background: linear-gradient(135deg, #8fd3fe 0%, #19223a 100%);
        min-height: 100vh;
    }
    .muk-post-outer {
        min-height: 80vh;
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding-top: 2.5rem;
    }
    .muk-post-card {
        background: rgba(255,255,255,0.13);
        backdrop-filter: blur(10px);
        border-radius: 28px;
        box-shadow: 0 8px 32px 0 rgba(31,38,135,0.18);
        padding: 2.5rem 2.5rem 2rem 2.5rem;
        max-width: 700px;
        width: 100%;
        animation: fadeInUp 0.8s cubic-bezier(.39,.575,.565,1.000);
    }
    @keyframes fadeInUp {
        0% { opacity: 0; transform: translateY(40px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .muk-post-title {
        font-size: 2.3rem;
        font-weight: 900;
        color: #fff;
        margin-bottom: 0.7rem;
        letter-spacing: 1px;
        text-align: center;
    }
    .muk-post-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 0.7rem;
        justify-content: center;
        align-items: center;
        color: #b6c6e3;
        font-size: 1.01rem;
        margin-bottom: 1.2rem;
    }
    .muk-post-meta .muk-post-author {
        color: #8fd3fe;
        font-weight: 700;
    }
    .muk-post-meta .muk-post-category {
        background: #8fd3fe22;
        color: #8fd3fe;
        font-size: 0.98rem;
        font-weight: 600;
        border-radius: 8px;
        padding: 0.2rem 0.8rem;
    }
    .muk-post-image {
        width: 100%;
        max-height: 340px;
        object-fit: cover;
        border-radius: 18px;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 12px 0 rgba(31,38,135,0.10);
    }
    .muk-post-content {
        color: #eaf6fb;
        font-size: 1.13rem;
        margin-bottom: 1.7rem;
        line-height: 1.7;
        word-break: break-word;
    }
    .muk-post-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
        justify-content: center;
    }
    .muk-post-tag {
        background: linear-gradient(90deg, #8fd3fe 0%, #6ec1f6 100%);
        color: #222e4a;
        font-size: 0.97rem;
        font-weight: 600;
        border-radius: 8px;
        padding: 0.2rem 0.9rem;
        box-shadow: 0 1px 4px 0 rgba(31,38,135,0.10);
        transition: background 0.2s, color 0.2s;
    }
    .muk-post-tag:hover {
        background: linear-gradient(90deg, #6ec1f6 0%, #8fd3fe 100%);
        color: #19223a;
    }
    /* Yorumlar */
    .muk-comment-form {
        background: rgba(255,255,255,0.10);
        border-radius: 16px;
        box-shadow: 0 2px 8px 0 rgba(31,38,135,0.10);
        padding: 1.2rem 1.2rem 1rem 1.2rem;
        margin-bottom: 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 0.7rem;
    }
    .muk-comment-form textarea {
        width: 100%;
        min-height: 70px;
        padding: 0.8rem 1rem;
        border-radius: 10px;
        border: none;
        background: rgba(255,255,255,0.18);
        color: #fff;
        font-size: 1.04rem;
        transition: box-shadow 0.2s, background 0.2s;
        resize: vertical;
    }
    .muk-comment-form textarea:focus {
        outline: none;
        background: #eaf6fb;
        color: #222e4a;
        box-shadow: 0 0 0 2px #8fd3fe;
    }
    .muk-comment-btn {
        padding: 0.7rem 1.5rem;
        border-radius: 10px;
        background: linear-gradient(90deg, #8fd3fe 0%, #6ec1f6 100%);
        color: #222e4a;
        font-weight: 700;
        font-size: 1.01rem;
        border: none;
        box-shadow: 0 2px 8px 0 rgba(31,38,135,0.10);
        transition: background 0.2s, color 0.2s, transform 0.15s;
    }
    .muk-comment-btn:hover {
        background: linear-gradient(90deg, #6ec1f6 0%, #8fd3fe 100%);
        color: #19223a;
        transform: translateY(-2px) scale(1.03);
    }
    .muk-comment-list {
        display: flex;
        flex-direction: column;
        gap: 1.1rem;
    }
    .muk-comment-card {
        background: rgba(255,255,255,0.13);
        border-radius: 14px;
        box-shadow: 0 2px 8px 0 rgba(31,38,135,0.10);
        padding: 1.1rem 1.1rem 0.9rem 1.1rem;
        display: flex;
        gap: 0.9rem;
        align-items: flex-start;
    }
    .muk-comment-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: linear-gradient(135deg, #8fd3fe 0%, #6ec1f6 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: #fff;
        font-size: 1.1rem;
        flex-shrink: 0;
    }
    .muk-comment-content {
        flex: 1;
    }
    .muk-comment-meta {
        display: flex;
        align-items: center;
        gap: 0.7rem;
        margin-bottom: 0.2rem;
    }
    .muk-comment-author {
        font-weight: 700;
        color: #8fd3fe;
        font-size: 1.01rem;
    }
    .muk-comment-date {
        color: #b6c6e3;
        font-size: 0.93rem;
    }
    .muk-comment-text {
        color: #eaf6fb;
        font-size: 1.01rem;
    }
    .muk-comment-empty {
        text-align: center;
        color: #b6c6e3;
        padding: 1.5rem 0 0.5rem 0;
        font-size: 1.08rem;
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
<div class="muk-post-outer">
    <div class="muk-post-card">
        <div class="muk-post-title">{{ $post->title }}</div>
        <div class="muk-post-meta">
            @if($post->user)
                <span class="inline-flex items-center gap-2">
                    <span class="post-avatar-effect">
                        <img src="{{ $post->user->profile_photo_url }}" alt="{{ $post->user->name }}" class="post-avatar-img" />
                    </span>
                    <span class="muk-post-author">{{ $post->user->name }}</span>
                </span>
            @else
                <span class="muk-post-author">Anonim</span>
            @endif
            <span>•</span>
            <span>{{ $post->created_at->format('d M Y') }}</span>
            @if($post->category)
                <span>•</span>
                <span class="muk-post-category">{{ $post->category->name }}</span>
            @endif
        </div>
        @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="muk-post-image">
        @endif
        <div class="muk-post-content">
            {!! $post->content !!}
        </div>
        @if($post->tags && count($post->tags))
        <div class="muk-post-tags">
            @foreach($post->tags as $tag)
                <span class="muk-post-tag">#{{ $tag->name }}</span>
            @endforeach
        </div>
        @endif
        <div class="mt-10">
            <h2 class="text-xl font-semibold mb-4" style="color:#fff;">Yorumlar</h2>
            @auth
            <form action="{{ route('comments.store', $post->slug) }}" method="POST" class="muk-comment-form">
                @csrf
                <textarea name="content" placeholder="Yorumunuzu yazın..." required>{{ old('content') }}</textarea>
                @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                <div class="text-right">
                    <button type="submit" class="muk-comment-btn">Yorum Yap</button>
                </div>
            </form>
            @endauth
            @guest
            <div class="mb-6 bg-gray-100 dark:bg-gray-700 p-4 rounded-lg text-center">
                <p class="mb-3 text-gray-700 dark:text-gray-200">Yorum yapmak için kayıt olmalısın.</p>
                <a href="{{ route('register', ['redirect' => url()->current()]) }}" class="inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded font-semibold text-sm transition">Kayıt Ol</a>
            </div>
            @endguest
            <div class="muk-comment-list">
                @forelse($comments as $comment)
                    <x-comment-item :comment="$comment" :post="$post" />
                @empty
                    <div class="muk-comment-empty">Henüz yorum yok.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endif
@endsection 