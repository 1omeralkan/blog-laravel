@props(['comment', 'post', 'depth' => 0])

@php $isOwner = auth()->check() && auth()->id() === $comment->user_id; @endphp

<div class="muk-comment-card" style="margin-left: {{ $depth * 20 }}px;" id="comment-card-{{ $comment->id }}">
    <div class="muk-comment-avatar">
        {{ mb_substr($comment->user->name ?? 'A', 0, 1) }}
    </div>
    <div class="muk-comment-content">
        <div class="muk-comment-meta">
            <span class="muk-comment-author">{{ $comment->user->name ?? 'Anonim' }}</span>
            <span class="muk-comment-date">{{ $comment->created_at->diffForHumans() }}</span>
        </div>
        <div class="muk-comment-text" id="comment-text-{{ $comment->id }}">{{ $comment->content }}</div>
        
        @auth
        <div class="muk-comment-actions" style="margin-top: 0.5rem;">
            @if($depth < 2)
            <button onclick="showReplyForm({{ $comment->id }})" class="text-blue-400 hover:text-blue-300 text-sm font-medium">
                Yanıtla
            </button>
            @endif
            @if($isOwner)
            <button onclick="showEditForm({{ $comment->id }}, '{{ route('comments.edit', $comment->id) }}')" class="text-yellow-400 hover:text-yellow-300 text-sm font-medium ml-3">
                Düzenle
            </button>
            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Yorumu silmek istediğinize emin misiniz?')" 
                        class="text-red-400 hover:text-red-300 text-sm font-medium ml-3">
                    Sil
                </button>
            </form>
            @endif
        </div>
        
        <!-- Edit Form -->
        @if($isOwner)
        <div id="edit-form-{{ $comment->id }}" class="muk-edit-form" style="display: none; margin-top: 0.8rem;">
            <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                @csrf
                @method('PUT')
                <textarea name="content" id="edit-content-{{ $comment->id }}" required class="w-full min-h-[60px] p-2 rounded-lg border border-yellow-400 bg-white text-gray-900 text-sm"></textarea>
                <div class="flex gap-2 mt-2">
                    <button type="submit" class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded text-sm">
                        Kaydet
                    </button>
                    <button type="button" onclick="hideEditForm({{ $comment->id }})" class="px-3 py-1 bg-gray-500 hover:bg-gray-600 text-white rounded text-sm">
                        İptal
                    </button>
                </div>
            </form>
        </div>
        @endif
        <!-- Reply Form -->
        <div id="reply-form-{{ $comment->id }}" class="muk-reply-form" style="display: none; margin-top: 0.8rem;">
            <form action="{{ route('comments.store', $post->slug) }}" method="POST">
                @csrf
                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                <textarea name="content" placeholder="Yanıtınızı yazın..." required 
                          class="w-full min-h-[60px] p-2 rounded-lg border border-gray-300 dark:border-gray-600 
                                 bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm"></textarea>
                @error('content') 
                    <span class="text-red-500 text-xs">{{ $message }}</span> 
                @enderror
                <div class="flex gap-2 mt-2">
                    <button type="submit" class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded text-sm">
                        Yanıtla
                    </button>
                    <button type="button" onclick="hideReplyForm({{ $comment->id }})" 
                            class="px-3 py-1 bg-gray-500 hover:bg-gray-600 text-white rounded text-sm">
                        İptal
                    </button>
                </div>
            </form>
        </div>
        @endauth
    </div>
</div>

<!-- Render replies -->
@if($comment->replies && $comment->replies->count() > 0)
    @foreach($comment->replies->where('is_approved', true) as $reply)
        <x-comment-item :comment="$reply" :post="$post" :depth="$depth + 1" />
    @endforeach
@endif

<style>
.muk-reply-form textarea:focus, .muk-edit-form textarea:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
}
</style>

<script>
function showReplyForm(commentId) {
    document.getElementById('reply-form-' + commentId).style.display = 'block';
    if(document.getElementById('edit-form-' + commentId)) {
        document.getElementById('edit-form-' + commentId).style.display = 'none';
    }
}
function hideReplyForm(commentId) {
    document.getElementById('reply-form-' + commentId).style.display = 'none';
}
function showEditForm(commentId, editUrl) {
    // Get content via AJAX
    fetch(editUrl)
        .then(response => response.json())
        .then(data => {
            document.getElementById('edit-content-' + commentId).value = data.content;
            document.getElementById('edit-form-' + commentId).style.display = 'block';
            document.getElementById('comment-text-' + commentId).style.display = 'none';
            if(document.getElementById('reply-form-' + commentId)) {
                document.getElementById('reply-form-' + commentId).style.display = 'none';
            }
        });
}
function hideEditForm(commentId) {
    document.getElementById('edit-form-' + commentId).style.display = 'none';
    document.getElementById('comment-text-' + commentId).style.display = 'block';
}
</script> 