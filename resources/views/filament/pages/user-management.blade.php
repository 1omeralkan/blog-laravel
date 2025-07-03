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
        .muk-admin-section-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #8fd3fe;
            margin-bottom: 1.1rem;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 8px #19223a44;
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
        .muk-badge-admin {
            background: #34d39922;
            color: #34d399;
            font-weight: 700;
            border-radius: 8px;
            padding: 0.2rem 0.7rem;
            font-size: 0.95rem;
        }
        .muk-badge-user {
            background: #b6c6e322;
            color: #b6c6e3;
            font-weight: 700;
            border-radius: 8px;
            padding: 0.2rem 0.7rem;
            font-size: 0.95rem;
        }
        .muk-btn-delete {
            color: #f87171;
            background: transparent;
            font-weight: 700;
            border: none;
            padding: 0.2rem 0.7rem;
            border-radius: 8px;
            font-size: 0.95rem;
            transition: color 0.15s, background 0.15s;
        }
        .muk-btn-delete:hover {
            color: #fff;
            background: #f87171;
        }
        .muk-btn-admin {
            color: #fbbf24;
            background: transparent;
            font-weight: 700;
            border: none;
            padding: 0.2rem 0.7rem;
            border-radius: 8px;
            font-size: 0.95rem;
            transition: color 0.15s, background 0.15s;
        }
        .muk-btn-admin:hover {
            color: #fff;
            background: #fbbf24;
        }
        .muk-search {
            border-radius: 12px;
            border: none;
            background: rgba(255,255,255,0.13);
            color: #fff;
            font-size: 1.05rem;
            padding: 0.7rem 1.1rem;
            box-shadow: 0 2px 8px 0 rgba(31,38,135,0.10);
            margin-bottom: 1.2rem;
            width: 100%;
            outline: none;
        }
        .muk-search::placeholder {
            color: #b6c6e3;
        }
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
    <div class="muk-admin-card">
        <h2 class="muk-admin-section-title">Kullanıcı Yönetimi</h2>
        <form method="GET" action="" class="flex flex-col md:flex-row gap-4 items-center mb-6">
            <input type="text" name="search" value="{{ $search }}" placeholder="İsim veya e-posta ile ara..." class="muk-search">
        </form>
        <div class="overflow-x-auto">
            <table class="muk-admin-table">
                <thead>
                    <tr>
                        <th>İsim</th>
                        <th>E-posta</th>
                        <th>Rol</th>
                        <th>Kayıt Tarihi</th>
                        <th>İşlem</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->isAdmin())
                                    <span class="muk-badge-admin">Admin</span>
                                @else
                                    <span class="muk-badge-user">Kullanıcı</span>
                                @endif
                            </td>
                            <td>{{ $user->created_at->format('d.m.Y H:i') }}</td>
                            <td>
                                @if(!$user->isAdmin())
                                    <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" onsubmit="return confirm('Bu kullanıcıyı silmek istediğinize emin misiniz?');" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="muk-btn-delete">Sil</button>
                                    </form>
                                    <span class="mx-1">|</span>
                                    <form action="{{ route('admin.makeAdmin', $user->id) }}" method="POST" onsubmit="return confirm('Bu kullanıcıya admin yetkisi vermek istediğinize emin misiniz?');" style="display:inline">
                                        @csrf
                                        <button type="submit" class="muk-btn-admin">Admin Yap</button>
                                    </form>
                                @else
                                    <span class="text-gray-400 text-xs">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center" style="color:#b6c6e3;">Kullanıcı bulunamadı.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-filament::page> 