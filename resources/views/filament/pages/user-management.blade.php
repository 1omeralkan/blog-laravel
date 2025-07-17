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
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.2rem;">
            <span class="muk-admin-section-title" style="margin: 0;">Kullanıcı Yönetimi</span>
            <a href="/dashboard" class="muk-dash-btn" style="background: linear-gradient(90deg, #8fd3fe 0%, #3b82f6 100%); color: #222e4a; font-weight:700; padding: 0.5rem 1.2rem; border-radius: 10px; display: inline-block; box-shadow: 0 2px 8px 0 rgba(31,38,135,0.10);">← Geri Dön</a>
        </div>
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
                                @if(Auth::id() !== $user->id)
                                    <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" style="display:inline" onsubmit="event.preventDefault(); openDeleteModal(this);">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="muk-btn-delete">Sil</button>
                                    </form>
                                    <span class="mx-1">|</span>
                                    <form action="{{ route('admin.toggleAdmin', $user->id) }}" method="POST" style="display:inline" onsubmit="event.preventDefault(); openAdminModal(this);">
                                        @csrf
                                        <button type="submit" class="muk-btn-admin">
                                            {{ $user->isAdmin() ? 'Adminliği Kaldır' : 'Admin Yap' }}
                                        </button>
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

<!-- Admin Toggle Modal -->
<div id="admin-toggle-modal" class="admin-modal-backdrop" style="display:none;">
    <div class="admin-modal">
        <button class="admin-modal-close" onclick="closeAdminModal()">&times;</button>
        <div class="admin-modal-header">
            <span class="admin-modal-icon">⚡</span>
            <span class="admin-modal-title">Yetki Değiştir</span>
        </div>
        <div class="admin-modal-desc">
            Bu kullanıcının admin yetkisini değiştirmek istediğinize emin misiniz?
        </div>
        <div class="admin-modal-actions">
            <button class="admin-modal-btn admin-modal-btn-blue" id="admin-modal-evet">Evet</button>
            <button class="admin-modal-btn admin-modal-btn-red" onclick="closeAdminModal()">Vazgeç</button>
        </div>
    </div>
</div>

<!-- Kullanıcı Sil Modalı -->
<div id="delete-user-modal" class="delete-modal-backdrop" style="display:none;">
    <div class="delete-modal">
        <button class="delete-modal-close" onclick="closeDeleteModal()">&times;</button>
        <div class="delete-modal-header">
            <span class="delete-modal-icon">🗑️</span>
            <span class="delete-modal-title">Kullanıcıyı Sil</span>
        </div>
        <div class="delete-modal-desc">
            Bu kullanıcıyı silmek istediğinize emin misiniz?
        </div>
        <div class="delete-modal-actions">
            <button class="delete-modal-btn delete-modal-btn-red" id="delete-modal-evet">Evet</button>
            <button class="delete-modal-btn delete-modal-btn-blue" onclick="closeDeleteModal()">Vazgeç</button>
        </div>
    </div>
</div>

<style>
.admin-modal-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(30, 41, 59, 0.25);
    backdrop-filter: blur(6px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    animation: modal-fade-in 350ms cubic-bezier(.39,.575,.565,1.000);
}
@keyframes modal-fade-in {
    0% { opacity: 0; transform: scale(0.95);}
    100% { opacity: 1; transform: scale(1);}
}
.admin-modal {
    background: rgba(255,255,255,0.95);
    border-radius: 22px;
    box-shadow: 0 8px 32px 0 rgba(31,38,135,0.18);
    padding: 2.2rem 2rem 1.5rem 2rem;
    min-width: 320px;
    max-width: 95vw;
    width: 100%;
    max-width: 370px;
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    animation: modal-fade-in 350ms cubic-bezier(.39,.575,.565,1.000);
}
.admin-modal-header {
    display: flex;
    align-items: center;
    gap: 0.7rem;
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 0.7rem;
    color: #222e4a;
}
.admin-modal-icon {
    font-size: 1.6rem;
    color: #3b82f6;
}
.admin-modal-title {
    font-size: 1.15rem;
    font-weight: 800;
    color: #222e4a;
}
.admin-modal-desc {
    color: #334155;
    font-size: 1.04rem;
    margin-bottom: 1.3rem;
    text-align: center;
    line-height: 1.5;
}
.admin-modal-actions {
    display: flex;
    gap: 1.1rem;
    width: 100%;
    justify-content: center;
}
.admin-modal-btn {
    border: none;
    border-radius: 999px;
    padding: 0.7rem 1.7rem;
    font-size: 1.08rem;
    font-weight: 700;
    cursor: pointer;
    transition: background 0.18s, color 0.18s, transform 0.15s;
    outline: none;
    box-shadow: 0 2px 8px 0 rgba(31,38,135,0.10);
}
.admin-modal-btn-blue {
    background: linear-gradient(90deg, #8fd3fe 0%, #3b82f6 100%);
    color: #222e4a;
}
.admin-modal-btn-blue:hover {
    background: linear-gradient(90deg, #3b82f6 0%, #8fd3fe 100%);
    color: #fff;
}
.admin-modal-btn-red {
    background: linear-gradient(90deg, #f87171 0%, #fbbf24 100%);
    color: #222e4a;
}
.admin-modal-btn-red:hover {
    background: linear-gradient(90deg, #fbbf24 0%, #f87171 100%);
    color: #fff;
}
.admin-modal-close {
    position: absolute;
    top: 1.1rem;
    right: 1.1rem;
    background: none;
    border: none;
    font-size: 1.5rem;
    color: #64748b;
    cursor: pointer;
    transition: color 0.18s;
    z-index: 2;
}
.admin-modal-close:hover {
    color: #ef4444;
}
@media (max-width: 500px) {
    .admin-modal { padding: 1.2rem 0.5rem 1rem 0.5rem; min-width: 0; }
}
.delete-modal-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(30, 41, 59, 0.25);
    backdrop-filter: blur(6px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    animation: modal-fade-in 350ms cubic-bezier(.39,.575,.565,1.000);
}
.delete-modal {
    background: rgba(255,255,255,0.95);
    border-radius: 22px;
    box-shadow: 0 8px 32px 0 rgba(31,38,135,0.28);
    padding: 2.2rem 2rem 1.5rem 2rem;
    min-width: 320px;
    max-width: 95vw;
    width: 100%;
    max-width: 370px;
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    animation: modal-fade-in 350ms cubic-bezier(.39,.575,.565,1.000);
}
.delete-modal-header {
    display: flex;
    align-items: center;
    gap: 0.7rem;
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 0.7rem;
    color: #222e4a;
}
.delete-modal-icon {
    font-size: 1.6rem;
    color: #f87171;
}
.delete-modal-title {
    font-size: 1.15rem;
    font-weight: 800;
    color: #222e4a;
}
.delete-modal-desc {
    color: #334155;
    font-size: 1.04rem;
    margin-bottom: 1.3rem;
    text-align: center;
    line-height: 1.5;
}
.delete-modal-actions {
    display: flex;
    gap: 1.1rem;
    width: 100%;
    justify-content: center;
}
.delete-modal-btn {
    border: none;
    border-radius: 999px;
    padding: 0.7rem 1.7rem;
    font-size: 1.08rem;
    font-weight: 700;
    cursor: pointer;
    transition: background 0.18s, color 0.18s, transform 0.15s;
    outline: none;
    box-shadow: 0 2px 8px 0 rgba(31,38,135,0.10);
}
.delete-modal-btn-red {
    background: linear-gradient(90deg, #f87171 0%, #fbbf24 100%);
    color: #222e4a;
}
.delete-modal-btn-red:hover {
    background: linear-gradient(90deg, #fbbf24 0%, #f87171 100%);
    color: #fff;
}
.delete-modal-btn-blue {
    background: linear-gradient(90deg, #8fd3fe 0%, #3b82f6 100%);
    color: #222e4a;
}
.delete-modal-btn-blue:hover {
    background: linear-gradient(90deg, #3b82f6 0%, #8fd3fe 100%);
    color: #fff;
}
.delete-modal-close {
    position: absolute;
    top: 1.1rem;
    right: 1.1rem;
    background: none;
    border: none;
    font-size: 1.5rem;
    color: #64748b;
    cursor: pointer;
    transition: color 0.18s;
    z-index: 2;
}
.delete-modal-close:hover {
    color: #ef4444;
}
@media (max-width: 500px) {
    .delete-modal { padding: 1.2rem 0.5rem 1rem 0.5rem; min-width: 0; }
}
</style>
<script>
let adminToggleForm = null;
function openAdminModal(form) {
    adminToggleForm = form;
    document.getElementById('admin-toggle-modal').style.display = 'flex';
}
function closeAdminModal() {
    document.getElementById('admin-toggle-modal').style.display = 'none';
    adminToggleForm = null;
}
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('admin-modal-evet').onclick = function() {
        if (adminToggleForm) adminToggleForm.submit();
        closeAdminModal();
    };
});
let deleteUserForm = null;
function openDeleteModal(form) {
    deleteUserForm = form;
    document.getElementById('delete-user-modal').style.display = 'flex';
}
function closeDeleteModal() {
    document.getElementById('delete-user-modal').style.display = 'none';
    deleteUserForm = null;
}
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('delete-modal-evet').onclick = function() {
        if (deleteUserForm) deleteUserForm.submit();
        closeDeleteModal();
    };
});
</script>
</x-filament::page> 