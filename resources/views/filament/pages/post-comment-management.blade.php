<x-filament::page>
    <div class="text-2xl font-bold mb-8">Post/Yorum Yönetimi</div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Son Eklenen Yorumlar -->
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold mb-4 text-gray-800">Son Eklenen Yorumlar</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Yorum</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Yazar</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Post</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tarih</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">İşlem</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($recentComments as $comment)
                            <tr>
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
                                        <input type="hidden" name="admin" value="1">
                                        <button type="submit" class="text-red-600 hover:underline">Sil</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-2 text-center text-gray-400">Henüz yorum eklenmemiş.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Son Eklenen Yazılar -->
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold mb-4 text-gray-800">Son Eklenen Yazılar</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Başlık</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Yazar</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tarih</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">İşlem</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($recentPosts as $post)
                            <tr>
                                <td class="px-4 py-2">{{ $post->title }}</td>
                                <td class="px-4 py-2">{{ $post->user->name ?? '-' }}</td>
                                <td class="px-4 py-2">{{ $post->created_at->format('d.m.Y H:i') }}</td>
                                <td class="px-4 py-2 flex gap-2">
                                    <a href="{{ route('posts.edit', $post->slug) }}?admin=1" class="text-blue-600 hover:underline">Düzenle</a>
                                    <form action="{{ route('posts.destroy', $post->slug) }}" method="POST" onsubmit="return confirm('Yazıyı silmek istediğinize emin misiniz?');">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="admin" value="1">
                                        <button type="submit" class="text-red-600 hover:underline ml-2">Sil</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-2 text-center text-gray-400">Henüz yazı eklenmemiş.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
        <!-- Onay Bekleyen Yorumlar -->
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold mb-4 text-gray-800">Onay Bekleyen Yorumlar</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Yorum</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Yazar</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Post</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tarih</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">İşlem</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($unapprovedComments as $comment)
                            <tr>
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
                                    <form action="{{ route('comments.approve', $comment->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:underline">Onayla</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-2 text-center text-gray-400">Onay bekleyen yorum yok.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Onay Bekleyen Yazılar -->
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold mb-4 text-gray-800">Onay Bekleyen Yazılar</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Başlık</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Yazar</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tarih</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">İşlem</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($unapprovedPosts as $post)
                            <tr>
                                <td class="px-4 py-2">{{ $post->title }}</td>
                                <td class="px-4 py-2">{{ $post->user->name ?? '-' }}</td>
                                <td class="px-4 py-2">{{ $post->created_at->format('d.m.Y H:i') }}</td>
                                <td class="px-4 py-2">
                                    <form action="{{ route('posts.approve', $post->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:underline">Onayla</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-2 text-center text-gray-400">Onay bekleyen yazı yok.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-filament::page> 