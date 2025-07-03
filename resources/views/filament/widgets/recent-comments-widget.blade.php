<div class="mt-10">
    <h2 class="text-lg font-semibold mb-4">Son Eklenen Yorumlar</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg shadow">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-gray-600">Yorum</th>
                    <th class="px-4 py-2 text-left text-gray-600">Yazar</th>
                    <th class="px-4 py-2 text-left text-gray-600">Post</th>
                    <th class="px-4 py-2 text-left text-gray-600">Tarih</th>
                    <th class="px-4 py-2 text-left text-gray-600">İşlem</th>
                </tr>
            </thead>
            <tbody>
                @forelse($comments as $comment)
                    <tr class="border-t">
                        <td class="px-4 py-2 max-w-xs truncate">{{ Str::limit($comment->content, 50) }}</td>
                        <td class="px-4 py-2">{{ $comment->user->name ?? '-' }}</td>
                        <td class="px-4 py-2">
                            @if($comment->post)
                                <a href="{{ route('posts.show', $comment->post->slug) }}" class="text-blue-600 hover:underline">{{ $comment->post->title }}</a>
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ $comment->created_at->format('d.m.Y H:i') }}</td>
                        <td class="px-4 py-2">
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Yorumu silmek istediğinize emin misiniz?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Sil</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-2 text-center text-gray-400">Henüz yorum eklenmemiş.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div> 