<x-filament::page>
    <div class="text-3xl font-bold mb-8">Custom Dashboard</div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Genel İstatistikler -->
        <div class="col-span-1 bg-white rounded-xl shadow p-6 flex flex-col items-center justify-center">
            <h2 class="text-xl font-semibold mb-6 text-gray-800">Genel İstatistikler</h2>
            <div class="grid grid-cols-2 gap-6 w-full">
                <div class="bg-gray-50 rounded-lg p-6 flex flex-col items-center">
                    <div class="text-3xl font-bold text-blue-600">{{ $postCount ?? '-' }}</div>
                    <div class="mt-2 text-gray-600">Toplam Yazı</div>
                </div>
                <div class="bg-gray-50 rounded-lg p-6 flex flex-col items-center">
                    <div class="text-3xl font-bold text-green-600">{{ $categoryCount ?? '-' }}</div>
                    <div class="mt-2 text-gray-600">Toplam Kategori</div>
                </div>
                <div class="bg-gray-50 rounded-lg p-6 flex flex-col items-center">
                    <div class="text-3xl font-bold text-yellow-600">{{ $commentCount ?? '-' }}</div>
                    <div class="mt-2 text-gray-600">Toplam Yorum</div>
                </div>
                <div class="bg-gray-50 rounded-lg p-6 flex flex-col items-center">
                    <div class="text-3xl font-bold text-purple-600">{{ $userCount ?? '-' }}</div>
                    <div class="mt-2 text-gray-600">Toplam Kullanıcı</div>
                </div>
            </div>
        </div>
        <!-- Son Eklenenler -->
        <div class="col-span-1 lg:col-span-2 flex flex-col gap-8">
            <div class="bg-white rounded-xl shadow p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Son Eklenen Yazılar</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Başlık</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Yazar</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tarih</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse($recentPosts as $post)
                                <tr>
                                    <td class="px-4 py-2">{{ $post->title }}</td>
                                    <td class="px-4 py-2">{{ $post->user->name ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $post->created_at->format('d.m.Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-2 text-center text-gray-400">Yazı yok.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Son Eklenen Yorumlar</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Yorum</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Yazar</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Post</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tarih</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse($recentComments as $comment)
                                <tr>
                                    <td class="px-4 py-2 max-w-xs truncate">{{ Str::limit($comment->content, 50) }}</td>
                                    <td class="px-4 py-2">{{ $comment->user->name ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $comment->post->title ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $comment->created_at->format('d.m.Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-2 text-center text-gray-400">Yorum yok.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Son Eklenen Kullanıcılar</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">İsim</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">E-posta</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Kayıt Tarihi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse($recentUsers as $user)
                                <tr>
                                    <td class="px-4 py-2">{{ $user->name }}</td>
                                    <td class="px-4 py-2">{{ $user->email }}</td>
                                    <td class="px-4 py-2">{{ $user->created_at->format('d.m.Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-2 text-center text-gray-400">Kullanıcı yok.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Sistem Bildirimleri / Uyarılar -->
        <div class="col-span-1 lg:col-span-3 mt-8">
            @if($pendingPostCount > 0 || $pendingCommentCount > 0)
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-6 rounded-xl mb-6">
                    <strong>Dikkat!</strong> Onay bekleyen {{ $pendingPostCount }} yazı ve {{ $pendingCommentCount }} yorum var.
                </div>
            @endif
            {{-- Son admin işlemleri/logları eklenebilir --}}
        </div>
    </div>
</x-filament::page> 