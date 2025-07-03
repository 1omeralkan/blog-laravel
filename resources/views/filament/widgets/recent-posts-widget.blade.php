<div class="mt-10">
    <h2 class="text-lg font-semibold mb-4">Son Eklenen Yazılar</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg shadow">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-gray-600">Başlık</th>
                    <th class="px-4 py-2 text-left text-gray-600">Yazar</th>
                    <th class="px-4 py-2 text-left text-gray-600">Tarih</th>
                    <th class="px-4 py-2 text-left text-gray-600">İşlem</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $post->title }}</td>
                        <td class="px-4 py-2">{{ $post->user->name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $post->created_at->format('d.m.Y H:i') }}</td>
                        <td class="px-4 py-2 flex gap-2">
                            <a href="{{ route('posts.edit', $post->slug) }}" class="text-blue-600 hover:underline">Düzenle</a>
                            <form action="{{ route('posts.destroy', $post->slug) }}" method="POST" onsubmit="return confirm('Yazıyı silmek istediğinize emin misiniz?');">
                                @csrf
                                @method('DELETE')
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