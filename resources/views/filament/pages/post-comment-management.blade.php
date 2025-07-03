<x-filament::page>
    <style>
        .muk-admin-card {
            background: linear-gradient(135deg, #8fd3fe 0%, #19223a 100%);
            border-radius: 22px;
            box-shadow: 0 8px 32px 0 rgba(31,38,135,0.18);
            padding: 2.2rem 2rem 2rem 2rem;
            color: #fff;
            margin-bottom: 2.2rem;
            animation: fadeInUp 0.8s cubic-bezier(.39,.575,.565,1.000);
        }
        .muk-admin-section-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #8fd3fe;
            margin-bottom: 1.1rem;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 8px #19223a44;
        }
        .muk-admin-table-card {
            background: rgba(255,255,255,0.13);
            border-radius: 16px;
            box-shadow: 0 2px 8px 0 rgba(31,38,135,0.10);
            padding: 1.5rem 1.2rem;
            margin-bottom: 1.2rem;
        }
        .muk-admin-table {
            width: 100%;
            border-radius: 12px;
            overflow: hidden;
        }
        .muk-admin-table th, .muk-admin-table td {
            padding: 0.7rem 1rem;
            text-align: left;
        }
        .muk-admin-table th {
            color: #3b82f6;
            font-size: 1.08rem;
            font-weight: 800;
            background: rgba(143,211,254,0.13);
            letter-spacing: 0.5px;
            text-shadow: 0 1px 4px #19223a22;
        }
        .muk-admin-table td {
            color: #fff;
            font-size: 1.07rem;
            background: rgba(255,255,255,0.07);
            font-weight: 500;
            text-shadow: 0 1px 4px #19223a22;
        }
        .muk-admin-table tr {
            border-bottom: 1px solid #8fd3fe33;
        }
        .muk-admin-table tr:last-child {
            border-bottom: none;
        }
        .muk-admin-table td .desc, .desc {
            color: #b6c6e3;
            font-size: 0.98rem;
            font-weight: 400;
        }
        .muk-btn-edit {
            color: #38bdf8;
            font-weight: 700;
            transition: color 0.15s;
        }
        .muk-btn-edit:hover {
            color: #0ea5e9;
            text-decoration: underline;
        }
        .muk-btn-delete {
            color: #f87171;
            font-weight: 700;
            margin-left: 0.5rem;
            transition: color 0.15s;
        }
        .muk-btn-delete:hover {
            color: #dc2626;
            text-decoration: underline;
        }
        .muk-btn-approve {
            color: #34d399;
            font-weight: 700;
            transition: color 0.15s;
        }
        .muk-btn-approve:hover {
            color: #059669;
            text-decoration: underline;
        }
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Son Eklenen Yorumlar -->
        <div class="muk-admin-card">
            <h2 class="muk-admin-section-title">Son Eklenen Yorumlar</h2>
            <div class="overflow-x-auto">
                <table class="muk-admin-table">
                    <thead>
                        <tr>
                            <th>Yorum</th>
                            <th>Yazar</th>
                            <th>Post</th>
                            <th>Tarih</th>
                            <th>İşlem</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentComments as $comment)
                            <tr>
                                <td class="max-w-xs truncate">{{ Str::limit($comment->content, 50) }}</td>
                                <td>{{ $comment->user->name ?? '-' }}</td>
                                <td>
                                    @if($comment->post)
                                        <a href="{{ route('posts.show', $comment->post->slug) }}" class="muk-btn-edit">{{ $comment->post->title }}</a>
                                    @else
                                        <span class="desc">-</span>
                                    @endif
                                </td>
                                <td>{{ $comment->created_at->format('d.m.Y H:i') }}</td>
                                <td>
                                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Yorumu silmek istediğinize emin misiniz?');">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="admin" value="1">
                                        <button type="submit" class="muk-btn-delete">Sil</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center desc">Henüz yorum eklenmemiş.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Son Eklenen Yazılar -->
        <div class="muk-admin-card">
            <h2 class="muk-admin-section-title">Son Eklenen Yazılar</h2>
            <div class="overflow-x-auto">
                <table class="muk-admin-table">
                    <thead>
                        <tr>
                            <th>Başlık</th>
                            <th>Yazar</th>
                            <th>Tarih</th>
                            <th>İşlem</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentPosts as $post)
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->user->name ?? '-' }}</td>
                                <td>{{ $post->created_at->format('d.m.Y H:i') }}</td>
                                <td class="flex gap-2">
                                    <a href="{{ route('posts.edit', $post->slug) }}?admin=1" class="muk-btn-edit">Düzenle</a>
                                    <form action="{{ route('posts.destroy', $post->slug) }}" method="POST" onsubmit="return confirm('Yazıyı silmek istediğinize emin misiniz?');">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="admin" value="1">
                                        <button type="submit" class="muk-btn-delete">Sil</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center desc">Henüz yazı eklenmemiş.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
        <!-- Onay Bekleyen Yorumlar -->
        <div class="muk-admin-card">
            <h2 class="muk-admin-section-title">Onay Bekleyen Yorumlar</h2>
            <div class="overflow-x-auto">
                <table class="muk-admin-table">
                    <thead>
                        <tr>
                            <th>Yorum</th>
                            <th>Yazar</th>
                            <th>Post</th>
                            <th>Tarih</th>
                            <th>İşlem</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($unapprovedComments as $comment)
                            <tr>
                                <td class="max-w-xs truncate">{{ Str::limit($comment->content, 50) }}</td>
                                <td>{{ $comment->user->name ?? '-' }}</td>
                                <td>
                                    @if($comment->post)
                                        <a href="{{ route('posts.show', $comment->post->slug) }}" class="muk-btn-edit">{{ $comment->post->title }}</a>
                                    @else
                                        <span class="desc">-</span>
                                    @endif
                                </td>
                                <td>{{ $comment->created_at->format('d.m.Y H:i') }}</td>
                                <td>
                                    <form action="{{ route('comments.approve', $comment->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        <button type="submit" class="muk-btn-approve">Onayla</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center desc">Onay bekleyen yorum yok.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Onay Bekleyen Yazılar -->
        <div class="muk-admin-card">
            <h2 class="muk-admin-section-title">Onay Bekleyen Yazılar</h2>
            <div class="overflow-x-auto">
                <table class="muk-admin-table">
                    <thead>
                        <tr>
                            <th>Başlık</th>
                            <th>Yazar</th>
                            <th>Tarih</th>
                            <th>İşlem</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($unapprovedPosts as $post)
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->user->name ?? '-' }}</td>
                                <td>{{ $post->created_at->format('d.m.Y H:i') }}</td>
                                <td>
                                    <form action="{{ route('posts.approve', $post->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        <button type="submit" class="muk-btn-approve">Onayla</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center desc">Onay bekleyen yazı yok.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-filament::page> 