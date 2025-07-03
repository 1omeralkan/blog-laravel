<x-filament::page :heading="false">
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
        .muk-admin-title {
            font-size: 2.2rem;
            font-weight: 900;
            color: #fff;
            margin-bottom: 1.2rem;
            letter-spacing: 1px;
            text-align: left;
        }
        .muk-admin-section-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #8fd3fe;
            margin-bottom: 1.1rem;
        }
        .muk-admin-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.2rem;
        }
        .muk-admin-stat-card {
            background: rgba(255,255,255,0.13);
            border-radius: 16px;
            box-shadow: 0 2px 8px 0 rgba(31,38,135,0.10);
            padding: 1.5rem 1.2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform 0.18s, box-shadow 0.18s;
        }
        .muk-admin-stat-card:hover {
            transform: translateY(-3px) scale(1.03);
            box-shadow: 0 8px 32px 0 rgba(31,38,135,0.18);
        }
        .muk-admin-stat-value {
            font-size: 2.3rem;
            font-weight: 900;
            color: #fff;
        }
        .muk-admin-stat-label {
            margin-top: 0.5rem;
            color: #b6c6e3;
            font-size: 1.08rem;
        }
        .muk-admin-table-card {
            background: rgba(255,255,255,0.13);
            border-radius: 16px;
            box-shadow: 0 2px 8px 0 rgba(31,38,135,0.10);
            padding: 1.5rem 1.2rem;
            margin-bottom: 1.2rem;
        }
        .muk-admin-table th, .muk-admin-table td {
            padding: 0.7rem 1rem;
            text-align: left;
        }
        .muk-admin-table th {
            color: #3b82f6;
            font-size: 1.04rem;
            font-weight: 700;
            background: rgba(255,255,255,0.08);
        }
        .muk-admin-table td {
            color: #222e4a;
            font-size: 1.07rem;
            background: rgba(255,255,255,0.03);
        }
        .muk-admin-table tr {
            border-bottom: 1px solid #2e3a5e22;
        }
        .muk-admin-table tr:last-child {
            border-bottom: none;
        }
        .muk-admin-alert {
            background: linear-gradient(90deg, #fbbf24 0%, #f87171 100%);
            color: #222e4a;
            border-radius: 16px;
            padding: 1.2rem 1.2rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 8px 0 rgba(251,191,36,0.10);
            font-size: 1.08rem;
        }
    </style>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Genel İstatistikler -->
        <div class="col-span-1 muk-admin-card flex flex-col items-center justify-center">
            <div class="muk-admin-section-title">Genel İstatistikler</div>
            <div class="muk-admin-stats w-full">
                <div class="muk-admin-stat-card">
                    <div class="muk-admin-stat-value">{{ $postCount ?? '-' }}</div>
                    <div class="muk-admin-stat-label">Toplam Yazı</div>
                </div>
                <div class="muk-admin-stat-card">
                    <div class="muk-admin-stat-value">{{ $categoryCount ?? '-' }}</div>
                    <div class="muk-admin-stat-label">Toplam Kategori</div>
                </div>
                <div class="muk-admin-stat-card">
                    <div class="muk-admin-stat-value">{{ $commentCount ?? '-' }}</div>
                    <div class="muk-admin-stat-label">Toplam Yorum</div>
                </div>
                <div class="muk-admin-stat-card">
                    <div class="muk-admin-stat-value">{{ $userCount ?? '-' }}</div>
                    <div class="muk-admin-stat-label">Toplam Kullanıcı</div>
                </div>
            </div>
        </div>
        <!-- Son Eklenenler -->
        <div class="col-span-1 lg:col-span-2 flex flex-col gap-8">
            <div class="muk-admin-table-card">
                <div class="muk-admin-section-title">Son Eklenen Yazılar</div>
                <div class="overflow-x-auto">
                    <table class="muk-admin-table min-w-full">
                        <thead>
                            <tr>
                                <th>Başlık</th>
                                <th>Yazar</th>
                                <th>Tarih</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPosts as $post)
                                <tr>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->user->name ?? '-' }}</td>
                                    <td>{{ $post->created_at->format('d.m.Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-gray-400">Yazı yok.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="muk-admin-table-card">
                <div class="muk-admin-section-title">Son Eklenen Yorumlar</div>
                <div class="overflow-x-auto">
                    <table class="muk-admin-table min-w-full">
                        <thead>
                            <tr>
                                <th>Yorum</th>
                                <th>Yazar</th>
                                <th>Post</th>
                                <th>Tarih</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentComments as $comment)
                                <tr>
                                    <td class="max-w-xs truncate">{{ Str::limit($comment->content, 50) }}</td>
                                    <td>{{ $comment->user->name ?? '-' }}</td>
                                    <td>{{ $comment->post->title ?? '-' }}</td>
                                    <td>{{ $comment->created_at->format('d.m.Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-gray-400">Yorum yok.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="muk-admin-table-card">
                <div class="muk-admin-section-title">Son Eklenen Kullanıcılar</div>
                <div class="overflow-x-auto">
                    <table class="muk-admin-table min-w-full">
                        <thead>
                            <tr>
                                <th>İsim</th>
                                <th>E-posta</th>
                                <th>Kayıt Tarihi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentUsers as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at->format('d.m.Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-gray-400">Kullanıcı yok.</td>
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
                <div class="muk-admin-alert">
                    <strong>Dikkat!</strong> Onay bekleyen {{ $pendingPostCount }} yazı ve {{ $pendingCommentCount }} yorum var.
                </div>
            @endif
        </div>
    </div>
</x-filament::page> 