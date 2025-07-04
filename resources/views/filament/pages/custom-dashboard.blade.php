<x-filament::page :heading="false">
    <style>
        body {
            font-family: 'Figtree', 'Inter', 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(120deg, #f8fafc 0%, #e0e7ef 100%) !important;
        }
        .muk-admin-card {
            background: linear-gradient(135deg, #8fd3fe 0%, #19223a 100%);
            border-radius: 28px;
            box-shadow: 0 8px 32px 0 rgba(31,38,135,0.18);
            padding: 2.5rem 2.2rem 2.2rem 2.2rem;
            color: #fff;
            margin-bottom: 2.2rem;
            animation: fadeInUp 0.8s cubic-bezier(.39,.575,.565,1.000);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(2px);
        }
        .muk-admin-title {
            font-size: 2.5rem;
            font-weight: 900;
            background: linear-gradient(90deg, #8fd3fe 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-fill-color: transparent;
            margin-bottom: 1.5rem;
            letter-spacing: 1px;
            text-align: left;
            text-shadow: 0 2px 12px #3b82f633;
        }
        .muk-admin-section-title {
            font-size: 1.35rem;
            font-weight: 800;
            background: linear-gradient(90deg, #8fd3fe 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-fill-color: transparent;
            margin-bottom: 1.1rem;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 8px #3b82f633;
        }
        .muk-admin-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.2rem;
        }
        .muk-admin-stat-card {
            background: rgba(255,255,255,0.13);
            border-radius: 18px;
            box-shadow: 0 2px 8px 0 rgba(31,38,135,0.10);
            padding: 1.7rem 1.2rem 1.2rem 1.2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform 0.18s, box-shadow 0.18s;
            position: relative;
        }
        .muk-admin-stat-card:hover {
            transform: translateY(-4px) scale(1.04);
            box-shadow: 0 12px 36px 0 rgba(31,38,135,0.22);
        }
        .muk-admin-stat-value {
            font-size: 2.5rem;
            font-weight: 900;
            color: #fff;
            letter-spacing: 1px;
            text-shadow: 0 2px 8px #3b82f655;
        }
        .muk-admin-stat-label {
            margin-top: 0.5rem;
            color: #b6c6e3;
            font-size: 1.13rem;
            font-weight: 600;
            letter-spacing: 0.2px;
        }
        .muk-admin-table-card {
            background: rgba(255,255,255,0.13);
            border-radius: 18px;
            box-shadow: 0 2px 8px 0 rgba(31,38,135,0.10);
            padding: 1.7rem 1.2rem 1.2rem 1.2rem;
            margin-bottom: 1.2rem;
            overflow-x: auto;
        }
        .muk-admin-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 2px 12px 0 rgba(31,38,135,0.08);
        }
        .muk-admin-table th, .muk-admin-table td {
            padding: 0.7rem 1rem;
            text-align: left;
        }
        .muk-admin-table th {
            background: linear-gradient(90deg, #3b82f6 0%, #8fd3fe 100%);
            color: #f8fafc;
            font-size: 1.08rem;
            font-weight: 800;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #60a5fa44;
            box-shadow: 0 2px 8px 0 rgba(31,38,135,0.06);
        }
        .muk-admin-table td {
            color: #23304a;
            font-size: 1.09rem;
            background: rgba(255,255,255,0.13);
            font-weight: 600;
            border-bottom: 1.5px solid #e0e7ef55;
            transition: color 0.18s, background 0.18s;
        }
        .muk-admin-table tr {
            border-bottom: 1.5px solid #e0e7ef55;
            transition: background 0.18s;
        }
        .muk-admin-table tr:hover td {
            background: linear-gradient(90deg, #60a5fa 0%, #a5b4fc 100%);
            color: #fff;
        }
        .muk-admin-table tr:last-child td {
            border-bottom: none;
        }
        .muk-admin-table td.text-center, .muk-admin-table th.text-center {
            text-align: center;
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
        @media (max-width: 1024px) {
            .grid-cols-3 { grid-template-columns: 1fr !important; }
            .muk-admin-card, .muk-admin-table-card { padding: 1.2rem 0.7rem; }
            .muk-admin-title { font-size: 2rem; }
        }
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
    <div class="muk-admin-title">Admin Panel Dashboard</div>
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