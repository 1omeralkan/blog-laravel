<div class="mt-10">
    <h2 class="text-lg font-semibold mb-4">Onay Bekleyen Yazılar</h2>
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